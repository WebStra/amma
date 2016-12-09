<?php

use App\Lot;
use Illuminate\Database\Eloquent\Builder;
use App\Currency;
use App\SubCategory;

return [
    'title' => 'Products',

    'description' => 'Users products',

    'model' => 'App\Product',

    /*
    |-------------------------------------------------------
    | Columns/Groups
    |-------------------------------------------------------
    |
    | Describe here full list of columns that should be presented
    | on main listing page
    |
    */
    'columns' => [
        'id',

        'image' => [
            'title' => 'Imagine',
            'output' => function($row)
            {
                $image = $row->images()->cover()->first();

                return $image ? output_image($image->image, null, ['width' => '100']) : '';
            }
        ],

        'name',

        'lot_id' => [
            'title' =>'Lot',
            'output' => function ($row) {
                if($lot = $row->lot_id)
                    $lotname = Lot::where('id',$lot)->first();
                return sprintf('%s','<a href="/admin/lot?id='.$row->lot_id.'">'.$lotname['name'].'</a>');
            }
        ],

        'price_info' => [
            'title' => 'Price Information',
            'elements' => [
                'price' => [
                    'title' => 'Current Price',
                    'output' => function ($row) {
                        $lotid = lot::where('id',$row->lot_id)->pluck('currency_id')->first();
                        $currency = Currency::where('id',$lotid)->pluck('sign')->first();
                        return sprintf('%s%s', ceil($row->price) ,$currency);
                    }
                ],
                'sale' => [
                    'title' => 'Sale',
                    'output' => function ($row) {
                        return sprintf("%s %%", $row->sale);
                    }
                ],
                'new_price' => [
                    'title' => 'Price with sale',
                    'output' => function ($row) {
                        $lotid = lot::where('id',$row->lot_id)->pluck('currency_id')->first();
                        $currency = Currency::where('id',$lotid)->pluck('sign')->first();
                        return sprintf('%s%s', ( // calc percent.
                            ceil($row->price - ($row->price * ($row->sale / 100)))),$currency
                        );
                    }
                ],
                'count' => [
                    'title' => 'Remains',
                    'output' => function ($row) {
                        return sprintf('%s unit.', $row->count);
                    }
                ]
            ]
        ],
    ],

    /*
    |-------------------------------------------------------
    | Actions available to do, including global
    |-------------------------------------------------------
    |
    | Global actions
    |
    */
    'actions' => [

    ],

    /*
    |-------------------------------------------------------
    | Eloquent With Section
    |-------------------------------------------------------
    |
    | Eloquent lazy data loading, just list relations that should be preloaded
    |
    */
    'with' => [

    ],

    /*
    |-------------------------------------------------------
    | QueryBuilder
    |-------------------------------------------------------
    |
    | Extend the main scaffold index query
    |
    */
    'query' => function (Builder $query) {

        if(request('lot_id'))
        return $query->where('lot_id',request('lot_id'));

        return $query;
    },

    /*
    |-------------------------------------------------------
    | Global filter
    |-------------------------------------------------------
    |
    | Filters should be defined here
    |
    */
    'filters' => [
        'id' => filter_hidden(),


        'price' => filter_number_range('Price Range', [
            'min' => '100',
            'max' => '10000'
        ]),
    ],

    /*
    |-------------------------------------------------------
    | Editable area
    |-------------------------------------------------------
    |
    | Describe here all fields that should be editable
    |
    */
    'edit_fields' => [

        'id' => form_key(),

        'sub_category_id' => form_select('Subcategoria', function () {
            $items = [];

            $collection = SubCategory::select('*')->active()->get();

            foreach ($collection as $item)
            {
                $items[$item->id] = $item->name;
            }

            return $items;
        }),

        'name' => form_text(),

        'description' => form_ckeditor(),

        'price' => form_text(),

        'sale' => form_text(),

        'old_price' => form_text(),

        'count' => form_text(),

        'active' => form_boolean()
    ]
];