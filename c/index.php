
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
    <h1 style="margin-right: 20px;">Daftar Sepatu</h1>
    <a href="cart.php"><img src="pfoto/shopping-cart.png" alt="cart" style="width: 36px;height: 36px;"></a>
    
</div>    

        <table class="table">
            <thead>
                <tr>
                    <th>Nama Sepatu</th>
                    <th>Ukuran Sepatu</th>
                    <th>Harga Produk</th>
                    <th>Kuantitas</th>
                    <th>Foto</th>
                    <th>Kode Produk</th>    
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
        fetch('http://localhost/sepatu/PABW/apiA/apiSepatu.php')
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
                        <td>${item.product_qty}</td>
                        <td><img src="${item.product_image}" alt="Foto" height="100"></td>
                        <td id="product_code">${item.product_code}</td>
                    `;
                    tableBody.appendChild(row);
                });
            })
            .catch(error => console.error(error));
    </script>
    <div class="form" style="width: 300px;display: flex;justify-content: center;margin-bottom: 50px;margin-left: 50px;">
    <form action="http://localhost/sepatu/PABW/apiB/apiCart.php" method="post" style="display: flex;flex-direction: column;">
        <input type="text" name="product_code" placeholder="Kode Sepatu">
        <input type="text" name="qty" placeholder="Kuantitas">
        <button type="submit">Submit</button>
    </form>        
</div>
    </div>
</body>    

</html>

?>
