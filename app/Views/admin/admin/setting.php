<div class="container-fluid">
    <div class="row d-flex justify-content-around">
        <div class="col-12 col-md-6 bg-white rounded-4 mb-3">
            <h3 class="text-center mt-3">Akun Saya</h3>
            <?php if (session()->getFlashdata('success')) : ?>
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <?= session()->getFlashdata('success') ?>
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            <?php endif; ?>
            <?= validation_list_errors() ?>
            <form action="<?php echo base_url(); ?>ubah-password-admin" method="post" enctype="multipart/form-data">
                <div class="mb-3">
                    <label for="exampleFormControlInput1" class="form-label">Nama</label>
                    <input type="hidden" class="form-control" id="exampleFormControlInput1" name="id" value="<?= $id ?>" readonly>
                    <input type="input" class="form-control" id="exampleFormControlInput1" name="nama" value="<?= $nama ?>" readonly>

                    <label for="exampleFormControlInput2" class="form-label">Password Lama</label>
                    <input type="input" class="form-control" id="exampleFormControlInput2" name="password-lama" value="<?= $admin['password'] ?>" readonly>

                    <label for="exampleFormControlInput2" class="form-label">Password</label>
                    <input type="input" class="form-control" id="exampleFormControlInput2" name="password" value="<?= set_value('password') ?>">

                    <!-- <label for="exampleFormControlInput4" class="form-label">Gambar</label>
                    <input type="file" class="form-control-file" id="gambar" name="gambar" value="<?= set_value('gambar') ?>">
                    <div id="preview-container" style="display: none;">
                        <img id="preview" src="#" alt="Preview Gambar" style="max-width: 100%; max-height: 200px; margin-top: 10px;">
                    </div> -->
                    <button type="submit" name="submit" class="btn btn-primary ms-auto mb-2 mt-3">Ubah Password</button>

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