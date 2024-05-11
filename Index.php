<?php
// Harga rental per hari untuk setiap jenis motor
$harga_per_hari = [
    "Honda Beat" => 7000,
    "Yamaha NMAX" => 10000,
    "Suzuki Satria F150" => 8000,
    "Kawasaki Ninja 250RR" => 12000
];

// Inisialisasi variabel hasil dan info
$hasil = "";
$info = "";

// Proses input dan hitung total biaya jika tombol 'hitung' ditekan
if(isset($_POST['submit'])) {
    // Memastikan semua input diisi
    if(!empty($_POST['nama_pelanggan']) && !empty($_POST['lama_waktu']) && !empty($_POST['motor'])) {
        $nama_pelanggan = $_POST['nama_pelanggan'];
        $lama_waktu = $_POST['lama_waktu'];
        $motor = $_POST['motor'];

        // Fungsi untuk menghitung total biaya rental
        function hitungBiayaRental($nama_pelanggan, $lama_waktu, $motor)
        {
            // Pajak tambahan
            $pajak = 10000;

            // Diskon untuk member
            $diskon_member = 0.05;

            // Cek apakah pelanggan merupakan member
            $nama_member = ["ana", "budi", "charlie"]; // Daftar nama member
            $is_member = in_array(strtolower($nama_pelanggan), $nama_member);

            global $harga_per_hari; // Menggunakan variabel global $harga_per_hari

            // Hitung total biaya rental
            $total_biaya = $harga_per_hari[$motor] * $lama_waktu;

            // Jika pelanggan merupakan member, berikan diskon 5%
            if ($is_member) {
                $total_biaya -= $total_biaya * $diskon_member;
            }

            // Tambahkan pajak tambahan
            $total_biaya += $pajak;

            return $total_biaya;
        }

        // Hitung total biaya rental
        $hasil = hitungBiayaRental($nama_pelanggan, $lama_waktu, $motor);
        // Menampilkan informasi sesuai kebutuhan
        if($hasil > 0) {
            $info .= $nama_pelanggan . " berstatus sebagai ";
            if(in_array(strtolower($nama_pelanggan), ["ana", "budi", "charlie"])) {
                $info .= "member ";
            } else {
                $info .= "non-member ";
            }
            if(in_array(strtolower($nama_pelanggan), ["ana", "budi", "charlie"])) {
                $info .= "mendapatkan diskon 5%. ";
            } else {
                $info .= "tidak mendapatkan diskon 5%. ";
            }
            $info .= "Jenis motor yang dirental adalah " . $motor . " selama " . $lama_waktu . " hari dengan harga rental per hari-harinya: " . $harga_per_hari[$motor] . ".<br>";
            $info .= "Biaya yang harus dibayarkan adalah Rp. " . number_format($hasil, 0, ',', '.') . ",-";
        } else {
            $info = "Input tidak valid";
        }
    } else {
        $info = "Semua input harus diisi";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Rental Motor</title>
    <style>
        body {
            background: #f2f2f2;
            font-family: sans-serif;
        }

        .input-container {
            display: flex;
            align-items: center;
            margin-bottom: 10px;
        }

        .input-container .h21 {
            margin-right: 20px;
            flex: 0 0 auto; /* Menetapkan ukuran yang tetap untuk judul */
        }

        .input-container .bil2 {
            flex: 1; /* Mengisi ruang yang tersedia */
            margin-left: 10px; /* Menambahkan margin kiri */
            width: auto; /* Menghapus lebar yang ditetapkan */
        }

        .kalkulator {
            width: 1030px;
            height: auto;
            margin: 100px auto;
            padding: 10px 20px 50px 20px;
            border-radius: 5px;
            box-shadow: 0px 10px 20px 0px #d1d1d1;
            background-color: white;
        }

        .bil2 {
            width: 300px;
            border: none;
            font-size: 16pt;
            border-radius: 5px;
            padding: 10px;
            margin: 5px;
        }

        .bil2 {
            margin-left: 45px;
            margin-top: 5px;
        }

        .bil1 {
            width: 300px;
            border: none;
            font-size: 16pt;
            border-radius: 5px;
            padding: 10px;
            display: flexbox;
            margin-left: 5px;
            margin-right: 15px;
        }

        .opt {
            font-size: 16pt;
            border: none;
            width: 215px;
            margin: 5px;
            border-radius: 5px;
            padding: 10px;
        }

        .tombol {
            background: lightgreen;
            border-top: none;
            border-right: none;
            border-left: none;
            border-radius: 5px;
            padding: 10px 20px;
            color: rgb(29, 27, 27);
            font-size: 15pt;
            border-bottom: 5px solid lightgreen;
            margin-top: 20px;
        }

        .brand {
            color: #eee;
            font-size: 11pt;
            text-decoration: none;
            margin: 12px;
        }

        .judul {
            text-align: center;
            color: black;
            font-weight: normal;
            margin-top: 50px;
            font-size: 3rem;
        }

        .container {
            display: flex;
            align-items: center;
        }

        .hasil2 {
            width: 350px;
            margin: 5px;
            border: none;
            font-size: 16pt;
            border-radius: 5px;
            padding: 10px;
            margin-top: 35px;
            align-items: center;
        }

        .h21 {
            margin-right: 90px;
            text-align: end;
        }

        .hasil-container {
            text-align: center;
        }

        .info {
            text-align: center;
            font-size: 1.2rem;
            margin-top: 20px;
        }
    </style>
</head>
<body>
<h2 class="judul">Rental Motor</h2>
<div class="kalkulator">
    <form method="post" action="">
        <div class="container">
            <div class="input-container">
                <h2 class="h21">Nama Pelanggan:</h2>
                <input type="text" name="nama_pelanggan" class="bil1" autocomplete="off" placeholder="Masukkan nama pelanggan">
            </div>
            <div class="input-container">
                <h2 class="h21">Lama Waktu:</h2>
                <input type="number" name="lama_waktu" class="bil2" autocomplete="off" placeholder="Masukkan lama waktu">
            </div>
        </div>
        <center>
            <div class="container">
                <h2 class="h21">Jenis Motor</h2>
                <select class="opt" name="motor">
                    <option value="Honda Beat">Honda Beat</option>
                    <option value="Yamaha NMAX">Yamaha NMAX</option>
                    <option value="Suzuki Satria F150">Suzuki Satria F150</option>
                    <option value="Kawasaki Ninja 250RR">Kawasaki Ninja 250RR</option>
                </select>
            </div>
        </center>
        <center>
            <input type="submit" name="submit" value="submit" class="tombol">
        </center>
    </form>
    <?php if(isset($_POST['submit'])){ ?>
    <div class="hasil-container">
        <p class="info"><?php echo $info; ?></p>
    </div>
<?php  } ?>

</div>
</body>
</html>
