<?php

class NotificationModel
{
  private $id;
  private $user_id;
  private $username;
  private $type;
  private $created_at;
  private $is_read;
  private $status;

  public function getId()
  {
    return $this->id;
  }

  public function getUserId()
  {
    return $this->user_id;
  }

  public function getUsername()
  {
    return $this->username;
  }

  public function getType()
  {
    return $this->type;
  }

  public function getCreatedAt()
  {
    return $this->created_at;
  }

  public function getIsRead()
  {
    return $this->is_read;
  }

  public function getStatus()
  {
    return $this->status;
  }
}
