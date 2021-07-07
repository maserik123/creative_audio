<?php 
    $this->load->view('templates/header_belanja');
    $level = $this->session->userdata('level');
?>
<!-- Featured Section Begin -->
    <section class="featured spad">
        <div class="container">
            <div class="row">
			<p><?php echo $this->session->userdata('message') <> '' ? $this->session->userdata('message') : ''; ?></p>
                <div class="col-lg-12" style="padding:30px;border:3px solid green;margin-top:-100px;">
                <h3>Registrasi Member</h3><br>
                <p>Harap isi alamat dengan lengkap dan benar, pengiriman akan dilakukan ke alamat yang telah didaftarkan</p><hr>
                <form method="POST" action="<?php echo base_url('User_Ctrl/create_action'); ?>">
                    <input type="hidden" name="id_user">
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="varchar">Nama Member<span class="text-danger"> *</span></label>
                            <input type="text" name="nama_user" class="form-control" placeholder="Masukkan Nama" required>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="varchar">Email Member <span class="text-danger"> *</span></label>
                            <input type="email" name="email_user" class="form-control" placeholder="Masukkan Email"  required>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="varchar">Telp Member <span class="text-danger"> *</span></label>
                            <input type="number" class="form-control" name="telp_user" placeholder="Masukkan Telp" required>
                        </div>
                    </div>
                    <div class="col-md-8">
                            <div class="form-group">
                                <label for="varchar">Alamat Member<span class="text-danger"> *</span></label>
                                <input type="text" name="alamat_user" class="form-control" placeholder="Masukkan Alamat" required>
                            </div>
                        </div>
                    <div class="col-md-4">
                            <div class="form-group">
                                <label for="varchar">Provinsi Member <span class="text-danger"> *</span></label>
                                <input type="text" name="provinsi_user" class="form-control" placeholder="Masukkan Provinsi" required>
                            </div>
                        </div>
                    <div class="col-md-4">
                            <div class="form-group">
                                <label for="varchar">Kota Member<span class="text-danger"> *</span></label>
                                <input type="text" name="kota_user" class="form-control" placeholder="Masukkan Kota" required>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="varchar">Kode Pos<span class="text-danger"> *</span></label>
                                <input type="number" class="form-control" name="kode_pos" placeholder="Masukkan Kode Pos" required>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="varchar">Password<span class="text-danger"> *</span></label>
                                <input type="password" class="form-control" name="password_user" placeholder="Masukkan Password" required>
                            </div>
                        </div>
                        <div class="col-md-12" style="margin-bottom: 10px;">
                            <button type="submit" class="btn btn-primary">Simpan</button> 
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
    <!-- Featured Section End -->
    <?php $this->load->view('templates/footer_belanja'); ?>