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

    function update_cart($id)
    {
        global $mysqli;
        $arrcheckpost = array('product_name' => '', 'product_size' => '', 'product_price' => '', 'product_image' => '', 'qty' => '', 'total_price' => '', 'product_code' => '');
        $hitung = count(array_intersect_key($_POST, $arrcheckpost));
        if ($hitung == count($arrcheckpost)) {
            $result = mysqli_query($mysqli, "UPDATE cart SET
              product_name = '$_POST[product_name]',
              product_size = '$_POST[product_size]',
              product_price = '$_POST[product_price]',
              product_image = '$_POST[product_image]',
              qty = '$_POST[qty]',
              total_price = '$_POST[total_price]',
              product_code = '$_POST[product_code]'
              WHERE id='$id'");

            if ($result) {
                $response = array(
                    'status' => 1,
                    'message' => 'Shoes Updated Successfully.'
                );
            } else {
                $response = array(
                    'status' => 0,
                    'message' => 'Shoes Updation Failed.'
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
?>
