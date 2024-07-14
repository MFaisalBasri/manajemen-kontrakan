<div class="container-fluid bg-white text-dark p-3 ms-2">
    <h3 class="text-center">Data Tagihan</h3>
    <div class="row">
        <div class="col-12 d-flex justify-content-end">
            <a href="<?php echo base_url(); ?>buat-tagihan"><button type="button" class="btn btn-primary ms-auto mb-2">Buat Tagihan</button></a>
        </div>
        <?php if (session()->getFlashdata('success')) : ?>
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <?= session()->getFlashdata('success') ?>
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        <?php endif; ?>
    </div>
    <div class="table-responsive">
        <table id="example" class="display table" style="width:100%; white-space: nowrap; overflow-x: auto;">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Nama</th>
                    <th>Nomor Kamar</th>
                    <th>Bulan</th>
                    <th>Status</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php $nomor = 1; ?>
                <?php foreach ($tagihan_list as $tagihan_item) : ?>
                    <tr>
                        <td><?= $nomor ?></td>
                        <td><?= esc($tagihan_item['id']) ?></td>
                        <td><?= esc($tagihan_item['id_penyewaan']) ?></td>
                        <td><?= esc($tagihan_item['bulan']) ?></td>
                        <td><?= esc($tagihan_item['status']) ?></td>
                        <td>
                            <a href="<?php echo base_url('detail-tagihan/' . $tagihan_item['id']); ?>"><span class="badge text-bg-warning">Edit</span></a>
                            <a href="#" onclick="confirmDelete('<?php echo base_url('hapus-tagihan/' . $tagihan_item['id']); ?>')">
                                <span class="badge badge-danger">Hapus</span>
                            </a>
                        </td>
                    </tr>
                    <?php $nomor++; ?>
                <?php endforeach ?>
            </tbody>
        </table>
    </div>
</div>
</div>
<script>
    new DataTable('#example');
</script>
<script>
    function confirmDelete(deleteUrl) {
        if (confirm("Apakah Anda yakin ingin menghapus data?")) {
            window.location.href = deleteUrl;
        }
    }
</script>