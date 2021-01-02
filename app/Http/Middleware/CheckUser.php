<?php

namespace App\Http\Middleware;

use Closure;

class CheckUser
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($req, Closure $next)
    {
        $login = $req->session()->get('login');
        if ($login['pelanggan'] === true) return $next($req);
        $req->session()->flash('msg', [
            'success' => false,
            'msg' => 'Silahkan login terlebih dahulu!'
        ]);
        return redirect('/login');
    }
}
