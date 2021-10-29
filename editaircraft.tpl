<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>AirBase</title>
</head>

<body>
    <form action="editaircraftdb.php" method="POST">
        <input type="hidden" name="aircraft_id" value="{$aircraft->aircraft_id}" />
        <select name="airline_id">
            {foreach $airlines as $airline}
                {if $airline->airline_id == $aircraft->airline_id}
                    <option value="{$airline->airline_id}" selected>{$airline->name}</option>
                {else}
                    <option value="{$airline->airline_id}">{$airline->name}</option>
                {/if}
            {/foreach}
        </select>
        <br />
        Registration: <input type="text" name="registration" value="{$aircraft->registration}" />
        <br />
        Manufacturer:<input type="text" name="manufacturer" value="{$aircraft->manufacturer}" />
        <br />
        Aircraft type: <input type="text" name="type" value="{$aircraft->type}" />
        <br />
        MSN (construction number): <input type="text" name="msn" value="{$aircraft->msn}" />
        <br />
        Name: <input type="text" name="name" value="{$aircraft->name}" />
        <hr />
        <button type="submit">Submit</button>
    </form>
    <a href="fleet.php?airline_id={$aircraft->airline_id}">Go back</a>
</body>

</html>