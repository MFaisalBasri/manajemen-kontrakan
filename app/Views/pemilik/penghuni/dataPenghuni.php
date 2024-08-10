<div class="container-fluid bg-white text-dark p-3 ms-2 border-top border-primary">
    <h3 class="text-center">Data Penghuni</h3>
    <div class="row">
        <div class="col-12 d-flex justify-content-end">
            <a href="<?php echo base_url(); ?>tambah-penghuni"><button type="button" class="btn btn-primary ms-auto mb-2">Tambah Penghuni</button></a>
        </div>
    </div>
    <?php if (session()->getFlashdata('success')) : ?>
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <?= session()->getFlashdata('success') ?>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    <?php endif; ?>
    <div class="table-responsive">
        <table id="example" class="display table" style="width:100%; white-space: nowrap; overflow-x: auto;">
            <thead>
                <tr>
                    <th>No</th>
                    <th>NIK</th>
                    <th>Nama</th>
                    <th>Tanggal Lahir</th>
                    <th>No Telepon</th>
                    <th>Pekerjaan</th>
                    <th>Tujuan</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php $nomor = 1; ?>
                <?php foreach ($penghuni_list as $penghuni_item) : ?>
                    <tr>
                        <td><?= $nomor ?></td>
                        <td><?= esc($penghuni_item['nik']) ?></td>
                        <td><?= esc($penghuni_item['nama']) ?></td>
                        <td><?= date('d-m-Y', strtotime($penghuni_item['tgl_lahir'])) ?></td>
                        <td><?= esc($penghuni_item['no_hp']) ?></td>
                        <td><?= esc($penghuni_item['pekerjaan']) ?></td>
                        <td><?= esc($penghuni_item['tujuan']) ?></td>
                        <td>
                            <a href="<?php echo base_url('detail-penghuni/' . $penghuni_item['id']); ?>"><span class="badge text-bg-warning">Edit</span></a>
                            <a href="#" onclick="confirmDelete('<?php echo base_url('hapus-penghuni/' . $penghuni_item['id']); ?>')">
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