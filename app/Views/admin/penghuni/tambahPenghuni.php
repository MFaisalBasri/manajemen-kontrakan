<div class="container-fluid">
    <h3 class="text-center">Input Data Penghuni</h3>
    <div class="row d-flex justify-content-around">
        <div class="col-12 col-md-6 bg-white">

            <?php if (session()->getFlashdata('error')) : ?>
                <div class="alert alert-danger" role="alert">
                    <?= session()->getFlashdata('error') ?>
                </div>
            <?php endif; ?>
            <?= validation_list_errors() ?>
            <form action="/tambah-penghuni" method="post" enctype="multipart/form-data">
                <div class="mb-3">
                    <label for="exampleFormControlInput1" class="form-label">Nama</label>
                    <input type="input" class="form-control" id="exampleFormControlInput1" name="nama" value="<?= set_value('nomor_kamar') ?>">

                    <label for="exampleFormControlInput3" class="form-label">Tanggal Lahir</label>
                    <input type="date" class="form-control" id="exampleFormControlInput3" name="tanggal_lahir" value="<?= set_value('fasilitas') ?>">

                    <label for="exampleFormControlInput2" class="form-label">Pekerjaan</label>
                    <input type="input" class="form-control" id="exampleFormControlInput2" name="pekerjaan" value="<?= set_value('harga') ?>">

                    <!-- <label for="exampleFormControlInput4" class="form-label">Gambar</label>
                    <input type="file" class="form-control-file" id="gambar" name="gambar" value="<?= set_value('gambar') ?>">
                    <div id="preview-container" style="display: none;">
                        <img id="preview" src="#" alt="Preview Gambar" style="max-width: 100%; max-height: 200px; margin-top: 10px;">
                    </div> -->
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