<!DOCTYPE html>
<html>
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    
    <title>Register</title>
    
    <!--CSS-->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css">

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

            table{width: 100%;}
            table.form{ position: relative;}
            #system tr{ 
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
                -webkit-box-shadow: 0 30px 60px 0 rgba(0,0,0,0.3);
                box-shadow: 0 30px 60px 0 rgba(0,0,0,0.3);
                text-align: center;
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

            input[type=button], input[type=submit], input[type=reset]  {
                background-color: #56baed;
                border: none;
                color: white;
                padding: 15px 80px;
                text-align: center;
                text-decoration: none;
                display: inline-block;
                text-transform: uppercase;
                font-size: 13px;
                -webkit-box-shadow: 0 10px 30px 0 rgba(95,186,233,0.4);
                box-shadow: 0 10px 30px 0 rgba(95,186,233,0.4);
                -webkit-border-radius: 5px 5px 5px 5px;
                border-radius: 5px 5px 5px 5px;
                margin: 5px 20px 40px 20px;
                -webkit-transition: all 0.3s ease-in-out;
                -moz-transition: all 0.3s ease-in-out;
                -ms-transition: all 0.3s ease-in-out;
                -o-transition: all 0.3s ease-in-out;
                transition: all 0.3s ease-in-out;
            }

            input[type=button]:hover, input[type=submit]:hover, input[type=reset]:hover  {
                background-color: #39ace7;
            }

            input[type=button]:active, input[type=submit]:active, input[type=reset]:active  {
                -moz-transform: scale(0.95);
                -webkit-transform: scale(0.95);
                -o-transform: scale(0.95);
                -ms-transform: scale(0.95);
                transform: scale(0.95);
            }

            input[type=email], input[type=password], input[type=text] {
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

            input[type=email]:focus {
                background-color: #fff;
                border-bottom: 2px solid #5fbae9;
            }

            input[type=email]:placeholder {
                color: #cccccc;
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
            #system_text:hover{
                cursor:pointer;
            }
        </style>
</head>
<body class="bg-light mb-3">
    <table id="system">
        <tr>
            <td><center><a href="frontpage.html" ><button type="button" id="system_text">Sinamum Futsal Court Reservation System</button></a></center></td>
        </tr>
    </table>
    <br>
     <table id="form">
        <tr>
            <td>
                <center>
                    <div id="formContent">
                        <br><h4 style='font-family: "Georgia", serif;'>User Registration</h4><br>
                        <form id="form" action="back_register.php" method="post">
                            <label>Email</label><br>
                            <input type="email" id="cust_id" name="cust_id" aria-describedby="emailHelp" required>
                            <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small><br>
                            <label for="name">Full Name</label><br>
                            <input type="text" id="name" name="name" required>
                            <label>Password</label><br>
                            <input type="password" id="pass" name="pass" onkeyup="validatePass()" onkeydown="validatePass()"><br>
                            <label for="confirmPass">Confirm Password</label><br>
                            <input type="password" id="confirmPass" name="confirmPass" onkeyup="validatePass()" onkeydown="validatePass()" required>
                            <small id="checkPass" name="checkPass" class="form-text"></small>
                            
                            <input type="submit" value="Register" onclick="return submitForm()"><br>
                        </form>
                    <div id="formFooter">
                        <a class="underlineHover" href="cust_login.php">Login here</a>
                    </div>   
                    </div>
                </center>
            </td>
        </tr>
    </table>
    <script>

        function validatePass() {
            var a = document.forms["form"]["pass"];
            var b = document.forms["form"]["confirmPass"];
            var c = document.getElementById("checkPass");
            var alertMessage = "";
            if (a.value != b.value){
                alertMessage = "Password do not match!";

                b.classList.add("border-danger");

                c.style.color = "#ff0000";
                c.innerHTML = alertMessage;
            } else{
                b.classList.remove("border-danger");
                c.innerHTML = "";
            }
        }

        function submitForm(){
            var c = document.getElementById("checkPass").innerHTML;
            if (c.length>0){
              alert("Password do not match!");
              return false;
            }

            else
                return true;
        }
    </script>

    <!--JS-->
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
</body>
</html>