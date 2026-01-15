<?php
//menyertakan code dari file koneksi
include "koneksi.php";
?>
<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>My Daily Journal</title>
    <link rel="icon" href="img/logo1.png" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">

    <style>
        /* Dark Mode */
        .dark-theme {
            background-color: #1a1a1a !important;
            color: white !important;
        }

        /* Light Mode */
        .light-theme {
            background-color: white !important;
            color: black !important;
        }

        /* Card */
        .dark-theme .card {
            background-color: #595d61 !important;
            color: white !important;
            border-color: #555555 !important;
        }

        .dark-theme .card-footer {
            background-color: #595d61 !important;
            color: white !important;
        }

        /* Hero & Gallery */
        .dark-theme .bg-danger-subtle {
            background-color: #555555 !important;
        }

        /* Schedule & About Me */
        .dark-theme #schedule,
        .dark-theme #about {
            background-color: #555555 !important;
            color: white !important;
        }

        /* Icons berubah warna */
        .dark-theme #schedule i {
            color: #ff8080 !important;
        }

        /* Accordion */
        .dark-theme .accordion-button {
            background-color: #444 !important;
            color: white !important;
        }

        .accordion-button:not(.collapsed) {
            background-color: #dc3545 !important;
            color: white !important;
        }

        .dark-theme .accordion-body {
            background-color: #333 !important;
            color: white !important;
        }

        /* Footer */
        .footer-dark {
            background-color: #212529 !important;
            color: white !important;
        }

        /* Icon footer */
        .footer-dark a,
        .footer-dark i {
            color: white !important;
        }
    </style>
</head>

<body id="mainBody">
    <!--nav begin-->
    <nav class="navbar navbar-expand-lg bg-body-tertiary" stick-top>
        <div class="container">
            <a class="navbar-brand" href="#">My Daily Journal</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
                aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav ms-auto mb-2 mb-lg-0 text-dark">
                    <li class="nav-item">
                        <a class="nav-link" href="#home">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#article">Article</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#gallery">Gallery</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#schedule">Schedule</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#about">About Me</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="login.php" target="_blank">Login</a>
                    </li>
                    <li class="nav-item ms-3">
                        <button id="darkButton" class="btn btn-dark btn-sm">
                            <i class="bi bi-moon-stars-fill"></i>
                        </button>
                        <button id="lightButton" class="btn btn-danger btn-sm">
                            <i class="bi bi-brightness-high-fill"></i>
                        </button>
                    </li>
            </div>
        </div>
    </nav>
    <!--nav end-->
    <!--hero begin-->
    <section id="hero" class="text-center p-5 bg-danger-subtle text-sm-start">
        <div class="container">
            <div class="d-sm-flex flex-sm-row-reverse align-items-center">
                <img src="img/banner.jpg" class="img-fluid" width="300">
                <div>
                    <h1 class="fw-bold display-4">
                        The Joy and Benefits of Being Active
                    </h1>
                    <h4 class="lead display-6">
                        Menemukan manfaat olahraga untuk tubuh dan semangat belajar
                    </h4>
                    <span id="tanggal"></span>
                    <span id="jam"></span>
                </div>
            </div>
        </div>
    </section>
    <!--hero end-->
    <!--article begin-->
    <section id="article" class="text-center p-5">
        <div class="container">
            <h1 class="fw-bold display-4 pb-3">article</h1>
            <div class="row row-cols-1 row-cols-md-3 g-4 justify-content-center">
            <?php
            $sql = "SELECT * FROM article ORDER BY tanggal DESC";
            $hasil = $conn->query($sql); 

            while($row = $hasil->fetch_assoc()){
            ?>
            <!--col begin-->
                <div class="col">
                    <div class="card h-100">
                        <img src="img/<?= $row["gambar"]?>" class="card-img-top" alt="..."/>
                        <div class="card-body">
                            <h5 class="card-title"><?= $row["judul"]?></h5>
                            <p class="card-text">
                                <?= $row["isi"]?>
                            </p>
                        </div>
                        <div class="card-footer">
                            <small class="text-body-secondary">
                                <?= $row["tanggal"]?>
                            </small>    
                        </div>
                    </div>
                </div>
            <!--col end-->
            <?php
            }
            ?>
             </div>
        </div>
    </section>
    <!--article end-->
    <!--gallery begin-->
    <section id="gallery" class="text-center p-5 bg-danger-subtle">
    <div class="container">
        <h1 class="fw-bold display-4 pb-3">Gallery</h1>

        <div id="carouselExample" class="carousel slide" data-bs-ride="carousel">
            <div class="carousel-inner">

                <?php
                $queryGallery = "SELECT * FROM gallery ORDER BY id DESC";
                $resultGallery = $conn->query($queryGallery);
                $active = "active";

                while ($gallery = $resultGallery->fetch_assoc()) {
                ?>
                    <div class="carousel-item <?= $active; ?>">
                        <img src="img/<?= $gallery['gambar']; ?>" class="d-block w-100">
                    </div>
                <?php
                    $active = ""; // supaya cuma item pertama yang active
                }
                ?>

            </div>

            <button class="carousel-control-prev" type="button" data-bs-target="#carouselExample" data-bs-slide="prev">
                <span class="carousel-control-prev-icon"></span>
            </button>

            <button class="carousel-control-next" type="button" data-bs-target="#carouselExample" data-bs-slide="next">
                <span class="carousel-control-next-icon"></span>
            </button>
        </div>
    </div>
