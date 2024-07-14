<div class="container-fluid">
    <h3 class="text-center">Tambah Data Penyewaan</h3>
    <div class="row d-flex justify-content-around">
        <div class="col-12 col-md-6 bg-white">
            <?php if (session()->getFlashdata('success')) : ?>
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <?= session()->getFlashdata('success') ?>
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            <?php endif; ?>
            <form action="<?php echo base_url(); ?>tambah-penyewaan" method="post">
                <div class="mb-3">
                    <label for="nama_penghuni" class="form-label">Nama Penghuni</label>
                    <select name="nama_penghuni" class="form-select" aria-label="Default select example">
                        <?php foreach ($penghuni_list as $penghuni_item) : ?>
                            <option value="<?php echo htmlspecialchars($penghuni_item['id']); ?>">
                                <?php echo htmlspecialchars($penghuni_item['nama']); ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                    <label for="nomor_kamar" class="form-label">Nomor Kamar</label>
                    <select name="nomor_kamar" class="form-select" aria-label="Default select example">
                        <?php foreach ($kamar_list as $kamar_item) : ?>
                            <option value="<?php echo htmlspecialchars($kamar_item['id']); ?>">
                                <?php echo htmlspecialchars($kamar_item['nomor_kamar']); ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                    <label for="exampleFormControlInput4" class="form-label">Tanggal Penyewaan</label>
                    <input type="date" class="form-control" id="exampleFormControlInput4" name="tanggal_penyewaan">
                    <label for="exampleFormControlInput3" class="form-label">Status Kamar</label>
                    <select class="form-select" aria-label="Default select example" name="status">
                        <option selected value="1">Tersedia</option>
                        <option value="2">Digunakan</option>
                    </select>
                    <button type="submit" class="btn btn-primary ms-auto mb-2 mt-1">Tambah</button>
                </div>
            </form>
        </div>
    </div>
</div>
</div>