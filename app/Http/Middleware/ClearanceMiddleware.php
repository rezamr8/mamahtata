<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class ClearanceMiddleware {
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next) {        
        if (Auth::user()->hasPermissionTo('Administrator')) //If user has this //permission
        {
            return $next($request);
        }

        if ($request->is('admin/orders/create'))//If user is creating a orders
         {
            if (!Auth::user()->hasPermissionTo('setting'))
         {
                abort('401');
            } 
         else {
                return $next($request);
            }
        }

        if ($request->is('admin/orders/*/edit')) //If user is editing a orders
         {
            if (!Auth::user()->hasPermissionTo('setting')) {
                abort('401');
            } else {
                return $next($request);
            }
        }

        if ($request->is('admin/orders/*/produk/*')) //If user is editing a orders
         {
            if (!Auth::user()->hasPermissionTo('setting')) {
                abort('401');
            } else {
                return $next($request);
            }
        }

        if ($request->isMethod('Delete')) //If user is deleting a orders
         {
            if (!Auth::user()->hasPermissionTo('Administrator')) {
                abort('401');
            } 
         else 
         {
                return $next($request);
            }
        }

        // customer
        if ($request->is('admin/customer/create'))//If user is creating a customer
         {
            if (!Auth::user()->hasPermissionTo('setting'))
         {
                abort('401');
            } 
         else {
                return $next($request);
            }
        }

        if ($request->is('admin/customer'))//If user is creating a customer
         {
            if (!Auth::user()->hasPermissionTo('setting'))
         {
                abort('401');
            } 
         else {
                return $next($request);
            }
        }


        if ($request->is('admin/customer/*/edit'))//If user is creating a customer
         {
            if (!Auth::user()->hasPermissionTo('setting'))
         {
                abort('401');
            } 
         else {
                return $next($request);
            }
        }

        //produk

         if ($request->is('admin/produk'))//If user is creating a produk
         {
            if (!Auth::user()->hasPermissionTo('setting'))
         {
                abort('401');
            } 
         else {
                return $next($request);
            }
        }

         if ($request->is('admin/produk/create'))//If user is creating a produk
         {
            if (!Auth::user()->hasPermissionTo('setting'))
         {
                abort('401');
            } 
         else {
                return $next($request);
            }
        }

         if ($request->is('admin/produk/*/edit'))//If user is creating a produk
         {
            if (!Auth::user()->hasPermissionTo('setting'))
         {
                abort('401');
            } 
         else {
                return $next($request);
            }
        }

        return $next($request);
    }
}