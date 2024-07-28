<?php

class UserController extends Controller
{
  public function dashboard()
  {
    $this->model(UserModel::class);
    $adminService = $this->service(AdminService::class);

    $username = Session::get('username');
    $users = $adminService->getUsers();

    $this->view('admin/templates/header');
    $this->view('admin/user/index', [
      'username' => $username,
      'users' => $users
    ]);
    $this->view('templates/footer');
  }

  public function edit($params = [])
  {
    $id = $params[3];
    $this->model(UserModel::class);
    $userService = $this->service(UserService::class);

    $user = $userService->getUserById($id);
    $name = $user->getName();
    $email = $user->getEmail();
    $role = $user->getRole();
    $username = $user->getUsername();
    $password = $user->getPassword();

    $this->view('admin/templates/header');
    $this->view('admin/user/edit', [
      'id' => $id,
      'name' => $name,
      'email' => $email,
      'role' => $role,
      'username' => $username,
      'password' => $password
    ]);
    $this->view('templates/footer');
  }

  public function update()
  {
    $this->model(UserModel::class);
    $adminService = $this->service(AdminService::class);

    $isUpdated = $adminService->updateUser();

    if ($isUpdated) {
      Flasher::set('User updated successfully', 'success');
    } else {
      Flasher::set('Failed to update user', 'danger');
    }

    $this->redirect('/admin/user');
  }

  public function block($params = [])
  {
    $id = $params[3];
    $this->model(UserModel::class);
    $adminService = $this->service(AdminService::class);

    $isBlocked = $adminService->blockUser($id);

    if ($isBlocked) {
      Flasher::set('User blocked successfully', 'success');
    } else {
      Flasher::set('Failed to block user', 'danger');
    }

    $this->redirect('/admin/user');
  }

  public function unblock($params = [])
  {
    $id = $params[3];
    $this->model(UserModel::class);
    $adminService = $this->service(AdminService::class);

    $isBlocked = $adminService->unblockUser($id);

    if ($isBlocked) {
      Flasher::set('User unblocked successfully', 'success');
    } else {
      Flasher::set('Failed to unblock user', 'danger');
    }

    $this->redirect('/admin/user');
  }

  public function delete($params = [])
  {
    $id = $params[3];
    $this->model(UserModel::class);
    $adminService = $this->service(AdminService::class);

    $isDeleted = $adminService->deleteUser($id);

    if ($isDeleted) {
      Flasher::set('User deleted successfully', 'success');
    } else {
      Flasher::set('Failed to delete user', 'danger');
    }

    $this->redirect('/admin/user');
  }

  public function search()
  {
    $this->model(UserModel::class);
    $adminService = $this->service(AdminService::class);

    $username = Session::get('username');
    $users = $adminService->searchUser();

    $this->view('admin/templates/header');
    $this->view('admin/user/index', [
      'username' => $username,
      'users' => $users,
    ]);
    $this->view('templates/footer');
  }
}
