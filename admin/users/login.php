<?php
session_start();
include '../../connect.php';
?>

<!DOCTYPE html>
<html lang="en" class="h-100">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <title>BrightChamps - Login</title>
    <!-- Favicon icon -->
    <link rel="icon" type="image/png" sizes="16x16" href="../assets/images/favicon.png">
    <link href="../assets/css/style.css" rel="stylesheet">
    
</head>

<body class="h-100">
    <div class="authincation h-100">
        <div class="container h-100">
            <div class="row justify-content-center h-100 align-items-center">
                <div class="col-md-10">
                    <?php
                        if(isset($_REQUEST['submit'])){
                            extract($_REQUEST);
                            if($obj->userLogin($username, $password)){
                    ?>
                                <div class="alert alert-success solid alert-dismissible fade show">
                                    <button type="button" class="close h-100" data-dismiss="alert" aria-label="Close"><span><i class="mdi mdi-close"></i></span>
                                    </button>
                                    <strong>Login</strong> Successfully!
                                </div>
                    <?php
                                header('location: ../index.php');
                            }
                            else{
                    ?>
                                <div class="alert alert-danger solid alert-dismissible fade show">
                                    <button type="button" class="close h-100" data-dismiss="alert" aria-label="Close"><span><i class="mdi mdi-close"></i></span>
                                    </button>
                                    <strong>Cannot Login!</strong> Invalid username or password.
                                </div>
                    <?php
                            }
                        }
                    ?>
                    <div class="authincation-content">
                        <div class="row no-gutters">
                            <div class="col-xl-6">
                                <div class="welcome-content">
                                    <div class="brand-logo">
                                        <a href="index.html">BrightChamps</a>
                                    </div>
                                    <h3 class="welcome-title">Welcome to BrightChamps</h3>
                                    <div class="intro-social">
                                        <ul>
                                            <li><a href="https://www.facebook.com/BrightChamps-101266664954230/"><i class="fa fa-facebook"></i></a></li>
                                            <li><a href="https://www.instagram.com/brightchamps/"><i class="fa fa-instagram"></i></a></li>
                                            <li><a href="https://in.linkedin.com/company/brightchamps"><i class="fa fa-linkedin"></i></a></li>
                                            <li><a href="https://www.youtube.com/channel/UC_Afe_rMGoK5Bs4nSt8QIzQ"><i class="fa fa-youtube"></i></a></li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-6">
                                <div class="auth-form">
                                    <h4 class="text-center mb-4">Sign in your account</h4>
                                    <form action="login.php" method="post">
                                        <div class="form-group">
                                            <label><strong>Username</strong></label>
                                            <input type="text" class="form-control" name="username" placeholder="Username" required>
                                        </div>
                                        <div class="form-group">
                                            <label><strong>Password</strong></label>
                                            <input type="password" class="form-control" name="password" placeholder="* * * * * * * *" required>
                                        </div>
                                        <div class="form-row d-flex justify-content-between mt-4 mb-2">
                                            <div class="form-group">
                                                <div class="form-check ml-2">
                                                    <input class="form-check-input" type="checkbox" id="basic_checkbox_1">
                                                    <label class="form-check-label" for="basic_checkbox_1">Remember me</label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="text-center">
                                            <input type="submit" name="submit" class="btn btn-primary btn-block" value="Sign In">
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

</html>