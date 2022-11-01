<?php
header("Content-Type: application/json");
include("connection.php");

if (isset($_POST['action']) && $_POST['action'] == 'company_id') {
    // $company_id = $_POST["company_id"];
    // $company_name = $_POST["company_name"];
    
    $fetchquery = "select * from company_tbl";
    $fetchqueryconnect = mysqli_query($con, $fetchquery);
    $return_data = [];
    while ($show = mysqli_fetch_assoc($fetchqueryconnect)) {
        $return_data[] = $show;
    }
    // print_r($return_data); die();
}
print(json_encode($return_data, JSON_PRETTY_PRINT));

?>