<div class="container-fluid bg-white text-dark p-3 ms-2 border-top border-primary">
    <h3 class="text-center">Data Pembayaran</h3>
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
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <?php $nomor = 1; ?>
                    <?php foreach ($pembayaran_list as $pembayaran_item) : ?>
                        <td><?= $nomor ?></td>
                        <td><?= esc($pembayaran_item['nama_penghuni']) ?></td>
                        <td><?= esc($pembayaran_item['nomor_kamar']) ?></td>
                        <td><?= esc($pembayaran_item['bulan']) ?></td>
                        <td><?= "Rp. " . number_format($pembayaran_item['bayar'], 0, ',', '.') ?></td>
                        <td>
                            <span class="badge <?= ($pembayaran_item['status_pembayaran'] == 'disetujui') ? 'text-bg-success' : 'text-bg-warning' ?>">
                                <?= esc($pembayaran_item['status_pembayaran']) ?>
                            </span>
                        </td>
                        <td><a href="<?php echo base_url('lihat-bukti/' . $pembayaran_item['id']); ?>"><span class="badge text-bg-info">Lihat Bukti</span></a></td>
                        <td>
                            <a href="<?php echo base_url('setujui-pembayaran/' . $pembayaran_item['id']); ?>"><span class="badge text-bg-warning">Setujui</span></a>
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