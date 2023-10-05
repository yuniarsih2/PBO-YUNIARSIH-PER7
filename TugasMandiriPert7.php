<?php
class Employee
{
    protected $nama;
    protected $gaji;

    public function __construct($nama, $gaji)
    {
        $this->nama = $nama;
        $this->gaji = $gaji;
    }

    public function getNama()
    {
        return $this->nama;
    }

    public function getGaji()
    {
        return $this->gaji;
    }

    public function setGaji($gaji)
    {
        $this->gaji = $gaji;
    }
}

class Programmer extends Employee
{
    private $masaKerja; // Masa kerja dalam tahun

    public function __construct($nama, $gaji, $masaKerja)
    {
        parent::__construct($nama, $gaji);
        $this->masaKerja = $masaKerja;
    }

    public function hitungKenaikanGaji()
    {
        if ($this->masaKerja >= 1 && $this->masaKerja <= 10) {
            // Kenaikan gaji sebesar 0.01 dari masa kerja
            $kenaikan = 0.01 * $this->masaKerja * $this->getGaji();
            $this->setGaji($this->getGaji() + $kenaikan);
        } elseif ($this->masaKerja > 10) {
            // Kenaikan gaji sebesar 0.02 dari masa kerja
            $kenaikan = 0.02 * $this->masaKerja * $this->getGaji();
            $this->setGaji($this->getGaji() + $kenaikan);
        }
    }

    public function getMasaKerja()
    {
        return $this->masaKerja;
    }
}

// Membuat objek Programmer
$programmer1 = new Programmer("John Doe", 5000, 5); // Nama, gaji awal, masa kerja (5 tahun)
$programmer2 = new Programmer("Jane Smith", 6000, 12); // Nama, gaji awal, masa kerja (12 tahun)

// Menghitung kenaikan gaji
$programmer1->hitungKenaikanGaji();
$programmer2->hitungKenaikanGaji();


// Menampilkan informasi nama programmer, gaji, dan masa kerja
echo "<h2>Clas Programmer Employee</h2>";
echo "Nama Programmer 1: " . $programmer1->getNama() . "<br>";
echo "Gaji Programmer 1: $" . $programmer1->getGaji() . "<br>";
echo "Masa Kerja Programmer 1: " . $programmer1->getMasaKerja() . " tahun<br>";

echo "Nama Programmer 2: " . $programmer2->getNama() . "<br>";
echo "Gaji Programmer 2: $" . $programmer2->getGaji() . "<br>";
echo "Masa Kerja Programmer 2: " . $programmer2->getMasaKerja() . " tahun<br>";


echo "                                                               " . "<br>";
echo "<------------------------------------------------------------->" . "<br>";

class Direktur extends Employee
{
    private $masaKerja; // Masa kerja dalam tahun

    public function __construct($nama, $gaji, $masaKerja)
    {
        parent::__construct($nama, $gaji);
        $this->masaKerja = $masaKerja;
    }

    public function hitungKenaikanGaji()
    {
        // Kenaikan gaji sebesar 0.5 dari masa kerja
        $kenaikan = 0.5 * $this->masaKerja * $this->getGaji();

        // Tunjangan sebesar 0.1 dari masa kerja
        $tunjangan = 0.1 * $this->masaKerja * $this->getGaji();

        $totalKenaikan = $kenaikan + $tunjangan;

        $this->setGaji($this->getGaji() + $totalKenaikan);
    }

    public function getMasaKerja()
    {
        return $this->masaKerja;
    }
}

// Membuat objek Direktur
$direktur = new Direktur("Alice Johnson", 10000, 15); // Nama, gaji awal, masa kerja (15 tahun)

// Menghitung kenaikan gaji
$direktur->hitungKenaikanGaji();

// Menampilkan informasi nama direktur, gaji, masa kerja, bonus, dan tunjangan
echo "<h2>Clas Direktur</h2>";
echo "Nama Direktur: " . $direktur->getNama() . "<br>";
echo "Gaji Direktur: $" . $direktur->getGaji() . "<br>";
echo "Masa Kerja Direktur: " . $direktur->getMasaKerja() . " tahun<br>";

echo "                                                               " . "<br>";
echo "<------------------------------------------------------------->" . "<br>";


class PegawaiMingguan extends Employee
{
    private $hargaBarang;
    private $stockTerjual;

    public function __construct($nama, $gaji, $hargaBarang, $stockTerjual)
    {
        parent::__construct($nama, $gaji);
        $this->hargaBarang = $hargaBarang;
        $this->stockTerjual = $stockTerjual;
    }

    public function hitungKenaikanGaji()
    {
        // Hitung total penjualan
        $totalPenjualan = $this->hargaBarang * $this->stockTerjual;

        // Hitung bonus gaji jika total penjualan lebih dari 70% stock yang harus terjual
        if ($totalPenjualan > 0.7 * $this->hargaBarang * $this->stockTerjual) {
            // Bonus gaji sebesar 10% dari harga barang tiap 1 penjualan
            $bonusGaji = 0.10 * $this->hargaBarang;
        } else {
            // Bonus gaji sebesar 3% dari harga barang tiap 1 penjualan
            $bonusGaji = 0.03 * $this->hargaBarang;
        }

        // Tambahkan bonus gaji ke gaji awal
        $gajiAkhir = $this->getGaji() + $bonusGaji;
        $this->setGaji($gajiAkhir);
    }

    public function getTotalPenjualan()
    {
        return $this->hargaBarang * $this->stockTerjual;
    }

    public function getHargaBarang()
    {
        return $this->hargaBarang;
    }

    public function getStockTerjual()
    {
        return $this->stockTerjual;
    }
}

// Handling form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nama = $_POST["nama"];
    $gaji = $_POST["gaji"];
    $hargaBarang = $_POST["harga_barang"];
    $stockTerjual = $_POST["stock_terjual"];

    // Membuat objek PegawaiMingguan
    $pegawai = new PegawaiMingguan($nama, $gaji, $hargaBarang, $stockTerjual);

    // Menghitung kenaikan gaji
    $pegawai->hitungKenaikanGaji();
}

?>

<!DOCTYPE html>
<html>

<head>
    <title>Hitung Kenaikan Gaji Pegawai Mingguan</title>
</head>

<body>
    <h1>Hitung Kenaikan Gaji Pegawai Mingguan</h1>
    <form method="POST" action="">
        <label for="nama">Nama Pegawai:</label>
        <input type="text" id="nama" name="nama" required><br><br>

        <label for="gaji">Gaji Awal:</label>
        <input type="number" id="gaji" name="gaji" required><br><br>

        <label for="harga_barang">Harga Barang:</label>
        <input type="number" id="harga_barang" name="harga_barang" required><br><br>

        <label for="stock_terjual">Stock Terjual:</label>
        <input type="number" id="stock_terjual" name="stock_terjual" required><br><br>

        <input type="submit" value="Hitung Kenaikan Gaji">
    </form>

    <?php if ($_SERVER["REQUEST_METHOD"] == "POST") : ?>
        <h2>Hasil Perhitungan:</h2>
        <p>Nama Pegawai: <?php echo $pegawai->getNama(); ?></p>
        <p>Gaji Pegawai: $<?php echo $pegawai->getGaji(); ?></p>
        <p>Total Penjualan: $<?php echo $pegawai->getTotalPenjualan(); ?></p>
        <p>Harga Barang: $<?php echo $pegawai->getHargaBarang(); ?></p>
        <p>Stock Terjual: <?php echo $pegawai->getStockTerjual(); ?> unit</p>
    <?php endif; ?>
</body>

</html>