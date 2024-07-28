<?php

class ForumController extends Controller
{
  public function dashboard()
  {
    $this->model(ForumModel::class);
    $forumService = $this->service(ForumService::class);

    $username = Session::get('username');
    $questions = $forumService->fetchQuestions();
    $answers = $forumService->fetchAnswers();

    $this->view('admin/templates/header');
    $this->view('admin/forum/index', [
      'username' => $username,
      'questions' => $questions,
      'answers' => $answers
    ]);
    $this->view('templates/footer');
  }

  public function search($params = [])
  {
    $this->model(ForumModel::class);
    $forumService = $this->service(ForumService::class);

    $username = Session::get('username');
    $questions = $forumService->fetchQuestions();
    $answers = $forumService->fetchAnswers();

    if ($params[3] == 'question') {
      $questions = $forumService->searchQuestions();
    } else if ($params[3] == 'answer') {
      $answers = $forumService->searchAnswers();
    }

    $this->view('admin/templates/header');
    $this->view('admin/forum/index', [
      'username' => $username,
      'questions' => $questions,
      'answers' => $answers
    ]);
    $this->view('templates/footer');
  }

  public function delete($params = [])
  {
    $id = $params[4];
    $this->model(ForumModel::class);
    $adminService = $this->service(AdminService::class);

    if ($params[3] == 'question') {
      $isDeleted = $adminService->deleteQuestion($id);

      if ($isDeleted) {
        Flasher::set('Question deleted successfully', 'success');
      } else {
        Flasher::set('Failed to delete question', 'danger');
      }
    } else if ($params[3] == 'answer') {
      $isDeleted = $adminService->deleteAnswer($id);

      if ($isDeleted) {
        Flasher::set('Answer deleted successfully', 'success');
      } else {
        Flasher::set('Failed to delete answer', 'danger');
      }
    }

    $this->redirect('/admin/forum');
  }
}
