<?php
require_once("db/db_conn.php");

$path = 'products';
if (isset($_GET['path'])) {
    $path = $_GET['path'];
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>StoreInventory - Dashboard</title>
    <link rel="stylesheet" href="css/store1.css">
    <link rel="stylesheet" href="css/store2.css">
</head>

<body>

    <nav>
        Store Inventory
    </nav>

    <div id="content_body">
        <div id="sidebar">
            <a href="index.php?path=products" class="sidebar_item <?= ($path == "products" ? "active_link" : "") ?>">
                Products
            </a>

            <a href="index.php?path=pcategories" class="sidebar_item <?= ($path == "pcategories" ? "active_link" : "") ?>">
                Product Categories
            </a>

            <a href="index.php?path=porders" class="sidebar_item <?= ($path == "porders" ? "active_link" : "") ?>">
                Purchase Orders
            </a>

            <a href="index.php?path=pdetails" class="sidebar_item <?= ($path == "pdetails" ? "active_link" : "") ?>">
                Purchase Details
            </a>

            <a href="index.php?path=sorders" class="sidebar_item <?= ($path == "sorders" ? "active_link" : "") ?>">
                Sales Orders
            </a>

            <a href="index.php?path=sdetails" class="sidebar_item <?= ($path == "sdetails" ? "active_link" : "") ?>">
                Sales Details
            </a>

            <a href="index.php?path=suppliers" class="sidebar_item <?= ($path == "suppliers" ? "active_link" : "") ?>">
                Suppliers
            </a>

            <a href="index.php?path=paydetails" class="sidebar_item <?= ($path == "paydetails" ? "active_link" : "") ?>">
                Payment Details
            </a>

            <a href="index.php?path=itracking" class="sidebar_item <?= ($path == "itracking" ? "active_link" : "") ?>">
                Inventory Tracking
            </a>

            <a href="index.php?path=expiry" class="sidebar_item <?= ($path == "expiry" ? "active_link" : "") ?>">
                Expiration Tracking
            </a>

            <a href="index.php?path=analytics" class="sidebar_item <?= ($path == "analytics" ? "active_link" : "") ?>">
                Analytics
            </a>

        </div>

        <div class="main_content">
            <?php

            if ($path == 'products') {
                include("pages/products.php");
            } elseif ($path == 'pcategories') {
                include("pages/pcategories.php");
            } elseif ($path == 'porders') {
                include("pages/porders.php");
            } elseif ($path == 'pdetails') {
                include("pages/pdetails.php");
            } elseif ($path == 'sorders') {
                include("pages/sorders.php");
            } elseif ($path == 'sdetails') {
                include("pages/sdetails.php");
            } elseif ($path == 'suppliers') {
                include("pages/suppliers.php");
            } elseif ($path == 'paydetails') {
                include("pages/paydetails.php");
            } elseif ($path == 'itracking') {
                include("pages/itracking.php");
            } elseif ($path == 'expiry') {
                include("pages/expiry.php");
            } elseif ($path == 'analytics') {
                include("pages/analytics.php");
            }

            ?>
        </div>
    </div>

</body>

</html>