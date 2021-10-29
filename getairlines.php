<?php
function getAirlines()
{
    $DB = mysqli_connect("127.0.0.1", "mjeknic", "BelgradeIsMyCapitalCity123!", "mjeknic");

    if (!$DB) {
        die("There was an error while connecting to database.");
        die(mysqli_connect_error());
    }

    if (!isset($_GET["page"])) {
        $page = 1;
    } else {
        $page = $_GET["page"];
    }

    $results_per_page = 10;
    $page_first_result = ($page - 1) * $results_per_page;

    $query = mysqli_query($DB, "SELECT * FROM airline ORDER BY icao_code ASC LIMIT " . $page_first_result . ", " . $results_per_page);

    if (!$query) {
        die(mysqli_error($DB));
    }

    $airlines = [];

    while ($airline = mysqli_fetch_object($query)) {
        $airlines[] = $airline;
    }

    return $airlines;
}

function totalPages()
{
    $DB = mysqli_connect("127.0.0.1", "mjeknic", "BelgradeIsMyCapitalCity123!", "mjeknic");

    if (!$DB) {
        die("There was an error while connecting to database.");
        die(mysqli_connect_error());
    }

    $results_per_page = 10;

    $query = "SELECT * FROM airline";
    $result = mysqli_query($DB, $query);
    $number_of_result = mysqli_num_rows($result);

    //determine the total number of pages available  
    $number_of_page = ceil($number_of_result / $results_per_page);
    return $number_of_page;
}
