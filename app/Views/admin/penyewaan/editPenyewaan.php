<div class="container-fluid">
    <h3 class="text-center">Edit Data Penyewaan</h3>
    <div class="row d-flex justify-content-around">
        <div class="col-12 col-md-6 bg-white">

            <form action="<?= base_url(); ?>edit-penyewaan" method="post" enctype="multipart/form-data">
                <div class="mb-3">
                    <input type="hidden" class="form-control" id="exampleFormControlInput1" name="id" value="<?= esc($penyewaan_item['id']) ?>">
                    <label for="exampleFormControlInput1" class="form-label">Nama</label>
                    <input type="input" class="form-control" id="exampleFormControlInput1" name="nama" value="<?= esc($penyewaan_item['nama']) ?>" readonly>

                    <label for="nomor_kamar" class="form-label">Nomor Kamar</label>
                    <input type="input" class="form-control" id="exampleFormControlInput1" name="nomor_kamar" value="<?= esc($penyewaan_item['nomor_kamar']) ?>" readonly>

                    <label for="exampleFormControlInput1" class="form-label">Tanggal Penyewaan</label>
                    <input type="date" class="form-control" id="exampleFormControlInput1" name="tanggal_penyewaan" value="<?= esc($penyewaan_item['tanggal_penyewaan']) ?>">

                    <button type="submit" name="submit" class="btn btn-primary ms-auto mb-2 mt-1">Edit</button>
                </div>
            </form>

        </div>
    </div>
</div>
</div>