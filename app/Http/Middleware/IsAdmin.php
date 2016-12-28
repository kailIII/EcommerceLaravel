<?php

namespace LaravelCommerce\Http\Middleware;

use Closure;
use Illuminate\Contracts\Auth\Guard;
use Illuminate\Support\MessageBag;

class IsAdmin
{
    /**
     * The Guard implementation.
     *
     * @var Guard
     */
    protected $auth;

    /**
     * Create a new filter instance.
     *
     * @param  Guard  $auth
     * @return void
     */
    public function __construct(Guard $auth)
    {
        $this->auth = $auth;
    }

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if (! $this->auth->user()->is_admin) {
            $errors = new MessageBag;
            $errors->add('adminarea','Restricted Area. Please use a admin login.');
            $this->auth->logout();
            return view('auth.login', compact('errors'));
        }

        return $next($request);
    }
}
