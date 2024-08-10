<div class="container-fluid">
    <div class="row mt-5 mb-5 d-flex justify-content-around bg-light p-5">

        <?php foreach ($kamar_list as $kamar_item) : ?>
            <div class="row bg-white p-3 mb-3">
                <h1 class="text-center mb-3">DETAIL KONTRAKAN</h1>
                <div class="col-md-4 col-12 d-flex justify-content-center mt-3">
                    <?php $nama_file_gambar = $kamar_item['gambar'];
                    $url_gambar = base_url('uploads/' . $nama_file_gambar); ?>
                    <td>
                        <?php if (!empty($kamar_item['gambar'])) : ?>
                            <img src="<?= $url_gambar ?>" alt="Gambar Kamar" style="max-width: 350px;">
                        <?php else : ?>
                            <span>Tidak ada gambar</span>
                        <?php endif; ?>
                    </td>
                </div>
                <div class="col-md-6 col-12 mt-3">
                    <h3 class="card-title"><?= esc($kamar_item['nama_kamar']) ?></h3><br>
                    <p class="card-text"><b>Fasilitas : </b><?= esc($kamar_item['fasilitas']) ?></p>
                    <p class="card-text"><b>Luas : </b><?= esc($kamar_item['luas']) ?> m²</p>
                    <p class="card-text"><b>Alamat : </b><?= esc($kamar_item['alamat']) ?></p>
                    <p class="card-text"><b>Harga : </b><?= "Rp. " . number_format($kamar_item['harga'], 0, ',', '.') ?></p>
                    <p class="card-text"><b>Kontak Pemilik : </b><?= esc($kamar_item['kontak']) ?></p>
                    <?php foreach ($kamar_list as $kamar) : ?>
                        <a href="<?php echo base_url('jadwal-kunjungan/') . $kamar['id']; ?>" class="btn btn-primary">Atur Jadwal Kunjungan</a>
                        <a href="<?php echo base_url('sewa-kontrakan/') . $kamar['id']; ?>" class="btn btn-warning">Sewa Kontrakan</a>
                    <?php endforeach ?>
                    <!-- <a href="#" class="btn btn-warning" onclick="sendWhatsAppMessage()">Beri Komentar</a> -->
                </div>
            </div>
        <?php endforeach ?>
    </div>

</div>