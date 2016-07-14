<?php
namespace App\Http\Controllers;

use App\Repositories\ContactsRepository;
use App\Http\Requests\ContactSend;
use Illuminate\Http\Request;

class PagesController extends Controller
{
    protected $contacts;

    /**
     * PagesController constructor.
     * @param ContactsRepository $contactsRepository
     */
    public function __construct(ContactsRepository $contactsRepository)
    {
        $this->contacts = $contactsRepository;
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
}