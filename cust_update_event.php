<?php
session_start();
require_once "config.php";
require "session_check.php";
is_customer();

if($_SERVER["REQUEST_METHOD"] == "GET"){
  if (isset($_GET['date'])) {
    $date = $_GET['date'];
  }
}

if($_SERVER["REQUEST_METHOD"] == "GET"){
  if (isset($_GET['id'])) {
    $id = $_GET['id'];
  }
}
$cust_id = $_SESSION["user"];
try{
  // Prepare statement
  $stmt = mysqli_prepare($mysqli, "SELECT id, name, phone, start, end, resource_id, total_payment, deposit_payment FROM events WHERE cust_id = ? AND id  = ?");

  //Bind statement
  mysqli_stmt_bind_param($stmt, "si", $cust_id, $id);

  //Executing statement
  mysqli_stmt_execute($stmt);

  // Get result from previous execuuted statemnet
  $result = mysqli_stmt_get_result($stmt);

    //Check if row = 0, exit. Else, success
    if(mysqli_stmt_affected_rows($stmt) == 0 || mysqli_stmt_affected_rows($stmt) > 1 || mysqli_stmt_affected_rows($stmt) < 0){
        mysqli_stmt_affected_rows($stmt);
    } else{
    //Fetch row from $result
        $row = mysqli_fetch_array($result);
        $resource_id = $row['resource_id'];
        $id = $row['id'];
    }
    //Closing statement
    mysqli_stmt_close($stmt);

    //Closing connection
    mysqli_close($mysqli);

    } catch (Exception $e) {echo 'Caught exception: '.  getMessage($e);} //catch exception
?>
<!DOCTYPE html>
<html>

<head>
    <!-- Required meta tags -->
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Update Reservation</title>

    <style type="text/css">
        body {
            /* The image used */
            background-image: url("https://wallpaperaccess.com/full/1919414.jpg");

            /* Full height */
            height: 100%;

            /* Center and scale the image nicely */
            background-position: center;
            background-repeat: no-repeat;
            background-size: cover;

        }

        table {
            width: 100%;
        }

        table.form {
            position: relative;
        }

        #system tr {
            background-color: #000000;
            font-family: "Georgia", serif;
            color: #FFFFFF;
        }

        #customers tr {
            border: 1px solid #ddd;
            padding: 10px;
        }

        #formContent {
            -webkit-border-radius: 10px 10px 10px 10px;
            border-radius: 10px 10px 10px 10px;
            background: #fff;
            padding: 30px;
            width: 90%;
            max-width: 450px;
            position: relative;
            padding: 0px;
            -webkit-box-shadow: 0 30px 60px 0 rgba(0, 0, 0, 0.3);
            box-shadow: 0 30px 60px 0 rgba(0, 0, 0, 0.3);
            text-align: center;
            display:block;
        }

        #formFooter {
            background-color: #f6f6f6;
            border-top: 1px solid #dce8f1;
            padding: 25px;
            text-align: center;
            -webkit-border-radius: 0 0 10px 10px;
            border-radius: 0 0 10px 10px;
        }

        /* FORM TYPOGRAPHY*/

        input[type=button].delete{
            background-color: #ed5656;
            -webkit-box-shadow: 0 10px 30px 0 rgba(237, 86, 86, 0.4);
            box-shadow: 0 10px 30px 0 rgba(237, 86, 86, 0.4);
        }

        input[type=button].cancel{
            background-color: #9e9e9e;
            -webkit-box-shadow: 0 10px 30px 0 rgba(158, 158, 158, 0.4);
            box-shadow: 0 10px 30px 0 rgba(158, 158, 158, 0.4);
        }
        
        input[type=submit],input[type=button] {
            background-color: #56baed;
            border: none;
            color: white;
            padding: 15px 30px;
            text-align: center;
            text-decoration: none;
            display: inline-block;
            text-transform: uppercase;
            font-size: 13px;
            -webkit-box-shadow: 0 10px 30px 0 rgba(95, 186, 233, 0.4);
            box-shadow: 0 10px 30px 0 rgba(95, 186, 233, 0.4);
            -webkit-border-radius: 5px 5px 5px 5px;
            border-radius: 5px 5px 5px 5px;
            margin: 5px 20px 40px 20px;
            -webkit-transition: all 0.3s ease-in-out;
            -moz-transition: all 0.3s ease-in-out;
            -ms-transition: all 0.3s ease-in-out;
            -o-transition: all 0.3s ease-in-out;
            transition: all 0.3s ease-in-out;
        }

        input[type=button].delete:hover{
            background-color:red;
        }

        input[type=button].cancel:hover{
            background-color:#828282;
        }

        input[type=submit]:hover, input[type=button] {
            background-color: #39ace7;
            cursor: pointer;
        }

        input[type=button]:active,
        input[type=submit]:active,
        input[type=reset]:active {
            -moz-transform: scale(0.95);
            -webkit-transform: scale(0.95);
            -o-transform: scale(0.95);
            -ms-transform: scale(0.95);
            transform: scale(0.95);
        }

        input[type=email],
        input[type=password],
        input[type=text],
        select {
            background-color: #f6f6f6;
            border: none;
            color: #0d0d0d;
            padding: 15px 32px;
            text-align: center;
            text-decoration: none;
            display: inline-block;
            font-size: 16px;
            margin: 5px;
            width: 85%;
            border: 2px solid #f6f6f6;
            -webkit-transition: all 0.5s ease-in-out;
            -moz-transition: all 0.5s ease-in-out;
            -ms-transition: all 0.5s ease-in-out;
            -o-transition: all 0.5s ease-in-out;
            transition: all 0.5s ease-in-out;
            -webkit-border-radius: 5px 5px 5px 5px;
            border-radius: 5px 5px 5px 5px;
        }

        button[type=button] {
            font-family: "Georgia", serif;
            background-color: #000000;
            border: none;
            color: white;
            padding: 15px 80px;
            text-align: center;
            text-decoration: none;
            display: inline-block;
            text-transform: uppercase;
            font-size: 13px;
        }

        #system_text:hover {
            cursor: pointer;
        }
    </style>
    <!--CSS-->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css"
        integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css">

    <link rel="stylesheet" type="text/css" href="css/jquery.datetimepicker.min.css" />
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
    <script src="js/jquery.datetimepicker.full.min.js"></script>
