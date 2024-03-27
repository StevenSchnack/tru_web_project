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

function deleteUser($username, $password)
{
    
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
            $userTimeSql = "UPDATE user_times SET quiz_$quizId = '$time' WHERE user_id = $userId";
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
    global $conn;
    $sql = "SELECT email, reminder FROM users WHERE username = '$username'";
    $result = mysqli_query($conn, $sql);

    if(mysqli_num_rows($result) > 0)
    {
        return mysqli_fetch_assoc($result);
    }
}

function toggleReminder($username, $reminder)
{
    global $conn;
    $sql = "UPDATE users SET reminder = $reminder WHERE username = '$username'";
    if(mysqli_query($conn, $sql))
        return true;
    else
        return false;
}

function changePassword($username, $newPassword)
{
    global $conn;
    $sql = "UPDATE users SET password = '$newPassword' WHERE username = '$username'";
    if(mysqli_query($conn, $sql))
    {
        return true;
    }
    else
    {
        echo 'Could not change password';
        return false;
    }
}

function changeEmail($username, $newEmail)
{
    global $conn;
    $sql = "UPDATE users SET email = '$newEmail' WHERE username = '$username'";
    if(mysqli_query($conn, $sql))
    {
        return true;
    }
    else
    {
        echo 'Could not change email';
        return false;
    }
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

function getLeaderboardData()
{
    $userScores = [];
    $userTimes = [];
    $quizId = checkQuizDate();
    global $conn;
    $usersScoreSql = "SELECT user_id, quiz_$quizId FROM user_scores ORDER BY quiz_$quizId DESC";
    $usersScoreResult = mysqli_query($conn, $usersScoreSql);
    while($row = mysqli_fetch_assoc($usersScoreResult)){
        $userScores[] = $row;
    }

    $usersTimeSql = "SELECT user_id, quiz_$quizId FROM user_times ORDER BY quiz_$quizId DESC";
    $usersTimeResult = mysqli_query($conn, $usersTimeSql);
    while($row = mysqli_fetch_assoc($usersTimeResult)){
        $userTimes[] = $row;
    }

    //Converting user_id to username and quiz_# to score/time
    $newUserScores = [];
    $newUserTimes = [];
    foreach($userScores as $userScore){
        $userId = $userScore['user_id'];
        $score = $userScore['quiz_' . $quizId];
        $sql = "SELECT username FROM users WHERE user_id = $userId";
        $result = mysqli_query($conn, $sql);
        if($row = mysqli_fetch_assoc($result)){
            $username = $row['username'];
            $newUserScores[] = ['username' => $username, 'score' => $score];
        }
    }
    foreach($userTimes as $userTime){
        $userId = $userTime['user_id'];
        $time = $userTime['quiz_' . $quizId];
        $sql = "SELECT username FROM users WHERE user_id = $userId";
        $result = mysqli_query($conn, $sql);
        if($row = mysqli_fetch_assoc($result)){
            $username = $row['username'];
            $newUserTimes[] = ['username' => $username, 'time' => $time];
        }
    }

    $leaderboardData = [
        'scores' => $newUserScores,
        'times' => $newUserTimes,
    ];

    return $leaderboardData;
}

function buildLeaderboard($leaderboardData)
{
    $lbHTML = '';
    $lbCount = 1;
    
    //Card
    $lbHTML .= '<div class="card">';
    //Header
    $lbHTML .= '<div class="card-header text-bg-primary">';
    $lbHTML .= '<h3 class="text-center"> Quiz #' . checkQuizDate() . '</h3>';
    $lbHTML .= '</div>';
    //Body
    $lbHTML .= '<div class="card-body">';
    //Table
    $lbHTML .= '<table class="table table-striped">';
    $lbHTML .= '<thead>';
    $lbHTML .= '<tr>';
    $lbHTML .= '<th scope="col">#</th>';
    $lbHTML .= '<th scope="col">Username</th>';
    $lbHTML .= '<th scope="col">Score</th>';
    $lbHTML .= '<th scope="col">Time</th>';
    $lbHTML .= '</tr>';
    $lbHTML .= '</thead>';
    $lbHTML .= '<tbody class="leaderboard-placement">';
    foreach ($leaderboardData['scores'] as $userScores) {
        $userName = $userScores['username'];
        $userScore = $userScores['score'];
        $userTime = null;
        //Get user times
        foreach($leaderboardData['times'] as $userTimes){
            if($userTimes['username'] == $userName){
                $userTime = $userTimes['time'];
                break;
            }
        }
        $lbHTML .= '<tr>';
        $lbHTML .= '<th scope="row">' . $lbCount . '</th>';
        $lbHTML .= '<td>' . $userName . '</td>';
        $lbHTML .= '<td>' . $userScore . '</td>';
        $lbHTML .= '<td>' . $userTime . '</td>';
        $lbHTML .= '</tr>';
        $lbCount++;
    }
    $lbHTML .= '</tbody></table></div></div>';                    

    return $lbHTML;
}
