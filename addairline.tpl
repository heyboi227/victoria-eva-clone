<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>AirBase</title>
</head>

<body>
    <form action="addairlinedb.php" method="POST" enctype="multipart/form-data">
        IATA code: <input type="text" name="iata_code" />
        <br />
        ICAO code:<input type="text" name="icao_code" />
        <br />
        Airline name: <input type="text" name="name" />
        <br />
        Country: <select name="country">
            <option value="default">Select a country</option>
            {foreach $countries as $country}
                <option value="{$country->country_id}">{$country->name}</option>
            {/foreach}
        </select>
        <br />
        Select image to upload as logo: <input type="file" name="fileToUpload" id="fileToUpload">
        <hr />
        <button type="submit">Submit</button>
    </form>
    <a href="index.php">Go back</a>
</body>

</html>