<?php
session_start();
if (!empty($_SESSION["username_petugas"])) {
    header("Location: petugas/index.php");
    exit();
}
elseif (!empty($_SESSION["username_admin"])) {
    header("Location: admin/index.php");
    exit();
}
elseif (!empty($_SESSION["username_ketua"])) {
    header("Location: ketua/index.php");
    exit();
}

$tab = isset($_GET['tab']) ? $_GET['tab'] : 'petugas';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <title>Administrator | Login Page</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport" />
    <link rel="stylesheet" href="assets/plugins/bootstrap/css/bootstrap.css" />
    <link rel="stylesheet" href="assets/css/login.css" />
    <link rel="stylesheet" href="assets/plugins/magic/magic.css" />
    <link rel="stylesheet" href="assets/css/main.css" />
    <link rel="stylesheet" href="assets/css/theme.css" />
    <link rel="stylesheet" href="assets/css/MoneAdmin.css" />
    <link rel="stylesheet" href="assets/plugins/Font-Awesome/css/font-awesome.css" />
</head>
<body>
<div class="container">
    <div class="text-center"><br/>
        <div class="row">
            <div class="col-lg-12">
                <div class="col-lg-3">&nbsp;</div>
                <div class="col-lg-6">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <h2 class="text-primary"><b>Halaman Login</b></h2>
                        </div>
                        <div class="panel-body">
                            <ul class="nav nav-pills">
                                <li class="<?= $tab == 'petugas' ? 'active' : '' ?>"><a href="#petugas" data-toggle="tab">PETUGAS</a></li>
                                <li class="<?= $tab == 'ketua' ? 'active' : '' ?>"><a href="#ketua" data-toggle="tab">KETUA</a></li>
                                <li class="<?= $tab == 'admin' ? 'active' : '' ?>"><a href="#admin" data-toggle="tab">ADMIN</a></li>
                            </ul>
                            <div class="tab-content">
                                <!-- PETUGAS -->
                                <div class="tab-pane fade in <?= $tab == 'petugas' ? 'active' : '' ?>" id="petugas">
                                    <h3 class="text-muted">Login ke halaman petugas</h3>
                                    <div class="col-lg-12">
                                        <form action="proses-login-petugas.php" method="post" class="form-horizontal">
                                            <div class="form-group">
                                                <p class="text-center text-primary">Masukkan username dan password</p>
                                            </div>
                                            <div class="form-group">
                                                <div class="input-group">
                                                    <span class="input-group-addon"><i class="icon-user"></i></span>
                                                    <input type="text" name="username" placeholder="Username" class="form-control" required />
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <div class="input-group">
                                                    <span class="input-group-addon"><i class="icon-lock"></i></span>
                                                    <input type="password" name="password" placeholder="Password" class="form-control" required />
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <button class="btn btn-md btn-block btn-success" name="LoginPetugas" type="submit"><i class="icon-signin"></i><b>LOGIN</b></button>
                                                
                                            </div>
                                        </form>
                                        <button class="btn btn-md btn-block btn-danger" id="btnBatalPetugas">
    <i class="icon-undo"></i><b>BATAL</b>
</button>
                                    </div>
                                </div>

                                <!-- KETUA -->
                                <div class="tab-pane fade in <?= $tab == 'ketua' ? 'active' : '' ?>" id="ketua">
                                    <h3 class="text-muted">Login ke halaman Ketua DKM</h3>
                                    <div class="col-lg-12">
                                        <form action="proses-login-ketua.php" method="post" class="form-horizontal">
                                            <div class="form-group">
                                                <p class="text-center text-primary">Masukkan username dan password</p>
                                            </div>
                                            <div class="form-group">
                                                <div class="input-group">
                                                    <span class="input-group-addon"><i class="icon-user"></i></span>
                                                    <input type="text" name="username_ketua" placeholder="Username" class="form-control" required />
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <div class="input-group">
                                                    <span class="input-group-addon"><i class="icon-lock"></i></span>
                                                    <input type="password" name="password_ketua" placeholder="Password" class="form-control" required />
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <button class="btn btn-md btn-block btn-success" name="LoginKetua" type="submit"><i class="icon-signin"></i><b>LOGIN</b></button>
                                                
                                            </div>
                                        </form>
                                        <button class="btn btn-md btn-block btn-danger" id="btnBatalKetua">
    <i class="icon-undo"></i><b>BATAL</b>
</button>
                                    </div>
                                </div>

                                <!-- ADMIN -->
                                <div class="tab-pane fade in <?= $tab == 'admin' ? 'active' : '' ?>" id="admin">
                                    <h3 class="text-muted">Login ke halaman admin</h3>
                                    <div class="col-lg-12">
                                        <form action="proses-login-admin.php" method="post" class="form-horizontal">
                                            <div class="form-group">
                                                <p class="text-center text-primary">Masukkan username dan password</p>
                                            </div>
                                            <div class="form-group">
                                                <div class="input-group">
                                                    <span class="input-group-addon"><i class="icon-user"></i></span>
                                                    <input type="text" name="username" placeholder="Username" class="form-control" required />
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <div class="input-group">
                                                    <span class="input-group-addon"><i class="icon-lock"></i></span>
                                                    <input type="password" name="password" placeholder="Password" class="form-control" required />
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <button class="btn btn-md btn-block btn-success" name="LoginAdmin" type="submit"><i class="icon-signin"></i><b>LOGIN</b></button>
                                                
                                            </div>
                                        </form>
                                        <button class="btn btn-md btn-block btn-danger" id="btnBatalAdmin">
    <i class="icon-undo"></i><b>BATAL</b>
</button>
                                    </div>
                                </div>
                            </div> <!-- tab-content -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- PAGE LEVEL SCRIPTS -->
<script src="assets/plugins/jquery-2.0.3.min.js"></script>
<script src="assets/plugins/bootstrap/js/bootstrap.min.js"></script>
<script src="assets/js/login.js"></script>
<script>
    document.getElementById("btnBatalAdmin").addEventListener("click", function() {
        window.location.href = "admin.php";
    });document.getElementById("btnBatalPetugas").addEventListener("click", function() {
        window.location.href = "admin.php";
    });document.getElementById("btnBatalKetua").addEventListener("click", function() {
        window.location.href = "admin.php";
    });
</script>
</body>
</html>
