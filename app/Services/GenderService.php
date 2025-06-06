<?php

namespace App\Services;
use App\Repositories\GenderRepository;
use App\Services\BookService;

class GenderService{
    private GenderRepository $genderRepository;
    private BookService $bookService;
    public function __construct(GenderRepository $genderRepository, BookService $bookService){
        $this->genderRepository = $genderRepository;
        $this->bookService = $bookService;
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
        $gender = $this->details($id);
        $books = $gender->book;
        foreach($books as $book){
            $data = ['gender_id'=> null];
            $book_id = $book->id;
            $this->bookService->update($book_id, $data);

        }

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