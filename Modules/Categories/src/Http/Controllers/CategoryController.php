<?php

namespace Modules\Categories\Http\Controllers;

use App\Http\Controllers\Controller;
use Modules\Categories\Models\Category;
use Symfony\Component\HttpFoundation\Response;
use Modules\Categories\Http\Requests\CategoryRequest;
use Modules\Categories\Transformers\CategoryResource;
use Modules\Categories\Repositories\CategoryRepository;

class CategoryController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @param CategoryRepository $repository
     */
    public function __construct(protected CategoryRepository $repository)
    {
        $this->middleware('auth:sanctum', ['except' => ['index', 'show']]);
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $categories = $this->repository->readAll();

        $data = CategoryResource::collection($categories);

        return $this->sendResponse($data, 'success');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CategoryRequest $request)
    {
        $data = $request->validated();

        $category = $this->repository->create($data);

        return $this->sendResponse($category, 'Category created successfully', Response::HTTP_CREATED);
    }

    /**
     * Show the specified resource.
     */
    public function show($id)
    {
        $category = $this->repository->read($id);

        if (!$category) {
            return $this->sendError('Category not found', code: Response::HTTP_NOT_FOUND);
        }

        return $this->sendResponse($category, 'Category retrieved successfully');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(CategoryRequest $request, $id)
    {
        $category = $this->repository->read($id);

        if (!$category) {
            return $this->sendError('Category not found', code: Response::HTTP_NOT_FOUND);
        }

        $data = $request->all();
        $category = $this->repository->update($category, $data);

        return $this->sendResponse($category, 'Category updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $category = $this->repository->read($id);

        if (!$category) {
            return $this->sendError('Category not found', code: Response::HTTP_NOT_FOUND);
        }

        $this->repository->delete($category);

        return $this->sendResponse([], 'Category deleted successfully', Response::HTTP_NO_CONTENT);
    }
}
