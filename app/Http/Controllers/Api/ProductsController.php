<?php

namespace App\Http\Controllers\Api;

use App\Industry;
use App\Product;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ProductsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        try {
            $industry = $request->query('industry') ?? null;

            $product = $request->query('product') ?? null;

            $products = Product::with('industry')
                ->when($industry, function ($query) use ($industry) {
                    $query->whereHas('industry', function ($query) use ($industry) {
                        $query->where('name', 'like', sprintf('%%%s%%', $industry));
                    });
                })
                ->when($product, function($query) use ($product) {
                    $query->where('name', 'like', sprintf('%%%s%%', $product));
                })
                ->orderBy('name')
                ->get();

            return response()->json([
                'message' => sprintf('%d product%s found.', $products->count(), $products->count() === 1 ? '' : 's'),
                'products' => $products,
            ], 200);
        } catch (\Exception $exception) {
            return response()->json([
                'message' => 'An error occurred trying to answer this request',
            ], 500);
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return response()->json([
            'message' => 'Not implemented due its not necessary for this challenge',
        ], 501);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        try {
            $industry = Industry::findOrFail($request->post('industry'));

            $industry->products()->create([
                'name' => $request->post('name'),
                'price' => $request->post('price'),
                'stock' => $request->post('stock'),
            ]);

            return response()->json([
                'message' => 'Product created successfully'
            ], 201);
        } catch (ModelNotFoundException $exception) {
            return response()->json([
                'message' => 'Industry not found',
            ], 404);
        } catch (\Exception $exception) {
            return response()->json([
                'message' => 'An error occurred trying to answer this request',
            ], 500);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        try {
            return response()->json([
                'product' => Product::findOrFail($id),
            ], 200);
        } catch (ModelNotFoundException $exception) {
            return response()->json([
                'message' => 'Product not found',
            ], 404);
        } catch (\Exception $exception) {
            return response()->json([
                'message' => 'An error occurred trying to answer this request',
            ], 500);
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        return $this->show($id);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        try {
            $product = Product::findOrFail($id);

            $product->industry_id = $request->post('industry');

            $product->name = $request->post('name');

            $product->price = $request->post('price');

            $product->stock = $request->post('stock');

            $product->save();

            return response()->json([
                'message' => 'Product saved successfully'
            ], 200);
        } catch (ModelNotFoundException $exception) {
            return response()->json([
                'message' => 'Product not found',
            ], 404);
        } catch (\Exception $exception) {
            return response()->json([
                'message' => 'An error occurred trying to answer this request',
            ], 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {
            Product::findOrFail($id);

            Product::destroy($id);

            return response()->json([
                'message' => 'Product deleted',
            ], 200);
        } catch (ModelNotFoundException $exception) {
            return response()->json([
                'message' => 'Product not found or already deleted',
            ], 404);
        } catch (\Exception $exception) {
            return response()->json([
                'message' => 'An error occurred trying to answer this request',
            ], 500);
        }
    }

    public function restore($id)
    {
        try {
            $product = Product::onlyTrashed()->findOrFail($id);

            $product->restore();

            return response()->json([
                'message' => 'Product restored',
            ], 200);
        } catch (ModelNotFoundException $exception) {
            return response()->json([
                'message' => 'Product not found or not deleted',
            ], 404);
        } catch (\Exception $exception) {
            return response()->json([
                'message' => 'An error occurred trying to answer this request',
            ], 500);
        }
    }
}
