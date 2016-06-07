<?php

use App\Partner;

class PartnersTableSeeder extends Seeder
{
    /**
     * Partners for seed.
     *
     * @var array
     */
    protected $partners = [
        [
            'name' => 'bcr',
            'link' => 'http://bcrs.org.uk/',
            'rank' => 1
        ],
        [
            'name' => 'moldcell',
            'link' => 'http://moldcell.md/',
            'rank' => 2
        ],
        [
            'name' => 'zorile',
            'link' => 'http://zorile.md/',
            'rank' => 3
        ],
        [
            'name' => 'tez-tour',
            'link' => 'http://www.tez-tour.com/',
            'rank' => 4
        ],
        [
            'name' => 'air-moldova',
            'link' => 'http://www.airmoldova.md/',
            'rank' => 5
        ],
        [
            'name' => 'webstyle',
            'link' => 'http://www.webstyle.md/',
            'rank' => 6
        ],
        [
            'name' => 'moldtelecom',
            'link' => 'http://www.moldtelecom.md/',
            'rank' => 7
        ],
        [
            'name' => 'expert',
            'link' => 'http://expert.md/',
            'rank' => 8
        ],
        [
            'name' => 'unite',
            'link' => 'http://unite.md/',
            'rank' => 9
        ]
    ];

    /**
     * PartnersTableSeeder constructor.
     * @param Partner $partner
     */
    public function __construct(Partner $partner)
    {
        $this->instance = $partner;
    }

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->deleteTable();
    
        array_walk($this->partners, function ($partner) {
            $this->instance->create($partner);
        });
    }
}