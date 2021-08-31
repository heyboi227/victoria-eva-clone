<?php
$DB = mysqli_connect("127.0.0.1", "mjeknic", "Ackostar1999!", "mjeknic");

if (!$DB) {
    die("There was an error while connecting to database.");
    die(mysqli_connect_error());
}

session_start();

if (isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true) {
    header("location: index.php");
    exit;
}

$username = $password = "";
$usernameErr = $passwordErr = $loginErr = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (empty(trim($_POST["username"]))) {
        $usernameErr = "Please enter an username.";
    } else {
        $username = trim($_POST["username"]);
    }

    if (empty(trim($_POST["password"]))) {
        $passwordErr = "Please enter a password.";
    } else {
        $password = trim($_POST["password"]);
    }

    if (empty($usernameErr) && empty($passwordErr)) {
        $sql = "SELECT `user_id`, username, password_hash FROM user WHERE username = ?";

        if ($stmt = mysqli_prepare($DB, $sql)) {
            mysqli_stmt_bind_param($stmt, "s", $param_username);

            $param_username = $username;

            if (mysqli_stmt_execute($stmt)) {
                mysqli_stmt_store_result($stmt);

                if (mysqli_stmt_num_rows($stmt) == 1) {
                    mysqli_stmt_bind_result($stmt, $userId, $username, $passwordHash);

                    if (mysqli_stmt_fetch($stmt)) {
                        if (password_verify($password, $passwordHash)) {
                            session_start();

                            $_SESSION["loggedin"] = true;
                            $_SESSION["userid"] = $userId;
                            $_SESSION["username"] = $username;

                            header("Location: index.php");
                        } else {
                            $loginErr = "Invalid username or password.";
                        }
                    }
                } else {
                    $loginErr = "Invalid username or password.";
                }
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
    <title>Login</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        body {
            font: 14px sans-serif;
        }
    </style>
</head>

<body>
    <div class="d-flex flex-column justify-content-center align-items-center">
        <h2>Login</h2>
        <p>Please fill in your credentials to login.</p>

        <?php
        if (!empty($login_err)) {
            echo '<div class="alert alert-danger">' . $login_err . '</div>';
        }
        ?>

        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
            <div class="form-group">
                <label>Username</label>
                <input type="text" name="username" class="form-control <?php echo (!empty($usernameErr)) ? 'is-invalid' : ''; ?>" value="<?php echo $username; ?>">
                <span class="invalid-feedback"><?php echo $usernameErr; ?></span>
            </div>
            <div class="form-group">
                <label>Password</label>
                <input type="password" name="password" class="form-control <?php echo (!empty($passwordErr)) ? 'is-invalid' : ''; ?>">
                <span class="invalid-feedback"><?php echo $passwordErr; ?></span>
            </div>
            <div class="form-group">
                <input type="submit" class="btn btn-primary" value="Login">
            </div>
            <p>Don't have an account? <a href="signup.php">Sign up now</a>.</p>
        </form>
    </div>
</body>

</html>