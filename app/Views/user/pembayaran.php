<div class="container-fluid">
    <h3>Bayar Tagihan Kamar</h3>
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
                    <?php foreach ($tagihan_list as $tagihan_item) : ?>
                        <input type="input" class="form-control" id="exampleFormControlInput1" name="id_penghuni" value="<?= esc($id_penghuni) ?>" readonly>
                        <label for="exampleFormControlInput1" class="form-label">Nama</label>

                        <input type="input" class="form-control" id="exampleFormControlInput1" name="id_tagihan" value="<?= esc($tagihan_item['id']) ?>" readonly>
                        <input type="input" class="form-control" id="exampleFormControlInput1" name="nama_kamar" value="<?= esc($tagihan_item['nama_penghuni']) ?>" readonly>

                        <label for="exampleFormControlInput1" class="form-label">Nomor Kamar</label>
                        <input type="input" class="form-control" id="exampleFormControlInput1" name="nomor_kamar" value="<?= esc($tagihan_item['nomor_kamar']) ?>" readonly>

                        <label for="exampleFormControlInput3" class="form-label">Bulan</label>
                        <input type="input" class="form-control" id="exampleFormControlInput3" name="bulan" value="<?= esc($tagihan_item['bulan']) ?>" readonly>

                        <label for="exampleFormControlInput2" class="form-label">Harga</label>
                        <input type="text" class="form-control" id="exampleFormControlInput2" name="harga" value="<?= 'Rp. ' . number_format($tagihan_item['harga'], 0, ',', '.'); ?>" readonly>

                        <label for="exampleFormControlInput4" class="form-label">Bukti Pembayaran</label>
                        <input type="file" class="form-control-file" id="gambar" name="bukti" value="<?= set_value('bukti') ?>">
                        <div id="preview-container" style="display: none;">
                            <img id="preview" src="#" alt="Preview Gambar" style="max-width: 100%; max-height: 200px; margin-top: 10px;">
                        </div>
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