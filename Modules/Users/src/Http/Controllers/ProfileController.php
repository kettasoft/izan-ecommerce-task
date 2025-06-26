<?php

namespace Modules\Users\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ProfileController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request)
    {
        $user = $request->user();

        if (!$user) {
            return $this->sendError('Unauthorized', [], 401);
        }

        $data = $user->getResource();
        return $this->sendResponse($data, 'success');
    }
}
