<?php

namespace Repository;

use Doctrine\ORM\EntityRepository;
use Doctrine\ORM\EntityManagerInterface;

use Model\User as UserModel;

class User extends EntityRepository {

  public function __construct(EntityManagerInterface $em) {

    parent::__construct($em, $em->getClassMetadata(UserModel::class));
  }

  // example function to show how to use entityManager inside repo
  public function _exampleFindAll() {

    $users = $this->getEntityManager()->getRepository(UserModel::class)->findAll();

    return $users;
  }

}