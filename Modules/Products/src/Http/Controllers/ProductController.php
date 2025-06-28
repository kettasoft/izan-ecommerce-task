<?php

namespace Modules\Products\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Symfony\Component\HttpFoundation\Response;
use Modules\Products\Http\Requests\ProductRequest;
use Modules\Products\Transformers\ProductResource;
use Modules\Products\Repositories\ProductRepository;

class ProductController extends Controller
{
    /**
     * Create a new controller instance.
     */
    public function __construct(protected ProductRepository $repository) {}

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $products = $this->repository->readAll();

        $data = ProductResource::collection($products);

        return $this->sendResponse($data, 'success');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ProductRequest $request)
    {
        $product = $this->repository->create($request->validated());

        $data = new ProductResource($product);

        return $this->sendResponse($data, 'Product created successfully', 201);
    }

    /**
     * Show the specified resource.
     */
    public function show($id)
    {
        $product = $this->repository->read($id);

        $data = new ProductResource($product);

        return $this->sendResponse($data, 'Product retrieved successfully');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ProductRequest $request, $id)
    {
        $product = $this->repository->update($id, $request->validated());

        $data = new ProductResource($product);

        return $this->sendResponse($data, 'Product updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $this->repository->delete($id);

        return $this->sendResponse([], 'Product deleted successfully', Response::HTTP_NO_CONTENT);
    }
}
