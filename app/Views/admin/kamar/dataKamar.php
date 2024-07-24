<div class="container-fluid bg-white text-dark p-3 ms-2 border-top border-primary">
    <h3 class="text-center">Data Kamar</h3>
    <div class="row">
        <div class="col-12 d-flex justify-content-end">
            <a href="<?php echo base_url(); ?>tambah-kamar"><button type="button" class="btn btn-primary ms-auto mb-2">Tambah Kamar</button></a>
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
                    <th>Kode Kamar</th>
                    <th>Nomor Kamar</th>
                    <th>Nama Kamar</th>
                    <th>Alamat</th>
                    <th>Fasilitas</th>
                    <th>Tarif Per Bulan</th>
                    <th>Status</th>
                    <th>Gambar</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php $nomor = 1; ?>
                <?php foreach ($kamar_list as $kamar_item) : ?>
                    <tr>
                        <td><?= $nomor ?></td>
                        <td><?= esc($kamar_item['kode_kamar']) ?></td>
                        <td><?= esc($kamar_item['nomor_kamar']) ?></td>
                        <td><?= esc($kamar_item['nama_kamar']) ?></td>
                        <td><?= esc($kamar_item['alamat']) ?></td>
                        <td><?= esc($kamar_item['fasilitas']) ?></td>
                        <td><?= esc($kamar_item['harga']) ?></td>
                        <td><?= esc($kamar_item['status']) ?></td>
                        <?php $nama_file_gambar = $kamar_item['gambar'];
                        $url_gambar = base_url('uploads/' . $nama_file_gambar); ?>
                        <td>
                            <?php if (!empty($kamar_item['gambar'])) : ?>
                                <img src="<?= $url_gambar ?>" alt="Gambar Kamar" style="max-width: 100px;">
                            <?php else : ?>
                                <span>Tidak ada gambar</span>
                            <?php endif; ?>
                        </td>
                        <td>
                            <a href="<?php echo base_url('detail-kamar/' . $kamar_item['id']); ?>"><span class="badge text-bg-warning">Edit</span></a>
                            <a href="#" onclick="confirmDelete('<?php echo base_url('hapus-kamar/' . $kamar_item['id']); ?>')">
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