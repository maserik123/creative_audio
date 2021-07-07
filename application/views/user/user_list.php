<?php 
    $this->load->view('templates/header');
    $level = $this->session->userdata('level');
?>
<div class="card">
    <div class="header">
        <h4 class="title">Data Member</h4><br>
            <p class="category"><?php echo $this->session->userdata('message') <> '' ? $this->session->userdata('message') : ''; ?></p>
    </div>
    <div class="content table-responsive ">
        <table id="mytable" class="table table-bordered table-hover table-striped">
            <thead>
                <tr>
                    <th><center>No</th>
                    <th><center>Nama</th>
                    <th><center>Email</th>
                    <th><center>Telp</th>
                    <th><center>Alamat</th>
                    <th><center>Provinsi</th>
                    <th><center>Kota</th>
                    <th><center>Kode Pos</th>
                    <th><center>Aksi</th>
                </tr>
            </thead>
            <tbody>
                 <?php
                    $no=1;
                    foreach ($user as $u) {
                    $kode=$u->id_user;
                ?>
                <tr>
                    <td><center><?php echo $no++ ?></td>
                    <td><center><?php echo $u->nama_user ?></td>
                    <td><center><?php echo $u->email_user ?></td>
                    <td><center><?php echo $u->telp_user ?></td>
                    <td><center><?php echo $u->alamat_user ?></td>
                    <td><center><?php echo $u->provinsi_user ?></td>
                    <td><center><?php echo $u->kota_user ?></td>
                    <td><center><?php echo $u->kode_pos ?></td>
                    <td><center><?php echo anchor(site_url('User_Ctrl/delete/').$kode,'<button class="btn btn-sm btn-danger">
                    <i class="pe-7s-trash"></i></button>','onclick="javasciprt: return confirm(\'Apakah kamu yakin?\')"') ?></td>
                </tr>
                <?php } ?>
            </tbody>            
        </table>
    </div>
</div>
<?php $this->load->view('templates/footer'); ?>
        