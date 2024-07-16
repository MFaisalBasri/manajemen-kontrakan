<div class="container-fluid mt-5">
    <div class="row mt-3">
        <div class=" col-12 col-md-6 p-5">
            <h3>Tentang Layanan</h3>
            Selamat datang di MFS_KOST, penyedia penginapan yang berkomitmen untuk memberikan kenyamanan dan keamanan bagi para penghuni kami. Sejak didirikan, kami telah memprioritaskan pelayanan yang ramah dan fasilitas yang memadai untuk memenuhi kebutuhan hunian jangka pendek maupun jangka panjang.
            <br><br>
            Komitmen kami terhadap pelayanan unggul tercermin dalam staf profesional kami yang selalu siap membantu dan menjaga agar setiap penghuni merasa dihargai dan diperhatikan. Dari fasilitas yang terawat dengan baik hingga kebijakan yang transparan, kami berusaha menjadikan MFS_KOST sebagai pilihan utama bagi mereka yang mencari tempat tinggal yang nyaman dan terjangkau.
        </div>
        <div class="col-12 col-md-6">
            <img src="<?php echo base_url(); ?>assets/img/kost/kost-2.jpeg" alt="" style="width: 90vh; max-width: 100%; height: auto;" class="rounded mt-4">
        </div>
    </div>
    <div class="row mt-5 mb-5 d-flex justify-content-around bg-light p-5">
        <h3 class="text-center mb-5">INFORMASI KOST</h3>
        <?php foreach ($kamar_list as $kamar_item) : ?>
            <div class="col-12 col-md-3">
                <div class="card mb-3" style="max-width: 18rem; min-height: 20rem;">
                    <?php $nama_file_gambar = $kamar_item['gambar'];
                    $url_gambar = base_url('uploads/' . $nama_file_gambar); ?>
                    <img src="<?= $url_gambar ?>" class="card-img-top" alt="..." style="max-width: 100%; max-height: 200px;">
                    <div class="card-body">
                        <h5 class="card-title"><?= esc($kamar_item['nama_kamar']) ?></h5>
                        <p><small><?= esc($kamar_item['status']) ?></small></p>
                        <p class="card-text"><b>Fasilitas : </b><?= esc($kamar_item['fasilitas']) ?></p>
                        <p class="card-text"><b>Alamat : </b><?= esc($kamar_item['alamat']) ?></p>
                        <a href="#" class="btn btn-primary" onclick="sendWhatsAppMessage()">Pesan Kamar</a>
                    </div>
                </div>
            </div>
        <?php endforeach ?>

    </div>
    <div class="row mt-5 mb-5 d-flex justify-content-center bg-light p-5">
        <div class="col-12 col-md-10 text-center">
            Selamat datang di MFS_KOST, penyedia penginapan yang berkomitmen untuk memberikan kenyamanan dan keamanan bagi para penghuni kami. Sejak didirikan, kami telah memprioritaskan pelayanan yang ramah dan fasilitas yang memadai untuk memenuhi kebutuhan hunian jangka pendek maupun jangka panjang.
            Komitmen kami terhadap pelayanan unggul tercermin dalam staf profesional kami yang selalu siap membantu dan menjaga agar setiap penghuni merasa dihargai dan diperhatikan. Dari fasilitas yang terawat dengan baik hingga kebijakan yang transparan, kami berusaha menjadikan MFS_KOST sebagai pilihan utama bagi mereka yang mencari tempat tinggal yang nyaman dan terjangkau.
        </div>
    </div>
</div>

<script>
    function sendWhatsAppMessage() {
        const phoneNumber = "62895380902470"; // Ganti '0' dengan kode negara Indonesia '62'
        const message = "hallo, saya ingin memesan kontrakan";
        const whatsappUrl = `https://wa.me/${phoneNumber}?text=${encodeURIComponent(message)}`;

        window.open(whatsappUrl, '_blank');
    }
</script>