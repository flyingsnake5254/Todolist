
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>TodoList</title>

    <style>
         html, body{
            width: 100%;
            height: 100%;
         }

         #vanta_bg{
            width: 100%;
            height: 100%;
            position: fixed;
            z-index: -1;
         }

        .font_style {
            font-family: Georgia, serif;
            font-size: 50px;
            letter-spacing: 5px;
            word-spacing: 6px;
            color: #ffffff;
            font-weight: 500;
            text-decoration: none;
            font-style: normal;
            font-variant: small-caps;
            text-transform: capitalize;
            text-align: center;
            margin-top: 50px;
        }
    </style>

    <!-- Bootstrap CDN -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

</head>
<body>      
    <div id="vanta_bg"></div>

    <div class="container" style="margin-top:50px; ">
        <!-- 分頁  -->
        <div class="row">
            <div class="col" style="display:flex; justify-content:center;">
                <nav aria-label="Page navigation example">
                    <ul class="pagination">
                        <li class="page-item"><a class="page-link" href="#" onclick="changeTitle('登入帳號','帳號','密碼','登入')">登入帳號</a></li>
                        <li class="page-item"><a class="page-link" href="#" onclick="changeTitle('建立帳號','新帳號','新密碼','建立')">建立帳號</a></li>
                    </ul>
                </nav>
            </div>
        </div>

        <!-- title  -->
        <div class="row " style="margin-top:50px;">
            <div class="col" style="display:flex; justify-content:center;">
                <p id="title" style="font-size:30px;">登入帳號</p>
            </div>
        </div>

        <!-- 帳號  -->
        <div class="row " style="">
            <div class="col" style="display:flex; justify-content:center;">
                <div class="input-group" style="width:700px;">
                    <span id="l_account" class="input-group-text">帳號</span>
                    <input id="t_account" type="text" class="form-control" placeholder="account"/>
                </div>
            </div>
        </div>

        <!-- 密碼  -->
        <div class="row " style="margin-top:30px;">
            <div class="col" style="display:flex; justify-content:center;">
                <div class="input-group" style="width:700px;">
                    <span id="l_password" class="input-group-text">密碼</span>
                    <input id="t_password" type="password" class="form-control" placeholder="password"/>
                </div>
            </div>
        </div>

        <!-- 按鈕  -->
        <div class="row " style="margin-top:30px;">
            <div class="col" style="display:flex; justify-content:center;">
                <button id="b_login" type="button" class="btn btn-primary" onclick="login_event()">登入</button>
            </div>
        </div>
    </div>

    <!-- component  -->
    <script>
        var loginComponent = {
            login : function(data){
                

                return fetch("http://localhost:8080/login", {
                    method : "POST",
                    headers: {
                        'Content-Type': 'application/json'
                    },
                    body: JSON.stringify(data)
                })
                .then(response => response.json())
                .then(res => {
                    if (res.msg == "success"){
                        window.location.href = "/home_page";
                    }
                    else{
                        alert(res.msg);
                    }
                })
                .catch(error => {
                    console.log("error" , error);
                });
            },
            createAccount : function(data){
                return fetch('http://localhost:8080/createAccount', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json'
                    },
                    body: JSON.stringify(data)
                })
                .then(response => response.json())
                .catch((error) => {
                    console.error('Error:', error);
                });
            }
        };

    </script>

    <!-- login  -->
    <script>
        function login_event(){
            let bt =document.getElementById("b_login");
            
            if (bt.textContent == "登入"){
                let account =document.getElementById("t_account").value;
                let password = document.getElementById("t_password").value;
                if (account.trim() !== "" && password.trim() !== "" ){
                    data = {
                        "account" : account,
                        "password" :password,
                    };
                }
                else{
                    alert("請輸入帳號、密碼");
                }
                
                loginComponent.login(data);
               
            }
            else if (bt.textContent == "建立"){
                let account =document.getElementById("t_account").value;
                let password = document.getElementById("t_password").value;
                if (account.trim() !== "" && password.trim() !== "" ){
                    data = {
                        "account" : account,
                        "password" :password,
                    };
                    console.log(data);
                    loginComponent.createAccount(data)
                    .then(res => {
                        alert(res.msg);
                       
                    });
                }
                else{
                    alert ("輸入不可為空")
                }
            }
        }

        
    </script>


    <!-- 切換分頁時，更改 title  -->
    <script>
        function changeTitle(title_content, l_account, l_password, l_login){
            let title =document.getElementById("title");
            title.textContent =title_content;

            let account =document.getElementById("l_account");
            let password =document.getElementById("l_password");
            account.textContent =l_account;
            password.textContent =l_password;

            let login =document.getElementById("b_login");
            login.textContent =l_login;
        }
    </script>


    
    <!-- Dynamic BG  -->

    <script src="https://cdnjs.cloudflare.com/ajax/libs/three.js/r134/three.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/vanta@latest/dist/vanta.dots.min.js"></script>
    <script>
        VANTA.DOTS({
            el: "#vanta_bg",
            mouseControls: true,
            touchControls: true,
            gyroControls: false,
            minHeight: 200.00,
            minWidth: 200.00,
            scale: 1.00,
            scaleMobile: 1.00,
            color: 0x7fff,
            color2: 0xffffff,
            backgroundColor: 0xffffff,
            spacing: 23.00
        })
    </script>
</body>
</html>