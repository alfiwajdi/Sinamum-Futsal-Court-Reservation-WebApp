<?php
  session_start();
  require_once "config.php";
  require "session_check.php";
  require "alert_message.php";
  is_admin();
  alert_login();

  if($_SERVER["REQUEST_METHOD"] == "GET"){
    if (isset($_GET['date'])) {
      $date = $_GET['date'];
    }
  }
  $cust_id = $_SESSION["user"];
  $check_pay = 0;
  try{
    // Prepare statement
    $stmt = mysqli_prepare($mysqli, "SELECT id, name, phone, DATE_FORMAT(start, '%d/%m/%Y %h:%i %p') as 'start', DATE_FORMAT(end, '%d/%m/%Y %h:%i %p') as 'end', resource_id, total_payment, deposit_payment, make_payment FROM events ORDER BY make_payment");

    //Bind statement
    //mysqli_stmt_bind_param($stmt);

    //Executing statement
    mysqli_stmt_execute($stmt);

    // Get result from previous execuuted statemnet
    $result = mysqli_stmt_get_result($stmt);

    // SQL query
    $sql = "SELECT * FROM announcement WHERE anc_id = 1";
    // Execute the query (the recordset $rs contains the result)
    $rs = mysqli_query($mysqli, $sql);
    $anc = mysqli_fetch_array($rs);
?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
  <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
  <title>Homepage</title>
  <style type="text/css">
    table{width: 100%; position: relative; border-collapse: collapse;}
    #system tr{ 
      background-color: #000000;
      font-size: 18px;
      color: #FFFFFF;
    }

    p,
    body,
    td {
      font-family: Tahoma, Arial, Helvetica, sans-serif;
      font-size: 10pt;
    }

    body {
      padding: 0px;
      margin: 0px;
      background-color: #FFFDF2;
    }

    a {
      color: #1155a3;
    }

    .space {
      margin: 10px 0px 10px 0px;
    }

    .header {
      background: #003267;
      background: linear-gradient(to right, #011329 0%, #00639e 44%, #011329 100%);
      padding: 20px 10px;
      color: white;
      box-shadow: 0px 0px 10px 5px rgba(0, 0, 0, 0.75);
    }

    .header a {
      color: white;
    }

    .header h1 a {
      text-decoration: none;
    }

    .header h1 {
      padding: 0px;
      margin: 0px;
    }

    .main {
      padding: 10px;
      margin-top: 10px;
    }
  </style>

  <!-- DayPilot library -->
  <script src="js/daypilot/daypilot-all.min.js"></script>
</head>

<body>

  <table id="system">
        <tr style="height: 38px;">
            <td><a href="admin_homepage.php" class="navbar-brand" style="color: #FFFFFF" >&nbsp;&nbsp;Home Page</a></td>
            <td>
                <a href="logout.php"><img src="img/off_icon.png" style="width: 20px; height: 20px; float: right; margin-right: 15px;">
                  <a href="announcement.php"><img src="img/announcement.png" style="width: 20px; height: 20px; float: right; margin-right: 10px;"></a>
            </td>
        </tr>
  </table>
  <br>
  <table style="width: 99%; border: 1px solid black; margin-left: 5px; margin-right: 10px; background-color: #FFFFFF;"> 
    <tr>
      <td><center><b><?php echo $anc['anc_title'];// anc_title?></b><br><?php echo $anc['anc_text'];?></center></td>
    </tr>
  </table>
  <br>
  <form action="" method="get">
    &nbsp;&nbsp;<input type="date" name="date" id="date"
    value="<?php if (isset($_GET['date'])) {echo $date;} ?>">
    <input type="submit" value="Submit">
  </form>

  <div class="main">
    <div id="dp"></div>
  </div>


  <div>
    <table id="table" class="table">
      <thead class="thead-dark">
        <tr>
          <th>Booking ID</th>
          <th>Name</th>
          <th>Phone</th>
          <th>Start</th>
          <th>End</th>
          <th>Court</th>
          <th>Total Price</th>
          <th>Required Deposit</th>
          <th>Action</th>
        </tr>
      </thead>
      <?php
        //Check if row = 0, exit. Else, success
        if(mysqli_stmt_affected_rows($stmt) == 0 || mysqli_stmt_affected_rows($stmt) < 0){
            //echo mysqli_stmt_affected_rows($stmt) . $user;
            $errorMessage = "No unpayed courts.";
        } else{
            $i = 0;
            $errorMessage = "";
            //echo mysqli_stmt_affected_rows($stmt);
            //Fetch row from $result
            while ($row = mysqli_fetch_array($result, MYSQLI_NUM))
            {
              $book_id = $row[0];
              $make_payment = $row[8];

                echo "<tr class='table-secondary'>";
                echo "<td>";
                echo $book_id;
                echo "</td>";
                echo "<td>";
                echo $row[1];
                echo "</td>";
                echo "<td>";
                echo $row[2];
                echo "</td>";
                echo "<td>";
                echo $row[3];
                echo "</td>";
                echo "<td>";
                echo $row[4];
                echo "</td>";
                echo "<td>";
                echo $row[5];
                echo "</td>";
                echo "<td>";
                echo $row[6];
                echo "</td>";
                echo "<td>";
                echo $row[7];
                echo "</td>";

                if($make_payment == 0){
                  echo "<td>";
                  echo "Not Paid";
                  echo "</td>";
                }
                else{
                  echo "<td>";
                  echo "Paid";
                  echo "</td>";
                }
                echo "</tr>";
                ++$i;
            }
        }
        
    //Closing statement
    mysqli_stmt_close($stmt);

    //Closing connection
    mysqli_close($mysqli);
}  catch (Exception $e) {echo 'Caught exception: '.  getMessage($e);} //catch exception
?>
    </table>
    <small id="errorMessage"><?php echo $errorMessage?></small>
  </div>

  <script type="text/javascript">
      
      $date_submit = document.getElementById('date').value;
      
      var dp = new DayPilot.Scheduler("dp");

      window.onload = function showForm(){
        var a = document.getElementById('date').value;
        if(a){
          document. getElementById("table").style.display = "block"; //show
          document. getElementById("errorMessage").style.display = "block"; //show
        }
        else{
          document. getElementById("table"). style. display = "none"; //hide
          document. getElementById("errorMessage"). style. display = "none"; //hide
        }
      }

      //dp.timeRangeSelectedHandling ="Disabled";
      dp.eventMoveHandling = "Disabled";
      dp.eventResizeHandling = "Disabled";
      //dp.eventDeleteHandling = "Disabled";
      //dp.eventClickHandling = "Disabled";
      dp.eventRightClickHandling = "Disabled";
      dp.eventDeleteHandling = "Update";
      dp.treeEnabled = true;


      dp.scale = "Hour";
      dp.startDate = $date_submit;
      dp.businessBeginsHour = 8;
      dp.businessEndsHour = 20;
      dp.showNonBusiness = false;
      dp.businessWeekends = true;

      dp.timeHeaders = [
        { groupBy: "Day", format: "dddd, dd-MM-yyyy" },
        { groupBy: "Hour" }
      ];

      dp.cellWidthSpec = "Auto";
      dp.eventHeight = 40;

            // http://api.daypilot.org/daypilot-scheduler-oneventmoved/
      dp.onEventMoved = function (args) {
        DayPilot.Http.ajax({
          url: "backend_move.php",
          data: {
            id: args.e.id(),
            newStart: args.newStart.toString(),
            newEnd: args.newEnd.toString(),
            newResource: args.newResource
          },
          success: function () {
            dp.message("Moved.");
          }
        });
      };

      // http://api.daypilot.org/daypilot-scheduler-oneventresized/
      dp.onEventResized = function (args) {
        DayPilot.Http.ajax({
          url: "backend_resize.php",
          data: {
            id: args.e.id(),
            newStart: args.newStart.toString(),
            newEnd: args.newEnd.toString()
          },
          success: function () {
            dp.message("Resized.");
          }
        });
      };

      dp.onEventDeleted = function (args) {
        DayPilot.Http.ajax({
          url: "backend_delete.php",
          data: {
            id: args.e.id()
          },
          success: function () {
            dp.message("Deleted.");
            alert("Page will reload 2 seconds after clicking ok.");
            window.setTimeout(function(){window.location.reload()}, 2000);
          }
        });
      };

      dp.onTimeRangeSelected = function (args) {
        var form = [
          { name: "Name", id: "text" },
          { name: "Phone", id: "phone" },
          { name: "Start", id: "start", dateFormat: "M/d/yyyy h:mm:ss tt" },
          { name: "End", id: "end", dateFormat: "M/d/yyyy h:mm:ss tt" },
          { name: "Resource", id: "resource", options: flatten(dp.resources) },
          { name: "Total Price", id: "total" },
          { name: "Required Deposit", id: "deposit" }
        ];

        var data = {
          start: args.start,
          end: args.end,
          resource: args.resource,
          total: ((args.end.getTime() - args.start.getTime())/1000)/3600*80,
          deposit: (((args.end.getTime() - args.start.getTime())/1000)/3600*80)*30/100
          //text: "New event"
        };

        var options = {
          focus: "text"
        };

        DayPilot.Modal.form(form, data, options).then(function (modal) {
          dp.clearSelection();
          if (modal.canceled) {
            return;
          }
          DayPilot.Http.ajax({
            url: "backend_create.php",
            data: modal.result,
            success: function (response) {
              modal.result.id = response.data.id
              dp.events.add(modal.result);
              dp.message("Created.");
              alert("Page will reload 2 seconds after clicking ok.");
              window.setTimeout(function(){window.location.reload()}, 2000);
            }
          });
          
        });
      };

      dp.onEventClick = function (args) {
        var form = [
          { name: "Name", id: "text" },
          { name: "Phone", id: "phone" },
          { name: "Start", id: "start", dateFormat: "M/d/yyyy h:mm:ss tt" },
          { name: "End", id: "end", dateFormat: "M/d/yyyy h:mm:ss tt" },
          { name: "Resource", id: "resource", options: flatten(dp.resources) },
          { name: "Paid?", id: "make_payment" }
        ];

        var data = args.e.data;

        var options = {
          focus: "text"
        };

        DayPilot.Modal.form(form, data, options).then(function (modal) {
          dp.clearSelection();
          if (modal.canceled) {
            return;
          }
          DayPilot.Http.ajax({
            url: "backend_update.php",
            data: modal.result,
            success: function (response) {
              console.log("Updating data", modal.result);
              dp.events.update(modal.result);
              dp.message("Updated.");
              alert("Page will reload 2 seconds after clicking ok.");
              window.setTimeout(function(){window.location.reload()}, 2000);
            }
          });
        });

      };

      dp.onBeforeEventRender = function (args) {
        args.data.barHidden = true;
        args.data.backColor = "#6d9eeb";
        args.data.borderColor = "darker";
        args.data.fontColor = "white";
      };

      dp.init();

      loadResources();
      loadEvents();

      function loadEvents() {
        dp.events.load("backend_events.php");
      }

      function loadResources() {
        dp.rows.load("backend_resources.php");
      }

      function flatten(resources, result) {
        result = result || [];

        resources && resources.forEach(function (r) {
          result.push(r);
          flatten(r.children, result);
        })

        return result;
      }
  </script>
  <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
  <script src="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
  <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>

</body>

</html>