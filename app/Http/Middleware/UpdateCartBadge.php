<?php

namespace App\Http\Middleware;

use App\Models\Cart;
use Closure;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class UpdateCartBadge
{
    public function handle($request, Closure $next)
    {
        if (Auth::guard('pembeli')->check()) {
            $totalItems = Cart::where('pembeli_id', Auth::guard('pembeli')->user()->id)->sum('quantity');
            session(['cart.totalItems' => $totalItems]);
        }

        return $next($request);
    }
}

