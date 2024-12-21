<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Riwayat Transaksi</title>
  <!-- Bootstrap CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" />
</head>

<body>
  <div class="container mt-5">
    <h2 class="text-center mb-4">Riwayat Transaksi</h2>

    <!-- Filter Tanggal -->
    <div class="card shadow-sm row mb-4">
      <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center">
        <h5 class="mb-0">Daftar Transaksi</h5>
      </div>
      <!-- Form Filter -->
      <form action="<?= BASEURL; ?>/transaksi/filter" method="POST" class="d-flex  mt-5"
        style="flex-direction:row; justify-content:space-between">
        <div class="col-md-4" style="width:30%">
          <label for="startDate" class="form-label">Tanggal Mulai</label>
          <input type="date" id="startDate" name="startDate" class="form-control" />
        </div>
        <div class="col-md-4" style="width:30%">
          <label for="endDate" class="form-label">Tanggal Selesai</label>
          <input type="date" id="endDate" name="endDate" class="form-control" />
        </div>
        <div class="col-md-4 align-items-end gap-2" style="display:flex; flex-direction:row;">
          <button type="submit" id="filterButton" class="btn btn-primary w-50">Filter</button>
          <button type="reset" id="resetFilterButton" class="btn btn-secondary w-50" style="height:55%;">Reset</button>
        </div>
      </form>


      <div class="card-body">
        <!-- Tabel Riwayat Transaksi -->
        <table id="riwayatTable" class="table table-striped table-bordered">
          <thead class="table-dark">
            <tr>
              <th>Tanggal</th>
              <th>Nama Nasabah</th>
              <th>Jenis Sampah</th>
              <!-- Kolom untuk Jenis Sampah -->
              <th>Berat (Kg)</th>
              <th>Deskripsi</th>
            </tr>
          </thead>
          <tbody>
            <!-- Contoh Data -->
            <tr>
              <td>2024-12-01</td>
              <td>John Doe</td>
              <td>Gelas Plastik</td>
              <!-- Jenis Sampah yang sesuai dengan transaksi -->
              <td>2.5</td>
              <td>-</td>
            </tr>
            <tr>
              <td>2024-12-02</td>
              <td>Jane Smith</td>
              <td>Botol Plastik</td>
              <!-- Jenis Sampah -->
              <td>1.0</td>
              <td>-</td>
            </tr>
          </tbody>
        </table>
      </div>

      <!-- Tombol Cetak Laporan -->
      <div class="d-flex justify-content-end mt-4 mb-4">
        <button id="printReportButton" class="btn btn-success">Cetak Laporan</button>
      </div>
    </div>
  </div>

  <!-- Bootstrap JS -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>
  <!-- Script untuk Filter -->
  <script>
    document.getElementById("filterButton").addEventListener("click", function () {
      const startDate = document.getElementById("startDate").value;
      const endDate = document.getElementById("endDate").value;

      const rows = document.querySelectorAll("#riwayatTable tbody tr");
      rows.forEach((row) => {
        const date = row.cells[0].textContent;
        if ((startDate && date < startDate) || (endDate && date > endDate)) {
          row.style.display = "none";
        } else {
          row.style.display = "";
        }
      });
    });

    document.getElementById("resetFilterButton").addEventListener("click", function () {
      const rows = document.querySelectorAll("#riwayatTable tbody tr");
      rows.forEach((row) => (row.style.display = ""));
      document.getElementById("startDate").value = "";
      document.getElementById("endDate").value = "";
    });

    document.getElementById("printReportButton").addEventListener("click", function () {
      window.location.href = "cetak_laporan.html"; // Ganti URL dengan halaman cetak laporan
    });
  </script>
</body>

</html>