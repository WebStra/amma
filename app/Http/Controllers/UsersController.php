<?php

namespace App\Http\Controllers;

use App\Http\Requests\InvolveProductRequest;
use App\Http\Requests\ExitProductRequest;
use App\Repositories\InvolvedRepository;
use Illuminate\Http\Request;

class UsersController extends Controller
{
    /**
     * @var InvolvedRepository
     */
    protected $involved;

    /**
     * UsersController constructor.
     * @param InvolvedRepository $involvedRepository
     */
    public function __construct(InvolvedRepository $involvedRepository)
    {
        $this->involved = $involvedRepository;
    }

    /**
     * Involve the product method.
     *
     * @param InvolveProductRequest $request
     * @param $product
     * @return \Illuminate\Http\RedirectResponse
     */
    public function involveProductOffer(InvolveProductRequest $request, $product)
    {
        $this->involved->createOrUpdate(['count' => $request->get('count')], $product);

        return redirect()->back()->withStatus('Success! You are involve the product offer.');
    }

    /**
     * Exit involved product.
     *
     * @param ExitProductRequest $request
     * @param $involve
     * @return \Illuminate\Http\RedirectResponse
     */
    public function exitProductOffer(ExitProductRequest $request, $involve)
    {
        $involve = $this->involved->update($involve, ['active' => 0]);

        $remaining = config('product.times') - $this->involved->getInvolveTimesProduct($involve->product);

        return redirect()->back()->withStatus('Success! You are exit from product offer. Remaining attempts (' . $remaining . ')');
    }
}