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
    $sql = "INSERT INTO users (username, password, email) VALUES ('$username', '$password', '$email');";
    $result = mysqli_query($conn, $sql);

    $scoreSql = "INSERT INTO user_scores (user_id) SELECT user_id FROM users WHERE username = '$username'";
    if(!mysqli_query($conn, $scoreSql)){
        return false;
    }

    $timeSql = "INSERT INTO user_times (user_id) SELECT user_id FROM users WHERE username = '$username'";
    if(!mysqli_query($conn, $timeSql)){
        return false;
    }
    return $result;
    
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

    
}

function saveUserQuizResults($quizId, $username, $score, $time)
{
    global $conn;
    $userIdSql = "SELECT user_id FROM users WHERE username = '$username'";
    $userIdResult = mysqli_query($conn, $userIdSql);

    if(mysqli_num_rows($userIdResult) > 0){
        $row = mysqli_fetch_assoc($userIdResult);
        $userId = $row['user_id'];

        $userScoreExistSql = "SELECT user_id FROM user_scores WHERE user_id = $userId";
        if(mysqli_query($conn, $userScoreExistSql))
        {
            $userScoreSql = "UPDATE user_scores SET quiz_$quizId = $score WHERE user_id = $userId";
            if(!mysqli_query($conn, $userScoreSql))
                echo "Could not update user scores";
        }
        else
        {
            echo "User does not exist in the scores table";
        }
        $userTimeExistSql = "SELECT user_id FROM user_times WHERE user_id = $userId";
        if(mysqli_query($conn, $userTimeExistSql)){
            $userTimeSql = "UPDATE user_times SET quiz_$quizId = '$time' WHERE user_id = $userId"; //Something is causing problems here
            if(!mysqli_query($conn, $userTimeSql))
                    echo "Could not update user times";
        }
        else
        {
            echo "User does not exist in the times table";
        }  
    }
    else
    {
        echo "User does not exist in users table";
    }
    
}

function getUserSummary($username)
{
    global $conn;
    $sqlScores = "SELECT quiz_1, quiz_2, quiz_3, quiz_4, quiz_5 FROM user_scores WHERE user_id IN 
    (SELECT user_id FROM users WHERE username = '$username')";
    $sqlTimes = "SELECT quiz_1, quiz_2, quiz_3, quiz_4, quiz_5 FROM user_times WHERE user_id IN 
    (SELECT user_id FROM users WHERE username = '$username')";

    $scoreResult = mysqli_query($conn, $sqlScores);
    $timeResult = mysqli_query($conn, $sqlTimes);

    if(mysqli_num_rows($scoreResult) == 0){
        return null;
    }
    if(mysqli_num_rows($timeResult) == 0){
        return null;
    }
   

    $scores = mysqli_fetch_assoc($scoreResult);
    $times = mysqli_fetch_assoc($timeResult);
    
    $scoreCount = 0;
    $timeCount = 0;
    $totalScore = 0;
    $totalTime = 0;
    foreach($scores as $score){
        if($score != NULL){
           $totalScore += $score;
           $scoreCount++; 
        }
    }
    foreach($times as $time){
        if($time != NULL){
           $totalTime += $time;
           $timeCount++; 
        }
    } 
    $averageScore = $scoreCount > 0 ? $totalScore / $scoreCount : 0;
    $averageTime = $timeCount > 0 ? $totalTime / $timeCount : 0;
    $summary = [
        'scores' => $scores,
        'times' => $times,
        'averageScore' => $averageScore,
        'averageTime' => $averageTime,
    ];
    return $summary;
}

function getUserProfile($username)
{

}

function changePassword($username, $newPassword)
{

}

function changeEmail($username, $email)
{

}

function checkQuizDate()
{
    global $conn;
    $sql = "SELECT * FROM quiz_updates";
    $result = mysqli_query($conn, $sql);

    $quizDate = mysqli_fetch_assoc($result);
    $quizId = $quizDate['quiz_id'];

    $lastUpdated = new DateTime($quizDate['last_updated']);
    $currentDate = new DateTime();
    $interval = $lastUpdated->diff($currentDate);

    if($interval->days >= 7){
        $newQuizId = $quizId + 1;
        $updateSql = "UPDATE quiz_updates SET quiz_id = $newQuizId AND last_updated = CURRENT_DATE WHERE quiz_id = $quizId";
        if(mysqli_query($conn, $updateSql))
            return $newQuizId;

    }
    
    return $quizId;       
}


function getQuizData()
{
    global $conn;
    $quizId = checkQuizDate();
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
