<?php

namespace App\Http\Controllers;

use App\Http\Requests\VendorCreateFormRequest;
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

    /**
     * Get vendor's create form.
     * 
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function getCreate()
    {
        return view('vendors.create');
    }

    /**
     * Create vendor.
     * 
     * @param VendorCreateFormRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function postCreate(VendorCreateFormRequest $request)
    {
        $vendor = $this->vendors->create($request->all());

        return redirect()->route('view_vendor', ['vendor' => $vendor->slug]);
    }

    /**
     * Show vendor.
     * 
     * @param $vendor
     * @return mixed
     */
    public function show($vendor)
    {
        return view('vendors.show')->withItem($vendor);
    }
}