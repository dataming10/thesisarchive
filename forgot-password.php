<html lang="en">
<head>
    <link rel="icon" href="uploads/logo-archive.png">
    <title>Digital Thesis Archives</title>
  <style>
    *, *:before, *:after {
  -webkit-box-sizing: border-box;
          box-sizing: border-box;
}

body {
  font-family: 'Lato', sans-serif;
}

/***** For Smartphones *******/
.container-center {
  position: absolute;
  left: 50%;
  width: 85%;
  height: auto;
  background-color: transparent;
  -webkit-transition: all 0.1s;
  transition: all 0.1s;
  bottom: 50%;a
  -webkit-transform: translateX(-50%) translateY(50%);
          transform: translateX(-50%) translateY(50%);
}

h2, img {
  text-align: center;
  color:#000000;
  font-weight: 10;
  text-shadow: 0px 1px rgba(0, 0, 0, 0.3);
}
h4{
  text-align: center;
  color:black;
  font-size: 1.1em;
  font-family: times;
  font-style:normal;
  line-height: 130%;
 opacity: .6;
}

form {
  width: 100%;
  overflow: hidden;
  background-color: #FEFEFE;
  padding: 21px 13px;
  border-radius: 21px;
  -webkit-box-shadow: 0px 5px 34px rgba(0, 0, 0, 0.1);
          box-shadow: 0px 5px 34px rgba(0, 0, 0, 0.1);
}

formgroup {
  position: relative;
  width: 100%;
  display: block;
  margin: 1em 0;
  font-size: 1em;
}
formgroup input {
  width: 100%;
  border: none;
  border-bottom: 1px solid #888888;
  padding: 8px 0;
  font-size: inherit !important;
  margin-bottom: 13px;
  outline: none;
  opacity: 0.7;
  font-weight: 455 !important;
}
formgroup input:focus {
  opacity: 1;
  border-bottom: 2px solid #F71442;
  color: #F71442;
}
formgroup label {
  position: absolute;
  font-size: 0.8em;
  top: -1em;
  left: 0;
  -webkit-transition: all 0.3s;
  transition: all 0.3s;
  opacity: 0.7;
  color: #888888;
  text-transform: uppercase;
}
formgroup span {
  position: absolute;
  top: -1em;
  left: -500px;
  opacity: 0;
  color: #333333;
  font-weight: bold;
  text-transform: uppercase;
  font-size: 0.8em;
  -webkit-transition: all 0.3s;
  transition: all 0.3s;
}
formgroup input:focus + label {
  left: 500px;
  opacity: 0;
}
formgroup input:focus ~ span {
  left: 0;
  opacity: 1;
}

.forgot {
  display: block;
  width: 100%;
  text-align: center;
  font-size: 1em;
  font-weight: bold;
  margin-top: 21px;
  opacity: 0.8;
}

#login-btn {
  border: none;
  color: #FEFEFE;
  padding: 0.8em 0;
  font-size: 1em;
  font-weight: 300;
  width: 100%;
  border-radius: 55px;
  background: #a30909;
  background-size: 100%;
  text-shadow: 0px 1px 2px rgba(0, 0, 0, 0.2);
}

.social {
  margin-top: 1.8em;
  display: -webkit-box;
  display: -ms-flexbox;
  display: flex;
}
.social button {
  width: 50%;
  margin: 0 8px;
  padding: 10px 0;
  font-size: 0.9em;
  border: none;
  border-radius: 34px;
  -webkit-box-shadow: 0px 1px 13px rgba(0, 0, 0, 0.2);
          box-shadow: 0px 1px 13px rgba(0, 0, 0, 0.2);
  color: white;
  font-weight: bold;
  cursor: pointer;
}
.social #facebook {
  background: #1F4788;
  background: -webkit-gradient(linear, left top, right top, from(#4B77BE), to(#1F4788));
  background: linear-gradient(to right, #4B77BE, #1F4788);
  background-size: 100%;
}
.social #google {
  background: #FEFEFE;
  background: -webkit-gradient(linear, left top, right top, from(#FEFEFE), to(#f1f1f1));
  background: linear-gradient(to right, #FEFEFE, #f1f1f1);
  background-size: 100%;
  color: #F71442;
}

p {
  color: #000000;
  text-align: center;
}
p a {
  color: inherit;
  text-decoration: none;
  font-weight: bold;
}

/***** For Tablets *******/
@media screen and (min-width: 480px) {
  .container-center {
    width: 70%;
  }

  #login-btn {
    padding: 0.8em 0;
    font-size: 1.2em;
  }
}
/***** For Desktop Monitors *******/
@media screen and (min-width: 768px) {
  .container-center {
    width: 500px;
  }
}

  </style>
</head>
<body>
  <div class="container-center">
  <h2>Don't worry let's bring back your account</h2>
  <form action="#" method="POST" name="recover_psw">
    <h4>
      Just provide your email<br> 
      and we can do the rest
    </h4>
    <formgroup>
      <input type="text" id="email_address" name="email" required/>
      <label for="email_address"><br>Email</label>
      <span>enter your email</span>
    </formgroup>
    
  
    <input type="submit" id="login-btn" value="Recover" name="recover">
  
   
    
  </form>
   
  <p>Did you remember? <a href="login.php">Sign In</a></p>
</div>
</body>
</html>

<?php 
    if(isset($_POST["recover"])){
        require_once('./config.php');
        $email = $_POST["email"];

        $db = mysqli_query($conn, "SELECT * FROM student_list WHERE email='$email'");
        $query = mysqli_num_rows($db);
  	    $fetch = mysqli_fetch_assoc($db);

        if(mysqli_num_rows($db) <= 0){
            ?>
            <script>
                alert("<?php  echo "Sorry, no emails exists "?>");
            </script>
            <?php
        }else if($fetch["status"] == 0){
            ?>
               <script>
                   alert("Sorry, your account must verify first, before you recover your password !");
                   window.location.replace("forgot-password.php");
               </script>
           <?php
        }else{
            // generate token by binaryhexa 
            $token = bin2hex(random_bytes(50));

            //session_start ();
            $ref = rand(100000,999999);
            $_SESSION['ref'] = $ref;
            $_SESSION['token'] = $token;
            $_SESSION['email'] = $email;

            require "Mail/phpmailer/PHPMailerAutoload.php";
            $mail = new PHPMailer;

            $mail->isSMTP();
            $mail->Host='smtp.gmail.com';
            $mail->Port=587;
            $mail->SMTPAuth=true;
            $mail->SMTPSecure='tls';

            // h-hotel account
            $mail->Username='digitalthesisarchives058@gmail.com';
            $mail->Password='kfeijyfpnrreaals';

            // send by h-hotel email
            $mail->setFrom('digitalthesisarchives058@gmail.com', 'Password Recovery');
            // get email from input
            $mail->addAddress($_POST["email"]);
            //$mail->addReplyTo('digitalthesisarchives058@gmail.com');

            // HTML body
            $mail->isHTML(true);
            $mail->Subject="Recover your password #$ref";
            $mail->Body="<b>Dear student,</b>
            <h3>We received a request to reset your password in $email with the reference number of #$ref</h3>
            <p>Kindly click the below link to begin resetting your password</p>
            https://forms.gle/nXiJquXMZ9sKjCqy7
            <br><br>
            <p>With regrads,</p>  
            <b>MIS ADMIN</b>";

            if(!$mail->send()){
                ?>
                    <script>
                        alert("<?php echo " Invalid Email "?>");
                    </script>
                <?php
            }else{
                ?>
                    <script>
                        window.location.replace("login.php");
                    </script>
                <?php
            }
        }
    }

?>


