<?php session_start();
include 'connection.php';
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css" integrity="sha384-zCbKRCUGaJDkqS1kPbPd7TveP5iyJE0EjAuZQTgFLD2ylzuqKfdKlfG/eSrtxUkn" crossorigin="anonymous">
    <link rel="stylesheet" href="assets/css/mycss.css?v=<?= time() ?>">
    <link rel="stylesheet" href="assets/css/responsive.css">
    <link rel="shortcut icon" href="assets/img/icon.png" type="image/x-icon">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>iShopping เว็บขายสินค้าออนใลน์</title>
</head>

<body>
    <div class="mobile-nav" id="mobile-nav">
        <ul>
            <li>
                <img src="assets/img/logo.svg?v=2" alt="LOGO BRAND">
            </li>
            <li>
                <a href="index.php">หน้าแรก</a>
            </li>
            <li>
                <a href="">สินค้าทั้งหมด</a>
            </li>
            <li>
                <a href="">คำถามที่พบบ่อย</a>
            </li>
            <li>
                <a href="https://ihaveweb.net/th">ติดต่อเรา</a>
            </li>
            <li>
                <hr>
            </li>
            <li>
                <a href=""><i class="fa fa-door-open"></i> เข้าสู่ระบบ</a>
            </li>
            <li>
                <a href=""><i class="fa fa-user-plus"></i> สมัครสมาชิก</a>
            </li>
        </ul>
    </div>

    <div class="header-sticky">
        <div class="top-header">
            <div class="container">
                <ul class="nav">
                    <li class="nav-item">
                        <a href="" class="nav-link"><i class="fab fa-facebook-square"></i></a>
                    </li>
                    <li class="nav -item">
                        <a href="" class="nav-link"><i class="fab fa-line"></i></a>
                    </li>
                    <li class="nav-item">
                        <a href="" class="nav-link"><i class="fab fa-instagram"></i></a>
                    </li>
                    <li class="nav-item ml-auto position-relative">
                        <a href="cart.php" class="nav-link">
                            <i class="fal fa-shopping-cart"></i>
                        </a>
                        <div class="cart">
                            <?php if (isset($_SESSION['cart'])) { // เช็คว่ามันมี session cart
                                echo count($_SESSION['cart']);
                            } else {
                                echo 0;
                            } ?>
                        </div>
                    </li>
                    <li class="nav-item sm-d-block">
                        <a href="javascript:void(0)" onclick="openNav()" class="nav-link"><i class="fal fa-bars"></i></a>
                    </li>
                </ul>
            </div>
        </div>
        <div class="bottom-header">
            <div class="container">
                <ul class="nav">
                    <li class="nav-item item-logo">
                        <a href="" class="nav-logo">
                            <img src="assets/img/logo.svg?v=2" alt="LOGO BRAND">
                        </a>
                    </li>
                    <li class="nav-item ml-auto active sm-d-none">
                        <a href="index.php" class="nav-link">หน้าแรก</a>
                    </li>
                    <li class="nav-item sm-d-none">
                        <a href="products.php" class="nav-link">สินค้าทั้งหมด</a>
                    </li>
                    <li class="nav-item sm-d-none">
                        <a href="" class="nav-link">คำถามที่พบบ่อย</a>
                    </li>
                    <li class="nav-item sm-d-none">
                        <a href="comparison.php" class="nav-link">เปรียบเทียบสินค้า</a>
                    </li>
                    <li class="nav-item sm-d-none">
                        <a href="https://ihaveweb.net/th" class="nav-link">ติดต่อเรา</a>
                    </li>
                    <?php if (isset($_SESSION['email']) == true) { ?>
                        <div class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-expanded="false">
                                <?php echo $_SESSION['email']; ?>
                            </a>
                            <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                <a class="dropdown-item" href="#">บัญชีของฉัน</a>
                                <a class="dropdown-item" href="order_history.php">ประวัติการสั่งซื้อ</a>
                                <?php if ($_SESSION['position'] == 1) { ?>
                                    <a class="dropdown-item" href="backend/index.php">จัดการหลังบ้าน</a>
                                <?php } ?>
                                <a class="dropdown-item" href="main.php?action=logout">ออกจากระบบ</a>
                            </div>
                        </div>
                    <?php } else { ?>
                        <li class="nav-item sm-ml-auto">
                            <a href="javascript:void(0)" class="nav-link" data-toggle="modal" data-target="#loginModal"><i class="fal fa-door-open"></i> เข้าสู่ระบบ</a>
                        </li>
                    <?php } ?>
                </ul>
            </div>
        </div>
    </div>