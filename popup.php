<!-- POPUP PROMO -->
<div id="promoModal" class="promo-modal">
  <div class="promo-content">
    <span id="closePromo" class="promo-close">&times;</span>
    <img src="asset/Promo1.png" class="promo-img" alt="Promo Geprek">
    <h2>🔥 Promo Geprek Hari Ini 🔥</h2>
    <p>Beli 2 Ayam Geprek Sambal Hijau GRATIS Es Teh!</p>
    <p>Buruan Order Sekarang!!</p>
  </div>
</div>

<!-- POPUP GALERI + NAVIGASI -->
<div id="imgPopup" class="img-popup">
  <span class="close-popup">&times;</span>

  <span class="prev-img">&#10094;</span>
  <img id="popupImg" class="popup-content">
  <span class="next-img">&#10095;</span>
</div>

<!-- POPUP DETAIL MENU -->
<div id="menuPopup" class="menu-popup">
  <div class="menu-popup-content">
    <span class="close-menu-popup">&times;</span>

    <img id="popupMenuImg" class="popup-menu-img">
    <h2 id="popupMenuTitle" class="popup-menu-title"></h2>
    <div class="popup-menu-price" id="popupMenuPrice"></div>
    <p id="popupMenuDesc" class="popup-menu-desc"></p>

    <form action="proses-beli.php" method="POST" style="margin-top: 15px;">
        
        <div style="margin-bottom: 10px;">
            <label style="font-weight:bold; display:block;">Nama Pemesan:</label>
            <input type="text" name="nama_pemesan" placeholder="Contoh: Budi Santoso" required 
                   style="width: 100%; padding: 10px; border: 1px solid #ccc; border-radius: 5px; box-sizing: border-box;">
        </div>

        <input type="hidden" name="nama_menu" id="inputMenuName" value="">
        <input type="hidden" name="harga_menu" id="inputMenuPrice" value="">

        <button type="submit" class="btn-order" style="width: 100%; border: none; font-size: 16px;">
            Pesan Via WhatsApp
        </button>
    </form>

  </div>
</div>

