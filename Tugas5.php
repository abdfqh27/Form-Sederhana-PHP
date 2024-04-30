<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pembelian Tiket</title>

    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #023047;
            margin: 0;
            padding: 0;
        }

        .container {
            max-width: 600px;
            margin: 50px auto;
            background-color: rgba(255, 183, 3, 0.8);
            /* Mengatur transparansi latar belakang */
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        h2 {
            text-align: center;
            color: #f9f9f9;
        }

        form {
            margin-bottom: 20px;
        }

        label {
            display: block;
            margin-bottom: 10px;
            font-weight: bold;
            color: #f9f9f9;
            /* Warna label */
        }

        select,
        input[type="submit"],
        input[type="text"],
        input[type="date"] {
            width: 100%;
            padding: 10px;
            margin-bottom: 20px;
            border: 1px solid #ccc;
            border-radius: 5px;
            box-sizing: border-box;
        }

        input[type="submit"] {
            background-color: #023047;
            color: white;
            font-weight: bold;
            cursor: pointer;
        }

        .ticket {
            background-color: #f9f9f9;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 0 5px rgba(0, 0, 0, 0.1);
        }

        .ticket h2 {
            margin-top: 0;
            color: #333;
        }

        .ticket-info {
            margin-bottom: 10px;
        }

        .ticket-info span {
            font-weight: bold;
        }

        footer {
            background-color: #FFB703;
            color: #f9f9f9;
            text-align: center;
            margin-top: 20px;
            padding: 10px 0;
        }

        footer p {
            margin: 0;
        }
    </style>
</head>
<body>
<div class="container">
        <h2>Pembelian Tiket</h2>
        <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
            <label>Nama Penumpang:</label>
            <input type="text" name="nama_penumpang" required>

            <label>Tanggal Keberangkatan:</label>
            <input type="date" name="tanggal_keberangkatan" required>

            <label>Nama Maskapai:</label>
            <select name="nama_maskapai">
                <option value="Garuda Indonesia">Garuda Indonesia</option>
                <option value="Air Asia">Air Asia</option>
                <option value="Lion Air">Lion Air</option>
                <option value="Batik Air">Batik Air</option>
                <option value="Citilink">Citilink</option>
                <option value="Sriwijaya Air">Sriwijaya Air</option>
                <option value="Emirates Airways">Emirates Airways</option>
                <option value="Qatar Airways">Qatar Airways</option>
            </select>
            <label>Bandara Asal:</label>
            <select name="bandara_asal">
                <?php
                $bandara_asal = array("Soekarno Hatta", "Husein Sastranegara", "Kertajati", "Juanda");
                sort($bandara_asal);
                foreach ($bandara_asal as $bandara) {
                    echo "<option value=\"$bandara\">$bandara</option>";
                }
                ?>
            </select>
            <label>Bandara Tujuan:</label>
            <select name="bandara_tujuan">
                <?php
                $bandara_tujuan = array("I Gusti Ngurah Rai", "Yogyakarta Internasional", "Hang Nadim", "Hassanudin");
                sort($bandara_tujuan);
                foreach ($bandara_tujuan as $bandara) {
                    echo "<option value=\"$bandara\">$bandara</option>";
                }
                ?>
            </select>
            <label>Kelas:</label>
            <select name="kelas">
                <option value="Ekonomi">Ekonomi (Rp 2.000.000)</option>
                <option value="Bisnis">Bisnis (Rp 5.000.000)</option>
            </select>

            <input type="submit" name="submit" value="Beli Sekarang">
        </form>

        <?php
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $nama_maskapai = $_POST['nama_maskapai'];
            $bandara_asal = $_POST['bandara_asal'];
            $bandara_tujuan = $_POST['bandara_tujuan'];
            $kelas = $_POST['kelas'];
            $nama_penumpang = $_POST['nama_penumpang'];
            $tanggal_keberangkatan = $_POST['tanggal_keberangkatan'];

            $harga_ekonomi = 2000000;
            $harga_bisnis = 5000000;

            $harga_tiket = ($kelas == 'Ekonomi') ? $harga_ekonomi : $harga_bisnis;

            $pajak_bandara_asal = array("Soekarno Hatta" => 65000, "Husein Sastranegara" => 50000, "Kertajati" => 40000, "Juanda" => 30000);
            $pajak_bandara_tujuan = array("I Gusti Ngurah Rai" => 85000, "Yogyakarta Internasional" => 70000, "Hang Nadim" => 90000, "Hassanudin" => 60000);

            $pajak = $pajak_bandara_asal[$bandara_asal] + $pajak_bandara_tujuan[$bandara_tujuan];
            $total_harga_tiket = $harga_tiket + $pajak;

            echo "<div class='ticket'>";
            echo "<h2>E - Ticket</h2>";
            echo "<div class='ticket-info'>Nomor Tiket: <span>" . uniqid() . "</span></div>";
            echo "<div class='ticket-info'>Tanggal Pemesanan: <span>" . date("Y-m-d H:i:s") . "</span></div>";
            echo "<div class='ticket-info'>Nama Penumpang: <span>$nama_penumpang</span></div>";
            echo "<div class='ticket-info'>Tanggal Keberangkatan: <span>$tanggal_keberangkatan</span></div>";
            echo "<div class='ticket-info'>Nama Maskapai: <span>$nama_maskapai</span></div>";
            echo "<div class='ticket-info'>Asal Penerbangan: <span>$bandara_asal</span></div>";
            echo "<div class='ticket-info'>Tujuan Penerbangan: <span>$bandara_tujuan</span></div>";
            echo "<div class='ticket-info'>Kelas: <span>$kelas</span></div>";
            echo "<div class='ticket-info'>Harga Tiket: <span>Rp " . number_format($harga_tiket) . "</span></div>";
            echo "<div class='ticket-info'>Pajak: <span>Rp " . number_format($pajak) . "</span></div>";
            echo "<div class='ticket-info'>Total Harga Tiket: <span>Rp " . number_format($total_harga_tiket) . "</span></div>";
            echo "</div>";
        }
        ?>
    </div>

    <!-- Footer -->
    <footer>
        <p>&copy; 2024 | Abdullah Faqih | 2210631250035</p>
    </footer>
</body>
</html>