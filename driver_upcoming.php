<?php

session_start();

if(isset($_SESSION['emailid'])){
$server="localhost";
$username="root";
$password="";
$con=mysqli_connect($server,$username,$password);


$emailid=$_SESSION['emailid'];

$current_date=date("Y-m-d");
$upcoming_trip_id=array();
$upcoming_trip_occupied_seat=array();
$upcoming_trip_starting_point=array();
$upcoming_trip_date=array();
$upcoming_trip_starting_time=array();
$upcoming_trip_ending_point=array();
$upcoming_trip_vehicle_number=array();
$upcoming_trip_rider_name=array();
$upcoming_trip_rider_phoneno=array();
$upcoming_trip_pickup_point=array();
$upcoming_trip_fare=array();

$upcoming_trip_num=0;

$sql_query=("SELECT `t`.`trip_id`,`t`.`trip_date`,`t`.`starting_time`,`t`.`starting_point`,`t`.`ending_point` 
FROM `ride`.`trip_info` `t`,`ride`.`driver_trip` `d` WHERE `d`.`driver_emailid`='$emailid' AND `t`.`trip_id`=`d`.`trip_id` AND `t`.`trip_date`>='$current_date';");
$sql_result=mysqli_query($con,$sql_query);
$num=mysqli_num_rows($sql_result);

while($row=mysqli_fetch_assoc($sql_result)){
  $upcoming_trip_id[$upcoming_trip_num]=$row['trip_id'];
  $upcoming_trip_date[$upcoming_trip_num]=$row['trip_date'];
  $upcoming_trip_starting_time[$upcoming_trip_num]=$row['starting_time'];
  $upcoming_trip_starting_time[$upcoming_trip_num]=date('h:i A',strtotime($upcoming_trip_starting_time[$upcoming_trip_num]));
  $upcoming_trip_starting_point[$upcoming_trip_num]=$row['starting_point'];
  $upcoming_trip_ending_point[$upcoming_trip_num]=$row['ending_point'];

 // echo $upcoming_trip_id[$upcoming_trip_num] . $upcoming_trip_date[$upcoming_trip_num];
  $upcoming_trip_num++;
}
for($i=0;$i<$num;$i++){
    $sql_query=("SELECT  `r`.`name`,`r`.`phoneno`,`t`.`seats` ,`t`.`pickup_point`, `t`.`fare` FROM `ride`.`rider_table` `r` ,`ride`.`rider_trip` `t`
    WHERE `t`.`trip_id`='$upcoming_trip_id[$i]' AND `r`.`emailid`=`t`.`rider_emailid` ;");
     $sql_result=mysqli_query($con,$sql_query);
     $rider_num=0;
     $upcoming_trip_rider_name[$upcoming_trip_id[$i]]=array();
     $upcoming_trip_rider_phoneno[$upcoming_trip_id[$i]]=array();
     $upcoming_trip_occupied_seat[$upcoming_trip_id[$i]]=array();
     $upcoming_trip_pickup_point[$upcoming_trip_id[$i]]=array();
     $upcoming_trip_fare[$upcoming_trip_id[$i]]=array();
    while($row=mysqli_fetch_assoc($sql_result)){
     
     $upcoming_trip_rider_name[$upcoming_trip_id[$i]][$rider_num]=$row['name'];
     $upcoming_trip_rider_phoneno[$upcoming_trip_id[$i]][$rider_num]=$row['phoneno'];
     $upcoming_trip_occupied_seat[$upcoming_trip_id[$i]][$rider_num]=$row['seats'];
     $upcoming_trip_pickup_point[$upcoming_trip_id[$i]][$rider_num]=$row['pickup_point'];
     $upcoming_trip_fare[$upcoming_trip_id[$i]][$rider_num]=$row['fare'];
     $rider_num++;
    }
    }
  }else{
    echo "<script>
    alert('You are not Logged In.Log In First');
    window.location.href='driver_rider.html'; 
    </script>";
  }
    
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Driver Trip Info</title>
    <style>

      body{
      background-color: #004c66;
      }
    @Keyframes spin{
  	100%{
		transform: rotate(360deg);
	  }
    }
.inside_container{
	width: 40px;
	margin: 250px auto 70px;
}
.dot{
	width: 10px;
	height: 10px;	
	display: inline-block;
	border-radius: 50%;
	
}
.dot1{
	background-color: #1abc9c;
	animation: jump-up 0.6s 0.1s linear infinite;
}
.dot2{
	background-color: #ffd64a;
	animation: jump-up 0.6s 0.2s linear infinite;
}
.dot3{
	background-color: #e067af;
	animation: jump-up 0.6s 0.3s linear infinite;
}
@Keyframes jump-up{
	50%{
		transform: translate(0,15px);
	}
}

h3{
    margin-top: 0px;
    font-size: 3rem;
    font-weight: 600;
    margin-left: 30%;
}

@media(max-width: 900px){
 h3{
     font-size: 2rem;
 }
}
    </style>
    
</head>
<body>
<div class="container">
    <div class="inside_container">
      <div class="dot dot1"></div>
			<div class="dot dot2"></div>
			<div class="dot dot3"></div>
      </div>
        <h3>Please Wait.Collecting Data</h3>
  </div>

  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.min.js" charset="utf-8"></script>      
    <script type = "text/javascript" src = "https://code.jquery.com/jquery-3.3.1.min.js"></script> 

  <script>
   const d_upcoming_trip_seat=<?php echo json_encode($upcoming_trip_occupied_seat); ?>;
   const d_upcoming_trip_fare=<?php echo json_encode($upcoming_trip_fare); ?>;
   const d_upcoming_trip_id=<?php echo json_encode($upcoming_trip_id); ?>;
   const d_upcoming_trip_s_point=<?php echo json_encode($upcoming_trip_starting_point); ?>;
   const d_upcoming_trip_date=<?php echo json_encode($upcoming_trip_date); ?>;
   const d_upcoming_trip_time=<?php echo json_encode($upcoming_trip_starting_time); ?>;
   const d_upcoming_trip_e_point=<?php echo json_encode($upcoming_trip_ending_point); ?>;
   const d_upcoming_trip_p_point=<?php echo json_encode($upcoming_trip_pickup_point); ?>;
   const d_upcoming_trip_r_name=<?php echo json_encode($upcoming_trip_rider_name); ?>;
   const d_upcoming_trip_r_phn=<?php echo json_encode($upcoming_trip_rider_phoneno); ?>;
   const d_trip_num = <?php echo $num; ?>;

   $(document).ready(function () {
    window.setTimeout(function () {
        localStorage.setItem("d_uc_trip_id",JSON.stringify(d_upcoming_trip_id));
        localStorage.setItem("d_uc_seat",JSON.stringify(d_upcoming_trip_seat));
        localStorage.setItem("d_uc_fare",JSON.stringify(d_upcoming_trip_fare));
        localStorage.setItem("d_uc_p_point",JSON.stringify(d_upcoming_trip_p_point));
        localStorage.setItem("d_uc_date",JSON.stringify(d_upcoming_trip_date));
        localStorage.setItem("d_uc_time",JSON.stringify(d_upcoming_trip_time));
        localStorage.setItem("d_uc_e_point",JSON.stringify(d_upcoming_trip_e_point));
        localStorage.setItem("d_uc_s_point",JSON.stringify(d_upcoming_trip_s_point));
        localStorage.setItem("d_uc_r_name",JSON.stringify(d_upcoming_trip_r_name));
        localStorage.setItem("d_uc_r_phn",JSON.stringify(d_upcoming_trip_r_phn));
        localStorage.setItem("d_uc_t_num",JSON.stringify(d_trip_num));
        location.href = "driver_trip_info.html";
        
    }, 5000);
});
    </script>

</body>
</html>