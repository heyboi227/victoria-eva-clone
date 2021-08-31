<?php
$DB = mysqli_connect("127.0.0.1", "mjeknic", "Ackostar1999!", "mjeknic");

if (!$DB) {
    die("There was an error while connecting to database.");
    die(mysqli_connect_error());
}

$username = $email = $firstName = $lastName = $password = $confirmPassword = "";
$usernameErr = $emailErr = $firstNameErr = $lastNameErr = $passwordErr = $confirmPasswordErr = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (empty(trim($_POST["username"]))) {
        $usernameErr = "Please enter an username.";
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

    if (empty($usernameErr) && empty($emailErr) && empty($passwordErr) && empty($confirmPasswordErr)) {
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
    <title>Sign Up</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        body {
            font: 14px sans-serif;
        }
    </style>
</head>

<body>
    <div class="d-flex flex-column justify-content-center align-items-center">
        <h2>Sign Up</h2>
        <p>Please fill this form to create an account.</p>
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
            <div class="form-group">
                <label>Username</label>
                <input type="text" name="username" class="form-control <?php echo (!empty($usernameErr)) ? 'is-invalid' : ''; ?>" value="<?php echo $username; ?>">
                <span class="invalid-feedback"><?php echo $usernameErr; ?></span>
            </div>
            <div class="form-group">
                <label>Email</label>
                <input type="text" name="email" class="form-control <?php echo (!empty($emailErr)) ? 'is-invalid' : ''; ?>" value="<?php echo $email; ?>">
                <span class="invalid-feedback"><?php echo $emailErr; ?></span>
            </div>
            <div class="form-group">
                <label>First Name</label>
                <input type="text" name="first_name" class="form-control <?php echo (!empty($firstNameErr)) ? 'is-invalid' : ''; ?>" value="<?php echo $firstName; ?>">
                <span class="invalid-feedback"><?php echo $firstNameErr; ?></span>
            </div>
            <div class="form-group">
                <label>Last Name</label>
                <input type="text" name="last_name" class="form-control <?php echo (!empty($lastNameErr)) ? 'is-invalid' : ''; ?>" value="<?php echo $lastName; ?>">
                <span class="invalid-feedback"><?php echo $lastNameErr; ?></span>
            </div>
            <div class="form-group">
                <label>Password</label>
                <input type="password" name="password" class="form-control <?php echo (!empty($passwordErr)) ? 'is-invalid' : ''; ?>" value="<?php echo $password; ?>">
                <span class="invalid-feedback"><?php echo $passwordErr; ?></span>
            </div>
            <div class="form-group">
                <label>Confirm Password</label>
                <input type="password" name="confirm_password" class="form-control <?php echo (!empty($confirmPasswordErr)) ? 'is-invalid' : ''; ?>" value="<?php echo $confirmPassword; ?>">
                <span class="invalid-feedback"><?php echo $confirmPasswordErr; ?></span>
            </div>
            <div class="form-group">
                <input type="submit" class="btn btn-primary" value="Submit">
                <input type="reset" class="btn btn-secondary ml-2" value="Reset">
            </div>
            <p>Already have an account? <a href="login.php">Login here</a>.</p>
        </form>
    </div>
</body>

</html>