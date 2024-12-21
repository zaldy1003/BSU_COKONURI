<!-- Main Content -->
<div class="container mt-5">
  <div class="text-center">
    <span>
      <h2 class="fw-bold">Selamat Datang di Sistem Pengelolaan Bank Sampah</h2>
      <!-- dibawah ini adalah nama sistem -->
      <h1 class="text-center fw-bold" id="systemName">Sistem Pengelolaan Bank Sampah</h1>
    </span>
  </div>
</div>

<div class="container mt-5">
  <!-- Ringkasan Statistik -->
  <div class="row mb-4">
    <div class="col-md-4">
      <div class="card stat-card text-center p-3">
        <div class="card-body">
          <i class="icon-large text-primary bi bi-people-fill"></i>
          <h5 class="card-title mt-2">Total Nasabah</h5>
          <h3 id="totalNasabah"><?= $data['totalNasabah']['jumlah_nasabah'] ?></h3>
        </div>
      </div>
    </div>
    <div class="col-md-4">
      <div class="card stat-card text-center p-3">
        <div class="card-body">
          <i class="icon-large text-success bi bi-cart-check-fill"></i>
          <h5 class="card-title mt-2">Transaksi Bulan Ini</h5>
          <h3 id="totalTransaksiBulanIni"><?= $data['totalTransaksi']['total_transaksi'] ?></h3>
        </div>
      </div>
    </div>
    <div class="col-md-4">
      <div class="card stat-card text-center p-3">
        <div class="card-body">
          <i class="icon-large text-warning bi bi-recycle"></i>
          <h5 class="card-title mt-2">Transaksi Sampah Terbanyak</h5>
          <h3 id="sampahTerbanyak"><?= $data['totalSampah']['jenisSampah'] ?>
            <?= $data['totalSampah']['jumlah_transaksi'] ?></h3>
          <!-- <h3 id="sampahTerbanyak"><?= $data['totalSampah']['jumlah_transaksi'] ?></h3> -->
        </div>
      </div>
    </div>
  </div>

  <!-- Tautan Cepat -->
  <div class="row g-4">
    <div class="col-md-4">
      <a href="<?= BASEURL; ?>/Transaksi" class="btn btn-primary w-100 mb-3">Tambah Transaksi</a>
    </div>
    <div class="col-md-4">
      <a href="<?= BASEURL; ?>/Riwayat_transaksi" class="btn btn-success w-100 mb-3">Lihat Riwayat Transaksi</a>
    </div>
    <div class="col-md-4">
      <a href="<?= BASEURL; ?>/Laporan" class="btn btn-warning w-100 mb-3">Cetak Laporan</a>
    </div>
  </div>
</div>
<script>

  // Data default
  const defaultData = {
    systemName: "BSU Cokonuri",
    contact: "Kontak: 08123456789",
    address: "Alamat: Jl. Contoh No. 123, Kota ABC",
  };

  // Ambil data dari localStorage
  const storedData = JSON.parse(localStorage.getItem("systemSettings"));

  // Gunakan data dari localStorage jika tersedia, jika tidak gunakan default
  const systemData = storedData || defaultData;

  // Tampilkan data
  document.getElementById("systemName").textContent = systemData.systemName;
  document.getElementById("contactInfo").textContent = `${systemData.contact} | ${systemData.address}`;
</script>

</script>
</body>

</html>