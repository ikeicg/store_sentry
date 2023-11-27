
<link rel="stylesheet" href="css/store3.css">

<?php

require_once("db/db_conn.php");

$sql = 'SELECT * FROM SUPPLIERS';
$result = $conn->query($sql);

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['add_supplier'])) {

    $spr_name = $_POST['spr_name'];
    $spr_email = $_POST['spr_email'];

    $sql = "INSERT INTO SUPPLIERS (supplier_name, supplier_email) VALUES (?, ?)";

    $stmt = $conn->prepare($sql);

    // Bind parameters to the statement
    $stmt->bind_param("ss", $spr_name, $spr_email);

    // Execute the statement
    if ($stmt->execute()) {
        // echo "New row added successfully."; 
        header("Location: " . $_SERVER['PHP_SELF'] . "?path=suppliers");

    } else {
        echo "Error: " . $stmt->error;
    }
}

?>


<div class="sub_content">

    <div class="form_options">
        <div class="option_btn" onclick="openForm('add_supplier')">New</div>
    </div>

    <table class="entity_table">

        <tr>
            <th>Supplier ID</th>
            <th>Supplier Name</th>
            <th>Supplier Email</th>
        </tr>

        <?php

        if ($result->num_rows > 0) {

            while ($row = $result->fetch_assoc()) {
                echo "<tr>
                        <td> {$row['supplier_id']} </td>
                        <td>  {$row['supplier_name']}  </td>
                        <td>  {$row['supplier_email']} </td>
                    </tr>";
            }
        }

        ?>

    </table>

    <div class="hdn_forms" id="add_supplier">
        <div class="close_form">Close</div>
        <form action="index.php?path=suppliers" method="post">
            <p>Supplier Name:</p>
            <input type="text" name="spr_name" id="spr_name" required autocomplete="off">
            <p>Supplier Email:</p>
            <input type="text" name="spr_email" id="spr_email" required autocomplete="off">
            <button type="submit" name='add_supplier'>
                Submit
            </button>
        </form>
    </div>


</div>

<script defer src="js/store1.js"></script>