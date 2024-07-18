<div class="container-fluid">
    <h1>Welcome, <?= $nama; ?>!</h1>
    <p>Your role: <?= $role; ?></p>
    <h3 class="text-center">Akun Saya</h3>
    <div class="row d-flex justify-content-around">
        <div class="col-12 col-md-6 bg-white">

            <?php if (session()->getFlashdata('error')) : ?>
                <div class="alert alert-danger" role="alert">
                    <?= session()->getFlashdata('error') ?>
                </div>
            <?php endif; ?>
            <?= validation_list_errors() ?>
            <form action="<?php echo base_url(); ?>tambah-penghuni" method="post" enctype="multipart/form-data">
                <div class="mb-3">
                    <label for="exampleFormControlInput1" class="form-label">Nama</label>
                    <input type="input" class="form-control" id="exampleFormControlInput1" name="nama" value="<?= $nama ?>" readonly>

                    <label for="exampleFormControlInput2" class="form-label">Password</label>
                    <input type="input" class="form-control" id="exampleFormControlInput2" name="password" value="<?= $password ?>">

                    <!-- <label for="exampleFormControlInput4" class="form-label">Gambar</label>
                    <input type="file" class="form-control-file" id="gambar" name="gambar" value="<?= set_value('gambar') ?>">
                    <div id="preview-container" style="display: none;">
                        <img id="preview" src="#" alt="Preview Gambar" style="max-width: 100%; max-height: 200px; margin-top: 10px;">
                    </div> -->
                    <button type="submit" name="submit" class="btn btn-primary ms-auto mb-2 mt-1">Ubah Password</button>

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