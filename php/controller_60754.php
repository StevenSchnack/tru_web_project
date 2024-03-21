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
            }
            else
            {
                echo json_encode(['success' => false, 'message' => 'Credentials are incorrect.']);
            }
            exit();
    }
}


// <?php
// // If Page == empty
// if (empty($_POST['page'])) {
//     include('start_page_60754.php');
//     exit();
// }

// require('model_60754.php');

// // If Login/Signup/Reset Password
// if ($_POST['page'] == 'page-start') {
//     switch ($_POST['command']) {
//         case 'login':
//             $username = $_POST['username'];
//             $password = $_POST['password'];
//             if (isValidLogin($username, $password)) {
//                 session_start();
//                 $_SESSION['signedin'] = 'YES';
//                 $_SESSION['username'] = $username;

//                 // Load the required HTML content
//                 $bodyContent = file_get_contents('main_page_home_60754.php');
//                 $leftContent = file_get_contents('left_content.html');
//                 $leftContentSm = file_get_contents('left_content_sm.html');
//                 $rightContent = file_get_contents('right_content.html');

//                 echo json_encode([
//                     'success' => true,
//                     'message' => 'Login successful.',
//                     'bodyContent' => $bodyContent,
//                     'leftContent' => $leftContent,
//                     'leftContentSm' => $leftContentSm,
//                     'rightContent' => $rightContent
//                 ]);
//             } else {
//                 echo json_encode(['success' => false, 'message' => 'Credentials are incorrect.']);
//             }
//             exit();
//         // Add other cases for signup, forgot password, etc.
//     }
// }
// ?>
?>