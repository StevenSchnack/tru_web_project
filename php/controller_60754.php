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
            $password = hash('sha256', $_POST['password']);

            if (isValidLogin($username, $password)) {
                session_start();
                $_SESSION['signedin'] = 'YES';
                $_SESSION['username'] = $username;
                header('Content-Type: application/json');
                echo json_encode(['success' => true, 'message' => 'Login successful.']);
            } else {
                header('Content-Type: application/json');
                echo json_encode(['success' => false, 'message' => 'Credentials are incorrect.']);
            }
            exit();

        case 'signup':
            $username = $_POST['username'];
            $password = hash('sha256', $_POST['password']);
            $email = $_POST['email'];

            if (isValidUsername($username)) {
                if (createNewUser($username, $password, $email)) {
                    header('Content-Type: application/json');
                    echo json_encode(['success' => true, 'message' => 'Account creation was succesful!']);
                } else {
                    header('Content-Type: application/json');
                    echo json_encode(['success' => false, 'message' => 'Something went wrong. Please try again']);
                }
            } else {
                header('Content-Type: application/json');
                echo json_encode(['success' => false, 'message' => 'Username is already taken. Please choose another one', 'data' => $username]);
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
    include('start_page_60754.php');
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

        case 'submit-quiz':
            $correct = 0;
            for ($i = 1; $i <= 10; $i++) {
                $thing = 'quiz-question-' . $i;
                if (isset($_POST[$thing])) {
                    $answer = $_POST[$thing];
                    if ($answer == 1) { 
                        $correct++;
                    }
                }
            }
            $percent = ($correct / 10) * 100;
            header('Content-Type: application/json');
            echo json_encode(['success' => true, 'message' => 'Results are in', 'data' => ['score' => $correct, 'percent' => $percent]]);
            break;
    }
}



