<?php
session_start();
include "query.php";
if (!isset($_SESSION['admin'])) {
    if (!isset($_SESSION['login'])) {
        header("Location: login.php");
        exit;
    } else {
        header("location:profil.php");
        exit;
    }
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>Manajemen User</title>
    <link rel="icon" href="assets/img/rose.png">
    <link href="https://cdn.jsdelivr.net/npm/simple-datatables@latest/dist/style.css" rel="stylesheet" />
    <link href="css/styles.css" rel="stylesheet" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/js/all.min.js" crossorigin="anonymous"></script>
</head>

<?php
include "template/sidebar.php"
?>


<main>
    <div class="container-fluid px-4">
        <h1 class="my-3">Manajemen Data Pengguna</h1>

        <div class="card mb-4">
            <div class="card-header">
                <!-- Button trigger modal -->
                <button type="button" class="btn btn-primary " data-bs-toggle="modal" data-bs-target="#addUserModal">
                    <i class="fas fa-plus"></i> Tambah Pengguna
                </button>

                <!-- Modal -->
                <div class="modal fade" id="addUserModal" tabindex="-1" aria-labelledby="addUserModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h1 class="modal-title fs-5" id="addUserModalLabel">Tambah Pengguna</h1>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <form action="tambah-user.php" method="post" enctype="multipart/form-data">
                                <input type="text" style="opacity: 0" name="id" value="<?php echo $id ?>">
                                <input type="text" style="opacity: 0" name="role" value="<?php echo $role ?>">
                                <div class="modal-body" style="margin-top: -2rem;">
                                    <div>
                                        <label for="nama" class="col-form-label">Nama:</label>
                                        <input type="text" class="form-control" id="nama" name="nama">
                                    </div>
                                    <div>
                                        <label for="email" class="col-form-label">Email:</label>
                                        <input type="float" class="form-control" id="email" name="email"></input>
                                    </div>
                                    <div>
                                        <label for="pass" class="col-form-label">Password:</label>
                                        <input type="password" class="form-control" id="pass" name="pass"></input>
                                    </div>
                                    <div>
                                        <label for="phone" class="col-form-label">Nomor Telepon:</label>
                                        <input type="float" class="form-control" id="phone" name="phone"></input>
                                    </div>
                                    <label for="gender" class="col-sm-3 col-form-label">Jenis Kelamin</label>
                                    <select class="form-select" name="gender">
                                        <option selected="1" value="1">Laki-Laki</option>
                                        <option value="2">Perempuan</option>
                                    </select>
                                    <div class="mb-3">
                                        <label for="file" class="col-form-label">Upload Foto</label>
                                        <input class="form-control" type="file" id="file" name="file">
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                                    <button type="submit" class="btn btn-primary">Simpan</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="card-body">
            <table id="datatablesSimple">
                <thead>
                    <tr>
                        <th>Nomor</th>
                        <th>Nama</th>
                        <th>Role</th>
                        <th>Email</th>
                        <th>Nomor Telepone</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tfoot>
                    <tr>
                        <th>Nomor</th>
                        <th>Nama</th>
                        <th>Role</th>
                        <th>Email</th>
                        <th>Nomor Telepone</th>
                        <th>Aksi</th>
                    </tr>
                </tfoot>
                <tbody>
                    <?php
                    $query_mysql = mysqli_query($host, "SELECT * FROM `user`") or die(mysqli_error($host));
                    $nomor = 1;
                    while ($data = mysqli_fetch_array($query_mysql)) {
                    ?>
                        <tr>
                            <td><?php echo $nomor++; ?></td>
                            <td><?php echo $data['name']; ?></td>
                            <td>
                                <?php
                                if ($data['role'] == 1) {
                                    echo "Admin";
                                } else {
                                    echo "User";
                                }
                                ?>
                            </td>
                            <td><?php echo $data['email']; ?></td>
                            <td><?php echo $data['phone']; ?></td>
                            <td>
                                <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#exampleModal<?php echo $nomor ?>">
                                    <strong>Ubah</strong>
                                </button>
                                <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#deleteModal<?php echo $nomor ?>">
                                    <strong> Hapus</strong>
                                </button>
                                <!-- Modal -->
                                <div class="modal fade" id="deleteModal<?php echo $nomor ?>" tabindex="-1" aria-labelledby="deleteModal<?php echo $nomor ?>Label" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h1 class="modal-title fs-5" id="deleteModal<?php echo $nomor ?>Label">Hapus Data</h1>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body" align="center">
                                                Apakah Anda yakin ingin menghapus pengguna <strong><?php echo $data['name'] ?> </strong> ?
                                            </div>
                                            <div class=" modal-footer">
                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                                                <a href="hapus_user_fcn.php?id=<?php echo $data['id'] ?>"><button type="button" class="btn btn-primary">Ya</button></a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- Modal -->
                                <div class="modal fade" id="exampleModal<?php echo $nomor ?>" tabindex="-1" aria-labelledby="exampleModal<?php echo $nomor ?>Label" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h1 class="modal-title fs-5" id="exampleModal<?php echo $nomor ?>Label">Ubah Profil</h1>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                <form action="ubah_user_fcn.php" method="post" enctype="multipart/form-data">
                                                    <div> <input style=" opacity:0" name="id" value="<?php echo $data['id'] ?>">
                                                    </div>
                                                    <div class="col-sm" style="margin-top: -2rem;">
                                                        <label for="email" class="col-sm-3 col-form-label">Email</label>
                                                        <div class="col">
                                                            <input type="text" class="form-control" id="email" name="email" value="<?php echo $data['email']; ?>">
                                                        </div>
                                                        <label for="name" class="col-sm-3 col-form-label">Nama Lengkap</label>
                                                        <div class="col">
                                                            <input type="text" class="form-control" id="name" name="name" value="<?php echo $data['name']; ?>">
                                                        </div>
                                                        <label for="phone" class="col-sm-3 col-form-label">Nomor Telepon</label>
                                                        <div class="col">
                                                            <input type="text" class="form-control" id="phone" name="phone" value="<?php echo $data['phone']; ?>">
                                                        </div>
                                                        <label for="pass" class="col-sm-3 col-form-label">Password</label>
                                                        <div class="col">
                                                            <input type="text" class="form-control" id="pass" name="pass" value="<?php echo $data['pass']; ?>">
                                                        </div>
                                                        <label for="gender" class="col-sm-3 col-form-label">Jenis Kelamin</label>
                                                        <select class="form-select" name="gender">
                                                            <option selected="1" value="1">Laki-Laki</option>
                                                            <option value="2">Perempuan</option>
                                                        </select>
                                                        <div class="mb-3">
                                                            <label for="file" class="col-form-label">Upload Foto</label>
                                                            <input class="form-control" type="file" id="file" name="file">
                                                        </div>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                                        <button type="submit" class="btn btn-primary">Simpan</button>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </td>
                        </tr>
                    <?php } ?>

                </tbody>
            </table>
        </div>
    </div>
    </div>
</main>





<?php
include "template/footer.php"
?>