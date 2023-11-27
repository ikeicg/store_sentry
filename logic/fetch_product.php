<?php

require('../db/db_conn.php');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    $jsonData = file_get_contents('php://input');

    $data = json_decode($jsonData, true);

    if ($data['type'] == "searchoptions") {

        $sql = "SELECT product_name pn FROM PRODUCTS p WHERE p.product_id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("i", $data['value']);
        $stmt->execute();
        $stmt->bind_result($col1);
        if ($stmt->fetch()) {
            $value = $col1;
            echo json_encode(['value' => $value]);
        } else {
            $value = '';
            echo json_encode(['error' => 'Invalid JSON data or missing "value" key']);
        }


    } elseif ($data['type'] == "populateform") {
        $sql = "SELECT product_name, cost_price, selling_price, cty_id, spr_id, reorder_quantity, quantity FROM PRODUCTS p WHERE p.product_id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("i", $data['value']);
        $stmt->execute();
        $stmt->bind_result($col0, $col1, $col2, $col3, $col4, $col5, $col6);

        if ($stmt->fetch()) {
            $value = $col1;
            echo json_encode(['pn' => $col0, 'cp' => $col1, 'sp' => $col2, 'cid' => $col3, 'sid' => $col4, 'rqt' => $col5, 'cqty' => $col6]);
        } else {
            $value = '';
            echo json_encode(['error' => 'Invalid JSON data or missing "value" key']);
        }

    }

}
;

?>