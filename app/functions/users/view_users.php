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
        $searchQuery = " and (user_name like '%".$searchValue."%' or 
        user_email like '%".$searchValue."%') ";
}

## Total number of records without filtering
$sel = mysqli_query($connection,"select count(*) as allcount from users WHERE user_active = 1 ORDER BY user_id ASC");
$records = mysqli_fetch_assoc($sel);
$totalRecords = $records['allcount'];

## Total number of record with filtering
$sel = mysqli_query($connection,"select count(*) as allcount from users WHERE user_active = 1 ".$searchQuery);
$records = mysqli_fetch_assoc($sel);
$totalRecordwithFilter = $records['allcount'];

## Fetch records
$empQuery = "select * from users WHERE user_active =  1 ".$searchQuery." order by ".$columnName." ".$columnSortOrder." limit ".$row.",".$rowperpage;
$empRecords = mysqli_query($connection, $empQuery);
$data = array();

while ($row = mysqli_fetch_assoc($empRecords)) {

    ##other querys
    
    #data-toggle='modal' data-target='#exampleModal'

    ##other querys

$data[] = array( 
    "user_id"=>$row['user_id'],
    "user_image"=>"<img class='img-fluid user-img rounded-circle' src='{$row['user_image']}'>",
    "user_name"=>$row['user_name'],
    "user_email"=>$row['user_email'],
    "user_actions"=> "
    <a href='index.php?page=user_view&user={$row['user_id']}' class=''  data-cat-name='{$row['user_name']}' data-cat-id='{$row['user_id']}' ><i data-toggle='tooltip' data-placement='left' title='Edit category' style='font-size: 20px; color:#b5b5b5' class='far fa-eye options'></i></a>
    &nbsp;&nbsp;
    <a href='index.php?page=user_update&user={$row['user_id']}'  class=''  data-cat-name='{$row['user_name']}' data-cat-id='{$row['user_id']}'><i data-toggle='tooltip' data-placement='left' title='Edit category' style='font-size: 20px; color:#b5b5b5' class='far fa-edit options'></i></a>
    &nbsp;&nbsp;
    <a href='index.php?page=user_delete&user={$row['user_id']}' class='' data-cat-name='{$row['user_name']}' data-cat-id='{$row['user_id']}'><i data-toggle='tooltip' data-placement='left' title='Delete category' style='font-size: 20px; color:#b5b5b5' class='far fa-trash-alt options'></i></a>"
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