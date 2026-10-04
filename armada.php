<?php 
session_start(); 
include "config/koneksi.php"; 
 
mysqli_query($conn, "UPDATE armada 
    SET status_ketersediaan = 'tersedia' 
    WHERE stock > 0 
"); 
 
mysqli_query($conn, "UPDATE armada 
    SET status_ketersediaan = 'tidak tersedia' 
    WHERE stock <= 0 
"); 
 
$query = mysqli_query($conn, "SELECT * FROM armada ORDER BY id_armada ASC"); 
?> 
 
<!DOCTYPE html> 
<html lang="id"> 
<head> 
    <meta charset="UTF-8"> 
    <meta name="viewport" content="width=device-width, initial-scale=1.0"> 
 
    <title>Daftar Armada</title> 
 
    <style> 
 
        * { 
            margin: 0; 
            padding: 0; 
            box-sizing: border-box; 
        } 
 
        body { 
            font-family: Arial, Helvetica, sans-serif; 
 
            background: linear-gradient( 
                120deg, 
                #383232, 
                #3e3b3b, 
                #0b080b, 
                #4f4c4c 
            ); 
 
            background-size: 400% 400%; 
            animation: backgroundMove 12s ease infinite; 
 
            min-height: 100vh; 
            color: #222; 
        } 
 
 
        @keyframes backgroundMove { 
 
            0% { 
                background-position: 0% 50%; 
            } 
 
            50% { 
                background-position: 100% 50%; 
            } 
 
            100% { 
                background-position: 0% 50%; 
            } 
 
        } 
 
 
        /* ========================= 
           NAVBAR 
        ========================= */ 
 
        .navbar { 
            width: 100%; 
 
            padding: 18px 5%; 
 
            display: flex; 
 
            justify-content: space-between; 
 
            align-items: center; 
 
            background: rgba(20, 18, 20, 0.88); 
 
            backdrop-filter: blur(12px); 
 
            border-bottom: 
                1px solid rgba(255, 255, 255, 0.08); 
 
            box-shadow: 
                0 5px 25px rgba(0, 0, 0, 0.25); 
 
            position: sticky; 
 
            top: 0; 
 
            z-index: 100; 
        } 
 
 
        .logo { 
            font-size: 22px; 
 
            font-weight: bold; 
 
            color: white; 
 
            letter-spacing: 1px; 
        } 
 
 
        .menu { 
            display: flex; 
 
            align-items: center; 
 
            gap: 8px; 
        } 
 
 
        .menu a { 
            text-decoration: none; 
 
            color: #eeeeee; 
 
            padding: 9px 15px; 
 
            border-radius: 8px; 
 
            font-size: 14px; 
 
            transition: 
                background 0.3s ease, 
                color 0.3s ease, 
                transform 0.3s ease; 
        } 
 
 
        .menu a:hover { 
            background: 
                rgba(255, 255, 255, 0.10); 
 
            color: white; 
 
            transform: 
                translateY(-2px); 
        } 
 
 
        /* ========================= 
           CONTAINER 
        ========================= */ 
 
        .container { 
            width: 84%; 
 
            max-width: 1250px; 
 
            margin: 45px auto; 
        } 
 
 
        /* ========================= 
           JUDUL 
        ========================= */ 
 
        .container h2 { 
            color: white; 
 
            text-align: center; 
 
            font-size: 30px; 
 
            margin-bottom: 8px; 
 
            letter-spacing: 0.5px; 
        } 
 
 
        .container h2::after { 
            content: ""; 
 
            display: block; 
 
            width: 70px; 
 
            height: 4px; 
 
            margin: 12px auto 0; 
 
            border-radius: 10px; 
 
            background: 
                linear-gradient( 
                    90deg, 
                    #ffffff, 
                    #7165ff 
                ); 
        } 
 
 
        /* ========================= 
           SEARCH BAR 
        ========================= */ 
 
        .search-container { 
            width: 100%; 
 
            display: flex; 
 
            flex-direction: column; 
 
            align-items: center; 
 
            margin-top: 28px; 
 
            margin-bottom: 30px; 
        } 
 
 
        .search-box { 
            position: relative; 
 
            width: 100%; 
 
            max-width: 600px; 
        } 
 
 
        .search-box input { 
            width: 100%; 
 
            height: 48px; 
 
            padding: 
                0 48px 0 48px; 
 
            border: 
                1px solid rgba(255, 255, 255, 0.2); 
 
            border-radius: 14px; 
 
            outline: none; 
 
            font-size: 15px; 
 
            background: 
                rgba(255, 255, 255, 0.95); 
 
            color: #222; 
 
            box-shadow: 
                0 8px 25px rgba(0, 0, 0, 0.18); 
 
            transition: 
                border 0.3s ease, 
                box-shadow 0.3s ease; 
        } 
 
 
        .search-box input:focus { 
            border-color: #7165ff; 
 
            box-shadow: 
                0 0 0 3px 
                rgba(113, 101, 255, 0.20), 
 
                0 8px 25px 
                rgba(0, 0, 0, 0.18); 
        } 
 
 
        .search-box input::placeholder { 
            color: #888; 
        } 
 
 
        .search-icon { 
            position: absolute; 
 
            left: 17px; 
 
            top: 50%; 
 
            transform: 
                translateY(-50%); 
 
            font-size: 23px; 
 
            color: #555; 
 
            pointer-events: none; 
        } 
 
 
        .clear-search { 
            display: none; 
 
            position: absolute; 
 
            right: 12px; 
 
            top: 50%; 
 
            transform: 
                translateY(-50%); 
 
            width: 28px; 
 
            height: 28px; 
 
            border: none; 
 
            border-radius: 50%; 
 
            background: #444; 
 
            color: white; 
 
            font-size: 20px; 
 
            line-height: 25px; 
 
            cursor: pointer; 
 
            transition: 
                background 0.3s ease, 
                transform 0.3s ease; 
        } 
 
 
        .clear-search:hover { 
            background: #5b4de8; 
 
            transform: 
                translateY(-50%) 
                scale(1.08); 
        } 
 
 
        .search-result { 
            margin-top: 10px; 
 
            color: 
                rgba(255, 255, 255, 0.75); 
 
            font-size: 14px; 
 
            min-height: 18px; 
        } 
 
 
        /* ========================= 
           CARD WRAPPER 
        ========================= */ 
 
        .card-wrapper { 
            display: grid; 
 
            grid-template-columns: 
                repeat(4, 1fr); 
 
            gap: 42px; 
 
            margin-top: 25px; 
        } 
 
 
        /* ========================= 
           CARD 
        ========================= */ 
 
        .card { 
            position: relative; 
 
            overflow: hidden; 
 
            background: white; 
 
            border-radius: 17px; 
 
            box-shadow: 
                0 10px 30px 
                rgba(0, 0, 0, 0.25); 
 
            transition: 
                transform 0.35s ease, 
                box-shadow 0.35s ease; 
 
            animation: 
                cardAppear 0.6s ease both; 
        } 
 
 
        .card:nth-child(1) { 
            animation-delay: 0.05s; 
        } 
 
        .card:nth-child(2) { 
            animation-delay: 0.10s; 
        } 
 
        .card:nth-child(3) { 
            animation-delay: 0.15s; 
        } 
 
        .card:nth-child(4) { 
            animation-delay: 0.20s; 
        } 
 
        .card:nth-child(5) { 
            animation-delay: 0.25s; 
        } 
 
        .card:nth-child(6) { 
            animation-delay: 0.30s; 
        } 
 
        .card:nth-child(7) { 
            animation-delay: 0.35s; 
        } 
 
        .card:nth-child(8) { 
            animation-delay: 0.40s; 
        } 
 
 
        @keyframes cardAppear { 
 
            from { 
                opacity: 0; 
 
                transform: 
                    translateY(25px); 
            } 
 
            to { 
                opacity: 1; 
 
                transform: 
                    translateY(0); 
            } 
 
        } 
 
 
        .card::before { 
            content: ""; 
 
            position: absolute; 
 
            top: 0; 
 
            left: 0; 
 
            width: 100%; 
 
            height: 4px; 
 
            background: 
                linear-gradient( 
                    90deg, 
                    #444248, 
                    #7165ff, 
                    #2e2b31 
                ); 
 
            transform: 
                scaleX(0); 
 
            transform-origin: left; 
 
            transition: 
                transform 0.4s ease; 
 
            z-index: 2; 
        } 
 
 
        .card:hover::before { 
            transform: 
                scaleX(1); 
        } 
 
 
        .card:hover { 
            transform: 
                translateY(-6px); 
 
            box-shadow: 
                0 18px 40px 
                rgba(0, 0, 0, 0.32); 
        } 
 
 
        /* ========================= 
           GAMBAR MOBIL 
        ========================= */ 
 
        .car-image-wrapper { 
            position: relative; 
 
            width: 100%; 
 
            height: 165px; 
 
            overflow: hidden; 
 
            background: 
                linear-gradient( 
                    135deg, 
                    #f1f1f3, 
                    #d9d7dc 
                ); 
 
            display: flex; 
 
            align-items: center; 
 
            justify-content: center; 
        } 
 
 
        .car-image { 
            width: 100%; 
 
            height: 165px; 
 
            object-fit: contain; 
 
            object-position: center; 
 
            display: block; 
 
            transition: 
                transform 0.5s ease, 
                filter 0.5s ease; 
        } 
 
 
        .card:hover .car-image { 
            transform: 
                scale(1.02); 
 
            filter: 
                brightness(1.05); 
        } 
 
 
        /* ========================= 
           CARD CONTENT 
        ========================= */ 
 
        .card-content { 
            padding: 15px; 
        } 
 
 
        .card h3 { 
            font-size: 17px; 
 
            color: #252329; 
 
            margin-bottom: 11px; 
        } 
 
 
        /* ========================= 
           INFORMASI MOBIL 
        ========================= */ 
 
        .car-info { 
            display: flex; 
 
            flex-direction: column; 
 
            gap: 7px; 
 
            margin-bottom: 12px; 
        } 
 
 
        .info-row { 
            display: flex; 
 
            justify-content: space-between; 
 
            align-items: center; 
 
            gap: 10px; 
 
            font-size: 13px; 
 
            color: #666; 
 
            border-bottom: 
                1px solid #eeeeee; 
 
            padding-bottom: 7px; 
        } 
 
 
        .info-row strong { 
            color: #333; 
 
            font-weight: 600; 
 
            text-align: right; 
        } 
 
 
        /* ========================= 
           HARGA 
        ========================= */ 
 
        .price-box { 
            margin-top: 12px; 
 
            padding: 10px; 
 
            border-radius: 10px; 
 
            background: 
                linear-gradient( 
                    135deg, 
                    #f2f2f4, 
                    #e4e2e7 
                ); 
        } 
 
 
        .price-label { 
            display: block; 
 
            font-size: 11px; 
 
            color: #777; 
 
            margin-bottom: 3px; 
        } 
 
 
        .price { 
            font-size: 16px; 
 
            font-weight: bold; 
 
            color: #302d35; 
        } 
 
 
        .price small { 
            font-size: 11px; 
 
            font-weight: normal; 
 
            color: #777; 
        } 
 
 
        /* ========================= 
           STATUS 
        ========================= */ 
 
        .status-row { 
            display: flex; 
 
            align-items: center; 
 
            justify-content: space-between; 
 
            margin-top: 12px; 
 
            margin-bottom: 13px; 
 
            font-size: 13px; 
 
            color: #555; 
        } 
 
 
        .badge { 
            display: inline-block; 
 
            padding: 4px 9px; 
 
            border-radius: 20px; 
 
            font-size: 11px; 
 
            font-weight: bold; 
 
            background: #ececf0; 
 
            color: #4b4850; 
        } 
 
 
        /* ========================= 
           BUTTON 
        ========================= */ 
 
        .btn { 
            display: block; 
 
            width: 100%; 
 
            padding: 10px 13px; 
 
            border: none; 
 
            border-radius: 9px; 
 
            text-align: center; 
 
            text-decoration: none; 
 
            cursor: pointer; 
 
            font-size: 13px; 
 
            font-weight: bold; 
 
            color: white; 
 
            background: 
                linear-gradient( 
                    135deg, 
                    #e0e0e6, 
                    #47454c 
                ); 
 
            box-shadow: 
                0 5px 15px 
                rgba(0, 0, 0, 0.18); 
 
            transition: 
                transform 0.3s ease, 
                box-shadow 0.3s ease, 
                filter 0.3s ease; 
        } 
 
 
        .btn:hover { 
            transform: 
                translateY(-2px); 
 
            filter: 
                brightness(1.08); 
 
            box-shadow: 
                0 8px 20px 
                rgba(0, 0, 0, 0.25); 
        } 
 
 
        .btn:disabled { 
            cursor: not-allowed; 
 
            opacity: 0.55; 
 
            transform: none; 
 
            box-shadow: none; 
 
            filter: none; 
        } 
 
 
        /* ========================= 
           RESPONSIVE 
        ========================= */ 
 
        @media (max-width: 1100px) { 
 
            .card-wrapper { 
                grid-template-columns: 
                    repeat(3, 1fr); 
 
                gap: 32px; 
            } 
 
        } 
 
 
        @media (max-width: 900px) { 
 
            .navbar { 
                padding: 
                    16px 4%; 
            } 
 
 
            .menu { 
                gap: 3px; 
            } 
 
 
            .menu a { 
                padding: 
                    8px 10px; 
 
                font-size: 13px; 
            } 
 
 
            .container { 
                width: 90%; 
            } 
 
 
            .card-wrapper { 
                grid-template-columns: 
                    repeat(2, 1fr); 
 
                gap: 30px; 
            } 
 
        } 
 
 
        @media (max-width: 600px) { 
 
            .navbar { 
                flex-direction: column; 
 
                gap: 12px; 
 
                padding: 
                    15px 4%; 
            } 
 
 
            .logo { 
                font-size: 19px; 
            } 
 
 
            .menu { 
                flex-wrap: wrap; 
 
                justify-content: center; 
            } 
 
 
            .menu a { 
                font-size: 12px; 
 
                padding: 
                    7px 9px; 
            } 
 
 
            .container { 
                width: 90%; 
 
                margin: 
                    30px auto; 
            } 
 
 
            .container h2 { 
                font-size: 25px; 
            } 
 
 
            .search-box input { 
                height: 45px; 
 
                font-size: 14px; 
            } 
 
 
            .card-wrapper { 
                grid-template-columns: 1fr; 
 
                gap: 25px; 
            } 
 
 
            .car-image-wrapper { 
                height: 190px; 
            } 
 
 
            .car-image { 
                height: 190px; 
            } 
 
        } 
 
    </style> 
</head> 
 
<body> 
 
 
<!-- ========================= 
     NAVBAR 
========================= --> 
 
<div class="navbar"> 
 
    <div class="logo"> 
        RENTAL MOBIL 
    </div> 
 
 
    <div class="menu"> 
 
        <a href="index.php"> 
            Home 
        </a> 
 
        <a href="armada.php"> 
            Armada 
        </a> 
 
 
        <?php if (isset($_SESSION['customer'])) { ?> 
 
            <a href="customer/dashboard.php"> 
                Dashboard 
            </a> 
 
            <a href="logout.php"> 
                Logout 
            </a> 
 
        <?php } else { ?> 
 
            <a href="login.php"> 
                Login 
            </a> 
 
        <?php } ?> 
 
    </div> 
 
</div> 
 
 
<!-- ========================= 
     KONTEN 
========================= --> 
 
<div class="container"> 
 
    <h2> 
        Daftar Armada 
    </h2> 
 
 
    <!-- ========================= 
         SEARCH BAR 
    ========================= --> 
 
    <div class="search-container"> 
 
        <div class="search-box"> 
 
            <span class="search-icon"> 
                ⌕ 
            </span> 
 
 
            <input 
                type="text" 
                id="searchArmada" 
                placeholder="Cari nama atau jenis mobil..." 
                autocomplete="off" 
            > 
 
 
            <button 
                type="button" 
                id="clearSearch" 
                class="clear-search" 
            > 
                × 
            </button> 
 
        </div> 
 
 
        <p 
            id="searchResult" 
            class="search-result" 
        ></p> 
 
    </div> 
 
 
    <!-- ========================= 
         CARD ARMADA 
    ========================= --> 
 
    <div class="card-wrapper"> 
 
        <?php while ($row = mysqli_fetch_assoc($query)) { ?> 
 
            <?php 
 
            // Ambil nama gambar dari database
            // Jika kolom gambar kosong,
            // gunakan default.png
 
            if (!empty($row['gambar'])) { 
 
                $gambar = $row['gambar']; 
 
            } else { 
 
                $gambar = "default.png"; 
 
            } 
 
            ?> 
 
 
            <div class="card"> 
 
 
                <!-- Gambar mobil --> 
 
                <div class="car-image-wrapper"> 
 
                    <img 
                        src="gambar/<?= $gambar; ?>" 
                        class="car-image" 
                        alt="<?= $row['nama_kendaraan']; ?>" 
                    > 
 
                </div> 
 
 
                <!-- Isi card --> 
 
                <div class="card-content"> 
 
 
                    <!-- Nama mobil --> 
 
                    <h3> 
                        <?= $row['nama_kendaraan']; ?> 
                    </h3> 
 
 
                    <!-- Informasi mobil --> 
 
                    <div class="car-info"> 
 
 
                        <div class="info-row"> 
 
                            <span> 
                                Tipe 
                            </span> 
 
                            <strong> 
                                <?= $row['tipe']; ?> 
                            </strong> 
 
                        </div> 
 
 
                        <div class="info-row"> 
 
                            <span> 
                                Transmisi 
                            </span> 
 
                            <strong> 
                                <?= $row['transmisi']; ?> 
                            </strong> 
 
                        </div> 
 
 
                    </div> 
 
 
                    <!-- Harga --> 
 
                    <div class="price-box"> 
 
                        <span class="price-label"> 
                            Harga sewa 
                        </span> 
 
                        <div class="price"> 
 
                            Rp <?= number_format($row['harga_sewa']); ?> 
 
                            <small> 
                                / hari 
                            </small> 
 
                        </div> 
 
                    </div> 
 
 
                    <!-- Status --> 
 
                    <div class="status-row"> 
 
                        <span> 
                            Status 
                        </span> 
 
                        <span class="badge"> 
 
                            <?= $row['status_ketersediaan']; ?> 
 
                        </span> 
 
                    </div> 
 
 
                    <!-- Tombol pesan --> 
 
                    <?php if ($row['status_ketersediaan'] == 'tersedia') { ?> 
 
 
                        <?php if (isset($_SESSION['customer'])) { ?> 
 
                            <a 
                                href="customer/pesan.php?id=<?= $row['id_armada']; ?>" 
                                class="btn" 
                            > 
                                Pesan 
                            </a> 
 
                        <?php } else { ?> 
 
                            <a 
                                href="login.php" 
                                class="btn" 
                            > 
                                Login untuk Pesan 
                            </a> 
 
                        <?php } ?> 
 
 
                    <?php } else { ?> 
 
                        <button 
                            class="btn" 
                            disabled 
                        > 
                            Tidak Tersedia 
                        </button> 
 
                    <?php } ?> 
 
 
                </div> 
 
            </div> 
 
 
        <?php } ?> 
 
    </div> 
 
</div> 
 
 
<!-- ========================= 
     SEARCH JAVASCRIPT 
========================= --> 
 
<script> 
 
    const searchInput = 
        document.getElementById("searchArmada"); 
 
 
    const clearSearch = 
        document.getElementById("clearSearch"); 
 
 
    const searchResult = 
        document.getElementById("searchResult"); 
 
 
    const cards = 
        document.querySelectorAll(".card"); 
 
 
    searchInput.addEventListener( 
        "input", 
        function () { 
 
            const keyword = 
                this.value 
                    .toLowerCase() 
                    .trim(); 
 
 
            let jumlahDitemukan = 0; 
 
 
            cards.forEach( 
                function (card) { 
 
                    const informasiMobil = 
                        card.textContent 
                            .toLowerCase(); 
 
 
                    if ( 
                        informasiMobil.includes(keyword) 
                    ) { 
 
                        card.style.display = ""; 
 
                        jumlahDitemukan++; 
 
                    } else { 
 
                        card.style.display = "none"; 
 
                    } 
 
                } 
            ); 
 
 
            if (keyword === "") { 
 
                searchResult.textContent = ""; 
 
                clearSearch.style.display = "none"; 
 
            } else { 
 
                clearSearch.style.display = "block"; 
 
 
                searchResult.textContent = 
                    jumlahDitemukan + 
                    " kendaraan ditemukan"; 
 
 
                if (jumlahDitemukan === 0) { 
 
                    searchResult.textContent = 
                        "Tidak ada kendaraan yang ditemukan"; 
 
                } 
 
            } 
 
        } 
    ); 
 
 
    clearSearch.addEventListener( 
        "click", 
        function () { 
 
            searchInput.value = ""; 
 
 
            cards.forEach( 
                function (card) { 
 
                    card.style.display = ""; 
 
                } 
            ); 
 
 
            searchResult.textContent = ""; 
 
            clearSearch.style.display = "none"; 
 
            searchInput.focus(); 
 
        } 
    ); 
 
</script> 
 
 
</body> 
</html>