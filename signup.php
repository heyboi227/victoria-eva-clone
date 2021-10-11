<?php
// File requirements for establishing database connection, and getting data for the navigation dropdown menus
require("../php/cfg/dbconfig.php");
require("get-database.php");

$username = $email = $firstName = $lastName = $password = $confirmPassword = "";
$usernameErr = $emailErr = $firstNameErr = $lastNameErr = $passwordErr = $confirmPasswordErr = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (empty(trim($_POST["username"]))) {
        $usernameErr = "Please enter an username.";
        // Regex for specific username naming conventions
    } else if (!preg_match('/^[a-zA-Z0-9_]+$/', trim($_POST["username"]))) {
        $usernameErr = "Username can only contain letters, numbers, and underscores.";
    } else {
        $sql = "SELECT `user_id` FROM user WHERE username = ?";

        if ($stmt = mysqli_prepare($DB, $sql)) {
            mysqli_stmt_bind_param($stmt, "s", $param_username);
            $param_username = trim($_POST["username"]);

            if (mysqli_stmt_execute($stmt)) {
                mysqli_stmt_store_result($stmt);
                if (mysqli_stmt_num_rows($stmt) == 1) {
                    $usernameErr = "The username you provided is already taken.";
                } else {
                    $username = trim($_POST["username"]);
                }
            } else {
                echo "Sorry! Something went wrong during the process. Please try again later.";
            }
            mysqli_stmt_close($stmt);
        }
    }

    if (empty(trim($_POST["email"]))) {
        $emailErr = "Please enter an email.";
        // Regex for specific email naming conventions
    } else if (!preg_match('/^[a-zA-Z0-9_]+@[a-z]+\.[a-z]+$/', trim($_POST["email"]))) {
        $emailErr = "Please enter a valid email.";
    } else {
        $sql = "SELECT `user_id` FROM user WHERE email_address = ?";

        if ($stmt = mysqli_prepare($DB, $sql)) {
            mysqli_stmt_bind_param($stmt, "s", $param_email);
            $param_email = trim($_POST["email"]);

            if (mysqli_stmt_execute($stmt)) {
                mysqli_stmt_store_result($stmt);
                if (mysqli_stmt_num_rows($stmt) == 1) {
                    $emailErr = "The email you provided is already taken.";
                } else {
                    $email = trim($_POST["email"]);
                }
            } else {
                echo "Sorry! Something went wrong during the process. Please try again later.";
            }
            mysqli_stmt_close($stmt);
        }
    }

    if (empty(trim($_POST["first_name"]))) {
        $firstNameErr = "Please enter your first name.";
    } else {
        $firstName = trim($_POST["first_name"]);
    }

    if (empty(trim($_POST["last_name"]))) {
        $lastNameErr = "Please enter your last name.";
    } else {
        $lastName = trim($_POST["last_name"]);
    }

    if (empty(trim($_POST["password"]))) {
        $passwordErr = "Please enter a password.";
    } else if (strlen(trim($_POST["password"])) < 6) {
        $passwordErr = "Password must contain at least 6 characters.";
    } else {
        $password = trim($_POST["password"]);
    }
    if (empty(trim($_POST["confirm_password"]))) {
        $confirmPasswordErr = "Please confirm the password.";
    } else {
        $confirmPassword = trim($_POST["confirm_password"]);
        if (empty($passwordErr) && ($password != $confirmPassword)) {
            $confirmPasswordErr = "The passwords do not match.";
        }
    }

    if (empty($usernameErr) && empty($emailErr) && empty($firstNameErr) && empty($lastNameErr) && empty($passwordErr) && empty($confirmPasswordErr)) {
        $sql = "INSERT INTO user (username, email_address, first_name, last_name, password_hash) VALUES (?, ?, ?, ?, ?)";
        if ($stmt = mysqli_prepare($DB, $sql)) {
            mysqli_stmt_bind_param($stmt, "sssss", $param_username, $param_email, $param_first_name, $param_last_name, $param_password);
            $param_username = $username;
            $param_email = $email;
            $param_first_name = $firstName;
            $param_last_name = $lastName;
            $param_password = password_hash($password, PASSWORD_DEFAULT);

            if (mysqli_stmt_execute($stmt)) {
                header("Location: login.php");
            } else {
                echo "Sorry! Something went wrong during the process. Please try again later.";
            }
            mysqli_stmt_close($stmt);
        }
    }

    mysqli_close($DB);
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Raleway:wght@200;300;400;500;600;700&display=swap" rel="stylesheet">
    <script src="https://kit.fontawesome.com/2c77941c98.js" crossorigin="anonymous"></script>
    <script src="splide-3.0.9/dist/js/splide.min.js"></script>
    <link rel="stylesheet" href="splide-3.0.9/dist/css/splide.min.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
    <script src="parallax.js-1.5.0/parallax.min.js"></script>
    <link rel="stylesheet" type="text/css" href="main.css" />
    <title>Victoria Eva - Sign Up</title>
