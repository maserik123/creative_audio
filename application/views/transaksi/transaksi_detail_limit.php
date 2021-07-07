<?php 
    $this->load->view('templates/header');
    $level = $this->session->userdata('level');
?>
<div class="card">
    <div class="header">
        <h4 class="title">Detail Pesanan Limit</h4><br>
        <?php echo anchor(site_url('Transaksi_Ctrl/limit'), '< Kembali', 'class="btn btn-info btn-fill"'); ?>
        <p class="category"><?php echo $this->session->userdata('message') <> '' ? $this->session->userdata('message') : ''; ?></p>
    </div>
    <div class="content table-responsive ">
        <table id="mytable" class="table table-bordered table-hover table-striped">
			<thead>
				<tr>
                    <th><center>No</th>
                    <th><center>Nama</th>
					<th><center>Tgl Pesan</th>
					<th><center>Nama Produk</th> 
					<th><center>Jumlah</th> 
					<th><center>Harga</th>  
				</tr>
			</thead>
			<tbody>
				<?php
                    $no=1;
					$total=0;
                    foreach ($transaksi as $u) {
                    $kode=$u->id_user;
                ?>
                <tr>
                    <td><center><?php echo $no++ ?></td>
                    <td><center><?php echo $u->nama_user ?></td>
                    <td><center><?php echo $u->tgl_transaksi ?></td>
                    <td><center><?php echo $u->nama_produk ?></td>
                    <td><center><?php echo $u->qty_transaksi ?></td>
                    <td><center>Rp. <?php echo number_format($u->harga_jual,0,",","."); ?></td>
                </tr>
                <?php } ?>
			</tbody>
		</table><hr>	
		<form method="POST" action="<?php echo base_url('Transaksi_Ctrl/batal_pesanan'); ?>">
			<input type="hidden" value="<?=$kode?>" name="id_user">
			<button type="submit" class="btn btn-lg btn-danger" onclick="javascript: return confirm('Apakah kamu yakin?')">Batalkan Semua Pesanan</button>
		</form>
    </div>
</div>
<?php $this->load->view('templates/footer'); ?>