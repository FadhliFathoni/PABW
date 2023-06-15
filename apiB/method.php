<?php
require_once "../conect.php";

class Cart
{
    public function get_cart()
    {
        global $mysqli;
        $query = "SELECT * FROM cart";
        $data = array();
        $result = $mysqli->query($query);
        while ($row = mysqli_fetch_object($result)) {
            $data[] = $row;
        }
        $response = array(
            'status' => 1,
            'message' => 'Get List Shoes Successfully.',
            'data' => $data
        );
        header('Content-Type: application/json');
        echo json_encode($response);
    }

    public function get_cart_by_id($id = 0)
    {
        global $mysqli;
        $query = "SELECT * FROM cart";
        if ($id != 0) {
            $query .= " WHERE id=" . $id . " LIMIT 1";
        }
        $data = array();
        $result = $mysqli->query($query);
        while ($row = mysqli_fetch_object($result)) {
            $data[] = $row;
        }
        $response = array(
            'status' => 1,
            'message' => 'Get Shoes Successfully.',
            'data' => $data
        );
        header('Content-Type: application/json');
        echo json_encode($response);
    }

    public function insert_cart()
    {
        global $mysqli;
        $arrcheckpost = array('product_code' => '','qty' => '');
        $hitung = count(array_intersect_key($_POST, $arrcheckpost));
        if ($hitung == count($arrcheckpost)) {
            if (isset($_POST['qty'])) {
                $qty = $_POST['qty'];
            } else {
                return;
            }
            if (isset($_POST['product_code'])) {
                $product_code = $_POST['product_code'];
            } else {
                return;
            }
            $result = mysqli_query($mysqli, "INSERT INTO cart (product_name, product_size, product_price, qty, product_image, product_code)
            SELECT product_name, product_size, product_price, $qty, product_image, product_code
            FROM product
            WHERE product_code = '$product_code';");

            if ($result) {
                $response = array(
                    'status' => 1,
                    'message' => 'Shoes Added Successfully.'
                );
            } else {
                $response = array(
                    'status' => 0,
                    'message' => 'Shoes Addition Failed.'
                );
            }
        } else {
            $response = array(
                'status' => 0,
                'message' => 'Parameter Do Not Match'
            );
        }
        header('Content-Type: application/json');
        echo json_encode($response);
    }

    function update_cart($product_code)
{
    global $mysqli;
    $arrcheckpost = array('product_code' => '');
    $hitung = count(array_intersect_key($_POST, $arrcheckpost));
    $response = []; // Declare and initialize $response variable

    if ($hitung == count($arrcheckpost)) {
        if (isset($_POST['product_code'])) {
            $product_code = $_POST['product_code'];
        } else {
            return;
        }
        
        $query = "UPDATE product
        JOIN cart ON product.product_code = cart.product_code
        SET product.product_qty = product.product_qty - cart.qty
        WHERE product.product_code = '$product_code';
        ";
        $result = mysqli_query($mysqli, $query);
        
        $query1 = "DELETE FROM `product` WHERE `product_code` = '$product_code' AND `product_qty` = 1";
        $result1 = mysqli_query($mysqli, $query1);
        
        $query2 = "DELETE FROM `cart` WHERE `product_code` = '$product_code'";
        $result2 = mysqli_query($mysqli, $query2);
        
        if ($result || $result1 && $result2) {
            $response["success"] = "true";
        } else {
            $response["success"] = "false";
        }
    } else {
        $response = array(
            'status' => 0,
            'message' => 'Parameter Do Not Match'
        );
    }
    header('Content-Type: application/json');
    echo json_encode($response);
}


    function delete_cart($id)
    {
        global $mysqli;
        $query = "DELETE FROM cart WHERE id=" . $id;
        if (mysqli_query($mysqli, $query)) {
            $response = array(
                'status' => 1,
                'message' => 'Shoes Deleted Successfully.'
            );
        } else {
            $response = array(
                'status' => 0,
                'message' => 'Shoes Deletion Failed.'
            );
        }
        header('Content-Type: application/json');
        echo json_encode($response);
    }
}
