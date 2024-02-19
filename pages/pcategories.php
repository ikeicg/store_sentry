
<link rel="stylesheet" href="css/store3.css">

<?php

require_once("db/db_conn.php");

$sql = 'SELECT * FROM CATEGORIES';
$result = $conn->query($sql);


if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['add_cty'])) {

    $cty_name = $_POST['cty_name'];
    $cty_desc = $_POST['cty_desc'];

    $sql = "INSERT INTO CATEGORIES (category_name, category_description) VALUES (?, ?)";

    $stmt = $conn->prepare($sql);

    // Bind parameters to the statement
    $stmt->bind_param("ss", $cty_name, $cty_desc);

    // Execute the statement
    if ($stmt->execute()) {
        // echo "New row added successfully."; 
        header("Location: " . $_SERVER['PHP_SELF'] . "?path=pcategories");

    } else {
        echo "Error: " . $stmt->error;
    }
}

?>

<div class="sub_content">
    <div class="form_options">
        <div class="option_btn" onclick="openForm('add_category')">New</div>
    </div>

    <table class="entity_table">

        <tr>
            <th>Category ID</th>
            <th>Category Name</th>
            <th>Description</th>
        </tr>

        <?php

        if ($result->num_rows > 0) {

            while ($row = $result->fetch_assoc()) {

                echo "<tr>
                            <td> {$row['category_id']} </td>
                            <td> {$row['category_name']} </td>
                            <td> {$row['category_description']} </td>
                    </tr>";

            }
        }

        ?>

    </table>


    <div class="hdn_forms" id="add_category">
        <div class="close_form">Close</div>
        <form action="index.php?path=pcategories" method="post">
            <p>Category Name:</p>
            <input type="text" name="cty_name" id="cty_name" required autocomplete="off">
            <p>Category Description:</p>
            <textarea name="cty_desc" id="" cols="30" rows="10" required autocomplete = "off"></textarea>
            <button type="submit" name='add_cty'>
                Submit
            </button>
        </form>
    </div>

</div>

<script defer src="js/store1.js"></script>

