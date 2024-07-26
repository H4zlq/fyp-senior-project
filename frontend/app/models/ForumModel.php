<?php

class ForumModel
{
  private $id;
  private $user_id;
  private $question_id;
  private $username;
  private $questions;
  private $answer;
  private $submit_date;

  public function getId()
  {
    return $this->id;
  }

  public function getUserId()
  {
    return $this->user_id;
  }

  public function getQuestionId()
  {
    return $this->question_id;
  }

  public function getUsername()
  {
    return $this->username;
  }

  public function getQuestions()
  {
    return $this->questions;
  }

  public function getAnswer()
  {
    return $this->answer;
  }

  public function getSubmitDate()
  {
    return $this->submit_date;
  }

  public function setSubmitDate($submit_date)
  {
    $this->submit_date = $submit_date;
  }
}
