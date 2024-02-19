
<link rel="stylesheet" href="css/store3.css">

<?php

require_once("db/db_conn.php");

$sql = 'SELECT p.product_name AS pname, SUM(sd.quantity) AS total_quantity
FROM `sales_details` sd
LEFT JOIN products p ON sd.pdt_id = p.product_id
LEFT JOIN sales_orders so ON sd.sor_id = so.order_id 
WHERE WEEK(so.order_date) = WEEK(CURDATE())
GROUP BY p.product_id
ORDER BY SUM(sd.quantity) DESC';

$result = $conn->query($sql);


?>


<div class="sub_content">

    <div class="itracking_header" >TOP WEEKLY PEFORMERS</div>

    <table class="entity_table">

        <tr>
            <th>Product Name</th>
            <th>Quantity Sold</th>
           
        </tr>

        <?php

        if ($result->num_rows > 0) {

            while ($row = $result->fetch_assoc()) {
                echo "<tr>
                        <td> {$row['pname']} </td>
                        <td>  {$row['total_quantity']}  </td>
                    </tr>";
            }
        }

        ?>

    </table>


</div>