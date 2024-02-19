<?php
    // Create a mysqli database connection
    $conn = new mysqli('localhost', 'root', null, 'store_inventory');

    // Check the connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }
    else {
        // echo "Connected Successfully";
    }
?>