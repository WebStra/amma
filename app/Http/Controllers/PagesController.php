<?php
namespace App\Http\Controllers;

use App\Repositories\ContactsRepository;
use App\Http\Requests\ContactSend;
use App\Repositories\ProductsRepository;
use Illuminate\Http\Request;

class PagesController extends Controller
{
    /**
     * @var ContactsRepository
     */
    protected $contacts;

    /**
     * @var ProductsRepository
     */
    protected $products;

    /**
     * PagesController constructor.
     * @param ContactsRepository $contactsRepository
     */
    public function __construct(ContactsRepository $contactsRepository, ProductsRepository $productsRepository)
    {
        $this->contacts = $contactsRepository;
        $this->products = $productsRepository;
    }

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

    /**
     * Get contacts page.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function contacts()
    {
        return view('home.contacts');
    }

    /**
     * @param ContactSend $request
     * @return mixed
     */
    public function send_contact(ContactSend $request)
    {
        $this->contacts->sendContact($request->all());

        return redirect()->back()->withStatus('Your message was send!');
    }
    
    /**
     * Expire soon product page.
     * 
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function expireSoonProducts()
    {
        $products = $this->products->getExpireSoon(6);

        return view('pages.expire_soon_products', compact('products'));
    }

    /**
     * Support static page.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function support()
    {
        return view('pages.support');
    }
}