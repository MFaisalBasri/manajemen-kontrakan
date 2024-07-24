<div class="container-fluid">
    <div class="row d-flex justify-content-around mb-3">
        <div class="col-12 col-md-6 bg-white rounded-4">
            <h3 class="text-center mt-2">Edit Data Kamar</h3>

            <form action="<?php echo base_url(); ?>edit-kamar" method="post" enctype="multipart/form-data">
                <div class="mb-3">
                    <?php foreach ($kamar_list as $kamar_item) : ?>
                        <input type="hidden" class="form-control" id="exampleFormControlInput1" name="id" value="<?= esc($kamar_item['id']) ?>">
                        <label for="exampleFormControlInput1" class="form-label">Kode Kamar</label>
                        <input type="input" class="form-control" id="exampleFormControlInput1" name="kode_kamar" value="<?= esc($kamar_item['kode_kamar']) ?>" readonly>

                        <label for="exampleFormControlInput1" class="form-label">Nomor Kamar</label>
                        <input type="input" class="form-control" id="exampleFormControlInput1" name="nomor_kamar" value="<?= esc($kamar_item['nomor_kamar']) ?>" readonly>

                        <label for="exampleFormControlInput1" class="form-label">Nama Kamar</label>
                        <input type="input" class="form-control" id="exampleFormControlInput1" name="nama_kamar" value="<?= esc($kamar_item['nama_kamar']) ?>">

                        <label for="exampleFormControlInput2" class="form-label">Alamat</label>
                        <input type="input" class="form-control" id="exampleFormControlInput2" name="alamat" value="<?= esc($kamar_item['alamat']) ?>">

                        <label for="exampleFormControlInput2" class="form-label">Fasilitas</label>
                        <input type="input" class="form-control" id="exampleFormControlInput2" name="fasilitas" value="<?= esc($kamar_item['fasilitas']) ?>">

                        <label for="exampleFormControlInput3" class="form-label">Harga</label>
                        <input type="input" class="form-control" id="exampleFormControlInput3" name="harga" value="<?= esc($kamar_item['harga']) ?>">

                        <label for="exampleFormControlInput3" class="form-label">Status</label>
                        <input type="input" class="form-control" id="exampleFormControlInput3" name="status" value="<?= esc($kamar_item['status']) ?>">

                        <label for="exampleFormControlInput4" class="form-label">Gambar</label>
                        <!-- <input type="file" class="form-control-file" id="gambar" name="gambar" onchange="previewFile()"> -->
                        <div id="preview-container">
                            <?php if (!empty($kamar_item['gambar'])) : ?>
                                <img id="preview" src="<?= base_url('uploads/' . $kamar_item['gambar']) ?>" alt="Preview Gambar" style="max-width: 100%; max-height: 200px; margin-top: 10px;">
                            <?php endif; ?>
                        </div>

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

<!-- <script>
    document.getElementById('gambar').onchange = function(e) {
        let preview = document.getElementById('preview');
        preview.src = URL.createObjectURL(this.files[0]);
        preview.onload = function() {
            URL.revokeObjectURL(preview.src); // Membebaskan memori
        }
        document.getElementById('preview-container').style.display = 'block'; // Menampilkan container preview
    };
</script> -->