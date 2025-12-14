<section id="menu" class="menu">
  <h2>Daftar Menu</h2>
  <button id="promoBtn" class="btn-primary">Lagi Promo nih!!</button>

  <div class="menu-list">

    <?php
    include "config.php";

    $result = mysqli_query($conn, "SELECT * FROM menu");

    if (mysqli_num_rows($result) > 0) {
      while ($row = mysqli_fetch_assoc($result)) {

        // Simpan gambar BLOB menjadi file sementara
        $imagePath = 'asset/menu_' . $row['ID_Menu'] . '.jpg';
        file_put_contents($imagePath, $row['Image']);

        echo '
          <div class="menu-item"
                data-title="'. htmlspecialchars($row['Nama_Menu'], ENT_QUOTES) .'"
                data-price="Rp '. number_format($row["Harga"], 0, ',', '.') .'"
                data-desc="'. htmlspecialchars($row['Deskripsi'], ENT_QUOTES) .'"
                data-image="'. $imagePath .'">

            <img src="'. $imagePath .'" alt="'. $row["Nama_Menu"] .'">
            <h3>'. $row["Nama_Menu"] .'</h3>
            <p><strong>Rp '. number_format($row["Harga"], 0, ',', '.') .'</strong></p>
          </div>
        ';
      }
    } else {
      echo "<p>Belum ada menu.</p>";
    }
    ?>

  </div>
</section>
