<?php $this->load->view('templates/header'); ?>
<div class="card">
	<div class="header">
		<h4 class="title">Form Produk</h4>
		<p class="category"><?php echo $this->session->userdata('message') <> '' ? $this->session->userdata('message') : ''; ?></p>
	</div>
	<div class="content">
		<?php echo form_open_multipart($this->uri->segment(3) ? 'Produk_Ctrl/update_action' : 'Produk_Ctrl/create_action'); ?>
		<input type="hidden" name="id_produk" value="<?php echo $id_produk; ?>" />
		<div class="row">
			<div class="col-md-0">
			</div>
			<div class="col-md-8">
				<div class="form-group">
					<label for="varchar">Nama Produk <?= form_error('nama_produk'); ?><span class="text-danger"> *</span></label>
					<input type="text" name="nama_produk" class="form-control" placeholder="Masukkan Produk" value="<?php echo $nama_produk; ?>" required>
				</div>
			</div>
			<div class="col-md-4">
				<div class="form-group">
					<label for="varchar">Harga Beli <?= form_error('harga_beli'); ?><span class="text-danger"> *</span></label>
					<input type="number" class="form-control" name="harga_beli" placeholder="Masukkan Harga" value="<?php echo $harga_beli; ?>" required>
				</div>
			</div>
			<div class="col-md-4">
				<div class="form-group">
					<label for="varchar">Harga Jual <?= form_error('harga_jual'); ?><span class="text-danger"> *</span></label>
					<input type="number" class="form-control" name="harga_jual" placeholder="Masukkan Harga" value="<?php echo $harga_jual; ?>" required>
				</div>
			</div>
			<div class="col-md-4">
				<div class="form-group">
					<label for="varchar">Stok <?= form_error('stok_produk'); ?><span class="text-danger"> *</span></label>
					<input type="number" class="form-control" name="stok_produk" placeholder="Masukkan Stok" value="<?php echo $stok_produk; ?>" required>
				</div>
			</div>
			<div class="col-md-4">
				<div class="form-group">
					<label for="varchar">Kat Produk<?= form_error('kategori_produk'); ?><span class="text-danger"> *</span></label>
					<select name="kategori_produk" class="form-control" required>
						<option value="<?php echo $kategori_produk; ?>"><?php echo $kategori_produk; ?></option>
						<option value="Alarm">Alarm</option>
						<option value="Audio">Audio</option>
						<option value="Klakson">Klakson</option>
						<option value="Sarung_Jok">Sarung Jok</option>
						<option value="Sarung_Stir">Sarung Stir</option>
						<option value="TV">TV</option>
						<option value="Wiper">Wiper</option>
					</select>
				</div>
			</div>
			<div class="col-md-4">
				<div class="form-group">
					<label for="varchar">Foto Produk <?= form_error('foto_produk'); ?><span class="text-danger"> *</span></label>
					<input type="file" class="form-control" name="foto_produk" required>
					<p class="category"><span class="text-danger"> * Ukuran Foto Max. 2 MB (Jpg\Png)</span></p>
					<p class="category"><span class="text-danger"> * Wajib Diisi</span></p>
				</div>
			</div>
			<div class="col-md-4">
				<div class="form-group">
					<label for="varchar">Deskripsi Produk<span class="text-danger"> *</span></label>
					<textarea name="deskripsi_produk" id="deskripsi_produk" class="form-control"><?php echo $deskripsi_produk; ?></textarea>
					<!-- <input type="number" class="form-control" name="stok_produk" placeholder="Masukkan Stok" value="<?php echo $stok_produk; ?>" required> -->
				</div>
			</div>
			<div class="col-md-12" style="margin-bottom: 10px;">
				<button type="submit" class="btn btn-primary">Simpan</button>
				<a href="<?php echo site_url('Produk_Ctrl') ?>" class="btn btn-warning">Batal</a>
			</div>
		</div>
	</div>
</div>
<?php $this->load->view('templates/footer'); ?>