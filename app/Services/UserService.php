<?php

namespace App\Services;
use App\Repositories\UserRepository;
use App\Services\ReviewService;

class UserService{
    private UserRepository $userRepository;
    private ReviewService $reviewService;
    public function __construct(UserRepository $userRepository, ReviewService $reviewService){
        $this->userRepository = $userRepository;
        $this->reviewService = $reviewService;
    }

    public function get(){
        $users = $this->userRepository->get();
        return $users;
    }

    public function details(int $id){
        return $this->userRepository->details($id);
    }

    public function store(array $data){
        return $this->userRepository->store($data);
    }

    public function update(int $id, array $data){
        return $this->userRepository->update($id,$data);
    }

    public function delete(int $id){
        $user = $this->details($id);
        $reviews = $user->review;

        foreach($reviews as $review){
            $this->reviewService->delete($review->id);
        }


        return $this->userRepository->delete($id);
    }

    public function findReviews(int $id)
    {
        return $this->userRepository->findReviews($id);
    }

}