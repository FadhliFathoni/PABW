
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
<!-- nambahin ini -->
<input type="text" id="searchInput" class="form-control mb-3" placeholder="Cari berdasarkan nama">
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

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
  $(document).ready(function() {
    // Fungsi untuk memuat data dari API
    function loadData(searchTerm = '') {
      $.getJSON('http://localhost/sepatu/PABW/apiA/sepatu.php?search=' +searchTerm, function(data) {
        // Membuang isi tabel sebelumnya
        $('#data-barang').empty();

        // Membangun tabel dengan data yang diperoleh
        $.each(data.result, function(index, item) {
          var row = $('<tr>').appendTo('#data-barang');
          $('<td>').text(item.product_name).appendTo(row);
          $('<td>').text(item.product_size).appendTo(row);
          $('<td>').text(item.product_price).appendTo(row);
          $('<td>').text(item.product_qty).appendTo(row);
          $('<td>').append($('<img>').attr('src', item.product_image).attr('alt', 'Foto').attr('height', '100')).appendTo(row);
          $('<td>').text(item.product_code).appendTo(row);
        });
      });
    }

    // Memuat data saat halaman dimuat
    loadData();

    // Meng-handle perubahan pada kolom pencarian
    $('#searchInput').on('input', function() {
      var searchTerm = $(this).val();
      loadData(searchTerm);
    });
  });
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
