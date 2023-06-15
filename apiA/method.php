<?php
require_once "../conect.php";
class Shoes
{
 
   public  function get_sptu()
   {
      global $mysqli;
      $query="SELECT * FROM product";
      $data=array();
      $result=$mysqli->query($query);
      while($row=mysqli_fetch_object($result))
      {
         $data[]=$row;
      }
      $response=array(
                     'status' => 1,
                     'message' =>'Get List Shoes Successfully.',
                     'data' => $data
                  );
      header('Content-Type: application/json');
      echo json_encode($response);
   }
 
   public function get_spt($id=0)
   {
      global $mysqli;
      $query="SELECT * FROM product";
      if($id != 0)
      {
         $query.=" WHERE id=".$id." LIMIT 1";
      }
      $data=array();
      $result=$mysqli->query($query);
      while($row=mysqli_fetch_object($result))
      {
         $data[]=$row;
      }
      $response=array(
                     'status' => 1,
                     'message' =>'Get Shoes Successfully.',
                     'data' => $data
                  );
      header('Content-Type: application/json');
      echo json_encode($response);
        
   }
 
   public function insert_spt()
      {
         global $mysqli;
         $arrcheckpost = array('id' => '', 'product_name' => '', 'product_size' => '', 'product_price' => '', 'product_qty'   => '', 'product_image'   => '', 'product_code'   => '');
         $hitung = count(array_intersect_key($_POST, $arrcheckpost));
         if($hitung == count($arrcheckpost)){
          
               $result = mysqli_query($mysqli, "INSERT INTO product SET
               id = '$_POST[id]',
               nama produk = '$_POST[product_name]',
               ukuran = '$_POST[product_size]',
               harga = '$_POST[product_price]',
               jumlah = '$_POST[product_qty]',
               foto = '$_POST[product_image]',
               kode = '$_POST[product_code]',");
                
               if($result)
               {
                  $response=array(
                     'status' => 1,
                     'message' =>'Shoes Added Successfully.'
                  );
               }
               else
               {
                  $response=array(
                     'status' => 0,
                     'message' =>'Shoes Addition Failed.'
                  );
               }
         }else{
            $response=array(
                     'status' => 0,
                     'message' =>'Parameter Do Not Match'
                  );
         }
         header('Content-Type: application/json');
         echo json_encode($response);
      }
 
   function update_spt($id)
      {
         global $mysqli;
         $arrcheckpost = array('id' => '', 'product_name' => '', 'product_size' => '', 'product_price' => '', 'product_qty'   => '', 'product_image'   => '', 'product_code'   => '');
         $hitung = count(array_intersect_key($_POST, $arrcheckpost));
         if($hitung == count($arrcheckpost)){
          
              $result = mysqli_query($mysqli, "UPDATE tbl_mahasiswa SET
              id = '$_POST[id]',
               nama produk = '$_POST[product_name]',
               ukuran = '$_POST[product_size]',
               harga = '$_POST[product_price]',
               jumlah = '$_POST[product_qty]',
               foto = '$_POST[product_image]',
               kode = '$_POST[product_code]'
               WHERE id='$id'");
          
            if($result)
            {
               $response=array(
                  'status' => 1,
                  'message' =>'Shoes Updated Successfully.'
               );
            }
            else
            {
               $response=array(
                  'status' => 0,
                  'message' =>'Shoes Updation Failed.'
               );
            }
         }else{
            $response=array(
                     'status' => 0,
                     'message' =>'Parameter Do Not Match'
                  );
         }
         header('Content-Type: application/json');
         echo json_encode($response);
      }
 
   function delete_spt($id)
   {
      global $mysqli;
      $query="DELETE FROM product WHERE id=".$id;
      if(mysqli_query($mysqli, $query))
      {
         $response=array(
            'status' => 1,
            'message' =>'Shoes Deleted Successfully.'
         );
      }
      else
      {
         $response=array(
            'status' => 0,
            'message' =>'Shoes Deletion Failed.'
         );
      }
      header('Content-Type: application/json');
      echo json_encode($response);
   }
}
 
 ?>