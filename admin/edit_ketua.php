<?php  
session_start();
include_once "library/database.php";

if (isset($_GET['id_ketua'])) {
    $tampil = $koneksi->prepare("SELECT id_ketua, nama_lengkap, alamat, no_hp, jabatan, username, password FROM tbl_ketua WHERE id_ketua = ?");
    $tampil->bind_param("i", $_GET['id_ketua']);
    $tampil->execute();
    $tampil->store_result();
    $tampil->bind_result($id_ketua, $nama_lengkap, $alamat, $no_hp, $jabatan, $username, $password);

    while ($tampil->fetch()) {
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <title>Edit Data Ketua</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport" />
    <link rel="stylesheet" href="../assets/plugins/bootstrap/css/bootstrap.css" />
    <link rel="stylesheet" href="../assets/css/main.css" />
    <link rel="stylesheet" href="../assets/css/theme.css" />
    <link rel="stylesheet" href="../assets/css/MoneAdmin.css" />
    <link rel="stylesheet" href="../assets/plugins/Font-Awesome/css/font-awesome.css" />
</head>

<body class="padTop53">
    <div id="wrap">
        <!-- HEADER -->
        <div id="top">
            <nav class="navbar navbar-inverse navbar-fixed-top" style="padding-top: 10px;">
                <a class="accordion-toggle btn btn-primary btn-sm visible-xs" data-toggle="collapse" href="#menu" id="menu-toggle">
                    <i class="icon-align-justify"></i>
                </a>
                <header class="navbar-header">
                    <a href="index.php" class="navbar-brand">
                        <b class="text-primary">SIMAS Jami'Riyadhis</b>
                    </a>
                </header>
                <ul class="nav navbar-top-links navbar-right">
                    <li><a href="logout.php"><i class="icon-signout"></i> Logout </a></li>
                </ul>
            </nav>
        </div>
        <!-- END HEADER -->

        <!-- MENU -->
        <div id="left">
            <div class="media user-media well-small">
                <a class="user-link" href="#"><img class="media-object img-thumbnail user-img" src="../assets/img/masjid.png" /></a>
                <br />
                <div class="media-body">
                    <h5 class="media-heading"><?php echo $_SESSION["nama_admin"]; ?></h5>
                    <ul class="list-unstyled user-info">
                        <li><a class="btn btn-success btn-xs btn-circle"></a> Online</li>
                    </ul>
                </div>
                <br />
            </div>
            <ul id="menu" class="collapse"><?php include_once "menu.php"; ?></ul>
        </div>
        <!-- END MENU -->

        <!-- PAGE CONTENT -->
        <div id="content">
            <div class="inner" style="min-height: 700px;">
                <div class="row">
                    <div class="col-lg-12"><h1>Form Ketua</h1></div>
                </div>
                <hr />
                <div class="col-lg-12">
                    <div class="box">
                        <header class="dark">
                            <div class="icons"><i class="icon-user"></i></div>
                            <h5>Ubah Data Ketua</h5>
                            <div class="toolbar">
                                <ul class="nav">
                                    <li>
                                        <div class="btn-group">
                                            <a class="accordion-toggle btn btn-xs minimize-box" data-toggle="collapse" href="#collapse2">
                                                <i class="icon-chevron-up"></i>
                                            </a>
                                        </div>
                                    </li>
                                </ul>
                            </div>
                        </header>
                        <div id="collapse2" class="body collapse in">
                            <form class="form-horizontal" action="contents/proses_update_ketua.php" method="POST">
                                <input type="hidden" name="id_ketua" value="<?php echo $id_ketua; ?>"/>

                                <div class="form-group">
                                    <label class="control-label col-lg-4">Nama Lengkap</label>
                                    <div class="col-lg-4">
                                        <input type="text" name="nama_lengkap" class="form-control" value="<?php echo $nama_lengkap; ?>" required />
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="control-label col-lg-4">Alamat</label>
                                    <div class="col-lg-4">
                                        <textarea name="alamat" class="form-control" required><?php echo $alamat; ?></textarea>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="control-label col-lg-4">No HP</label>
                                    <div class="col-lg-4">
                                        <input type="text" name="no_hp" class="form-control" value="<?php echo $no_hp; ?>" required />
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="control-label col-lg-4">Jabatan</label>
                                    <div class="col-lg-4">
                                        <input type="text" name="jabatan" class="form-control" value="<?php echo $jabatan; ?>" required />
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="control-label col-lg-4">Username</label>
                                    <div class="col-lg-4">
                                        <input type="text" name="username" class="form-control" value="<?php echo $username; ?>" required />
                                    </div>
                                </div>

                                <div style="text-align:center" class="form-actions no-margin-bottom"> 
                                    <button type="submit" class="btn btn-grad btn-success btn-lg">
                                        <i class="icon-save"></i> Update
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- END PAGE CONTENT -->

        <div id="right">
            <div class="well well-small">
                <button class="btn btn-primary btn-block">Bantuan</button>
                <button class="btn btn-success btn-block">Profil</button>
            </div>
        </div>
    </div>

    <div id="footer">
        <p>&copy; SIMAS Jami'Riyadhis 2025</p>
    </div>

    <!-- GLOBAL SCRIPTS -->
    <script src="../assets/plugins/jquery-2.0.3.min.js"></script>
    <script src="../assets/plugins/bootstrap/js/bootstrap.min.js"></script>
    <script src="../assets/plugins/modernizr-2.6.2-respond-1.1.0.min.js"></script>
</body>
</html>

<?php
    }
}
?>
