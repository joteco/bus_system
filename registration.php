<?php include "includes/db.php"; ?>
<?php include "includes/header.php"; ?>
    
    <!-- Navigation -->
    <?php include "includes/navigation.php"; ?>

<?php

if (isset($_POST['register'])) {
//echo "registered";
    $username = $_POST['username'];
   
    $email = $_POST['email'];
    $phone_no = $_POST['phone_no'];
    $password = $_POST['password'];

   

if ($username=="" || $email=="" || $phone_no==""  || $password=="") {
  # code...
  echo "ALL FIELDS ARE MANDATORY";
}
elseif (strlen($phone_no)!=10) {
  # code...
  echo "PhoneNo Must Contain  10 digit";
}

else {

$query = "INSERT INTO users(username, user_password, user_email, user_phoneno, user_role) VALUES('$username', '$password',  '$email', '$phone_no', 'subscriber') ";

$register_user = mysqli_query($connection, $query);

if(!$register_user) {
    die("Query Failed" . mysqli_error($connection));
}

header("Location: index.php");

}

}

?>

    <!-- Page Content -->
    <!-- <div class="container jumbotron" style="width: 45%; border-radius: 15px"> -->

    <div class="container">
        <div class="row">
            <div class="col-lg-6">
                <img src="images/bus_regis.png" style="margin-top: 30%;">
            </div>
            <div class="col-lg-6">
                
              
              <h2 style="margin-left: 40%;">Sign Up to Book Ticket</h2>
              <form action="" method="post" enctype="multipart/form-data">
                
                <div class="form-group">
                  <label for="email">Username:</label>
                  <input type="text" class="form-control" id="email" placeholder="Enter Username" name="username">
                </div>

                <div class="form-group">
                  <label for="email">Email:</label>
                  <input type="email" class="form-control" id="email" placeholder="Enter email" name="email">
                </div>
                
                <div class="form-group">
                  <label for="pwd">Phone No:</label>
                  <input type="text" class="form-control" id="pwd" placeholder="Enter password" name="phone_no">
                </div>

                <div class="form-group">
                  <label for="pwd">Password:</label>
                  <input type="password" class="form-control" id="pwd" placeholder="Enter password" name="password">
                </div>
        
                <button type="submit" class="btn btn-primary" name="register" style="margin-left: 45%; margin-top: 20px;">Sign Up</button>
              </form>
            

            </div>
        </div>

    </div>
        <hr>

<?php include "includes/footer.php"; ?>