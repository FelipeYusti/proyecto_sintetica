<?php header_admin($data); ?>
<main class="main-content">
    <div class="position-relative iq-banner">

        <nav class="nav navbar navbar-expand-lg navbar-light iq-navbar">
            <div class="container-fluid navbar-inner">
                <a href="<?= base_url() ?>/home" class="navbar-brand">
                    <!--Logo start-->
                    <!--logo End-->

                    <!--Logo start-->
                    <div class="logo-main">
                        <div class="logo-normal">
                            <svg
                                class="text-primary icon-30"
                                viewBox="0 0 30 30"
                                fill="none"
                                xmlns="http://www.w3.org/2000/svg">
                                <rect
                                    x="-0.757324"
                                    y="19.2427"
                                    width="28"
                                    height="4"
                                    rx="2"
                                    transform="rotate(-45 -0.757324 19.2427)"
                                    fill="currentColor" />
                                <rect
                                    x="7.72803"
                                    y="27.728"
                                    width="28"
                                    height="4"
                                    rx="2"
                                    transform="rotate(-45 7.72803 27.728)"
                                    fill="currentColor" />
                                <rect
                                    x="10.5366"
                                    y="16.3945"
                                    width="16"
                                    height="4"
                                    rx="2"
                                    transform="rotate(45 10.5366 16.3945)"
                                    fill="currentColor" />
                                <rect
                                    x="10.5562"
                                    y="-0.556152"
                                    width="28"
                                    height="4"
                                    rx="2"
                                    transform="rotate(45 10.5562 -0.556152)"
                                    fill="currentColor" />
                            </svg>
                        </div>
                        <div class="logo-mini">
                            <svg
                                class="text-primary icon-30"
                                viewBox="0 0 30 30"
                                fill="none"
                                xmlns="http://www.w3.org/2000/svg">
                                <rect
                                    x="-0.757324"
                                    y="19.2427"
                                    width="28"
                                    height="4"
                                    rx="2"
                                    transform="rotate(-45 -0.757324 19.2427)"
                                    fill="currentColor" />
                                <rect
                                    x="7.72803"
                                    y="27.728"
                                    width="28"
                                    height="4"
                                    rx="2"
                                    transform="rotate(-45 7.72803 27.728)"
                                    fill="currentColor" />
                                <rect
                                    x="10.5366"
                                    y="16.3945"
                                    width="16"
                                    height="4"
                                    rx="2"
                                    transform="rotate(45 10.5366 16.3945)"
                                    fill="currentColor" />
                                <rect
                                    x="10.5562"
                                    y="-0.556152"
                                    width="28"
                                    height="4"
                                    rx="2"
                                    transform="rotate(45 10.5562 -0.556152)"
                                    fill="currentColor" />
                            </svg>
                        </div>
                    </div>
                    <!--logo End-->

                    <h4 class="logo-title">SyntheSport</h4>
                </a>
                <div class="sidebar-toggle" data-toggle="sidebar" data-active="true">
                    <i class="icon">
                        <svg width="20px" class="icon-20" viewBox="0 0 24 24">
                            <path
                                fill="currentColor"
                                d="M4,11V13H16L10.5,18.5L11.92,19.92L19.84,12L11.92,4.08L10.5,5.5L16,11H4Z" />
                        </svg>
                    </i>
                </div>
                <div class="input-group search-input">
                    <span class="input-group-text" id="search-input">
                        <svg
                            class="icon-18"
                            width="18"
                            viewBox="0 0 24 24"
                            fill="none"
                            xmlns="http://www.w3.org/2000/svg">
                            <circle
                                cx="11.7669"
                                cy="11.7666"
                                r="8.98856"
                                stroke="currentColor"
                                stroke-width="1.5"
                                stroke-linecap="round"
                                stroke-linejoin="round"></circle>
                            <path
                                d="M18.0186 18.4851L21.5426 22"
                                stroke="currentColor"
                                stroke-width="1.5"
                                stroke-linecap="round"
                                stroke-linejoin="round"></path>
                        </svg>
                    </span>
                    <input type="search" class="form-control" placeholder="Search..." />
                </div>
                <button
                    class="navbar-toggler"
                    type="button"
                    data-bs-toggle="collapse"
                    data-bs-target="#navbarSupportedContent"
                    aria-controls="navbarSupportedContent"
                    aria-expanded="false"
                    aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon">
                        <span class="mt-2 navbar-toggler-bar bar1"></span>
                        <span class="navbar-toggler-bar bar2"></span>
                        <span class="navbar-toggler-bar bar3"></span>
                    </span>
                </button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="mb-2 navbar-nav ms-auto align-items-center navbar-list mb-lg-0">
                        <li class="nav-item dropdown">
                            <a
                                class="py-0 nav-link d-flex align-items-center"
                                href="#"
                                id="navbarDropdown"
                                role="button"
                                data-bs-toggle="dropdown"
                                aria-expanded="false">
                                <img
                                    src="<?= media() ?>/images/avatars/01.png"
                                    alt="User-Profile"
                                    class="theme-color-default-img img-fluid avatar avatar-50 avatar-rounded" />
                                <img
                                    src="<?= media() ?>/images/avatars/avtar_1.png"
                                    alt="User-Profile"
                                    class="theme-color-purple-img img-fluid avatar avatar-50 avatar-rounded" />
                                <img
                                    src="<?= media() ?>/images/avatars/avtar_2.png"
                                    alt="User-Profile"
                                    class="theme-color-blue-img img-fluid avatar avatar-50 avatar-rounded" />
                                <img
                                    src="<?= media() ?>/images/avatars/avtar_4.png"
                                    alt="User-Profile"
                                    class="theme-color-green-img img-fluid avatar avatar-50 avatar-rounded" />
                                <img
                                    src="<?= media() ?>/images/avatars/avtar_5.png"
                                    alt="User-Profile"
                                    class="theme-color-yellow-img img-fluid avatar avatar-50 avatar-rounded" />
                                <img
                                    src="<?= media() ?>/images/avatars/avtar_3.png"
                                    alt="User-Profile"
                                    class="theme-color-pink-img img-fluid avatar avatar-50 avatar-rounded" />
                                <div class="caption ms-3 d-none d-md-block">
                                    <h6 class="mb-0 caption-title">Austin Robertson</h6>
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
                                <h1>Hello Gutter!</h1>
                                <p>
                                    We are on a mission to help developers like you build successful projects for
                                    FREE.
                                </p>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
            <div class="iq-header-img">
                <img
                    src="<?= media() ?>/images/dashboard/top-header.png"
                    alt="header"
                    class="theme-color-default-img img-fluid w-100 h-100 animated-scaleX" />
                <img
                    src="<?= media() ?>/images/dashboard/top-header1.png"
                    alt="header"
                    class="theme-color-purple-img img-fluid w-100 h-100 animated-scaleX" />
                <img
                    src="<?= media() ?>/images/dashboard/top-header2.png"
                    alt="header"
                    class="theme-color-blue-img img-fluid w-100 h-100 animated-scaleX" />
                <img
                    src="<?= media() ?>/images/dashboard/top-header3.png"
                    alt="header"
                    class="theme-color-green-img img-fluid w-100 h-100 animated-scaleX" />
                <img
                    src="<?= media() ?>/images/dashboard/top-header4.png"
                    alt="header"
                    class="theme-color-yellow-img img-fluid w-100 h-100 animated-scaleX" />
                <img
                    src="<?= media() ?>/images/dashboard/top-header5.png"
                    alt="header"
                    class="theme-color-pink-img img-fluid w-100 h-100 animated-scaleX" />
            </div>
        </div>
        <!-- Nav Header Component End -->
        <!--Nav End-->
    </div>
    <div class="conatiner-fluid content-inner mt-n5 py-0">
        <div class="row">
            <div class="modal fade" id="detalles" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header bg-primary">
                            <h5 class="modal-title text-white" id="staticBackdropLabel">Detalle de la Reserva</h5>
                            <button type="button" class="btn-close" id="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body" id="modal-body">

                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-12  col-lg-12">
                <div class="col-md-12">
                    <div class="card" data-aos="fade-up" data-aos-delay="800"></div>
                    <div id="calendar"></div>
                </div>
            </div>
        </div>
    </div>
    </div>
</main>
<?php footer_admin($data); ?>