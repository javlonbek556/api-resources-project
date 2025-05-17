<?php

namespace App\Http\Controllers;

use App\Models\Book;
use Illuminate\Http\Request;
use App\Http\Resources\BookResource;
use App\Http\Requests\BookStoreRequest;
use App\Http\Requests\BookUpdateRequest;

class BookController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Fetch all books with their authors
        $books = Book::with('user')->get();

        // Return the books as a resource collection
        return response()->json([
            'data' => BookResource::collection($books),
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
    public function store(BookStoreRequest $request)
    {
        $book = Book::create([
            'title' => $request->title,
            'description' => $request->description,
            'price' => $request->price,
            'user_id' => $request->user_id,
        ]);

        return response()->json([
            'data' => new BookResource($book),
        ], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $book = Book::with('user')->findOrFail($id);
        return response()->json([
            'data' => new BookResource($book),
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
    public function update(BookUpdateRequest $request, string $id)
    {
        $book = Book::findOrFail($id);
        $book->update([
            'title' => $request->title,
            'description' => $request->description,
            'price' => $request->price,
            'author_id' => $request->author_id,
        ]);

        return response()->json([
            'data' => new BookResource($book),
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $book = Book::findOrFail($id);
        $book->delete();

        return response()->json([
            'message' => 'Book deleted successfully',
        ]);
    }
}
