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
include "query.php";
include "template/sidebar.php"
?>


<main>
    <div class="container-fluid px-4">
        <h1 class="my-3">Manajemen Data Pengguna</h1>

        <div class="card mb-4">
            <div class="card-header">
            </div>
            <div class="card-body">
                <table id="datatablesSimple">
                    <thead>
                        <tr>
                            <th>Nomor</th>
                            <th>Nama</th>
                            <th>Role</th>
                            <th>Nomor Telepone</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th>Nomor</th>
                            <th>Nama</th>
                            <th>Role</th>
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
                                <td><?php echo $data['phone']; ?></td>
                                <td>
                                    <a class="edit" style="color: white;text-decoration:none" href="edit_user.php?id=<?php echo $data['id'] . "&role=" . $data['role'] . "&ida=" . $_GET['id'] . "&rolea=" . $_GET['role']; ?>"><button class="btn btn-success"><strong>Edit</strong></button></a>
                                    <a class="edit" style="color: white;text-decoration:none" href="hapus.php?id=<?php echo $data['id'] . "&role=" . $data['role'] . "&ida=" . $_GET['id'] . "&rolea=" . $_GET['role'];; ?>"><button class="btn btn-danger"><strong>Hapus</strong></button></a>
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