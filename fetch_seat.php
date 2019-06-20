<?php
include 'includes/db.php';

if (isset($_POST["bus_id"])) {
	
	$bus_id = $_POST["bus_id"];

	
                                 
                                ?>
                         <h3>Select Seat</h3>
                         <div>
                             <b>Note: </b><span>Selected seat</span> <img 
    src="images/selected_seat_img.gif" 
    alt="I'm sad" /> |
                             <span>Booked seat</span><img 
    src="images/booked_seat_img.gif" 
    alt="I'm sad" /> |
                             <span>Available seat</span><img 
    src="images/available_seat_img.gif" 
    alt="available_seat_img" />
                         </div>
                         <br />
                         <div class="col-md-6">
                                <h6>Left Side</h6>

                                <?php 
                                    
                                     

                                       $query2 = mysqli_query($connection, "SELECT * FROM seats WHERE bus_id = '$bus_id' AND seat_number LIKE '%K%' OR seat_number LIKE '%M%' OR seat_number LIKE '%L%' OR seat_number LIKE '%N%' OR seat_number LIKE '%O%' OR seat_number LIKE '%P%' OR seat_number LIKE '%Q%' OR seat_number LIKE '%R' OR seat_number LIKE '%S%' OR seat_number LIKE '%T%' OR seat_number LIKE '%U%' OR seat_number LIKE '%V%' OR seat_number LIKE '%W%' OR seat_number LIKE '%X%' OR seat_number LIKE '%Y%' OR seat_number LIKE '%Z%'  LIMIT 20");
                               
                                  if ($query2 == TRUE) {
                                     
                                 while ($seat_row2 = mysqli_fetch_assoc($query2)) {
        

                                     if ($seat_row2["booked_seat"] == 'yes') {
                            
                        
                            ?>

                            
                             <span class="col-md-6">  <?php echo $seat_row2["seat_number"]; ?> <input type="radio"   class="input-hidden"  value="<?php echo $seat_row2["id"]; ?>" />
                                            <label for="booked_seat">
                                            <img 
                                              src="images/booked_seat_img.gif" 
                                              alt="booked_seat_img" />
                                              </label>
                                          
                                     </span>

                                 <?php }else{

                            ?>
                                   
                                   
                                  <span class="col-md-6">  <?php echo $seat_row2["seat_number"]; ?> <input type="radio" name="seat"  id="<?php echo $seat_row2["seat_number"]; ?>" class="input-hidden"  value="<?php echo $seat_row2["id"]; ?>" />

                                          <label for="<?php echo $seat_row2["seat_number"]; ?>">
                                            <img 
                                              src="images/available_seat_img.gif" 
                                              alt="available_seat_img" />
                                                </label>
                                     </span>
                              

                           <?php }}}?>


                        
                             </div>
                             <div class="col-md-6">
                                <h6>Right (Driver Side)</h6>

                                 <?php 

                                

                                    $query = mysqli_query($connection, "SELECT * FROM seats WHERE bus_id = '$bus_id'  LIMIT 20");
                               
                                  if ($query == TRUE) {

                                     
                                 while ($seat_row = mysqli_fetch_assoc($query)) {
        

                                     if ($seat_row["booked_seat"] == 'yes') {
                            
                        
                            ?>

                            
                             <span class="col-md-6">  <?php echo $seat_row["seat_number"]; ?> <input type="radio"   class="input-hidden"  value="<?php echo $seat_row["id"]; ?>" />
                                            <label for="booked_seat">
                                            <img 
                                              src="images/booked_seat_img.gif" 
                                              alt="booked_seat_img" />
                                              </label>
                                          
                                     </span>

                                 <?php }else{

                            ?>
                                   
                                   
                                  <span class="col-md-6">  <?php echo $seat_row["seat_number"]; ?> <input type="radio" name="seat"  id="<?php echo $seat_row["seat_number"]; ?>" class="input-hidden"  value="<?php echo $seat_row["id"]; ?>" />

                                          <label for="<?php echo $seat_row["seat_number"]; ?>">
                                            <img 
                                              src="images/available_seat_img.gif" 
                                              alt="available_seat_img" />
                                                </label>
                                     </span>
                              

                           <?php }}?>

                             </div>

                        
                                <?php 
                                  }
                           
                                 }

                  


                    
?>