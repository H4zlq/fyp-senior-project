<?php

class NotificationController extends Controller
{
  public function index()
  {
    $this->model('NotificationModel');
    $adminService = $this->service('AdminService');

    $userRequest = $adminService->getUserRequests();
    $userCount = $adminService->getUserRequestsCount();

    echo json_encode([
      'users' => $userRequest,
      'count' => $userCount
    ]);
  }

  public function update()
  {
    $id = $_POST['id'];
    $this->model('NotificationModel');
    $adminService = $this->service('AdminService');

    $isUpdated = $adminService->updateUserRequest($id);

    if ($isUpdated) {
      echo json_encode([
        'message' => 'Notification updated successfully',
        'type' => 'success'
      ]);
    } else {
      echo json_encode([
        'message' => 'Failed to update notification',
        'type' => 'danger'
      ]);
    }
  }
}
