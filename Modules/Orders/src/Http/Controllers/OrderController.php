<?php

namespace Modules\Orders\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Modules\Orders\Http\Requests\OrderRequest;
use Modules\Orders\Repositories\OrderRepository;

class OrderController extends Controller
{
    public function __construct(protected OrderRepository $repository) {}

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //

        return response()->json([]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(OrderRequest $request)
    {
        $this->repository->create(null);

        return $this->sendSuccess('success', 201);
    }

    /**
     * Show the specified resource.
     */
    public function show($id)
    {
        //

        return response()->json([]);
    }
}
