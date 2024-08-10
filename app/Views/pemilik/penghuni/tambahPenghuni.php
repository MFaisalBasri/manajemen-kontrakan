<div class="container-fluid">
    <div class="row d-flex justify-content-around">
        <div class="col-12 col-md-6 bg-white rounded-4 mb-3">
            <h3 class="text-center mt-3">Tambah Data Penghuni</h3>

            <?php if (session()->getFlashdata('error')) : ?>
                <div class="alert alert-danger" role="alert">
                    <?= session()->getFlashdata('error') ?>
                </div>
            <?php endif; ?>
            <?= validation_list_errors() ?>
            <form action="<?php echo base_url(); ?>tambah-penghuni" method="post" enctype="multipart/form-data">
                <div class="mb-3">
                    <label for="exampleFormControlInput1" class="form-label">NIK</label>
                    <input type="input" class="form-control" id="exampleFormControlInput1" name="nik" value="<?= set_value('nik') ?>">

                    <label for="exampleFormControlInput1" class="form-label">Nama</label>
                    <input type="input" class="form-control" id="exampleFormControlInput1" name="nama" value="<?= set_value('nama') ?>">

                    <label for="exampleFormControlInput3" class="form-label">Tanggal Lahir</label>
                    <input type="date" class="form-control" id="exampleFormControlInput3" name="tanggal_lahir" value="<?= set_value('tanggal_lahir') ?>">

                    <label for="exampleFormControlInput3" class="form-label">No HP</label>
                    <input type="input" class="form-control" id="exampleFormControlInput3" name="no_hp" value="<?= set_value('no_hp') ?>">

                    <label for="exampleFormControlInput2" class="form-label">Pekerjaan</label>
                    <input type="input" class="form-control" id="exampleFormControlInput2" name="pekerjaan" value="<?= set_value('pekerjaan') ?>">

                    <label for="exampleFormControlInput2" class="form-label">Tujuan</label>
                    <input type="input" class="form-control" id="exampleFormControlInput2" name="tujuan" value="<?= set_value('tujuan') ?>">

                    <p style="color: red;"><small>*masukan email yang telah terdaftar!</small></p>

                    <label for="exampleFormControlInput1" class="form-label">Email</label>
                    <input type="input" class="form-control" id="exampleFormControlInput1" name="email">

                    <button type="submit" name="submit" class="btn btn-primary ms-auto mb-2 mt-3">Tambah</button>

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