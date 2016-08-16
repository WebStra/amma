<?php

namespace App\Http\Controllers;

use App\Http\Requests\VendorFormRequest;
use App\Http\Requests\VendorUpdateFormRequest;
use App\Repositories\VendorRepository;

class VendorController extends Controller
{
    /**
     * @var VendorRepository
     */
    protected $vendors;

    /**
     * VendorController constructor.
     * @param VendorRepository $vendorRepository
     */
    public function __construct(VendorRepository $vendorRepository)
    {
        $this->vendors = $vendorRepository;
    }

    public function index()
    {
        $vendors = $this->vendors->getPublic($paginate = 9);
        
        return view('vendors.index', compact('vendors'));
    }

    /**
     * Create vendor.
     *
     * @param VendorFormRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function postCreate(VendorFormRequest $request)
    {
        $vendor = $this->vendors->create($request->all());

        return redirect()->route('view_vendor', ['vendor' => $vendor->slug]);
    }

    /**
     * Create form for vendor.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function getCreate()
    {
        return view('vendors.create');
    }

    /**
     * Show vendor.
     * 
     * @param $vendor
     * @return mixed
     */
    public function show($vendor)
    {
        $products = $this->vendors->getAuthenticatedUsersProducts($vendor);

        return view('vendors.show')->withItem($vendor)->withProducts($products);
    }

    /**
     * Edit form for vendor.
     *
     * @param $vendor
     * @return mixed
     */
    public function edit($vendor)
    {
        return view('vendors.edit')->withItem($vendor);
    }

    /**
     * Update vendor.
     * 
     * @param VendorUpdateFormRequest $request
     * @param $vendor
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(VendorUpdateFormRequest $request, $vendor)
    {
        $this->vendors->update($vendor, $request->all());

        return redirect()->route('view_vendor', ['slug' => $vendor->slug]);
    }
}