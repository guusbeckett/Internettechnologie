<!DOCTYPE html>
<html>
<head>
  <title>Welcome</title>
  <link href="css/style.css" rel="stylesheet">
</head>
<div id="login-page-content">
  <div id="login-title">Radio Login</div>
  <form onsubmit="return logincheck()" role="form">
    <!-- <div class="form-group"> -->
    <input id="radioName" class="form-control" placeholder="Radio name" name="radioName" type="radioName" autofocus>
    <div id="go-button">Go</div>
    <!-- </div> -->
    <script>
      document.getElementById('radioName').onkeypress = function(e)
      {
        if (!e) e = window.event;
        var keyCode = e.keyCode || e.which;
        if (keyCode == '13')
        {
          logincheck();
          return false;
        }
      }
    </script>
    <?php
    $con = mysqli_connect("localhost","ipac_user","kissFM","ipac_user");

// Check connection
    if (mysqli_connect_errno())
    {
      echo "Failed to connect to MySQL: " . mysqli_connect_error();
    }
    else
    {
        // echo "Hi";
    }
    ?>
  </div>
  <!-- Core Scripts - Include with every page -->
</body>
</html>
