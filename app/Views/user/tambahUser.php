<div class="container-fluid">
    <h3 class="text-center">Tambah Data User</h3>
    <div class="row d-flex justify-content-around">
        <div class="col-12 col-md-6 bg-white">

            <?php if (session()->getFlashdata('error')) : ?>
                <div class="alert alert-danger" role="alert">
                    <?= session()->getFlashdata('error') ?>
                </div>
            <?php endif; ?>
            <form action="<?php echo base_url(); ?>tambah-user" method="post" enctype="multipart/form-data">
                <div class="mb-3">
                    <label for="nama_penghuni" class="form-label">Nama Penghuni</label>
                    <select name="nama" class="form-select" aria-label="Default select example">
                        <?php foreach ($penghuni_list as $user_item) : ?>
                            <option value="<?php echo htmlspecialchars($user_item['id']); ?>">
                                <?php echo htmlspecialchars($user_item['nama']); ?>
                            </option>
                        <?php endforeach; ?>
                    </select>

                    <label for="exampleFormControlInput3" class="form-label">password</label>
                    <input type="input" class="form-control" id="exampleFormControlInput3" name="password" value="<?= set_value('password') ?>">

                    <label for="exampleFormControlInput2" class="form-label">Role</label>
                    <input type="input" class="form-control" id="exampleFormControlInput2" name="role" value="<?= set_value('role') ?>">

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