<?php include 'basic.php' ?>

<?php
if(!isset($_SESSION['username'])){
    header("location: login.php");
    
}
?>


<?php 

require_once "config.php";
if ($_SERVER['REQUEST_METHOD'] == "POST"){
$rating=$_POST['rating'];
$done_today=$_POST['work_done_today'];
$to_do=$_POST['to_do_next'];
$satisfy=$_POST['satisfy'];
$user=$_SESSION['username'];

$sql="INSERT INTO `daily_data` ( `Rating`, `done_today`, `to_do`, `satisfy`, `username`, `date`) VALUES ('$rating', '$done_today', '$to_do', '$satisfy', '$user', current_timestamp())";


$result= mysqli_query($conn,$sql);
if($result){
    header("refresh:5;url=index.php");
}
else{
    echo "sorry we cant able to do it";
}


}
?>


<div class="container mt-4">

   <form class="row g-2 mt-4 mb-4" action="" method="post">
   <div class="col-md-6">
     <label for="inputEmail4" class="form-label">Rate Yourself For Today out of 10</label>
     <input type="text" name="rating" class="form-control" id="inputEmail4">
   </div>
   <div class="col-md-12">
     <label for="inputPassword4" class="form-label">What work you done in whole day </label>
     <input type="text" name="work_done_today" class="form-control" id="inputPassword4">
   </div>
   <div class="col-12">
     <label for="inputAddress" class="form-label">To Do for next day </label>
     <input type="text" class="form-control" name="to_do_next" id="inputAddress" placeholder="to do for next day">
   </div>
   <div class="col-12">
     <label for="inputAddress2" class="form-label">Are satisfy what you done today</label>
     <input type="boolen" class="form-control" name="satisfy" id="inputAddress2" placeholder="Yes or No">
   </div>
  
  
   <div class="col-12">
     <div class="form-check">
       <input class="form-check-input" type="checkbox" id="gridCheck">
       <label class="form-check-label" for="gridCheck">
         Check me out
       </label>
     </div>
   </div>
   <div class="col-12">
     <button type="submit" class="btn btn-primary">Sign in</button>
   </div>
 </form>


</div>


