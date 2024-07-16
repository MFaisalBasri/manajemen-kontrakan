<div class="container-fluid">
    <h3 class="text-center">Edit Data Penghuni</h3>
    <div class="row d-flex justify-content-around">
        <div class="col-12 col-md-6 bg-white">

            <form action="<?php echo base_url(); ?>edit-penghuni" method="post" enctype="multipart/form-data">
                <div class="mb-3">
                    <?php foreach ($penghuni_list as $penghuni_item) : ?>
                        <input type="hidden" class="form-control" id="exampleFormControlInput1" name="id" value="<?= esc($penghuni_item['id']) ?>">
                        <label for="exampleFormControlInput1" class="form-label">Nama</label>
                        <input type="input" class="form-control" id="exampleFormControlInput1" name="nama" value="<?= esc($penghuni_item['nama']) ?>">

                        <label for="exampleFormControlInput1" class="form-label">Tanggal Lahir</label>
                        <input type="date" class="form-control" id="exampleFormControlInput1" name="tanggal_lahir" value="<?= esc($penghuni_item['tgl_lahir']) ?>">

                        <label for="exampleFormControlInput1" class="form-label">Pekerjaan</label>
                        <input type="input" class="form-control" id="exampleFormControlInput1" name="pekerjaan" value="<?= esc($penghuni_item['pekerjaan']) ?>">

                        <button type="submit" name="submit" class="btn btn-primary ms-auto mb-2 mt-1">Edit</button>
                    <?php endforeach ?>
                </div>
            </form>
        </div>
    </div>
</div>
</div>