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
            <div class="col-lg-12" style="padding:30px;border:3px solid green;margin-top:-100px;min-height:300px;">
                <h3>Keranjang Belanja</h3>
                <hr>
                <table width="100%">
                    <tr>
                        <th>Foto</th>
                        <th>Produk</th>
                        <th>Harga</th>
                        <th>Jumlah</th>
                        <th>Total</th>
                        <th>Aksi</th>
                    </tr>
                    <?php
                    $no = 1;
                    foreach ($produk as $u) {
                        $kode = $u->id_transaksi;
                    ?>
                        <tr>
                            <td><img src="<?php echo base_url('uploads/'); ?><?= $u->foto_produk ?>" width="100"></td>
                            <td><?php echo $u->nama_produk ?></td>
                            <td>Rp. <?php echo number_format($u->harga_jual, 0, ",", "."); ?></td>
                            <td><?php echo $u->qty_transaksi ?></td>
                            <td>Rp. <?php echo number_format($u->total_transaksi, 0, ",", "."); ?></td>
                            <td><?php echo anchor(site_url('Transaksi_Ctrl/delete/') . $kode, '<button class="btn btn-sm btn-danger"><i class="fa fa-trash"></i></button>', 'onclick="javasciprt: return confirm(\'Apakah kamu yakin?\')"') ?></td>
                        </tr>
                    <?php } ?>
                    <tr>
                        <th>&nbsp;</th>
                        <th>&nbsp;</th>
                        <th>&nbsp;</th>
                        <th>&nbsp;</th>
                        <th>&nbsp;</th>
                        <th>&nbsp;</th>
                    </tr>
                    <tr>
                        <th>&nbsp;</th>
                        <th>&nbsp;</th>
                        <th>&nbsp;</th>
                        <th>&nbsp;</th>
                        <th>&nbsp;</th>
                        <th>&nbsp;</th>
                    </tr>
                    <?php
                    $kode = $this->session->userdata('kode');
                    if ($kode != '') {
                        $query = $this->db->query('SELECT * FROM tbl_transaksi WHERE aktif="0" AND id_user="' . $kode . '"');
                        if ($query->num_rows() > 0) {
                    ?>
                            <form method="POST" action="<?= base_url("Transaksi_Ctrl/checkout") ?>">
                                <tr style="font-size:20px;">
                                    <th colspan="4">Total Belanja :</th>
                                    <th colspan="2"> <?php echo rupiah_format($total->total); ?></th>
                                </tr>
                                <tr>
                                    <th colspan="4">&nbsp;</th>
                                    <th colspan="2"><br>
                                        <button type="button" class="btn btn-sm btn-info" onclick="window.location = '<?php echo base_url('Main_Ctrl/produk'); ?>'">
                                            <li class="fa fa-shopping-cart"></li> Belanja Lagi
                                        </button>
                                        <button type="submit" class="btn btn-sm btn-success" id="checkout" onclick="javascript: return confirm('Apakah kamu yakin?')"><i class="fa fa-shopping-bag"></i> Checkout</button>
                                    </th>
                                </tr>
                            </form>
                    <?php
                        }
                    }
                    ?>
                </table>
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
        //document.getElementById("checkout").disabled=true;
    });

    function cekKurir() {
        var kurir = $("#kurir").val();
        console.log(kurir);
        if (kurir == "") {
            document.getElementById("checkout").disabled = true;
        } else {
            document.getElementById("checkout").disabled = false;
        }
    }
</script>