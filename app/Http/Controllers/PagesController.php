<?php
namespace App\Http\Controllers;

use App\Repositories\ContactsRepository;
use App\Http\Requests\ContactSend;
use Illuminate\Http\Request;



class PagesController extends Controller
{



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


public function contacts() {

return view('home.contacts');

}


public function send_form(ContactSend $request) {


$this->contacts->sendContact($request->all());


return back()->withStatus('Message Send!');
}



}