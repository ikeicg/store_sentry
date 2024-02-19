
<link rel="stylesheet" href="css/store3.css">

<?php

require_once("db/db_conn.php");

$sql = 'SELECT * FROM PAYMENT_DETAILS';
$result = $conn->query($sql);

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['add_payment'])) {

    $p_bank = $_POST['p_bank'];
    $p_account = $_POST['p_account'];
    $spr_id = $_POST['spr_id'];

    $sql = "INSERT INTO PAYMENT_DETAILS (payment_bank, payment_account, spr_id) VALUES (?, ?, ?)";

    $stmt = $conn->prepare($sql);

    // Bind parameters to the statement
    $stmt->bind_param("ssi", $p_bank, $p_account, $spr_id);

    // Execute the statement
    if ($stmt->execute()) {
        // echo "New row added successfully."; 
        header("Location: " . $_SERVER['PHP_SELF'] . "?path=paydetails");

    } else {
        echo "Error: " . $stmt->error;
    }
}


?>

<div class="form_options">
        <div class="option_btn" onclick="openForm('add_supplier')">New</div>
</div>

<table class="entity_table">

    <tr>
        <th>Payment ID</th>
        <th>Payment Bank</th>
        <th>Payment Account</th>
        <th>Supplier ID</th>
    </tr>

    <?php

    if ($result->num_rows > 0) {

        while ($row = $result->fetch_assoc()) {
            echo "
                <tr>
                    <td>" . $row['payment_id'] . "</td>
                    <td>" . $row['payment_bank'] . "</td>
                    <td>" . $row['payment_account'] . "</td>
                    <td>" . $row['spr_id'] . "</td>
                </tr>
            ";
        }
    }

    ?>

</table>


<div class="hdn_forms" id="add_supplier">
        <div class="close_form">Close</div>
            <form action="index.php?path=paydetails" method="post">
                <p>Supplier's Bank:</p>
                <input type="text" name="p_bank" id="p_bank" required autocomplete="off">
                <p>Supplier's Account:</p>
                <input type="text" name="p_account" id="p_account" required autocomplete="off">
                <p>Supplier ID:</p>
                <input type="number" name="spr_id" id="spr_id" required autocomplete="off">
                <button type="submit" name='add_payment'>
                    Submit
                </button>
            </form>
        </div>
    </div>

<script defer src="js/store1.js"></script>