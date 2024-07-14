<div class="container-fluid">
    <h3>Laporan Penyewaan</h3>
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
                <td>1</td>
                <td>P001</td>
                <td>Edinburgh</td>
                <td>001</td>
                <td>Rp.500.000</td>
                <td>Sedang dicek</td>
                <td> <span class="badge text-bg-info">Lihat Bukti</span></td>
                <td>
                    <span class="badge text-bg-warning">Edit</span>
                    <span class="badge text-bg-danger">Hapus</span>
                </td>
            </tr>
            <tr>
                <td>2</td>
                <td>P002</td>
                <td>Tokyo</td>
                <td>002</td>
                <td>Rp.500.000</td>
                <td>Sedang dicek</td>
                <td><span class="badge text-bg-info">Lihat Bukti</span></td>
                <td>
                    <span class="badge text-bg-warning">Edit</span>
                    <span class="badge text-bg-danger">Hapus</span>
                </td>
            </tr>
            <tr>
                <td>3</td>
                <td>P003</td>
                <td>San Francisco</td>
                <td>003</td>
                <td>Rp.400.000</td>
                <td>Sedang dicek</td>
                <td><span class="badge text-bg-info">Lihat Bukti</span></td>
                <td>
                    <span class="badge text-bg-warning">Edit</span>
                    <span class="badge text-bg-danger">Hapus</span>
                </td>
            </tr>
        </tbody>
    </table>
</div>
</div>
<script>
    new DataTable('#example');
</script>