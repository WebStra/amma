<?php

namespace App\Http\Controllers;

use App\Repositories\UserRepository;
use App\Repositories\ProfileRepository;
use Illuminate\Contracts\Auth\Guard;
use Illuminate\Http\Request;
use Illuminate\Http\Auth;
use App\Http\Requests\UpdateUserSettings;
use App\Image;
use App\Services\ImageProcessor;
use Illuminate\Http\UploadedFile;

class DashboardController extends Controller
{
    /**
     * @var UserRepository
     */
    protected $users;


/**
     * @var  ProfileRepository
     */
    protected $profile;


    /**
     * @var Guard
     */
    private $auth;

    /**
     * DashboardController constructor.
     * @param UserRepository $userRepository
     * @param Guard $auth
     */
    public function __construct(UserRepository $userRepository, Guard $auth , ProfileRepository $profileRepository)
    {
        $this->users = $userRepository;
        $this->profile = $profileRepository;
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



    public function accountsettings() 
    {
        return view('dashboard.account-settings');
    }



    public function update(UpdateUserSettings $request)
    {

        

        $this->users->update_user($request->all());

       /*$image = $request->file('photo');
        if ($image instanceof UploadedFile) {
            $location = 'assets/images/user_avatar/';
            $processor = new ImageProcessor();
            $imageable = $processor->uploadAndCreate($image,  $this->auth->user()->profile->id, null, $location);
        } else {
            throw new \Exception('Invalid Image');
        }*/
       

        return back()->withStatus('Profile Updated!');
    }


}