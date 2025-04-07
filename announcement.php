<?php 
session_start();
require "session_check.php";
is_admin();
?>
<!DOCTYPE html>
<html>
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <title>Announcement Page</title>

    <!--CSS-->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css">

    <style type="text/css">
        table{width: 100%; position: relative; border-collapse: collapse;}
        #system tr{ 
          background-color: #000000;
          font-size: 18px;
          color: #FFFFFF;
        }
    </style>

</head>
<body style="background-color: #FFFDF2;">
    <table id="system">
        <tr style="height: 38px;">
            <td><img><a href="admin_homepage.php" class="navbar-brand" style="color: #FFFFFF" >&nbsp;&nbsp;Home Page</a></td>
            <td>
                <a href="logout.php"><img src="img/off_icon.png" style="width: 20px; height: 20px; float: right; margin-right: 15px;">
                <a href="announcement.php"><img src="https://icons-for-free.com/iconfiles/png/512/advertising-131964752294140847.png" style="width: 20px; height: 20px; float: right; margin-right: 10px;"></a>
            </td>
        </tr>
    </table>


    <!-------- Page Content --------------->    

    <div class="container mx-auto mt-5 w-50">
	<div class="card login-form">
	<div class="card-body">
		<div class="col-md-12">
            <h4>ANNOUNCEMENT</h4>
            <hr>
        </div>
    <div class="card-text row">
            <form id="form" name="form" action="" method="POST" class="was-validated col-md-12">
                <div class="form-group mt-1">
                    <label for="anc_title">Title</label><br>
                    <input type="text" name="anc_title" required><br><br>
                    <label for="anc_text"></label>Announcement Details<br>
                    <textarea id="anc_text" name="anc_text" rows="4" cols="50" required></textarea>
                </div>
                <input type="submit" id="submit" name="submit" class="btn btn-primary mt-2" value="Add" onclick="return submitForm()">
                <a class="btn btn-secondary" href="admin_homepage.php" role="button" style=" margin-top: 8px;">Cancel</a>
                <br/>

             </form>

        </div>
                
    </div>
    </div>
    </div>
    <!--JS-->
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>

<?php
			if (isset($_POST['submit'])){
				$anc_title = $_POST['anc_title'];
				$anc_text = $_POST['anc_text'];
                $admin_id = $_SESSION['user'];
				
				$conn = mysqli_connect("127.0.0.1", "root", "", "sinamum") or die (mysql_error ());

				// SQL query
				$sql = "UPDATE announcement SET anc_title = '$anc_title', anc_text = '$anc_text', admin_id ='$admin_id' WHERE anc_id = 1";
				// Execute the query (the recordset $rs contains the result)
				if (mysqli_query($conn, $sql)) {
					echo '<script>alert("New announcment updated successfully.")</script>';
					echo '<script>window.location="admin_homepage.php"</script>';
				} else {
					echo "Error: " . $sql . "<br>" . mysqli_error($conn);
				}
					mysqli_close($conn);
							}
?>
</body>
</html>