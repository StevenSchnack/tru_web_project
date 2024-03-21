<!doctype html>
<html>

<head>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!--Header-->

    <div id="div-home-header" class="container-fluid p-5 text-bg-dark rounded-0 rounded-bottom">
        <h2 class="text-center">Welcome to Quizzle</h2>
        <h4 class="text-center"> New quizzes weekly!</h4>
    </div>
</head>

<body>
    <div id="div-home-content" class="row justify-content-center">
        <!--Left Content-->
        <div class="col-md-2"></div>

        <div id="div-left-content" class="col-md-2 col-auto align-self-center text-center d-none d-sm-block ">

        </div>

        <!--Left Content Small-->
        <div id="div-left-content-sm" class="col-12 d-sm-none text-center ">

        </div>


        <!--Body-->
        <div id="div-body-content">
            <div id="div-start-content" class="col-md-8 col-11 pt-5 p-5 align-self-center text-center ">
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
                    <input id="button-forgot-password" type="button" class="btn btn-secondary"
                        value="Forgot Password" />
                </div>
            </div>


            <!--Login Modal-->
            <div id="modal-login" class="modal fade pt-5">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header text-bg-primary justify-content-center">
                            <h1 class="modal-title">Login</h1>
                        </div>
                        <div class="modal-body">
                            <form id="form-login" method="post" action="controller_60754.php">
                                <input type="hidden" name="page" value="page-start">
                                <input type="hidden" name="command" value="login">
                                <label class="form-label" for="login-username">Username</label>
                                <input id="login-username" name="username" type="text" class="form-control" required>
                                <label class="form-label" for="login-password">Password</label>
                                <input id="login-password" name="password " type="password" class="form-control"
                                    required>
                            </form>
                        </div>
                        <div class="modal-footer">
                            <input type="button" class="btn btn-outline-danger" data-bs-dismiss="modal" value="Cancel">
                            <input id="button-login-submit" type="submit" class="btn btn-primary" value="Confirm">
                        </div>
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
                        <div class="modal-body">
                            <form method="" action="">
                                <input type="hidden" name="page" value="page-start">
                                <input type="hidden" name="command" value="signup">
                                <label class="form-label" for="signup-username">Username</label>
                                <input id="signup-username" type="text" class="form-control" required>
                                <label class="form-label" for="signup-email">Email</label>
                                <input id="signup-email" type="email" class="form-control" required>
                                <label class="form-label" for="signup-password">Password</label>
                                <input id="signup-password" type="password" class="form-control"
                                    pattern="^[A-Z][a-zA-Z0-9_\-]$" placeholder="Enter Password" required>
                                <p>Password must start with Uppercase letter
                                <p>
                            </form>
                        </div>
                        <div class="modal-footer">
                            <input type="button" class="btn btn-outline-danger" data-bs-dismiss="modal" value="Cancel">
                            <input type="button" class="btn btn-primary" value="Confirm">
                        </div>
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
                        <div class="modal-body">
                            <form method="" action="">
                                <input type="hidden" name="page" value="page-start">
                                <input type="hidden" name="command" value="forgot-password">
                                <label class="form-label" for="forgot-password-email">Email</label>
                                <input id="forgot-password-email" type="email" class="form-control" required>
                            </form>
                        </div>
                        <div class="modal-footer">
                            <input type="button" class="btn btn-outline-danger" data-bs-dismiss="modal" value="Cancel">
                            <input type="button" class="btn btn-primary" value="Confirm">
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!--Right Content-->
        <div class="col-md-2"></div>
        <div id="div-right-content" class="text-center col-md-2 col-auto">

        </div>
    </div>
    <link rel="stylesheet" href="styles.css">
    <script>
        $(document).ready(function () {
            $('#button-login-submit').click(function (e) {
                e.preventDefault(); // Prevent the default form submission

                var formData = {
                    'page': 'page-start',
                    'command': 'login',
                    'username': $('#login-username').val(),
                    'password': $('#login-password').val()
                };

                $.ajax({
                    type: "POST",
                    url: "controller_60754.php",
                    data: formData,
                    success: function (response) {
                        console.log(response);
                        $('#div-left-content, #div-right-content').removeClass('hidden');
                        var homeHTML = $.get('main_page_home_60754.php');
                        $('#div-center-content').html(homeHTML); // Handle the response
                    },
                    error: function (xhr, status, error) {
                        console.error(error); // Handle errors
                    }
                });
            });
        })


        $('#button-login').click(function () {
            $('#modal-login').modal('show');
        });

        $('#button-signup').click(function () {
            $('#modal-signup').modal('show');
        });

        $('#button-forgot-password').click(function () {
            $('#modal-forgot-password').modal('show');
        });

        $('#button-login-submit').click()

        function loadPageStyles(pageName) {
            $.get(pageName + ".css", function (css) {
                $("#dynamic-styles").html(css);
            });
        }

        function loadPage(url, page, data, callback) {
            $.ajax({
                type: POST,
                url: url,
                data: data,
                success: function (response) {
                    console.log(response);
                    loadPageStyles(page);
                    var pageHTML = $.get(page);

                },
                error: function (xhr, status, error) {
                    console.error(error); // Handle errors
                }
            });
        }

    </script>
</body>

</html>