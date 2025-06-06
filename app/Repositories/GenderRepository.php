<?php
namespace App\Repositories;
use App\Models\Gender;


class GenderRepository{
    public function get(){
        return Gender::all();
    }

    public function details(int $id){
        return Gender::findOrFail($id); 
    }

    public function store(array $data){
        return Gender::create($data);
    }

    public function update(int $id, array $data){
        $gender = $this->details($id);
        $gender->update($data);
        return $gender;
    }

    public function delete(int $id){
        $gender = $this->details($id);
        $gender->delete();
        return $gender;
    }

    public function getWithBook()
    {
        $genders  = Gender::with('book')->get();
        return $genders;

    }

    public function findBooks(int $id)
    {
        $gender = $this->details($id);
        $book = $gender->book;
        return $book;
    }
}