<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Kelola Nasabah</title>
  <!-- Bootstrap CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" />
</head>

<body>
  <!-- <?= var_dump($data) ?> -->
  <div class="container mt-5">
    <h2 class="text-center mb-4">Kelola Nasabah</h2>

    <!-- Daftar Nasabah -->
    <div class="card shadow-sm mb-4">
      <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center">
        <h5 class="mb-0">Daftar Nasabah</h5>
        <button class="btn btn-light btn-sm" data-bs-toggle="modal" data-bs-target="#formModal">Tambah Nasabah</button>
      </div>
      <div class="card-body">
        <table class="table table-hover table-striped">
          <thead class="table-dark">
            <tr>
              <th>ID</th>
              <th>Nama</th>
              <th>Kontak</th>
              <th>Alamat</th>
              <th>Jumlah Transaksi</th>
              <th>Aksi</th>
            </tr>
          </thead>
          <tbody>
            <!-- Contoh Data -->

            <?php if (!empty($data)): ?>
              <?php foreach ($data['nasabah'] as $nasabah): ?>
                <tr>
                  <td><?= htmlspecialchars($nasabah['id']) ?></td>
                  <td><?= htmlspecialchars($nasabah['namaNasabah']) ?></td>
                  <td><?= htmlspecialchars($nasabah['kontak']) ?></td>
                  <td><?= htmlspecialchars($nasabah['alamat']) ?></td>
                  <td><?= htmlspecialchars($nasabah['jumlahTransaksi']) ?></td>
                  <td>
                    <!-- edit button pop up -->
                    <button class="btn btn-warning btn-sm me-2 edit-btn" data-id="<?= htmlspecialchars($nasabah['id']) ?>"
                      data-nama="<?= htmlspecialchars($nasabah['namaNasabah']) ?>"
                      data-kontak="<?= htmlspecialchars($nasabah['kontak']) ?>"
                      data-alamat="<?= htmlspecialchars($nasabah['alamat']) ?>"
                      data-transaksi="<?= htmlspecialchars($nasabah['jumlahTransaksi']) ?>">
                      Edit
                    </button>

                    <button class="btn btn-danger btn-sm">Hapus</button>
                    <a href="<?= BASEURL; ?> /Nasabah/detail/<?= $nasabah['id'] ?>"><button
                        class="btn btn-info btn-sm">Detail</button></a>
                  </td>
                </tr>
              <?php endforeach; ?>
            <?php else: ?>
              <tr>
                <td colspan="6">Tidak ada data nasabah.</td>
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
            <h5 class="modal-title" id="formModalLabel">Form Nasabah</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
            <form id="nasabahForm">
              <!-- Hidden field for ID (only used for edit) -->
              <input type="hidden" id="nasabahId" />

              <div class="mb-3">
                <label for="nama" class="form-label">Nama</label>
                <input type="text" class="form-control" id="nama" required />
              </div>
              <div class="mb-3">
                <label for="kontak" class="form-label">Kontak</label>
                <input type="number" class="form-control" id="umur" required />
              </div>
              <div class="mb-3">
                <label for="alamat" class="form-label">Alamat</label>
                <textarea class="form-control" id="alamat" rows="3" required></textarea>
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

    <!-- Script -->
    <script>
      const form = document.getElementById("nasabahForm");
      const resetButton = document.getElementById("resetForm");

      // Handle form submission
      form.addEventListener("submit", (e) => {
        e.preventDefault();
        const id = document.getElementById("nasabahId").value;
        const nama = document.getElementById("nama").value;
        const umur = document.getElementById("kontak").value;
        const alamat = document.getElementById("alamat").value;

        if (id) {
          alert(`Data nasabah dengan ID ${id} berhasil diperbarui!`);
          // Integrasikan dengan backend untuk update data nasabah
        } else {
          alert("Nasabah baru berhasil disimpan!");
          // Integrasikan dengan backend untuk menyimpan data nasabah baru
        }

        form.reset();
        const modal = bootstrap.Modal.getInstance(document.getElementById("formModal"));
        modal.hide();
      });

      resetButton.addEventListener("click", () => {
        form.reset();
      });

      // Populate modal for edit
      document.querySelectorAll(".edit-btn").forEach((button) => {
        button.addEventListener("click", (e) => {
          const id = e.target.getAttribute("data-id");
          const nama = e.target.getAttribute("data-nama");
          const umur = e.target.getAttribute("data-kontak");
          const alamat = e.target.getAttribute("data-alamat");

          document.getElementById("nasabahId").value = id;
          document.getElementById("nama").value = nama;
          document.getElementById("umur").value = umur;
          document.getElementById("alamat").value = alamat;

          // Update modal title
          document.getElementById("formModalLabel").textContent = "Edit Nasabah";

          // Open modal
          const modal = new bootstrap.Modal(document.getElementById("formModal"));
          modal.show();
        });
      });
    </script>

</body>

</html>