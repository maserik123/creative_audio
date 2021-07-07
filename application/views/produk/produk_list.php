<?php
$this->load->view('templates/header');
$level = $this->session->userdata('level');
?>
<div class="card">
    <div class="header">
        <h4 class="title">Data Produk</h4><br>
        <?php echo anchor(site_url('Produk_Ctrl/create'), '(+) Tambah', 'class="btn btn-info btn-fill"'); ?>
        <p class="category"><?php echo $this->session->userdata('message') <> '' ? $this->session->userdata('message') : ''; ?></p>
    </div>
    <div class="content table-responsive ">
        <table id="mytable" class="table table-bordered table-hover table-striped">
            <thead>
                <tr>
                    <th>
                        <center>No
                    </th>
                    <th>
                        <center>Nama Produk
                    </th>
                    <th>
                        <center>Harga Beli
                    </th>
                    <th>
                        <center>Harga Jual
                    </th>
                    <th>
                        <center>Stok
                    </th>
                    <th>
                        <center>Kat Produk
                    </th>
                    <th>
                        <center>Status Stok
                    </th>
                    <th>
                        <center>Foto
                    </th>
                    <th>
                        <center>ROP
                    </th>
                    <th>
                        <center>EOQ
                    </th>
                    <th>
                        <center>Aksi
                    </th>
                </tr>
            </thead>
            <tbody>
                <?php
                $no = 1;
                foreach ($produk as $u) {
                    $kode = $u->id_produk;
                ?>
                    <tr>
                        <td>
                            <center><?php echo $no++ ?>
                        </td>
                        <td>
                            <center><?php echo $u->nama_produk ?>
                        </td>
                        <td>
                            <center>Rp. <?php echo number_format($u->harga_beli, 0, ",", "."); ?>
                        </td>
                        <td>
                            <center>Rp. <?php echo number_format($u->harga_jual, 0, ",", "."); ?>
                        </td>
                        <td>
                            <center><?php echo $u->stok_produk ?>
                        </td>
                        <td>
                            <center><?php echo $u->kategori_produk ?>
                        </td>
                        <td>
                            <center><?php echo $u->stok_produk < $u->rop ? '<div style="font-size:12px;background-color:red;color:white" >Stok butuh ditambah</div>' : '<div style="font-size:12px;background-color:green;color:white">Stok masih aman</div>'; ?>
                        </td>
                        <td>
                            <center><img src="<?php echo base_url('uploads/'); ?><?= $u->foto_produk ?>" style="height: 50px;">
                        </td>
                        <td>
                            <center><?php echo $u->rop ?>
                        </td>
                        <td>
                            <center><?php echo $u->eoq ?>
                        </td>
                        <td>
                            <center><?php echo anchor(site_url('Produk_Ctrl/read/') . $kode, '<button class="btn btn-sm btn-success"><i class="pe-7s-search"></i></button>') . " "
                                        . anchor(site_url('Produk_Ctrl/update/') . $kode, '<button class="btn btn-sm btn-info"><i class="pe-7s-pen"></i></button>') . " "
                                        . anchor(site_url('Produk_Ctrl/delete/') . $kode, '<button class="btn btn-sm btn-danger"><i class="pe-7s-trash"></i></button>', 'onclick="javasciprt: return confirm(\'Apakah kamu yakin?\')"') ?>
                        </td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>
</div>
<?php $this->load->view('templates/footer'); ?>