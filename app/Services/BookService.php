<?php

namespace App\Services;
use App\Repositories\BookRepository;
use App\Services\ReviewService;

class BookService{
    private BookRepository $bookRepository;
    private ReviewService $reviewService;
    public function __construct(BookRepository $bookRepository, ReviewService $reviewService){
        $this->bookRepository = $bookRepository;
        $this->reviewService = $reviewService;
    }

    public function get(){
        $books = $this->bookRepository->get();
        return $books;
    }

    public function details(int $id){
        return $this->bookRepository->details($id);
    }

    public function store(array $data){
        return $this->bookRepository->store($data);
    }

    public function update(int $id, array $data){
        return $this->bookRepository->update($id,$data);
    }

    public function delete(int $id){
        $book = $this->details($id);
        $reviews = $book->review;

        foreach($reviews as $review){
            $this->reviewService->delete($review->id);
        }

        return $this->bookRepository->delete($id);
    }

    public function getWithAllInfo()
    {
        return $this->bookRepository->getWithAllInfo();
    }

    public function findReview(int $id)
    {
        return $this->bookRepository->findReview($id);
    }
}