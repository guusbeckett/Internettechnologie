<!DOCTYPE html>
<html>
<head>
  <title>Welcome</title>
  <link href="css/style.css" rel="stylesheet">
  <link rel="stylesheet" href="css/font-awesome.css">
  <script src="js/login.js"></script>
</head>
<div id="login-page-content">
  <div id="login-title">Radio login</div>
  <form onsubmit="return logincheck()" role="form" style="padding-top: 1%;">
    <!-- <div class="form-group"> -->
    <input id="radioName" class="form-control" placeholder="Radio name" name="radioName" type="radioName" onKeyUp="checkRadioNameValidity(this)" autofocus>
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
//     $con = mysqli_connect("localhost","ipac_user","kissFM","ipac_user");
//
// // Check connection
//     if (mysqli_connect_errno())
//     {
//       echo "Failed to connect to MySQL: " . mysqli_connect_error();
//   }
//   else
//   {
//         // echo "Hi";
//   }
    ?>
</div>
<!-- Core Scripts - Include with every page -->
>>>>>>> b89e7fb1611dc0241540defc1e2f430c82df5b1e
</body>
</html>
