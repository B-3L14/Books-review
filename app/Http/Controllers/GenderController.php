<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\GenderService;
use App\Http\Requests\GenderStoreRequest;
use App\Http\Requests\GenderUpdateRequest;
use App\Http\Resources\GenderResource;
use App\Http\Resources\BookResource;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class GenderController extends Controller
{
    private GenderService $genderService;
    public function __construct(GenderService $genderService)
    {
        $this->genderService = $genderService;
    }
    public function get(){
        $genders = $this->genderService->get();
        return GenderResource::collection($genders);
    }

    public function details($id){
        try {
            $gender = $this->genderService->details($id);
        }   catch (ModelNotFoundException $e) {
                return response()->json(['message' => 'Gender not found'], 404);
            }           
        
        return new GenderResource($gender);
    }

    public function store(GenderStoreRequest $request){
        $data = $request->validated();
        $gender = $this->genderService->store($data);
        return new GenderResource($gender);

    }

    public function update(int $id, GenderUpdateRequest $request){
        $data = $request->validated();
        try {
            $gender = $this->genderService->update($id, $data);
        }   catch (ModelNotFoundException $e) {
                return response()->json(['message' => 'Gender not found'], 404);
            }    
        
        return new GenderResource($gender);
    }

    public function delete(int $id){
        try {
            $gender = $this->genderService->delete($id);
        }   catch (ModelNotFoundException $e) {
                return response()->json(['message' => 'Gender not found'], 404);
            }  
            
        return new GenderResource($gender);
    }

    public function getWithBook()
    {
        $genders = $this->genderService->getWithBook();
        return GenderResource::collection($genders);

    }

    public function findBooks(int $id)
    {
        try{
            $book = $this->genderService->findBooks($id);
        }catch(ModelNotFoundException $e){
            return response()->json(['error'=>'Gender not found'],404);
        }
        return BookResource::collection($book);
    }
}
