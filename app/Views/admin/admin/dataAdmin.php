<div class="container-fluid bg-white text-dark p-3 ms-2">
    <h3>Data Pengguna</h3>
    <div class="row">
        <div class="col-12 d-flex justify-content-end">
            <a href="<?php echo base_url(); ?>tambah-admin"><button type="button" class="btn btn-primary ms-auto mb-2">Tambah Admin</button></a>
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
                    <th>Nama</th>
                    <th>password</th>
                    <th>Role</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php $nomor = 1; ?>
                <?php foreach ($admin_list as $admin_item) : ?>
                    <tr>
                        <td><?= $nomor ?></td>
                        <td><?= esc($admin_item['nama']) ?></td>
                        <td><?= esc($admin_item['password']) ?></td>
                        <td><?= esc($admin_item['role']) ?></td>
                        <td>
                            <a href="<?php echo base_url('detail-admin/' . $admin_item['id']); ?>"><span class="badge text-bg-warning">Edit</span></a>
                            <a href="#" onclick="confirmDelete('<?php echo base_url('hapus-admin/' . $admin_item['id']); ?>')">
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