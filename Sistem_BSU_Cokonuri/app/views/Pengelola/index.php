<div class="container mt-5">
  <h2 class="text-center mb-4">Kelola Pengelola</h2>

  <!-- Daftar Pengelola -->
  <div class="card shadow-sm mb-4">
    <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center">
      <h5 class="mb-0">Daftar Pengelola</h5>
      <button class="btn btn-light btn-sm" data-bs-toggle="modal" data-bs-target="#formModal">Tambah
        Pengelola</button>
    </div>
    <div class="card-body">
      <table class="table table-hover table-striped">
        <thead class="table-dark">
          <tr>
            <th>ID</th>
            <th>Username</th>
            <th>Kontak</th>
            <th>Aksi</th>
          </tr>
        </thead>
        <tbody>
          <!-- Contoh Data -->

          <?php if (!empty($data)): ?>
            <?php foreach ($data['pengelola'] as $pengelola): ?>
              <tr>
                <td><?= htmlspecialchars($pengelola['id']) ?></td>
                <td><?= htmlspecialchars($pengelola['username']) ?></td>
                <td><?= htmlspecialchars($pengelola['kontak']) ?></td>
                <td>
                  <button class="btn btn-warning btn-sm me-2">Edit</button>
                  <button class="btn btn-danger btn-sm">Hapus</button>
                </td>
              </tr>
            <?php endforeach; ?>
          <?php else: ?>
            <tr>
              <td colspan="6">Tidak ada data Pengelola.</td>
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
          <h5 class="modal-title" id="formModalLabel">Form Pengelola</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <form id="pengelolaForm">
            <div class="mb-3">
              <label for="nama" class="form-label">Nama</label>
              <input type="text" class="form-control" id="nama" required />
            </div>
            <div class="mb-3">
              <label for="username" class="form-label">Username</label>
              <input type="text" class="form-control" id="username" required />
            </div>
            <div class="mb-3">
              <label for="password" class="form-label">Password</label>
              <input type="password" class="form-control" id="password" required />
            </div>
            <div class="mb-3">
              <label for="kontak" class="form-label">Kontak</label>
              <input type="text" class="form-control" id="kontak" required />
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
  const form = document.getElementById("pengelolaForm");
  const resetButton = document.getElementById("resetForm");

  form.addEventListener("submit", (e) => {
    e.preventDefault();
    alert("Pengelola berhasil disimpan! (Integrasikan dengan backend untuk penyimpanan data)");
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