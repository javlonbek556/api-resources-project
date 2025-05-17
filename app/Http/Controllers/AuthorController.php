<?php

namespace App\Http\Controllers;


use App\Models\User;

use Illuminate\Http\Request;
use App\Http\Resources\AuthorResource;
use App\Http\Requests\AuthorStoreRequest;
use App\Http\Requests\AuthorUpdateRequest;

class AuthorController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Fetch all authors with their books
        $authors = User::with('books')->get();

        // Return the authors as a resource collection
        return response()->json([
            'data' => AuthorResource::collection($authors),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(AuthorStoreRequest $request)
    {
        $author =  User::create([
            'name' => $request->name,
            'bio' => $request->bio,
        ]);
        return response()->json([
            'data' => new AuthorResource($author),
        ], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        // Fetch the author by ID with their books
        $author = User::with('books')->findOrFail($id);

        // Return the author as a resource
        return response()->json([
            'data' => new AuthorResource($author),
        ]);

    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(AuthorUpdateRequest $request, string $id)
    {
        $author = User::findOrFail($id);
        $author->update([
            'name' => $request->name,
            'bio' => $request->bio,
        ]);
        return response()->json([
            'data' => new AuthorResource($author),
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $author = User::findOrFail($id);
        $author->delete();

        return response()->json([
            'message' => 'Author deleted successfully',
        ], 204);
    }
}
