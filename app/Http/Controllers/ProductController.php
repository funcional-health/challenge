<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProductRequest;
use App\Product;
use App\Services\ProductService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class ProductController extends Controller
{
    private $productService;

    public function __construct(ProductService $productService) {
        $this->productService = $productService;
    }
    public function index() : JsonResponse {
        $list = $this->productService->findAll();
        return response()->json($list, Response::HTTP_OK);
    }

    public function show(int $id) : JsonResponse {
        $product = $this->productService->findOne($id);
        return response()->json($product, Response::HTTP_OK);
    }

    public function store(ProductRequest $request) : JsonResponse {
        $object = new Product($request->all());
        $product = $this->productService->save($object);
        return response()->json($product, Response::HTTP_CREATED);
    }

    public function update(ProductRequest $request, int $id) : JsonResponse {
        $object = new Product($request->all());
        $this->productService->update($object, $id);
        return response()->json([], Response::HTTP_NO_CONTENT);
    }

    public function destroy(int $id) : JsonResponse {
        $this->productService->delete($id);
        return response()->json([], Response::HTTP_NO_CONTENT);
    }
}
