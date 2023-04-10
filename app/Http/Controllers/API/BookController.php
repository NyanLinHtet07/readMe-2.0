<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Book;

class BookController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $books = Book::all() -> toArray();
        return array_reverse($books);

    }

    public function store(Request $request)
    {
        $request -> validate([
            'title' => 'required',
            'cover' => 'nullable',
            'description' => 'nullable',
            'author' => 'nullable',
            'releaseDate' => 'nullable'
        ]);

        $covers = $request -> file('cover');

        if($covers){
            $imgAry = array();

            foreach($covers as $cover) {
                $filename = uniqid().'_'.$cover -> getClientOriginalName();
                array_push($imgAry, $filename);
                $cover -> move(public_path().'/upload/cover/', $filename);
            }
        }

        $book = Book::create([
            'title' => $request -> title,
            'cover' => serialize($imgAry),
            'description' => $request -> description,
            'author' => $request -> author,
            'releaseDate' => $request -> releaseDate,
        ]);

        $book -> save();

        return response() -> json('Successfully Uploaded');

    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $book = Book::find($id);
        return $book;
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request -> validate([
            'title' => 'required',
            'cover' => 'nullable',
            'description' => 'nullable',
            'author' => 'nullable',
            'releaseDate' => 'nullable'
        ]);

        $books = Book::find($id);
        $books -> update($request -> only('title', 'cover', 'description', 'author', 'releaseDate'));

        return response() -> json('Successfully Updated');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $book = Book::find($id);

        $book -> delete();

        return  response() -> json('Book Deleted');
    }
}
