<link rel="stylesheet" href="css/store3.css">

<?php

require_once("db/db_conn.php");

$sql = 'SELECT * FROM  PURCHASE_ORDERS';
$result = $conn->query($sql);

?>

<div class="sub_content">

    <table class="entity_table">

        <tr>
            <th>Order ID</th>
            <th>Order Date</th>
            <th>Total Value (Naira)</th>

        </tr>

        <?php

        if ($result->num_rows > 0) {

            while ($row = $result->fetch_assoc()) {
                $num_format = number_format($row['total_value']);
                echo "<tr class='order_line_purchase'>
                            <td class='order_line_id'> {$row['order_id']} </td>
                            <td> {$row['order_date']} </td>
                            <td> {$num_format}</td>
                        </tr>";
            }

        }

        ?>

    </table>

    <div class="hd_orderlines hdn_forms" id="hd_orderlines">
        <div class="close_form">Close</div>
        <table class="entity_table" id="pop_orderline">
            <tr>
                <th>Product Name</th>
                <th>Quantity</th>
            </tr>
        </table>
    </div>
</div>

<script src="js/store4.js" defer></script>