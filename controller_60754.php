<?php

//If Page == empty
if(empty($_POST['page']))
{
    include('start_page_60754.php');
    exit();
}

require('model_60754.php');

//If Login/Signup/Reset Password
if($_POST['page'] == 'page-start')
{
    switch($_POST['command'])
    {
        case 'login':
            $username = $_POST['username'];
            $password = $_POST['password'];

            if(isValidLogin($username, $password))
            {
                session_start();
                $_SESSION['signedin'] = 'YES';
                $_SESSION['username'] = $username;
                echo json_encode(['success' => true, 'message' => 'Login successful.']);
                //include('main_page_home_60754.php');
            }
            else
            {
                echo json_encode(['success' => false, 'message' => 'Credentials are incorrect.']);
                //include('start_page_60754.html');
                //include('main_page_home_60754.php');

            }
            exit();
    }
}

?>