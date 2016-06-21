<?php

namespace App\Repositories;

use App\Product;
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
                ->whereIn('status', ['published', 'drafted', 'notverified', 'completed'])
                ->first();

        return $this->getModel()
            ->whereSlug($slug)
            ->whereIn('status', ['published', 'drafted', 'notverified', 'completed'])
            ->first();
    }

    /**
     * Create product.
     * 
     * @param array $data
     * @return static
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
                'published_date' => (isset($data['published_date']) ? $data['published_date'] : ''),
                'expiration_date' => (isset($data['expiration_date']) ? $data['expiration_date'] : ''),
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
            'name' => (isset($data['name']) ? $data['name'] : ''),
            'price' => (isset($data['price']) ? $data['price'] : ''),
            'sale' => (isset($data['sale'])) ? $data['sale'] : 0,
            'count' => (isset($data['count'])) ? $data['count'] : 1,
            'type' => (isset($data['type'])) ? $data['type'] : 'new',
            'status' => (isset($data['status'])) ? $data['status'] : 'notverified',
            'published_date' => (isset($data['published_date']) ? $data['published_date'] : ''),
            'expiration_date' => (isset($data['expiration_date']) ? $data['expiration_date'] : ''),
            'active' => 1
        ]);

        $product->save();

        return $product;
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
}