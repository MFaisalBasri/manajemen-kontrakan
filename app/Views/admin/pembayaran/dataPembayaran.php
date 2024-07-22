<div class="container-fluid">
    <h3>Data Pembayaran</h3>
    <table id="example" class="display" style="width:100%">
        <thead>
            <tr>
                <th>No</th>
                <th>Kode Penyewaan</th>
                <th>Nama Penghuni</th>
                <th>Nomor Kamar</th>
                <th>Tarif</th>
                <th>Status</th>
                <th>Bukti Pembayaran</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <?php $nomor = 1; ?>
                <?php foreach ($pembayaran_list as $pembayaran_item) : ?>
                    <td><?= $nomor ?></td>
                    <td><?= esc($pembayaran_item['id_tagihan']) ?></td>
                    <td><?= esc($pembayaran_item['bukti_pembayaran']) ?></td>
                    <td>001</td>
                    <td>Rp.500.000</td>
                    <?php $nama_file_gambar = $pembayaran_item['bukti_pembayaran'];
                    $url_gambar = base_url('uploads/' . $nama_file_gambar); ?>
                    <td>
                        <?php if (!empty($pembayaran_item['bukti_pembayaran'])) : ?>
                            <img src="<?= $url_gambar ?>" alt="Gambar Bukti" style="max-width: 100px;">
                        <?php else : ?>
                            <span>Tidak ada gambar</span>
                        <?php endif; ?>
                    </td>
                    <td> <span class="badge text-bg-info">Lihat Bukti</span></td>
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