<link rel="stylesheet" href="css/store3.css">

<?php

require_once("db/db_conn.php");

$sql = "SELECT product_id, product_name, expiry
        FROM products
        WHERE expiry > 0 
        AND (expiry - UNIX_TIMESTAMP()) <= 604800
        ORDER BY expiry";
$result = $conn->query($sql);


?>


<div class="sub_content">

    <div class="itracking_header" style="color: red;">Expiration Tracker</div>

    <table class="entity_table">

        <tr>
            <th>Product ID</th>
            <th>Product Name</th>
            <th>Expires</th>
            <th>Countdown</th>
        </tr>

        <?php

        if ($result->num_rows > 0) {

            while ($row = $result->fetch_assoc()) {

                // Convert Unix timestamp to standard date format
                $expiryDate = date('Y-m-d', $row['expiry']);

                // Calculate the difference between expiry date and current date in days
                $currentDate = time(); // Current Unix timestamp
                $expiryDaysLeft = round(($row['expiry'] - $currentDate) / (60 * 60 * 24)); // Difference in days

                echo "<tr>
                        <td> {$row['product_id']} </td>
                        <td> {$row['product_name']} </td>
                        <td> $expiryDate </td>
                        <td> $expiryDaysLeft days</td>
                    </tr>";
            }
        }

        ?>

    </table>


</div>