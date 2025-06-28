<?php

namespace Modules\Users\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class LogoutController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request)
    {
        $request->user()->tokens()->delete();
        auth()->logout();

        // Return a successful response
        return $this->sendSuccess('Logged out successfully', 200);
    }
}
