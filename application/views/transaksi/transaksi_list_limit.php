<?php 
    $this->load->view('templates/header');
    $level = $this->session->userdata('level');
?>
<div class="card">
    <div class="header">
        <h4 class="title">Pesanan Limit</h4><br>
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
					<th><center>Status Pesanan</th> 
					<th><center>Aksi</th>
				</tr>
			</thead>
			<tbody>
				<?php
                    $no=1;
                    foreach ($transaksi as $u) {
                    $kode=$u->id_user;?>
                <tr>
                    <td><center><?php echo $no++ ?></td>
                    <td><center><?php echo $u->nama_user ?></td>
                    <td><center><?=$u->alamat_user?>, Prov. <?=$u->provinsi_user?>, Kota. <?=$u->kota_user?>, Kode Pos : <?=$u->kode_pos?></td>
                    <td><center><?php echo $u->telp_user ?></td>
                    <td><center><?php echo $u->tgl_transaksi ?></td>
					<td><center><button class="btn btn-sm btn-danger">Belum Bayar</button></td>
                    <td><center><?php echo anchor(site_url('Transaksi_Ctrl/detail_limit/').$kode,'<button class="btn btn-sm btn-success"><i class="pe-7s-search"></i></button>')?></td>
                </tr>
                <?php } ?>
			</tbody>			
		</table>
    </div>
</div>
<?php $this->load->view('templates/footer'); ?>