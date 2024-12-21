<?php
require_once '../app/config/db.php';
require_once '../app/models/Nasabah_model.php';
require_once '../app/controllers/Nasabah_controller.php';

// Buat instance model dan controller
$model = new Nasabah_model($db);
$controller = new NasabahController($model);

// Panggil fungsi index
$controller->index();
