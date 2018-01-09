<?php

namespace App\Http\Middleware;

use Closure;
use App\Photos;

class deletePhoto
{
    public function handle($request, Closure $next)
    {
        $photos     = Photos::whereRaw("categories_id is null or title is null or location is null or tag is null or description is null")
        ->forceDelete();

        return $next($request);
    }
}