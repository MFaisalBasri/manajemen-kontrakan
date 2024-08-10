<div class="container-fluid">
    <div class="row d-flex justify-content-around mb-3">
        <div class="col-12 col-md-6 bg-white rounded-4">
            <h3 class="text-center mt-2">Bukti Pembayaran</h3>

            <div class="mb-3">
                <?php foreach ($pembayaran_list as $pembayaran_item) : ?>
                    <label for="exampleFormControlInput4" class="form-label">Bukti Pembayaran</label>
                    <!-- <input type="file" class="form-control-file" id="gambar" name="gambar" onchange="previewFile()"> -->
                    <div id="preview-container">
                        <?php if (!empty($pembayaran_item['bukti_pembayaran'])) : ?>
                            <img id="preview" src="<?= base_url('uploads/' . $pembayaran_item['bukti_pembayaran']) ?>" alt="Preview Gambar" style="max-width: 100%; max-height: 200px; margin-top: 10px;">
                        <?php endif; ?>
                    </div>

                    <a href="../data-pembayaran"><button type="" name="submit" class="btn btn-primary ms-auto mb-2 mt-3">Keluar</button></a>
                <?php endforeach ?>
            </div>
        </div>
    </div>
</div>
</div>

<script>
    function previewFile() {
        var preview = document.getElementById('preview');
        var file = document.querySelector('input[type=file]').files[0];
        var reader = new FileReader();

        reader.onloadend = function() {
            preview.src = reader.result;
        }

        if (file) {
            reader.readAsDataURL(file); // Baca file sebagai URL data
            document.getElementById('preview-container').style.display = 'block'; // Menampilkan container preview
        } else {
            preview.src = "";
            document.getElementById('preview-container').style.display = 'none'; // Menyembunyikan container preview jika tidak ada gambar dipilih
        }
    }
</script>