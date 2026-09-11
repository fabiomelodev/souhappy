<?php

namespace App\Http\Middleware;

use App\Models\Condominium;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class EnsureResidentBelongsToCondominium
{
    /**
     * Handle an incoming request.
     *
     * @param  Closure(Request): (Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $condominium = $request->route('condominium');

        abort_unless($condominium instanceof Condominium, 404);

        abort_unless($request->user()?->condominium_id === $condominium->id, 403);

        return $next($request);
    }
}
