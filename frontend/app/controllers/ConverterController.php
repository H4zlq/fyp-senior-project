<?php

class ConverterController extends Controller
{
  public function index()
  {
    $this->model(UserModel::class);
    $this->model(SubscriptionModel::class);
    $userService = $this->service(UserService::class);
    $subscriptionService = $this->service(SubscriptionService::class);

    $id = null;
    $username = null;
    $subscription = null;
    $border = 'black';

    if (Session::exists('loggedin') && Session::get('loggedin') === true) {
      $user = $userService->getUserById();
      $id = $user->getId();
      $username = $user->getUsername();
      $subscription = $subscriptionService->getSubscriptionByUserId($id);
      $isExpired = $subscriptionService->deleteExpiredSubscription();

      if ($isExpired) {
        Flasher::set('Your subscription has expired. Please renew your subscription to continue using the service.', 'info');
      }

      if ($subscription !== null) {
        if ($subscription->getPurchasePlan() === 'Yearly') {
          $border = 'red';
        } elseif ($subscription->getPurchasePlan() === 'Monthly') {
          $border = 'green';
        } elseif ($subscription->getPurchasePlan() === 'Weekly') {
          $border = 'blue';
        } else {
          $border = 'black';
        }
      }
    }

    $this->view('templates/header');
    $this->view('converter/index', [
      'id' => $id,
      'username' => $username,
      'subscription' => $subscription,
      'border' => $border
    ]);
    $this->view('templates/footer');
  }
}
