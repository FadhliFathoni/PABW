<!DOCTYPE html>
<html>

<head>
    <title>Daftar Sepatu</title>
    <!-- Memasukkan file Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>

<body>
    <div class="container">
    <div class="header" style="display: flex;justify-content: space-between">
    <h1 style="margin-right: 20px;"><a href="index.php" style="color: black;text-decoration: none;">Daftar Sepatu</a> </h1>
    <a href="cart.php"><img src="pfoto/shopping-cart.png" alt="cart" style="width: 36px;height: 36px;"></a>
    
</div>

        <table class="table">
            <thead>
                <tr>
                    <th>Nama Sepatu</th>
                    <th>Ukuran Sepatu</th>
                    <th>Harga Produk</th>
                    <th>Kuantitas</th>
                    <th>Foto Produk</th>
                    <th>Kode Produk</th>
                    <th>Total</th>
                </tr>
            </thead>
            <tbody id="data-barang">
            </tbody>
        </table>
    </div>

    

    <!-- Memasukkan file Bootstrap JavaScript dan jQuery -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

    <script>
        // Mengambil data dari API
        fetch('http://localhost/sepatu/PABW/apiB/apiCart.php')
            .then(response => response.json())
            .then(data => {
                // Menampilkan data dalam tabel
                const tableBody = document.getElementById('data-barang');
                data.data.forEach(item => {
                    const row = document.createElement('tr');
                    row.innerHTML = `
                        <td name="product_name">${item.product_name}</td>
                        <td name="product_size">${item.product_size}</td>
                        <td >${item.product_price}</td>
                        <td>${item.qty}</td>
                        <td><img src="${item.product_image}" alt="Foto" height="100"></td>
                        <td id="product_code">${item.product_code}</td>
                        <td id="product_code">${item.qty * item.product_price}</td>
                    `;
                    tableBody.appendChild(row);
                });
            })
            .catch(error => console.error(error));
    </script>
    <div class="form" style="display: flex;justify-content: end;margin-right: 50px;">
        <form action="" method="post">
            <input type="text" name="product_code" placeholder="Kode Produk">
            <button type="submit">Checkout</button>
        </form>

    </div>
</body>

</html>

<?php
require_once "../conect.php";
$con = dbconnection();

if (isset($_POST['product_code'])) {
    $product_code = $_POST['product_code'];
} else {
    return;
}

$query = "UPDATE product
JOIN cart ON product.product_code = cart.product_code
SET product.product_qty = product.product_qty - cart.qty
WHERE product.product_code = '$product_code';
";
$exe = mysqli_query($con, $query);

$query = "DELETE FROM `product` WHERE `product_code` = '$product_code' AND `product_qty` = 1";
$exe2 = mysqli_query($con, $query);

$query = "DELETE FROM `cart` WHERE `product_code` = '$product_code'";
$exe3 = mysqli_query($con, $query);

$arr = [];
if ($exe || $exe2 && $exe3) {
    $arr["success"] = "true";
} else {
    $arr["success"] = "false";
}

?>

?>
