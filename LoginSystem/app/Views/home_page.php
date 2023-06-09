
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>LoginSystem</title>

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
    
    <div class="container" style="margin-top:30px;">
        <div class="row" style="margin-top:30px;">
            <div class="col" style="display:flex; justify-content:center;">
                <p>Welcome to home page</p>
   
            </div>
        </div>
        <div class="row " style="margin-top:30px;">
            <div class="col" style="display:flex; justify-content:center;">
                <button id="b_login" type="button" class="btn btn-primary" onclick="logout_event()">登出</button>
            </div>
        </div>
    </div>
    
    <!-- logout  -->
    <script>


        function logout_event(){
            window.location.href = "/";
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