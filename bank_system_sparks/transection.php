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

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

     <!-- bootstrap4 -->
     <link rel = "stylesheet" href = "https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" >
    <script src = "https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js" > </script> 
    <script src = "https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js" > </script> 
    <script src = "https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js" > </script>

    <style>
        * {
            margin: 0px;
            padding: 0px;
            box-sizing: border-box;
        }
    </style>

    <title>NGBH Bank | Transfer</title>
</head>
<body>
<nav class = "navbar navbar-expand-md bg-warning navbar-light" >
    <!-- Brand -->
    <a class = "navbar-brand" href = "#" > <strong > NGBH Bank </strong></a >

    <!-- Toggler/collapsibe Button -->
    <button class = "navbar-toggler" type = "button" data - toggle = "collapse" data - target = "#collapsibleNavbar" >
    <span class = "navbar-toggler-icon" > </span> </button>

<!-- Navbar links -->
<div class = "collapse navbar-collapse" id = "collapsibleNavbar" >
    <ul class = "navbar-nav ml-auto text-center" >
    <li class = "nav-item" >
    <a class = "nav-link btn btn-outline-secondary mx-1" href = "index.html" > Home </a> 
    </li> 
    <li class = "nav-item " >
    <a class = "nav-link btn btn-outline-secondary mx-1" href = "customer.php" > Customers </a>
     </li> 
     </ul>
      </div> 
      </nav>

      <div class="container my-5">
          <?php
                $s_id = $_GET['senderId'];
                $sql = "SELECT * FROM `customer` WHERE c_id = $s_id";
                $result = mysqli_query($conn,$sql);
                if(!$result)
                {
                    echo "something went wrong";
                }
                else
                {
                    $s_data = mysqli_fetch_assoc($result);
                    echo '<h2><strong>Hello,' . $s_data['c_name'] . '</strong></h2>';
                }
          ?>

            <div class="card">
                <div class="card-body">
                <form action="after_transection.php" method="POST">
                    <?php echo '<input type="hidden" name="s_id" value=" '. $s_id . '">
'; ?>
                    <div class="form-group">
                    <select name="r_id" class="form-control" required>
                    <option disabled selected>Select Customer to send money</option>
                    <?php
                       $sql = "SELECT `c_id`,`c_name` FROM `customer`";
                       $result = mysqli_query($conn,$sql);
                       if(!$result)
                       {
                           echo "something went wrong";
                       }
                       else
                       {
                           while($row = mysqli_fetch_assoc($result))
                           {
                               if($row['c_id'] != $s_id)
                               {
                                echo '<option value="' . $row["c_id"] . '">'.$row["c_name"].'</option>';
                               }
                           }
                       }
                    ?>
                </select>
                    </div>
                    <div class="form-group">
                    <input type="number" class="form-control" name="amt" id="amt" placeholder="Enter Amount (Rs)" required>
                    </div>
                    <div class="text-center">
                        <button type="submit" class="btn btn-warning" name="send">Transfer</button>
                    </div>
            </form>
                </div>
            </div>
      </div>
      
</body>
</html>