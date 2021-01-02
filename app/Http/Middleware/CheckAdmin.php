<?php

namespace App\Http\Middleware;

use Closure;

class CheckAdmin
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
        if (isset($login['admin'])) return $next($req);
        $req->session()->flash('msg', [
            'success' => false,
            'msg' => 'Silahkan login sebagai admin terlebih dahulu!'
        ]);
        return redirect('/admin/login');
    }
}
