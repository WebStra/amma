<?php
namespace App\Http\administrator;

use App\Repositories\RolesRepository;
use App\Repositories\VendorRepository;
use Keyhunter\Administrator\Controller;
use Illuminate\Contracts\Auth\Guard AS AuthGuard;
use Illuminate\Foundation\Application;
use App\Repositories\UserRepository;
use App\Repositories\LotRepository;
use App\Visitors;

/**
 * Class DashboardStatisticController
 * @package App\Http\administrator
 */
class DashboardStatisticController extends Controller
{
    /**
     * @var LotRepository
     */
    protected $lot;

    /**
     * @var RolesRepository
     */
    protected $roles;

    /**
     * @var VendorRepository
     */
    protected $vendor;

    /**
     * DashboardStatisticController constructor.
     * @param Application $application
     * @param AuthGuard $user
     * @param LotRepository $lotRepository
     * @param UserRepository $userRepository
     */
    public function __construct(Application $application,
                                AuthGuard $user,
                                LotRepository $lotRepository,
                                RolesRepository $rolesRepository,
                                VendorRepository $vendorRepository
    )
    {
        parent::__construct($application, $user);

        $this->lot = $lotRepository;
        $this->roles = $rolesRepository;
        $this->vendor = $vendorRepository;
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function dashboard()
    {
        return view('administrator::dashboard', [
            'lot' => $this->lot,
            'vendor'=> $this->vendor->getPublic(),
            'user' => $this->roles->getSimpleUserRole()->users,
            'visitors' => Visitors::get(),
        ]);
    }
}

