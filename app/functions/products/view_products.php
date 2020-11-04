<?php
require_once("../../settings/db.php");
session_start();

global $connection;

## Read value
$draw = $_POST['draw'];
$row = $_POST['start'];
$rowperpage = $_POST['length']; // Rows display per page
$columnIndex = $_POST['order'][0]['column']; // Column index
$columnName = $_POST['columns'][$columnIndex]['data']; // Column name
$columnSortOrder = $_POST['order'][0]['dir']; // asc or desc
$searchValue = $_POST['search']['value']; // Search value

## Search 
$searchQuery = " ";
if($searchValue != ''){
        $searchQuery = " and (product_name like '%".$searchValue."%' or 
        product_id like '%".$searchValue."%' or product_description like '%".$searchValue."%') ";
}

## Total number of records without filtering
$sel = mysqli_query($connection,"select count(*) as allcount from products WHERE product_active = 1 ORDER BY product_id ASC");
$records = mysqli_fetch_assoc($sel);
$totalRecords = $records['allcount'];

## Total number of record with filtering
$sel = mysqli_query($connection,"select count(*) as allcount from products WHERE product_active = 1 ".$searchQuery);
$records = mysqli_fetch_assoc($sel);
$totalRecordwithFilter = $records['allcount'];

## Fetch records
$empQuery = "select * from products left join categories on products.product_category = categories.cat_id left join currency on products.product_currency_code_id = currency.currency_id WHERE product_active =  1 ".$searchQuery." order by ".$columnName." ".$columnSortOrder." limit ".$row.",".$rowperpage;
$empRecords = mysqli_query($connection, $empQuery);
$data = array();

while ($row = mysqli_fetch_assoc($empRecords)) {

    ##other querys
    
    #data-toggle='modal' data-target='#exampleModal'

    ##other querys

$data[] = array( 
    "product_id"=>$row['product_id'],
    "product_name"=>$row['product_name'],
    "product_category"=>$row['cat_name'],
    "product_description"=>$row['product_description'],
    "product_price"=>$row['product_price'],
    "product_currency_code_id"=>$row['currency_code'],
    "product_qty"=>$row['product_qty'],
    "product_image"=>"<img class='img-fluid user-img rounded-circle' src='{$row['product_image']}'>",
    "product_actions"=> "
    <a href='index.php?page=product_view&product={$row['product_id']}' class=''  data-cat-name='{$row['product_name']}' data-cat-id='{$row['product_id']}' ><i data-toggle='tooltip' data-placement='left' title='Edit category' style='font-size: 20px; color:#b5b5b5' class='far fa-eye options'></i></a>
    &nbsp;&nbsp;
    <a href='index.php?page=product_update&product={$row['product_id']}'  class=''  data-cat-name='{$row['product_name']}' data-cat-id='{$row['product_id']}'><i data-toggle='tooltip' data-placement='left' title='Edit category' style='font-size: 20px; color:#b5b5b5' class='far fa-edit options'></i></a>
    &nbsp;&nbsp;
    <a href='index.php?page=product_delete&product={$row['product_id']}' class='' data-cat-name='{$row['product_name']}' data-cat-id='{$row['product_id']}'><i data-toggle='tooltip' data-placement='left' title='Delete category' style='font-size: 20px; color:#b5b5b5' class='far fa-trash-alt options'></i></a>"
);
}

## Response
$response = array(
"draw" => intval($draw),
"iTotalRecords" => $totalRecords,
"iTotalDisplayRecords" => $totalRecordwithFilter,
"aaData" => $data
);

echo json_encode($response);


?>