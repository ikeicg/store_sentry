<link rel="stylesheet" href="css/store3.css">

<?php

require_once("db/db_conn.php");

?>
<div id="error" style="margin: 5px"></div>

<div class="form_options">
    <div class="option_btn" onclick="addProductItem()">Add Product</div>
</div>

<form action="" class="sales_form" method='post'>

    <table class="entity_table">

        <tr>
            <th>PRODUCT ID</th>
            <th>PRODUCT NAME</th>
            <th>UNIT PRICE</th>
            <th>STOCK</th>
            <th>QUANTITY SOLD</th>
        </tr>

    </table>

    <button type="submit" class='create_sales'>Create Order</button>
</form>

<script src='js/store2.js' defer></script>