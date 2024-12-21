<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Halaman Transaksi</title>
  <!-- Bootstrap CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" />
  <style>
    body {
      background-color: #f8f9fa;
      /* Warna latar belakang bersih */
    }

    .modal-header {
      background-color: #0d6efd;
      /* Warna biru Bootstrap */
      color: white;
    }

    .table th,
    .table td {
      vertical-align: middle;
    }
  </style>
</head>

<body>
  <div class="container mt-5">
    <h2 class="text-center mb-4">Halaman Transaksi</h2>

    <!-- Table untuk List Nasabah -->
    <div class="card shadow-sm mb-4">
      <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center">
        <h5 class="mb-0">Daftar Nasabah</h5>
      </div>
      <div class="card-body">
        <table id="nasabahTable" class="table table-striped table-bordered">
          <thead class="table-dark">
            <tr>
              <th>Nama Nasabah</th>
              <th>Umur</th>
              <th>Alamat</th>
              <th>Aksi</th>
            </tr>
          </thead>
          <tbody>
            <!-- Contoh Data -->
            <tr>
              <td>John Doe</td>
              <td>30</td>
              <td>Jl. Mawar No. 1</td>
              <td style="display: flex; justify-content: center; gap: 1rem">
                <button class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#transaksiModal"
                  onclick="setNasabahData('John Doe')">Catat Transaksi</button>
              </td>
            </tr>
            <tr>
              <td>Jane Smith</td>
              <td>25</td>
              <td>Jl. Melati No. 5</td>
              <td style="display: flex; justify-content: center; gap: 1rem">
                <button class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#transaksiModal"
                  onclick="setNasabahData('Jane Smith')">Catat Transaksi</button>
              </td>
            </tr>
          </tbody>
        </table>
      </div>
    </div>
  </div>

  <!-- Modal untuk Pencatatan Transaksi -->
  <div class="modal fade" id="transaksiModal" tabindex="-1" aria-labelledby="transaksiModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="transaksiModalLabel">Pencatatan Transaksi</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <form id="formTransaksi">
            <div class="mb-3">
              <label for="namaNasabah" class="form-label">Nama Nasabah</label>
              <input type="text" class="form-control" id="namaNasabah" readonly />
            </div>
            <div class="mb-3">
              <label for="jenisSampah" class="form-label">Jenis Sampah</label>
              <select class="form-select" id="jenisSampah" required>
                <!-- Opsi jenis sampah akan dimasukkan dari data harga sampah -->

              </select>
            </div>
            <div class="mb-3">
              <label for="beratSampah" class="form-label">Berat Sampah (Kg)</label>
              <input type="number" class="form-control" id="beratSampah" placeholder="Masukkan berat sampah" required />
            </div>
            <div class="mb-3">
              <label for="deskripsiTransaksi" class="form-label">Deskripsi</label>
              <textarea class="form-control" id="deskripsiTransaksi" rows="3" placeholder="Masukkan deskripsi"
                required></textarea>
            </div>
          </form>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
          <button type="reset" class="btn btn-danger"
            onclick="document.getElementById('formTransaksi').reset()">Reset</button>
          <button type="button" class="btn btn-primary" onclick="simpanTransaksi()">Simpan</button>
        </div>
      </div>
    </div>
  </div>

  <!-- Bootstrap JS -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>
  <script>
    // Data Harga Sampah untuk disesuaikan dengan dropdown
    const hargaSampah = [
      <?php foreach ($data['jenisSampah'] as $sampah): ?>
          { jenis: "<?= htmlspecialchars($sampah['jenisSampah']) ?>", harga: <?= htmlspecialchars($sampah['hargaPerKG']) ?> },
      <?php endforeach; ?>
    ];

    // Fungsi untuk mengisi dropdown jenis sampah dengan harga
    function updateJenisSampah() {
      const jenisSampahSelect = document.getElementById("jenisSampah");
      jenisSampahSelect.innerHTML = ""; // Kosongkan dropdown
      hargaSampah.forEach((item) => {
        const option = document.createElement("option");
        option.value = item.jenis;
        option.textContent = `${item.jenis} (Rp ${item.harga}/Kg)`;
        jenisSampahSelect.appendChild(option);
      });
    }

    // Fungsi untuk mengisi nama nasabah yang dipilih
    function setNasabahData(nama) {
      document.getElementById("namaNasabah").value = nama;
      updateJenisSampah(); // Update dropdown jenis sampah
    }

    // Fungsi untuk menyimpan transaksi (untuk saat ini hanya alert)
    function simpanTransaksi() {
      const namaNasabah = document.getElementById("namaNasabah").value;
      const jenisSampah = document.getElementById("jenisSampah").value;
      const beratSampah = document.getElementById("beratSampah").value;
      const deskripsiTransaksi = document.getElementById("deskripsiTransaksi").value;

      if (!namaNasabah || !jenisSampah || !beratSampah || !deskripsiTransaksi) {
        alert("Semua kolom harus diisi!");
        return;
      }

      alert(`Transaksi untuk ${namaNasabah} telah disimpan!`);
      const modal = bootstrap.Modal.getInstance(document.getElementById("transaksiModal"));
      modal.hide();
    }
  </script>
</body>

</html>