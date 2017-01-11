<?php

use App\Category;
use App\Currency;
use App\Lot;
return [
    'title' => 'Verified Lots',

    'description' => 'Users Lots',

    'model' => Lot::class,

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

        'name' => [
            'title'=>'Denumire',
            'output'=> function($row) {
                return sprintf('%s','<a href="/admin/products?lot_id='.$row->id.'">'.$row->name.'</a>');
            }
        ],

        'vendor' => [
            'title' => 'Magazin',
            'output' => function ($row) {
                if($vendor = $row->vendor)
                    return sprintf('Magazin: <a href="/admin/allvendors?id=%s">%s</a>', $vendor->id, $vendor->present()->renderTitle());
                return sprintf('No vendor');
            }
        ],

        'status' => [
            'output' => function ($row){
                switch ($row->verify_status) {
                    case 'verified':
                        $status = '<b style="color: #00a65a">Verified</b>';
                        break;

                    default:
                        $status = '<b>No Status</b>';
                }

                return $status;
            }
        ],

        'price_info' => [
            'title' => 'Price Information',
            'output' => function ($row) {
                $currency= Currency::where('id', $row->currency_id)->pluck('title')->first();
                return sprintf('%s %s', ceil($row->yield_amount),$currency);
            }
        ],

        'comision',

        'dates' => [
            'elements' => [
                'public_date',
                'expire_date',
            ]
        ]
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
    'query' => function ($query) {

        return $query->where('status','complete')->where('verify_status','verified')->orderBy('public_date','desc');
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

        'verify_status' => filter_select('Status', [
            '' => '-- Any --',
            'verified' => '-- Verificat --',
            'pending' => '-- In Asteptare --',
            'declined' => '-- Refuzat --',
        ]),


        'created_at' => filter_daterange('Created period'),
        'published_date' => filter_daterange('Published date'),
        'expiration_date' => filter_daterange('Expiration date')
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

        'category_id' => form_select('Categoria', function () {
            $items = [];

            $collection = Category::select('*')->active()->get();

            foreach ($collection as $item)
            {
                $items[$item->id] = $item->name;
            }

            return $items;
        }),

        'name' => form_text(),

        'description' => form_textarea(),

        'currency_id' => form_select('Currency', function () {
            $items = [];

            $collection = Currency::select('*')->active()->get();

            foreach ($collection as $item)
            {
                $items[$item->id] = $item->title;
            }

            return $items;
        }),

        'comision' => form_text(),

        'description_delivery' => form_textarea(),

        'description_payment' => form_textarea(),

        'public_date' => form_date(),

        'expire_date' => form_date(),

        'verify_status' => [
            'type' => 'select',
            'options' => function() {
                $options = ['verified'=>'Verified','pending' => 'Pendding','declined'=>'Declined'];

                return $options;
            }
        ],

        'active' => form_boolean()
    ]
];