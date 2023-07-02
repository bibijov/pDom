<?php
$connect = mysqli_connect('127.0.0.1:3307', 'root', '', 'pdom');
$output = '';
$order = $_POST["order"];
if ($order == 'desc') {
    $order = 'asc';
} else {
    $order = 'desc';
}
$query = "SELECT * FROM korisnici ORDER BY " . $_POST["column_name"] . " " . $_POST["order"] . "";
$result = mysqli_query($connect, $query);
$output .= '
<table class="table table-bordered">
<tr>
    <th><a href="#" id="ime" data-order="' . $order . '" class="column_sort">Ime</a></th>
    <th><a href="#" id="prezime" data-order="' . $order . '" class="column_sort">Prezime</a></th>
    <th><a href="#" id="email" data-order="' . $order . '" class="column_sort">Email</a></th>
</tr>
';
while ($row = mysqli_fetch_array($result)) {
    $output .= '
    <tr>
    <td>' . $row["ime"] . '</td>
    <td>' . $row["prezime"] . '</td>
    <td>' . $row["email"] . '</td>
    </tr>
    ';
}
$output .= '</table>';
echo $output;
?>
