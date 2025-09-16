<?php
 
namespace App\Http\Middleware;
 
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
 
class EnsureMfaIsVerified
{
    public function handle(Request $request, Closure $next)
    {
        $user = Auth::user();
        if ($user && $user->hasRole('admin') && !$user->mfa_verified) {
            return redirect()->route('mfa.setup')->with('error', 'Please verify MFA first.');
        }
        return $next($request);
    }
}