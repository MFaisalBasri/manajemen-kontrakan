<div class="container-fluid">
    <div class="row d-flex justify-content-around">
        <div class="col-12 col-md-6 bg-white">
            <h3 class="text-center">Buat Tagihan</h3>
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
                    <label for="id" class="form-label">ID Penyewaan</label>
                    <select name="id_penyewaan" class="form-select" aria-label="Default select example">
                        <?php foreach ($tagihan_list as $tagihan_item) : ?>
                            <option value="<?php echo htmlspecialchars($tagihan_item['id']); ?>">
                                <?php echo htmlspecialchars($tagihan_item['id']); ?>
                            </option>
                        <?php endforeach; ?>
                    </select>

                    <label for="exampleFormControlInput1" class="form-label">Bulan</label>
                    <input type="input" class="form-control" id="exampleFormControlInput1" name="bulan">

                    <label for="exampleFormControlSelect2" class="form-label">Status</label>
                    <input type="input" class="form-control" id="exampleFormControlInput2" name="status" readonly value="Belum Lunas">

                    <button type="submit" class="btn btn-primary ms-auto mb-2 mt-1">Tambah</button>
                </div>
            </form>
        </div>
    </div>
</div>
</div>