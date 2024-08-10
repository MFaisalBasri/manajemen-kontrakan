<div class="container-fluid mt-5 mb-5">
    <div class="row d-flex justify-content-around">
        <div class="col-12 col-md-6 bg-white rounded-4 mb-3">
            <h3 class="text-center mt-3">Atur Jadwal Kunjungan</h3>

            <?php if (session()->getFlashdata('error')) : ?>
                <div class="alert alert-danger" role="alert">
                    <?= session()->getFlashdata('error') ?>
                </div>
            <?php endif; ?>
            <?= validation_list_errors() ?>
            <form action="<?php echo base_url(); ?>buat-kunjungan" method="post" enctype="multipart/form-data">
                <div class="mb-3">
                    <?php foreach ($kamar_list as $kamar_item) : ?>
                        <label for="exampleFormControlInput1" class="form-label">Nama Kontrakan</label>
                        <input type="input" class="form-control" id="exampleFormControlInput1" name="nama_kontrakan" value="<?= esc($kamar_item['nama_kamar']) ?>" readonly>
                        <input type="hidden" class="form-control" id="exampleFormControlInput1" name="id_pemilik" value="<?= esc($kamar_item['id_pemilik']) ?>" readonly>
                    <?php endforeach ?>

                    <label for="exampleFormControlInput3" class="form-label">Waktu Kunjungan</label>
                    <input type="date" class="form-control" id="exampleFormControlInput3" name="waktu" value="<?= set_value('waktu') ?>">

                    <label for="exampleFormControlInput3" class="form-label">Nama Pengunjung</label>
                    <input type="input" class="form-control" id="exampleFormControlInput3" name="nama" value="<?= set_value('nama') ?>">

                    <label for="exampleFormControlInput3" class="form-label">No Hp</label>
                    <input type="input" class="form-control" id="exampleFormControlInput3" name="no_hp" value="<?= set_value('no_hp') ?>">

                    <button type="submit" name="submit" class="btn btn-primary ms-auto mb-2 mt-1">Buat Jadwal</button>

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