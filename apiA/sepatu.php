<?php
include "../conect.php";
$conn = dbconnection();

$searchTerm = isset($_GET['search']) ? $_GET['search'] : '';

$sql = "SELECT * FROM product WHERE product_name LIKE '%$searchTerm%'";
$query = mysqli_query($conn, $sql);
$result = array();

while ($row = mysqli_fetch_array($query)) {
    array_push($result, array(
        'product_name' => $row['product_name'],
        'product_size' => $row['product_size'],
        'product_price' => $row['product_price'],
        'product_qty' => $row['product_qty'],
        'product_image' => $row['product_image'],
        'product_code' => $row['product_code'],
    ));
}

echo json_encode(
    array('result' => $result)
);
?>
