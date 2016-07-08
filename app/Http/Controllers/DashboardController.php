<?php

namespace App\Http\Controllers;

use App\Repositories\UserRepository;
use Illuminate\Contracts\Auth\Guard;

class DashboardController extends Controller
{
    /**
     * @var UserRepository
     */
    protected $users;

    /**
     * @var Guard
     */
    private $auth;

    /**
     * DashboardController constructor.
     * @param UserRepository $userRepository
     * @param Guard $auth
     */
    public function __construct(UserRepository $userRepository, Guard $auth)
    {
        $this->users = $userRepository;
        $this->auth = $auth;
    }

    /**
     * My vendors.
     * 
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function myVendors()
    {
        $vendors = $this->auth->user()->vendors;

        return view('dashboard.my-vendors', compact('vendors'));
    }

    /**
     * My products.
     * 
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function myProducts()
    {
        $vendors = $this->auth->user()->vendors;

        return view('dashboard.my-products', compact('vendors'));
    }

    /**
     * My products.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function myInvolved()
    {
        $involved = $this->auth->user()->involved()->active()->get();

        return view('dashboard.my-involved', compact('involved'));
    }


}