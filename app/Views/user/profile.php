<div class="container-fluid">
    <div class="row d-flex justify-content-around">
        <div class="col-12 col-md-6 bg-white rounded-4 mb-3">
            <h3 class="text-center mt-3">Profile Saya</h3>

            <?php if (session()->getFlashdata('success')) : ?>
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <?= session()->getFlashdata('success') ?>
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            <?php endif; ?>
            <?= validation_list_errors() ?>
            <form action="<?php echo base_url(); ?>edit-profile" method="post" enctype="multipart/form-data">
                <div class="mb-3">
                    <input type="hidden" class="form-control" id="exampleFormControlInput1" name="id" value="<?= esc($penghuni['id']) ?>">
                    <label for="exampleFormControlInput1" class="form-label">NIK</label>
                    <input type="input" class="form-control" id="exampleFormControlInput1" name="nik" value="<?= esc($penghuni['nik']) ?>" readonly>

                    <label for="exampleFormControlInput1" class="form-label">Nama</label>
                    <input type="input" class="form-control" id="exampleFormControlInput1" name="nama" value="<?= esc($penghuni['nama']) ?>">

                    <label for="exampleFormControlInput1" class="form-label">Tanggal Lahir</label>
                    <input type="date" class="form-control" id="exampleFormControlInput1" name="tanggal_lahir" value="<?= esc($penghuni['tgl_lahir']) ?>">

                    <label for="exampleFormControlInput1" class="form-label">No HP</label>
                    <input type="input" class="form-control" id="exampleFormControlInput1" name="no_hp" value="<?= esc($penghuni['no_hp']) ?>">

                    <label for="exampleFormControlInput1" class="form-label">Pekerjaan</label>
                    <input type="input" class="form-control" id="exampleFormControlInput1" name="pekerjaan" value="<?= esc($penghuni['pekerjaan']) ?>">

                    <label for="exampleFormControlInput1" class="form-label">Tujuan</label>
                    <input type="input" class="form-control" id="exampleFormControlInput1" name="tujuan" value="<?= esc($penghuni['tujuan']) ?>">
                    <!-- <label for="exampleFormControlInput4" class="form-label">Gambar</label>
                    <input type="file" class="form-control-file" id="gambar" name="gambar" value="<?= set_value('gambar') ?>">
                    <div id="preview-container" style="display: none;">
                        <img id="preview" src="#" alt="Preview Gambar" style="max-width: 100%; max-height: 200px; margin-top: 10px;">
                    </div> -->
                    <button type="submit" name="submit" class="btn btn-primary ms-auto mb-2 mt-3">Ubah Profil</button>

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