<!DOCTYPE HTML>
<html lang="en" >
<html>
<head>
  <title>Login</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta charset="utf-8">
  <link rel="stylesheet" type="text/css" href="css/login_style.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <link href='https://fonts.googleapis.com/css?family=Titillium+Web:400,300,600' rel='stylesheet' type='text/css'>  
  <link href='https://fonts.googleapis.com/css?family=Titillium+Web:400,300,600' rel='stylesheet' type='text/css'> 
  <script src="https://unpkg.com/@lottiefiles/lottie-player@latest/dist/lottie-player.js"></script>
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.1/css/all.css" integrity="sha384-vp86vTRFVJgpjF9jiIGPEEqYqlDwgyBgEF109VFjmqGmIY/Y4HV4d3Gp2irVfcrp" crossorigin="anonymous">

  <!-- liff -->
  <script src="https://static.line-scdn.net/liff/edge/2/sdk.js"></script>

  <!-- alert -->
  <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>

  <!-- vue -->
  <script src="https://unpkg.com/vue@3"></script>

  <!-- ajax -->
  <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>

  <!-- VConsole -->
  <script src="https://unpkg.com/vconsole@latest/dist/vconsole.min.js"></script>
  <script>
  var vConsole = new window.VConsole();
  </script>
  
</head>

<body onload='Check_OS();Check_verion_webview();'class="body">

<div id="index_page">
  <div class="login-page">
    <div class="form">
        <img src="https://i.imgur.com/FUaYmQX.png" class="rounded-circle" style="height: 180px;">
        <div style="height: 1rem"></div>
        <p style="font-size: 20px;"><b>Login Dashboard</b></p>
        <form action="login_backend.php" method="post">
          <input type="text" id="user_id" name="user_id" placeholder="&#xf007;  เลขประจำตัวผู้ดูแลระบบ"/>
          <input type="password" id="cardID" name="cardID" placeholder="&#xf023;  เลขบัตรประชาชน"/>
          <br>
          <button type="submit">LOGIN</button>
        </form>
        <p class="message"></p>
    </div>
  </div>
</div> 

  <script>
    
    function show(){
      var password = document.getElementById("password");
      var icon = document.querySelector(".fas")

      // ========== Checking type of password ===========
      if(password.type === "password"){
        password.type = "text";
      }
      else {
        password.type = "password";
      }
    };
  </script>
</body>
</html>

