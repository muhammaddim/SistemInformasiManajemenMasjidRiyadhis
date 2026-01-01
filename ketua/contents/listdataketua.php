<?php  
include_once "library/database.php";
?>
<div class="inner" style="min-height: 700px;">
    <div class="row">
        <div class="col-lg-12">
            <h1> Data Ketua </h1>
        </div>
    </div>
    <hr />
    <div class="col-lg-12">
        <div class="box">
            <header class="dark">
                <div class="icons"><i class="icon-user"></i></div>
                <h5>Daftar Ketua</h5>
            </header>
            <div class="body collapse in">
                <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                    <thead>
                        <tr>
                            <th>ID Ketua</th>
                            <th>Nama</th>
                            <th>Alamat</th>
                            <th>No HP</th>
                            <th>Username</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $tampil = $koneksi->query("SELECT * FROM tbl_ketua");
                        while($data = $tampil->fetch_assoc()){
                        ?>
                        <tr>
                            <td><?php echo $data['id_ketua']; ?></td>
                            <td><?php echo $data['nama_ketua']; ?></td>
                            <td><?php echo $data['alamat_ketua']; ?></td>
                            <td><?php echo $data['nohp_ketua']; ?></td>
                            <td><?php echo $data['id_ketua']; ?></td>
                        </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
