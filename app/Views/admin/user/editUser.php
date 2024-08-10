<div class="container-fluid">
    <div class="row d-flex justify-content-around">
        <div class="col-12 col-md-6 bg-white rounded-4">
            <h3 class="text-center mt-3">Edit Data User</h3>

            <form action="<?php echo base_url(); ?>edit-user" method="post" enctype="multipart/form-data">
                <div class="mb-3">
                    <?php foreach ($user_list as $user) : ?>
                        <label for="exampleFormControlInput1" class="form-label">Nama</label>
                        <input type="hidden" class="form-control" id="exampleFormControlInput1" name="id" value="<?= $user['id'] ?>">
                        <input type="input" class="form-control" id="exampleFormControlInput1" name="nama" value="<?= $user['nama'] ?>">

                        <label for="exampleFormControlInput3" class="form-label">No HP</label>
                        <input type="input" class="form-control" id="exampleFormControlInput3" name="no_hp" value="<?= $user['no_hp'] ?>">

                        <label for="exampleFormControlInput2" class="form-label">Email</label>
                        <input type="input" class="form-control" id="exampleFormControlInput2" name="email" value="<?= $user['email']  ?>">

                        <label for="exampleFormControlInput2" class="form-label">Password</label>
                        <input type="input" class="form-control" id="exampleFormControlInput2" name="password" value="<?= $user['password'] ?>">

                        <label for="exampleFormControlInput3" class="form-label">Daftar Sebagai :</label>
                        <select class="form-control" id="exampleFormControlInput3" name="status">
                            <option value="penyewa" <?= ($user['status'] === 'penyewa') ? 'selected' : '' ?>>Penyewa</option>
                            <option value="pemilik" <?= ($user['status'] === 'pemilik') ? 'selected' : '' ?>>Pemilik</option>
                        </select>


                        <button type="submit" name="submit" class="btn btn-primary ms-auto mb-2 mt-1">Edit</button>
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