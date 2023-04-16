<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Petani Kita</title>
    <link
      href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css"
      rel="stylesheet"
      integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ"
      crossorigin="anonymous"
    />
    <link rel="stylesheet" href="style.css" />
  </head>

  <body>
    <div class="landpage">
      <!-- Header -->
      <nav class="navbar navbar-expand-sm fixed-top">
        <a class="petani navbar-brand" href="#">
          <img src="./atribut/logo.png" />
        </a>
        <button
          class="navbar-toggler"
          type="button"
          data-bs-toggle="collapse"
          data-bs-target="#navbarNavAltMarkup"
          aria-controls="navbarNavAltMarkup"
          aria-expanded="false"
          aria-label="Toggle navigation"
        >
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="wrap-log collapse navbar-collapse" id="navbarNavAltMarkup">
          <div class="login navbar-nav ms-auto">
            <a
              class="nav-link active fw-bold"
              aria-current="page"
              href="dist/login.php"
            >
              <img
                class="mb-1"
                src="./atribut/icon_log.png"
                height="25rem"
              />Log In
            </a>
            <a class="nav-link active fw-bold" href="#">
              <img
                class="mb-1"
                src="./atribut/icon_about.png"
                aria-current="page"
                height="25rem"
              />
              Hubungi Kami</a
            >
          </div>
        </div>
      </nav>
      <!-- Body -->

      <div class="container text-center body">
        <div class="row align-items-start">
          <div class="head-text col-6 ps-0 mt-5">
            <h1 class="head-body mb-5 fw-bold" align="left">
              Data Pertanian <br />
              Untuk Wawasan <br />
              Kedepan
            </h1>
            <p class="text-body text-start mb-5 lh-sm fw-medium">
              Maksimalkan Hasil Panen Dan Pendapatan Para Petani Demi
              Kelangsungan Hidup Para Petani Kita Di Indonesia
            </p>
            <div class="d-grid gap-2 justify-content-md-start">
              <button class="btn btn-primary btn-lg" type="button">
                Daftar Untuk Cek Data Terbaru
                <img src="./atribut/panah.png" class="ms-3" />
              </button>
            </div>
          </div>
          <div class="img-slide col-6">
            <div class="slide-btn">
              <div class="slide-carousel">
                <button
                  type="button"
                  data-bs-target="#carouselExampleAutoplaying"
                  data-bs-slide-to="0"
                  aria-label="Slide 1"
                >
                  <img src="./atribut/Vector.svg" alt="" />
                </button>
                <button
                  type="button"
                  data-bs-target="#carouselExampleAutoplaying"
                  data-bs-slide-to="1"
                  aria-label="Slide 2"
                >
                  <img src="./atribut/Vector.svg" alt="" />
                </button>
                <button
                  type="button"
                  data-bs-target="#carouselExampleAutoplaying"
                  data-bs-slide-to="2"
                  aria-label="Slide 3"
                >
                  <img src="./atribut/Vector.svg" alt="" />
                </button>
              </div>
              <!-- <div class="next-img">
                            <button class="carousel-control carousel-control-prev" type="button"
                                data-bs-target="#carouselExampleAutoplaying" data-bs-slide="prev">
                                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                            </button>
                            <button class="carousel-control carousel-control-next" type="button"
                                data-bs-target="#carouselExampleAutoplaying" data-bs-slide="next">
                                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                            </button>
                        </div> -->
            </div>
            <div id="carouselExampleAutoplaying" class="carousel slide">
              <div class="carousel-inner rounded-bottom-4">
                <div class="carousel-item active">
                  <img src="./atribut/picture1.png" class="d-block" alt="..." />
                </div>
                <div class="carousel-item">
                  <img src="./atribut/picture2.png" class="d-block" alt="..." />
                </div>
                <div class="carousel-item">
                  <img src="./atribut/picture3.png" class="d-block" alt="..." />
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <!-- QnA -->
      <div class="container quetion">
        <h5 class="text-center fw-bold">PERTANYAAN YANG MUNGKIN TERLINTAS</h5>
        <h1 class="answer text-center fw-bold">
          BEBERAPA JAWABAN YANG MEMBANTU
        </h1>
        <!-- Pertanyaan -->
        <div
          class="container accordion accordion-flush"
          id="accordionFlushExample"
        >
          <div class="mb-3 accordion-item">
            <h2 class="accordion-header">
              <button
                class="accordion-button collapsed"
                type="button"
                data-bs-toggle="collapse"
                data-bs-target="#flush-collapseOne"
                aria-expanded="false"
                aria-controls="flush-collapseOne"
              >
                Bagaimana Caranya Menghapus Data Yang Telah Di Input?
              </button>
            </h2>
            <div
              id="flush-collapseOne"
              class="accordion-collapse collapse"
              data-bs-parent="#accordionFlushExample"
            >
              <div class="accordion-body">
                Placeholder content for this accordion, which is intended to
                demonstrate the <code>.accordion-flush</code> class. This is the
                first item's accordion body.
              </div>
            </div>
          </div>
          <div class="mb-3 accordion-item">
            <h2 class="accordion-header">
              <button
                class="accordion-button collapsed"
                type="button"
                data-bs-toggle="collapse"
                data-bs-target="#flush-collapseTwo"
                aria-expanded="false"
                aria-controls="flush-collapseTwo"
              >
                Apakah User Yang Telah Dibuat Dapat Dihapus?
              </button>
            </h2>
            <div
              id="flush-collapseTwo"
              class="accordion-collapse collapse"
              data-bs-parent="#accordionFlushExample"
            >
              <div class="accordion-body">
                Placeholder content for this accordion, which is intended to
                demonstrate the <code>.accordion-flush</code> class. This is the
                second item's accordion body. Let's imagine this being filled
                with some actual content.
              </div>
            </div>
          </div>
          <div class="mb-3 accordion-item">
            <h2 class="accordion-header">
              <button
                class="accordion-button collapsed"
                type="button"
                data-bs-toggle="collapse"
                data-bs-target="#flush-collapseThree"
                aria-expanded="false"
                aria-controls="flush-collapseThree"
              >
                Apakah Data Yang Ada Valid?
              </button>
            </h2>
            <div
              id="flush-collapseThree"
              class="accordion-collapse collapse"
              data-bs-parent="#accordionFlushExample"
            >
              <div class="accordion-body">
                Placeholder content for this accordion, which is intended to
                demonstrate the <code>.accordion-flush</code> class. This is the
                third item's accordion body. Nothing more exciting happening
                here in terms of content, but just filling up the space to make
                it look, at least at first glance, a bit more representative of
                how this would look in a real-world application.
              </div>
            </div>
          </div>
          <div class="mb-3 accordion-item">
            <h2 class="accordion-header">
              <button
                class="accordion-button collapsed"
                type="button"
                data-bs-toggle="collapse"
                data-bs-target="#flush-collapseFour"
                aria-expanded="false"
                aria-controls="flush-collapseThree"
              >
                Apakah Data Nomor Telpon dan Password Aman?
              </button>
            </h2>
            <div
              id="flush-collapseFour"
              class="accordion-collapse collapse"
              data-bs-parent="#accordionFlushExample"
            >
              <div class="accordion-body">
                Placeholder content for this accordion, which is intended to
                demonstrate the <code>.accordion-flush</code> class. This is the
                third item's accordion body. Nothing more exciting happening
                here in terms of content, but just filling up the space to make
                it look, at least at first glance, a bit more representative of
                how this would look in a real-world application.
              </div>
            </div>
          </div>
          <div class="accordion-item">
            <h2 class="accordion-header">
              <button
                class="accordion-button collapsed"
                type="button"
                data-bs-toggle="collapse"
                data-bs-target="#flush-collapseFive"
                aria-expanded="false"
                aria-controls="flush-collapseThree"
              >
                Apabila Ada Pertanyaan Yang Lain, Bagaimana Cara Menghubungi
                Admin?
              </button>
            </h2>
            <div
              id="flush-collapseFive"
              class="accordion-collapse collapse"
              data-bs-parent="#accordionFlushExample"
            >
              <div class="accordion-body">
                Placeholder content for this accordion, which is intended to
                demonstrate the <code>.accordion-flush</code> class. This is the
                third item's accordion body. Nothing more exciting happening
                here in terms of content, but just filling up the space to make
                it look, at least at first glance, a bit more representative of
                how this would look in a real-world application.
              </div>
            </div>
          </div>
        </div>
      </div>
      <!-- Footer -->
      <div class="footer row">
        <div class="col-sm-4"></div>
        <div class="col-sm-5 d-flex">
          <img src="./atribut/Tel-U-logo_21 1.png" />
          <p class="text">Tugas Akhir Pertanian @ 2023. All rights reserved.</p>
        </div>
        <div class="col-sm-3"></div>
      </div>
    </div>

    <script
      src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"
      integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe"
      crossorigin="anonymous"
    ></script>
  </body>
</html>
