<?php
session_start();

?>
<!DOCTYPE html>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1">
<style>
body {font-family: Arial, Helvetica, sans-serif;}

input[type=text], input[type=password] {
  width: 100%;
  padding: 12px 20px;
  margin: 8px 0;
  display: inline-block;
  border: 1px solid #ccc;
  box-sizing: border-box;
}

button {
  background-color: #04AA6D;
  color: white;
  padding: 14px 20px;
  margin: 8px 0;
  border: none;
  cursor: pointer;
  width: 100%;
}

button:hover {
  opacity: 0.8;
}

/* Extra styles for the cancel button */
.cancelbtn {
  width: auto;
  padding: 10px 18px;
  background-color: #f44336;
}

/* Center the image and position the close button */
.imgcontainer {
  text-align: center;
  margin: 24px 0 12px 0;
  position: relative;
}

img.avatar {
  width: 40%;
  border-radius: 50%;
}

.container {
  padding: 16px;
}

span.psw {
  float: right;
  padding-top: 16px;
}

.modal-content {
  background-color: #fefefe;
  margin: 5% auto 15% auto; /* 5% from the top, 15% from the bottom and centered */
  border: 1px solid #888;
  width: 80%; /* Could be more or less, depending on screen size */
}
  
  
@keyframes animatezoom {
  from {transform: scale(0)} 
  to {transform: scale(1)}
}

/* Change styles for span and cancel button on extra small screens */
@media screen and (max-width: 300px) {
  span.psw {
     display: block;
     float: none;
  }
  
}
</style>
</head>
<body>
<?php
 include 'conn.php';
 if(isset($_POST['submit'])){
  $email=$_POST['email'];
  $password=$_POST['password'];
  
  $email_search = "SELECT * FROM signup WHERE email='$email' ";
  $query=mysqli_query($con,$email_search);

  $emailcount= mysqli_num_rows($query);
  if($emailcount){
    $email_pass=mysqli_fetch_assoc($query);
    $db_pass= $email['password'];

    $pass_decode= password_verify($password,$db_pass);
    if($pass_decode){
      echo "login successfull";
      
    }
    else{
      echo "password incorrect";
    }
  }
  else{
      echo "Invalid Email";
    }
 }

?>

<div id="id01" class="modal">
  
  <form class="modal-content animate" action="<?php echo htmlentities($_SERVER['PHP_SELF']); ?>" method="post">
    <div class="imgcontainer">
      
      <img src="https://www.w3schools.com/howto/img_avatar.png" height="200" width="100" alt="Avatar" class="avatar">
    </div>

    <div class="container">
     <label for="email"><b>Email</b></label>
     <input type="text" placeholder="Enter Email" name="email" id="email" required>

      <label for="psw"><b>Password</b></label>
      <input type="password" placeholder="Enter Password" name="password" required>
        
      <button type="submit" name="submit">Login</button>
      <label>
        <input type="checkbox" checked="checked" name="remember"> Remember me
      </label>
    </div>

    <div class="container" style="background-color:#f1f1f1">
      <button type="button" name="button" class="cancelbtn">Cancel</button>
      <span class="psw">Forgot <a href="#">password?</a></span>
    </div>
  </form>
</div>



</body>
</html>
