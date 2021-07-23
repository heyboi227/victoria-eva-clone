<!DOCTYPE html>
<html lang="en">

<head>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>AirBase</title>
    <link rel="stylesheet" type="text/css" href="main.css" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous" />

</head>

<body>
    {if $airlines == null}
        <p>There are no airlines currently in database.</p>
    {else}
        <div class="container-fluid">
            <h4>Search filters</h4>
            <form action="filterairlines.php" method="POST">
                <select name="selectCountry" onchange="this.form.submit();">
                    <option value="default">Select a country</option>
                    {foreach $countryNames as $countryName}
                        <option value="{$countryName->country_id}">{$countryName->name} ({$countryName->count})</option>
                    {/foreach}
                </select>
            </form>
            <table class="table table-sm">
                <thead>
                    <tr>
                        <th scope="col">IATA Code</th>
                        <th scope="col">ICAO Code</th>
                        <th scope="col">Name</th>
                        <th scope="col">Country</th>
                        <th scope="col">Logo</th>
                        <th scope="col" colspan="3">Actions</th>
                    </tr>
                </thead>
                {foreach $airlines as $airline}
                    <tr>
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
        </div>
    {/if}
    {if isset($page)}
        {if $page > 1}
            <a href="index.php?page={$page - 1}">Previous page</a>
        {/if}
        {if $page < $totalPages}
            <a href="index.php?page={$page + 1}">Next page</a>
        {/if}
    {/if}
    <a href="addairline.php">Add new airline</a>
</body>

</html>