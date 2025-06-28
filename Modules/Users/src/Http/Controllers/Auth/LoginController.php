<?php

namespace Modules\Users\Http\Controllers\Auth;

use Carbon\Carbon;
use Modules\Users\Models\User;
use Illuminate\Auth\Events\Login;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Eloquent\Builder;
use Modules\Users\Http\Requests\LoginRequest;
use Symfony\Component\HttpFoundation\Response;

class LoginController extends Controller
{
    /**
     * The fake password for timing attacks.
     *
     * @var string
     */
    protected string $password = '$2y$12$jAJu4ycg8adGHKAc1GtNZe/d3epttORtygQyOPnTxGRFbaEzBBWNC';

    /**
     * Handle the incoming request.
     * 
     * This method handles the login request by checking the user's credentials.
     * It looks for a user by either email or phone number, verifies the password,
     * and if successful, updates the last login time and returns the user data.
     * 
     * @param LoginRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function __invoke(LoginRequest $request)
    {
        $user = User::where(function (Builder $query) use ($request) {
            $query->where('email', $request->username);
            $query->orWhere('phone', $request->username);
        })->first();

        // If user not found, return error response
        if (!$user) {
            Hash::check($this->password, $this->password); // Timing attack prevention
            return $this->sendError('Password or username is incorrect.', code: Response::HTTP_NOT_FOUND);
        }

        // If the password does not match, return error response
        if (!Hash::check($request->password, $user->password)) {
            $this->sendError('Password or username is incorrect.', code: Response::HTTP_NOT_FOUND);
        }

        Auth::login($user);
        $request->session()->regenerate();

        $user->last_login_at = Carbon::now()->toDateTimeString();

        $data = $user->getResource();

        return $this->sendResponse($data, 'Login successful', code: Response::HTTP_OK);
    }
}
