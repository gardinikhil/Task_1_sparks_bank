<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel = "stylesheet" href = "https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" >
    <script src = "https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js" > </script> 
    <script src = "https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js" > </script> 
    <script src = "https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js" > </script>


    <title>Transection Completed</title>
</head>
<body>
    

<?php
    $server = "localhost";
    $user = "root";
    $pass = "";
    $db = "Basic_bank_system";

    $conn = mysqli_connect($server,$user,$pass,$db);
    if(!$conn)
    {
        echo "Connection failed";
    }
?>

<?php
if(isset($_POST['send']))
{
    $s_user_id = $_POST['s_id'];
    $r_user_id = $_POST['r_id'];
    $amt = $_POST['amt'];
    $sql = "SELECT * FROM `customer` WHERE c_id = $r_user_id";
    $r_result = mysqli_query($conn,$sql);
    $sql = "SELECT * FROM `customer` WHERE c_id = $s_user_id";
    $s_result = mysqli_query($conn,$sql);
    if(!($r_result and $s_result))
    {
        echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
        <strong>Failed!</strong> Something went wrong
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>';
    }
    else
    {
        $s_data = mysqli_fetch_assoc($s_result);
        $r_data = mysqli_fetch_assoc($r_result);
        if($amt > $s_data['curr_bal'])
        {
            echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
        <strong>Failed!</strong> amount exceeds !!! Go and Check your balence !!
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>';
        }
        else
        {
            $s_after_bal = $s_data['curr_bal'] - $amt;
            $r_after_bal = $r_data['curr_bal'] + $amt;


            $sql = "UPDATE `customer` SET `curr_bal` = '$r_after_bal' WHERE `c_id` = $r_user_id";
            $r_result = mysqli_query($conn,$sql);


            $sql = "UPDATE `customer` SET `curr_bal` = '$s_after_bal' WHERE `c_id` = $s_user_id";
            $s_result = mysqli_query($conn,$sql);
            if($r_result and $s_result)
            {
                
                $sql = "INSERT INTO `transfer` (`s_id`, `r_id`, `amt`, `date`) VALUES ('$s_user_id', '$r_user_id', '$amt', current_timestamp())";
                $result = mysqli_query($conn,$sql);
                echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
        <strong>Success!</strong> Amount transfer successfully....
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>';
            }
            else
            {
                echo "Something went wrong";
            }
        }
    }
}
else
{
    echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
        <strong>Failed!</strong> Something went wrong
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>';
}
?>
<div class="text-center">
<a href="index.html" class="btn btn-warning">Home</a>
</div>
</body>
</html>
