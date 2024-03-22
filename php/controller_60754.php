<?php

//If Page == empty
if (empty($_POST['page'])) {
    include('start_page_60754.php');
    exit();
}

require('model_60754.php');

//If Login/Signup/Reset Password
if ($_POST['page'] == 'page-start') {
    switch ($_POST['command']) {
        case 'login':
            $username = $_POST['username'];
            $password = $_POST['password'];

            if (isValidLogin($username, $password)) {
                session_start();
                $_SESSION['signedin'] = 'YES';
                $_SESSION['username'] = $username;
                echo json_encode(['success' => true, 'message' => 'Login successful.']);
            } else {
                echo json_encode(['success' => false, 'message' => 'Credentials are incorrect.']);
            }
            exit();

        case 'signup':
            $username = $_POST['username'];
            $password = $_POST['password'];
            $email = $_POST['email'];

            if (isValidUsername($username)) {
                if (createNewUser($username, $password, $email)) {
                    echo json_encode(['success' => true, 'message' => 'Account creation was succesful!']);
                } else {
                    json_encode(['success' => false, 'message' => 'Something went wrong. Please try again']);
                }
            } else {
                json_encode(['success' => false, 'message' => 'Username is already taken. Please choose another one']);
            }
            exit();

        case 'forgot-password':
            $email = $_POST['email'];
            break;
    }
}

//CASE 3 Home Page
session_start();

if (!isset($_SESSION['signedin'])) {
}

$username = $_SESSION['username'];
if ($_POST['page'] == 'page-main') {
    switch ($_POST['command']) {
        case 'signout':
            session_unset();
            session_destroy();
            break;

        case 'start-quiz':
            $quizData = getQuizData();
            $quizHTML = buildQuiz($quizData);
            header('Content-Type: application/json');
            echo json_encode(['success' => true, 'message' => 'Quiz was Constructed', 'data' => $quizHTML]);
            break;
    }
}


function buildQuiz($quizData)
{
    $quizHTML = '';
    $questionCount = 1;
    foreach ($quizData['questions'] as $question) {
        $optionCount = 1;
        $quizHTML .= '<div class="question-content card">';
        //Header
        $quizHTML .= '<div class="card-header text-bg-info">';
        $quizHTML .= '<h4> Question ' . $questionCount . '</h4>';
        $quizHTML .= '</div>';
        //Title
        $quizHTML .= '<div class="card-body">';
        $quizHTML .= '<div class="card-title">';
        $quizHTML .= '<p>' . $question['description'] . '</p>';
        $quizHTML .= '</div>';
        //Body
        $quizHTML .= '<div class="card-text input-group">';
        $quizHTML .= '<div class="row p-1 pt-2">';
        foreach ($question['options'] as $option) {
            $quizHTML .= '<div class="form-check">';
            $quizHTML .= '<input id="quiz-option-' . $optionCount . '" class="form-check-input" type="radio" name="quiz-question-' . $questionCount . '" value="' . $option['option_id'] . '">';
            $quizHTML .= '<label class="form-check-label" for="quiz-option-' . $optionCount . '">' . $option['description'] . '</label>';
            $quizHTML .= '</div>';
            $optionCount++;
        }
        $quizHTML .= '</div>';
        $quizHTML .= '</div>';
        $quizHTML .= '</div>';
        $quizHTML .= '</div>';
        $questionCount++;
    }
    return $quizHTML;
}
