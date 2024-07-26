<?php

class SubscriptionService
{
  private $table = 'purchase';
  private $database;

  public function __construct()
  {
    $this->database = new Database;
  }

  public function getSubscriptionByUserId($userId)
  {
    $query = "SELECT * FROM $this->table WHERE user_id = ? ORDER BY purchase_plan DESC LIMIT 1;";
    $this->database->query($query);

    $this->database->bind(1, $userId);

    return $this->database->singleAsClass(SubscriptionModel::class);
  }

  public function getSubscriptionsByUserId($userId)
  {
    $subscriptions = [];

    $query = "SELECT * FROM purchase WHERE user_id = ?";
    $this->database->query($query);

    $this->database->bind(1, $userId);

    $this->database->execute();

    while ($subscription = $this->database->singleAsClass(SubscriptionModel::class)) {
      $subscriptions[] = $subscription;
    }

    return $subscriptions;
  }

  public function findExpiredSubscriptions()
  {
    $userId = $_SESSION['id']; // Assuming user ID is stored in the session
    $expiredSubscriptions = [];

    $query = "SELECT purchase_id FROM $this->table WHERE user_id = ? AND end_date < ?;";

    $this->database->query($query);
    $formatedDate = DateHelper::getCurrentDate();

    $this->database->bind(1, $userId);

    $this->database->bind(2, $formatedDate);

    while ($subscription = $this->database->singleAsClass(SubscriptionModel::class)) {
      $expiredSubscriptions[] = $subscription;
    }

    return $expiredSubscriptions;
  }

  public function deleteExpiredSubscription()
  {
    $expiredSubscriptions = $this->findExpiredSubscriptions();

    if (count($expiredSubscriptions) > 0) {
      $query = "DELETE FROM purchase WHERE purchase_id = ?;";
      $this->database->query($query);

      foreach ($expiredSubscriptions as $subscription) {
        $subscriptionId = $subscription->getPurchaseId();
        $this->database->bind(1, $subscriptionId);
        $this->database->execute();
      }

      return true;
    }

    return false;
  }
}
