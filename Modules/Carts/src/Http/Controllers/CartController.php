<?php

namespace Modules\Carts\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Modules\Carts\Http\Requests\CartRequest;
use Modules\Carts\Models\Cart;
use Modules\Carts\Transformers\CartResource;
use Modules\Carts\Repositories\CartRepository;
use Symfony\Component\HttpFoundation\Response;

class CartController extends Controller
{

    public function __construct(protected CartRepository $repository) {}

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $items = $this->repository->readAll();

        $data = CartResource::collection($items);

        return $this->sendResponse($data, 'success');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CartRequest $request)
    {
        $items = $this->repository->create($request->validated());

        return $this->sendResponse(new CartResource($items), 'success');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        if (Cart::where('user_id', auth()->id())->findOrFail($id)) {
            $this->repository->delete($id);

            return $this->sendSuccess('success', Response::HTTP_NO_CONTENT);
        }

        return $this->sendError('', code: 401);
    }
}
