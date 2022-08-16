<?php 
session_start();


if(isset($_SESSION['key'])){
    if($_SESSION['key'] == 'user'){
        header("Location: user/");
    }else{
        header("Location: hairdresser/");
    }

}
?>

<!DOCTYPE html>
<!-- Created By CodingNepal -->
<html lang="en" dir="ltr">

<head>
    <meta charset="utf-8">
    <title>Login </title>
    <link rel="stylesheet" href="./css/style.login.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

</head>

<body>
    <div class="wrapper">
        <div class="title-text">
            <div class="title login">
                เข้าสู่ระบบ
            </div>
            <div class="title signup">
                สมัครสมาชิก
            </div>
        </div>
        <div class="form-container">
            <div class="slide-controls">
                <input type="radio" name="slide" id="login" checked>
                <input type="radio" name="slide" id="signup">
                <label for="login" class="slide login">Login</label>
                <label for="signup" class="slide signup">Signup</label>
                <div class="slider-tab"></div>
            </div>
            <div class="form-inner">
                <form id="form-login" action="javascript:void(0)" method="post" class="login">
                    <div class="field">
                        <input type="tel" name="tel_user" placeholder="เบอร์โทร" required>
                    </div>
                    <div class="field">
                        <input type="password" name="pass_user" placeholder="รหัสผ่าน" required>
                    </div>

                    <div class="field btn">
                        <div class="btn-layer"></div>
                        <input type="submit" name="submit" value="Login">
                    </div>
                    <div class="signup-link">
                        คุณยังไม่เป็นสมาชิก? <a href="">Signup now</a>
                    </div>

                </form>

                <form id="form-signup" action="javascript:void(0)" method="post" class="signup">
                    <div class="field">
                        <input type="text" name="name_user" placeholder="ชื่อ" required>
                    </div>
                    <div class="field">
                        <input type="text" name="lastname_user" placeholder="นามสกุล" required>
                    </div>
                    <div class="field">
                        <input type="text" name="tel_user" placeholder="เบอร์โทร" required>
                    </div>
                    <div class="field">
                        <input type="email" name="e_mail" placeholder="อีเมล์" required>
                    </div>
                    <div class="field">
                        <input type="password" name="pass_user" placeholder="รหัสผ่าน" required>
                    </div>
                    <!-- <div class="field"> -->
                    <!-- <input type="password" name="confirm_pass_user" placeholder="ยืนยันรหัสผ่าน" required> -->
                    <!-- </div> -->
                    <div class="field btn">
                        <div class="btn-layer"></div>
                        <input type="submit" name="submit" value="Signup">
                    </div>
                </form>

                <script>
                    $("#form-login").submit(function() {
                        var $inputs = $("#form-login :input");
                        var values = {};
                        $inputs.each(function() {
                            values[this.name] = $(this).val();
                        })
                        console.log(values);
                        $.ajax({
                            url: "./controllers/login_cl.php",
                            type: "POST",

                            data: {
                                key: "form-login",
                                data: values,
                            },
                            success: function(result, textStatus, jqXHR) {
                                console.log(result);
                                if(result == "login-user"){
                                    location.assign("./user/")

                                }else if(result == "login-hai"){
                                    location.assign("./hairdresser/")
                                }else if(result == "login-admin"){
                                    location.assign("./admin/")
                                }else{
                                    alert(result);
                                }

                            },
                            error: function(jqXHR, textStatus, errorThrown) {

                            }
                        });

                    });

                    $("#form-signup").submit(function() {
                        var $inputs = $("#form-signup :input");
                        var values = {};
                        $inputs.each(function() {
                            values[this.name] = $(this).val();
                        })
                        console.log(values);
                        $.ajax({
                            url: "./controllers/register_cl.php",
                            type: "POST",

                            data: {
                                key: "form-signup",
                                data: values,
                            },
                            success: function(result, textStatus, jqXHR) {
                                console.log(result);
                                if (result == "success") {
                                    alert("สมัครสมาชิกสำเร็จ!!!");
                                    location.reload();
                                } else if (result == "x541") {
                                    alert("ท่านเคยสมัครก่อนหน้านี้แล้ว")
                                } else if (result == "error") {
                                    alert("ระบบตรวจพบข้อผิดพลาด")
                                    location.reload();
                                } else {
                                    alert("ระบบตรวจพบข้อผิดพลาด")
                                    location.reload();
                                }

                            },
                            error: function(jqXHR, textStatus, errorThrown) {
                                alert(errorThrown);
                            }
                        });

                    });
                </script>
            </div>
        </div>
    </div>
    <script>
        const loginText = document.querySelector(".title-text .login");
        const loginForm = document.querySelector("form.login");
        const loginBtn = document.querySelector("label.login");
        const signupBtn = document.querySelector("label.signup");
        const signupLink = document.querySelector("form .signup-link a");
        signupBtn.onclick = (() => {
            loginForm.style.marginLeft = "-50%";
            loginText.style.marginLeft = "-50%";
        });
        loginBtn.onclick = (() => {
            loginForm.style.marginLeft = "0%";
            loginText.style.marginLeft = "0%";
        });
        signupLink.onclick = (() => {
            signupBtn.click();
            return false;
        });
    </script>
</body>

</html>