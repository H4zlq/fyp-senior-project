<?php

class UserModel
{
  private $id;
  private $name;
  private $email;
  private $role;
  private $username;
  private $password;

  public function getId()
  {
    return $this->id;
  }

  public function getName()
  {
    return $this->name;
  }

  public function getEmail()
  {
    return $this->email;
  }

  public function getRole()
  {
    return $this->role;
  }

  public function getUsername()
  {
    return $this->username;
  }

  public function getPassword()
  {
    return $this->password;
  }

  public function isBlocked($role)
  {
    return $role === 'blocked';
  }

  public function getRoleClass($role)
  {
    switch ($role) {
      case 'admin':
        return 'info';
      case 'user':
        return 'success';
      case 'blocked':
        return 'danger';
      case 'deleted':
        return 'danger';
    }
  }
}
