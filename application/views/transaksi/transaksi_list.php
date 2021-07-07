<?php 
    $this->load->view('templates/header');
    $level = $this->session->userdata('level');
?>
<div class="card">
    <div class="header">
        <h4 class="title">Pesanan Masuk</h4><br>
        <p class="category"><?php echo $this->session->userdata('message') <> '' ? $this->session->userdata('message') : ''; ?></p>
    </div>
    <div class="content table-responsive ">
        <table id="mytable" class="table table-bordered table-hover table-striped">
			<thead>
				<tr>
                    <th><center>No</th>
                    <th><center>Nama Pemesan</th>
                    <th><center>Alamat Pemesan</th>
					<th><center>Telp Pemesan</th>
					<th><center>Tgl Pesan</th> 
					<th><center>Total Pesanan</th> 
					<!-- <th><center>Kurir</th>  -->
					<!-- <th><center>No Resi</th>  -->
					<th><center>Bukti Pembayaran</th> 
					<th><center>Status Pesanan</th> 
					<th><center>Aksi</th>
				</tr>
			</thead>
			<tbody>
				<?php
                    $no=1;
                    foreach ($transaksi as $u) {
                    $kode=$u->id_pembayaran;?>
                <tr>
                    <td><center><?php echo $no++ ?></td>
                    <td><center><?php echo $u->nama_user ?></td>
                    <td><center><?=$u->alamat_user?>, Prov. <?=$u->provinsi_user?>, Kota. <?=$u->kota_user?>, Kode Pos : <?=$u->kode_pos?></td>
                    <td><center><?php echo $u->telp_user ?></td>
                    <td><center><?php echo $u->tgl_pembayaran ?></td>
                    <td><center>Rp. <?php echo number_format($u->total_pembayaran,0,",","."); ?></td>
                    <!-- <td><center><?php echo $u->kurir_pengiriman ?></td> -->
                    <!-- <td><center><a href="https://cekresi.com/" target="_blank"><?php echo $u->nomor_resi ?></a></td> -->
                    <td><center><img src="<?php echo base_url('uploads/');?><?=$u->bukti_pembayaran?>" style="height: 50px;"></td>
                    <td><center>
                        <?php if($u->status_pembayaran == "Sudah Bayar"){ ?>
                            <button class="btn btn-sm btn-danger">Belum Dikirim</button>
                        <?php }else{ ?>
                            <button class="btn btn-sm btn-success">Sudah Dikirim</button>
                        <?php } ?>
                    </td>
                    <td><center><?php echo anchor(site_url('Transaksi_Ctrl/detail/').$kode,'<button class="btn btn-sm btn-success"><i class="pe-7s-search"></i></button>')?></td>
                </tr>
                <?php } ?>
			</tbody>			
		</table>
    </div>
</div>
<?php $this->load->view('templates/footer'); ?>