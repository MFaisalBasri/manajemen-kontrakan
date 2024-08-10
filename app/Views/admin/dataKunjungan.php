<div class="container-fluid bg-white text-dark p-3 ms-2 border-top border-primary">
    <h3 class="text-center">Data Kunjungan</h3>
    <!-- <div class="row">
        <div class="col-12 d-flex justify-content-end">
            <a href="<?php echo base_url(); ?>tambah-kamar"><button type="button" class="btn btn-primary ms-auto mb-2">Tambah Kamar</button></a>
        </div>
    </div> -->
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
                    <th>Nama Pengunjung</th>
                    <th>Waktu Kunjungan</th>
                    <th>Nama Kontrakan</th>
                    <th>Kontak Pengunjung</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php $nomor = 1; ?>
                <?php foreach ($kunjungan_list as $kamar_item) : ?>
                    <tr>
                        <td><?= $nomor ?></td>
                        <td><?= esc($kamar_item['nama']) ?></td>
                        <td><?= date('d-m-Y', strtotime($kamar_item['waktu'])) ?></td>
                        <td><?= esc($kamar_item['nama_kontrakan']) ?></td>
                        <td id="phoneNumber"><?= esc($kamar_item['no_hp']) ?></td>
                        <td>
                            <!--<a href="<?php echo base_url('detail-kamar/' . $kamar_item['id']); ?>"><span class="badge text-bg-warning">Edit</span></a>-->
                            <a href="#" class="btn btn-primary" onclick="sendWhatsAppMessage()">Konfirmasi</a>
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

<script>
    function sendWhatsAppMessage() {
        // Ambil elemen dengan ID 'phoneNumber'
        const phoneNumberElement = document.getElementById('phoneNumber');
        const phoneNumber = phoneNumberElement.textContent.trim();
        const message = "hallo, saya pemilik kontrakan melalui pesan ini saya menyetujui jadwal kunjungan yang anda buat.";
        const whatsappUrl = `https://wa.me/${phoneNumber}?text=${encodeURIComponent(message)}`;

        window.open(whatsappUrl, '_blank');
    }
</script>