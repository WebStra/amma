<?php

namespace App\Http\Middleware;

use Illuminate\Session\Store;

class ViewPostThrottleMiddleware
{
    /**
     * Views will expire after 12 hours.
     *
     * @var int
     */
    protected $throttleTime = 43200;

    /**
     * @var Store
     */
    protected $session;

    /**
     * ViewThrottleMiddleware constructor.
     * @param Store $session
     */
    public function __construct(Store $session)
    {
        $this->session = $session;
    }

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string|null  $guard
     * @return mixed
     */
    public function handle($request, \Closure $next, $guard = null)
    {
        $posts = $this->getViewedPosts();

        if ( ! is_null($posts))
        {
            $posts = $this->cleanExpiredViews($posts);

            $this->storePosts($posts);
        }

        return $next($request);
    }

    /**
     * Get all the viewed posts from the session. If no
     * entry in the session exists, default to null.
     *
     * @return mixed
     */
    private function getViewedPosts()
    {
        return $this->session->get('viewed_posts', null);
    }

    /**
     * Clean expired views.
     *
     * @param $posts
     * @return array
     */
    private function cleanExpiredViews($posts)
    {
        $time = time();

        // Filter through the post array. The argument passed to the
        // function will be the value from the array, which is the
        // timestamp in our case.
        return array_filter($posts, function ($timestamp) use ($time)
        {
            // If the view timestamp + the throttle time is
            // still after the current timestamp the view
            // has not expired yet, so we want to keep it.
            return ($timestamp + $this->throttleTime) > $time;
        });
    }

    /**
     * Push the post id onto the viewed_posts session array.
     *
     * @param $posts
     */
    private function storePosts($posts)
    {
        $this->session->put('viewed_posts', $posts);
    }
}