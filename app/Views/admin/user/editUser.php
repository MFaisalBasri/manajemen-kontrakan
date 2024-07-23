<div class="container-fluid">
    <h3 class="text-center">Edit Data User</h3>
    <div class="row d-flex justify-content-around">
        <div class="col-12 col-md-6 bg-white">

            <form action="<?php echo base_url(); ?>edit-user" method="post" enctype="multipart/form-data">
                <div class="mb-3">
                    <input type="hidden" class="form-control" id="exampleFormControlInput1" name="id" value="<?= esc($user_list['id']) ?>">
                    <label for="exampleFormControlInput1" class="form-label">Nama</label>
                    <input type="input" class="form-control" id="exampleFormControlInput1" name="nama" value="<?= esc($user_list['nama']) ?>">

                    <label for="exampleFormControlInput1" class="form-label">Password</label>
                    <input type="input" class="form-control" id="exampleFormControlInput1" name="password" value="<?= esc($user_list['password']) ?>">

                    <label for="role" class="form-label">Role</label>
                    <select class="form-control" id="role" name="role">
                        <option value="admin" <?= ($user_list['role'] == 'admin') ? 'selected' : '' ?>>Admin</option>
                        <option value="user" <?= ($user_list['role'] == 'user') ? 'selected' : '' ?>>User</option>
                    </select>


                    <button type="submit" name="submit" class="btn btn-primary ms-auto mb-2 mt-1">Edit</button>
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