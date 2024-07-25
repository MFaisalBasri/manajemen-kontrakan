<div class="container-fluid bg-white text-dark p-3 ms-2 border-top border-primary">
    <h3 class="text-center">Data Pembayaran Saya</h3>
    <div class="table-responsive">
        <table id="example" class="display table" style="width:100%; white-space: nowrap; overflow-x: auto;">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Nama Penghuni</th>
                    <th>Nomor Kamar</th>
                    <th>Bulan</th>
                    <th>Harga</th>
                    <th>Status</th>
                    <th>Bukti Pembayaran</th>
                </tr>
            </thead>
            <tbody>
                <?php $nomor = 1; ?>
                <?php foreach ($pembayaran_list as $pembayaran_item) : ?>
                    <tr>
                        <td><?= $nomor ?></td>
                        <td><?= esc($pembayaran_item['nama_penghuni']) ?></td>
                        <td><?= esc($pembayaran_item['nomor_kamar']) ?></td>
                        <td><?= esc($pembayaran_item['bulan']) ?></td>
                        <td><?= "Rp. " . number_format($pembayaran_item['harga'], 0, ',', '.') ?></td>
                        <td>
                            <span class="badge <?= ($pembayaran_item['status_pembayaran'] == 'disetujui') ? 'text-bg-success' : 'text-bg-warning' ?>">
                                <?= esc($pembayaran_item['status_pembayaran']) ?>
                            </span>
                        </td>
                        <?php $nama_file_gambar = $pembayaran_item['bukti_pembayaran'];
                        $url_gambar = base_url('uploads/' . $nama_file_gambar); ?>
                        <td>
                            <?php if (!empty($pembayaran_item['bukti_pembayaran'])) : ?>
                                <img src="<?= $url_gambar ?>" alt="Gambar Kamar" style="max-width: 100px;">
                            <?php else : ?>
                                <span>Tidak ada gambar</span>
                            <?php endif; ?>
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