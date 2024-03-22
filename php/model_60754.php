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
}

function createNewUser($username, $password, $email)
{
    global $conn;
    //$current_date = date("Ymd");
    $sql = "INSERT INTO users VALUES (NULL, '$username', '$password', '$email');";

    $result = mysqli_query($conn, $sql);

    return $result;
}

function isValidUsername($username)
{
    global $conn;
    $sql = "SELECT username FROM users WHERE '$username' = username";
    $result = mysqli_query($conn, $sql);

    if (mysqli_num_rows($result))
        return true;
    else
        return false;
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
