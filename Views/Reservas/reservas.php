<?php
header_admin($data);
?>
<main class="main-content">
    <div class="position-relative iq-banner">
        <!--Nav Start-->
        <nav class="nav navbar navbar-expand-lg navbar-light iq-navbar">
            <div class="container-fluid navbar-inner">
                <a href="<?= base_url() ?>/home" class="navbar-brand">
                    <!--Logo start-->
                    <!--logo End-->

                    <!--Logo start-->
                    <div class="logo-main">
                        <div class="logo-normal">
                            <svg class="text-primary icon-30" viewBox="0 0 30 30" fill="none"
                                xmlns="http://www.w3.org/2000/svg">
                                <rect x="-0.757324" y="19.2427" width="28" height="4" rx="2"
                                    transform="rotate(-45 -0.757324 19.2427)" fill="currentColor" />
                                <rect x="7.72803" y="27.728" width="28" height="4" rx="2"
                                    transform="rotate(-45 7.72803 27.728)" fill="currentColor" />
                                <rect x="10.5366" y="16.3945" width="16" height="4" rx="2"
                                    transform="rotate(45 10.5366 16.3945)" fill="currentColor" />
                                <rect x="10.5562" y="-0.556152" width="28" height="4" rx="2"
                                    transform="rotate(45 10.5562 -0.556152)" fill="currentColor" />
                            </svg>
                        </div>
                        <div class="logo-mini">
                            <svg class="text-primary icon-30" viewBox="0 0 30 30" fill="none"
                                xmlns="http://www.w3.org/2000/svg">
                                <rect x="-0.757324" y="19.2427" width="28" height="4" rx="2"
                                    transform="rotate(-45 -0.757324 19.2427)" fill="currentColor" />
                                <rect x="7.72803" y="27.728" width="28" height="4" rx="2"
                                    transform="rotate(-45 7.72803 27.728)" fill="currentColor" />
                                <rect x="10.5366" y="16.3945" width="16" height="4" rx="2"
                                    transform="rotate(45 10.5366 16.3945)" fill="currentColor" />
                                <rect x="10.5562" y="-0.556152" width="28" height="4" rx="2"
                                    transform="rotate(45 10.5562 -0.556152)" fill="currentColor" />
                            </svg>
                        </div>
                    </div>
                    <!--logo End-->
                    <h4 class="logo-title">SyntheSport</h4>
                </a>
                <div class="sidebar-toggle" data-toggle="sidebar" data-active="true">
                    <i class="icon">
                        <svg width="20px" class="icon-20" viewBox="0 0 24 24">
                            <path fill="currentColor"
                                d="M4,11V13H16L10.5,18.5L11.92,19.92L19.84,12L11.92,4.08L10.5,5.5L16,11H4Z" />
                        </svg>
                    </i>
                </div>
                <div class="input-group search-input">
                    <span class="input-group-text" id="search-input">
                        <svg class="icon-18" width="18" viewBox="0 0 24 24" fill="none"
                            xmlns="http://www.w3.org/2000/svg">
                            <circle cx="11.7669" cy="11.7666" r="8.98856" stroke="currentColor" stroke-width="1.5"
                                stroke-linecap="round" stroke-linejoin="round"></circle>
                            <path d="M18.0186 18.4851L21.5426 22" stroke="currentColor" stroke-width="1.5"
                                stroke-linecap="round" stroke-linejoin="round"></path>
                        </svg>
                    </span>
                    <input type="search" class="form-control" placeholder="Search..." />
                </div>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                    data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                    aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon">
                        <span class="mt-2 navbar-toggler-bar bar1"></span>
                        <span class="navbar-toggler-bar bar2"></span>
                        <span class="navbar-toggler-bar bar3"></span>
                    </span>
                </button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="mb-2 navbar-nav ms-auto align-items-center navbar-list mb-lg-0">
                        <li class="nav-item dropdown">
                            <a class="py-0 nav-link d-flex align-items-center" href="#" id="navbarDropdown"
                                role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                <img src="<?= media() ?>/images/avatars/01.png" alt="User-Profile"
                                    class="theme-color-default-img img-fluid avatar avatar-50 avatar-rounded" />
                                <div class="caption ms-3 d-none d-md-block">
                                    <h6 class="mb-0 caption-title">
                                        <?= isset($_SESSION) ? $_SESSION['userData']['nombre'] . " " . $_SESSION['userData']['apellido'] : "Informacion no disponible" ?>
                                    </h6>
                                    <span><?= isset($_SESSION) ? $_SESSION['userData']['rol'] : "Informacion no disponible" ?>
                                        </h6>
                                </div>
                            </a>
                            <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                                <li>
                                    <a class="dropdown-item" href="../dashboard/auth/sign-in.html">Logout</a>
                                </li>
                            </ul>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
        <!-- Nav Header Component Start -->
        <div class="iq-navbar-header" style="height: 215px">
            <div class="container-fluid iq-container">
                <div class="row">
                    <div class="col-md-12">
                        <div class="flex-wrap d-flex justify-content-between align-items-center">
                            <div>
                                <h1>Hello Devs!</h1>
                                <p>
                                    We are on a mission to <?= $data['page_title'] ?>
                                    like you build successful projects for
                                    FREE.
                                </p>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
            <div class="iq-header-img">
                <img src="<?= media() ?>/images/dashboard/top-header.png" alt="header"
                    class="theme-color-default-img img-fluid w-100 h-100 animated-scaleX" />
            </div>
        </div>
    </div>
    <div class="container1" id="container1">
        <div class="conatiner-fluid content-inner mt-n5 py-0">
            <div class="row">
                <!--  <div class="col-md-12 col-lg-12">
                <div class="row row-cols-1">
                    <div class="overflow-hidden d-slider1">
                        <ul class="p-0 m-0 mb-2 swiper-wrapper list-inline">
                            <li class="swiper-slide card card-slide" data-aos="fade-up" data-aos-delay="700">
                                <div class="card-body">
                                    <div class="progress-widget">
                                        <div
                                            id="circle-progress-01"
                                            class="text-center circle-progress-01 circle-progress circle-progress-primary"
                                            data-min-value="0"
                                            data-max-value="100"
                                            data-value="90"
                                            data-type="percent">
                                            <svg class="card-slie-arrow icon-24" width="24" viewBox="0 0 24 24">
                                                <path
                                                    fill="currentColor"
                                                    d="M5,17.59L15.59,7H9V5H19V15H17V8.41L6.41,19L5,17.59Z" />
                                            </svg>
                                        </div>
                                        <div class="progress-detail">
                                            <p class="mb-2">Total Sales</p>
                                            <h4 class="counter">$560K</h4>
                                        </div>
                                    </div>
                                </div>
                            </li>
                            <li class="swiper-slide card card-slide" data-aos="fade-up" data-aos-delay="800">
                                <div class="card-body">
                                    <div class="progress-widget">
                                        <div
                                            id="circle-progress-02"
                                            class="text-center circle-progress-01 circle-progress circle-progress-info"
                                            data-min-value="0"
                                            data-max-value="100"
                                            data-value="80"
                                            data-type="percent">
                                            <svg class="card-slie-arrow icon-24" width="24" viewBox="0 0 24 24">
                                                <path
                                                    fill="currentColor"
                                                    d="M19,6.41L17.59,5L7,15.59V9H5V19H15V17H8.41L19,6.41Z" />
                                            </svg>
                                        </div>
                                        <div class="progress-detail">
                                            <p class="mb-2">Total Profit</p>
                                            <h4 class="counter">$185K</h4>
                                        </div>
                                    </div>
                                </div>
                            </li>
                            <li class="swiper-slide card card-slide" data-aos="fade-up" data-aos-delay="900">
                                <div class="card-body">
                                    <div class="progress-widget">
                                        <div
                                            id="circle-progress-03"
                                            class="text-center circle-progress-01 circle-progress circle-progress-primary"
                                            data-min-value="0"
                                            data-max-value="100"
                                            data-value="70"
                                            data-type="percent">
                                            <svg class="card-slie-arrow icon-24" width="24" viewBox="0 0 24 24">
                                                <path
                                                    fill="currentColor"
                                                    d="M19,6.41L17.59,5L7,15.59V9H5V19H15V17H8.41L19,6.41Z" />
                                            </svg>
                                        </div>
                                        <div class="progress-detail">
                                            <p class="mb-2">Total Cost</p>
                                            <h4 class="counter">$375K</h4>
                                        </div>
                                    </div>
                                </div>
                            </li>
                            <li class="swiper-slide card card-slide" data-aos="fade-up" data-aos-delay="1000">
                                <div class="card-body">
                                    <div class="progress-widget">
                                        <div
                                            id="circle-progress-04"
                                            class="text-center circle-progress-01 circle-progress circle-progress-info"
                                            data-min-value="0"
                                            data-max-value="100"
                                            data-value="60"
                                            data-type="percent">
                                            <svg class="card-slie-arrow icon-24" width="24px" viewBox="0 0 24 24">
                                                <path
                                                    fill="currentColor"
                                                    d="M5,17.59L15.59,7H9V5H19V15H17V8.41L6.41,19L5,17.59Z" />
                                            </svg>
                                        </div>
                                        <div class="progress-detail">
                                            <p class="mb-2">Revenue</p>
                                            <h4 class="counter">$742K</h4>
                                        </div>
                                    </div>
                                </div>
                            </li>
                            <li class="swiper-slide card card-slide" data-aos="fade-up" data-aos-delay="1100">
                                <div class="card-body">
                                    <div class="progress-widget">
                                        <div
                                            id="circle-progress-05"
                                            class="text-center circle-progress-01 circle-progress circle-progress-primary"
                                            data-min-value="0"
                                            data-max-value="100"
                                            data-value="50"
                                            data-type="percent">
                                            <svg class="card-slie-arrow icon-24" width="24px" viewBox="0 0 24 24">
                                                <path
                                                    fill="currentColor"
                                                    d="M5,17.59L15.59,7H9V5H19V15H17V8.41L6.41,19L5,17.59Z" />
                                            </svg>
                                        </div>
                                        <div class="progress-detail">
                                            <p class="mb-2">Net Income</p>
                                            <h4 class="counter">$150K</h4>
                                        </div>
                                    </div>
                                </div>
                            </li>
                            <li class="swiper-slide card card-slide" data-aos="fade-up" data-aos-delay="1200">
                                <div class="card-body">
                                    <div class="progress-widget">
                                        <div
                                            id="circle-progress-06"
                                            class="text-center circle-progress-01 circle-progress circle-progress-info"
                                            data-min-value="0"
                                            data-max-value="100"
                                            data-value="40"
                                            data-type="percent">
                                            <svg class="card-slie-arrow icon-24" width="24" viewBox="0 0 24 24">
                                                <path
                                                    fill="currentColor"
                                                    d="M19,6.41L17.59,5L7,15.59V9H5V19H15V17H8.41L19,6.41Z" />
                                            </svg>
                                        </div>
                                        <div class="progress-detail">
                                            <p class="mb-2">Today</p>
                                            <h4 class="counter">$4600</h4>
                                        </div>
                                    </div>
                                </div>
                            </li>
                            <li class="swiper-slide card card-slide" data-aos="fade-up" data-aos-delay="1300">
                                <div class="card-body">
                                    <div class="progress-widget">
                                        <div
                                            id="circle-progress-07"
                                            class="text-center circle-progress-01 circle-progress circle-progress-primary"
                                            data-min-value="0"
                                            data-max-value="100"
                                            data-value="30"
                                            data-type="percent">
                                            <svg class="card-slie-arrow icon-24" width="24" viewBox="0 0 24 24">
                                                <path
                                                    fill="currentColor"
                                                    d="M19,6.41L17.59,5L7,15.59V9H5V19H15V17H8.41L19,6.41Z" />
                                            </svg>
                                        </div>
                                        <div class="progress-detail">
                                            <p class="mb-2">Members</p>
                                            <h4 class="counter">11.2M</h4>
                                        </div>
                                    </div>
                                </div>
                            </li>
                        </ul>
                        <div class="swiper-button swiper-button-next"></div>
                        <div class="swiper-button swiper-button-prev"></div>
                    </div>
                </div>
            </div> -->
                <div class="col-md-12 col-lg-12">
                    <div class="row">
                        <?php getModal('reservasModal', $data); ?>
                        <div class="col-3">
                            <li class="swiper-slide card card-slide" data-aos="fade-up" data-aos-delay="1300">
                                <div class="card-body">
                                    <div class="progress-widget">
                                        <button type="button" id="btnCrearReserva" class="btn btn-primary">
                                            Agregar reserva
                                        </button>

                                    </div>

                                </div>
                            </li>
                        </div>
                    </div>
                    <div class="row">
                        <div class="modal fade" id="detalles" data-bs-backdrop="static" data-bs-keyboard="false"
                            tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered">
                                <div class="modal-content">
                                    <div class="modal-header bg-primary">
                                        <h4 class="modal-title text-white text-align-center" id="staticBackdropLabel">
                                            <b>Información de la Reserva</b>
                                        </h4>
                                        <button type="button" class="btn-close" id="btn-close" data-bs-dismiss="modal"
                                            aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body" id="modal-body">

                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12 mt-2 col-lg-12">
                            <div class="col-md-12">
                                <div class="card mt-2" data-aos="fade-down" data-aos-delay="900">
                                    <div id="calendar"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="container2" id="container2" style="display:none">
        <div class="mt-n5 py-0">
            <div class="row">
                <form id="frmCrearReserva" method="POST">
                    <div class="row">
                        <div class="col-4" style="margin: 80px;">
                            <div class="row">
                                <div id="userStatusZone" class="mb-3">
                                    <input type="hidden" name="idReserva" id="idReserva" value="0">
                                    <div class="row">
                                        <label for="txtName" class="form-label"><b>Nombre de el reservante</b> </label>
                                        <input type="text" class="form-control" id="nombreReserva" name="nombreReserva">
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div id="userStatusZone" class="mb-3">
                                    <label for="txtType" class="form-label"><b>Convenio (Si aplica)</b></label>
                                    <select class="form-control" name="idConvenio" id="idConvenio">
                                        <option selected="" value="" disabled>No aplica</option>
                                        <div class="selectConvenio" name="selectConvenio" id="selectConvenio"></div>
                                    </select>

                                </div>
                            </div>

                            <div class="row">
                                <div id="userStatusZone" class="mb-3">
                                    <label for="genero" class="form-label">Usuario</label>
                                    <select class="form-control" name="idUsuario" id="idUsuario">
                                        <option selected="" value="" disabled>Seleccione el usuario</option>
                                        <div class="selectUsuario" name="selectUsuario" id="selectUsuario"></div>
                                    </select>

                                </div>
                            </div>

                            <button type="submit" class="btn btn-primary">Reservar</button>
                        </div>

                        <div class="col-5" style="text-align: center;">
                            <div class="formularioProducto" id="formularioProducto">
                                <div class="row" id="idRow1">
                                    <div style="margin: 50px; border: 1px solid #ccc; padding: 50px; border-radius: 50px; box-shadow: 0 0 10px rgba(0,0,0,0.1);"
                                        class="mb-3">
                                        <input type="hidden" name="idReservaPivote1" id="idReservaPivote1" value="40">

                                        <div class="row">
                                            <label for="txtName" class="form-label"><b>Día de la reserva</b> </label>
                                            <input type="date" class="form-control" id="diaReserva1" name="diaReserva1"
                                                required>
                                        </div>
                                        <script>
                                            const input = document.getElementById(`diaReserva1`);
                                            const hoy = new Date().toISOString().split('T')[0];
                                            input.min = hoy;
                                        </script>
                                        <div class="row">
                                            <label for="genero" class="form-label"><b>Cancha</b></label>
                                            <select class="form-control" name="idCancha1" id="idCancha1">
                                                <option selected="" value="" disabled>Seleccione la cancha</option>

                                            </select>
                                        </div>
                                        <div class="row">
                                            <label for="txtName" class="form-label"><b>Hora de la reserva</b> </label>
                                            <input type="time" class="form-control" id="horaReserva1"
                                                name="horaReserva1" required>
                                        </div>
                                        <div class="row">
                                            <label for="txtName" class="form-label"><b>Horas reservadas</b> </label>
                                            <input type="number" class="form-control" id="horasReservadas1"
                                                name="horasReservadas1" required>
                                        </div>
                                    </div>
                                </div>

                            </div>

                            <button type="submit" id="btnFormularioProducto" class="btn btn-primary">Agregar otro
                                producto</button>
                        </div>
                    </div>
                </form>

            </div>
        </div>

    </div>

    </div>
</main>
<?php footer_admin($data); ?>
<script src="<?= media() ?>/js/reservas.js"></script>