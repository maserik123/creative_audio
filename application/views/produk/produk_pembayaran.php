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
                <h3>Checkout Pesanan</h3>
                <hr>
                Silahkan melakukan pembayaran ke No. Rekening Berikut:<br>
                - 7101869088 (BSM) <br>
                - 465401020684052 (BRI) <br><br>


                Alamat Penerima : <br>
                <b><?= $user->alamat_user ?>, Prov. <?= $user->provinsi_user ?>, Kota. <?= $user->kota_user ?>, Kec. <?= $user->kecamatan_user ?>, Kode Pos : <?= $user->kode_pos ?><br>
                    Telp. <?= $user->telp_user ?> (<?= $user->nama_user ?>)</b>
                <br><br>

                Total Belanja : <br>
                <b><?= number_format($totalBelanja, 0, ",", "."); ?></b>
                <br><br>

                Kurir Pengiriman : <br>
                <b><?= $kurir . ' ( Rp.' . number_format($hargaKurir, 0, ",", ".") . ')'; ?></b>
                <br><br>

                Total Pembayaran Sebesar : <br>
                <b>Rp. <?php echo number_format($total, 0, ",", "."); ?></b><br><br>

                <hr>Silahkan upload bukti pembayaran di sini :
                <hr>
                <form method="post" action="<?php echo base_url('Transaksi_Ctrl/checkout_action'); ?>" enctype="multipart/form-data">
                    <input type="hidden" class="form-control" name="total_pembayaran" value="<?= $total ?>">
                    <input type="hidden" class="form-control" name="kurir_pengiriman" value="<?= $pengiriman ?>">
                    <div class="col-lg-4">
                        <input type="hidden" value="<?php echo date('Y-m-d') ?>" class="form-control" name="tgl_pembayaran" readonly>
                    </div><br>
                    <div class="col-lg-4">
                        Bukti Bayar : <input type="file" class="form-control" name="bukti_pembayaran" required>
                    </div><br>
                    <div class="col-lg-4">
                        <span class="btn btn-md btn-danger" OnClick="window.location='<?php echo base_url('Transaksi_Ctrl/checkout') ?>'">Kembali</span>
                        <input type="submit" class="btn btn-md btn-success" value="Simpan">
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>
<!-- Featured Section End -->
<?php $this->load->view('templates/footer_belanja'); ?>
<script type="text/javascript">
    $(document).ready(function() {
        document.getElementById("banner").style.display = "none";
        document.getElementById("kategori").style.display = "none";
    });
</script>