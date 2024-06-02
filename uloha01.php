<!DOCTYPE html>
<html lang="sk">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Úloha 01</title>
    <link rel="stylesheet" href="uloha01.css">
</head>
<body>

<?php
require_once "connect.php";
?>

<h1>požiadavka 01</h1>
<?php
$sql = "
    SELECT * FROM customers;
    SELECT * FROM orders;
    SELECT * FROM suppliers;
";
$conn->multi_query($sql);
do {
    if ($result = $conn->store_result()) {
        echo "<table>";
        while ($fieldinfo = $result->fetch_field()) {
            echo "<th>{$fieldinfo->name}</th>";
        }
        while ($row = $result->fetch_assoc()) {
            echo "<tr>";
            foreach ($row as $cell) {
                echo "<td>{$cell}</td>";
            }
            echo "</tr>";
        }
        echo "</table><br>";
        $result->free();
    }
} while ($conn->next_result());
?>

<h1>požiadavka 02</h1>
<?php
$sql = "SELECT * FROM customers ORDER BY country, company_name";
$result = $conn->query($sql);
echo "<table>";
while ($fieldinfo = $result->fetch_field()) {
    echo "<th>{$fieldinfo->name}</th>";
}
while ($row = $result->fetch_assoc()) {
    echo "<tr>";
    foreach ($row as $cell) {
        echo "<td>{$cell}</td>";
    }
    echo "</tr>";
}
echo "</table>";
?>

<h1>požiadavka 03</h1>
<?php
$sql = "SELECT * FROM orders ORDER BY order_date";
$result = $conn->query($sql);
echo "<table>";
while ($fieldinfo = $result->fetch_field()) {
    echo "<th>{$fieldinfo->name}</th>";
}
while ($row = $result->fetch_assoc()) {
    echo "<tr>";
    foreach ($row as $cell) {
        echo "<td>{$cell}</td>";
    }
    echo "</tr>";
}
echo "</table>";
?>

<h1>požiadavka 04</h1>
<?php
$sql = "SELECT COUNT(*) as order_count FROM orders WHERE YEAR(order_date) = 1997";
$result = $conn->query($sql);
$row = $result->fetch_assoc();
echo "<p>Počet objednávok uskutočnených v roku 1997: {$row['order_count']}</p>";
?>

<h1>požiadavka 05</h1>
<?php
$sql = "SELECT contact_name FROM customers WHERE contact_title = 'Manager' ORDER BY contact_name";
$result = $conn->query($sql);
echo "<table>";
echo "<tr><th>Contact Name</th></tr>";
while ($row = $result->fetch_assoc()) {
    echo "<tr><td>{$row['contact_name']}</td></tr>";
}
echo "</table>";
?>

<h1>požiadavka 06</h1>
<?php
$sql = "SELECT * FROM orders WHERE order_date = '1997-05-19'";
$result = $conn->query($sql);
echo "<table>";
while ($fieldinfo = $result->fetch_field()) {
    echo "<th>{$fieldinfo->name}</th>";
}
while ($row = $result->fetch_assoc()) {
    echo "<tr>";
    foreach ($row as $cell) {
        echo "<td>{$cell}</td>";
    }
    echo "</tr>";
}
echo "</table>";
?>

<?php $conn->close(); ?>

</body>
</html>

