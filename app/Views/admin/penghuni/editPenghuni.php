<div class="container-fluid">
    <div class="row d-flex justify-content-around mb-3">
        <div class="col-12 col-md-6 bg-white rounded-4">
            <h3 class="text-center mt-3">Edit Data Penghuni</h3>
            <form action="<?php echo base_url(); ?>edit-penghuni-admin" method="post" enctype="multipart/form-data">
                <div class="mb-3">
                    <?php foreach ($penghuni_list as $penghuni_item) : ?>
                        <input type="hidden" class="form-control" id="exampleFormControlInput1" name="id" value="<?= esc($penghuni_item['id']) ?>">
                        <label for="exampleFormControlInput1" class="form-label">NIK</label>
                        <input type="input" class="form-control" id="exampleFormControlInput1" name="nik" value="<?= esc($penghuni_item['nik']) ?>" readonly>

                        <label for="exampleFormControlInput1" class="form-label">Nama</label>
                        <input type="input" class="form-control" id="exampleFormControlInput1" name="nama" value="<?= esc($penghuni_item['nama']) ?>">

                        <label for="exampleFormControlInput1" class="form-label">Tanggal Lahir</label>
                        <input type="date" class="form-control" id="exampleFormControlInput1" name="tanggal_lahir" value="<?= esc($penghuni_item['tgl_lahir']) ?>">

                        <label for="exampleFormControlInput1" class="form-label">No HP</label>
                        <input type="input" class="form-control" id="exampleFormControlInput1" name="no_hp" value="<?= esc($penghuni_item['no_hp']) ?>">

                        <label for="exampleFormControlInput1" class="form-label">Pekerjaan</label>
                        <input type="input" class="form-control" id="exampleFormControlInput1" name="pekerjaan" value="<?= esc($penghuni_item['pekerjaan']) ?>">

                        <label for="exampleFormControlInput1" class="form-label">Tujuan</label>
                        <input type="input" class="form-control" id="exampleFormControlInput1" name="tujuan" value="<?= esc($penghuni_item['tujuan']) ?>">

                        <button type="submit" name="submit" class="btn btn-primary ms-auto mb-2 mt-3">Edit</button>
                    <?php endforeach ?>
                </div>
            </form>
        </div>
    </div>
</div>
</div>