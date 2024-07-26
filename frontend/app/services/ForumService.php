<?php

class ForumService
{
  private $question_table = 'question';
  private $answer_table = 'answer';
  private $user_table = 'user';
  private $database;

  public function __construct()
  {
    $this->database = new Database();
  }

  public function insertQuestion($question)
  {
    $userId = Session::get('id'); // Assuming user ID is stored in the session

    $query = "INSERT INTO $this->question_table (user_id, questions, submit_date) VALUES (?, ?, NOW())";
    $this->database->query($query);

    $this->database->bind(1, $userId);
    $this->database->bind(2, $question);

    $this->database->execute();

    return $this->database->rowCount() > 0;
  }

  public function insertAnswer($answer, $question_id)
  {
    $userId = Session::get('id'); // Assuming user ID is stored in the session

    $query = "INSERT INTO answer (question_id, user_id, answer, submit_date) VALUES (?, ?, ?, NOW())";
    $this->database->query($query);

    $this->database->bind(1, $question_id);
    $this->database->bind(2, $userId);
    $this->database->bind(3, $answer);

    $this->database->execute();

    return $this->database->rowCount() > 0;
  }

  public function fetchQuestions()
  {
    $query = "SELECT q.id, q.questions, q.submit_date, u.username FROM $this->question_table q JOIN $this->user_table u ON q.user_id = u.id ORDER BY q.submit_date DESC";
    $this->database->query($query);
    $this->database->execute();

    if ($this->database->rowCount() > 0) {
      $results = $this->database->resultSetAsClass(ForumModel::class);

      foreach ($results as $result) {
        $formatted_date = date("F j,Y, g:i a", strtotime($result->getSubmitDate()));
        $result->setSubmitDate($formatted_date);
      }

      return $results;
    }

    return [];
  }

  public function fetchAnswers()
  {
    $query = "SELECT a.id, a.question_id, a.answer, a.submit_date, u.username FROM $this->answer_table a JOIN $this->user_table u ON a.user_id = u.id ORDER BY a.submit_date DESC";
    $this->database->query($query);
    $this->database->execute();
    $answers = [];

    if ($this->database->rowCount() > 0) {
      $results = $this->database->resultSetAsClass(ForumModel::class);

      foreach ($results as $result) {
        $formatted_date = date("F j,Y, g:i a", strtotime($result->getSubmitDate()));
        $result->setSubmitDate($formatted_date);
        $answers[$result->getQuestionId()][] = $result;
      }
    }

    return $answers;
  }

  public function searchQuestions()
  {
    $keyword = $_POST['keyword'];
    $query = "SELECT q.id, q.questions, q.submit_date, u.username FROM question q JOIN user u ON q.user_id = u.id WHERE q.questions LIKE ? ORDER BY q.submit_date DESC";
    // $query = "SELECT q.id, q.questions, q.submit_date, u.username FROM $this->question_table q JOIN $this->user_table u ON q.user_id = u.id WHERE q.questions LIKE ? ORDER BY q.submit_date DESC";
    $this->database->query($query);

    $keyword = "%$keyword%";

    $this->database->bind(1, $keyword);

    $this->database->execute();

    if ($this->database->rowCount() > 0) {
      return $this->database->resultSetAsClass(ForumModel::class);
    }

    return [];
  }

  public function searchAnswers()
  {
    $keyword = $_POST['keyword'];
    $query = "SELECT a.id, a.question_id, a.answer, a.submit_date, u.username FROM answer a JOIN user u ON a.user_id = u.id WHERE a.answer LIKE ? ORDER BY a.submit_date DESC";
    $this->database->query($query);
    $answers = [];

    $keyword = "%$keyword";

    $this->database->bind(1, $keyword);

    $this->database->execute();

    if ($this->database->rowCount() > 0) {
      $results = $this->database->resultSetAsClass(ForumModel::class);

      foreach ($results as $result) {
        $formatted_date = date("F j,Y, g:i a", strtotime($result->getSubmitDate()));
        $result->setSubmitDate($formatted_date);
        $answers[$result->getQuestionId()][] = $result;
      }
    }

    return $answers;
  }


  public function deleteQuestion($question_id)
  {
    $userId = Session::get('id'); // Assuming user ID is stored in the session

    $query = "DELETE FROM $this->question_table WHERE id = ? AND user_id = ?";
    $this->database->query($query);

    $this->database->bind(1, $question_id);
    $this->database->bind(2, $userId);

    $this->database->execute();

    return $this->database->rowCount() > 0;
  }

  public function deleteAnswer($question_id, $id)
  {
    $userId = Session::get('id'); // Assuming user ID is stored in the session

    $query = "DELETE FROM $this->answer_table WHERE question_id = ? AND user_id = ? AND id = ?";
    $this->database->query($query);

    $this->database->bind(1, $question_id);
    $this->database->bind(2, $userId);
    $this->database->bind(3, $id);

    $this->database->execute();

    return $this->database->rowCount() > 0;
  }
}
