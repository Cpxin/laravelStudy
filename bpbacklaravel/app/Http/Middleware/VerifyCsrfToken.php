<?php

namespace App\Http\Middleware;

use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken as Middleware;


class VerifyCsrfToken extends Middleware
{
    /**
     * The URIs that should be excluded from CSRF verification.
     *
     * @var array
     */
    protected $except = [
        //以下路由不会检测csrf
        'staff/wx_staff_login',
        'staff/wx_staff_pwd',
        'staff/wx_staff_detail',
        'staff/wx_staff_sign',
        'excel/import',
        'excel/export',
        'project/word_save',
    ];
//    public function handle($request, \Closure $next)
//    {
//        $_url=$request->decodedPath();
//        if(in_array($_url,$this->except)){
//            unset($_url);
//            // 禁用CSRF
//            return $next($request);
//        }else{
//            unset($_url);
//            // 使用CSRF
//            return parent::handle($request, $next);
//        }
//    }
}
