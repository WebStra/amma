<?php
namespace App\Http\Controllers;

use App\Repositories\SubscribeRepository;
use App\Http\Requests\SubscribeRequest;
use App\Subscribe;
use Illuminate\Http\Request;
use Illuminate\Mail\Message;

class SubscribeController extends Controller
{
    protected $subscribe;

    public function __construct(SubscribeRepository $subscribeRepository)
    {
        $this->subscribe = $subscribeRepository;
    }

    public function index(SubscribeRequest $request)
    {
        if (!$this->subscribe->checkSubscriber($request['email']))
        {
            $subscribe = $this->subscribe->sendSubscribe($request->all());

            $this->sendEmail($subscribe);
        } else {
            $subscribe = $this->subscribe->getByEmail($request['email']);

            if (!$subscribe->active) {
                $subscribe->fill([
                    'active' => (int)true,
                ])->save();

                $this->sendEmail($subscribe);
            } else {
                return redirect()->back()->withStatus('You already subscribed.');
            }
        }

        return back()->withStatus('You are subscribed to Amma!');
    }

    /**
     * Send email.
     *
     * @param \App\Subscribe $subscribe
     * @return void
     */
    private function sendEmail(Subscribe $subscribe)
    {
        \Mail::send('email.subscribe', compact('subscribe'), function (Message $message) use ($subscribe) {
            $message->to($subscribe->email, sprintf('%s %s', $subscribe->email, $subscribe->token))
                ->subject("Amma subscribed message!");
        });
    }

    public function unscribe(Request $request, $token)
    {
        $this->subscribe->unscribe($token);

        return redirect()->route('home')->withStatus('You have unsubscribed!');
    }

}