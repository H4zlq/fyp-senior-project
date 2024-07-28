<?php

class DashboardController extends Controller
{
  public function dashboard()
  {
    $adminService = $this->service(AdminService::class);

    $this->view('admin/templates/header');
    $this->view('admin/dashboard/index', [
      'username' => Session::get('username'),
      'userCount' => $adminService->getUserCount(),
      'subscriptionCount' => $adminService->getSubscriptionCount(),
      'questionCount' => $adminService->getQuestionCount(),
      'answerCount' => $adminService->getAnswerCount()
    ]);
    $this->view('templates/footer');
  }
}
