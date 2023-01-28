<?php

namespace App\Http\Middleware;

use App\Models\Branch;
use App\Models\BranchUser;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CheckBranch
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        if (! $request->session()->has('branch_id')) {
            # try setting the session...
            $branches = Branch::all();
            $branch_users = BranchUser::where('user_id', Auth::user()->id)->get();
            if ($branches->count() > 0) {
                # try to set one of the branches as current branch...
                foreach ($branch_users as $key) {
                    if (! empty($key->branch)) {
                        # set session and exit...
                        $request->session()->put('branch_id', $key->branch_id);
                        return $next($request);
                    }
                }
            } else {
                return redirect()->route('no-branch');
            }
        } elseif (! empty(Branch::find($request->session()->has('branch_id')))) {
            return $next($request);
        } else {
            return redirect()->route('no-branch');
        }
    }
}
