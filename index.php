<?php
session_start();

$page = 'Beranda';
?>

<?php include('_top.php'); ?>

<div class="col-lg-10">
    <!-- Content -->
    <div class="card rounded-3 border-0">
        <div class="card-header border-0 text-bg-primary rounded-top-3 fw-semibold py-3">
            <h5 class="my-auto"><?= ucfirst($page); ?></h5>
        </div>
        <div class="card-body border border-top-0 rounded-bottom-3">
            <h4 class="card-title mb-3">Selamat Datang</h4>
            <p class="card-text mb-3">Website ini dibuat untuk memenuhi tugas akhir mata kuliah Pemrograman Web, dengan fokus pada studi kasus <span class="fw-semibold">Data Kependudukan</span>. Situs ini mencakup implementasi fitur CRUD (Cread, Read, Update dan Delete) serta sistem login yang sederhana.</p>
            <div class="d-flex flex-column gap-1">
                <small>Dibuat oleh:</small>
                <span class="fw-semibold">Alfian</span>
            </div>
        </div>
    </div>
    <!-- End of content -->
</div>

<?php include('_bottom.php'); ?>