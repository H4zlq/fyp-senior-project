<?php

class ProfileController extends Controller
{
  public function index()
  {
    $this->model(UserModel::class);
    $this->model('SubscriptionModel');
    $userService = $this->service(UserService::class);
    $subscriptionService = $this->service('SubscriptionService');
    $user = $userService->getUserById();
    $id = $user->getId();
    $name = $user->getName();
    $username = $user->getUsername();
    $email = $user->getEmail();
    $subscription = $subscriptionService->getSubscriptionByUserId($user->getId());

    $start_date = $subscription ? $subscription->getStartDate() : '';
    $end_date = $subscription ? $subscription->getEndDate() : '';

    $this->view('templates/header');
    $this->view('profile/index', [
      'id' => $id,
      'name' => $name,
      'username' => $username,
      'email' => $email,
      'subscription' => $subscription,
      'start_date' => $start_date,
      'end_date' => $end_date
    ]);
    $this->view('templates/footer');
  }

  public function admin()
  {
    $this->view('admin/templates/header');
    $this->view('dashboard/index');
    $this->view('templates/footer');
  }

  public function edit()
  {
    $this->model(UserModel::class);
    $this->model('SubscriptionModel');
    $userService = $this->service(UserService::class);
    $subscriptionService = $this->service('SubscriptionService');
    $user = $userService->getUserById();
    $id = $user->getId();
    $name = $user->getName();
    $username = $user->getUsername();
    $email = $user->getEmail();
    $subscription = $subscriptionService->getSubscriptionByUserId($user->getId());
    $plan = $subscription ? $subscription->getPurchasePlan() : '';

    $start_date = $subscription ? $subscription->getStartDate() : '';
    $end_date = $subscription ? $subscription->getEndDate() : '';

    $this->view('templates/header');
    $this->view('profile/edit', [
      'id' => $id,
      'name' => $name,
      'username' => $username,
      'email' => $email,
      'plan' => $plan,
      'start_date' => $start_date,
      'end_date' => $end_date
    ]);
    $this->view('templates/footer');
  }

  public function delete($params)
  {
    $this->model(UserModel::class);
    $userService = $this->service(UserService::class);

    if ($params == 'request') {
      $isRequested = $userService->submitAccountDeletionRequest();

      if ($isRequested) {
        Flasher::set('Request submitted successfully. Please wait for the administrator to approve your request.', 'success');
      } else {
        Flasher::set('Failed to submit request', 'danger');
      }
    }

    $this->redirect('/profile');
  }

  public function update()
  {
    $this->model(UserModel::class);
    $userService = $this->service(UserService::class);

    $isUpdated = $userService->updateUser();

    if ($isUpdated) {
      Flasher::set('Profile updated successfully', 'success');
    } else {
      Flasher::set('Failed to update profile', 'danger');
    }

    $this->redirect('/profile');
  }
}
