<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class RoleMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next,$role): Response
    {
        // if($request->user()==null){
        //     return redirect('/');
        // }
            // if($request->user()->role != 'admin' && $request->path() == '/admin/dashboard'){
            //     abort(403,'you dont have permission',[]);
            // }
            
            // if($request->user()->role != 'user' && $request->path() == '/dashboard'){
            //     abort(403,'you dont have permission',[]);
            // }




            
            // if($request->user()->role !== $role){
            //     if($request->user()->role == 'admin'){
            //         return redirect()->route('admin.dashbaord');
            //     }
            // }
        
        
        return $next($request);
    }
}
