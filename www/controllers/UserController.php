<?php
/**
 * Created by PhpStorm.
 * User: amarz
 * Date: 14.11.2017
 * Time: 13:16
 */

namespace controllers;
use models\Question;
use models\Test;

class UserController extends AppController
{

    public function indexAction()
    {
        $title = "list of tests";
        $tests = Test::findAll();
        $this->setVars(compact('title', 'tests'));
        $this->view = 'index';
    }

    public function questionsAction(){
        $testId = 0;
        if (isset ($_GET['test_id'])) {
            $testId = $_GET['test_id'];
        }
        // if we don not have questions in sessions (it happens when we finish questions) so new array
        $this->initSession($testId);
        // show answer and question id !
        $errors = $this->checkAnswers();
        $method = isset($_GET['method']) ? $_GET['method'] : 'next';
        $question = Question::getNextQuestion($testId, $method);
        $_SESSION['test_id'] = $question->test_id;
        if ($question === false) {
            if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                $this->result();
            }else{
                $this->indexAction();
            }
            return; // not to complete code.
        }
        $answers = $question->answers;
        $this->setVars(compact('question', 'answers', 'errors'));

    }

    protected function checkAnswers(){
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            if (isset($_POST['answer']) && isset($_POST['quest_id'])) {
                $answer = $_POST['answer'];
                $quest_id = $_POST['quest_id'];
                // $_SESSION['last_quest_id'] = $_POST['quest_id'];

                $question = Question::findOneById($quest_id);
                $_SESSION['QUESTIONS'][] = $question->id;
                $right_ans_id = $question->right_ans_id;

                if ($answer == $right_ans_id) {
                    $_SESSION['right_answers'][] = $answer;
                    $_SESSION['right_answers_count']++;
                } else {
                    $_SESSION['wrong_answers'][] = $answer;
                    $_SESSION['wrong_answers_count']++;
                }
            } else {
                $errors[] = "please choose an answer..";
                return $errors;
            }
        }
    }

    protected function result(){
        $this->view = 'success';
        unset($_SESSION['QUESTIONS']);
        unset($_SESSION['test_id']);
    }

    protected function initSession($testId){
        if (!isset($_SESSION['QUESTIONS']) || $_SESSION['test_id'] != $testId) {
            $_SESSION['QUESTIONS'] = [];
            $_SESSION['right_answers'] = array();
            $_SESSION['right_answers_count'] = 0;
            $_SESSION['wrong_answers'] = array();
            $_SESSION['wrong_answers_count'] = 0;
        }
    }


}