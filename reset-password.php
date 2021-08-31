<?php
session_start();

if (!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true) {
    header("location: login.php");
    exit;
}

$DB = mysqli_connect("127.0.0.1", "mjeknic", "Ackostar1999!", "mjeknic");

if (!$DB) {
    die("There was an error while connecting to database.");
    die(mysqli_connect_error());
}

$newPassword = $confirmPassword = "";
$newPasswordErr = $confirmPasswordErr = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    if (empty(trim($_POST["new_password"]))) {
        $newPasswordErr = "Please enter the new password.";
    } else if (strlen(trim($_POST["new_password"])) < 6) {
        $newPasswordErr = "Password must contain at least 6 characters.";
    } else {
        $newPassword = trim($_POST["new_password"]);
    }

    if (empty(trim($_POST["confirm_password"]))) {
        $confirmPasswordErr = "Please confirm the password.";
    } else {
        $confirmPassword = trim($_POST["confirm_password"]);
        if (empty($newPasswordErr) && $newPassword != $confirmPassword) {
            $confirmPasswordErr = "The passwords do not match.";
        }
    }

    if (empty($newPasswordErr) && empty($confirmPasswordErr)) {
        $sql = "UPDATE user SET password_hash = ? WHERE `user_id` = ?";

        if ($stmt = mysqli_prepare($DB, $sql)) {
            mysqli_stmt_bind_param($stmt, "si", $param_password_hash, $param_user_id);
            $param_password_hash = password_hash($newPassword, PASSWORD_DEFAULT);
            $param_user_id = $_SESSION["userid"];

            if (mysqli_stmt_execute($stmt)) {
                session_destroy();
                header("location: login.php");
                exit;
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
    <title>Reset Password</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        body {
            font: 14px sans-serif;
        }
    </style>
</head>

<body>
    <div class="d-flex flex-column justify-content-center align-items-center">
        <h2>Reset Password</h2>
        <p>Please fill out this form to reset your password.</p>
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
            <div class="form-group">
                <label>New Password</label>
                <input type="password" name="new_password" class="form-control <?php echo (!empty($newPasswordErr)) ? 'is-invalid' : ''; ?>" value="<?php echo $newPassword; ?>">
                <span class="invalid-feedback"><?php echo $newPasswordErr; ?></span>
            </div>
            <div class="form-group">
                <label>Confirm Password</label>
                <input type="password" name="confirm_password" class="form-control <?php echo (!empty($confirmPasswordErr)) ? 'is-invalid' : ''; ?>">
                <span class="invalid-feedback"><?php echo $confirmPasswordErr; ?></span>
            </div>
            <div class="form-group">
                <input type="submit" class="btn btn-primary" value="Submit">
                <a class="btn btn-link ml-2" href="index.php">Cancel</a>
            </div>
        </form>
    </div>
</body>

</html>