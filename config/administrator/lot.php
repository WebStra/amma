<?php

use App\Category;
use App\Currency;
use App\Lot;
return [
    'title' => 'Lots',

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
                    case 'pending':
                        $status = '<b style="color: #ffb336">Not Verified</b>';
                        break;
                    case 'declined':
                        $status = '<b style="color: #ea0b0b">Declined</b>';
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

        'description' => form_wysi_html5(),

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

        'description_delivery' => form_text(),

        'description_payment' => form_text(),

        'public_date' => form_date(),

        'expire_date' => form_date(),

        'verify_status' => [
            'type' => 'select',
            'options' => function() {
                $options = ['verified'=>'Verificat','pending' => 'In Asteptare','declined'=>'Refuzat'];

                return $options;
            }
        ],

        'active' => form_boolean()
    ]
];