</head>

<body>
    <div id="container">
        <div id="header-container">
            <div id="header">
                <div id="logo-wrapper">
                    <div id="logo">
                        <a href="index.php"><img src="img/logo_gold.png" alt="Site logo" /></a>
                        <p>Your beauty is our duty</p>
                    </div>
                    <div id="btn-mobile">
                        <i class="fas fa-bars fa-lg"></i>
                    </div>
                </div>
                <div id="nav-auth">
                    <div id="nav">
                        <ul class="nav-links">
                            <li><a href="index.php">Home</a></li>
                            <li><a href="#">About us</a></li>
                            <li class="services-link link-dropdown-menu"><a href="#" id="services-list-drop">Services <i class="fas fa-chevron-down fa-xs"></i></a>
                                <div id="services-list-container">
                                    <ul class="services-list">
                                        <?php foreach ($services as $service) {
                                            echo "<li>" . $service->name . "</li>";
                                        } ?>
                                    </ul>
                                </div>
                            </li>
                            <li class="brands-link link-dropdown-menu"><a href="#" id="brands-list-drop">Brands <i class="fas fa-chevron-down fa-xs"></i></a>
                                <div id="brands-list-container">
                                    <ul class="brands-list">
                                        <?php foreach ($brands as $brand) {
                                            echo "<li>" . $brand->name . "</li>";
                                        } ?>
                                    </ul>
                                </div>
                            </li>
                            <li><a href="#">Online shop</a></li>
                            <li><a href="#">Blog</a></li>
                            <li><a href="#">Contact</a></li>
                        </ul>
                    </div>
                    <div id="auth">
                        <?php if (!(isset($_SESSION['loggedin']) && $_SESSION["loggedin"] === true)) {
                            echo "<a href='signup.php' class='signup-btn active'>Sign Up</a>";
                            echo "<a href='login.php'>Login</a>";
                            echo "<div id='edit-profile'>";
                            echo "<ul class='edit-profile-list'>";
                            echo "<li><a href='edit-profile.php'>Edit profile</a></li>";
                            echo "<li><a href='logout.php'>Logout</a></li>";
                            echo "</ul>";
                            echo "</div>";
                        } else {
                            echo "<div class='profile-info'>";
                            echo "<i class='fas fa-user fa-2x'></i>" . "<p>" . $_SESSION['username'] . "</p>";
                            echo "<div id='edit-profile'>";
                            echo "<ul class='edit-profile-list'>";
                            echo "<li><a href='edit-profile.php'>Edit profile</a></li>";
                            echo "<li><a href='logout.php'>Logout</a></li>";
                            echo "</ul>";
                            echo "</div>";
                            echo "</div>";
                        } ?>
                    </div>
                </div>
            </div>
        </div>
        <div class="clearfix"></div>
        <div class="signup-area">
            <div class="form-area">
                <h1>Sign Up</h1>
                <p>Please fill this form to create an account.</p>
                <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                    <div class="form-inputs">
                        <div class="form-group">
                            <label>Username</label>
                            <div class="form-input">
                                <input type="text" name="username" class="form-control <?php echo (!empty($usernameErr)) ? 'is-invalid' : ''; ?>" value="<?php echo $username; ?>">
                                <span class="alert"><?php echo $usernameErr; ?></span>
                            </div>
                        </div>
                        <div class="form-group">
                            <label>Email</label>
                            <div class="form-input">
                                <input type="text" name="email" class="form-control <?php echo (!empty($emailErr)) ? 'is-invalid' : ''; ?>" value="<?php echo $email; ?>">
                                <span class="alert"><?php echo $emailErr; ?></span>
                            </div>
                        </div>
                        <div class="form-group">
                            <label>First Name</label>
                            <div class="form-input">
                                <input type="text" name="first_name" class="form-control <?php echo (!empty($firstNameErr)) ? 'is-invalid' : ''; ?>" value="<?php echo $firstName; ?>">
                                <span class="alert"><?php echo $firstNameErr; ?></span>
                            </div>
                        </div>
                        <div class="form-group">
                            <label>Last Name</label>
                            <div class="form-input">
                                <input type="text" name="last_name" class="form-control <?php echo (!empty($lastNameErr)) ? 'is-invalid' : ''; ?>" value="<?php echo $lastName; ?>">
                                <span class="alert"><?php echo $lastNameErr; ?></span>
                            </div>
                        </div>
                        <div class="form-group">
                            <label>Password</label>
                            <div class="form-input">
                                <input type="password" name="password" class="form-control <?php echo (!empty($passwordErr)) ? 'is-invalid' : ''; ?>" value="<?php echo $password; ?>">
                                <span class="alert"><?php echo $passwordErr; ?></span>
                            </div>
                        </div>
                        <div class="form-group">
                            <label>Confirm Password</label>
                            <div class="form-input">
                                <input type="password" name="confirm_password" class="form-control <?php echo (!empty($confirmPasswordErr)) ? 'is-invalid' : ''; ?>" value="<?php echo $confirmPassword; ?>">
                                <span class="alert"><?php echo $confirmPasswordErr; ?></span>
                            </div>
                        </div>
                    </div>
                    <div class="form-group-btn">
                        <input type="submit" class="btn signup-btn" value="Submit">
                        <input type="reset" class="btn reset-btn" value="Reset">
                    </div>
                    <p>Already have an account? <a href="login.php" class="auth-link">Login here.</a></p>
                </form>
            </div>
        </div>
        <div class="clearfix"></div>
        <div id="footer">
            <div id="footer-logo">
                <img src="img/logo_gold.png" alt="Site logo" />
                <h4>Your beauty is our duty</h4>
            </div>
            <div id="contact-info">
                <p><i class="fas fa-map-marker-alt"></i> 99 A. N. N, Limassol, Cyprus&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<i class="fas fa-phone-alt"></i><a href="#">+357 11 22 33 44</a></p>
                <p><i class="fas fa-phone-alt"></i><a href="#">+357 44 33 22 11</a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<i class="fas fa-envelope"></i><a href="#">dummy@victoriaeva.com</a></p>
            </div>
            <div id="social-media">
                <a href="#" class="facebook"><i class="fab fa-facebook-f fa-lg"></i></a>
                <a href="#" class="instagram"><i class="fab fa-instagram fa-lg"></i></a>
            </div>
            <div class="border-down-footer"></div>
            <div id="copyright">
                <p>Created by <a href="https://bluebookstudio.com/" class="blue-book">Blue Book</a>. Cloned by Milos Jeknic. All rights reserved.</p>
            </div>
        </div>
        <div class="clearfix"></div>
    </div>
</body>
<script src="main.js"></script>
<script>
    $(".scroll").click(function() {
        $('html, body').animate({
            scrollTop: $("#services").offset().top - 80
        });
    });
</script>

</html>