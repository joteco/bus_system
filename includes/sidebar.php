           <script>
               
                function fetchPrice(val){
                   
                 $.ajax({
                    url:"fetch_price.php",
                    method:"POST",
                    data:"bus_id="+val,

                    success:function(data){
                       
                      $('#price').html(data);
                    }
                 });
               } 


               function fetchSeat(val){

                  $.ajax({
                      
                      url:"fetch_seat.php",
                      method:"POST",
                      data:"bus_id="+val,
                      beforeSend:function(){
                         $('#book').html('<span class="glyphicon glyphicon-transfer"></span> &nbsp; processing ...');
                      },
                      success:function(data){
                        

                        $('#seat').html(data);
                      }
                  });
               }
               
              
           </script>

            <div class="col-md-4">

                <!-- Blog Search Well -->
                <div class="well">
                    <h4>Book Ticket</h4>
                    <form  method="post"  id="bookForm">

                            <label>From</label>
                            <select class="form-control" name="from">
                                 <?php 

                                 include 'db.php';

                                 //$query = mysqli_query($connection, "SELECT routes.id AS routeID, routes.from AS fromRoute, routes.to AS to FROM routes,bus_schedule WHERE routes.id = bus_schedule.route_id ");

                                 $query = mysqli_query($connection, "SELECT * FROM routes ");

                                 while ($row = mysqli_fetch_assoc($query)) {
                                     
                        
                            ?>
                                <option value="<?php echo $row["id"]; ?>">From -  <?php echo $row["from"]; ?> - To -   <?php echo $row["to"]; ?></option>
                                
                            <?php }?>
                            </select>
                        

                        <br />
                           <label>Date</label>
                            <input type="date" style="margin-top: 10px;" name="date" class="form-control" id="date" placeholder="dd/mm/yyyy" >

                         <br />
                        <!--  <label>Time</label>
                         <select name="time_id" class="form-control" onchange="checkTime(this.value);">

                             <option>Choose Departure Time</option>
                            <?php
/*
                                 $query = mysqli_query($connection, "SELECT departure_time.id AS departure_id, departure_time.time AS departureTime FROM departure_time,bus_schedule WHERE departure_time.id = bus_schedule.departure_time_id AND bus_schedule.seat_status != 'full'");

                                 while ($time_row = mysqli_fetch_assoc($query)) { 
*/
                             ?>
                                <option value="<?php //echo $time_row["departure_id"]; ?>"><?php //echo date('h:i A ',strtotime($time_row["departureTime"])); ?></option>
                                
                            <?php //}?>

                         </select>
                         <br />
                         <br /> -->
                         <br />
                        
                         <div id="bus">
                           <label>Bus And Departure Time</label>
                         <select name="bus_id" class="form-control" onchange="fetchSeat(this.value);" onclick="fetchPrice(this.value);" >
                            <option>Choose Bus</option>
                                   
                               <?php 

                                 
                                  $query = mysqli_query($connection, "SELECT bus.bus_name AS bus_name,bus.bus_id AS bus_id, bus.bus_standard AS bus_standard, departure_time.time AS departureTime FROM bus_schedule,bus,departure_time WHERE  bus_schedule.bus_id = bus.bus_id AND departure_time.id = bus_schedule.departure_time_id AND bus_schedule.seat_status != 'full'");

                                 while ($bus_row = mysqli_fetch_assoc($query)) {
                                     
                        
                            ?>
                                <option value="<?php echo $bus_row["bus_id"]; ?>" ><?php echo $bus_row["bus_name"]; ?>  -   <?php echo $bus_row["bus_standard"]; ?> - AT - <?php echo date('h:i A ',strtotime($bus_row["departureTime"])); ?></option>
                                
                            <?php }?> 
                            </select>
                            </div>
                          <br />
                          <br />
                         
                           <div id="price"></div>
                          <br />
                         
                          <div id="seat"></div>

                            <input type="hidden" name="user_id" value="3">
                            <input type="hidden" name="time" value="<?php echo  $bus_row["departureTime"];  ?>">
                 <!-- <input type="hidden" name="price" value="<?php //echo $price_row["price"]; ?>"> -->



                            <input type="submit" class="btn btn-primary" name="submit" style="margin-left: 130px; margin-top: 10px;" value="Book" id="book">
                        
                    </form>
                    <!-- /.input-group -->
                </div>


                <!-- Login -->
                <?php

                    if (!isset($_SESSION['s_username'])) {
                        ?>
                            <div class="well">
                                <h4>Login</h4>
                                <form action="includes/login.php" method="post">

                                    
                                        <input name="username" type="text" class="form-control" placeholder="Username">
                                        <input name="password" type="password" class="form-control" placeholder="Password" style="margin-top: 10px;">

                                        <input type="submit" class="btn btn-primary" name="login" style="margin-left: 130px; margin-top: 10px;" value="Login">
                                    
                                </form>
                                <!-- /.input-group -->
                            </div>
                        
                <?php } ?>

            


               
            </div>


<script>
    $(document).ready(function(){
        
         $('#bookForm').on('submit', function(event){
                   event.preventDefault();

                   $.ajax({
                     url:"submit.php",
                     method: "POST",
                     dataType: 'html',
                     data:$(this).serialize(),
                     success:function(data){

                      alert(data);
                      
                    window.location.href = "ticket.php";
                    
                     }

                   });
                       
               });


});
</script>

            

 <!--  <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#seat">Select Seat</button>
 -->

 <!--popup modal to show host_supervisor_signature  -->
<div class="modal fade" tabindex="-1" id="seat" role="dialog">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="gridSystemModalLabel">Select Aboud Bus  seat</h4>
        <br >
       <span><b>Note:</b></span> <button class="btn btn-default btn-sm">Free Seat</button>
        <button class="btn btn-success btn-sm">Booked Seat</button>
      </div>
      <div class="modal-body">
    

                             <div class="col-md-6">
                               <input type="button" name="c1" value="c1" class="btn btn-default" id="mySeat">
                               <input type="button" name="c2" value="c2" class="btn btn-default" id="mySeat"> 
                               <br />
                               <br />
                               <input type="button" name="d1" value="D1" class="btn btn-default" id="mySeat">
                               <input type="button" name="d2" value="D2" class="btn btn-default" id="mySeat">  
                             </div>
                             <div class="col-md-6">
                                <input type="button" name="a1" value="A1" class="btn btn-default" id="mySeat">
                               <input type="button" name="a2" value="A2" class="btn btn-default" id="mySeat"> 
                               <br />
                               <br />
                               <input type="button" name="b1" value="B1" class="btn btn-default" id="mySeat">
                               <input type="button" name="b2" value="B2" class="btn btn-default" id="mySeat"> 
                                 
                             </div>
                         </div>


      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
       <input type="submit" id="" class="btn btn-primary" name="add" value="Add Seat">
      </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->

