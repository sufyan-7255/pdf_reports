<?php
// include('select_2.php');
// Include mpdf library file
require_once __DIR__ . '/vendor/autoload.php';
$mpdf = new \Mpdf\Mpdf();

// Database Connection
// $con = new mysqli('hostname', 'username', 'password', 'database');
$localhost = "localhost";
$user = "root";
$pass = "";
$db = "select_2_db";
$con = mysqli_connect($localhost, $user, $pass, $db);

$select = "SELECT * FROM `company_tbl` where company_id = '" . $_GET['sid'] . "' ";

$result = $con->query($select);
$data = array();
while ($row = $result->fetch_object()) {
    $data .= '<tr>'
    . '<td>' . $row->company_id . '</td>'
    . '<td>' . $row->company_name . '</td></tr>'
    . '<td>' . $row->company_phone . '</td></tr>'
    . '<td>' . $row->company_email . '</td></tr>'
    . '<td>' . $row->company_address . '</td></tr>';
}

// Take PDF contents in a variable
$pdfcontent = '<h1>Welcome to Sufyan</h1>
<br>
<h2>Employee Details</h2>
<br>
<table autosize="1">
		<tr>
		<td style="width: 10%"><strong>ID</strong></td>
		<td style="width: 36%"><strong>NAME</strong></td>
		<td style="width: 20%"><strong>PHONE</strong></td>
		<td style="width: 26%"><strong>EMAIL</strong></td>
		<td style="width: 56%"><strong>ADDRESS</strong></td>
		</tr>
		' . $data . '
		</table>';

$mpdf->WriteHTML($pdfcontent);

$mpdf->SetDisplayMode('fullpage');
$mpdf->list_indent_first_level = 0;

//call watermark content and image
$mpdf->SetWatermarkText('Sufyan');
$mpdf->showWatermarkText = true;
$mpdf->watermarkTextAlpha = 0.2;

//output in browser
$mpdf->Output();
