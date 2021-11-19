<?php

namespace App\Http\Middleware;

use App\Models\Category;
use Closure;

class VerifyCtegoryCount
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if(Category::all()->count() == 0)
        {
            session()->flash('error', 'You need to add category to create a post');
            return redirect(route('categories.create'));
        }
        return $next($request);
    }
}
