<div class="container-fluid bg-white text-dark p-3 ms-2 border-top border-primary">
    <h3 class="text-center">Data Penyewaan</h3>
    <div class="row">
        <div class="col-12 d-flex justify-content-end">
            <a href="<?php echo base_url(); ?>tambah-penyewaan"><button type="button" class="btn btn-primary ms-auto mb-2">Tambah Penyewaan</button></a>
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
                    <th>Nomor Kontrakan</th>
                    <th>Harga</th>
                    <th>Tanggal Penyewaan</th>
                    <th>Status</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php $nomor = 1; ?>
                <?php foreach ($penyewaan_list as $penyewaan_item) : ?>
                    <tr>
                        <td><?= $nomor ?></td>
                        <td><?= esc($penyewaan_item['nama']) ?></td>
                        <td><?= esc($penyewaan_item['nomor_kamar']) ?></td>
                        <td><?= "Rp. " . number_format($penyewaan_item['harga'], 0, ',', '.') ?></td>
                        <td><?= date('d-m-Y', strtotime($penyewaan_item['tanggal_penyewaan'])) ?></td>
                        <td> <span class="badge <?= ($penyewaan_item['status'] == 'Disetujui') ? 'text-bg-success' : 'text-bg-warning' ?>">
                                <?= esc($penyewaan_item['status']) ?>
                            </span></td>
                        <td>
                            <a href="<?php echo base_url('setujui-penyewaan/' . $penyewaan_item['id']); ?>"><span class="badge text-bg-primary">Setujui</span></a>
                            <a href="<?php echo base_url('detail-penyewaan/' . $penyewaan_item['id']); ?>"><span class="badge text-bg-warning">Edit</span></a>
                            <a href="#" onclick="confirmDelete('<?php echo base_url('hapus-penyewaan/' . $penyewaan_item['id']); ?>')">
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