<?php 

include 'includes/db.php';

if (isset($_POST["bus_id"])) {


	if (empty($_POST["from"]) || empty($_POST["date"]) || empty($_POST["bus_id"]) || empty($_POST["seat"])) {
	
	     echo "Both Fields Required";
	}else{
	
	$bus_id =  mysqli_real_escape_string($connection,$_POST["bus_id"]);
	$user_id =  mysqli_real_escape_string($connection,$_POST["user_id"]);
	$route_id = mysqli_real_escape_string($connection,$_POST["from"]);
	$seat_id =  mysqli_real_escape_string($connection,$_POST["seat"]);
	$date =  mysqli_real_escape_string($connection,$_POST["date"]);
	$time =  mysqli_real_escape_string($connection,$_POST["time"]);
	 $price_id =  mysqli_real_escape_string($connection,$_POST["price"]);
	
	
    $query = mysqli_query($connection, "INSERT orders(bus_id,user_id,route_id,seat_id,date,departure_time,cost_id) VALUES('$bus_id','$user_id','$route_id','$seat_id','$date','$time','$price_id')");
    
   if ($query == TRUE) {

   	  $query_seat_id = mysqli_query($connection, "SELECT id FROM seats WHERE id = '$seat_id'");

   	  $row = mysqli_fetch_assoc($query_seat_id);

   	  $id = $row["id"];

   	   $update_seat = mysqli_query($connection, "UPDATE seats SET available_seats = 'null', booked_seat = 'yes' WHERE id = '$id' ");

   	    if ($update_seat == TRUE) {
   	    	
   	    $ok = '';
   	    echo $ok;
   	    echo "Ticket Booked";
   	}
   }else{

   	  echo "Booking failed";
   }
}

}



?>