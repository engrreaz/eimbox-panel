<?php
include 'inc.php';
include 'auth/gpConfig.php';
?>

<!DOCTYPE html>
<html lang="en" data-bs-theme="light">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="google-site-verification" content="K_qbT82L46NbBQI4vboBAETVLjE8sZGuZhwxHE7EIEA" />
    <title>EIMBox - Admin Panel</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Gothic+A1&family=Great+Vibes&family=JetBrains+Mono:ital,wght@0,100..800;1,100..800&family=Noto+Sans+Bengali:wght@100..900&family=Romanesco&display=swap"
        rel="stylesheet">
    <!-- plugins:css -->
    <link rel="stylesheet" href="assets/vendors/mdi/css/materialdesignicons.min.css">
    <link rel="stylesheet" href="assets/vendors/css/vendor.bundle.base.css">

    <link rel="stylesheet" href="assets/vendors/select2/select2.min.css">
    <link rel="stylesheet" href="assets/vendors/select2-bootstrap-theme/select2-bootstrap.min.css">

    <!-- endinject -->
    <!-- Plugin css for this page -->
    <link rel="stylesheet" href="assets/vendors/jvectormap/jquery-jvectormap.css">
    <link rel="stylesheet" href="assets/vendors/flag-icon-css/css/flag-icon.min.css">
    <link rel="stylesheet" href="assets/vendors/owl-carousel-2/owl.carousel.min.css">
    <link rel="stylesheet" href="assets/vendors/owl-carousel-2/owl.theme.default.min.css">



    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Source+Code+Pro:ital,wght@0,200..900;1,200..900&display=swap"
        rel="stylesheet">


    <link rel="stylesheet" href="https://cdn.datatables.net/2.0.8/css/dataTables.dataTables.min.css" />
    <script src="https://cdn.datatables.net/2.0.8/js/dataTables.min.js"></script>
    <!-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.0/css/bootstrap.min.css">
     -->
    <!-- End plugin css for this page -->
    <!-- inject:css -->
    <!-- endinject -->
    <!-- Layout styles -->
    <link rel="stylesheet" href="assets/css/style.css">
    <!-- End layout styles -->
    <link rel="shortcut icon" href="assets/imgs/logo.png" />
    <style>
        * {
            font-family: "Noto Sans Bengali", sans-serif;
        }

        .bg-trans {
            background-color: #333333;
        }

        .code-pro {

            font-family: "Source Code Pro", monospace;
            font-optical-sizing: auto;
            font-weight: 400;
            font-style: italic;
        }
    </style>
    </style>
</head>


<body>



    <div class="container-scroller" id="full-page" style="display:none;">
        <!-- partial:partials/_sidebar.html -->
        <?php

        include 'nav.php';

        ?>
        <!-- partial -->
        <div class="container-fluid page-body-wrapper">
            <!-- partial:partials/_navbar.html -->
            <?php include 'topbar.php'; ?>

            <!-- partial -->
            <div class="main-panel">
                <div class="content-wrapper">

                    <?php
                    $enum = array('1', '2', '3', '4', '5', '6', '7', '8', '9', '0');
                    $bnum = array('১', '২', '৩', '৪', '৫', '৬', '৭', '৮', '৯', '০');


                    // echo '----' . $key . '----';
                    // echo '<br><br>';
                    // echo '----' . $permission . '----';
                    // echo '<br><br>';
                    // echo var_dump($permissions_roll);
                    // echo '<br><br>';
                    // echo var_dump($key);
                    
