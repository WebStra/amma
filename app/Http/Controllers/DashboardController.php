<?php

namespace App\Http\Controllers;

use App\Repositories\UserRepository;
use App\Repositories\LotRepository;
use App\Repositories\ProfileRepository;
use Illuminate\Contracts\Auth\Guard;
use App\Http\Requests\UpdateUserSettings;
use App\Http\Requests\UpdateUserPassword;
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
    
    private $lots;
    /**
     * DashboardController constructor.
     * @param UserRepository $userRepository
     * @param Guard $auth
     */
    public function __construct(UserRepository $userRepository, Guard $auth, ProfileRepository $profileRepository,LotRepository $lotRepository)
    {
        $this->users = $userRepository;
        $this->profile = $profileRepository;
        $this->auth = $auth;
        $this->lots = $lotRepository;

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

    /**
     * Account and password settings.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function accountSettings()
    {
        return view('dashboard.account-settings');
    }

    /**
     * @param UpdateUserSettings $request
     * @return mixed
     */
    public function update(UpdateUserSettings $request)
    {
        $this->users->update_user($request->all());

        $image = $request->file('photo');
        if ($image && $image instanceof UploadedFile) {
            (new ImageProcessor())->changeAvatar($image);
        }

        return back()->withStatus('Profile Updated!')->with('activeclass', 'update_settings');
    }

    /**
     * @param UpdateUserPassword $request
     * @return mixed
     */
    public function updatePassword(UpdateUserPassword $request)
    {
        $this->users->updatePassword($request->password);

        return back()->withStatus('Password Updated!')->with('activeclass', 'update_password');
    }
}