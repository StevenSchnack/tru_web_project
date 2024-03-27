<?php

session_start();
require('model_60754.php');

//If Page == empty
if (empty($_POST['page'])) {
    include('start_page_60754.php');
    exit();
}

// if (isset($_SESSION['signedin']) && $_SESSION['signedin'] === 'YES') {
//     echo json_encode(['status' => 'logged_in']);
// } else {
//     echo json_encode(['status' => 'not_logged_in']);
// }
// exit();

//If Login/Signup/Reset Password
if ($_POST['page'] == 'page-start') {
    switch ($_POST['command']) {
        case 'login':
            $username = $_POST['username'];
            $password = hash('sha256', $_POST['password']);

            if (isValidLogin($username, $password)) {

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
            $resetCode = rand(10000, 99999);
            if (forgotPassword($resetCode, $email)) {
                header('Content-Type: application/json');
                echo json_encode(['success' => true, 'message' => 'Password reset initiated! Copy this reset code and press continue: ', 'data' => $resetCode]);
            } else {
                header('Content-Type: application/json');
                echo json_encode(['success' => false, 'message' => 'Email not found. Please try again']);
            }

            exit();

        case 'reset-password':
            $resetCode = $_POST['reset-code'];
            $newPassword = hash('sha256', $_POST['password']);
            if (resetPassword($resetCode, $newPassword)) {
                header('Content-Type: application/json');
                echo json_encode(['success' => true, 'message' => 'Password has been reset! You may now sign-in with your new password']);
            } else {
                header('Content-Type: application/json');
                echo json_encode(['success' => false, 'message' => 'Password reset failed. Please try again']);
            }
            exit();
    }
}

//CASE 3 Home Page
else if ($_POST['page'] == 'page-main') {

    if (!isset($_SESSION['signedin'])) {
        include('start_page_60754.php');
        exit();
    }

    $username = $_SESSION['username'];


    switch ($_POST['command']) {
        case 'signout':
            session_unset();
            session_destroy();
            header('Content-Type: application/json');
            echo json_encode(['success' => true, 'message' => 'You were signed out successfully!']);
            exit();

        case 'start-quiz':
            $quizData = getQuizData();
            $quizHTML = buildQuiz($quizData);
            header('Content-Type: application/json');
            echo json_encode(['success' => true, 'message' => 'Quiz was Constructed', 'data' => $quizHTML]);
            exit();

        case 'submit-quiz':
            $correct = 0;
            $time = $_POST['time'];
            $quizId = checkQuizDate();
            for ($i = 1; $i <= 10; $i++) {
                $questionAnswer = 'quiz-question-' . $i;
                if (isset($_POST[$questionAnswer])) {
                    $answer = $_POST[$questionAnswer];
                    if ($answer == 1) {
                        $correct++;
                    }
                }
            }
            $percent = ($correct / 10) * 100;
            saveUserQuizResults($quizId, $username, $correct, $time);
            header('Content-Type: application/json');
            echo json_encode(['success' => true, 'message' => 'Results are in', 'data' => ['score' => $correct, 'percent' => $percent]]);
            exit();

        case 'leaderboard-data':
            $leaderboardData = getLeaderboardData();
            $lbHTML = buildLeaderboard($leaderboardData);
            header('Content-Type: application/json');
            echo json_encode(['data' => $lbHTML]);
            exit();

        case 'summary-data':
            $summaryData = getUserSummary($username);
            header('Content-Type: application/json');
            echo json_encode($summaryData);
            exit();

        case 'profile-data':
            $profileData = getUserProfile($username);
            header('Content-Type: application/json');
            echo json_encode($profileData);
            exit();

        case 'change-profile':
            $response = [];

            // Change password
            if (!empty($_POST['new-password'])) {
                $newPassword = hash('sha256', $_POST['new-password']);
                if (changePassword($username, $newPassword)) {
                    $response['passwordChange'] = ['success' => true, 'message' => 'Password change successful'];
                } else {
                    $response['passwordChange'] = ['success' => false, 'message' => 'Password change has failed'];
                }
            }
            // Change email
            if (!empty($_POST['new-email'])) {
                $newEmail = $_POST['new-email'];
                if (changeEmail($username, $newEmail)) {
                    $response['emailChange'] = ['success' => true, 'message' => 'Email change successful'];
                } else {
                    $response['emailChange'] = ['success' => false, 'message' => 'Email change has failed'];
                }
            }
            //Set reminder
            $reminder = 0;
            if (isset($_POST['set-reminder']))
                $reminder = 1;

            if (toggleReminder($username, $reminder)) {
                $response['setReminder'] = ['success' => true, 'message' => 'Reminder change successful'];
            } else {
                $response['setReminder'] = ['success' => false, 'message' => 'Reminder change has failed'];
            }
            header('Content-Type: application/json');
            echo json_encode($response);
            exit();

        case 'delete-user':
            $password = hash('sha256', $_POST['password']);
            if (deleteUser($username, $password)) {
                header('Content-Type: application/json');
                echo json_encode(['success' => true, 'message' => 'Account succesfully deleted']);
            } else 
            {
                header('Content-Type: application/json');
                echo json_encode(['success' => false, 'message' => 'User could not be deleted']);
            }
            exit();
        
        case 'lock-quiz':
            //If user completed the quiz
            if(checkQuizCompletion($username)){
                header('Content-Type: application/json');
                echo json_encode(['success' => true]);
            } else {
                header('Content-Type: application/json');
                echo json_encode(['success' => false]);
            }
            exit();
            
            
    }
}
