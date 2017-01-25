<?php

namespace App\Http\Controllers;

use App\Repositories\UserRepository;
use App\Repositories\LotRepository;
use App\Repositories\ProfileRepository;
use App\Repositories\InvolvedRepository;
use Carbon\Carbon;
use Illuminate\Contracts\Auth\Guard;
use App\Http\Requests\UpdateUserSettings;
use App\Http\Requests\UpdateUserPassword;
use App\Services\ImageProcessor;
use App\Video;
use Illuminate\Http\UploadedFile;


/**
 * Class DashboardController
 * @package App\Http\Controllers
 */
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
     * @var LotRepository
     */
    private $lots;

    /**
     * @var InvolvedRepository
     */
    private $involved;

    /**
     * DashboardController constructor.
     * @param UserRepository $userRepository
     * @param Guard $auth
     */
    public function __construct(UserRepository $userRepository,
                                Guard $auth,
                                ProfileRepository $profileRepository,
                                LotRepository $lotRepository,
                                InvolvedRepository $involvedRepository
    )
    {
        $this->users = $userRepository;
        $this->profile = $profileRepository;
        $this->auth = $auth;
        $this->lots = $lotRepository;
        $this->involved = $involvedRepository;
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function howWork()
    {

        $video = Video::orderBy('id', 'desc')->get();

        return view('dashboard.how-amma-work', compact('video'));
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
    public function myInvolved($type)
    {
        $involved = $this->auth->user()->involved()->active()->where('type', $type)->get();

        $product = $this->sortInvolvedProducts($involved);

        return view('dashboard.my-involved', compact('product', 'type'));
    }


    /**
     * @param $involved
     * @return array
     */
    public function sortInvolvedProducts($involved)
    {
        if (count($involved)) {
            $product = [];
            foreach ($involved as $item) {
                if ($item->lot->verify_status == 'verified') {
                    $product[] = ['date' => $item->lot->public_date, 'product' => $item->product, 'involved' => $item];
                }
            }
            if (count($product) > 0) {
                usort($product, function ($product, $b) {
                    return date('dmy', strtotime($product['date'])) - date('dmy', strtotime($b['date']));
                });
            }
            return $product;
        }
    }

    /**
     * @param $type
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function myHistory($type)
    {
        $involved = $this->auth->user()->involved()->active()->where('type', $type)->get();

        $product = $this->sortHistoryProducts($involved);

        return view('dashboard.my-involved', compact('product'));
    }

    /**
     * @param $involved
     * @return array
     */
    public function sortHistoryProducts($involved)
    {
        if (count($involved)) {
            $product = [];
            foreach ($involved as $item) {
                if ($item->lot->verify_status == 'expired') {
                    $product[] = ['date' => $item->lot->public_date, 'product' => $item->product, 'involved' => $item];
                }
            }
            if (count($product) > 0) {
                usort($product, function ($product, $b) {
                    return date('dmy', strtotime($product['date'])) - date('dmy', strtotime($b['date']));
                });
            }

            return $product;
        }
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
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function userPassword()
    {
        return view('dashboard.user-password');
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

        return back()->withStatus('Setarile au fost modificate!')->withColor('green')->with('activeclass', 'update_settings');
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