<?php

require('../db/db_conn.php');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    $jsonData = file_get_contents('php://input');

    $data = json_decode($jsonData, true);


    if (isset($data['type']) && $data['type'] == 'sales') {

        $conn->begin_transaction();

        try {

            $totalValue = $data["totalValue"];
            $orderDate = date('Y-m-d H:i:s'); // Current date and time
            $stmt = $conn->prepare("INSERT INTO sales_orders (order_date, total_value) VALUES (?, ?)");
            $stmt->bind_param('sd', $orderDate, $totalValue);
            $stmt->execute();
            $orderId = $conn->insert_id;


            foreach ($data['products'] as $value) {

                $stmt = $conn->prepare("INSERT INTO sales_details (sor_id, pdt_id, quantity) VALUES (?, ?, ?)");
                $stmt->bind_param('iii', $orderId, $value['product_id'], $value['product_quantity']);
                $stmt->execute();

                // Update quantity in products table
                $stmt = $conn->prepare("UPDATE products SET quantity = quantity - ? WHERE product_id = ?");
                $stmt->bind_param('ii', $value['product_quantity'], $value['product_id']);
                $stmt->execute();
            }

            $conn->commit();




            echo json_encode(array('status' => 'success', 'message' => 'Operation sucessful'));
        } catch (Exception $e) {
            // Rollback the transaction if any query fails
            $conn->rollback();
            echo json_encode(array('status' => 'error', 'message' => $e->getMessage()));
        }
    } elseif ((isset($data['type']) && $data['type'] == 'purchase')) {

        $conn->begin_transaction();

        try {


            $totalValue = $data["totalValue"];
            $orderDate = date('Y-m-d H:i:s'); // Current date and time
            $stmt = $conn->prepare("INSERT INTO purchase_orders (order_date, total_value, spr_id) VALUES (?, ?, ?)");
            $stmt->bind_param('sdi', $orderDate, $totalValue, $data['supplierId']);
            $stmt->execute();
            $orderId = $conn->insert_id;


            foreach ($data['products'] as $value) {

                $stmt = $conn->prepare("INSERT INTO purchase_details (por_id, pdt_id, quantity) VALUES (?, ?, ?)");
                $stmt->bind_param('iii', $orderId, $value['product_id'], $value['product_quantity']);
                $stmt->execute();

                $expiry = strtotime($value['product_expiry']);

                // Update quantity in products table
                $stmt = $conn->prepare("UPDATE products SET quantity = quantity + ?, expiry = ? WHERE product_id = ?");
                $stmt->bind_param('iii', $value['product_quantity'], $expiry, $value['product_id']);
                $stmt->execute();
            }


            $conn->commit();

            echo json_encode(array('status' => 'success', 'message' => 'Operation sucessful'));
        } catch (Exception $e) {
            // Rollback the transaction if any query fails
            $conn->rollback();
            echo json_encode(array('status' => 'error', 'message' => $e->getMessage()));
        }
    }
}
