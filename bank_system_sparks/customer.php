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

<!DOCTYPE html >
    <html lang = "en" >

    <head >
    <meta charset = "UTF-8" >
    <meta http - equiv = "X-UA-Compatible" content = "IE=edge" >
    <meta name = "viewport" content = "width=device-width, initial-scale=1.0" >

    <!-- bootstrap4 -->
    <link rel = "stylesheet" href = "https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" >
    <script src = "https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js" > </script> 
    <script src = "https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js" > </script> 
    <script src = "https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js" > </script>


<!-- data table links -->
<link rel = "stylesheet" type = "text/css" href = "https://cdn.datatables.net/1.10.24/css/jquery.dataTables.css" >
    <script type = "text/javascript" charset = "utf8" src = "https://cdn.datatables.net/1.10.24/js/jquery.dataTables.js" > </script>
    <!-- data table script -->
    <script >
    $(document).ready(function() {
        $('#myTable').DataTable();
    }); 
    </script>


<style>
    * {
            margin: 0px;
            padding: 0px;
            box-sizing: border-box;
        }
</style>
<title > NGBH Bank | Customers </title>
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

<!-- fetching data from database -->
<?php
        $sql = "SELECT * FROM `customer`";
        $result = mysqli_query($conn,$sql);
        $s_no=0;
        if(!$result)
        {
            echo "Something went wrong";
        }
        else
        {
            echo '
              <div class="table-responsive py-5 container">
              <table id="myTable" class="table">
                  <thead>
                    <tr>
                      <th>S.No</th>
                      <th>Name</th>
                      <th>Email</th>
                      <th>Account Type</th>
                      <th>Select</th>
                    </tr>
                  </thead>
                  <tbody>';

              while($row = mysqli_fetch_assoc($result))
              {
                $s_no++;
                echo '
                    <tr>
                      <td>' .$s_no .'</td>
                      <td>' . $row["c_name"] . '</td>
                      <td>' . $row["c_email"] . '</td>
                      <td>' . $row["acc_type"] . '</td>
                      <td><a href="transection.php?senderId=' . $row["c_id"] . '" class="btn btn-warning">select</a></td>
                    </tr>';
              }
                  echo '
                </tbody>
              </table>
              </div>';
        }
    ?> 
</body>
<!-- my java script -->
<script src="script.js"></script>
</html>