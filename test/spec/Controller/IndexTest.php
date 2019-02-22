<?php

namespace test\spec\Controller;

use \PHPUnit\Framework\TestCase;

use \Doctrine\ORM\EntityManager;
use \Doctrine\ORM\EntityRepository;

use \Slim\Http\Response;
use \Slim\Http\Request;
use \Slim\Http\Environment;

use \Model\User;
use \Repository\User as UserRepository;
use \Controller\Index as IndexConroller;

class IndexTest extends TestCase {

  public function testGetUsers() {

    // given
    $repo = $this->mockRepo('findAll', [ new MockUser(1, 'foo', 'bar') ]);
    $indexController = new IndexConroller($repo);

    // when
    $res = $indexController->get(null, new Response);

    // then
    $this->assertEquals('[{"id":1,"email":"foo"}]', (string)$res->getBody());
  }

  protected function mockRepo($method, $data) {
    $repo = $this->createMock(UserRepository::class);
    $repo->expects($this->any())
      ->method($method)
      ->willReturn($data);

    return $repo;
  }

}

class MockUser extends User {
  public function __construct($id, $email, $password) {
    $this->id = $id;
    parent::__construct($email, $password);
  }
}