<div class="container-fluid">
    <h3>Upload Ulang Bukti Pembayaran</h3>
    <div class="row d-flex justify-content-around">
        <div class="col-12 col-md-6 bg-white">

            <?php if (session()->getFlashdata('error')) : ?>
                <div class="alert alert-danger" role="alert">
                    <?= session()->getFlashdata('error') ?>
                </div>
            <?php endif; ?>
            <?= validation_list_errors() ?>
            <form action="<?php echo base_url(); ?>bayar-tagihan" method="post" enctype="multipart/form-data">
                <div class="mb-3">
                    <?php foreach ($pembayaran_list as $pembayaran) : ?>
                        <label for="exampleFormControlInput1" class="form-label">Nama</label>
                        <input type="input" class="form-control" id="exampleFormControlInput1" name="id_tagihan" value="<?= esc($pembayaran['id']) ?>" readonly>
                        <input type="input" class="form-control" id="exampleFormControlInput1" name="nama_kamar" value="<?= esc($pembayaran['bukti_pembayaran']) ?>" readonly>

                        <button type="submit" name="submit" class="btn btn-primary ms-auto mb-2 mt-1">Bayar</button>
                    <?php endforeach ?>
                </div>
            </form>
        </div>
    </div>
</div>
</div>

<script>
    document.getElementById('gambar').onchange = function(e) {
        let preview = document.getElementById('preview');
        preview.src = URL.createObjectURL(this.files[0]);
        preview.onload = function() {
            URL.revokeObjectURL(preview.src); // Membebaskan memori
        }
        document.getElementById('preview-container').style.display = 'block'; // Menampilkan container preview
    };
</script>