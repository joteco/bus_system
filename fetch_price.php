<?php 
include 'includes/db.php';

if (isset($_POST["bus_id"])) {
	
	$bus_id = $_POST["bus_id"];


	$query = mysqli_query($connection, "SELECT price.price AS price, price.id AS priceID, price.bus_standard FROM price, bus
		WHERE price.bus_standard = bus.bus_standard AND bus.bus_id = '$bus_id'");

	if ($query == TRUE) {

		$price_row  = mysqli_fetch_assoc($query);
		
         echo ' <label>Ticket Price</label>  <p>Tsh  '.number_format($price_row['price']).' /=</p>';

         echo '<input type="hidden" name="price" value="'.$price_row["priceID"].'">';
	}else{

		echo 'No price';
	}
}



?>