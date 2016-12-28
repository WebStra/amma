<?php

namespace App\Repositories;

use App\Page;

class PagesRepository extends Repository
{
    public function getModel()
    {
        return new Page();
    }

    /**
     * Get pages for footer.
     * Max number of pages is 2 at moment.
     *
     * @return mixed
     */
    public function getHeader($count = 1)
    {
        return self::getModel()
            ->where('show_in_header', 1)
            ->active()
            ->take($count)
            ->get();
    }

    /**
     * Get pages for footer.
     *
     * @return mixed
     */
    public function getFooter()
    {
        return self::getModel()
            ->where('show_in_footer', 1)
            ->active()
            ->get();
    }


    public function getPagesHelp()
    {
        return self::getModel()
            ->where('page_type', '!=', null)
            ->orderBy('page_type',self::ASC)
            ->active()
            ->get();
    }
}