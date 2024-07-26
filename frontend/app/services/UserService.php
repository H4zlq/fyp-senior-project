<?php

class UserService
{
  private $table = 'user';
  private $user_request_table = 'user_request';
  private $database;

  public function __construct()
  {
    $this->database = new Database;
  }

  public function getUserByUsername($username)
  {
    $query = "SELECT * FROM $this->table WHERE username = ?";
    $this->database->query($query);

    $this->database->bind(1, $username);

    return $this->database->singleAsClass(UserModel::class);
  }

  public function loginUser($username, $password, $test)
  {
    $query = "SELECT id, username, password, role FROM $this->table WHERE username = ?";
    $this->database->query($query);

    $this->database->bind(1, $username);

    $this->database->execute();

    if ($this->database->rowCount() == 1) {
      $user = $this->getUserByUsername($username);

      if ($user->getRole() == 'blocked') {
        Session::set([
          'id' => $user->getId(),
          'username' => $user->getUsername(),
        ]);
        Flasher::set('Your account has been blocked. Please contact the administrator to retrieve your account.', 'danger');

        return false;
      }

      $id = $user->getId();
      $username = $user->getUsername();
      $role = $user->getRole();

      if ($password == $user->getPassword()) {
        Session::regenerate();
        Session::set([
          'loggedin' => true,
          'id' => $id,
          'username' => $username,
          'role' => $role
        ]);
        return true;
      } else {
        Flasher::set('Invalid credentials. Please try again.', 'danger');
      }
    } else {
      Flasher::set('Invalid credentials. Please try again.', 'danger');
    }

    return false;
  }

  public function insertUser()
  {
    $email = $_POST['email'];
    $username = $_POST['username'];
    $password = $_POST['password'];

    $query = "INSERT INTO $this->table (email, username, password) VALUES (?, ?, ?)";
    $this->database->query($query);

    $this->database->bind(1, $email);
    $this->database->bind(2, $username);
    $this->database->bind(3, $password);

    $this->database->execute();

    return $this->database->rowCount() > 0;
  }

  public function getUserById()
  {
    $userId = Session::get('id');
    $query = "SELECT * FROM $this->table WHERE id = ?";
    $this->database->query($query);

    $this->database->bind(1, $userId);

    $this->database->execute();

    return $this->database->singleAsClass(UserModel::class);
  }

  public function updateUser()
  {
    $userId = $_SESSION['id']; // Assuming user ID is stored in the session
    $name = $_POST['name'];
    $email = $_POST['email'];

    $query = "UPDATE $this->table SET name = ?, email = ? WHERE id = ?";
    $this->database->query($query);

    $this->database->bind(1, $name);
    $this->database->bind(2, $email);
    $this->database->bind(3, $userId);

    $this->database->execute();

    return $this->database->rowCount() > 0;
  }

  public function updateUserRole($role, $userId)
  {
    $query = "UPDATE $this->table SET role = ? WHERE id = ?";
    $this->database->query($query);

    $this->database->bind(1, $role);
    $this->database->bind(2, $userId);

    return $this->database->execute();
  }

  public function submitRequest()
  {
    $userId = $_POST['user_id'];
    $username = $_POST['username'];
    $query = "INSERT INTO $this->user_request_table (user_id, username, type, created_at, is_read, status) VALUES (?, ?, ?, NOW(), 0, ?)";
    $this->database->query($query);
    $type = 'block';
    $status = 'pending';

    $this->database->bind(1, $userId);
    $this->database->bind(2, $username);
    $this->database->bind(3, $type);
    $this->database->bind(4, $status);

    $this->database->execute();

    return $this->database->rowCount() > 0;
  }

  public function submitAccountDeletionRequest()
  {
    $userId = $_POST['user_id'];
    $username = $_POST['username'];

    $query = "INSERT INTO $this->user_request_table (user_id, username, type, created_at, status) VALUES (?, ?, ?, NOW(), ?)";
    $this->database->query($query);
    $type = 'deletion';
    $status = 'pending';
    $role = 'deleted';

    $this->updateUserRole($role, $userId);

    $this->database->bind(1, $userId);
    $this->database->bind(2, $username);
    $this->database->bind(3, $type);
    $this->database->bind(4, $status);

    return $this->database->execute();
  }
}
