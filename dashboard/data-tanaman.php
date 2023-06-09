<?php
session_start();
include "query.php";
if (!isset($_SESSION['admin'])) {
    if (!isset($_SESSION['login'])) {
        header("Location: login.php");
        exit;
    } else {
        header("location:profil.php?id=$id&role=$role");
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
    <title>Data Tanaman</title>
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
        <svg xmlns="http://www.w3.org/2000/svg" style="display: none;">
            <symbol id="check-circle-fill" viewBox="0 0 16 16">
                <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zm-3.97-3.03a.75.75 0 0 0-1.08.022L7.477 9.417 5.384 7.323a.75.75 0 0 0-1.06 1.06L6.97 11.03a.75.75 0 0 0 1.079-.02l3.992-4.99a.75.75 0 0 0-.01-1.05z" />
            </symbol>
            <symbol id="info-fill" viewBox="0 0 16 16">
                <path d="M8 16A8 8 0 1 0 8 0a8 8 0 0 0 0 16zm.93-9.412-1 4.705c-.07.34.029.533.304.533.194 0 .487-.07.686-.246l-.088.416c-.287.346-.92.598-1.465.598-.703 0-1.002-.422-.808-1.319l.738-3.468c.064-.293.006-.399-.287-.47l-.451-.081.082-.381 2.29-.287zM8 5.5a1 1 0 1 1 0-2 1 1 0 0 1 0 2z" />
            </symbol>
            <symbol id="exclamation-triangle-fill" viewBox="0 0 16 16">
                <path d="M8.982 1.566a1.13 1.13 0 0 0-1.96 0L.165 13.233c-.457.778.091 1.767.98 1.767h13.713c.889 0 1.438-.99.98-1.767L8.982 1.566zM8 5c.535 0 .954.462.9.995l-.35 3.507a.552.552 0 0 1-1.1 0L7.1 5.995A.905.905 0 0 1 8 5zm.002 6a1 1 0 1 1 0 2 1 1 0 0 1 0-2z" />
            </symbol>
        </svg>
        <h1 class="my-3">Manajemen Data Tanaman</h1>
        <?php
        if (isset($_GET['pesan'])) {
            if ($_GET['pesan'] == 1) {
                echo "
                <div class='alert alert-success d-flex align-items-center' style='width: fit-content; padding: 0.5rem;' role='alert'>
                <svg class='bi flex-shrink-0' style='width: 1.5rem ;height: 2rem; margin-right:1rem' role='img' aria-label='Success:'><use xlink:href='#check-circle-fill'/></svg>
                <div>
                    Data Berhasil Disimpan!
                </div>
                </div>";
            } else if ($_GET['pesan'] == 2) {
                echo "
                <div class='alert alert-success d-flex align-items-center' style='width: fit-content; padding: 0.5rem;' role='alert'>
                <svg class='bi flex-shrink-0' style='width: 1.5rem ;height: 2rem; margin-right:1rem' role='img' aria-label='Success:'><use xlink:href='#check-circle-fill'/></svg>
                <div>
                    Data Berhasil Diubah!
                </div>
                </div>";
            } else if ($_GET['pesan'] == 3) {
                echo "
                <div class='alert alert-warning  d-flex align-items-center' style='width: fit-content; padding: 0.5rem;' role='alert'>
                <svg class='bi flex-shrink-0 me-2' style='width: 1.5rem ;height: 2rem; margin-right:1rem' role='img' aria-label='Warning:'><use xlink:href='#info-fill'/></svg>
                <div>
                    Data Berhasil Dihapus!
                </div>
                </div>";
            } else if ($_GET['pesan'] == 4) {
                echo "
                <div class='alert alert-danger  d-flex align-items-center' style='width: fit-content; padding: 0.5rem;' role='alert'>
                <svg class='bi flex-shrink-0 me-2' style='width: 1.5rem ;height: 2rem; margin-right:1rem' role='img' aria-label='Danger:'><use xlink:href='#exclamation-triangle-fill'/></svg>
                <div>
                    Perubahan Gagal Disimpan!
                </div>
                </div>";
            }
        }
        ?>
        <div class="card mb-4">
            <div class="card-header">
                <!-- Button trigger modal -->
                <button type="button" class="btn btn-primary " data-bs-toggle="modal" data-bs-target="#exampleModal">
                    <i class="fas fa-plus"></i> Tambah Tanaman
                </button>

                <!-- Modal -->
                <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h1 class="modal-title fs-5" id="exampleModalLabel">Modal title</h1>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <form action="tambah-tanaman.php" method="post">
                                <input type="text" style="opacity: 0" name="id" value="<?php echo $id ?>">
                                <input type="text" style="opacity: 0" name="role" value="<?php echo $role ?>">
                                <div class="modal-body" style="margin-top: -2rem;">
                                    <div class="mb-3">
                                        <label for="nama" class="col-form-label">Nama Tanaman:</label>
                                        <input type="text" class="form-control" id="nama" name="nama">
                                    </div>
                                    <div class="mb-3">
                                        <label for="felp" class="col-form-label">Faktor Estimasi Lama Panen :</label>
                                        <input type="float" class="form-control" id="felp" name="felp"></input>
                                    </div>
                                    <div class="mb-3">
                                        <label for="febp" class="col-form-label">Faktor Estimasi Bobot Panen :</label>
                                        <input type="float" class="form-control" id="febp" name="febp"></input>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                    <button type="submit" class="btn btn-primary">Save changes</button>
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
                        <th>ID Tanaman</th>
                        <th>Faktor Estimasi Lama Panen</th>
                        <th>Faktor Estimasi Bobot Panen</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tfoot>
                    <tr>
                        <th>Nomor</th>
                        <th>Nama</th>
                        <th>ID Tanaman</th>
                        <th>Faktor Estimasi Lama Panen</th>
                        <th>Faktor Estimasi Bobot Panen</th>
                        <th>Aksi</th>
                    </tr>
                </tfoot>
                <tbody>
                    <?php
                    $query_mysql = mysqli_query($host, "SELECT * FROM `plant`") or die(mysqli_error($host));
                    $nomor = 1;
                    while ($data = mysqli_fetch_array($query_mysql)) {
                    ?>
                        <tr>
                            <td><?php echo $nomor++; ?></td>
                            <td><?php echo $data['nama']; ?></td>
                            <td><?php echo $data['id']; ?></td>
                            <td><?php echo $data['felp']; ?></td>
                            <td><?php echo $data['febp']; ?></td>
                            <td>
                                <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#editModal<?php echo $nomor; ?>">
                                    <strong> Ubah</strong>
                                </button>
                                <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#deleteModal<?php echo $nomor; ?>">
                                    <strong> Hapus</strong>
                                </button>
                                <!-- Modal Ubah-->
                                <div class="modal fade" id="editModal<?php echo $nomor; ?>" tabindex="-1" aria-labelledby="editModal<?php echo $nomor; ?>Label" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h1 class="modal-title fs-5" id="editModal<?php echo $nomor; ?>Label">Ubah Data</h1>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                <form action="edit-tanaman.php" method="post">
                                                    <input type="text" style="opacity: 0" name="id" value="<?php echo $data['id'] ?>">
                                                    <div class="modal-body" style="margin-top: -2rem;">
                                                        <div>
                                                            <label for="nama" class="col-form-label">Nama Tanaman:</label>
                                                            <input type="text" class="form-control" id="nama" name="nama" value="<?php echo $data['nama'] ?>">
                                                        </div>
                                                        <div>
                                                            <label for="felp" class="col-form-label">Faktor Estimasi Lama Panen :</label>
                                                            <input type="float" class="form-control" id="felp" name="felp" value="<?php echo $data['felp'] ?>"></input>
                                                        </div>
                                                        <div>
                                                            <label for="febp" class="col-form-label">Faktor Estimasi Bobot Panen :</label>
                                                            <input type="float" class="form-control" id="febp" name="febp" value="<?php echo $data['febp'] ?>"></input>
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
        <!-- Modal Hapus -->
        <div class="modal fade" id="deleteModal<?php echo $nomor; ?>" tabindex="-1" aria-labelledby="deleteModal<?php echo $nomor; ?>Label" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="deleteModal<?php echo $nomor; ?>Label">Hapus Data</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body" align="center">
                        Apakah Anda yakin ingin menghapus data tanaman <strong> <?php echo $data['nama'] ?> </strong>?
                    </div>
                    <div class=" modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                        <a href="hapus_tanaman_fcn.php?id=<?php echo $data['id'] ?>"><button type="button" class="btn btn-primary">Ya</button></a>
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
</main>







<?php
include "template/footer.php"
?>