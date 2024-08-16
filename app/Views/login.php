<!DOCTYPE html>
<html lang="en">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!-- Meta, title, CSS, favicons, etc. -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" href="/images/admin2.png" type="image/ico" />

    <title>Seventhsoft | Magang </title>

    <!-- Bootstrap -->
    <link href="../vendors/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="../vendors/font-awesome/css/font-awesome.min.css" rel="stylesheet">
    <!-- NProgress -->
    <link href="../vendors/nprogress/nprogress.css" rel="stylesheet">
    <!-- Animate.css -->
    <link href="../vendors/animate.css/animate.min.css" rel="stylesheet">

    <!-- Custom Theme Style -->
    <link href="../build/css/custom.min.css" rel="stylesheet">
</head>

<body class="login">
    <div>
        <a class="hiddenanchor" id="signup"></a>
        <a class="hiddenanchor" id="signin"></a>

        <div class="login_wrapper">
            <div class="animate form login_form">
                <section class="login_content">
                    <form action="/login/auth" method="post">
                        <h1>Login Form</h1>
                        <div>
                            <input type="email" name="email" class="form-control" id="InputForEmail" aria-describedby="emailHelp" placeholder="Email address" required="" autofocus="">
                        </div>
                        <div>
                            <input type="password" name="password" class="form-control" id="InputForPassword" placeholder="Password" required="">
                        </div>
                        <?php if (!empty(session()->getFlashdata('error'))) : ?> <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                <?php echo session()->getFlashdata('error'); ?>
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                </button>
                            </div>
                        <?php endif; ?>
                        <div>
                            <button type="submit" class="btn btn-outline-secondary">Log In</button>
                            <!-- <button type="submit" class="btn btn-default" size="12px">Login</button> -->
                            <!-- <button type="button" class="btn btn-primary">Primary</button> -->
                            <!-- <a class="btn btn-default submit" href="index.html">Log in</a> -->
                            <!-- <button class="btn btn-default" href="home">Lost your password</button> -->
                            <a class="reset_pass" href="#">Lost your password?</a>
                        </div>

                        <div class="clearfix"></div>
                        <br />

                        <div>
                            <h1><i class="fa fa-paw"></i> Sevensoft Komputindo</h1>
                            <p>©2021 Sevensoft | Magang</p>
                        </div>
            </div>
            </form>
            </section>
        </div>

        <div id="register" class="animate form registration_form">
            <section class="login_content">
                <form action="/register/save" method="store">
                    <h1>Create Account</h1>
                    <div>
                        <input type="text" class="form-control" placeholder="Username" required="" />
                    </div>
                    <div>
                        <input type="email" class="form-control" placeholder="Email" required="" />
                    </div>
                    <div>
                        <input type="password" class="form-control" placeholder="Password" required="" />
                    </div>
                    <div>
                        <a class="btn btn-default submit" href="index.html">Submit</a>
                    </div>

                    <div class="clearfix"></div>

                    <div class="separator">
                        <p class="change_link">Already a member ?
                            <a href="#signin" class="to_register"> Log in </a>
                        </p>

                        <div class="clearfix"></div>
                        <br />

                        <div>
                            <h1><i class="fa fa-paw"></i> Sevensoft Komputindo</h1>
                            <p>©2021 Sevensoft | Magang</p>
                        </div>
                    </div>
                </form>
            </section>
        </div>
    </div>
    </div>
</body>

</html>