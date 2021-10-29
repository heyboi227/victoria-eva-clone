<?php
$DB = mysqli_connect("127.0.0.1", "mjeknic", "BelgradeIsMyCapitalCity123!", "mjeknic");

if (!$DB) {
    die("There was an error while connecting to database.");
    die(mysqli_connect_error());
}

$airlineID = (int) $_POST['airline_id'];
$iataCode = mysqli_real_escape_string($DB, $_POST['iata_code']);
$icaoCode = mysqli_real_escape_string($DB, $_POST['icao_code']);
$name = mysqli_real_escape_string($DB, $_POST['name']);
$countryID = mysqli_real_escape_string($DB, $_POST['country']);

$target_dir = "uploads/";
$temp = explode(".", basename($_FILES["fileToUpload"]["name"]));
$newFileName = $icaoCode . '.' . end($temp);
$target_file = $target_dir . $newFileName;
$uploadOk = 1;
$imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

// Check if image file is a actual image or fake image
if (isset($_POST["submit"])) {
    $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
    if ($check !== false) {
        echo "File is an image - " . $check["mime"] . ".";
        $uploadOk = 1;
    } else {
        echo "File is not an image.";
        $uploadOk = 0;
    }
}

// Check if file already exists
if (file_exists($target_file)) {
    echo "Sorry, file already exists.";
    $uploadOk = 0;
}

// Check file size
if ($_FILES["fileToUpload"]["size"] > 500000) {
    echo "Sorry, your file is too large.";
    $uploadOk = 0;
}

// Allow certain file formats
if (
    $imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
    && $imageFileType != "gif"
) {
    echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
    $uploadOk = 0;
}

// Check if $uploadOk is set to 0 by an error
if ($uploadOk == 0) {
    echo "Sorry, your file was not uploaded.";
    // if everything is ok, try to upload file
} else {
    if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
        echo "The file " . htmlspecialchars(basename($_FILES["fileToUpload"]["name"])) . " has been uploaded.";
    } else {
        echo "Sorry, there was an error uploading your file.";
    }
}

$query = mysqli_query($DB, "UPDATE airline SET iata_code = '$iataCode', icao_code = '$icaoCode', `name` = '$name', country_id = '$countryID', image_path = '$target_file' WHERE airline_id = $airlineID");

if (!$query) {
    die(mysqli_error($DB));
}

die(header("Location: index.php"));
