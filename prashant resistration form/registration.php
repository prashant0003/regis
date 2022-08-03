<?php
session_start();

?>
<!DOCTYPE html>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1">
<style>
body {
  font-family: Arial, Helvetica, sans-serif;
  
}

* {
  box-sizing: border-box;
}

.container {
  padding: 16px;
  background-color: white;
}


input[type=text], input[type=password] {
  width: 100%;
  padding: 15px;
  margin: 5px 0 22px 0;
  display: inline-block;
  border: none;
  background: #f1f1f1;
}
input[type=number], input[type=number ] {
  width: 100%;
  padding: 15px;
  margin: 5px 0 22px 0;
  display: inline-block;
  border: none;
  background: #f1f1f1;
}

input[type=text]:focus, input[type=password]:focus {
  background-color: #ddd;
  outline: none;
}

/* Overwrite default styles of hr */
hr {
  border: 1px solid #f1f1f1;
  margin-bottom: 25px;
}

/* Set a style for the submit button */
.registerbtn {
  background-color: #FA8072;
  color: white;
  padding: 16px 20px;
  margin: 8px 0;
  border: none;
  cursor: pointer;
  width: 100%;
  opacity: 0.9;
}

.registerbtn:hover {
  opacity: 1;
}

/* Add a blue text color to links */
a {
  color: dodgerblue;
}

/* Set a grey background color and center the text of the "sign in" section */
.signin {
  background-color: #f1f1f1;
  text-align: center;
}
</style>
</head>
<body>
  <?php
    include 'conn.php';

    if(isset($_POST['submit'])){
      $email=mysqli_real_escape_string($con,$_POST['email']);
      $number=mysqli_real_escape_string($con,$_POST['number']);
      $password=mysqli_real_escape_string($con,$_POST['password']);
      $cpassword=mysqli_real_escape_string($con,$_POST['cpassword']);

      $pass=password_hash($password, PASSWORD_BCRYPT);
      $cpass=password_hash($password, PASSWORD_BCRYPT);

      $emailquery= "SELECT * FROM signup WHERE email='$email' ";
      $query= mysqli_query($con,$emailquery);

      $emailcount= mysqli_num_rows($query);
      if($emailcount>0){
        echo "email alredy exists";
      }
      else{
        if($password === $cpassword){
          $insertquery= "INSERT INTO signup(email, mobile, password, cpassword) VALUES ('$email','$number','$pass','$cpass')";
          $iquery=mysqli_query($con,$insertquery);
          if($con){
          ?>
          <script>
            alert("connection successful");
          </script>
          <?php
        }
        else{
        ?>
          <script>
            alert("failed");
          </script>
          <?php
        }
        }
        else{
          echo "password are not matching, try again";
        }
      
      }
    }


  ?>

<form action="<?php  echo htmlentities($_SERVER['PHP_SELF']); ?>" method="post">
  <div class="container">
    <h1>Register</h1>
    <p>Please fill in this form to create an account.</p>
    <hr>

    <label for="email"><b>Email</b></label>
    <input type="text" placeholder="Enter Email" name="email" id="email" required>

    <label for="number"><b>Mobile No</b></label>
    <input type="number" placeholder="Enter Phone Number" name="number"  required>

    <label for="psw"><b>Password</b></label>
    <input type="password" placeholder="Enter Password" name="password" id="psw" required>

    <label for="psw-repeat"><b>Repeat Password</b></label>
    <input type="password" placeholder="Repeat Password" name="cpassword" id="psw-repeat" required>
    <hr>
    <p>By creating an account you agree to our <a href="#">Terms & Privacy</a>.</p>

    <button type="submit" name="submit" class="registerbtn">Register</button>
  </div>
  
  <div class="container signin">
    <p>Already have an account? <a href="#">Sign in</a>.</p>
  </div>
</form>

</body>
</html>
