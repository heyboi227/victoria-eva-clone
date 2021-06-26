<!DOCTYPE html>
<html lang="en">

<head>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>AirBase</title>
    <link rel="stylesheet" type="text/css" href="main.css" />
</head>

<body>
    {if $airlines == null}
        <p>There are no airlines currently in database.</p>
    {else}
        <table>
            <h4>Search filters</h4>
            <form action="filterairlines.php" method="POST">
                <select name="selectCountry" onchange="this.form.submit();">
                    <option value="default">Select a country</option>
                    {foreach $countryNames as $countryName}
                        <option value="{$countryName->country_id}">{$countryName->name} ({$countryName->count})</option>
                    {/foreach}
                </select>
            </form>
            <tr align="center">
                <th>IATA Code</th>
                <th>ICAO Code</th>
                <th>Name</th>
                <th>Country</th>
                <th>Logo</th>
                <th colspan="3">Actions</th>
            </tr>
            {foreach $airlines as $airline}
                <tr align="center">
                    <td>{$airline->iata_code}</td>
                    <td>{$airline->icao_code}</td>
                    <td>{$airline->name}</td>
                    {foreach $countries as $country}
                        {if $country->country_id == $airline->country_id}
                            <td>{$country->name}</td>
                        {/if}
                    {/foreach}
                    {if $airline->image_path != null}
                        <td><img src="{$airline->image_path}" alt="{$airline->name} logo" width="100px" /></td>
                    {else}
                        <td></td>
                    {/if}
                    <td><a href="fleet.php?airline_id={$airline->airline_id}">Fleet</a></td>
                    <td><a href="editairline.php?airline_id={$airline->airline_id}">Edit</a></td>
                    <td><a href="#"
                            onclick="if (confirm('Are you sure you want to delete {$airline->name}?')) window.location.replace('deleteairline.php?airline_id={$airline->airline_id}');">Delete</a>
                    </td>
                </tr>
            {/foreach}
        </table>
    {/if}
    {if $page > 1}
        <a href="index.php?page={$page - 1}">Previous page</a>
    {/if}
    {if $page < $totalPages}
        <a href="index.php?page={$page + 1}">Next page</a>
    {/if}
    <a href="addairline.php">Add new airline</a>
</body>

</html>