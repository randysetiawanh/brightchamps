<?php
include '../../connect.php';

?>

<!DOCTYPE html>
<html lang="en" class="h-100">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <title>Corbin - Simple Admin Dashboard</title>
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
                        if($obj->userReg($name,$username,$password,$email)){
                ?>
                            <div class="alert alert-success solid alert-dismissible fade show">
                                <button type="button" class="close h-100" data-dismiss="alert" aria-label="Close"><span><i class="mdi mdi-close"></i></span>
                                </button>
                                Register <strong><?php echo $username; ?></strong> is Successfully! Please Login <a href="login.php">here.</a>
                            </div>
                <?php
                        
                        }
                        else{
                ?>
                            <div class="alert alert-danger solid alert-dismissible fade show">
                                    <button type="button" class="close h-100" data-dismiss="alert" aria-label="Close"><span><i class="mdi mdi-close"></i></span>
                                    </button>
                                    <strong>Cannot Register!</strong> Your username or email already registered, please try again.
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
                                        <a href="index.html">Corbin</a>
                                    </div>
                                    <h3 class="welcome-title">Welcome to Corbin</h3>
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
                                    <h4 class="text-center mb-4">Sign up your account</h4>
                                    <form action="register.php" method="post">
                                        <div class="form-group">
                                            <label><strong>Full Name</strong></label>
                                            <input type="text" name="name" class="form-control" placeholder="Name" required>
                                        </div>
                                        <div class="form-group">
                                            <label><strong>Username</strong></label>
                                            <input type="text" name="username" class="form-control" placeholder="Username" required>
                                        </div>
                                        <div class="form-group">
                                            <label><strong>Email</strong></label>
                                            <input type="email" name="email" class="form-control" placeholder="hello@example.com" required>
                                        </div>
                                        <div class="form-group">
                                            <label><strong>Password</strong></label>
                                            <input type="password" name="password" class="form-control" placeholder="* * * * * * * *" required>
                                        </div>
                                        <div class="text-center mt-4">
                                            <input type="submit" name="submit" class="btn btn-primary btn-block" value="Sign Up">
                                        </div>
                                    </form>
                                    <div class="new-account mt-3">
                                        <p>Already have an account? <a class="text-primary" href="login.php">Sign in</a></p>
                                    </div>    
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