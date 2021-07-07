<?php 
    $this->load->view('templates/header');
    $level = $this->session->userdata('level');
?>
<div class="col-md-9">
	<div class="col-md-2">
		<div class="card">
			<div class="header">
				<h4 class="title">Member</h4>
			</div>
			<div class="content" style="font-size:20px;">
			<center>
				<?php 
					$jum_pelanggan=$this->db->query("select COUNT(id_pelanggan) as Jumlah from tbl_pelanggan WHERE no_member!=''")->row();
					echo $jum_pelanggan->Jumlah.' Orang';
				?>
			</center>
			</div>
		</div>
	</div>
	<div class="col-md-2">
		<div class="card">
			<div class="header">
				<h4 class="title">Non-Member</h4>
			</div>
			<div class="content" style="font-size:20px;">
			<center>
				<?php 
					$jum_pelanggan2=$this->db->query("select COUNT(id_pelanggan) as Jumlah from tbl_pelanggan WHERE no_member=''")->row();
					echo $jum_pelanggan2->Jumlah.' Orang';
				?>
			</center>
			</div>
		</div>
	</div>
	<div class="col-md-4">
		<div class="card">
			<div class="header">
				<h4 class="title">Layanan Terlaris</h4>
			</div>
			<div class="content" style="font-size:20px;">
			<center>
				<?php 
					$layanan=$this->db->query("select b.nama_produk, COUNT(a.id_produk) as Banyak from tbl_transaksi a, tbl_produk b WHERE a.id_produk=b.id_produk AND b.jenis_produk='Jasa' GROUP BY a.id_produk ORDER BY Banyak DESC")->row();
					echo $layanan->nama_produk;
				?>
			</center>
			</div>
		</div>
	</div>
	<div class="col-md-4">
		<div class="card">
			<div class="header">
				<h4 class="title">Produk Terlaris</h4>
			</div>
			<div class="content" style="font-size:20px;">
			<center>
				<?php 
					$produk=$this->db->query("select b.nama_produk, COUNT(a.id_produk) as Banyak from tbl_transaksi a, tbl_produk b WHERE a.id_produk=b.id_produk AND b.jenis_produk='Barang' GROUP BY a.id_produk ORDER BY Banyak DESC")->row();
					echo $produk->nama_produk;
				?>
			</center>
			</div>
		</div>
	</div>
	<div class="col-md-12">
		<div class="card">
			<div class="header">
				<h4 class="title">Grafik Transaksi Pelanggan Tahun <?=date("Y")?></h4>
			</div>
			<div class="content">
				<?php
					$data=$this->db->query("SELECT MONTH(a.tgl_transaksi) as bulan,SUM(b.harga_produk) AS total FROM tbl_transaksi a, tbl_produk b WHERE a.id_produk=b.id_produk AND YEAR(a.tgl_transaksi)='".date("Y")."' GROUP BY MONTH(a.tgl_transaksi)")->result();
					foreach($data as $data){
						$bulan[] = $data->bulan;
						$total[] = (float) $data->total;
					}
				?>
				<canvas id="canvas" width="800" height="280"></canvas>
			</div>
		</div>
	</div>
	<div class="col-md-12">
		<div class="card">
			<div class="header">
				<h4 class="title">Grafik Pelayanan Transaksi Karyawan <?=date("Y")?></h4>
			</div>
			<div class="content">
				<?php
					$data4=$this->db->query("SELECT nama_karyawan as nama,COUNT(id_transaksi) AS total FROM tbl_transaksi WHERE YEAR(tgl_transaksi)='".date("Y")."' GROUP BY nama_karyawan")->result();
					foreach($data4 as $data4){
						$karyawan[] = $data4->nama;
						$total4[] = (float) $data4->total;
					}
				?>
				<canvas id="canvas4" width="800" height="280"></canvas>
			</div>
		</div>
	</div>
	<div class="col-md-12">
		<div class="card">
			<div class="header">
				<h4 class="title">Grafik Status Pelanggan</h4>
			</div>
			<div class="content">
				<?php
					$data2=$this->db->query("SELECT *, COUNT(id_pelanggan) as total FROM tbl_pelanggan GROUP BY status_perkawinan")->result();
					foreach($data2 as $data){
						$status[] = $data->status_perkawinan;
						$total2[] = (float) $data->total;
					}
				?>
				<canvas id="canvas2" width="800" height="280"></canvas>
			</div>
		</div>
	</div>
	<div class="col-md-12">
		<div class="card">
			<div class="header">
				<h4 class="title">Grafik Usia Pelanggan</h4>
			</div>
			<div class="content">
				<?php
					$data3=$this->db->query("SELECT *,YEAR(tgl_lahir) as tahun, COUNT(YEAR(tgl_lahir)) as total FROM tbl_pelanggan GROUP BY tahun ORDER BY tahun DESC")->result();
					foreach($data3 as $data){
						$tahun[] = date("Y")-$data->tahun;
						$total3[] = (float) $data->total;
					}
				?>
				<canvas id="canvas3" width="800" height="280"></canvas>
			</div>
		</div>
	</div>
