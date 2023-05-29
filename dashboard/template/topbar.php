<div class="container-fluid">
    <div class="d-flex justify-content-end bg-transparent" style="padding: 2.5rem 3rem 0rem 0rem;">
        <div class="dropdown bg-light">

            <button class="btn btn-outline-secondary dropdown-toggle" type="button" style="font-size: 1.2rem; font-weight: 600" data-bs-toggle="dropdown" aria-expanded="false">
                <img src="./assets/img/foto/<?php echo $foto ?>" height="50rem" alt="" style="border-radius: 50%;"> Hi, <?php echo $nama ?>!
            </button>
            <ul class=" dropdown-menu">
                <li><a class="dropdown-item" href="profil.php?id=<?php echo $id ?>&role=<?php echo $role ?>">Profil</a></li>
                <li><a class="dropdown-item" href="user-input.php?id=<?php echo $id ?>&role=<?php echo $role ?>">Data Input</a></li>
                <li><a class="dropdown-item" href="logout_fcn.php">Keluar</a></li>
            </ul>
        </div>
    </div>
</div>