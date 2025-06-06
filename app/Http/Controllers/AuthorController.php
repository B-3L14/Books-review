<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\AuthorService;
use App\Http\Requests\AuthorStoreRequest;
use App\Http\Requests\AuthorUpdateRequest;
use App\Http\Resources\AuthorResource;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class AuthorController extends Controller
{
    private AuthorService $authorService;
    public function __construct(AuthorService $authorService)
    {
        $this->authorService = $authorService;
    }
    public function get(){
        $authors = $this->authorService->get();
        return AuthorResource::collection($authors);
    }

    public function details($id){
        try {
            $author = $this->authorService->details($id);
        }   catch (ModelNotFoundException $e) {
                return response()->json(['message' => 'Author not found'], 404);
            }           
        
        return new AuthorResource($author);
    }

    public function store(AuthorStoreRequest $request){
        $data = $request->validated();
        $author = $this->authorService->store($data);
        return new AuthorResource($author);

    }

    public function update(int $id, AuthorUpdateRequest $request){
        $data = $request->validated();
        try {
            $author = $this->authorService->update($id, $data);
        }   catch (ModelNotFoundException $e) {
                return response()->json(['message' => 'Author not found'], 404);
            }    
        
        return new AuthorResource($author);
    }

    public function delete(int $id){
        try {
            $author = $this->authorService->delete($id);
        }   catch (ModelNotFoundException $e) {
                return response()->json(['message' => 'Author not found'], 404);
            }  
            
        return new AuthorResource($author);
    }

    public function getWithAllInfo()
    {
        $authors = $this->authorService->getWithAllInfo();
        return AuthorResource::collection($authors);

    }

    public function findReview(int $id)
    {
        try{
            $review = $this->authorService->findReview($id);
        }catch(ModelNotFoundException $e){
            return response()->json(['error'=>'Author not found'],404);
        }
        return new AuthorResource($review);
    }
}
