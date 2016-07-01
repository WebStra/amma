<?php

namespace App\Http\Controllers;

class PagesController extends Controller
{
    /**
     * Show page method.
     *
     * @param $page
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function show($page)
    {
        return view('pages.show', ['item' => $page]);
    }
}