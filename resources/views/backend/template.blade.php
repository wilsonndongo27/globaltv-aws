<!doctype html>
<html lang="en" data-layout="vertical" data-topbar="light" data-sidebar="light" data-sidebar-size="lg" data-sidebar-image="none" data-preloader="disable">

<head>

    <meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="Global TV au coeur de l'actualité.">
    <meta name="keywords" content="TV, Chaîne de télévision, Afrique, Cameroun, Télévision">
    <meta name="csrf-token" content="{{ csrf_token() }}">

	<title>GLOBAL TV - DASHBOARD</title>
    <link rel="icon" type="image/png" href="{{ asset ('images/logo.png') }}">

    <!-- jsvectormap css -->
    <link href="{{asset ('assets/libs/jsvectormap/css/jsvectormap.min.css') }}" rel="stylesheet" type="text/css" />

    <!--Swiper slider css-->
    <link href="{{ asset ('assets/libs/swiper/swiper-bundle.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset ('assets/libs/quill/quill.snow.css') }}" rel="stylesheet">
    <link href="{{ asset ('assets/css/sweetalert.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset ('assets/css/toastr.css') }}" rel="stylesheet" type="text/css" />

    <!-- Layout config Js -->
    <script src="{{asset ('assets/js/layout.js') }}"></script>
    <!-- Bootstrap Css -->
    <link href="{{asset ('assets/css/bootstrap.min.css') }}" rel="stylesheet" type="text/css" />

    <!--datatable css-->
    <link rel="stylesheet" href="{{asset ('assets/libs/datatables/dataTables.bootstrap5.min.css') }}" />
    <link rel="stylesheet" href="{{asset ('assets/libs/datatables/responsive.bootstrap.min.css') }}" />
    <link rel="stylesheet" href="{{asset ('assets/libs/datatables/buttons.dataTables.min.css') }}">
    <!-- gridjs css -->
    <link rel="stylesheet" href="{{asset ('assets/libs/gridjs/theme/mermaid.min.css') }}">

    <!-- Icons Css -->
    <link href="{{asset ('assets/css/icons.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{asset ('assets/css/font-awesome.min.css') }}" rel="stylesheet" type="text/css" />
    <!-- App Css-->
    <link href="{{asset ('assets/css/app.min.css') }}" rel="stylesheet" type="text/css" />
    <!-- custom Css-->
    <link href="{{asset ('assets/css/custom.css') }}" rel="stylesheet" type="text/css" />


</head>


