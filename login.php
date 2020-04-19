<?php 
  require "templates/top.php";
  require "templates/navbar.php";
?>
    <script>
            function login(e){
                if(e == "emailInput"){
                    document.getElementById("email").style.top="27%";
                    document.getElementById(e).style.borderBottom="2px solid green";
                }
                if(e == "passInput"){
                    document.getElementById("pass").style.top="41%";
                    document.getElementById(e).style.borderBottom="2px solid green";
                }
            }

        function loginOut(e){
            if(e == "emailInput"){
                //If not input was made
                if(document.getElementById(e).value == ""){
                    document.getElementById("email").style.top="34%";
                    document.getElementById(e).style.borderBottom="2px solid red";
                    emailFlag = false;
                }
            }
            if(e == "passInput"){
                //If not input was made
                if(document.getElementById(e).value == ""){
                    document.getElementById("pass").style.top="48%";
                    document.getElementById(e).style.borderBottom="2px solid red";
                    passFlag = false;
                }
            }
        }

    <!--loginbox-->
    <div class="loginbox">
        
        <h1>Login</h1>
        <form>
            <div class="emailContainer">
                <p id="email">Email Address</p>
                <input type="text" id="emailInput" onfocusout="loginOut(this.id)" onfocus="login(this.id)" name="email">
            </div>
            <div class="passContainer">
                <p id="pass">Password</p>
                <input type="password" id="passInput" onfocusout="loginOut(this.id)" onfocus="login(this.id)" name="password">
            </div>
            <input type="submit" name="" value="Log In">
            <div class="d-flex">
                <a href="#">Don't have an account?</a>
                <a href="#" class="ml-2">Sign Up</a>
            </div>
        </form>
    </div>
<?php require "templates/foot.php" ?>