<div class="container-fluid">
    <h3 class="text-center">Konfirmasi Bukti Pembayaran</h3>
    <div class="row d-flex justify-content-around">
        <div class="col-12 col-md-6 bg-white">

            <form action="<?php echo base_url(); ?>edit-kamar" method="post" enctype="multipart/form-data">
                <div class="mb-3">
                    <?php foreach ($pembayaran_list as $pembayaran_item) : ?>
                        <label for="exampleFormControlInput4" class="form-label">Bukti Pembayaran</label>
                        <!-- <input type="file" class="form-control-file" id="gambar" name="gambar" onchange="previewFile()"> -->
                        <div id="preview-container">
                            <?php if (!empty($pembayaran_item['bukti_pembayaran'])) : ?>
                                <img id="preview" src="<?= base_url('uploads/' . $pembayaran_item['bukti_pembayaran']) ?>" alt="Preview Gambar" style="max-width: 100%; max-height: 200px; margin-top: 10px;">
                            <?php endif; ?>
                        </div>

                        <button type="submit" name="submit" class="btn btn-primary ms-auto mb-2 mt-1">Setujui</button>
                    <?php endforeach ?>
                </div>
            </form>
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