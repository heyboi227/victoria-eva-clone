<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>AirBase</title>
</head>

<body>
    <form action="editairlinedb.php" method="POST" enctype="multipart/form-data">
        <input type="hidden" name="airline_id" value="{$airline->airline_id}" />
        IATA code: <input type="text" name="iata_code" value="{$airline->iata_code}" />
        <br />
        ICAO code:<input type="text" name="icao_code" value="{$airline->icao_code}" />
        <br />
        Airline name: <input type="text" name="name" value="{$airline->name}" />
        <br />
        Country: <select name="country">
            <option value="default">Select a country</option>
            {foreach $countries as $country}
                {if $country->country_id == $airline->country_id}
                    <option value="{$country->country_id}" selected>{$country->name}</option>
                {else}
                    <option value="{$country->country_id}">{$country->name}</option>
                {/if}
            {/foreach}
        </select>
        <br />
        Select image to update as logo: <input type="file" name="fileToUpload" id="fileToUpload">
        <hr />
        <button type="submit">Submit</button>
    </form>
    <a href="index.php">Go back</a>
</body>

</html>