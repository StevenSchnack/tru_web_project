<?php

$conn = mysqli_connect('localhost', 'w3sschnackenberg', 'w3sschnackenberg136', 'C354_w3sschnackenberg');

function isValidLogin($username, $password)
{
    global $conn;
    $sql = "SELECT username FROM users WHERE ('$username' = username AND '$password' = password);";
    $result = mysqli_query($conn, $sql);
    
    if(mysqli_num_rows($result) > 0)
       return true;
    else
       return false;
}

function createNewUser($username, $password, $email) {
    global $conn;
    //$current_date = date("Ymd");
    $sql = "INSERT INTO users VALUES (NULL, '$username', '$password', '$email');";
    
    $result = mysqli_query($conn, $sql);
    
    return $result;
}

function isValidUsername($username) { 
    global $conn; 
    $sql = "SELECT username FROM users WHERE '$username' = username";
    $result = mysqli_query($conn, $sql);
    
    if (mysqli_num_rows($result))
        return true;
    else
        return false;
}
?>