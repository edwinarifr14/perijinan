<?php

namespace App\Http\Middleware;

use Closure;

class CheckSuper
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
        if ($login['admin'] === true && $login['level'] === 1) return $next($req);
        else if ($login['admin'] === true) {
            $req->session()->flash('msg', [
                'success' => false,
                'msg' => 'Hanya Super Admin yang berhak melakukan request ini!'
            ]);
            return redirect('/admin');
        }
        $req->session()->flash('msg', [
            'success' => false,
            'msg' => 'Silahkan login sebagai admin terlebih dahulu!'
        ]);
        return redirect('/admin/login');
    }
}
