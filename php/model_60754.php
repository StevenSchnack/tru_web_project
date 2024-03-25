<?php

$conn = mysqli_connect('localhost', 'w3sschnackenberg', 'w3sschnackenberg136', 'C354_w3sschnackenberg');

function isValidLogin($username, $password)
{
    global $conn;
    $sql = "SELECT username FROM users WHERE ('$username' = username AND '$password' = password);";
    $result = mysqli_query($conn, $sql);

    if (mysqli_num_rows($result) > 0)
        return true;
    else
        return false;

    //mysqli_close($conn);
}

function createNewUser($username, $password, $email)
{
    global $conn;
    $sql = "INSERT INTO users (username, password, email) VALUES ('$username', '$password', '$email');";
    $result = mysqli_query($conn, $sql);
    
    return $result;
    mysqli_close($conn);
}

function isValidUsername($username)
{
    global $conn;
    $sql = "SELECT username FROM users WHERE '$username' = username";
    $result = mysqli_query($conn, $sql);

    if (!mysqli_num_rows($result))
        return true;
    else
        return false;

    mysqli_close($conn);
}

function forgotPassword($resetCode, $email)
{
    global $conn;
    $sql = "UPDATE users SET reset_code = $resetCode WHERE '$email' = email";
    mysqli_query($conn, $sql);

    if(mysqli_affected_rows($conn) > 0)
        return true;
    else
        return false;

    mysqli_close($conn);
}

function resetPassword($resetCode, $newPassword)
{
    global $conn;
    $sql = "UPDATE users SET password = '$newPassword', reset_code = NULL WHERE reset_code = $resetCode";
    mysqli_query($conn, $sql);

    if(mysqli_affected_rows($conn) > 0)
        return true;
    else
        return false;

    mysqli_close($conn);
}

function getQuizData()
{
    global $conn;
    $quizId = 1;
    $questions = [];
    
    $quizSQL = "SELECT * FROM quizzes WHERE quiz_id = $quizId";
    $quizResult = mysqli_query($conn, $quizSQL);
    $quiz = mysqli_fetch_assoc($quizResult);

    $questionsSQL = "SELECT * FROM questions WHERE quiz_id = $quizId";
    $questionsResult = mysqli_query($conn, $questionsSQL);
    while ($row = mysqli_fetch_assoc($questionsResult))
        $questions[] = $row;

    $quizData = [
        'quiz_id' => $quiz['quiz_id'],
        'name' => $quiz['name'],
        'subject' => $quiz['subject'],
        'questions' => []
    ];

    foreach ($questions as $question) {
        $options = [];
        $questionId = $question['question_id'];
        $optionsSQL = "SELECT option_id, description, is_correct FROM options WHERE quiz_id = $quizId AND question_id = $questionId";
        $optionsResult = mysqli_query($conn, $optionsSQL);
        while ($row = mysqli_fetch_assoc($optionsResult))
            $options[] = $row;

        $quizData['questions'][] = [
            'question_id' => $question['question_id'],
            'description' => $question['description'],
            'options' => $options
        ];
    }
    mysqli_close($conn);
    return $quizData;
    
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
            $quizHTML .= '<input id="quiz-option-' . $option['option_id'] . '" class="form-check-input" type="radio" name="quiz-question-' . $questionCount . '" value="' . $option['is_correct'] . '">';
            $quizHTML .= '<label class="form-check-label" for="quiz-option-' . $option['option_id'] . '">' . $option['description'] . '</label>';
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
