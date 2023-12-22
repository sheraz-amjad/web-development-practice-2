<?php
$success=0;
$user=0;
if($_SERVER['REQUEST_METHOD']=='POST'){
   include 'connect.php'; 
   $username=$_POST['username'];
   $password=$_POST['password'];

   // NOW WE INSERT DATA
  /* $sql="insert into registration (username,password)
   values('$username','password')";
   //FOR EXECUTION OF ABOVE QUERY
   $result=mysqli_query($con,$sql);
   if($result){
    echo "Data Inserted Successfully";
   }
   else{
    die(mysqli_error($con));*/
   
   $sql="Select * from registration where username ='$username'";
   $result=mysqli_query($con,$sql);
   if($result){
    $num=mysqli_num_rows($result);//count the no of rows in database
    if($num>0){
       // echo "User Already Exist";
       $user=1;
    }else{
        $sql="insert into registration (username,password)
   values('$username','password')";
   $result=mysqli_query($con,$sql);
   if($result){
    //echo "Signup Successfull";
    $success=1;
    header('location:login.php');
   }
   else{
    die(mysqli_error($con));
    }
    }
   }
}
 /* AFTER WRITING ABOVE CODE WHEN YOU CLICKED ON SUBMIT BUTTON
 IT SHOWS YOU THE MESSAGE CONNECTION SUCCESFUL IF IT IS CONNECTED */

?>





<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Signup page</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <link rel="stylesheet" href="styles.css">
  </head>
  <body>
<?php
if($user){
    echo'<div class="alert alert-danger alert-dismissible fade show" role="alert">
    <strong>Sorry </strong> User Already Exist
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
      <span aria-hidden="true">&times;</span>
    </button>
  </div>';
}

?>

<?php
if($success){
    echo'<div class="alert alert-succes alert-dismissible fade show" role="alert">
    <strong>Success </strong> You are Successfully Signed Up
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
      <span aria-hidden="true">&times;</span>
    </button>
  </div>';
}

?>


   <h1 class="text-center"> Signup Page </h1>
  <div class="container mt-5"> 
  <form action="sign.php" method="post">

    <div class="form-group">
    <label>Name</label>
    <input type="text" class="form-control"  
    placeholder="Enter your username" name="username" autocomplete="off">
  </div>
<div>
  <p>hello</p>
</div>
  <div class="form-group">
    <label>Password</label>
    <input type="text" class="form-control"  
    placeholder="Enter your password" name="password" autocomplete="off">
  </div>


  <button type="submit"
   class="btn btn-primary w-100" name="submit">Sign up</button>
</form>




</div>
</body>
</html>
