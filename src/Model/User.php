<?php

namespace Model;

/** @Entity(repositoryClass="Repository\User") @Table(name="users") **/
class User {

  /** @Id @Column(type="integer") @GeneratedValue **/
  protected $id;

  /** @Column(type="string", unique=true) **/
  protected $email;

  /** @Column(type="string") **/
  protected $password;

  public function __construct($email, $password) {
    $this->email = $email;
    $this->password = $password;
  } 

  public function getId() {
    return $this->id;
  }

  public function getEmail() {
    return $this->email;
  }
}