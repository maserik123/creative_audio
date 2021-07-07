<?php 
    $this->load->view('templates/header');
    $level = $this->session->userdata('level');
?>
<div class="card">
    <div class="header">
        <h4 class="title">Detail Pesanan <?=$transaksi2->nama_user?></h4><br>
		<?php echo anchor(site_url('Transaksi_Ctrl'), '< Kembali', 'class="btn btn-info btn-fill"'); ?>
        <p class="category"><?php echo $this->session->userdata('message') <> '' ? $this->session->userdata('message') : ''; ?></p>
    </div>
    <div class="content table-responsive ">
        <table id="mytable" class="table table-bordered table-hover table-striped">
			<thead>
				<tr>
                    <th><center>No</th>
					<th><center>Tgl Pesan</th>
					<th><center>Nama Produk</th> 
					<th><center>Jumlah</th> 
					<th><center>Harga</th> 
					<th><center>Status Pesanan</th> 
				</tr>
			</thead>
			<tbody>
				<?php
                    $no=1;
					$total=0;
                    foreach ($transaksi as $u) {
                    $kode=$u->id_transaksi;
                ?>
                <tr>
                    <td><center><?php echo $no++ ?></td>
                    <td><center><?php echo $u->tgl_transaksi ?></td>
                    <td><center><?php echo $u->nama_produk ?></td>
                    <td><center><?php echo $u->qty_transaksi ?></td>
                    <td><center>Rp. <?php echo number_format($u->harga_jual,0,",","."); ?></td>
                    <td><center><?php echo $u->status_pembayaran ?></td>
                </tr>
                <?php } ?>
			</tbody>			
		</table><hr>
		<?php if($transaksi2->status_pembayaran!="Sudah Dikirim"){ ?>
		<form method="POST" action="<?php echo base_url('Transaksi_Ctrl/pengiriman'); ?>">
		<!-- <h4><div class="col-md-4">Kurir Pengiriman : <span style="float:right;"></span></div><div class="col-md-8"> <input type="text" style="font-size:20px;" class="form-control" value="<?=$transaksi2->kurir_pengiriman?>" readonly></div></h4> -->
		<h4><div class="col-md-4">Total Biaya : <span style="float:right;">Rp.</span></div><div class="col-md-8"> <input type="text" style="font-size:20px;" class="form-control" value="<?=number_format($transaksi2->total_pembayaran,0,",",".")?>" readonly></div></h4>
		<h4><div class="col-md-4">Bukti Bayar : <span style="float:right;"></span></div><div class="col-md-8"> <a href="<?php echo base_url('uploads/');?><?=$transaksi2->bukti_pembayaran?>" target="_blank">Cek Bukti Bayar</a></div></h4>
		<!-- <h4><div class="col-md-4">Masukkan Nomor Resi : <span style="float:right;"></span></div><div class="col-md-8"><input type="text" style="font-size:20px;" class="form-control" name="nomor_resi" required></div></h4> -->
		<input type="hidden" value="<?=$transaksi2->id_pembayaran?>" name="id_pembayaran">
		<button type="submit" class="btn btn-lg btn-success" id="simpan">Kirim Pesanan </button>
		</form>
		<?php } ?>
    </div>
</div>
<?php $this->load->view('templates/footer'); ?>