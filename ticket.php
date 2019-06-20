<?php include "includes/db.php";

 $_SESSION['user_id'] = 3;
      $user_id = $_SESSION['user_id'];
      
       $query  = mysqli_query($connection, "SELECT users.username AS username, users.user_phoneno AS phone,routes.from AS fromu, routes.to AS destination, seats.seat_number AS seat_number, price.price AS price, price.bus_standard AS bus_class,orders.departure_time AS departure_time,orders.date AS day,bus.bus_name AS bus_name,bus.bus_number AS bus_number FROM  orders,users,bus,routes,seats,price  WHERE orders.user_id = users.user_id AND orders.bus_id = bus.bus_id AND orders.route_id = routes.id AND orders.seat_id = seats.id AND orders.cost_id = price.id AND  users.user_id = '$user_id' ");

       $result = mysqli_fetch_assoc($query);



if (isset($_POST["ticket"])) {
  
    require_once 'mpdf/vendor/autoload.php';

  $mpdf = new \Mpdf\Mpdf();

  $content  = '
       <h3>'.$result["bus_name"].' Bus Ticket</h3>

      <div class="col-md-6">
  <p>Passenger Name: <b>'.$result["username"].'</b></p>
  <p>Phone Number:<b> '.$result["phone"].'</p>
  <p>Travel From:<b> '.$result["fromu"].'</b></p>
  <p>Destination:<b> '.$result["destination"].'</b></p>
  <p>Departure Time:<b> '.date('h:i A', strtotime($result["departure_time"])).'</b></p>
  <p>Day:<b> '.date('F d, Y',strtotime($result["day"])).'</b></p>
<p>Seat Number:<b> '.$result["seat_number"].'</b></p>

</div>

<div class="col-md-6">
  
  <p>Bus Name:<b> '.$result["bus_name"].'</b></p>
  <p>Bus Number:<b> '.$result["bus_number"].'</b>
  <p>Bus Class:<b> '.$result["bus_class"].'</b>
   <p>Price:<b> Tsh '.number_format($result["price"]).'/=</b>
  
</div>

 <h3>Note:</h3> <span>This ticket will be valid only after completing mobile payment through the following number; 0789456789</span>

        

  ';

     $mpdf->AddPage();
     $mpdf->SetTitle($result["bus_name"]. 'BUS TICKET');
  $mpdf->WriteHTML($content);
  ob_end_clean();
  $mpdf->Output($result["username"]. ' BUS TICKET.pdf', "I");

}



 ?>
<?php include "includes/header.php"; ?>
    
    <!-- Navigation -->
    <?php include "includes/navigation.php"; ?>

    <!-- Page Content -->
    <!-- <div class="container jumbotron" style="width: 45%; border-radius: 15px"> -->

    <div class="container" style="width: 50%;">

        <h3>Bus Ticket</h3>
     <?php 

       $query  = mysqli_query($connection, "SELECT users.username AS username, users.user_phoneno AS phone,routes.from AS fromu, routes.to AS destination, seats.seat_number AS seat_number, price.price AS price, price.bus_standard AS bus_class,orders.departure_time AS departure_time,orders.date AS day,bus.bus_name AS bus_name,bus.bus_number AS bus_number FROM  orders,users,bus,routes,seats,price  WHERE orders.user_id = users.user_id AND orders.bus_id = bus.bus_id AND orders.route_id = routes.id AND orders.seat_id = seats.id AND orders.cost_id = price.id AND  users.user_id = '$user_id' ");
     
      $count = mysqli_num_rows($query);

      if ($count > 0) {
        

         while ($row = mysqli_fetch_assoc($query)) {
             
             echo '<div class="col-md-6">
  <p><label>Passenger Name:</label> '.$row["username"].'</p>
  <p><label>Phone Number:</label> '.$row["phone"].'</p>
  <p><label>Travel From:</label> '.$row["fromu"].'</p>
  <p><label>Destination:</label> '.$row["destination"].'</p>
  <p><label>Departure Time:</label> '.date('h:i A',strtotime($row["departure_time"])).'</p>
  <p><label>Day:</label> '.date('F d, Y',strtotime($row["day"])).'</p>
<p><label>Seat Number:</label> '.$row["seat_number"].'</p>

</div>

<div class="col-md-6">
  
  <p><label>Bus Name:</label> '.$row["bus_name"].'</p>
  <p><label>Bus Number:</label> '.$row["bus_number"].'</p>
  <p><label>Bus Class:</label> '.$row["bus_class"].'</p>
   <p><label>Price: Tsh </label> '.number_format($row["price"]).' /=</p>
  
</div>

 <h3>Note:</h3> <span>This ticket will be valid only after completing mobile payment through the following number; 0789456789</span>
<br />
<br />
 <form method="post" action="">
   <input type="submit" name="ticket" Value="Print Ticket" class="btn btn-danger">
 </form>
 ';

         }
      }else{

        echo 'Ticket Not Yet created';
      }



     ?>

<!-- 
<div class="col-md-6">
  <p>Passenger Name:</p>
  <p>Phone Number:</p>
  <p>Travel From:</p>
  <p>Destination:</p>
  <p>Departure Time:</p>
  <p>Day: </p>
<p>Seat Number:</p>

</div>

<div class="col-md-6">
  <p></p>
  <p>Price:</p>
  <p>Bus Class:</p>
  <p>Bus Name:</p>
  <p>Bus Number:</p>
  <p>Passenger Name:</p>


</div>
  -->





    </div>

    
<?php include "includes/footer.php"; 

//$query  = mysqli_query($connection, "SELECT users.username AS username, users.user_phoneno AS phone, routes.from AS fromu, routes.to AS to, seats.seat_number AS seat_number, price.price AS price, price.bus_standard AS bus_class, orders.departure_time AS departure_time, orders.date AS day, bus.bus_name AS bus_name, bus.bus_number AS bus_number FROM  orders, users, routes, seats, price, bus WHERE orders.user_id = users.user_id AND orders.bus_id = bus.bus_id AND orders.route_id = routes.id AND orders.seat_id = seats.id AND orders.cost_id = price.id AND orders.user_id = '$user_id' ");
      



 ?> 