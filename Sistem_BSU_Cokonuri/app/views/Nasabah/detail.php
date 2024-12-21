<div class="container mt-5">

    <div class="card" style="width: 18rem;">
        <div class="card-body">
            <h5 class="card-title"> <?= $data['nasabah']['namaNasabah'] ?></h5>
            <h6 class="card-subtitle mb-2 text-body-secondary"> <?= $data['nasabah']['kontak'] ?></h6>
            <p class="card-text"><?= $data['nasabah']['alamat'] ?></p>
            <p class="card-text"><?= $data['nasabah']['jumlahTransaksi'] ?></p>
            <a href=" <?= BASEURL; ?> /Nasabah" class="card-link">Back</a>
        </div>
    </div>
</div>