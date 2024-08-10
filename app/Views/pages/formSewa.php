<div class="container mt-5">
    <div class="row d-flex justify-content-around mb-5">
        <div class="row bg-white p-3 mb-3">
            <div class="col-md-6 col-12">
                <?php foreach ($kamar_list as $kamar_item) : ?>
                    <div class="row bg-white p-3 mb-3">
                        <h5 class="text-center mb-3">DETAIL KONTRAKAN</h5>
                        <div class="col-md-4 col-12 d-flex justify-content-center mt-3">
                            <?php $nama_file_gambar = $kamar_item['gambar'];
                            $url_gambar = base_url('uploads/' . $nama_file_gambar); ?>
                            <td>
                                <?php if (!empty($kamar_item['gambar'])) : ?>
                                    <img src="<?= $url_gambar ?>" alt="Gambar Kamar" style="max-width: 150px; max-height: 150px;">
                                <?php else : ?>
                                    <span>Tidak ada gambar</span>
                                <?php endif; ?>
                            </td>
                        </div>
                        <div class="col-md-6 col-12 mt-3">
                            <h5 class="card-title"><?= esc($kamar_item['nama_kamar']) ?></h5><br>
                            <p class="card-text"><b>Fasilitas : </b><?= esc($kamar_item['fasilitas']) ?></p>
                            <p class="card-text"><b>Luas : </b><?= esc($kamar_item['luas']) ?> m²</p>
                            <p class="card-text"><b>Alamat : </b><?= esc($kamar_item['alamat']) ?></p>
                            <p class="card-text"><b>Harga : </b><?= "Rp. " . number_format($kamar_item['harga'], 0, ',', '.') ?></p>
                            <p class="card-text"><b>Kontak Pemilik : </b><?= esc($kamar_item['kontak']) ?></p>
                        </div>
                    </div>
                <?php endforeach ?>
            </div>

            <div class="col-12 col-md-4 bg-white rounded-4 mb-">
                <h5 class="text-center mt-3">ISI DATA PENYEWAAN</h5>

                <?php if (session()->getFlashdata('error')) : ?>
                    <div class="alert alert-danger" role="alert">
                        <?= session()->getFlashdata('error') ?>
                    </div>
                <?php endif; ?>
                <?= validation_list_errors() ?>
                <form action="<?php echo base_url(); ?>sewa-kontrakan" method="post" enctype="multipart/form-data">
                    <div class="mb-3">
                        <?php foreach ($kamar_list as $kamar_item) : ?>
                            <input type="hidden" class="form-control" id="exampleFormControlInput1" name="id_kamar" value="<?= esc($kamar_item['id']) ?>">
                            <input type="hidden" class="form-control" id="exampleFormControlInput1" name="id_pemilik" value="<?= esc($kamar_item['id_pemilik']) ?>">
                        <?php endforeach ?>
                        <label for="exampleFormControlInput1" class="form-label">NIK</label>
                        <input type="input" class="form-control" id="exampleFormControlInput1" name="nik" value="<?= set_value('nik') ?>">

                        <label for="exampleFormControlInput1" class="form-label">Nama</label>
                        <input type="input" class="form-control" id="exampleFormControlInput1" name="nama" value="<?= set_value('nama') ?>">

                        <label for="exampleFormControlInput3" class="form-label">Tanggal Lahir</label>
                        <input type="date" class="form-control" id="exampleFormControlInput3" name="tanggal_lahir" value="<?= set_value('tanggal_lahir') ?>">

                        <label for="exampleFormControlInput3" class="form-label">No HP</label>
                        <input type="input" class="form-control" id="exampleFormControlInput3" name="no_hp" value="<?= set_value('no_hp') ?>" placeholder="contoh: 629874637377">

                        <label for="exampleFormControlInput2" class="form-label">Pekerjaan</label>
                        <input type="input" class="form-control" id="exampleFormControlInput2" name="pekerjaan" value="<?= set_value('pekerjaan') ?>">

                        <label for="exampleFormControlInput2" class="form-label">Tujuan</label>
                        <input type="input" class="form-control mb-2" id="exampleFormControlInput2" name="tujuan" value="<?= set_value('tujuan') ?>">

                        <label for="dateInput" class="form-label">Tanggal Sewa</label>
                        <input type="date" id="#" class="form-control" name="tanggal">

                        <p style="color: red;"><small>*masukan email dan password yang telah terdaftar!</small></p>

                        <label for="exampleFormControlInput1" class="form-label">Email</label>
                        <input type="input" class="form-control" id="exampleFormControlInput1" name="email">
                        <label for="exampleFormControlInput2" class="form-label">Password</label>
                        <input type="password" class="form-control" id="exampleFormControlInput2" name="password">
                        <button type="submit" name="submit" class="btn btn-primary ms-auto mb-2 mt-3">Sewa</button>

                    </div>
                </form>
            </div>
        </div>
    </div>
</div>



<script>
    document.getElementById('gambar').onchange = function(e) {
        let preview = document.getElementById('preview');
        preview.src = URL.createObjectURL(this.files[0]);
        preview.onload = function() {
            URL.revokeObjectURL(preview.src); // Membebaskan memori
        }
        document.getElementById('preview-container').style.display = 'block'; // Menampilkan container preview
    };
</script>