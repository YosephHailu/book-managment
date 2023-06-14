<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreBookRequest;
use App\Http\Requests\UpdateBookRequest;
use App\Http\Resources\V1\BookResource;
use App\Http\Resources\V1\BookResourceCollection;
use App\Models\Book;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class BookController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        //
        return new BookResourceCollection(Book::paginate($request->per_page ?? 15));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreBookRequest $request): BookResource
    {
        //prepare model to insert to database
        $bookModel = $request->safe()->only(['title', 'author', 'publication_year', 'genre', 'summery']);

        if($request->hasFile('cover_image')) {
            $filesname = $request->cover_image->store('book-cover-images', ['disk' => 'public']);
            $bookModel['cover_image'] = $filesname;
        }
        // insert to database
        $book = Book::create($bookModel);

        return new BookResource($book);
    }

    /**
     * Display the specified resource.
     */
    public function show(Book $book): BookResource
    {
        return new BookResource($book);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateBookRequest $request, Book $book): BookResource
    {
        //prepare model to insert to database
        $bookModel = $request->safe()->only(['title', 'author', 'publication_year', 'genre', 'summery']);

        // update to database record
        $book->update($bookModel);

        return new BookResource($book);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Book $book): BookResource
    {
        $book->delete();

        return new BookResource($book);
    }
}