</head>

<body>
    <table id="form">
        <tr>
            <td>
                <center>
                    <div id="formContent">
                        <br>
                        <h4 style='font-family: "Georgia", serif;'>Update Reservation</h4><br>
                        <form id="form" action="back_cust_update.php" method="post">
                            <label>Booking ID</label><br>
                            <input type="text" id="id" name="id" aria-describedby="idHelp"
                                value="<?php echo $id ?>" readonly required><br>
                            <label for="name">Name</label><br>
                            <input type="text" id="name" name="name" value="<?php echo $row['name'] ?>" required><br>
                            <label for="phone">Phone</label><br>
                            <input type="text" id="phone" name="phone" value="<?php echo $row['phone'] ?>" required><br>
                            <label for="phone">Start</label><br>
                            <input type="text" id="start" name="start" value="<?php echo $row['start'] ?>" readonly
                                required /><br>
                            <label for="phone">End</label><br>
                            <input type="text" id="end" name="end" value="<?php echo $row['end'] ?>" readonly
                                required /><br>
                            <label for="name">Court</label><br>
                            <select name="resource_id" id="resource_id">
                                <option value="1" <?php if($resource_id==1) echo "selected" ; ?>>Court 1</option>
                                <option value="2" <?php if($resource_id==2) echo "selected" ; ?>>Court 2</option>
                            </select><br><br>
                            <div style="display:inline-block">
                            <input type="button" value="Cancel" class="cancel" onclick="window.location='cust_homepage.php'">
                            <input type="submit" value="Update">
                            </div><br>
                            <input type="button" class="delete" value="Delete" onclick="window.location='back_cust_delete.php?id=<?php echo $id?>'">
                        </form>
                    </div>
                </center>
            </td>
        </tr>
    </table>

    <script>
        $('#start').datetimepicker({
            format:'Y-m-d H:i:s',
            scrollMonth: false,
            inverseButton: false,
            minTime: '08:00:00',
            maxTime: '20:00:00',
        });

        $('#end').datetimepicker({
            format:'Y-m-d H:i:s',
            scrollMonth: false,
            inverseButton: false,
            minTime: '09:00:00',
            maxTime: '21:00:00',
        });
    </script>


</body>

</html>