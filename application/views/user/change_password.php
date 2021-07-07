<?php 
    $this->load->view('templates/header_belanja');
    $level = $this->session->userdata('level');
?>
<!-- Featured Section Begin -->
<br><br>
    <section class="featured spad">
        <div class="container">
            <div class="row">
			<p><?php echo $this->session->userdata('message') <> '' ? $this->session->userdata('message') : ''; ?></p>
                <div class="col-lg-12" style="padding:30px;border:3px solid green;margin-top:-100px;">
				<?php if(isset($error)) { echo $error; }; ?>
                <h3>Change Password</h3><br><hr>
					<form method="POST" action="<?php echo base_url('User_Ctrl/change_password'); ?>">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="varchar">Masukkan Password Baru<span class="text-danger"> *</span></label>
                                <input type="password" class="form-control" name="password_user" placeholder="Masukkan Password" required>
                            </div>
                        </div>
						<div class="col-md-4">
                            <div class="form-group">
                                <label for="varchar">Konfirmasi Password Baru<span class="text-danger"> *</span></label>
                                <input type="password" class="form-control" name="password_user2" placeholder="Masukkan Konfirmasi Password" required>
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
	<script type="text/javascript">
		$(document).ready(function () {
            document.getElementById("banner").style.display = "none";
            document.getElementById("kategori").style.display = "none";
        });
	</script>