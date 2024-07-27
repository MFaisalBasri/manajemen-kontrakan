<div class="container-fluid bg-white text-dark p-3 ms-2 border-top border-primary">
    <h3 class="text-center">Laporan Keuangan</h3>
    <div class="table-responsive">
        <table id="example" class="display table" style="width:100%; white-space: nowrap; overflow-x: auto;">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Tanggal Pembayaran</th>
                    <th>Nomor Kamar</th>
                    <th>Bulan</th>
                    <th>Harga</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $nomor = 1;
                $total_bayar = 0;
                ?>
                <?php foreach ($pembayaran_list as $pembayaran_item) : ?>
                    <tr>
                        <td><?= $nomor ?></td>
                        <td><?= esc($pembayaran_item['tanggal_pembayaran']) ?></td>
                        <td><?= esc($pembayaran_item['nomor_kamar']) ?></td>
                        <td><?= esc($pembayaran_item['bulan']) ?></td>
                        <td><?= "Rp. " . number_format($pembayaran_item['bayar'], 0, ',', '.') ?></td>
                    </tr>
                    <?php
                    $total_bayar += $pembayaran_item['bayar'];
                    $nomor++;
                    ?>
                <?php endforeach ?>
            </tbody>
            <tfoot>
                <tr>
                    <td colspan="4" style="text-align: right;"><strong>Total</strong></td>
                    <td><strong><?= "Rp. " . number_format($total_bayar, 0, ',', '.') ?></strong></td>
                </tr>
            </tfoot>
        </table>

    </div>
</div>
</div>
<script>
    new DataTable('#example', {
        buttons: [
            'copy', 'excel', 'pdf'
        ],
        layout: {
            topStart: 'buttons'
        }
    });
</script>