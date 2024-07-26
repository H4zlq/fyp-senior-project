<?php

class ForumController extends Controller
{
  public function index()
  {
    $this->model('ForumModel');
    $forumService = $this->service('ForumService');

    $questions = $forumService->fetchQuestions();
    $answers = $forumService->fetchAnswers();

    $this->view('templates/header');
    $this->view('forum/index', [
      'questions' => $questions,
      'answers' => $answers
    ]);
    $this->view('templates/footer');
  }

  public function search()
  {
    $this->model('ForumModel');
    $forumService = $this->service('ForumService');

    $questions = $forumService->searchQuestions();
    $answers = $forumService->fetchAnswers();

    $this->view('templates/header');
    $this->view('forum/index', [
      'questions' => $questions,
      'answers' => $answers
    ]);
    $this->view('templates/footer');
  }

  public function submit($params = [])
  {
    $this->model('ForumModel');
    $forumService = $this->service('ForumService');

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
      if ($params === 'question') {
        $question = $_POST['question'];
        $isSubmitted = $forumService->insertQuestion($question);

        if ($isSubmitted) {
          Flasher::set('Question submitted successfully', 'success');
        } else {
          Flasher::set('Failed to submit question', 'danger');
        }
      } else if ($params === 'answer') {
        $answer = $_POST['answer'];
        $question_id = $_POST['question_id'];
        $isSubmitted = $forumService->insertAnswer($answer, $question_id);

        if ($isSubmitted) {
          Flasher::set('Answer submitted successfully', 'success');
        } else {
          Flasher::set('Failed to submit answer', 'danger');
        }
      }
    }

    $this->redirect('/forum');
  }

  public function delete($params = [])
  {
    $this->model('ForumModel');
    $forumService = $this->service('ForumService');

    if ($_SERVER['REQUEST_METHOD'] == 'GET') {
      if ($params[2] == 'question') {
        $question_id = $params[3];
        $isDeleted = $forumService->deleteQuestion($question_id);

        if ($isDeleted) {
          Flasher::set('Question deleted successfully', 'success');
        } else {
          Flasher::set('Failed to delete question', 'danger');
        }
      } else if ($params[2] == 'answer') {
        $answer_id = $params[4];
        $question_id = $params[3];
        $isDeleted = $forumService->deleteAnswer($question_id, $answer_id);

        if ($isDeleted) {
          Flasher::set('Answer deleted successfully', 'success');
        } else {
          Flasher::set('Failed to delete answer', 'danger');
        }
      }
    }

    $this->redirect('/forum');
  }
}
