<?php

namespace App\Repositories;

use App\Lot;
use App\Product;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Mockery\CountValidator\Exception;

class ProductsRepository extends Repository
{
    /**
     * @return Product
     */
    public function getModel()
    {
        return new Product();
    }

    /**
     * Get all published products
     *
     * @return mixed
     */
    public function getPublic()
    {
        return self::getModel()
            ->published()
            ->get();
    }

    /**
     * Find product by id/slug.
     *
     * @param $slug
     * @return Product
     */
    public function find($slug)
    {
        if (is_numeric($slug))
            return $this->getModel()
                ->whereId((int) $slug)
//                ->whereIn('status', ['published', 'drafted', 'notverified', 'completed'])
                ->first();

        return $this->getModel()
            ->whereSlug($slug)
//            ->whereIn('status', ['published', 'drafted', 'notverified', 'completed'])
            ->first();
    }

    /**
     * Create product.
     * 
     * @param array $data
     * @return Product
     */
    public function create(array $data)
    {
        return self::getModel()
            ->create([
                'vendor_id' => $data['vendor_id'],
                'name' => (isset($data['name']) ? $data['name'] : ''),
                'price' => (isset($data['price']) ? $data['price'] : ''),
                'sale' => (isset($data['sale'])) ? $data['sale'] : 0,
                'count' => (isset($data['count'])) ? $data['count'] : 1,
                'type' => (isset($data['type'])) ? $data['type'] : 'new',
                'status' => (isset($data['status'])) ? $data['status'] : 'drafted',
                'published_date' => (isset($data['published_date']) ? $data['published_date'] : Carbon::now()),
                'expiration_date' => (isset($data['expiration_date']) ? $data['expiration_date'] : Carbon::now()),
                'active' => (isset($data['active']) ? $data['active'] : 0)
            ]);
    }

    /**
     * Update data.
     *
     * @param $product
     * @param $data
     * @return mixed
     */
    public function update($product, $data)
    {
        if(! $product instanceof Model)
            throw new Exception('First argument MUST be an instance of '.Model::class);

        $product->fill([
            'name' => (isset($data['name']) ? $data['name'] : $product->name),
            'price' => (isset($data['price']) ? $data['price'] : $product->price),
            'sale' => (isset($data['sale'])) ? $this->formatSale($data['sale']) : $product->sale,
            'count' => (isset($data['count'])) ? $data['count'] : $product->count,
            'description' => (isset($data['description'])) ? $data['description'] : $product->description,
            'type' => (isset($data['type'])) ? $data['type'] : 'new',
            'status' => ($product->status == 'drafted') ? 'notverified' : $product->status,
            'published_date' => (isset($data['published_date']) ? $this->dateToTimestamp($data['published_date']) : $product->published_date),
            'expiration_date' => (isset($data['expiration_date']) ? $this->dateToTimestamp($data['expiration_date']) : $product->published_date),
            'active' => 1
        ]);

        $product->save();

        return $product;
    }

    /**
     * Reformat date.
     *
     * @param $date
     * @param string $delimiter
     * @return mixed
     */
    public function reformatDateString($date, $delimiter = '.')
    {
        $datas = explode($delimiter, $date);

        $new_date['d'] = $datas[0];
        $new_date['m'] = $datas[1];
        $new_date['y'] = $datas[2];

        return $new_date;
    }

    /**
     * Convert string date to \Carbon/Carbon timestamp.
     *
     * @param $date
     * @return static
     */
    public function dateToTimestamp($date)
    {
        $dates = $this->reformatDateString($date);

        return Carbon::createFromDate($dates['y'], $dates['m'], $dates['d']);
    }

    /**
     * Remove product row from table.
     *
     * @param $id
     * @return bool|null
     * @throws \Exception
     */
    public function delete($id)
    {
        return $this->find($id)->delete();
    }

