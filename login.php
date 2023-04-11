<?php
session_start();
?>
<?php
include('database.php');
?>
<?php

    if (isset($_COOKIE['loguser'])){
        $loguser = $_COOKIE['loguser'];
        header('Location: index.php');
    }

?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>simpstudy</title>
    <link rel="stylesheet" href="style.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
        @import url('https://fonts.googleapis.com/css?family=Poppins:400,500,600,700&display=swap');
        *{
          margin: 0;
          padding: 0;
          box-sizing: border-box;
          font-family: 'Poppins', sans-serif;
        }
        html,body{
          display: grid;
          height: 100%;
          width: 100%;
          place-items: center;
          background: -webkit-linear-gradient(left, #fff, #fff);
        }
        ::selection{
          background: #1DBF73;
          color: #fff;
        }
        .wrapper{overflow: hidden;max-width: 100vw;background: #fff;padding: 20px;padding-top:2px;box-shadow: 0px 10px 100% rgba(1,1,1,0.1);
                border-top-left-radius: 30px;border-top-right-radius: 30px;}
        .wrapper .title-text{
          display: flex;
          width: 200%;
        }
        .wrapper .title{
          width: 50%;
          font-size: 35px;
          font-weight: 600;
          text-align: center;
          transition: all 0.6s cubic-bezier(0.68,-0.55,0.265,1.55);
        }
        .wrapper .slide-controls{
          position: relative;
          display: flex;
          height: 50px;
          width: 100%;
          overflow: hidden;
          margin: 30px 0 10px 0;
          justify-content: space-between;
          border: 1px solid lightgrey;
          border-radius: 5px;
        }
        .slide-controls .slide{
          height: 100%;
          width: 100%;
          color: #fff;
          font-size: 18px;
          font-weight: 500;
          text-align: center;
          line-height: 48px;
          cursor: pointer;
          z-index: 1;
          transition: all 0.6s ease;
        }
        .slide-controls label.signup{
          color: #000;
        }
        .slide-controls .slider-tab{
          position: absolute;
          height: 100%;
          width: 50%;
          left: 0;
          z-index: 0;
          border-radius: 5px;
          background: -webkit-linear-gradient(left, #BFA097, #BFA097);
          transition: all 0.6s cubic-bezier(0.68,-0.55,0.265,1.55);
        }
        input[type="radio"]{
          display: none;
        }
        #signup:checked ~ .slider-tab{
          left: 50%;
        }
        #signup:checked ~ label.signup{
          color: #fff;
          cursor: default;
          user-select: none;
        }
        #signup:checked ~ label.login{
          color: #000;
        }
        #login:checked ~ label.signup{
          color: #000;
        }
        #login:checked ~ label.login{
          cursor: default;
          color:#fff;
          user-select: none;
        }
        .wrapper .form-container{
          width:100%;
          overflow: hidden;
        }
        .form-container .form-inner{
          display: flex;
          width: 200%;
        }
        .form-container .form-inner form{
          width: 50%;
          transition: all 0.6s cubic-bezier(0.68,-0.55,0.265,1.55);
        }
        .form-inner form .field{
          height: 50px;
          width: 100%;
          margin-top: 20px;
        }
        .form-inner form .field input{
          height: 100%;
          width: 100%;
          outline: none;
          padding-left: 15px;
          border-radius: 20px;
          border: 1px solid #BFA097;
          border-bottom-width: 2px;
          font-size: 17px;
          transition: all 0.3s ease;
        }
        .form-inner form .field input:focus{
          border-color: #fe2121;
          /* box-shadow: inset 0 0 3px #fb6aae; */
        }
        .form-inner form .field input::placeholder{
          color: #999;
          transition: all 0.3s ease;
        }
        form .field input:focus::placeholder{
          color: #b3b3b3;
        }
        .form-inner form .pass-link{
          margin-top: 5px;
        }
        .form-inner form .signup-link{
          text-align: center;
          margin-top: 30px;
        }
        .form-inner form .pass-link a,
        .form-inner form .signup-link a{
          color: #BFA097;
          text-decoration: none;
        }
        .form-inner form .pass-link a:hover,
        .form-inner form .signup-link a:hover{
          text-decoration: none;
        }
        form .btn{
          height: 50px;
          width: 100%;
          border-radius: 5px;
          position: relative;
          overflow: hidden;
        }
        form .btn .btn-layer{
          height: 100%;
          width: 300%;
          position: absolute;
          left: -100%;
          border-radius: 5px;
          transition: all 0.4s ease;
        }
        form .btn:hover .btn-layer{
          left: 0;
        }
        form .btn input[type="submit"]{
          height: 100%;
          width: 100%;
          z-index: 1;
          position: relative;
          background: #BFA097;
          border: none;
          color: #fff;
          padding-left: 0;
          border-radius: 20px;
          font-size: 20px;
          font-weight: 500;
          cursor: pointer;
        }
        @media(max-width:560px){
            .wrapper{
                margin:2vh 5vw;
            }
        }

    </style>
  </head>
  <body>
      <script src="sweetalert.min.js"></script>
      <?php
      
      if (isset($_SESSION['signupfail'])){
           echo "<script>
        			swal({
        				title: 'Password dosent Match',
        				text: 'Please check Your Passwords',
        				icon: 'error',
        			});
        		</script>";
        		session_destroy ();
      }
      if (isset($_SESSION['wrongpwd'])){
           echo "<script>
        				swal({
        					title: 'Wrong Password',
        					text: 'Please check Your Password',
        					icon: 'error',
        				});
        			</script>";
        		session_destroy ();
      }
      if (isset($_SESSION['wrongemail'])){
           echo "<script>
        				swal({
        					title: 'Incorrect EPF Number',
        					text: 'Please check Your EPF Number',
        					icon: 'error',
        				});
        			</script>";
        		session_destroy ();
      }
      if (isset($_SESSION['alreadyuser'])){
           echo "<script>
        				swal({
        					title: 'Wrong EPF Number',
        					text: 'the EPF Number Cant Found',
        					icon: 'error',
        				});
        			</script>";
        		session_destroy ();
      }
      ?>
      <div style = 'width:100vw;height:32vh;position:fixed;top:0px;background: linear-gradient(to right, #BFA097, #ccc);color:#fff;'>
      <br><br><br>
            <p style = 'margin-left:7vw;font-size:25px;font-weight:400;'>Login or Register</p>
      </div>
    <br>
    <div class="wrapper" style = 'z-index:5;'>
    <br><br>
        <div class="title-text">
        <div class="title login">Login</div>
        <div class="title signup">Register</div>
      </div>
      
      <div class="form-container">
        <div class="slide-controls">
          <input type="radio" name="slide" id="login" checked>
          <input type="radio" name="slide" id="signup">
          <label for="login" class="slide login">Login</label>
          <label for="signup" class="slide signup">Register</label>
          <div class="slider-tab"></div>
        </div>
        <div class="form-inner">
          <form action="x.php" method = 'post' class="login">
            <div class="field">
              <input type="text" placeholder="EPF Number" name = 'lepf' required>
            </div>
            <div class="field">
              <input type="password" placeholder="Password" name = 'lpwd' required>
            </div>
            <!--<div class="pass-link"><a href="#">Forgot password?</a></div>-->
            <div class="field btn">
              <div class="btn-layer"></div>
              <input type="submit" name = 'lbtn' value="Login">
            </div>
            <div class="signup-link">Not a member? <a href="">Register now</a></div>
          </form>
          <form action="x.php" method = 'post' class="signup">
            <div class="field">
              <input type="text" name = 'epf' placeholder="EPF Number" required>
            </div>
            <div class="field">
              <input type="password" name = 'pwd' placeholder="Password" required>
            </div>
            <div class="field">
              <input type="password" name = 'rpwd' placeholder="Confirm password" required>
            </div>
            
            <div class="field btn">
              <div class="btn-layer"></div>
              <input type="submit" name = 'sbtn' value="Register Now">
            </div>
          </form>
        </div>
      </div>
    </div>

    <script>
      const loginText = document.querySelector(".title-text .login");
      const loginForm = document.querySelector("form.login");
      const loginBtn = document.querySelector("label.login");
      const signupBtn = document.querySelector("label.signup");
      const signupLink = document.querySelector("form .signup-link a");
      signupBtn.onclick = (()=>{
        loginForm.style.marginLeft = "-50%";
        loginText.style.marginLeft = "-50%";
      });
      loginBtn.onclick = (()=>{
        loginForm.style.marginLeft = "0%";
        loginText.style.marginLeft = "0%";
      });
      signupLink.onclick = (()=>{
        signupBtn.click();
        return false;
      });
    </script>

  </body>
</html>
