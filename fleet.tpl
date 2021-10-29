<!DOCTYPE html>
<html lang="en">

<head>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>AirBase</title>
    <link rel="stylesheet" type="text/css" href="main.css" />
</head>

<body>
    {if $fleet == null}
        <p>Airline currently has no aircraft in its fleet.</p>
    {else}
        <table>
            <h4>Search filters</h4>
            <form action="filterfleet.php?airline_id={$airlineID}" method="POST">
                <select name="selectManufacturer">
                    <option value="default">Select a manufacturer</option>
                    {foreach $manufacturers as $manufacturer}
                        <option value="{$manufacturer->manufacturer}">{$manufacturer->manufacturer} ({$manufacturer->count})
                        </option>
                    {/foreach}
                </select>
                <select name="selectType">
                    <option value="default">Select aircraft type</option>
                    {foreach $types as $type}
                        <option value="{$type->type}">{$type->type} ({$type->count})</option>
                    {/foreach}
                </select>
                <button type="submit">Search</button>
            </form>
            <tr align="center">
                <th>Registration</th>
                <th>Manufacturer</th>
                <th>Type</th>
                <th>MSN</th>
                <th>Name</th>
                <th colspan="3">Actions</th>
            </tr>

            {foreach $fleet as $aircraft}
                <tr align="center">
                    <td>{$aircraft->registration}</td>
                    <td>{$aircraft->manufacturer}</td>
                    <td>{$aircraft->type}</td>
                    <td>{$aircraft->msn}</td>
                    <td>{$aircraft->name}</td>
                    <td><a href="editaircraft.php?aircraft_id={$aircraft->aircraft_id}">Edit</a></td>
                    <td><a href="#"
                            onclick="if (confirm('Are you sure you want to delete {$aircraft->registration}?')) window.location.replace('deleteaircraft.php?aircraft_id={$aircraft->aircraft_id}&airline_id={$airlineID}');">Delete</a>
                    </td>
                    <td><a href="https://www.jetphotos.com/registration/{$aircraft->registration}" target="_blank">Photos</a>
                    </td>
                </tr>
            {/foreach}
        </table>
    {/if}
    <a href="addaircraft.php?airline_id={$airlineID}">Add new aircraft</a>
    <a href="index.php">Go back</a>
</body>

</html>