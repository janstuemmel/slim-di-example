<?php

namespace Controller;

use Repository\User as UserRepository;

class Index {

  public function __construct(UserRepository $userRepo) {
    $this->userRepo = $userRepo;
  }

  public function get($request, $response) {

    $users = $this->userRepo->findAll();

    return $response->withJson(array_map(function ($user) {
      return [
        'id' => $user->getId(),
        'email' => $user->getEmail(),
      ];
    }, $users));
  }
}