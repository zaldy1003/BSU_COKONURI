<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title><?= $data['judul']; ?></title>
  <!-- Bootstrap CSS -->
  <link href="<?= BASEURL; ?>/css/bootstrap.css" rel="stylesheet" />
  <style>
    .stat-card {
      border-radius: 12px;
      box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
    }

    .icon-large {
      font-size: 2rem;
    }

    .wrapper {
      display: flex;
      justify-content: center;
      align-items: center;
      height: 100vh;
      /* Full height of the viewport */
      margin: 0;
    }

    /* body {
        
      } */
    footer {
      position: relative;
      bottom: 0%;
      left: 50%;
      /* Posisikan elemen di tengah secara horizontal */
      transform: translateX(-50%);
      /* Geser elemen ke kiri setengah lebarnya */
      background-color: #f8f9fa;
      padding: 1rem 0;
      text-align: center;
      font-size: 0.9rem;
      color: #6c757d;
    }
  </style>
</head>

<body class="bg-light">
  <div class="wrapper">
    <div class="card shadow-sm p-4" style="width: 100%; max-width: 400px">
      <h3 class="text-center mb-4">Login</h3>

      <!-- form login -->
      <form action="<?= BASEURL; ?>/login/index" method="POST">
        <div class="mb-3">
          <label for="username" class="form-label">Username</label>
          <input type="text" class="form-control" name="username" id="username" placeholder="Enter your username"
            required />
        </div>
        <div class="mb-3">
          <label for="password" class="form-label">Password</label>
          <input type="password" class="form-control" name="password" id="password" placeholder="Enter your password"
            required />
        </div>
        <div class="d-grid">
          <button type="submit" class="btn btn-primary mt-3">Login</button>
        </div>
      </form>
    </div>
  </div>

  <!-- Bootstrap JS -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>