<body>
    <!-- Begin page -->
    <div id="layout-wrapper">
        <header id="page-topbar">
            <div class="layout-width">
                <div class="navbar-header">
                    <div class="d-flex">
                        <!-- LOGO -->
                        <div class="navbar-brand-box horizontal-logo">
                            <a href="{{route('analytics')}}" class="logo logo-dark">
                                <span class="logo-sm">
                                    <img src="{{ asset ('images/logo.png') }}" alt="" height="22">
                                </span>
                                <span class="logo-lg">
                                    <img src="{{ asset ('images/logo.png') }}" alt="" height="17">
                                </span>
                            </a>

                            <a href="{{route('analytics')}}" class="logo logo-light">
                                <span class="logo-sm">
                                    <img src="{{ asset ('images/logo.png') }}" alt="" height="22">
                                </span>
                                <span class="logo-lg">
                                    <img src="{{ asset ('images/logo.png') }}" alt="" height="17">
                                </span>
                            </a>
                        </div>

                        <button type="button" class="btn btn-sm px-3 fs-16 header-item vertical-menu-btn topnav-hamburger" id="topnav-hamburger-icon">
                            <span class="hamburger-icon">
                                <span></span>
                                <span></span>
                                <span></span>
                            </span>
                        </button>

                        <!-- App Search-->
                        <form class="app-search d-none d-md-block">
                            <div class="position-relative">
                                <input type="text" class="form-control" placeholder="Search..." autocomplete="off" id="search-options" value="">
                                <span class="mdi mdi-magnify search-widget-icon"></span>
                                <span class="mdi mdi-close-circle search-widget-icon search-widget-icon-close d-none" id="search-close-options"></span>
                            </div>
                            <div class="dropdown-menu dropdown-menu-lg" id="search-dropdown">
                                <div data-simplebar style="max-height: 320px;">
                                    <!-- item-->
                                    <div class="dropdown-header">
                                        <h6 class="text-overflow text-muted mb-0 text-uppercase">Recent Searches</h6>
                                    </div>

                                    <div class="dropdown-item bg-transparent text-wrap">
                                        <a href="{{route('analytics')}}" class="btn btn-soft-secondary btn-sm rounded-pill">how to setup <i class="mdi mdi-magnify ms-1"></i></a>
                                        <a href="{{route('analytics')}}" class="btn btn-soft-secondary btn-sm rounded-pill">buttons <i class="mdi mdi-magnify ms-1"></i></a>
                                    </div>
                                    <!-- item-->
                                    <div class="dropdown-header mt-2">
                                        <h6 class="text-overflow text-muted mb-1 text-uppercase">Pages</h6>
                                    </div>

                                    <!-- item-->
                                    <a href="javascript:void(0);" class="dropdown-item notify-item">
                                        <i class="ri-bubble-chart-line align-middle fs-18 text-muted me-2"></i>
                                        <span>Analytics Dashboard</span>
                                    </a>

                                    <!-- item-->
                                    <a href="javascript:void(0);" class="dropdown-item notify-item">
                                        <i class="ri-lifebuoy-line align-middle fs-18 text-muted me-2"></i>
                                        <span>Help Center</span>
                                    </a>

                                    <!-- item-->
                                    <a href="javascript:void(0);" class="dropdown-item notify-item">
                                        <i class="ri-user-settings-line align-middle fs-18 text-muted me-2"></i>
                                        <span>My account settings</span>
                                    </a>

                                    <!-- item-->
                                    <div class="dropdown-header mt-2">
                                        <h6 class="text-overflow text-muted mb-2 text-uppercase">Members</h6>
                                    </div>

                                    <div class="notification-list">
                                        <!-- item -->
                                        <a href="javascript:void(0);" class="dropdown-item notify-item py-2">
                                            <div class="d-flex">
                                                <img src="{{ asset ('assets/images/users/avatar-2.jpg') }}" class="me-3 rounded-circle avatar-xs" alt="user-pic">
                                                <div class="flex-grow-1">
                                                    <h6 class="m-0">Angela Bernier</h6>
                                                    <span class="fs-11 mb-0 text-muted">Manager</span>
                                                </div>
                                            </div>
                                        </a>
                                        <!-- item -->
                                        <a href="javascript:void(0);" class="dropdown-item notify-item py-2">
                                            <div class="d-flex">
                                                <img src="{{ asset ('assets/images/users/avatar-3.jpg') }}" class="me-3 rounded-circle avatar-xs" alt="user-pic">
                                                <div class="flex-grow-1">
                                                    <h6 class="m-0">David Grasso</h6>
                                                    <span class="fs-11 mb-0 text-muted">Web Designer</span>
                                                </div>
                                            </div>
                                        </a>
                                        <!-- item -->
                                        <a href="javascript:void(0);" class="dropdown-item notify-item py-2">
                                            <div class="d-flex">
                                                <img src="{{ asset ('assets/images/users/avatar-5.jpg') }}" class="me-3 rounded-circle avatar-xs" alt="user-pic">
                                                <div class="flex-grow-1">
                                                    <h6 class="m-0">Mike Bunch</h6>
                                                    <span class="fs-11 mb-0 text-muted">React Developer</span>
                                                </div>
                                            </div>
                                        </a>
                                    </div>
                                </div>

                                <div class="text-center pt-3 pb-1">
                                    <a href="pages-search-results.html" class="btn btn-primary btn-sm">View All Results <i class="ri-arrow-right-line ms-1"></i></a>
                                </div>
                            </div>
                        </form>
                    </div>

                    <div class="d-flex align-items-center">

                        <div class="dropdown d-md-none topbar-head-dropdown header-item">
                            <button type="button" class="btn btn-icon btn-topbar btn-ghost-secondary rounded-circle" id="page-header-search-dropdown" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="bx bx-search fs-22"></i>
                            </button>
                            <div class="dropdown-menu dropdown-menu-lg dropdown-menu-end p-0" aria-labelledby="page-header-search-dropdown">
                                <form class="p-3">
                                    <div class="form-group m-0">
                                        <div class="input-group">
                                            <input type="text" class="form-control" placeholder="Search ..." aria-label="Recipient's username">
                                            <button class="btn btn-primary" type="submit"><i class="mdi mdi-magnify"></i></button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>

                        <div class="dropdown ms-1 topbar-head-dropdown header-item">
                            <button type="button" class="btn btn-icon btn-topbar btn-ghost-secondary rounded-circle" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <img id="header-lang-img" src="{{ asset ('assets/images/flags/us.svg') }}" alt="Header Language" height="20" class="rounded">
                            </button>
                            <div class="dropdown-menu dropdown-menu-end">

                                <!-- item-->
                                <a href="javascript:void(0);" class="dropdown-item notify-item language py-2" data-lang="en" title="English">
                                    <img src="{{ asset ('assets/images/flags/us.svg') }}" alt="user-image" class="me-2 rounded" height="18">
                                    <span class="align-middle">English</span>
                                </a>

                                <!-- item-->
                                <a href="javascript:void(0);" class="dropdown-item notify-item language" data-lang="sp" title="Spanish">
                                    <img src="{{ asset ('assets/images/flags/spain.svg') }}" alt="user-image" class="me-2 rounded" height="18">
                                    <span class="align-middle">Española</span>
                                </a>

                                <!-- item-->
                                <a href="javascript:void(0);" class="dropdown-item notify-item language" data-lang="ar" title="Arabic">
                                    <img src="{{ asset ('assets/images/flags/ae.svg') }}" alt="user-image" class="me-2 rounded" height="18">
                                    <span class="align-middle">Arabic</span>
                                </a>
                            </div>
                        </div>

                        <div class="dropdown topbar-head-dropdown ms-1 header-item">
                            <button type="button" class="btn btn-icon btn-topbar btn-ghost-secondary rounded-circle" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class='bx bx-category-alt fs-22'></i>
                            </button>
                            <div class="dropdown-menu dropdown-menu-lg p-0 dropdown-menu-end">
                                <div class="p-3 border-top-0 border-start-0 border-end-0 border-dashed border">
                                    <div class="row align-items-center">
                                        <div class="col">
                                            <h6 class="m-0 fw-semibold fs-15"> Web Apps </h6>
                                        </div>
                                        <div class="col-auto">
                                            <a href="#!" class="btn btn-sm btn-soft-info"> View All Apps
                                                <i class="ri-arrow-right-s-line align-middle"></i></a>
                                        </div>
                                    </div>
                                </div>

                                <div class="p-2">
                                    <div class="row g-0">
                                        <div class="col">
                                            <a class="dropdown-icon-item" href="#!">
                                                <img src="{{ asset ('assets/images/brands/github.png') }}" alt="Github">
                                                <span>GitHub</span>
                                            </a>
                                        </div>
                                        <div class="col">
                                            <a class="dropdown-icon-item" href="#!">
                                                <img src="{{ asset ('assets/images/brands/bitbucket.png') }}" alt="bitbucket">
                                                <span>Bitbucket</span>
                                            </a>
                                        </div>
                                        <div class="col">
                                            <a class="dropdown-icon-item" href="#!">
                                                <img src="{{ asset ('assets/images/brands/dribbble.png') }}" alt="dribbble">
                                                <span>Dribbble</span>
                                            </a>
                                        </div>
                                    </div>

                                    <div class="row g-0">
                                        <div class="col">
                                            <a class="dropdown-icon-item" href="#!">
                                                <img src="{{ asset ('assets/images/brands/dropbox.png') }}" alt="dropbox">
                                                <span>Dropbox</span>
                                            </a>
                                        </div>
                                        <div class="col">
                                            <a class="dropdown-icon-item" href="#!">
                                                <img src="{{ asset ('assets/images/brands/mail_chimp.png') }}" alt="mail_chimp">
                                                <span>Mail Chimp</span>
                                            </a>
                                        </div>
                                        <div class="col">
                                            <a class="dropdown-icon-item" href="#!">
                                                <img src="{{ asset ('assets/images/brands/slack.png') }}" alt="slack">
                                                <span>Slack</span>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="dropdown topbar-head-dropdown ms-1 header-item">
                            <button type="button" class="btn btn-icon btn-topbar btn-ghost-secondary rounded-circle" id="page-header-cart-dropdown" data-bs-toggle="dropdown" data-bs-auto-close="outside" aria-haspopup="true" aria-expanded="false">
                                <i class='bx bx-shopping-bag fs-22'></i>
                                <span class="position-absolute topbar-badge cartitem-badge fs-10 translate-middle badge rounded-pill bg-info">5</span>
                            </button>
                            <div class="dropdown-menu dropdown-menu-xl dropdown-menu-end p-0 dropdown-menu-cart" aria-labelledby="page-header-cart-dropdown">
                                <div class="p-3 border-top-0 border-start-0 border-end-0 border-dashed border">
                                    <div class="row align-items-center">
                                        <div class="col">
                                            <h6 class="m-0 fs-16 fw-semibold"> My Cart</h6>
                                        </div>
                                        <div class="col-auto">
                                            <span class="badge bg-warning-subtle text-warning fs-13"><span class="cartitem-badge">7</span>
                                                items</span>
                                        </div>
                                    </div>
                                </div>
                                <div data-simplebar style="max-height: 300px;">
                                    <div class="p-2">
                                        <div class="text-center empty-cart" id="empty-cart">
                                            <div class="avatar-md mx-auto my-3">
                                                <div class="avatar-title bg-info-subtle text-info fs-36 rounded-circle">
                                                    <i class='bx bx-cart'></i>
                                                </div>
                                            </div>
                                            <h5 class="mb-3">Your Cart is Empty!</h5>
                                            <a href="apps-ecommerce-products.html" class="btn btn-success w-md mb-3">Shop Now</a>
                                        </div>
                                        <div class="d-block dropdown-item dropdown-item-cart text-wrap px-3 py-2">
                                            <div class="d-flex align-items-center">
                                                <img src="{{ asset ('assets/images/products/img-1.png') }}" class="me-3 rounded-circle avatar-sm p-2 bg-light" alt="user-pic">
                                                <div class="flex-grow-1">
                                                    <h6 class="mt-0 mb-1 fs-14">
                                                        <a href="apps-ecommerce-product-details.html" class="text-reset">Branded
                                                            T-Shirts</a>
                                                    </h6>
                                                    <p class="mb-0 fs-12 text-muted">
                                                        Quantity: <span>10 x $32</span>
                                                    </p>
                                                </div>
                                                <div class="px-2">
                                                    <h5 class="m-0 fw-normal">$<span class="cart-item-price">320</span></h5>
                                                </div>
                                                <div class="ps-2">
                                                    <button type="button" class="btn btn-icon btn-sm btn-ghost-secondary remove-item-btn"><i class="ri-close-fill fs-16"></i></button>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="d-block dropdown-item dropdown-item-cart text-wrap px-3 py-2">
                                            <div class="d-flex align-items-center">
                                                <img src="{{ asset ('assets/images/products/img-2.png') }}" class="me-3 rounded-circle avatar-sm p-2 bg-light" alt="user-pic">
                                                <div class="flex-grow-1">
                                                    <h6 class="mt-0 mb-1 fs-14">
                                                        <a href="apps-ecommerce-product-details.html" class="text-reset">Bentwood Chair</a>
                                                    </h6>
                                                    <p class="mb-0 fs-12 text-muted">
                                                        Quantity: <span>5 x $18</span>
                                                    </p>
                                                </div>
                                                <div class="px-2">
                                                    <h5 class="m-0 fw-normal">$<span class="cart-item-price">89</span></h5>
                                                </div>
                                                <div class="ps-2">
                                                    <button type="button" class="btn btn-icon btn-sm btn-ghost-secondary remove-item-btn"><i class="ri-close-fill fs-16"></i></button>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="d-block dropdown-item dropdown-item-cart text-wrap px-3 py-2">
                                            <div class="d-flex align-items-center">
                                                <img src="{{ asset ('assets/images/products/img-3.png') }}" class="me-3 rounded-circle avatar-sm p-2 bg-light" alt="user-pic">
                                                <div class="flex-grow-1">
                                                    <h6 class="mt-0 mb-1 fs-14">
                                                        <a href="apps-ecommerce-product-details.html" class="text-reset">
                                                            Borosil Paper Cup</a>
                                                    </h6>
                                                    <p class="mb-0 fs-12 text-muted">
                                                        Quantity: <span>3 x $250</span>
                                                    </p>
                                                </div>
                                                <div class="px-2">
                                                    <h5 class="m-0 fw-normal">$<span class="cart-item-price">750</span></h5>
                                                </div>
                                                <div class="ps-2">
                                                    <button type="button" class="btn btn-icon btn-sm btn-ghost-secondary remove-item-btn"><i class="ri-close-fill fs-16"></i></button>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="d-block dropdown-item dropdown-item-cart text-wrap px-3 py-2">
                                            <div class="d-flex align-items-center">
                                                <img src="{{ asset ('assets/images/products/img-6.png') }}" class="me-3 rounded-circle avatar-sm p-2 bg-light" alt="user-pic">
                                                <div class="flex-grow-1">
                                                    <h6 class="mt-0 mb-1 fs-14">
                                                        <a href="apps-ecommerce-product-details.html" class="text-reset">Gray
                                                            Styled T-Shirt</a>
                                                    </h6>
                                                    <p class="mb-0 fs-12 text-muted">
                                                        Quantity: <span>1 x $1250</span>
                                                    </p>
                                                </div>
                                                <div class="px-2">
                                                    <h5 class="m-0 fw-normal">$ <span class="cart-item-price">1250</span></h5>
                                                </div>
                                                <div class="ps-2">
                                                    <button type="button" class="btn btn-icon btn-sm btn-ghost-secondary remove-item-btn"><i class="ri-close-fill fs-16"></i></button>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="d-block dropdown-item dropdown-item-cart text-wrap px-3 py-2">
                                            <div class="d-flex align-items-center">
                                                <img src="{{ asset ('assets/images/products/img-5.png') }}" class="me-3 rounded-circle avatar-sm p-2 bg-light" alt="user-pic">
                                                <div class="flex-grow-1">
                                                    <h6 class="mt-0 mb-1 fs-14">
                                                        <a href="apps-ecommerce-product-details.html" class="text-reset">Stillbird Helmet</a>
                                                    </h6>
                                                    <p class="mb-0 fs-12 text-muted">
                                                        Quantity: <span>2 x $495</span>
                                                    </p>
                                                </div>
                                                <div class="px-2">
                                                    <h5 class="m-0 fw-normal">$<span class="cart-item-price">990</span></h5>
                                                </div>
                                                <div class="ps-2">
                                                    <button type="button" class="btn btn-icon btn-sm btn-ghost-secondary remove-item-btn"><i class="ri-close-fill fs-16"></i></button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="p-3 border-bottom-0 border-start-0 border-end-0 border-dashed border" id="checkout-elem">
                                    <div class="d-flex justify-content-between align-items-center pb-3">
                                        <h5 class="m-0 text-muted">Total:</h5>
                                        <div class="px-2">
                                            <h5 class="m-0" id="cart-item-total">$1258.58</h5>
                                        </div>
                                    </div>

                                    <a href="apps-ecommerce-checkout.html" class="btn btn-success text-center w-100">
                                        Checkout
                                    </a>
                                </div>
                            </div>
                        </div>

                        <div class="ms-1 header-item d-none d-sm-flex">
                            <button type="button" class="btn btn-icon btn-topbar btn-ghost-secondary rounded-circle" data-toggle="fullscreen">
                                <i class='bx bx-fullscreen fs-22'></i>
                            </button>
                        </div>

                        <div class="ms-1 header-item d-none d-sm-flex">
                            <button type="button" class="btn btn-icon btn-topbar btn-ghost-secondary rounded-circle light-dark-mode">
                                <i class='bx bx-moon fs-22'></i>
                            </button>
                        </div>

                        <div class="dropdown topbar-head-dropdown ms-1 header-item" id="notificationDropdown">
                            <button type="button" class="btn btn-icon btn-topbar btn-ghost-secondary rounded-circle" id="page-header-notifications-dropdown" data-bs-toggle="dropdown" data-bs-auto-close="outside" aria-haspopup="true" aria-expanded="false">
                                <i class='bx bx-bell fs-22'></i>
                                <span class="position-absolute topbar-badge fs-10 translate-middle badge rounded-pill bg-danger">3<span class="visually-hidden">unread messages</span></span>
                            </button>
                            <div class="dropdown-menu dropdown-menu-lg dropdown-menu-end p-0" aria-labelledby="page-header-notifications-dropdown">

                                <div class="dropdown-head bg-primary bg-pattern rounded-top">
                                    <div class="p-3">
                                        <div class="row align-items-center">
                                            <div class="col">
                                                <h6 class="m-0 fs-16 fw-semibold text-white"> Notifications </h6>
                                            </div>
                                            <div class="col-auto dropdown-tabs">
                                                <span class="badge bg-light-subtle text-body fs-13"> 4 New</span>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="px-2 pt-2">
                                        <ul class="nav nav-tabs dropdown-tabs nav-tabs-custom" data-dropdown-tabs="true" id="notificationItemsTab" role="tablist">
                                            <li class="nav-item waves-effect waves-light">
                                                <a class="nav-link active" data-bs-toggle="tab" href="#all-noti-tab" role="tab" aria-selected="true">
                                                    All (4)
                                                </a>
                                            </li>
                                            <li class="nav-item waves-effect waves-light">
                                                <a class="nav-link" data-bs-toggle="tab" href="#messages-tab" role="tab" aria-selected="false">
                                                    Messages
                                                </a>
                                            </li>
                                            <li class="nav-item waves-effect waves-light">
                                                <a class="nav-link" data-bs-toggle="tab" href="#alerts-tab" role="tab" aria-selected="false">
                                                    Alerts
                                                </a>
                                            </li>
                                        </ul>
                                    </div>

                                </div>

                                <div class="tab-content position-relative" id="notificationItemsTabContent">
                                    <div class="tab-pane fade show active py-2 ps-2" id="all-noti-tab" role="tabpanel">
                                        <div data-simplebar style="max-height: 300px;" class="pe-2">
                                            <div class="text-reset notification-item d-block dropdown-item position-relative">
                                                <div class="d-flex">
                                                    <div class="avatar-xs me-3 flex-shrink-0">
                                                        <span class="avatar-title bg-info-subtle text-info rounded-circle fs-16">
                                                            <i class="bx bx-badge-check"></i>
                                                        </span>
                                                    </div>
                                                    <div class="flex-grow-1">
                                                        <a href="#!" class="stretched-link">
                                                            <h6 class="mt-0 mb-2 lh-base">Your <b>Elite</b> author Graphic
                                                                Optimization <span class="text-secondary">reward</span> is
                                                                ready!
                                                            </h6>
                                                        </a>
                                                        <p class="mb-0 fs-11 fw-medium text-uppercase text-muted">
                                                            <span><i class="mdi mdi-clock-outline"></i> Just 30 sec ago</span>
                                                        </p>
                                                    </div>
                                                    <div class="px-2 fs-15">
                                                        <div class="form-check notification-check">
                                                            <input class="form-check-input" type="checkbox" value="" id="all-notification-check01">
                                                            <label class="form-check-label" for="all-notification-check01"></label>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="text-reset notification-item d-block dropdown-item position-relative">
                                                <div class="d-flex">
                                                    <img src="{{ asset ('assets/images/users/avatar-2.jpg') }}" class="me-3 rounded-circle avatar-xs flex-shrink-0" alt="user-pic">
                                                    <div class="flex-grow-1">
                                                        <a href="#!" class="stretched-link">
                                                            <h6 class="mt-0 mb-1 fs-13 fw-semibold">Angela Bernier</h6>
                                                        </a>
                                                        <div class="fs-13 text-muted">
                                                            <p class="mb-1">Answered to your comment on the cash flow forecast's
                                                                graph 🔔.</p>
                                                        </div>
                                                        <p class="mb-0 fs-11 fw-medium text-uppercase text-muted">
                                                            <span><i class="mdi mdi-clock-outline"></i> 48 min ago</span>
                                                        </p>
                                                    </div>
                                                    <div class="px-2 fs-15">
                                                        <div class="form-check notification-check">
                                                            <input class="form-check-input" type="checkbox" value="" id="all-notification-check02">
                                                            <label class="form-check-label" for="all-notification-check02"></label>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="text-reset notification-item d-block dropdown-item position-relative">
                                                <div class="d-flex">
                                                    <div class="avatar-xs me-3 flex-shrink-0">
                                                        <span class="avatar-title bg-danger-subtle text-danger rounded-circle fs-16">
                                                            <i class='bx bx-message-square-dots'></i>
                                                        </span>
                                                    </div>
                                                    <div class="flex-grow-1">
                                                        <a href="#!" class="stretched-link">
                                                            <h6 class="mt-0 mb-2 fs-13 lh-base">You have received <b class="text-success">20</b> new messages in the conversation
                                                            </h6>
                                                        </a>
                                                        <p class="mb-0 fs-11 fw-medium text-uppercase text-muted">
                                                            <span><i class="mdi mdi-clock-outline"></i> 2 hrs ago</span>
                                                        </p>
                                                    </div>
                                                    <div class="px-2 fs-15">
                                                        <div class="form-check notification-check">
                                                            <input class="form-check-input" type="checkbox" value="" id="all-notification-check03">
                                                            <label class="form-check-label" for="all-notification-check03"></label>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="text-reset notification-item d-block dropdown-item position-relative">
                                                <div class="d-flex">
                                                    <img src="{{ asset ('assets/images/users/avatar-8.jpg') }}" class="me-3 rounded-circle avatar-xs flex-shrink-0" alt="user-pic">
                                                    <div class="flex-grow-1">
                                                        <a href="#!" class="stretched-link">
                                                            <h6 class="mt-0 mb-1 fs-13 fw-semibold">Maureen Gibson</h6>
                                                        </a>
                                                        <div class="fs-13 text-muted">
                                                            <p class="mb-1">We talked about a project on linkedin.</p>
                                                        </div>
                                                        <p class="mb-0 fs-11 fw-medium text-uppercase text-muted">
                                                            <span><i class="mdi mdi-clock-outline"></i> 4 hrs ago</span>
                                                        </p>
                                                    </div>
                                                    <div class="px-2 fs-15">
                                                        <div class="form-check notification-check">
                                                            <input class="form-check-input" type="checkbox" value="" id="all-notification-check04">
                                                            <label class="form-check-label" for="all-notification-check04"></label>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="my-3 text-center view-all">
                                                <button type="button" class="btn btn-soft-success waves-effect waves-light">View
                                                    All Notifications <i class="ri-arrow-right-line align-middle"></i></button>
                                            </div>
                                        </div>

                                    </div>

                                    <div class="tab-pane fade py-2 ps-2" id="messages-tab" role="tabpanel" aria-labelledby="messages-tab">
                                        <div data-simplebar style="max-height: 300px;" class="pe-2">
                                            <div class="text-reset notification-item d-block dropdown-item">
                                                <div class="d-flex">
                                                    <img src="{{ asset ('assets/images/users/avatar-3.jpg') }}" class="me-3 rounded-circle avatar-xs" alt="user-pic">
                                                    <div class="flex-grow-1">
                                                        <a href="#!" class="stretched-link">
                                                            <h6 class="mt-0 mb-1 fs-13 fw-semibold">James Lemire</h6>
                                                        </a>
                                                        <div class="fs-13 text-muted">
                                                            <p class="mb-1">We talked about a project on linkedin.</p>
                                                        </div>
                                                        <p class="mb-0 fs-11 fw-medium text-uppercase text-muted">
                                                            <span><i class="mdi mdi-clock-outline"></i> 30 min ago</span>
                                                        </p>
                                                    </div>
                                                    <div class="px-2 fs-15">
                                                        <div class="form-check notification-check">
                                                            <input class="form-check-input" type="checkbox" value="" id="messages-notification-check01">
                                                            <label class="form-check-label" for="messages-notification-check01"></label>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="text-reset notification-item d-block dropdown-item">
                                                <div class="d-flex">
                                                    <img src="{{ asset ('assets/images/users/avatar-2.jpg') }}" class="me-3 rounded-circle avatar-xs" alt="user-pic">
                                                    <div class="flex-grow-1">
                                                        <a href="#!" class="stretched-link">
                                                            <h6 class="mt-0 mb-1 fs-13 fw-semibold">Angela Bernier</h6>
                                                        </a>
                                                        <div class="fs-13 text-muted">
                                                            <p class="mb-1">Answered to your comment on the cash flow forecast's
                                                                graph 🔔.</p>
                                                        </div>
                                                        <p class="mb-0 fs-11 fw-medium text-uppercase text-muted">
                                                            <span><i class="mdi mdi-clock-outline"></i> 2 hrs ago</span>
                                                        </p>
                                                    </div>
                                                    <div class="px-2 fs-15">
                                                        <div class="form-check notification-check">
                                                            <input class="form-check-input" type="checkbox" value="" id="messages-notification-check02">
                                                            <label class="form-check-label" for="messages-notification-check02"></label>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="text-reset notification-item d-block dropdown-item">
                                                <div class="d-flex">
                                                    <img src="{{ asset ('assets/images/users/avatar-6.jpg') }}" class="me-3 rounded-circle avatar-xs" alt="user-pic">
                                                    <div class="flex-grow-1">
                                                        <a href="#!" class="stretched-link">
                                                            <h6 class="mt-0 mb-1 fs-13 fw-semibold">Kenneth Brown</h6>
                                                        </a>
                                                        <div class="fs-13 text-muted">
                                                            <p class="mb-1">Mentionned you in his comment on 📃 invoice #12501.
                                                            </p>
                                                        </div>
                                                        <p class="mb-0 fs-11 fw-medium text-uppercase text-muted">
                                                            <span><i class="mdi mdi-clock-outline"></i> 10 hrs ago</span>
                                                        </p>
                                                    </div>
                                                    <div class="px-2 fs-15">
                                                        <div class="form-check notification-check">
                                                            <input class="form-check-input" type="checkbox" value="" id="messages-notification-check03">
                                                            <label class="form-check-label" for="messages-notification-check03"></label>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="text-reset notification-item d-block dropdown-item">
                                                <div class="d-flex">
                                                    <img src="{{ asset ('assets/images/users/avatar-8.jpg') }}" class="me-3 rounded-circle avatar-xs" alt="user-pic">
                                                    <div class="flex-grow-1">
                                                        <a href="#!" class="stretched-link">
                                                            <h6 class="mt-0 mb-1 fs-13 fw-semibold">Maureen Gibson</h6>
                                                        </a>
                                                        <div class="fs-13 text-muted">
                                                            <p class="mb-1">We talked about a project on linkedin.</p>
                                                        </div>
                                                        <p class="mb-0 fs-11 fw-medium text-uppercase text-muted">
                                                            <span><i class="mdi mdi-clock-outline"></i> 3 days ago</span>
                                                        </p>
                                                    </div>
                                                    <div class="px-2 fs-15">
                                                        <div class="form-check notification-check">
                                                            <input class="form-check-input" type="checkbox" value="" id="messages-notification-check04">
                                                            <label class="form-check-label" for="messages-notification-check04"></label>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="my-3 text-center view-all">
                                                <button type="button" class="btn btn-soft-success waves-effect waves-light">View
                                                    All Messages <i class="ri-arrow-right-line align-middle"></i></button>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="tab-pane fade p-4" id="alerts-tab" role="tabpanel" aria-labelledby="alerts-tab"></div>

                                    <div class="notification-actions" id="notification-actions">
                                        <div class="d-flex text-muted justify-content-center">
                                            Select <div id="select-content" class="text-body fw-semibold px-1">0</div> Result <button type="button" class="btn btn-link link-danger p-0 ms-3" data-bs-toggle="modal" data-bs-target="#removeNotificationModal">Remove</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="dropdown ms-sm-3 header-item topbar-user">
                            <button type="button" class="btn" id="page-header-user-dropdown" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <span class="d-flex align-items-center">
                                    @if (Auth::check())
                                        <img class="rounded-circle header-profile-user" src="{{ asset ('storage/'.Auth::user()->pp) }}" alt="Header Avatar">
                                        <span class="text-start ms-xl-2">
                                            <span class="d-none d-xl-inline-block ms-1 fw-medium user-name-text">
                                                {{Auth::user()->name}}
                                            </span>
                                            <span class="d-none d-xl-block ms-1 fs-12 user-name-sub-text">
                                                Admin
                                            </span>
                                        </span>
                                    @else
                                        <span style="color: red">Déconnecter</span>
                                    @endif
                                </span>
                            </button>
                            <div class="dropdown-menu dropdown-menu-end">
                                <!-- item-->
                                <h6 class="dropdown-header">
                                    @if (Auth::check())
                                        {{Auth::user()->name}}
                                    @else
                                    @endif
                                </h6>
                                <a class="dropdown-item" href="pages-profile.html"><i class="mdi mdi-account-circle text-muted fs-16 align-middle me-1"></i> <span class="align-middle">Profile</span></a>
                                <a class="dropdown-item" href="apps-chat.html"><i class="mdi mdi-message-text-outline text-muted fs-16 align-middle me-1"></i> <span class="align-middle">Messages</span></a>
                                <a class="dropdown-item" href="apps-tasks-kanban.html"><i class="mdi mdi-calendar-check-outline text-muted fs-16 align-middle me-1"></i> <span class="align-middle">Taskboard</span></a>
                                <a class="dropdown-item" href="pages-faqs.html"><i class="mdi mdi-lifebuoy text-muted fs-16 align-middle me-1"></i> <span class="align-middle">Help</span></a>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" href="pages-profile.html"><i class="mdi mdi-wallet text-muted fs-16 align-middle me-1"></i> <span class="align-middle">Balance : <b>$5971.67</b></span></a>
                                <a class="dropdown-item" href="pages-profile-settings.html"><span class="badge bg-success-subtle text-success mt-1 float-end">New</span><i class="mdi mdi-cog-outline text-muted fs-16 align-middle me-1"></i> <span class="align-middle">Settings</span></a>
                                <a class="dropdown-item" href="auth-lockscreen-basic.html"><i class="mdi mdi-lock text-muted fs-16 align-middle me-1"></i> <span class="align-middle">Lock screen</span></a>
                                <a class="dropdown-item Logout" href="javascript:void()" data-url={{route('logout')}}>
                                    <i class="mdi mdi-logout text-muted fs-16 align-middle me-1"></i> 
                                    <span class="align-middle" data-key="t-logout">Logout</span>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </header>

        <!-- removeNotificationModal -->
        <div id="removeNotificationModal" class="modal fade zoomIn" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" id="NotificationModalbtn-close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="mt-2 text-center">
                            <lord-icon src="https://cdn.lordicon.com/gsqxdxog.json" trigger="loop" colors="primary:#f7b84b,secondary:#f06548" style="width:100px;height:100px"></lord-icon>
                            <div class="mt-4 pt-2 fs-15 mx-4 mx-sm-5">
                                <h4>Are you sure ?</h4>
                                <p class="text-muted mx-4 mb-0">Are you sure you want to remove this Notification ?</p>
                            </div>
                        </div>
                        <div class="d-flex gap-2 justify-content-center mt-4 mb-2">
                            <button type="button" class="btn w-sm btn-light" data-bs-dismiss="modal">Close</button>
                            <button type="button" class="btn w-sm btn-danger" id="delete-notification">Yes, Delete It!</button>
                        </div>
                    </div>

                </div><!-- /.modal-content -->
            </div><!-- /.modal-dialog -->
        </div>
        <!-- /.modal -->

        <!-- ========== App Menu ========== -->
        <div class="app-menu navbar-menu">
            <!-- LOGO -->
            <div class="navbar-brand-box">
                <!-- Dark Logo-->
                <a href="{{route('analytics')}}" class="logo logo-dark">
                    <span class="logo-sm">
                        <img src="{{ asset ('images/logo.png') }}" alt="" height="22">
                    </span>
                    <span class="logo-lg">
                        <img src="{{ asset ('images/logo.png') }}" alt="" height="17">
                    </span>
                </a>
                <!-- Light Logo-->
                <a href="{{route('analytics')}}" class="logo logo-light">
                    <span class="logo-sm">
                        <img src="{{ asset ('images/logo.png') }}" alt="" height="22">
                    </span>
                    <span class="logo-lg">
                        <img src="{{ asset ('images/logo.png') }}" alt="" height="17">
                    </span>
                </a>
                <button type="button" class="btn btn-sm p-0 fs-20 header-item float-end btn-vertical-sm-hover" id="vertical-hover">
                    <i class="ri-record-circle-line"></i>
                </button>
            </div>

            <div id="scrollbar">
                <div class="container-fluid">

                    <div id="two-column-menu">
                    </div>
                    <ul class="navbar-nav" id="navbar-nav">
                        <li class="menu-title"><span data-key="t-menu">Administration</span></li>
                        <li class="nav-item">
                            <a class="nav-link menu-link" href="#sidebarDashboards" data-bs-toggle="collapse" role="button" aria-expanded="false" aria-controls="sidebarDashboards">
                                <i data-feather="home" class="icon-dual"></i> <span data-key="t-dashboards">Dashboards</span>
                            </a>
                            <div class="collapse menu-dropdown" id="sidebarDashboards">
                                <ul class="nav nav-sm flex-column">
                                    <li class="nav-item">
                                        <a href="{{ route ('analytics')}}" class="nav-link" data-key="t-analytics"> Analytics </a>
                                    </li>
                                </ul>
                            </div>
                        </li> 

                        <li class="nav-item">
                            <a class="nav-link menu-link" href="#enterprise" data-bs-toggle="collapse" role="button" aria-expanded="false" aria-controls="enterprise">
                                <i data-feather="info" class="icon-dual"></i> <span data-key="t-dashboards">Entreprise</span>
                            </a>
                            <div class="collapse menu-dropdown" id="enterprise">
                                <ul class="nav nav-sm flex-column">
                                    <li class="nav-item">
                                        <a href="{{ route ('company')}}" class="nav-link" data-key="t-apropos">A Propos de L'entreprise</a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="#" class="nav-link" data-key="t-agence">Gestion des Agences</a>
                                    </li>
                                </ul>
                            </div>
                        </li> 

                        <li class="nav-item">
                            <a class="nav-link menu-link" href="#users" data-bs-toggle="collapse" role="button" aria-expanded="false" aria-controls="users">
                                <i data-feather="users" class="icon-dual"></i> <span data-key="t-dashboards">Utilisateurs</span>
                            </a>
                            <div class="collapse menu-dropdown" id="users">
                                <ul class="nav nav-sm flex-column">
                                    <li class="nav-item">
                                        <a href="#" class="nav-link" data-key="t-rules">Gestion des rôles</a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="{{ route ('users')}}" class="nav-link" data-key="t-users">Gestion des utilisateurs</a>
                                    </li>
                                </ul>
                            </div>
                        </li> 

                        <li class="nav-item">
                            <a class="nav-link menu-link" href="#log" data-bs-toggle="collapse" role="button" aria-expanded="false" aria-controls="log">
                                <i data-feather="database" class="icon-dual"></i> <span data-key="t-dashboards">Logs</span>
                            </a>
                            <div class="collapse menu-dropdown" id="log">
                                <ul class="nav nav-sm flex-column">
                                    <li class="nav-item">
                                        <a href="#" class="nav-link" data-key="t-logc">Logs de connexion</a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="#" class="nav-link" data-key="t-loga">Logs des actions</a>
                                    </li>
                                </ul>
                            </div>
                        </li> 

                        <li class="menu-title"><span data-key="t-menu">Services</span></li>
                        <li class="nav-item">
                            <a class="nav-link menu-link" href="#streaming" data-bs-toggle="collapse" role="button" aria-expanded="false" aria-controls="streaming">
                                <i data-feather="cast" class="icon-dual"></i> <span data-key="t-dashboards">Streaming</span>
                            </a>
                            <div class="collapse menu-dropdown" id="streaming">
                                <ul class="nav nav-sm flex-column">
                                    <li class="nav-item">
                                        <a href="{{route('stream')}}" class="nav-link" data-key="t-flux"> Gestion des flux </a>
                                    </li>
                                </ul>
                            </div>

                            <a class="nav-link menu-link" href="#program" data-bs-toggle="collapse" role="button" aria-expanded="false" aria-controls="program">
                                <i class="icon-dual ri-calendar-todo-fill"></i> <span data-key="t-dashboards">Programmes</span>
                            </a>
                            <div class="collapse menu-dropdown" id="program">
                                <ul class="nav nav-sm flex-column">
                                    <li class="nav-item">
                                        <a href="{{route('program')}}" class="nav-link" data-key="t-flux"> Gestion des pragrammes </a>
                                    </li>
                                </ul>
                            </div>

                            <a class="nav-link menu-link" href="#replay" data-bs-toggle="collapse" role="button" aria-expanded="false" aria-controls="replay">
                                <i class="icon-dual ri-play-list-2-line"></i> <span data-key="t-dashboards">Replays</span>
                            </a>
                            <div class="collapse menu-dropdown" id="replay">
                                <ul class="nav nav-sm flex-column">
                                    <li class="nav-item">
                                        <a href="{{route('replay')}}" class="nav-link" data-key="t-flux"> Gestion des replays </a>
                                    </li>
                                </ul>
                            </div>

                            <a class="nav-link menu-link" href="#interview" data-bs-toggle="collapse" role="button" aria-expanded="false" aria-controls="interview">
                                <i class="icon-dual ri-airplay-line"></i> <span data-key="t-dashboards">Interview</span>
                            </a>
                            <div class="collapse menu-dropdown" id="interview">
                                <ul class="nav nav-sm flex-column">
                                    <li class="nav-item">
                                        <a href="{{route('interview')}}" class="nav-link" data-key="t-flux"> Gestion des Interviews </a>
                                    </li>
                                </ul>
                            </div>

                            <a class="nav-link menu-link" href="#podcast" data-bs-toggle="collapse" role="button" aria-expanded="false" aria-controls="podcast">
                                <i class="icon-dual ri-broadcast-line"></i> <span data-key="t-dashboards">Podcasts</span>
                            </a>
                            <div class="collapse menu-dropdown" id="podcast">
                                <ul class="nav nav-sm flex-column">
                                    <li class="nav-item">
                                        <a href="{{route('podcast')}}" class="nav-link" data-key="t-flux"> Gestion des Podcasts </a>
                                    </li>
                                </ul>
                            </div>
                        </li> 

                        <li class="menu-title"><span data-key="t-menu">Advertizings</span></li>
                        <li class="nav-item">
                            <a class="nav-link menu-link" href="#banner" data-bs-toggle="collapse" role="button" aria-expanded="false" aria-controls="banner">
                                <i data-feather="flag" class="icon-dual"></i> <span data-key="t-dashboards">Bannières</span>
                            </a>
                            <div class="collapse menu-dropdown" id="banner">
                                <ul class="nav nav-sm flex-column">
                                    <li class="nav-item">
                                        <a href="{{route('banner')}}" class="nav-link" data-key="t-banner"> Gestion de la bannière </a>
                                    </li>
                                </ul>
                            </div>

                            <a class="nav-link menu-link" href="#news" data-bs-toggle="collapse" role="button" aria-expanded="false" aria-controls="news">
                                <i data-feather="rss" class="icon-dual"></i> <span data-key="t-dashboards">Actualités</span>
                            </a>
                            <div class="collapse menu-dropdown" id="news">
                                <ul class="nav nav-sm flex-column">
                                    <li class="nav-item">
                                        <a href="{{route('category')}}" class="nav-link" data-key="t-cat"> Gestion des Catégories </a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="{{route('news')}}" class="nav-link" data-key="t-actu"> Gestion des Actualités </a>
                                    </li>
                                </ul>
                            </div>
                            
                            <a class="nav-link menu-link" href="#pub" data-bs-toggle="collapse" role="button" aria-expanded="false" aria-controls="pub">
                                <i data-feather="bell" class="icon-dual"></i> <span data-key="t-dashboards">Espace Publicitaire</span>
                            </a>
                            <div class="collapse menu-dropdown" id="pub">
                                <ul class="nav nav-sm flex-column">
                                    <li class="nav-item">
                                        <a href="#" class="nav-link" data-key="t-zone"> Gestion des Zones </a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="#" class="nav-link" data-key="t-pubstate"> Gestion des Publicités </a>
                                    </li>
                                </ul>
                            </div>
                        </li> 
                        

                        <li class="menu-title"><span data-key="t-menu">Supports</span></li>
                        <li class="nav-item">
                            <a class="nav-link menu-link" href="#followers" data-bs-toggle="collapse" role="button" aria-expanded="false" aria-controls="followers">
                                <i data-feather="user-check" class="icon-dual"></i> <span data-key="t-dashboards">Abonnées</span>
                            </a>
                            <div class="collapse menu-dropdown" id="followers">
                                <ul class="nav nav-sm flex-column">
                                    <li class="nav-item">
                                        <a href="#" class="nav-link" data-key="t-banner"> Gestion des Abonnées </a>
                                    </li>
                                </ul>
                            </div>

                            <a class="nav-link menu-link" href="#visitor" data-bs-toggle="collapse" role="button" aria-expanded="false" aria-controls="visitor">
                                <i data-feather="user-plus" class="icon-dual"></i> <span data-key="t-dashboards">Visiteurs</span>
                            </a>
                            <div class="collapse menu-dropdown" id="visitor">
                                <ul class="nav nav-sm flex-column">
                                    <li class="nav-item">
                                        <a href="#" class="nav-link" data-key="t-visitor"> Gestion des Visiteurs </a>
                                    </li>
                                </ul>
                            </div>
                            
                            <a class="nav-link menu-link" href="#support" data-bs-toggle="collapse" role="button" aria-expanded="false" aria-controls="support">
                                <i data-feather="help-circle" class="icon-dual"></i> <span data-key="t-dashboards">Support Service</span>
                            </a>
                            <div class="collapse menu-dropdown" id="support">
                                <ul class="nav nav-sm flex-column">
                                    <li class="nav-item">
                                        <a href="#" class="nav-link" data-key="t-agent"> Gestion des Agents </a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="#" class="nav-link" data-key="t-ticket"> Gestion des Tickets </a>
                                    </li>
                                </ul>
                            </div>
                        </li> 


                        <li class="menu-title"><span data-key="t-menu">Finances</span></li>
                        <li class="nav-item">
                            <a class="nav-link menu-link" href="#product" data-bs-toggle="collapse" role="button" aria-expanded="false" aria-controls="product">
                                <i data-feather="shopping-bag" class="icon-dual"></i> <span data-key="t-dashboards">Produits</span>
                            </a>
                            <div class="collapse menu-dropdown" id="product">
                                <ul class="nav nav-sm flex-column">
                                    <li class="nav-item">
                                        <a href="#" class="nav-link" data-key="t-banner"> Gestion des Produits </a>
                                    </li>
                                </ul>
                            </div>

                            <a class="nav-link menu-link" href="#command" data-bs-toggle="collapse" role="button" aria-expanded="false" aria-controls="command">
                                <i data-feather="shopping-cart" class="icon-dual"></i> <span data-key="t-dashboards">Commandes</span>
                            </a>
                            <div class="collapse menu-dropdown" id="command">
                                <ul class="nav nav-sm flex-column">
                                    <li class="nav-item">
                                        <a href="#" class="nav-link" data-key="t-command"> Gestion des Commandes </a>
                                    </li>
                                </ul>
                            </div>
                            
                            <a class="nav-link menu-link" href="#report" data-bs-toggle="collapse" role="button" aria-expanded="false" aria-controls="report">
                                <i data-feather="list" class="icon-dual"></i> <span data-key="t-dashboards">Reportings</span>
                            </a>
                            <div class="collapse menu-dropdown" id="report">
                                <ul class="nav nav-sm flex-column">
                                    <li class="nav-item">
                                        <a href="#" class="nav-link" data-key="t-agent">Etats Financiers </a>
                                    </li>
                                </ul>
                            </div>
                        </li> 


                        <!-- end Dashboard Menu -->
                    </ul>
                </div>
                <!-- Sidebar -->
            </div>

            <div class="sidebar-background"></div>
        </div>
        <!-- Left Sidebar End -->
        <!-- Vertical Overlay-->
        <div class="vertical-overlay"></div>

        <!-- ============================================================== -->
        <!-- Start right Content here -->
        <!-- ============================================================== -->
        <div class="main-content">

            <div class="page-content">
                <div class="container-fluid">

                    <!-- start page title -->
                    <div class="row">
                        @yield('route')
                    </div>
                    <!-- end page title -->

                    @yield('body')

                </div>
                <!-- container-fluid -->
            </div>
            <!-- End Page-content -->

            <footer class="footer">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-sm-6">
                            <script>document.write(new Date().getFullYear())</script> © Global TV.
                        </div>
                        <div class="col-sm-6">
                            <div class="text-sm-end d-none d-sm-block">
                                Design & Develop by GLOBAL IT
                            </div>
                        </div>
                    </div>
                </div>
            </footer>
        </div>
        <!-- end main content-->

    </div>
    <!-- END layout-wrapper -->



    <!--start back-to-top-->
    <button onclick="topFunction()" class="btn btn-danger btn-icon" id="back-to-top">
        <i class="ri-arrow-up-line"></i>
    </button>
    <!--end back-to-top-->

    <!--preloader-->
    <div id="preloader">
        <div id="status">
            <div class="spinner-border text-primary avatar-sm" role="status">
                <span class="visually-hidden">Loading...</span>
            </div>
        </div>
    </div>

    <div class="customizer-setting d-none d-md-block">
        <div class="btn-primary rounded-pill shadow-lg btn btn-icon btn-lg p-2" data-bs-toggle="offcanvas" data-bs-target="#theme-settings-offcanvas" aria-controls="theme-settings-offcanvas">
            <i class='mdi mdi-spin mdi-cog-outline fs-22'></i>
        </div>
    </div>

    <!-- JAVASCRIPT -->
    <!-- jQuery 3 -->
	<script src="{{ asset ('assets/libs/jquery/jquery.js') }}"></script>
	
	<!-- jQuery UI 1.11.4 -->
	<script src="{{ asset ('assets/libs/jquery/jquery-ui.js') }}"></script>

    <script src="{{ asset ('assets/libs/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    
    <script src="{{ asset ('assets/libs/simplebar/simplebar.min.js') }}"></script>
    <script src="{{ asset ('assets/libs/node-waves/waves.min.js') }}"></script>
    <script src="{{ asset ('assets/libs/feather-icons/feather.min.js') }}"></script>
    <script src="{{ asset ('assets/js/pages/plugins/lord-icon-2.1.0.js') }}"></script>
    <script src="{{ asset ('assets/js/plugins.js') }}"></script>
    <script src="{{ asset ('assets/js/toastr.min.js') }}"></script>
    <script src="{{ asset ('assets/js/sweetalert.min.js') }}"></script>
    
    <!-- prismjs plugin -->
    <script src="{{ asset ('assets/libs/prismjs/prism.js') }}"></script>

    <!-- Lord Icon -->
    <script src="{{ asset ('assets/js/pages/mssddfmo.js') }}"></script>

    <!-- Modal Js -->
    <script src="{{ asset ('assets/js/pages/modal.init.js') }}"></script>

    <!-- apexcharts -->
    <script src="{{ asset ('assets/libs/apexcharts/apexcharts.min.js') }}"></script>

    <!-- Vector map-->
    <script src="{{ asset ('assets/libs/jsvectormap/js/jsvectormap.min.js') }}"></script>
    <script src="{{ asset ('assets/libs/jsvectormap/maps/world-merc.js') }}"></script>

    <script src="//cdn.quilljs.com/1.3.6/quill.min.js"></script>

    <!-- Dashboard init -->
    <script src="{{ asset ('assets/js/pages/dashboard-analytics.init.js') }}"></script>

    <!--datatable js-->
    <script src="{{ asset ('assets/libs/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset ('assets/libs/datatables/dataTables.bootstrap5.min.js') }}"></script>
    <script src="{{ asset ('assets/libs/datatables/dataTables.responsive.min.js') }}"></script>
    <script src="{{ asset ('assets/libs/datatables/dataTables.buttons.min.js') }}"></script>
    <script src="{{ asset ('assets/libs/datatables/buttons.print.min.js') }}"></script>
    <script src="{{ asset ('assets/libs/datatables/buttons.html5.min.js') }}"></script>
    <script src="{{ asset ('assets/libs/datatables/vfs_fonts.js') }}"></script>
    <script src="{{ asset ('assets/libs/datatables/pdfmake.min.js') }}"></script>
    <script src="{{ asset ('assets/libs/datatables/jszip.min.js') }}"></script>
    <script src="{{ asset ('assets/js/pages/datatables.init.js') }}"></script>
    <script src="{{ asset ('assets/libs/quill/quill.min.js') }}"></script>

    <!-- App js -->
    <script src="{{ asset ('assets/js/app.js') }}"></script>
    <script src="{{ asset ('assets/js/script.js') }}"></script>
    <script src="{{ asset ('assets/js/user.js') }}"></script>
    <script src="{{ asset ('assets/js/company.js') }}"></script>
    <script src="{{ asset ('assets/js/banner.js') }}"></script>
    <script src="{{ asset ('assets/js/category.js') }}"></script>
    <script src="{{ asset ('assets/js/news.js') }}"></script>
    <script src="{{ asset ('assets/js/stream.js') }}"></script>
    <script src="{{ asset ('assets/js/program.js') }}"></script>
    <script src="{{ asset ('assets/js/replay.js') }}"></script>
    <script src="{{ asset ('assets/js/podcast.js') }}"></script>
    <script src="{{ asset ('assets/js/interview.js') }}"></script>
</body>


</html>