<?php
namespace App\Http\Controllers;

use App\Repositories\ContactsRepository;
use App\Http\Requests\ContactSend;
use App\Repositories\ProductsRepository;
use App\Repositories\PagesRepository;
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

    protected $pages;

    /**
     * PagesController constructor.
     * @param ContactsRepository $contactsRepository
     * @param ProductsRepository $productsRepository
     */
    public function __construct(
        ContactsRepository $contactsRepository,
        ProductsRepository $productsRepository,
        PagesRepository $pagesRepository
    ) {
        $this->contacts = $contactsRepository;
        $this->products = $productsRepository;
        $this->pages = $pagesRepository;
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

    public function help()
    {
        $helpPages = $this->pages->getPagesHelp();
        return view('pages.help', compact('helpPages'));
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