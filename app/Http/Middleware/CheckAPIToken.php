<?php

namespace App\Http\Middleware;

use App\Models\Member;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class CheckAPIToken
{
    public function handle(Request $request, Closure $next, string ...$guards): Response
    {
        if(!$request->input('token')) {
            return response()->json([
                'message' => 'Unauthorized user'
            ])->setStatusCode(401);
        }

        try {
            $member = Member::query()->where('token', $request->input('token'))
                ->where('is_activated', 1)->firstOrFail();

            Auth::login($member);
        } catch(\Exception $e) {
            return response()->json([
                'message' => 'Unauthorized user'
            ])->setStatusCode(401);
        }

        return $next($request);
    }
}
