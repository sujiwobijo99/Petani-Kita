<?php
session_start();
include "query.php";
if (!isset($_SESSION['login'])) {
    header("Location: login.php");
    exit;
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
    <title>Leaderboard</title>
    <link rel="icon" href="assets/img/rose.png">
    <link href="https://cdn.jsdelivr.net/npm/simple-datatables@latest/dist/style.css" rel="stylesheet" />
    <link href="css/styles.css" rel="stylesheet" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/js/all.min.js" crossorigin="anonymous"></script>
</head>

<?php
include "template/sidebar.php"
?>

<style>
    html {
        --black: #000000;
        --white: #ffffff;
        --darkest: #101010;
        --darker: #16171A;
        --dark: #A3AFBF;
        --medium: #DFE7EF;
        --light: #CAD4E1;
        --lighter: #F5F8FC;
        --lightest: var(--white);
        --primary: #7B16FF;
        --primary-light: #DDD9FF;
        --primary-trans: rgba(123, 22, 255, 0.4);
        --yellow: #FDCB6E;
        --orange: #E17055;
        --teal: #00CEC9;
        --bg: var(--lightest);
        --color: var(--lightest);
        --surface: var(--darker);
    }

    html {
        /* font-size: 62.5%; */
        box-sizing: border-box;
    }

    *,
    *:before,
    *:after {
        box-sizing: inherit;
    }

    html,
    body {
        width: 100%;
        height: 100%;
    }

    body {
        background: var(--bg);
        color: var(--color);
        /* font-size: 1.6rem; */
        font-family: "Overpass Mono", system-ui;
    }

    h1,
    h2,
    h3,
    h4,
    h5,
    h6 {
        font-weight: 400;
        text-transform: uppercase;
        letter-spacing: 0.05em;
        margin-top: 0.8rem;
        margin-bottom: 0.8rem;
        font-family: "Oswald", system-ui;
    }

    a {
        color: var(--primary);
        text-decoration: none;
        transition: all 120ms ease-out 0s;
        display: inline-block;
        border-radius: 0.4rem;
    }

    /* a:hover {
        background: var(--primary-trans);
        color: var(--primary-light);
        box-shadow: 0px 0px 0px 0.4rem var(--primary-trans);
    }

    button,
    textarea,
    input,
    select {
        font-family: inherit;
        color: inherit;
    }

    */
    button:active,
    button:focus,
    textarea:active,
    textarea:focus,
    input:active,
    input:focus,
    select:active,
    select:focus {
        outline: 0;
    }

    button,
    select {
        cursor: pointer;
    }

    .l-wrapper {
        width: 100%;
        max-width: 960px;
        margin: auto;
        padding: 1.6rem 1.6rem 3.2rem;
    }

    .l-grid {
        display: grid;
        grid-template-columns: 1fr 2fr;
        grid-column-gap: 1.6rem;
        grid-row-gap: 1.6rem;
        position: relative;
    }

    @media screen and (max-width: 700px) {
        .l-grid {
            grid-template-columns: 1fr;
        }
    }

    .c-header {
        padding: 1rem 0;
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 2rem;
        position: relative;
    }

    .c-header:before {
        content: "";
        position: absolute;
        bottom: 0;
        right: 0;
        left: 0;
        height: 0.2rem;
        background: var(--primary-trans);
    }

    .c-card {
        border-radius: 0.8rem;
        background: var(--surface);
        width: 100%;
        margin-bottom: 1.6rem;
        box-shadow: 0px 0px 0px 1px rgba(255, 255, 255, 0.12);
    }

    .c-card__body,
    .c-card__header {
        padding: 2.4rem;
    }

    @media screen and (max-width: 700px) {

        .c-card__body,
        .c-card__header {
            padding: 1.2rem;
        }
    }

    .c-card__header {
        display: flex;
        align-items: center;
        justify-content: space-between;
        padding-bottom: 0;
    }

    @media screen and (max-width: 700px) {
        .c-card__header {
            flex-direction: column;
        }
    }

    @media screen and (max-width: 700px) {
        .c-place {
            transform: translateY(4px);
        }
    }

    .c-logo {
        display: inline-block;
        width: 100%;
        max-width: 4rem;
        -webkit-user-select: none;
        -moz-user-select: none;
        -ms-user-select: none;
        user-select: none;
    }

    .c-list {
        margin: 0;
        padding: 0;
        list-style-type: none;
    }

    .c-list__item {
        padding: 1.6rem 0;
    }

    .c-list__item .c-flag {
        margin-top: 0.8rem;
    }

    @media screen and (max-width: 700px) {
        .c-list__item .c-flag {
            margin-top: 0.4rem;
        }
    }

    .c-list__grid {
        display: grid;
        grid-template-columns: 4.8rem 3fr 1fr;
        grid-column-gap: 2.4rem;
    }

    @media screen and (max-width: 700px) {
        .c-list__grid {
            grid-template-columns: 3.2rem 3fr 1fr;
            grid-column-gap: 0.8rem;
        }
    }

    .c-media {
        display: inline-flex;
        align-items: center;
    }

    .c-media__content {
        padding-left: 1.6rem;
    }

    @media screen and (max-width: 700px) {
        .c-media__content {
            padding-left: 0.8rem;
        }
    }

    .c-media__title {
        margin-bottom: 0.4rem;
    }

    @media screen and (max-width: 700px) {
        .c-media__title {
            font-size: 1rem;
        }
    }

    .c-avatar {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        width: 4.8rem;
        height: 4.8rem;
        box-shadow: inset 0px 0px 0px 1px currentColor;
        border-radius: 50%;
        background: var(--lightest);
        color: var(--dark);
    }

    @media screen and (max-width: 700px) {
        .c-avatar {
            width: 3.2rem;
            height: 3.2rem;
        }
    }

    .c-avatar--lg {
        width: 9.6rem;
        height: 9.6rem;
    }

    .c-button {
        display: inline-block;
        background: var(--dark);
        border: 0;
        color: var(--white);
        font-weight: 600;
        border-radius: 0.4rem;
        padding: 1.2rem 2rem;
        transition: all 120ms ease-out 0s;
    }

    .c-button--block {
        display: block;
        width: 100%;
    }

    .c-button:hover,
    .c-button:focus {
        filter: brightness(0.9);
    }

    .c-button:focus {
        box-shadow: 0px 0px 0px 0.4rem var(--primary-trans);
    }

    .c-button:active {
        box-shadow: 0px 0px 0px 0.4rem var(--primary-trans), inset 0px 0px 0.8rem rgba(0, 0, 0, 0.2);
        filter: brightness(0.8);
    }

    .c-select {
        background: transparent;
        padding: 1.2rem;
        -webkit-appearance: none;
        -moz-appearance: none;
        appearance: none;
        font-size: 1rem;
        border-color: rgba(255, 255, 255, 0.2);
        transition: all 120ms ease-out 0s;
    }

    .c-select:hover {
        background: var(--darkest);
    }

    .c-flag {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        width: 3.2rem;
        height: 3.2rem;
        background: var(--lightest);
        color: var(--dark);
        border-radius: 0.4rem;
    }

    @media screen and (max-width: 700px) {
        .c-flag {
            width: 2.4rem;
            height: 2.4rem;
        }
    }

    .c-button--light {
        background: var(--lightest);
    }

    .c-button--primary {
        background: var(--primary);
    }

    .c-button--dark {
        background: var(--darkest);
    }

    .c-button--transparent {
        background: transparent;
    }

    .c-button--medium {
        background: var(--medium);
    }

    .c-button--yellow {
        background: var(--yellow);
    }

    .c-button--orange {
        background: var(--orange);
    }

    .c-button--teal {
        background: var(--teal);
    }

    .c-button--light-gradient {
        background: linear-gradient(to top, var(--light), var(--lightest));
    }

    .u-text--title {
        font-family: "Oswald", system-ui;
    }

    .u-text--left {
        text-align: left;
    }

    .u-text--center {
        text-align: center;
    }

    .u-text--right {
        text-align: right;
    }

    .u-bg--light {
        background: var(--lightest) !important;
    }

    .u-text--light {
        color: var(--lightest) !important;
    }

    .u-bg--primary {
        background: var(--primary) !important;
    }

    .u-text--primary {
        color: var(--primary) !important;
    }

    .u-bg--dark {
        background: var(--darkest) !important;
    }

    .u-text--dark {
        color: var(--darkest) !important;
    }

    .u-bg--transparent {
        background: transparent !important;
    }

    .u-text--transparent {
        color: transparent !important;
    }

    .u-bg--medium {
        background: var(--medium) !important;
    }

    .u-text--medium {
        color: var(--medium) !important;
    }

    .u-bg--yellow {
        background: var(--yellow) !important;
    }

    .u-text--yellow {
        color: var(--yellow) !important;
    }

    .u-bg--orange {
        background: var(--orange) !important;
    }

    .u-text--orange {
        color: var(--orange) !important;
    }

    .u-bg--teal {
        background: var(--teal) !important;
    }

    .u-text--teal {
        color: var(--teal) !important;
    }

    .u-bg--light-gradient {
        background: linear-gradient(to top, var(--light), var(--lightest)) !important;
    }

    .u-text--light-gradient {
        color: linear-gradient(to top, var(--light), var(--lightest)) !important;
    }

    .u-display--flex {
        display: flex;
    }

    .u-align--center {
        align-items: center;
    }

    .u-justify--center {
        justify-content: center;
    }

    .u-align--flex-end {
        align-items: flex-end;
    }

    .u-justify--flex-end {
        justify-content: flex-end;
    }

    .u-align--flex-start {
        align-items: flex-start;
    }

    .u-justify--flex-start {
        justify-content: flex-start;
    }

    .u-align--space-between {
        align-items: space-between;
    }

    .u-justify--space-between {
        justify-content: space-between;
    }

    .u-text--small {
        font-size: 1rem;
    }
</style>


<div class="l-wrapper">
    <div class="c-header">
        <form action="leaderboard.php" method="get" style="display: flex">
            <div class="col-md-3">
                <img class="c-logo" src="assets/img/rose.png" draggable="false" />
            </div>

            <div class="col-md-3">
                <lable style="color: var(--black)">Tanggal Mulai</lable>
                <input type="date" class="form-control" id="tgl_mulai" name="tgl_mulai"></input>

            </div>
            <div class="col-md-3" style="margin-left: 2rem;">
                <lable style="color: var(--black)">Tangal Akhir</lable>
                <input type="date" class="form-control" id="tgl_akhir" name="tgl_akhir"></input>

            </div>
            <div class="col-md-3" style="margin-left: 2rem;">
                <!-- <input type="text" style="opacity: 0"> -->
                <button class="c-button c-button--primary">Set Tanggal</button>
            </div>
            <input type="text" style="opacity: 0" name="id" value="<?php echo $id ?>">
            <input type="text" style="opacity: 0" name="role" value="<?php echo $role ?>">
        </form>


    </div>
    <div class="l-grid">
        <div class="l-grid__item l-grid__item--sticky">
            <div class="c-card u-bg--light-gradient u-text--dark">
                <div class="c-card__body">
                    <div class="u-display--flex u-justify--space-between">
                        <?php
                        if (!isset($_GET["tgl_mulai"]) ||  !isset($_GET["tgl_akhir"])) {
                            $query_mysql = mysqli_query(
                                $host,
                                "SELECT *, FIND_IN_SET(`jmlh_bibit`, (SELECT GROUP_CONCAT(`jmlh_bibit` ORDER BY `jmlh_bibit` DESC) FROM `data-input`)) AS `peringkat` FROM `data-input` WHERE `id_user` = $id ORDER BY `jmlh_bibit` DESC;"
                            ) or die(mysqli_error($host));
                        } else {
                            $start = $_GET["tgl_mulai"];
                            $end = $_GET["tgl_akhir"];
                            $query_mysql = mysqli_query(
                                $host,
                                "SELECT *, FIND_IN_SET(`jmlh_bibit`, (SELECT GROUP_CONCAT(`jmlh_bibit` ORDER BY `jmlh_bibit` DESC) FROM `data-input` WHERE `tgl_tanam` BETWEEN '$start' AND '$end')) AS `peringkat` FROM `data-input` WHERE `id_user` = $id AND `tgl_tanam` BETWEEN '$start' AND '$end' ORDER BY `jmlh_bibit` DESC;
"
                            ) or die(mysqli_error($host));
                        }

                        $data = mysqli_fetch_array($query_mysql);
                        // var_dump($data);

                        ?>
                        <div class="u-text--center">
                            <div class="u-text--small">Peringkat Ku</div>
                            <h4 style="font-weight: 600;">
                                <?php
                                if ($data != NULL) {
                                    echo $data['peringkat'];
                                } else {
                                    echo "-";
                                }
                                ?>

                            </h4>
                        </div>
                        <div class="u-text--center">
                            <div class="u-text--small">#Bibit</div>
                            <h4 style="font-weight: 600;">
                                <?php
                                if ($data != NULL) {
                                    echo $data['jmlh_bibit'];
                                } else {
                                    echo "-";
                                }
                                ?>
                            </h4>
                        </div>
                    </div>
                </div>
            </div>
            <div class="c-card">
                <div class="c-card__body">
                    <div class="u-text--center" id="winner"></div>
                </div>
            </div>
        </div>
        <div class="l-grid__item">
            <div class="c-card">
                <div class="c-card__header">
                    <h5>Peringkat Bibit</h5>
                </div>
                <div class="c-card__body">
                    <ul class="c-list" id="list">
                        <li class="c-list__item">
                            <div class="c-list__grid">
                                <div class="u-text--left u-text--small u-text--medium">Peringkat</div>
                                <div class="u-text--left u-text--small u-text--medium">Pengguna</div>
                                <div class="u-text--right u-text--small u-text--medium"># Bibit</div>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>


<script>
    <?php
    if (!isset($_GET["tgl_mulai"]) ||  !isset($_GET["tgl_akhir"])) {
        $query_mysql = mysqli_query($host, "SELECT * FROM `data-input`ORDER BY `jmlh_bibit` DESC") or die(mysqli_error($host));
    } else {
        $start = $_GET["tgl_mulai"];
        $end = $_GET["tgl_akhir"];
        $query_mysql = mysqli_query($host, "SELECT * FROM `data-input` WHERE `tgl_tanam` BETWEEN '$start' AND '$end' ORDER BY `jmlh_bibit` DESC") or die(mysqli_error($host));
    }

    $data = array();
    $i = 1;
    while ($row = mysqli_fetch_assoc($query_mysql)) {
        // 4. Buat array asosiatif untuk setiap baris data
        $id_user = $row["id_user"];
        $queryNamaUser = mysqli_query($host, "SELECT * FROM `user` WHERE `id` LIKE $id_user") or die(mysqli_error($host));
        $user = mysqli_fetch_array($queryNamaUser);
        if ($user['foto'] != NULL) {
            $foto = $user['foto'];
        } else {
            $foto = "user.PNG";
        }
        $item = array(
            "rank" => $i,
            "name" => $user['name'],
            "phone" => $user["phone"],
            "img" => "assets/img/foto/" . $foto,
            "kudos" => $row["jmlh_bibit"],
            "sent" => 31
        );

        // 5. Tambahkan setiap array asosiatif ke dalam array utama
        array_push($data, $item);
        $i++;
    }

    $json = json_encode($data);


    ?>
    const team =
        <?php
        echo $json;
        ?>

    // [


    //     {
    //         rank: 1,
    //         name: 'Lewis Hamilton',
    //         handle: 'lewishamilton',
    //         img: 'https://www.formula1.com/content/dam/fom-website/drivers/L/LEWHAM01_Lewis_Hamilton/lewham01.png.transform/2col-retina/image.png',
    //         kudos: 36,
    //         sent: 31
    //     }, {
    //         rank: 2,
    //         name: 'Kimi Raikkonen',
    //         handle: 'kimimatiasraikkonen',
    //         img: 'https://www.formula1.com/content/dam/fom-website/drivers/K/KIMRAI01_Kimi_R%C3%A4ikk%C3%B6nen/kimrai01.png.transform/2col-retina/image.png',
    //         kudos: 31,
    //         sent: 21
    //     }, {
    //         rank: 3,
    //         name: 'Sebastian Vettel',
    //         handle: 'vettelofficial',
    //         img: 'https://www.formula1.com/content/dam/fom-website/drivers/S/SEBVET01_Sebastian_Vettel/sebvet01.png.transform/2col-retina/image.png',
    //         kudos: 24,
    //         sent: 7
    //     }, {
    //         rank: 4,
    //         name: 'Max Verstappen',
    //         handle: 'maxverstappen1',
    //         img: 'https://www.formula1.com/content/dam/fom-website/drivers/M/MAXVER01_Max_Verstappen/maxver01.png.transform/2col-retina/image.png',
    //         kudos: 22,
    //         sent: 4
    //     }, {
    //         rank: 5,
    //         name: 'Lando Norris',
    //         handle: 'landonorris',
    //         img: 'https://www.formula1.com/content/dam/fom-website/drivers/L/LANNOR01_Lando_Norris/lannor01.png.transform/2col-retina/image.png',
    //         kudos: 18,
    //         sent: 16
    //     }, {
    //         rank: 6,
    //         name: 'Charles Leclerc',
    //         handle: 'charles_leclerc',
    //         img: 'https://www.formula1.com/content/dam/fom-website/drivers/C/CHALEC01_Charles_Leclerc/chalec01.png.transform/2col-retina/image.png',
    //         kudos: 16,
    //         sent: 6
    //     }, {
    //         rank: 7,
    //         name: 'George Russell',
    //         handle: 'georgerussell63',
    //         img: 'https://www.formula1.com/content/dam/fom-website/drivers/G/GEORUS01_George_Russell/georus01.png.transform/2col-retina/image.png',
    //         kudos: 10,
    //         sent: 21
    //     }, {
    //         rank: 8,
    //         name: 'Daniel Ricciardo',
    //         handle: 'danielricciardo',
    //         img: 'https://www.formula1.com/content/dam/fom-website/drivers/D/DANRIC01_Daniel_Ricciardo/danric01.png.transform/2col-retina/image.png',
    //         kudos: 7,
    //         sent: 46
    //     }, {
    //         rank: 9,
    //         name: 'Alexander Albon',
    //         handle: 'alex_albon',
    //         img: 'https://www.formula1.com/content/dam/fom-website/drivers/A/ALEALB01_Alexander_Albon/alealb01.png.transform/2col-retina/image.png',
    //         kudos: 4,
    //         sent: 2
    //     }, {
    //         rank: 10,
    //         name: 'Carlos Sainz Jr.',
    //         handle: 'carlossainz55',
    //         img: 'https://www.formula1.com/content/dam/fom-website/drivers/C/CARSAI01_Carlos_Sainz/carsai01.png.transform/2col-retina/image.png',
    //         kudos: 1,
    //         sent: 24
    //     }
    // ];

    const randomEmoji = () => {
        const emojis = ['👏', '👍', '🙌', '🤩', '🔥', '⭐️', '🏆', '💯'];
        let randomNumber = Math.floor(Math.random() * emojis.length);
        return emojis[randomNumber]
    }

    team.forEach(member => {
        let newRow = document.createElement('li');
        newRow.classList = 'c-list__item';
        newRow.innerHTML = `
		<div class="c-list__grid">
			<div class="c-flag c-place u-bg--transparent">${member.rank}</div>
			<div class="c-media">
				<img class="c-avatar c-media__img" src="${member.img}" />
				<div class="c-media__content">
					<div class="c-media__title">${member.name}</div>
					<a class="c-media__link u-text--small" href="mailto:${member.phone}" target="_blank">${member.phone}</a>
				</div>
			</div>
			<div class="u-text--right c-kudos">
				<div>
					<strong>${member.kudos}</strong> ${randomEmoji()}
				</div>
			</div>
		</div>
	`;
        if (member.rank === 1) {
            newRow.querySelector('.c-place').classList.add('u-text--dark')
            newRow.querySelector('.c-place').classList.add('u-bg--yellow')
            newRow.querySelector('.c-kudos').classList.add('u-text--yellow')
        } else if (member.rank === 2) {
            newRow.querySelector('.c-place').classList.add('u-text--dark')
            newRow.querySelector('.c-place').classList.add('u-bg--teal')
            newRow.querySelector('.c-kudos').classList.add('u-text--teal')
        } else if (member.rank === 3) {
            newRow.querySelector('.c-place').classList.add('u-text--dark')
            newRow.querySelector('.c-place').classList.add('u-bg--orange')
            newRow.querySelector('.c-kudos').classList.add('u-text--orange')
        }
        list.appendChild(newRow)
    })

    // Find Winner from sent kudos by sorting the drivers in the team array
    let sortedTeam = team.sort((a, b) => b.sent - a.sent)
    let winner = sortedTeam[0]

    // Render winner card
    const winnerCard = document.getElementById('winner')
    winnerCard.innerHTML = `
	<div class="u-text-small u-text--medium">Pengguna Terbaik</div>
	<img class="c-avatar c-avatar--lg mt-2" src="${winner.img}"/>
	<h5>${winner.name}</h5>
	<span class="u-text--teal u-text--small">${winner.phone}</span>
`
</script>

<?php
include "template/footer.php"
?>