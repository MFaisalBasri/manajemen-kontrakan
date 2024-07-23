<div class="container-fluid">
    <h3 class="text-center">Tambah Data Admin</h3>
    <div class="row d-flex justify-content-around">
        <div class="col-12 col-md-6 bg-white">

            <?php if (session()->getFlashdata('error')) : ?>
                <div class="alert alert-danger" role="alert">
                    <?= session()->getFlashdata('error') ?>
                </div>
            <?php endif; ?>
            <form action="<?php echo base_url(); ?>tambah-admin" method="post" enctype="multipart/form-data">
                <div class="mb-3">
                    <label for="exampleFormControlInput3" class="form-label">Nama</label>
                    <input type="input" class="form-control" id="exampleFormControlInput3" name="nama" value="<?= set_value('nama') ?>">

                    <label for="exampleFormControlInput3" class="form-label">Password</label>
                    <input type="input" class="form-control" id="exampleFormControlInput3" name="password" value="<?= set_value('password') ?>">

                    <label for="exampleFormControlInput2" class="form-label">Role</label>
                    <input type="input" class="form-control" id="exampleFormControlInput2" name="role" value="Admin" readonly>

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