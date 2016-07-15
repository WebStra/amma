<?php 
namespace App\Http\Controllers;
use App\Repositories\SubscribeRepository;
use App\Http\Requests\Subscribe;
use Illuminate\Http\Request;
use Illuminate\Mail\Message;

class SubscribeController extends Controller
{
    protected $subscribe;

    public function __construct(SubscribeRepository $subscribeRepository)
    {
        $this->subscribe = $subscribeRepository;
    }
   
    public function index(Subscribe $request) 
    {
        if(!$this->subscribe->checkSubscriber($request['email']))
        
        {
            $subscribe = $this->subscribe->sendSubscribe($request->all());

            \Mail::send('email.subscribe',compact('subscribe'), function(Message $message) use ($subscribe)
            {
                $message->to($subscribe->email, sprintf('%s %s', $subscribe->email, $subscribe->token))
                    ->subject("Amma subscribed message!");
            });
        }

        else {
            $model = $this->subscribe->getByEmail($request['email']);

            if(! $model->active){
                $model->update([
                    'active' => (int) true,
                ]);
                
                $model->save();
            } else {
                return redirect()->back()->withStatus('You already subscribed.');
            }
        }

    
        return back()->withStatus('You are subscribed to Amma!');
    }

    public function unscribe(Request $request, $token) 
    {
        $this->subscribe->unscribe($token);

        return redirect()->route('home')->withStatus('You have unsubscribed!');
    }

}