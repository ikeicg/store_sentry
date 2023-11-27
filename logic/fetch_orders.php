<?php

require('../db/db_conn.php');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    $jsonData = file_get_contents('php://input');

    $data = json_decode($jsonData, true);


    if (isset($data['type']) && $data['type'] == 'sales') {

        $conn->begin_transaction();

        try {

            $sql = "SELECT p.product_name AS `Product Name`, s.quantity, t.total_value AS total_value
            FROM sales_details s 
            LEFT JOIN sales_orders t ON s.sor_id = t.order_id
            LEFT JOIN products p ON s.pdt_id = p.product_id 
            WHERE s.sor_id = ?;
            ";

            $id = (int) $data['value'];
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("i", $id);
            $stmt->execute();

            $result = $stmt->get_result();
            $fin_array = array();
            $tot_value = 0;


            if ($result->num_rows > 0) {

                while ($row = $result->fetch_assoc()) {
                    $res_array = array(
                        "p_name" => $row["Product Name"],
                        "p_quantity" => $row["quantity"]
                    );
                    $tot_value = $row["total_value"];

                    array_push($fin_array, $res_array);
                }
            }

            $conn->commit();

            echo json_encode(array('status' => 'success', 'message' => array('items' => $fin_array, 'value' => $tot_value)));

        } catch (Exception $e) {
            // Rollback the transaction if any query fails
            $conn->rollback();
            echo json_encode(array('status' => 'error', 'message' => $e->getMessage()));
        }

    } elseif ((isset($data['type']) && $data['type'] == 'purchase')) {

        $conn->begin_transaction();

        try {

            $sql = "SELECT p.product_name AS `Product Name`, s.quantity, t.total_value AS total_value
            FROM purchase_details s 
            LEFT JOIN purchase_orders t ON s.por_id = t.order_id
            LEFT JOIN products p ON s.pdt_id = p.product_id 
            WHERE s.por_id = ?;
            ";

            $id = (int) $data['value'];
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("i", $id);
            $stmt->execute();

            $result = $stmt->get_result();
            $fin_array = array();
            $tot_value = 0;


            if ($result->num_rows > 0) {

                while ($row = $result->fetch_assoc()) {
                    $res_array = array(
                        "p_name" => $row["Product Name"],
                        "p_quantity" => $row["quantity"]
                    );
                    $tot_value = $row["total_value"];

                    array_push($fin_array, $res_array);
                }
            }

            $conn->commit();

            echo json_encode(array('status' => 'success', 'message' => array('items' => $fin_array, 'value' => $tot_value)));

        } catch (Exception $e) {
            // Rollback the transaction if any query fails
            $conn->rollback();
            echo json_encode(array('status' => 'error', 'message' => $e->getMessage()));
        }

    }

}

?>