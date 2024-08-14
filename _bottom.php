</section>
</main>
<!-- End of main -->

<!-- Footer -->
<footer class="container border-top mt-3 py-3">
    <div class="row">
        <div class="col text-center">
            &copy; <?= date('Y'); ?> Universitas Teknologi Mataram
        </div>
    </div>
</footer>
<!-- End of footer -->

<!-- General JS -->
<script src="https://code.jquery.com/jquery-3.7.1.min.js"
    integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
    crossorigin="anonymous"></script>

<?php if ($page == 'Data'): ?>
    <!-- Plugin -->
    <script src="https://cdn.datatables.net/2.1.3/js/dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/2.1.3/js/dataTables.bootstrap5.min.js"></script>
    <script src="assets/js/language.dataTables.js"></script>
<?php endif ?>

<!-- Custom JS -->
<script src="assets/js/script.js"></script>

<?php if ($page == 'Tambah Data' || $page == 'Ubah Data'): ?>
    <script>
        function previewImage() {
            const inputFile = document.querySelector('#img_file');
            const imgPreview = document.querySelector('#img-file-preview');

            if (inputFile && inputFile.files && inputFile.files[0]) {
                const file = inputFile.files[0];
                const fileReader = new FileReader();

                if (file.type.startsWith('image/')) {
                    fileReader.readAsDataURL(file);

                    fileReader.onload = function(e) {
                        imgPreview.src = e.target.result;
                    };
                } else {
                    imgPreview.src = 'assets/img/no-image-placeholder.png';
                }
            }
        }
    </script>
<?php endif ?>
</body>

</html>