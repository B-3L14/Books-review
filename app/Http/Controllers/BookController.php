<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\BookService;
use App\Http\Requests\BookStoreRequest;
use App\Http\Requests\BookUpdateRequest;
use App\Http\Resources\BookResource;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class BookController extends Controller
{
    private BookService $bookService;
    public function __construct(BookService $bookService)
    {
        $this->bookService = $bookService;
    }
    public function get(){
        $books = $this->bookService->get();
        return BookResource::collection($books);
    }

    public function details($id){
        try {
            $book = $this->bookService->details($id);
        }   catch (ModelNotFoundException $e) {
                return response()->json(['message' => 'Book not found'], 404);
            }           
        
        return new BookResource($book);
    }

    public function store(BookStoreRequest $request){
        $data = $request->validated();
        $book = $this->bookService->store($data);
        return new BookResource($book);

    }

    public function update(int $id, BookUpdateRequest $request){
        $data = $request->validated();
        try {
            $book = $this->bookService->update($id, $data);
        }   catch (ModelNotFoundException $e) {
                return response()->json(['message' => 'Book not found'], 404);
            }    
        
        return new BookResource($book);
    }

    public function delete(int $id){
        try {
            $book = $this->bookService->delete($id);
        }   catch (ModelNotFoundException $e) {
                return response()->json(['message' => 'Book not found'], 404);
            }  
            
        return new BookResource($book);
    }

    public function getWithAllInfo()
    {
        $books = $this->bookService->getWithAllInfo();
        return BookResource::collection($books);

    }

    public function findReview(int $id)
    {
        try{
            $review = $this->bookService->findReview($id);
        }catch(ModelNotFoundException $e){
            return response()->json(['error'=>'Book not found'],404);
        }
        return new BookResource($review);
    }
}
