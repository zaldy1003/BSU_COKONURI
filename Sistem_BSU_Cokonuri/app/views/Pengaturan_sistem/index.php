<div class="container">
  <!-- Form Login Password -->
  <div id="passwordPrompt" class="d-flex flex-column jsut=" style="margin-top: 50%">
    <h3 class="mb-4">Masukkan Kata Sandi</h3>
    <div class="col-md-4">
      <input type="password" id="passwordInput" class="form-control mb-3" placeholder="Kata Sandi" />
      <button id="submitPassword" class="btn btn-primary w-100">Masuk</button>
    </div>
    <p id="errorMessage" class="text-danger mt-3" style="display: none">Kata sandi salah, coba lagi.</p>
  </div>

  <!-- Halaman Pengaturan -->
  <div id="settingsPage" class="d-none">
    <h2 class="mb-4">Pengaturan Sistem</h2>

    <!-- Informasi Organisasi -->
    <div class="mb-4">
      <h4>Informasi Organisasi</h4>
      <form id="organizationForm">
        <div class="mb-3">
          <label for="orgName" class="form-label">Nama Organisasi</label>
          <input type="text" id="orgName" class="form-control" placeholder="Masukkan nama organisasi" />
        </div>
        <div class="mb-3">
          <label for="orgContact" class="form-label">Kontak</label>
          <input type="text" id="orgContact" class="form-control" placeholder="Masukkan kontak" />
        </div>
        <div class="mb-3">
          <label for="orgAddress" class="form-label">Alamat</label>
          <textarea id="orgAddress" class="form-control" rows="3" placeholder="Masukkan alamat"></textarea>
        </div>
      </form>
    </div>

    <!-- Pengaturan Global -->
    <div class="mb-4">
      <h4>Pengaturan Global</h4>
      <form>
        <div class="mb-3">
          <label for="pointsPerKg" class="form-label">Jumlah Poin per Kilogram Sampah</label>
          <input type="number" id="pointsPerKg" class="form-control" placeholder="Masukkan jumlah poin" />
        </div>
      </form>
    </div>

    <button id="saveSettings" class="btn btn-success">Simpan Pengaturan</button>
  </div>
</div>

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>
<script>
  const correctPassword = "admin123"; // Kata sandi untuk login

  // Fungsi untuk menampilkan halaman pengaturan jika kata sandi benar
  document.getElementById("submitPassword").addEventListener("click", function () {
    const enteredPassword = document.getElementById("passwordInput").value;
    if (enteredPassword === correctPassword) {
      document.getElementById("passwordPrompt").classList.add("d-none");
      document.getElementById("settingsPage").classList.remove("d-none");
      loadSettings();
    } else {
      document.getElementById("errorMessage").style.display = "block";
    }
  });

  // Fungsi untuk menyimpan data ke localStorage
  document.getElementById("saveSettings").addEventListener("click", function () {
    const orgName = document.getElementById("orgName").value;
    const orgContact = document.getElementById("orgContact").value;
    const orgAddress = document.getElementById("orgAddress").value;

    const systemData = {
      systemName: orgName,
      contact: orgContact,
      address: orgAddress,
    };

    localStorage.setItem("systemData", JSON.stringify(systemData));
    alert("Pengaturan berhasil disimpan!");
  });

  // Fungsi untuk memuat data dari localStorage ke dalam form
  function loadSettings() {
    const savedData = JSON.parse(localStorage.getItem("systemData"));
    if (savedData) {
      document.getElementById("orgName").value = savedData.systemName || "";
      document.getElementById("orgContact").value = savedData.contact || "";
      document.getElementById("orgAddress").value = savedData.address || "";
    }
  }
</script>
</body>

</html>