<?php

namespace App\Services;
use App\Repositories\GenderRepository;

class GenderService{
    private GenderRepository $genderRepository;
    public function __construct(GenderRepository $genderRepository){
        $this->genderRepository = $genderRepository;
    }

    public function get(){
        $genders = $this->genderRepository->get();
        return $genders;
    }

    public function details(int $id){
        return $this->genderRepository->details($id);
    }

    public function store(array $data){
        return $this->genderRepository->store($data);
    }

    public function update(int $id, array $data){
        return $this->genderRepository->update($id,$data);
    }

    public function delete(int $id){
        return $this->genderRepository->delete($id);
    }

    public function getWithBook()
    {
        return $this->genderRepository->getWithBook();
    }

    public function findBooks(int $id)
    {
        return $this->genderRepository->findBooks($id);
    }
}