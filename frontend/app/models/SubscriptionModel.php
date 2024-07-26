<?php

class SubscriptionModel
{
  private $purchase_id;
  private $user_id;
  private $username;
  private $email;
  private $purchase_plan;
  private $start_date;
  private $end_date;
  private $status;

  // Getters
  public function getPurchaseId()
  {
    return $this->purchase_id;
  }

  public function getUserId()
  {
    return $this->user_id;
  }

  public function getUsername()
  {
    return $this->username;
  }

  public function getEmail()
  {
    return $this->email;
  }

  public function getPurchasePlan()
  {
    return $this->purchase_plan;
  }

  public function getStartDate()
  {
    return $this->start_date;
  }

  public function getEndDate()
  {
    return $this->end_date;
  }

  public function getStatus()
  {
    return $this->status;
  }
}
