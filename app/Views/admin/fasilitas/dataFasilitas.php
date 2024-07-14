<div class="container-fluid">
    <h3>Data Fasilitas</h3>
    <div class="row">
        <div class="col-12 d-flex justify-content-end">
            <a href="<?php echo base_url(); ?>tambah-fasilitas"><button type="button" class="btn btn-primary ms-auto mb-2">Tambah Fasilitas</button></a>
        </div>
    </div>

    <table id="example" class="display" style="width:100%">
        <thead>
            <tr>
                <th>No</th>
                <th>Nama</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            <?php $nomor = 1; ?>
            <?php foreach ($fasilitas_list as $fasilitas_item) : ?>
                <tr>
                    <td><?= $nomor ?></td>
                    <td><?= esc($fasilitas_item['nama']) ?></td>
                    <td>
                        <span class="badge text-bg-warning">Edit</span>
                        <span class="badge text-bg-danger">Hapus</span>
                    </td>
                </tr>
                <?php $nomor++; ?>
            <?php endforeach ?>
        </tbody>
    </table>
</div>
</div>
<script>
    new DataTable('#example');
</script>