
<link rel="stylesheet" href="css/store3.css">

<?php

require_once("db/db_conn.php");

$sql = 'SELECT * FROM PRODUCTS';
$result = $conn->query($sql);

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['add_product'])) {

    $pdt_name = $_POST['pdt_name'];
    $pdt_cp = $_POST['pdt_cp'];
    $pdt_sp = $_POST['pdt_sp'];
    $cty_id = $_POST['cty_id'];
    $spr_id = $_POST['spr_id'];
    $reorder_qt = $_POST['reorder_qt'];


    $sql = "INSERT INTO PRODUCTS (product_name,
        cost_price, selling_price, cty_id, spr_id, reorder_quantity) VALUES (?, ?, ?, ?, ?, ?)";

    $stmt = $conn->prepare($sql);

    // Bind parameters to the statement
    $stmt->bind_param("siiiii", $pdt_name, $pdt_cp, $pdt_sp, $cty_id, $spr_id, $reorder_qt);

    // Execute the statement
    if ($stmt->execute()) {
        // echo "New row added successfully."; 
        header("Location: " . $_SERVER['PHP_SELF'] . "?path=products");

    } else {
        echo "Error: " . $stmt->error;
    }
} elseif ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['edit_product'])) {

    $pdt_id = $_POST['pdt_id'];
    $pdt_cp = $_POST['pdt_cp'];
    $pdt_sp = $_POST['pdt_sp'];
    $cty_id = $_POST['cty_id'];
    $spr_id = $_POST['spr_id'];
    $reorder_qt = $_POST['reorder_qt'];


    $sql = "UPDATE PRODUCTS
        SET
            cost_price = ?,
            selling_price = ?,
            cty_id = ?,
            spr_id = ?,
            reorder_quantity = ?
        WHERE
            product_id = ?;
        ";

    $stmt = $conn->prepare($sql);

    // Bind parameters to the statement
    $stmt->bind_param("iiiiii", $pdt_cp, $pdt_sp, $cty_id, $spr_id, $reorder_qt, $pdt_id);

    // Execute the statement
    if ($stmt->execute()) {
        // echo "New row added successfully."; 
        header("Location: " . $_SERVER['PHP_SELF'] . "?path=products");

    } else {
        echo "Error: " . $stmt->error;
    }
}


?>



<div class="sub_content">
    <div class="form_options">
        <div class="option_btn" onclick="openForm('add_product')">New</div>
        <div class="option_btn" onclick="openForm('edit_product')">Edit</div>
    </div>

    <table class="entity_table">

        <tr>
            <th>Product ID</th>
            <th>Product Name</th>
            <th>Cost Price</th>
            <th>Selling Price</th>
            <th>Category ID</th>
            <th>Supplier ID</th>
            <th>Reorder Quantity</th>
            <th>Current Quantity</th>
        </tr>

        <?php

        if ($result->num_rows > 0) {

            while ($row = $result->fetch_assoc()) {
                echo "<tr>
                        <td> {$row['product_id']} </td>
                        <td> {$row['product_name']} </td>
                        <td> {$row['cost_price']} </td>
                        <td> {$row['selling_price']}</td>
                        <td> {$row['cty_id']} </td>
                        <td> {$row['spr_id']}</td>
                        <td> {$row['reorder_quantity']}</td>
                        <td> {$row['quantity']}</td>
                    </tr>";
            }
        }

        ?>

    </table>

    <div class="hdn_forms" id="add_product">
        <div class="close_form">Close</div>
        <form action="index.php?path=products" method="post">
            <p>Product Name:</p>
            <input type="text" name="pdt_name" id="pdt_name" required autocomplete="off">
            <p>Cost Price:</p>
            <input type="number" name="pdt_cp" id="pdt_cp" required>
            <p>Selling Price:</p>
            <input type="number" name="pdt_sp" id="pdt_sp" required>
            <p>Category ID:</p>
            <input type="number" name="cty_id" id="cty_id" required>
            <p>Supplier ID:</p>
            <input type="number" name="spr_id" id="spr_id" required>
            <p>Reorder Quantity:</p>
            <input type="number" name="reorder_qt" id="reorder_qt" required>
            <button type="submit" name='add_product'>
                Submit
            </button>
        </form>
    </div>

    <div class="hdn_forms" id="edit_product">
        <div class="close_form">Close</div>
        <form action="index.php?path=products" method="post">
            <p>Enter ID:</p>
            <div class="form_search">
                <input type='number' name='pdt_id' id="search_pid" oninput='fetchProductName(this.value)'></input>
                <div class="form_search_drop" onclick="populateEditForm(10)" onmousedown='populateEditForm(this)'>
                    No Such Product
                </div>
            </div>
            <p>Cost Price:</p>
            <input type="number" name="pdt_cp" id="pdt_cp2" required>
            <p>Selling Price:</p>
            <input type="number" name="pdt_sp" id="pdt_sp2" required>
            <p>Category ID:</p>
            <input type="number" name="cty_id" id="cty_id2" required>
            <p>Supplier ID:</p>
            <input type="number" name="spr_id" id="spr_id2" required>
            <p>Reorder Quantity:</p>
            <input type="number" name="reorder_qt" id="reorder_qt2" required>
            <button type="submit" name='edit_product'>
                Submit
            </button>
        </form>
    </div>
</div>

<script defer src="js/store1.js"></script>