<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>AirBase</title>
</head>

<body>
    <form action="addaircraftdb.php" method="POST">
        <input type="hidden" name="airline_id" value="{$airlineID}" />
        Registration: <input type="text" name="registration" />
        <br />
        Manufacturer:<input type="text" name="manufacturer" />
        <br />
        Aircraft type: <input type="text" name="type" />
        <br />
        MSN (construction number): <input type="text" name="msn" />
        <br />
        Name: <input type="text" name="name" />
        <hr />
        <button type="submit">Submit</button>
    </form>
    <a href="fleet.php?airline_id={$airlineID}">Go back</a>
</body>

</html>