<?php

namespace App\Services;
use App\Repositories\AuthorRepository;
use App\Services\BookService;

class AuthorService{
    private AuthorRepository $authorRepository;
    private BookService $bookService;

    public function __construct(AuthorRepository $authorRepository, BookService $bookService){
        $this->authorRepository = $authorRepository;
        $this->bookService = $bookService;
    }

    public function get(){
        $authors = $this->authorRepository->get();
        return $authors;
    }

    public function details(int $id){
        return $this->authorRepository->details($id);
    }

    public function store(array $data){
        return $this->authorRepository->store($data);
    }

    public function update(int $id, array $data){
        return $this->authorRepository->update($id,$data);
    }

    public function delete(int $id){
        $author = $this->details($id);
        $books = $author->book;

        foreach($books as $book){
            $this->bookService->delete($book->id);
        }

        return $this->authorRepository->delete($id);
    }

    public function getWithBook()
    {
        return $this->authorRepository->getWithBook();
    }

    public function findBooks(int $id)
    {
        return $this->authorRepository->findBooks($id);
    }
}