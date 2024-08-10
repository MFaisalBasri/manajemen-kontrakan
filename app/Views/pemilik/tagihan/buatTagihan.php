<div class="container-fluid">
    <div class="row d-flex justify-content-around">
        <div class="col-12 col-md-6 bg-white rounded-3">
            <h3 class="text-center mt-3">Buat Tagihan</h3>
            <?php if (session()->getFlashdata('success')) : ?>
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <?= session()->getFlashdata('success') ?>
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            <?php endif; ?>
            <form action="<?php echo base_url(); ?>buat-tagihan" method="post">
                <div class="mb-3">
                    <input type="hidden" class="form-control" id="exampleFormControlInput1" name="id_pemilik" value="<?= session()->get('id') ?>">
                    <label for="id" class="form-label">ID Penyewaan</label>
                    <select name="id_penyewaan" class="form-select" aria-label="Default select example">
                        <?php foreach ($tagihan_list as $tagihan_item) : ?>
                            <option value="<?php echo htmlspecialchars($tagihan_item['id']); ?>">
                                <?php echo htmlspecialchars($tagihan_item['nama']); ?>
                            </option>
                        <?php endforeach; ?>
                    </select>

                    <label for="exampleFormControlSelect1" class="form-label">Bulan</label>
                    <select class="form-control" id="exampleFormControlSelect1" name="bulan">
                        <option value="Januari">Januari</option>
                        <option value="Februari">Februari</option>
                        <option value="Maret">Maret</option>
                        <option value="April">April</option>
                        <option value="Mei">Mei</option>
                        <option value="Juni">Juni</option>
                        <option value="Juli">Juli</option>
                        <option value="Agustus">Agustus</option>
                        <option value="September">September</option>
                        <option value="Oktober">Oktober</option>
                        <option value="November">November</option>
                        <option value="Desember">Desember</option>
                    </select>

                    <label for="exampleFormControlSelect2" class="form-label">Status</label>
                    <input type="input" class="form-control" id="exampleFormControlInput2" name="status" readonly value="Belum Lunas">

                    <button type="submit" class="btn btn-primary ms-auto mb-2 mt-3">Tambah</button>
                </div>
            </form>
        </div>
    </div>
</div>
</div>