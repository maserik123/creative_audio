
<div class="card">
    <div class="header">
        <h4 class="title">Form Member</h4>
        <p class="category"><span class="text-danger"> * Wajib Diisi</span></p>
        <p class="category"><?php echo $this->session->userdata('message') <> '' ? $this->session->userdata('message') : ''; ?></p>
    </div>
    <div class="content">
    	<?php echo form_open_multipart($this->uri->segment(3) ? 'User_Ctrl/update_action' : 'User_Ctrl/create_action');?>
	    <input type="hidden" name="id_user" value="<?php echo $id_user; ?>" /> 
		<div class="row">
		   <div class="col-md-4">
				<div class="form-group">
					<label for="varchar">Nama Member <?= form_error('nama_user'); ?><span class="text-danger"> *</span></label>
					<input type="text" name="nama_user" class="form-control" placeholder="Masukkan Nama" value="<?php echo $nama_user; ?>" required>
				</div>
			</div>
		   <div class="col-md-4">
				<div class="form-group">
					<label for="varchar">Email Member <?= form_error('email_user'); ?><span class="text-danger"> *</span></label>
					<input type="email" name="email_user" class="form-control" placeholder="Masukkan Email" value="<?php echo $email_user; ?>" required>
				</div>
			</div>
			<div class="col-md-4">
				<div class="form-group">
					<label for="varchar">Telp Member <?= form_error('telp_user'); ?><span class="text-danger"> *</span></label>
					<input type="number" class="form-control" name="telp_user" placeholder="Masukkan Telp" value="<?php echo $telp_user; ?>" required>
				</div>
			</div>
		   <div class="col-md-8">
				<div class="form-group">
					<label for="varchar">Alamat Member <?= form_error('alamat_user'); ?><span class="text-danger"> *</span></label>
					<input type="text" name="alamat_user" class="form-control" placeholder="Masukkan Alamat" value="<?php echo $alamat_user; ?>" required>
				</div>
			</div>
		   <div class="col-md-4">
				<div class="form-group">
					<label for="varchar">Provinsi Member <?= form_error('provinsi_user'); ?><span class="text-danger"> *</span></label>
					<input type="text" name="provinsi_user" class="form-control" placeholder="Masukkan Provinsi" value="<?php echo $provinsi_user; ?>" required>
				</div>
			</div>
		   <div class="col-md-4">
				<div class="form-group">
					<label for="varchar">Kota Member <?= form_error('kota_user'); ?><span class="text-danger"> *</span></label>
					<input type="text" name="kota_user" class="form-control" placeholder="Masukkan Kota" value="<?php echo $kota_user; ?>" required>
				</div>
			</div>
			<div class="col-md-4">
				<div class="form-group">
					<label for="varchar">Kode Pos <?= form_error('kode_pos'); ?><span class="text-danger"> *</span></label>
					<input type="number" class="form-control" name="kode_pos" placeholder="Masukkan Kode Pos" value="<?php echo $kode_pos; ?>" required>
				</div>
			</div>
			<div class="col-md-4">
				<div class="form-group">
					<label for="varchar">Password <?= form_error('password_user'); ?><span class="text-danger"> *</span></label>
					<input type="password" class="form-control" name="password_user" placeholder="Masukkan Password" required>
				</div>
			</div>
			<div class="col-md-12" style="margin-bottom: 10px;">
				<button type="submit" class="btn btn-primary">Simpan</button> 
				<a href="<?php echo site_url('User_Ctrl') ?>" class="btn btn-warning">Batal</a>
			</div>
		</div>
    </div>
</div>