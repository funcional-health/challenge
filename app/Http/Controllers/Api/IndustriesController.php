<?php

namespace App\Http\Controllers\Api;

use App\Industry;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class IndustriesController extends Controller
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

            $industries = Industry::when($industry, function($query) use ($industry) {
                    $query->where('name', 'like', sprintf('%%%s%%', $industry));
                })
                ->orderBy('name')
                ->get();

            return response()->json([
                'message' => sprintf('%d industr%s found.', $industries->count(), $industries->count() === 1 ? 'y' : 'ies'),
                'industries' => $industries,
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
            Industry::create([
                'name' => $request->post('name'),
            ]);

            return response()->json([
                'message' => 'Industry created successfully'
            ], 201);
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
                'industry' => Industry::findOrFail($id),
            ], 200);
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
            $industry = Industry::findOrFail($id);

            $industry->name = $request->post('name');

            $industry->save();

            return response()->json([
                'message' => 'Industry saved successfully'
            ], 200);
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
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {
            Industry::findOrFail($id);

            Industry::destroy($id);

            return response()->json([
                'message' => 'Industry deleted',
            ], 200);
        } catch (ModelNotFoundException $exception) {
            return response()->json([
                'message' => 'Industry not found or already deleted',
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
            $industry = Industry::onlyTrashed()->findOrFail($id);

            $industry->restore();

            return response()->json([
                'message' => 'Industry restored',
            ], 200);
        } catch (ModelNotFoundException $exception) {
            return response()->json([
                'message' => 'Industry not found or not deleted',
            ], 404);
        } catch (\Exception $exception) {
            return response()->json([
                'message' => 'An error occurred trying to answer this request',
            ], 500);
        }
    }
}
