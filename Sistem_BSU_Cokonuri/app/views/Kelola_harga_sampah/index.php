<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Kelola Harga Sampah</title>
  <!-- Bootstrap CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" />
  <style>
    body {
      background-color: #f8f9fa;
      /* Warna latar bersih */
    }

    .modal-header {
      background-color: #0d6efd;
      /* Warna biru Bootstrap */
      color: white;
    }
  </style>
</head>

<body>
  <div class="container mt-5">
    <h2 class="text-center mb-4">Kelola Harga Sampah</h2>

    <!-- Daftar Harga Sampah -->
    <div class="card shadow-sm mb-4">
      <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center">
        <h5 class="mb-0">Daftar Harga Sampah</h5>
        <button class="btn btn-light btn-sm" data-bs-toggle="modal" data-bs-target="#formModal">Tambah Sampah
          Baru</button>
      </div>
      <div class="card-body">
        <table class="table table-hover table-striped">
          <thead class="table-dark">
            <tr>
              <th>ID</th>
              <th>Nama Sampah</th>
              <th>Harga per Kg (Rp)</th>
              <th>Aksi</th>
            </tr>
          </thead>
          <tbody>
            <!-- Contoh Data -->
            <tr>
              <td>1</td>
              <td>Plastik</td>
              <td>5,000</td>
              <td>
                <button class="btn btn-warning btn-sm me-2">Edit</button>
                <button class="btn btn-danger btn-sm">Hapus</button>
              </td>
            </tr>
            <?php if (!empty($data)): ?>
              <?php foreach ($data['jenisSampah'] as $sampah): ?>
                <tr>
                  <td><?= htmlspecialchars($sampah['id']) ?></td>
                  <td><?= htmlspecialchars($sampah['jenisSampah']) ?></td>
                  <td><?= htmlspecialchars($sampah['hargaPerKG']) ?></td>
                  <td>
                    <button class="btn btn-warning btn-sm me-2">Edit</button>
                    <button class="btn btn-danger btn-sm">Hapus</button>
                    <!-- <a href="<?= BASEURL; ?> /Nasabah/detail/<?= $nasabah['id'] ?>"><button
                        class="btn btn-info btn-sm">Detail</button></a> -->
                  </td>
                </tr>
              <?php endforeach; ?>
            <?php else: ?>
              <tr>
                <td colspan="4">Tidak ada data nasabah.</td>
              </tr>
            <?php endif; ?>
          </tbody>
        </table>
      </div>
    </div>

    <!-- Modal Form -->
    <div class="modal fade" id="formModal" tabindex="-1" aria-labelledby="formModalLabel" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="formModalLabel">Form Harga Sampah</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
            <form id="hargaForm">
              <div class="mb-3">
                <label for="jenisSampah" class="form-label">Jenis Sampah</label>
                <input type="text" class="form-control" id="jenisSampah" required />
              </div>
              <div class="mb-3">
                <label for="hargaSampah" class="form-label">Harga per Kg (Rp)</label>
                <input type="number" class="form-control" id="hargaSampah" required />
              </div>
              <div class="d-flex justify-content-between">
                <button type="button" id="resetForm" class="btn btn-secondary">Hapus Semua Input</button>
                <button type="submit" class="btn btn-primary">Simpan</button>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>

  <!-- Bootstrap JS -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>
  <!-- Script -->
  <script>
    const form = document.getElementById("hargaForm");
    const resetButton = document.getElementById("resetForm");

    form.addEventListener("submit", (e) => {
      e.preventDefault();
      alert("Harga sampah berhasil disimpan! (Integrasikan dengan backend untuk penyimpanan data)");
      form.reset();
      const modal = bootstrap.Modal.getInstance(document.getElementById("formModal"));
      modal.hide();
    });

    resetButton.addEventListener("click", () => {
      form.reset();
    });
  </script>
</body>

</html>