    /**
     * Get random products.
     *
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function getSomeRandomProducts()
    {
        $random_element_1 = rand(1, 2);
        $random_element_2 = rand(1, 2);
        $random_element_3 = rand(1, 2);

        $query = self::getModel()->select('*');

        if ($random_element_1 == 1) {
            $query->published();
        } else {
            $query->drafted();
        }

        if ($random_element_2 == 1) {
            $query->whereType('old');
        } else {
            $query->whereType('new');
        }

        if ($random_element_3 == 1) {
            $query->whereBetween('sale', [1, 50]);
        } else {
            $query->whereBetween('sale', [51, 100]);
        }

        return $query->get();
    }

    /**
     * Get drafted product by id.
     * 
     * @param $id
     * @return mixed
     */
    public function findDrafted($id)
    {
        return self::getModel()
            ->whereId($id)
            ->drafted()
            ->first();
    }

    public function search($filters)
    {
        $product = $filters['search'];

        if(isset($filters['category']))
            $category = $filters['category'];

        if(empty($product) && (!isset($category)))
            return null;

        if(isset($category))
        {
            $query = $this->getModel()
                ->select('products.*', 'categoryable.category_id')
                ->where('products.name', 'like', '%'.$product.'%')
                ->join('categoryable', 'products.id', '=', 'categoryable.categoryable_id')
                ->where('categoryable.categoryable_type', get_class(self::getModel()))
                ->where('categoryable.category_id', $category);
        } else
        {
            $query = $this->getModel()
                ->where('name', 'like', '%'.$product.'%');
        }

        $query->where('products.active', 1)
            ->whereIn('status', ['published', 'completed']);

        return $query->get();
    }

    /**
     * Remove percent from sale if it exists.
     *
     * @param $sale
     * @return int
     */
    private function formatSale($sale)
    {
        list($sale, $percent) = explode('%', $sale);

        return (int) $sale;
    }

    /**
     * Get same products.
     *
     * @param mixed
     */
    public function getSameProduct($product)
    {
        //
    }

    /**
     * Get public latest created products.
     *
     * @param int $count
     * @return mixed
     */
    public function getPublicLatest($count = 8)
    {
        return $this->getModel()
            ->active()
//            ->published() // todo: on production back it.
            ->orderBy('id', self::DESC)
            ->take($count)
            ->get();
    }

    /**
     * Get popular products.
     *
     * @return mixed
     */
    public function getFeaturedPublic($count = 8)
    {
        return $this->getModel()
//            ->published()
            ->featured()
            ->active()
            ->orderBy('id', self::DESC)
            ->take($count)
            ->get();
    }

    /**
     * Get expire soon products.
     *
     * @param int $count
     * @return mixed
     */
    public function getPublicExpireSoon($count = 8)
    {
        return $this->getModel()
//            ->published()
            ->active()
//            ->where('expiration_date', '>', Carbon::now())
//            ->orderBy('expiration_date', self::ASC)
            ->orderBy('id', self::ASC)
            ->take($count)
            ->get();
    }

    /**
     * Expire soon products.
     *
     * @param int $paginate
     * @return mixed
     */
    public function getExpireSoon($paginate = 10)
    {
        $query = $this->getModel()
            ->published()
            ->active()
            ->where('expiration_date', '>', Carbon::now())
            ->orderBy('expiration_date', self::ASC);

        if(request()->get('name'))
            $query->orderBy('name', request()->get('name') == self::ASC ? self::ASC : self::DESC);

        if(request()->get('created_at'))
            $query->orderBy('created_at', request()->get('created_at') == self::ASC ? self::ASC : self::DESC);

        if(request()->get('price'))
            $query->orderBy('price', request()->get('price') == self::ASC ? self::ASC : self::DESC);

//        return $query->orderBy('id', self::ASC)
            return $query->paginate($paginate);
    }

    /**
     * Create plain product for \App\Lot $lot
     *
     * @param Lot $lot
     * @return static
     */
    public function createPlain(Lot $lot)
    {
        return self::getModel()
            ->create([
                'lot_id' => $lot->id
            ]);
    }

    public function saveProduct($product, array $data)
    {
        $product->fill([
            'name' => isset($data['name']) ? $data['name'] : null,
            'old_price' => isset($data['old_price']) ? $data['old_price'] : null,
            'price' => isset($data['price']) ? $data['price'] : null,
            'sale' => isset($data['sale']) ? $data['sale'] : null,
        ]);

        $product->save();
    }
}