</div>
<div class="col-md-3">
	<div class="col-md-12">
		<div class="card">
			<div class="header">
				<h4 class="title">Pelanggan Poin Terbanyak</h4>
			</div>
			<div class="content" style="font-size:20px;">
			<center>
				<?php 
					$point=$this->db->query("select * from tbl_pelanggan ORDER BY point_pelanggan DESC")->row();
					echo $point->nama_pelanggan.'<br>('.$point->point_pelanggan.' Poin)';
				?>
			</center>
			</div>
		</div>
	</div>
	
	<div class="col-md-12">
		<div class="card">
			<div class="header">
				<h4 class="title">Pelanggan Terloyal</h4>
			</div>
			<div class="content" style="font-size:20px;">
			<center>
				<?php 
					$point=$this->db->query("select b.nama_pelanggan, SUM(c.harga_produk) as Total from tbl_transaksi a,tbl_pelanggan b, tbl_produk c WHERE a.id_pelanggan=b.id_pelanggan AND a.id_produk=c.id_produk GROUP BY a.id_pelanggan ORDER BY Total DESC")->row();
					echo $point->nama_pelanggan.'<br>(Rp.'.number_format($point->Total,0,",",".").')';
				?>
			</center>
			</div>
		</div>
	</div>
	<div class="col-md-12">
		<div class="card">
			<div class="header">
				<h4 class="title">Daftar Pelanggan Terbaru</h4>
			</div>
			<div class="content" style="font-size:20px;">
			<center>
				<?php 
					$pelanggan=$this->db->query("select b.nama_pelanggan, COUNT(a.id_transaksi) as transaksi from tbl_transaksi a,tbl_pelanggan b WHERE a.id_pelanggan=b.id_pelanggan GROUP BY a.id_pelanggan ORDER BY transaksi ASC")->result();
					foreach($pelanggan as $u){
						if($u->transaksi<=3){
							echo $u->nama_pelanggan.'<hr>';
						}
					}
				?>
			</center>
			</div>
		</div>
	</div>
</div>
<script type="text/javascript" src="<?php echo base_url().'assets/chart.js'?>"></script>
<script>
 
            var lineChartData = {
                labels : <?php echo json_encode($bulan);?>,
                datasets : [
                     
                    {
                        fillColor: "rgba(60,141,188,0.9)",
                        strokeColor: "rgba(60,141,188,0.8)",
                        pointColor: "#6b6f75",
                        pointStrokeColor: "#fff",
                        pointHighlightFill: "#fff",
                        pointHighlightStroke: "rgba(152,235,239,1)",
                        data : <?php echo json_encode($total);?>
                    }
 
                ]
                 
            }
			var lineChartData2 = {
                labels : <?php echo json_encode($status);?>,
                datasets : [
                     
                    {
                        fillColor: "rgba(60,141,188,0.9)",
                        strokeColor: "rgba(60,141,188,0.8)",
                        pointColor: "#6b6f75",
                        pointStrokeColor: "#fff",
                        pointHighlightFill: "#fff",
                        pointHighlightStroke: "rgba(152,235,239,1)",
                        data : <?php echo json_encode($total2);?>
                    }
 
                ]
                 
            }
			var lineChartData3 = {
                labels : <?php echo json_encode($tahun);?>,
                datasets : [
                     
                    {
                        fillColor: "rgba(60,141,188,0.9)",
                        strokeColor: "rgba(60,141,188,0.8)",
                        pointColor: "#6b6f75",
                        pointStrokeColor: "#fff",
                        pointHighlightFill: "#fff",
                        pointHighlightStroke: "rgba(152,235,239,1)",
                        data : <?php echo json_encode($total3);?>
                    }
 
                ]
                 
            }
			var lineChartData4 = {
                labels : <?php echo json_encode($karyawan);?>,
                datasets : [
                     
                    {
                        fillColor: "rgba(60,141,188,0.9)",
                        strokeColor: "rgba(60,141,188,0.8)",
                        pointColor: "#6b6f75",
                        pointStrokeColor: "#fff",
                        pointHighlightFill: "#fff",
                        pointHighlightStroke: "rgba(152,235,239,1)",
                        data : <?php echo json_encode($total4);?>
                    }
 
                ]
                 
            }
 
        var myLine = new Chart(document.getElementById("canvas").getContext("2d")).Bar(lineChartData);
        var myLine2 = new Chart(document.getElementById("canvas2").getContext("2d")).Bar(lineChartData2);
        var myLine3 = new Chart(document.getElementById("canvas3").getContext("2d")).Bar(lineChartData3);
        var myLine4 = new Chart(document.getElementById("canvas4").getContext("2d")).Bar(lineChartData4);
         
</script>
<?php $this->load->view('templates/footer');?>



	