</section>
    <!--gallery end-->
    <!--schedule begin-->
    <section id="schedule" class="text-center p-5">
        <div class="container">
            <h1 class="fw-bold display-4 pb-3">Schedule</h1>
            <div class="row row-cols-1 row-cols-md-4 g-4 mb-4 justify-content-center">
                <div class="col">
                    <div class="card h-100 p-3 shadow-sm border-0">
                        <div class="text-center">
                            <i class="bi bi-bicycle h1 text-danger"></i>
                        </div>
                        <div class="card-body">
                            <h5 class="card-title">Senin</h5>
                            <p class="card-text"><small class="text-muted">Bersepeda pagi hari untuk memulai hari dengan
                                    energi positif.</small></p>
                        </div>
                    </div>
                </div>
                <div class="col">
                    <div class="card h-100 p-3 shadow-sm border-0">
                        <div class="text-center">
                            <i class="bi bi-lightning-charge h1 text-danger"></i>
                        </div>
                        <div class="card-body">
                            <h5 class="card-title">Selasa</h5>
                            <p class="card-text"><small class="text-muted">Work out di Gym.</small></p>
                        </div>
                    </div>
                </div>
                <div class="col">
                    <div class="card h-100 p-3 shadow-sm border-0">
                        <div class="text-center">
                            <i class="bi bi-activity h1 text-danger"></i>
                        </div>
                        <div class="card-body">
                            <h5 class="card-title">Rabu</h5>
                            <p class="card-text"><small class="text-muted">Free time untuk istirahat.</small></p>
                        </div>
                    </div>
                </div>
                <div class="col">
                    <div class="card h-100 p-3 shadow-sm border-0">
                        <div class="text-center">
                            <i class="bi bi-fire h1 text-danger"></i>
                        </div>
                        <div class="card-body">
                            <h5 class="card-title">Kamis</h5>
                            <p class="card-text"><small class="text-muted">Main badminton fun game bareng temen
                                    kampus.</small></p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row row-cols-1 row-cols-md-4 g-4 justify-content-center">
                <div class="col">
                    <div class="card h-100 p-3 shadow-sm border-0">
                        <div class="text-center">
                            <i class="bi bi-water h1 text-danger"></i>
                        </div>
                        <div class="card-body">
                            <h5 class="card-title">Jumat</h5>
                            <p class="card-text"><small class="text-muted">Renang sore untuk relaksasi.</small></p>
                        </div>
                    </div>
                </div>
                <div class="col">
                    <div class="card h-100 p-3 shadow-sm border-0">
                        <div class="text-center">
                            <i class="bi bi-lightning-charge h1 text-danger"></i>
                        </div>
                        <div class="card-body">
                            <h5 class="card-title">Sabtu</h5>
                            <p class="card-text"><small class="text-muted">Fun run keliling kompleks perumahan.</small>
                            </p>
                        </div>
                    </div>
                </div>
                <div class="col">
                    <div class="card h-100 p-3 shadow-sm border-0 bg-light">
                        <div class="text-center">
                            <i class="bi bi-activity h1 text-secondary"></i>
                        </div>
                        <div class="card-body">
                            <h5 class="card-title text-secondary">Minggu</h5>
                            <p class="card-text"><small class="text-muted">Free time untuk istirahat</small></p>
                        </div>
                    </div>
                </div>
                <div class="col">
                    <div class="card h-100 p-3 shadow-sm border-0 bg-light">
                        <div class="text-center">
                            <i class="bi bi-three-dots h1 text-secondary"></i>
                        </div>
                        <div class="card-body">
                            <h5 class="card-title text-secondary">Aktivitas Lain</h5>
                            <p class="card-text"><small class="text-muted">...</small></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <footer class="text-center p-5">
        <!--schedule end-->
        <!--about me begin-->
        <section id="about" class="p-5 bg-light">
            <div class="container">
                <h1 class="fw-bold display-4 text-center pb-3">About Me</h1>
                <div class="accordion" id="accordionExample">
                    <!-- Accordion 1 -->
                    <div class="accordion-item">
                        <h2 class="accordion-header" id="headingOne">
                            <button class="accordion-button" type="button" data-bs-toggle="collapse"
                                data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                Profil Singkat
                            </button>
                        </h2>
                        <div id="collapseOne" class="accordion-collapse collapse show" aria-labelledby="headingOne"
                            data-bs-parent="#accordionExample">
                            <div class="accordion-body">
                                Halo! Saya <strong>Ganeswari</strong>, mahasiswa aktif Universitas Dian Nuswantoro
                                (Udinus).
                                Saya suka olahraga seperti renang, badminton, dan jogging untuk menjaga keseimbangan
                                antara tubuh dan pikiran.
                                Bagi saya, olahraga bukan cuma kegiatan fisik, tapi juga sumber semangat dan
                                kebahagiaan.
                            </div>
                        </div>
                    </div>
                    <!-- Accordion 2 -->
                    <div class="accordion-item">
                        <h2 class="accordion-header" id="headingTwo">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                data-bs-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                                Riwayat Sekolah
                            </button>
                        </h2>
                        <div id="collapseTwo" class="accordion-collapse collapse" aria-labelledby="headingTwo"
                            data-bs-parent="#accordionExample">
                            <div class="accordion-body text-start">
                                SDN Batursari 5 <br>
                                SMP N 3 Mranggen <br>
                                SMK Penerbangan Kartika Aqasa Bhakti Semarang
                            </div>
                        </div>
                    </div>
                    <!-- Accordion 3 -->
                    <div class="accordion-item">
                        <h2 class="accordion-header" id="headingThree">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                data-bs-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                                Cita-cita & Harapan
                            </button>
                        </h2>
                        <div id="collapseThree" class="accordion-collapse collapse" aria-labelledby="headingThree"
                            data-bs-parent="#accordionExample">
                            <div class="accordion-body text-start">
                                Saya ingin menjadi seorang <strong>Web Developer</strong> yang tidak hanya ahli dalam
                                coding
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </section>
        <!--about me end-->
        <!--footer begin-->
        <footer class="text-center p-5 footer-dark">
            <div>
                <a href="https://www.instagram.com/229.929"><i class="bi bi-instagram h2 p-2 text-dark"></i></a>
                <a href="https://wa.me/+6285877762013"><i class="bi bi-whatsapp h2 p-2 text-dark"></i></a>
                <a href="https://www.tiktok.com/@kamolatte_"><i class="bi bi-tiktok h2 p-2 text-dark"></i></a>
            </div>
            <div>
                Ganeswari &copy;2025
            </div>
        </footer>
        <!--footer end-->

        <!-- Tombol Back to Top -->
        <button id="backToTop" class="btn btn-danger rounded-circle position-fixed bottom-0 end-0 m-3 d-none">
            <i class="bi bi-arrow-up" title="Back to Top"></i>
        </button>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"></script>

        <script>
            const body = document.getElementById("mainBody");

            document.getElementById("darkButton").onclick = function () {
                body.style.backgroundColor = "black";
                body.style.color = "white";
                body.classList.add("dark-theme");
                body.classList.remove("light-theme");
            };

            document.getElementById("lightButton").onclick = function () {
                body.style.backgroundColor = "white";
                body.style.color = "black";
                body.classList.add("light-theme");
                body.classList.remove("dark-theme");
            };
        </script>

        <script type="text/javascript">
            function tampilWaktu() {
                const waktu = new Date();

                const tanggal = waktu.getDate();
                const bulan = waktu.getMonth();
                const tahun = waktu.getFullYear();
                const jam = waktu.getHours();
                const menit = waktu.getMinutes();
                const detik = waktu.getSeconds();

                const arrBulan = ["1", "2", "3", "4", "5", "6", "7", "8", "9", "10", "11", "12"];

                const tanggal_full = tanggal + "/" + arrBulan[bulan] + "/" + tahun;
                const jam_full = jam + ":" + menit + ":" + detik;

                document.getElementById("tanggal").innerHTML = tanggal_full;
                document.getElementById("jam").innerHTML = jam_full;

                console.log(tanggal_full);
                console.log(jam_full);
            }

            setInterval(tampilWaktu, 1000);
        </script>

        <script type="text/javascript">
            const backToTop = document.getElementById("backToTop");

            window.addEventListener("scroll", function () {
                if (window.scrollY > 300) {
                    backToTop.classList.remove("d-none");
                    backToTop.classList.add("d-block");
                } else {
                    backToTop.classList.remove("d-block");
                    backToTop.classList.add("d-none");
                }
            });

            backToTop.addEventListener("click", function () {
                window.scrollTo({ top: 0, behavior: "smooth" });
            });
        </script>
</body>

</html>