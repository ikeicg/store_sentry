
<link rel="stylesheet" href="css/store3.css">

<?php

require_once("db/db_conn.php");

$sql = 'SELECT product_id, product_name, reorder_quantity, quantity
FROM PRODUCTS
WHERE (quantity - reorder_quantity) <= 10
ORDER BY (quantity - reorder_quantity) DESC';
$result = $conn->query($sql);


?>


<div class="sub_content">

    <div class="itracking_header" style="color: red;">Critical Stock</div>

    <table class="entity_table">

        <tr>
            <th>Product ID</th>
            <th>Product Name</th>
            <th>Reorder Quantity</th>
            <th>Current Quantity</th>
        </tr>

        <?php

        if ($result->num_rows > 0) {

            while ($row = $result->fetch_assoc()) {
                echo "<tr>
                        <td> {$row['product_id']} </td>
                        <td> {$row['product_name']} </td>
                        <td>  {$row['reorder_quantity']}  </td>
                        <td>  {$row['quantity']} </td>
                    </tr>";
            }
        }

        ?>

    </table>


</div>