<?php



	$output = '';
	$connect = mysqli_connect("localhost","root","","web_lessons");

	$query = "SELECT * FROM tbl_employee ORDER BY id DESC";
	$result = mysqli_query($connect, $query);
	
	$row = mysqli_fetch_array($result);
		 




require_once __DIR__ . '/vendor/autoload.php';

$mpdf = new \Mpdf\Mpdf();
//$mpdf->WriteHTML('<h1>Hello world!</h1>');
$content = '<div style="float:right;"><h4>THE INSTITUTE OF FINANCE MANAGEMENT,</h4>
					<p>P.O.BOX 3918,</p>
					<h4>SHAABAN ROBERT,</h4>
					<h4>DAR ES SALAAM.</h4>
					<p>Date</p></div>

    <div>
	<h4>REGISTRAR,</h4>
	<h4>THE INSTITUTE OF FINANCE MANAGEMENT,</h4>
	<p>P.O.BOX 3918,</p>
	<h4>SHAABAN ROBERT,</h4>
	<h4>DAR ES SALAAM.</h4></div>


    <div>
	<h4>'.$row["name"].'</h4>
	<h4>DEPARTMENT</h4>
	<h4>THE INSTITUTE OF FINANCE MANAGEMENT,</h4>
	<p>P.O.BOX 3918,</p>
	<h4>SHAABAN ROBERT,</h4>
	<h4>DAR ES SALAAM.</h4>
 <p>Dear Sir.</p></div>

       <h3><b><u>REF: SUBJECT</u></b></h3>


        <div>
       <p>Body</p>
       </div>
        
       <p>Closure</p>
       <span>Signature</span>

       <h5>SENDER NAME</h5>';
$mpdf->WriteHTML($content);
$mpdf->Output();
