                <!-- Begin Page Content -->
                <div class="container-fluid">
                    <h1>Dashboard</h1>
                    <!-- Content Row -->
                    <div class="row">

                        <!-- Earnings (Monthly) Card Example -->
                        <div class="col-xl-3 col-md-6 mb-4">
                            <div class="card border-left-primary shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                                Nama</div>
                                            <div class="h5 mb-0 font-weight-bold text-gray-800">
                                                <p><?= $nama; ?></p>
                                            </div>
                                        </div>
                                        <div class="col-auto">
                                            <i class="fas fa-calendar fa-2x text-gray-300"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Earnings (Monthly) Card Example -->
                        <div class="col-xl-3 col-md-6 mb-4">
                            <div class="card border-left-success shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                                Role</div>
                                            <div class="h5 mb-0 font-weight-bold text-gray-800">
                                                <p><?= $role; ?></p>
                                            </div>
                                        </div>
                                        <div class="col-auto">
                                            <i class="fas fa-clipboard-list fa-2x text-gray-300"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Earnings (Monthly) Card Example -->
                        <div class="col-xl-3 col-md-6 mb-4">
                            <div class="card border-left-info shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-info text-uppercase mb-1">Data Tagihan
                                            </div>
                                            <div class="row no-gutters align-items-center">
                                                <div class="col-auto">
                                                    <div class="h5 mb-0 mr-3 font-weight-bold text-gray-800"><?= $totalTagihan; ?></div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-auto">
                                            <i class="fas fa-dollar-sign fa-2x text-gray-300"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Pending Requests Card Example -->
                        <div class="col-xl-3 col-md-6 mb-4">
                            <div class="card border-left-warning shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">
                                                Data Pembayaran</div>
                                            <div class="h5 mb-0 font-weight-bold text-gray-800"><?= $totalPembayaran; ?></div>
                                        </div>
                                        <div class="col-auto">
                                            <i class="fas fa-comments fa-2x text-gray-300"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php foreach ($kamar_list as $tagihan_item) : ?>
                        <div class="row bg-white p-3 mb-3">
                            <h2 class="text-center mb-3">Informasi Kontrakan</h2>
                            <div class="col-md-4 col-12 d-flex justify-content-center mt-3">
                                <?php $nama_file_gambar = $tagihan_item['gambar'];
                                $url_gambar = base_url('uploads/' . $nama_file_gambar); ?>
                                <td>
                                    <?php if (!empty($tagihan_item['gambar'])) : ?>
                                        <img src="<?= $url_gambar ?>" alt="Gambar Kamar" style="max-width: 350px;">
                                    <?php else : ?>
                                        <span>Tidak ada gambar</span>
                                    <?php endif; ?>
                                </td>
                            </div>
                            <div class="col-md-6 col-12 mt-3">
                                <h5 class="card-title"><?= esc($tagihan_item['nama_kamar']) ?></h5>
                                <p class="card-text"><b>Fasilitas : </b><?= esc($tagihan_item['fasilitas']) ?></p>
                                <p class="card-text"><b>Alamat : </b><?= esc($tagihan_item['alamat']) ?></p>
                                <p class="card-text"><b>Harga : </b><?= "Rp. " . number_format($tagihan_item['harga'], 0, ',', '.') ?></p>
                                <a href="<?php echo base_url('tagihan-user/') ?>" class="btn btn-primary">Bayar Sewa</a>
                                <a href="#" class="btn btn-warning" onclick="sendWhatsAppMessage()">Komplain</a>
                            </div>
                        </div>
                    <?php endforeach ?>

                </div>
                <!-- /.container-fluid -->

                </div>
                <!-- End of Main Content -->

                <script>
                    function sendWhatsAppMessage() {
                        const phoneNumber = "62895321406949"; // Ganti '0' dengan kode negara Indonesia '62'
                        const message = "hallo, saya memiliki keluhan tentang kontrakan";
                        const whatsappUrl = `https://wa.me/${phoneNumber}?text=${encodeURIComponent(message)}`;

                        window.open(whatsappUrl, '_blank');
                    }
                </script>