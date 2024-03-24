<?php
if (!isset($_SERVER['HTTPS'])) {
    $url = 'https://' . $_SERVER['HTTP_HOST'] .
        $_SERVER['REQUEST_URI'];  // starts with /...
    header("Location: " . $url);  // Redirect - 302
    exit;                         // should be before any output
}
?>
<!doctype html>
<html>

<head>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <meta name="viewport" content="width=device-width, initial-scale=1">
</head>

<body>
    <!--Header-->
    <div id="div-home-header" class="container-fluid p-5 text-bg-dark rounded-0 rounded-bottom">
        <h2 class="text-center">Welcome to Quizzle</h2>
        <h4 class="text-center"> New quizzes weekly!</h4>
    </div>

    <div id="div-home-content" class="row justify-content-center">
        <!--Left Content-->
        <div class="col-md-2"></div>

        <div id="div-left-content" class="col-md-2 col-auto align-self-center text-center d-none d-sm-block ">

        </div>

        <!--Left Content Small-->
        <div id="div-left-content-sm" class="col-12 d-sm-none text-center">

        </div>


        <!--Body-->

        <div id="div-center-content" class="col-md-7 col-11 pt-2 p-1 align-items-center">
            <div class="row">
                <img src="">
            </div>
            <div class="row justify-content-center pt-5 d-grid">
                <input id="button-login" type="button" class="btn btn-primary btn-lg" value="Login">
            </div>
            <div class="row justify-content-center pt-3 d-grid">
                <input id="button-signup" type="button" class="btn btn-warning" value="Sign-Up" />

            </div>
            <div class="row justify-content-center pt-3 d-grid">
                <input id="button-forgot-password" type="button" class="btn btn-secondary" value="Forgot Password" />
            </div>
        </div>


        <!--Login Modal-->
        <div id="modal-login" class="modal fade pt-5">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header text-bg-primary justify-content-center">
                        <h1 class="modal-title">Login</h1>
                    </div>
                    <form id="form-login" method="post" action="controller_60754.php">
                        <div class="modal-body">
                            <input type="hidden" name="page" value="page-start">
                            <input type="hidden" name="command" value="login">
                            <label class="form-label" for="login-username">Username</label>
                            <input id="login-username" name="username" type="text" class="form-control" required>
                            <label class="form-label" for="login-password">Password</label>
                            <input id="login-password" name="password" type="password" class="form-control" required>
                        </div>
                        <div class="modal-footer">
                            <input type="button" class="btn btn-outline-danger" data-bs-dismiss="modal" value="Cancel">
                            <input id="button-login-submit" type="submit" class="btn btn-primary" value="Confirm">
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <!--Signup Modal-->
        <div id="modal-signup" class="modal fade pt-5">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header text-bg-warning justify-content-center">
                        <h1 class="modal-title">Signup</h1>
                    </div>
                    <form id="form-signup" method="post" action="controller_60754.php">
                        <div class="modal-body">
                            <input type="hidden" name="page" value="page-start">
                            <input type="hidden" name="command" value="signup">
                            <label class="form-label" for="signup-username">Username</label>
                            <input id="signup-username" name="username" type="text" class="form-control" required>
                            <label class="form-label" for="signup-email">Email</label>
                            <input id="signup-email" name="email" type="email" class="form-control" required>
                            <label class="form-label" for="signup-password">Password</label>
                            <input id="signup-password" name="password" type="password" class="form-control" pattern="^[A-Z].{5,20}$" placeholder="Enter Password" required>

                        </div>
                        <div class="modal-footer">
                            <input type="button" class="btn btn-outline-danger" data-bs-dismiss="modal" value="Cancel">
                            <input type="submit" class="btn btn-primary" value="Confirm">
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <!--Forgot Password Modal-->
        <div id="modal-forgot-password" class="modal fade pt-5">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header text-bg-secondary justify-content-center">
                        <h1 class="modal-title">Forgot Password</h1>
                    </div>
                    <form id="form-forgot-password" method="post" action="controller_60754.php">
                        <div class="modal-body">
                            <input type="hidden" name="page" value="page-start">
                            <input type="hidden" name="command" value="forgot-password">
                            <label class="form-label" for="forgot-password-email">Email</label>
                            <input id="forgot-password-email" type="email" class="form-control" required>
                        </div>
                        <div class="modal-footer">
                            <input type="button" class="btn btn-outline-danger" data-bs-dismiss="modal" value="Cancel">
                            <input type="submit" class="btn btn-primary" value="Confirm">
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <!-- Submission Modal-->
        <div id="modal-quiz-results" class="modal fade pt-5">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header text-bg-success justify-content-center">
                        <h1 class="modal-title">Results</h1>
                    </div>
                    <div class="modal-body text-center">
                        <form id="form-quiz-results" method="post" action="controller_60754.php">
                            <input type="hidden" name="page" value="page-main">
                            <input type="hidden" name="command" value="submit-quiz">
                            <p id="quiz-score" name="score" value="">Score: 0</p>
                            <p id="quiz-percent" name="percent" value="">Percent: 0%</p>
                            <p id="quiz-time-final" name="time" value="">Time: 0:00</p>
                        </form>
                    </div>
                    <div class="modal-footer">
                        <input type="button" class="btn btn-warning" value="Share">
                        <input type="button" class="btn btn-primary" data-bs-dismiss="modal" value="Continue">
                    </div>
                </div>
            </div>
        </div>

        <!--Right Content-->
        <div class="col-md-2"></div>
        <div id="div-right-content" class="text-center col-md-2 col-auto">

        </div>
    </div>
    <link href="styles.css" rel="stylesheet">
    <script>
        //Form Submissions
        $(document).ready(function() {
            $(document).on('submit', 'form', function(e) {
                e.preventDefault();

                var formData = $(this).serialize();
                var formType = $(this).attr('method');
                var formUrl = $(this).attr('action');
                var formId = $(this).attr('id');
                console.log(formData);

                $.ajax({
                    type: formType,
                    url: formUrl,
                    data: formData,
                    success: function(response) {
                        console.log(response);

                        switch (formId) {
                            case 'form-login':
                                $('#modal-login').modal('hide');
                                $.get('main_page_home_60754.php', function(homeContent) {
                                    $('#div-center-content').html(homeContent);
                                });

                                $.get('left_content.php', function(leftContent) {
                                    $('#div-left-content').html(leftContent);
                                });

                                $.get('left_content_sm.php', function(leftContentSm) {
                                    $('#div-left-content-sm').html(leftContentSm);
                                });

                                $.get('right_content.php', function(rightContent) {
                                    $('#div-right-content').html(rightContent);
                                });
                                break;
                            case 'form-signup':
                                $('#modal-signup').modal('hide');
                                alert(response.message);
                                break;

                            case 'form-forgot-password':

                                break;

                            case 'form-submit-quiz':
                                $('#right-content-answered').text('Answered: 0/10');
                                $('#quiz-score').val(response.data.score);
                                $('#quiz-percent').val(response.data.percent);
                                $('#quiz-score').text('Score: ' + response.data.score + '/10');
                                $('#quiz-percent').text('Percent: ' + response.data.percent + '%');
                                if (secondsDisplay < 10) {
                                    $('#quiz-time-final').text('Time: ' + minutes + ':' + '0' + secondsDisplay);
                                    $('#quiz-time-final').val(minutes + ':' + '0' + secondsDisplay);
                                } else {
                                    $('#quiz-time-final').text('Time: ' + minutes + ':' + secondsDisplay);
                                    $('#quiz-time-final').val(minutes + ':' + secondsDisplay);
                                }
                                $('#button-submit-quiz').prop('disabled', true);
                                $('#button-save-quiz').prop('disabled', true);
                                var radioButtons = $('.form-check input[type="radio"]');
                                $(radioButtons).each(function() {
                                    if ($(this).attr('value') == '1') {
                                        $(this).parent().css('background-color', 'lightgreen');
                                    } else if($(this).attr('value') == '0' && $(this).is(':checked')) {
                                        $(this).parent().css('background-color', 'rgb(255, 72, 72)');
                                    }
                                })
                                break;

                            case 'form-quiz-results':

                        }
                    },
                    error: function(xhr, status, error) {
                        console.error(error);
                    }
                });
            });
            //Left Nav Buttons
            $(document).on('click', '#nav-buttons-left button', function() {
                var buttonId = $(this).attr('id');
                switch (buttonId) {
                    case 'nav-button-home':
                        $.get('main_page_home_60754.php', function(homeContent) {
                            $('#div-center-content').html(homeContent);
                        });

                        break;

                    case 'nav-button-profile':
                        $.get('main_page_profile_60754.php', function(profileContent) {
                            $('#div-center-content').html(profileContent);
                        });
                        break;

                    case 'nav-button-summary':
                        $.get('main_page_summary_60754.php', function(summaryContent) {
                            $('#div-center-content').html(summaryContent);
                        });
                        break;

                    case 'nav-button-leaderboard':
                        $.get('main_page_leaderboard_60754.php', function(leaderboardContent) {
                            $('#div-center-content').html(leaderboardContent);
                        });
                        break;

                    case 'nav-button-logout':


                }
                $('#nav-buttons-left button').removeClass('active');
                $(this).addClass('active');
            });

            //Right Nav Buttons
            $(document).on('click', '#nav-buttons-right button', function() {
                var buttonId = $(this).attr('id');
                switch (buttonId) {
                    case 'button-submit-quiz':
                        $('#form-submit-quiz').submit();
                        $('#modal-quiz-results').modal('show');

                        break;

                    case 'button-save-quiz':


                }
            });

            //Start Quiz
            $(document).on('click', '#button-start-quiz', function() {
                $.ajax({
                    url: 'controller_60754.php',
                    type: 'POST',
                    data: {
                        page: "page-main",
                        command: "start-quiz"
                    },
                    success: function(obj) {
                        console.log(obj);
                        if (obj.success) {
                            $.get('main_page_quiz_60754.php', function(quizContent) {
                                $('#div-center-content').html(quizContent);
                                $('#div-content-quiz').html(obj.data);
                                $('#button-submit-quiz').prop('disabled', false);
                                $('#button-save-quiz').prop('disabled', false);
                            });

                            console.log(obj.data);
                        } else {
                            console.error('Failed to load quiz:', obj.message);
                        }
                    },
                    error: function(xhr, status, error) {
                        console.error('Error:', error);
                    }
                });
            })

            //Quiz Radio Button Count
            $(document).on('click', '.form-check input[type="radio"]', function() {
                var answered = 0;
                var radioButtons = $('.form-check input[type="radio"]');
                $(radioButtons).each(function() {
                    if ($(this).is(':checked')) {
                        answered++;
                    }
                })
                console.log(answered);
                $('#right-content-answered').text('Answered: ' + answered + '/10');
            })

        });




        $('#button-login').click(function() {
            $('#modal-login').modal('show');
        });

        $('#button-signup').click(function() {
            $('#modal-signup').modal('show');
        });

        $('#button-forgot-password').click(function() {
            $('#modal-forgot-password').modal('show');
        });



        function loadPage(page, data, callback) {
            $.ajax({
                type: POST,
                url: 'controller_60754.php',
                data: data,
                success: function(response) {
                    console.log(response);
                    var pageHTML = $.get(page);

                },
                error: function(xhr, status, error) {
                    console.error(error);
                }
            });
        }

        //Quiz Timer
        let timer;
        let seconds = 0;
        let minutes = 0;
        let secondsDisplay = 0;

        function startTimer() {
            clearInterval(timer);
            timer = setInterval(function() {
                seconds++;
                minutes = Math.floor(seconds / 60);
                secondsDisplay = seconds % 60;
                if (secondsDisplay < 10) {
                    $('#right-content-timer').text('Time: ' + minutes + ':' + '0' + secondsDisplay);
                } else {
                    $('#right-content-timer').text('Time: ' + minutes + ':' + secondsDisplay);
                }
            }, 1000);
        }

        function stopTimer() {
            clearInterval(timer);
        }

        function resetTimer() {
            clearInterval(timer);
            seconds = 0;
            $('#right-content-timer').text('Time: ' + '0:00');
        }
    </script>
</body>

</html>