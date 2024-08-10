<div class="container-fluid">
    <div class="row d-flex justify-content-around">
        <div class="col-12 col-md-6 bg-white rounded-4 mb-3">
            <h3 class="text-center mt-3">Tambah Data Kamar</h3>

            <?php if (session()->getFlashdata('error')) : ?>
                <div class="alert alert-danger" role="alert">
                    <?= session()->getFlashdata('error') ?>
                </div>
            <?php endif; ?>
            <?= validation_list_errors() ?>
            <form action="<?php echo base_url(); ?>tambah-kamar" method="post" enctype="multipart/form-data">
                <div class="mb-3">
                    <label for="exampleFormControlInput1" class="form-label">Kode Kamar</label>
                    <input type="input" class="form-control" id="exampleFormControlInput1" name="kode_kamar" value="<?= set_value('kode_kamar') ?>">

                    <label for="exampleFormControlInput1" class="form-label">Nomor Kamar</label>
                    <input type="input" class="form-control" id="exampleFormControlInput1" name="nomor_kamar" value="<?= set_value('nomor_kamar') ?>">

                    <label for="exampleFormControlInput1" class="form-label">Nama Kamar</label>
                    <input type="input" class="form-control" id="exampleFormControlInput1" name="nama_kamar" value="<?= set_value('nama_kamar') ?>">

                    <label for="exampleFormControlInput3" class="form-label">Fasilitas</label>
                    <input type="input" class="form-control" id="exampleFormControlInput3" name="fasilitas" value="<?= set_value('fasilitas') ?>">

                    <label for="exampleFormControlInput3" class="form-label">Luas</label>
                    <input type="input" class="form-control" id="exampleFormControlInput3" name="luas" value="<?= set_value('luas') ?>">

                    <label for="exampleFormControlInput2" class="form-label">Harga</label>
                    <input type="input" class="form-control" id="exampleFormControlInput2" name="harga" value="<?= set_value('harga') ?>">

                    <label for="exampleFormControlInput3" class="form-label">Status</label>
                    <select class="form-control" id="exampleFormControlInput3" name="status">
                        <option value="digunakan" <?= set_select('status', 'digunakan') ?>>Digunakan</option>
                        <option value="tersedia" <?= set_select('status', 'tersedia') ?>>Tersedia</option>
                    </select>


                    <label for="exampleFormControlInput3" class="form-label">Alamat</label>
                    <input type="input" class="form-control" id="exampleFormControlInput3" name="alamat" value="<?= set_value('alamat') ?>">

                    <label for="exampleFormControlInput3" class="form-label">Kontak</label>
                    <input type="input" class="form-control" id="exampleFormControlInput3" name="kontak" value="<?= set_value('kontak') ?>">

                    <label for="exampleFormControlInput4" class="form-label">Gambar</label>
                    <input type="file" class="form-control-file" id="gambar" name="gambar" value="<?= set_value('gambar') ?>">
                    <div id="preview-container" style="display: none;">
                        <img id="preview" src="#" alt="Preview Gambar" style="max-width: 100%; max-height: 200px; margin-top: 10px;">
                    </div>
                    <button type="submit" name="submit" class="btn btn-primary ms-auto mb-2 mt-1">Tambah</button>

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