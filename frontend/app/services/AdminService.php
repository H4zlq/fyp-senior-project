<?php

class AdminService
{
  private $user_table = 'user';
  private $subscription_table = 'purchase';
  private $question_table = 'question';
  private $answer_table = 'answer';
  private $user_request_table = 'user_request';
  private $database;

  public function __construct()
  {
    $this->database = new Database;
  }

  public function getUserCount()
  {
    $query = "SELECT COUNT(*) FROM $this->user_table";
    $this->database->query($query);

    $this->database->execute();

    return $this->database->count();
  }

  public function getSubscriptionCount()
  {
    $query = "SELECT COUNT(*) FROM $this->subscription_table";
    $this->database->query($query);

    $this->database->execute();

    return $this->database->count();
  }

  public function getQuestionCount()
  {
    $query = "SELECT COUNT(*) FROM $this->question_table";
    $this->database->query($query);

    $this->database->execute();

    return $this->database->count();
  }

  public function getAnswerCount()
  {
    $query = "SELECT COUNT(*) FROM $this->answer_table";
    $this->database->query($query);

    $this->database->execute();

    return $this->database->count();
  }

  public function getUsers()
  {
    $query = "SELECT * FROM $this->user_table";
    $this->database->query($query);

    return $this->database->resultSetAsClass(UserModel::class);
  }

  public function updateUser()
  {
    $id = $_POST['id'];
    $name = $_POST['name'];
    $email = $_POST['email'];
    $role = $_POST['role'];
    $username = $_POST['username'];
    $password = $_POST['password'];

    $query = "UPDATE $this->user_table SET name = ?, email = ?, role = ?, username = ?, password = ? WHERE id = ?";
    $this->database->query($query);

    $this->database->bind(1, $name);
    $this->database->bind(2, $email);
    $this->database->bind(3, $role);
    $this->database->bind(4, $username);
    $this->database->bind(5, $password);
    $this->database->bind(6, $id);

    $this->database->execute();

    return $this->database->rowCount() > 0;
  }

  public function blockUser($id)
  {
    $query = "UPDATE $this->user_table SET role = 'blocked' WHERE id = ?";
    $this->database->query($query);

    $this->database->bind(1, $id);

    $this->database->execute();

    return $this->database->rowCount() > 0;
  }

  public function unblockUser($id)
  {
    $query = "UPDATE $this->user_table SET role = '$this->user_table' WHERE id = ?";
    $this->database->query($query);

    $this->database->bind(1, $id);

    $this->database->execute();

    return $this->database->rowCount() > 0;
  }
  public function foreignKeyCheck($bool)
  {
    $FOREIGN_KEY = "SET FOREIGN_KEY_CHECKS = $bool";
    $this->database->query($FOREIGN_KEY);

    $this->database->execute();
  }

  public function deleteUser($id)
  {
    $this->foreignKeyCheck(0);

    $query = "DELETE FROM $this->user_table WHERE id = ?";
    $this->database->query($query);

    $this->database->bind(1, $id);

    $this->database->execute();

    return $this->database->rowCount() > 0;
  }

  public function searchUser()
  {
    $keyword = $_POST['keyword'];
    $query = "SELECT * FROM $this->user_table WHERE username LIKE ?";
    $this->database->query($query);

    $keyword = "%$keyword%";

    $this->database->bind(1, $keyword);

    $this->database->execute();

    if ($this->database->rowCount() > 0) {
      return $this->database->resultSetAsClass(UserModel::class);
    }

    return [];
  }

  public function deleteQuestion($id)
  {
    $this->foreignKeyCheck(0);

    $query = "DELETE FROM $this->question_table WHERE id = ?";
    $this->database->query($query);

    $this->database->bind(1, $id);

    $this->database->execute();

    return $this->database->rowCount() > 0;
  }

  public function deleteAnswer($id)
  {
    $this->foreignKeyCheck(0);

    $query = "DELETE FROM $this->answer_table WHERE id = ?";
    $this->database->query($query);

    $this->database->bind(1, $id);

    $this->database->execute();

    return $this->database->rowCount() > 0;
  }

  public function getUserRequests()
  {
    $query = "SELECT * FROM $this->user_request_table WHERE status = 'pending' AND is_read = 0";
    $this->database->query($query);

    $this->database->execute();

    if ($this->database->rowCount() > 0) {
      return $this->database->resultSet();
    }

    return [];
  }

  public function getUserRequestsCount()
  {
    $query = "SELECT COUNT(*) FROM $this->user_request_table WHERE status = 'pending' AND is_read = 0";
    $this->database->query($query);

    $this->database->execute();

    return $this->database->count();
  }

  public function updateUserRequest($id)
  {
    $query = "UPDATE $this->user_request_table SET status = ?, is_read = 1 WHERE id = ?";
    $this->database->query($query);
    $status = 'unblocked';

    $this->database->bind(1, $status);
    $this->database->bind(2, $id);

    $this->database->execute();

    return $this->database->rowCount() > 0;
  }
}
