<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Laporan Bulanan</title>
  <!-- Bootstrap CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" />
  <style>
    .summary-card {
      border-radius: 12px;
      box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
    }

    .icon-large {
      font-size: 2rem;
    }
  </style>
</head>

<body>
  <div class="container mt-5">
    <h2 class="mb-4">Laporan Bulanan</h2>

    <!-- Pilih Bulan dan Tahun -->
    <div class="row mb-4">
      <form action="<?= BASEURL; ?>/laporan/tampilData" method="POST" class="w-100"
        style="display:flex; flex-direction:row; justify-content:space-between; gap:2%;">
        <div class="col-md-3">
          <label for="monthSelect" class="form-label">Pilih Bulan</label>
          <select id="monthSelect" name="month" class="form-select">
            <option value="01" <?= (isset($_POST['month']) && $_POST['month'] == '01') ? 'selected' : ''; ?>>Januari
            </option>
            <option value="02" <?= (isset($_POST['month']) && $_POST['month'] == '02') ? 'selected' : ''; ?>>Februari
            </option>
            <option value="03" <?= (isset($_POST['month']) && $_POST['month'] == '03') ? 'selected' : ''; ?>>Maret</option>
            <option value="04" <?= (isset($_POST['month']) && $_POST['month'] == '04') ? 'selected' : ''; ?>>April</option>
            <option value="05" <?= (isset($_POST['month']) && $_POST['month'] == '05') ? 'selected' : ''; ?>>Mei</option>
            <option value="06" <?= (isset($_POST['month']) && $_POST['month'] == '06') ? 'selected' : ''; ?>>Juni</option>
            <option value="07" <?= (isset($_POST['month']) && $_POST['month'] == '07') ? 'selected' : ''; ?>>Juli</option>
            <option value="08" <?= (isset($_POST['month']) && $_POST['month'] == '08') ? 'selected' : ''; ?>>Agustus
            </option>
            <option value="09" <?= (isset($_POST['month']) && $_POST['month'] == '09') ? 'selected' : ''; ?>>September
            </option>
            <option value="10" <?= (isset($_POST['month']) && $_POST['month'] == '10') ? 'selected' : ''; ?>>Oktober
            </option>
            <option value="11" <?= (isset($_POST['month']) && $_POST['month'] == '11') ? 'selected' : ''; ?>>November
            </option>
            <option value="12" <?= (isset($_POST['month']) && $_POST['month'] == '12') ? 'selected' : ''; ?>>Desember
            </option>
          </select>
        </div>
        <div class="col-md-3">
          <label for="yearSelect" class="form-label">Pilih Tahun</label>
          <select id="yearSelect" name="year" class="form-select">
            <option value="2024" <?= (isset($_POST['year']) && $_POST['year'] == '2024') ? 'selected' : ''; ?>>2024
            </option>
            <option value="2023" <?= (isset($_POST['year']) && $_POST['year'] == '2023') ? 'selected' : ''; ?>>2023
            </option>
            <option value="2022" <?= (isset($_POST['year']) && $_POST['year'] == '2022') ? 'selected' : ''; ?>>2022
            </option>
          </select>
        </div>
        <div class="col-md-4 d-flex align-items-end">
          <button type="submit" id="generateReportButton" class="btn btn-primary w-100">Tampilkan Laporan</button>
        </div>
      </form>
    </div>


    <!-- Ringkasan Laporan -->
    <div class="row mb-4">
      <div class="col-md-4">
        <div class="card summary-card text-center p-3">
          <div class="card-body">
            <i class="icon-large text-primary bi bi-cart-fill"></i>
            <h6 class="card-title">Jumlah Total Transaksi per-bulan</h6>
            <h3 id="totalTransactions"><?= $data['jumlahTransaksi']['total_transaksi']; ?></h3>
          </div>
        </div>
      </div>
      <div class="col-md-4">
        <div class="card summary-card text-center p-3">
          <div class="card-body">
            <i class="icon-large text-success bi bi-star-fill"></i>
            <h6 class="card-title">Total Poin per-bulan</h6>
            <h3 id="totalPoints">
              <?php if (!isset($data['jumlahPoin']['total_poin'])):
                echo '0';
              else:
                echo $data['jumlahPoin']['total_poin'];
              endif;
              ?>
            </h3>
          </div>
        </div>
      </div>
      <div class="col-md-4">
        <div class="card summary-card text-center p-3">
          <div class="card-body">
            <i class="icon-large text-warning bi bi-basket-fill"></i>
            <h6 class="card-title">Total Berat Sampah per-bulan</h6>
            <h3 id="totalPoints">
              <?php if (!isset($data['jumlahBerat']['berat_sampah'])):
                echo '0';
              else:
                echo $data['jumlahBerat']['berat_sampah'];
              endif;
              ?>
            </h3>
          </div>
        </div>
      </div>
    </div>

    <!-- Tabel Detail Laporan -->
    <div class="table-responsive">
      <table class="table table-striped table-bordered">
        <thead class="table-dark">
          <tr>
            <th>Jenis Sampah</th>
            <th>Berat Total (Kg)</th>
            <th>Total Transaksi</th>
          </tr>
        </thead>
        <tbody id="reportTableBody">
          <?php if (!empty($data)): ?>
            <?php foreach ($data['tableLaporan'] as $Laporan): ?>
              <tr>
                <td><?= htmlspecialchars($Laporan['jenis']) ?></td>
                <td><?= htmlspecialchars($Laporan['total_berat']) ?></td>
                <td><?= htmlspecialchars($Laporan['total_transaksi']) ?></td>
              </tr>
            <?php endforeach; ?>
          <?php else: ?>
            <tr>
              <td colspan="6">Tidak ada data Laporan.</td>
            </tr>
          <?php endif; ?>
        </tbody>
      </table>
    </div>

    <!-- Tombol Cetak Laporan -->
    <div class="d-flex justify-content-end mt-4">
      <button id="printReportButton" class="btn btn-success">Cetak PDF</button>
    </div>
  </div>

  <!-- Bootstrap JS -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>
  <!-- Icons -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.js"></script>
  <!-- Script -->
  <script>
    document.getElementById("generateReportButton").addEventListener("click", function () {
      const month = document.getElementById("monthSelect").value;
      const year = document.getElementById("yearSelect").value;

      // Placeholder logic for fetching data
      // Data fetching can be replaced with AJAX or API integration
      document.getElementById("totalTransactions").textContent = 75; // Total transaksi
      document.getElementById("totalPoints").textContent = 1500; // Poin total
      document.getElementById("totalWeight").textContent = "80 Kg"; // Berat total sampah

      // Example data for table
      const data = [
        { jenis: "Plastik", berat: 50, poin: 500 },
        { jenis: "Kertas", berat: 30, poin: 300 },
      ];

      const tableBody = document.getElementById("reportTableBody");
      tableBody.innerHTML = data
        .map(
          (row) =>
            `<tr>
                <td>${row.jenis}</td>
                <td>${row.berat}</td>
                <td>${row.poin}</td>
              </tr>`
        )
        .join("");
    });

    document.getElementById("printReportButton").addEventListener("click", function () {
      window.print();
    });
  </script>
</body>

</html>