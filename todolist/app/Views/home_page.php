

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

    <script>
        let todoListComponent = {
            getAllData : function(){
                return fetch("http://localhost:8080/tdl")
                .then(response => response.json())
                .catch(error => {
                    console.log(error);
                })
            },
            getData : function(id){
             
                let url = "http://localhost:8080/tdl/" + id;
                return fetch(url)
                .then(response => response)
                .catch(error => {
                    console.log(error);
                })
            },
            createData : function(data){
                return fetch('http://localhost:8080/tdl', {
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

            },
            updateData : function(data, id){
                let url = "http://localhost:8080/tdl/" + id;
                console.log("url", url);
                return fetch(url, {
                    method: 'PUT',
                    headers: {
                        'Content-Type': 'application/json'
                    },
                    body: JSON.stringify(data)
                })
                .catch((error) => {
                    console.error('Error:', error);
                });
            },
            deleteData : function(id){
                let url = "http://localhost:8080/tdl/" + id;
                return fetch(url, {
                    method:"DELETE"
                })
                .then(response => response)
                .catch(error => {
                    console.log(error);
                })
            }
        }

    </script>

    <script>
        
        

        function setWidgetVisible(visible1 = false, visible2 = false, visible3 = false, visible4 = false){
            let tx_input = document.getElementById("input");
            let bt_input = document.getElementById("input_bt");
            let create_data = document.getElementById("create-data");
            let table = document.getElementById("todolist-table");
            let update_bt =document.getElementById("update-bt");
            if (visible1){
                tx_input.style.visibility = "visible";
                bt_input.style.visibility = "visible";
            }
            else{
                tx_input.style.visibility = "hidden";
                bt_input.style.visibility = "hidden";
            }

            if (visible2){
                create_data.classList.remove("d-none");
                create_data.classList.add("d-flex");
            }
            else{
                create_data.classList.add("d-none");
                create_data.classList.remove("d-flex");
            }

            if (visible3){
                table.classList.remove("d-none");
                table.classList.add("d-flex");
            }
            else{
                table.classList.add("d-none");
                table.classList.remove("d-flex");
            }

            if (visible4){
                update_bt.classList.remove("d-none");
                update_bt.classList.add("d-flex");
            }
            else{
                update_bt.classList.add("d-none");
                update_bt.classList.remove("d-flex");
            }
        }

        function doAction(event){
            let table =document.getElementById('data-table');
            let element = event.target;
            let element_id = element.id;
            let action_bt =document.getElementById("action");
            action_bt.textContent = element.textContent;

            if (element_id == "get-all"){
                setWidgetVisible(false, false, true, false);
                todoListComponent.getAllData()
                .then(res => {
                    if (res.msg == "success"){
                        if (res.data.length == 0){
                            table.innerHTML = '<caption>尚無待辦事項</caption>';
                        }
                        else{
                            let table_data = '';
                            let data = res.data;
                            data.forEach(function(element) {
                                table_data += `
                                <tr>
                                    <td contenteditable='false'>${element.id}</td>
                                    <td contenteditable='false'>${element.title}</td>
                                    <td contenteditable='false'>${element.description}</td>
                                    <td contenteditable='false'>${element.due}</td>
                                </tr>`;
                            });
                            table.innerHTML = `
                            <caption>待辦事項</caption>
                            <thead>
                                <tr>
                                    <th>id</th>
                                    <th>項目名稱</th>
                                    <th>描述</th>
                                    <th>截止日期</th>
                                </tr>
                            </thead>
                            <tbody>`+
                            table_data+
                            `</tbody>`;
                        }
                    }
                    else{
                        alert("fail to get data");
                    }
                })
                .catch(error => {
                    console.log(error);
                });
            }
            else if (element_id == "get-single"){
                setWidgetVisible(true, false, false);
                let tx_input = document.getElementById("input");
                let bt_input = document.getElementById("input_bt");
                bt_input.className = "btn btn-primary";
             
                tx_input.placeholder = "輸入 id";
                bt_input.textContent = "搜尋";

        
            }
            else if (element_id == "create"){
                setWidgetVisible(false, true, false);
                let input =document.getElementById("input");
                input.placeholder = "輸入 id";
            }
            else if (element_id == "update"){
                setWidgetVisible(true, false, false);
                let input =document.getElementById("input");
                let bt_input = document.getElementById("input_bt");
                bt_input.className = "btn btn-primary";

                input.placeholder = "輸入 id";
                bt_input.textContent = "搜尋";
            }
            else if (element_id == "delete"){
                setWidgetVisible(true, false, false);
                let input =document.getElementById("input");
                let input_bt =document.getElementById('input_bt');
                
                input_bt.className = "btn btn-danger";
                input_bt.textContent = "刪除";
                input.placeholder = "輸入 id";
            }

        }

        function bt_event(){
            let action =document.getElementById('action');
            if (action.textContent == "根據 id 取得待辦事項"){
                let input_id =document.getElementById('input').value;
                todoListComponent.getData(parseInt(input_id))
                .then(res => {
                    if (res.status == "200"){
                        res.json().then(respond => {
                            if (respond.msg == "success"){
                                setWidgetVisible(true, false, true);
                                let table =document.getElementById('data-table');
                                let table_data = '';
                                let data = respond.data;
                                table.innerHTML = `
                                <caption>待辦事項</caption>
                                <thead>
                                    <tr>
                                        <th>id</th>
                                        <th>項目名稱</th>
                                        <th>描述</th>
                                        <th>截止日期</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td contenteditable='false'>${data.id}</td>
                                        <td contenteditable='false'>${data.title}</td>
                                        <td contenteditable='false'>${data.description}</td>
                                        <td contenteditable='false'>${data.due}</td>
                                    </tr>
                                </tbody>`;
                            }
                            else{
                                alert ("fail to get data");
                            }
                        });
                    }
                    else{
                        alert("Not found")
                    }
                })
                .catch(error => {
                    console.log("error", error);
                })
            }
            else if (action.textContent == "更新待辦事項"){
                let input_id =document.getElementById('input').value;
                todoListComponent.getData(parseInt(input_id))
                .then(res => {
                    if (res.status == "200"){
                        res.json().then(respond => {
                            if (respond.msg == "success"){
                                setWidgetVisible(true, false, true, true);
                                let table =document.getElementById('data-table');
                                let table_data = '';
                                let data = respond.data;
                                table.innerHTML = `
                                <caption>待辦事項</caption>
                                <thead>
                                    <tr>
                                        <th>id</th>
                                        <th>項目名稱</th>
                                        <th>描述</th>
                                        <th>截止日期</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td contenteditable='false'>${data.id}</td>
                                        <td contenteditable='true'>${data.title}</td>
                                        <td contenteditable='true'>${data.description}</td>
                                        <td contenteditable='true'>${data.due}</td>
                                    </tr>
                                </tbody>`;
                            }
                            else{
                                alert ("fail to get data");
                            }
                        });
                    }
                    else{
                        alert("Not found")
                    }
                })
                .catch(error => {
                    console.log("error", error);
                })
            }
            else if (action.textContent == "刪除待辦事項"){
                let input_id =document.getElementById('input').value;
                todoListComponent.deleteData(parseInt(input_id))
                .then(res => {
                    if(res.ok){
                        alert("刪除成功");
                    }
                })
                .catch(error => {
                    console.log(error);
                })

                
            }
        }

        function create_event(){
     
            let t_title =document.getElementById("t-title").value;
            let t_des =document.getElementById("t-des").value;
            let t_due =document.getElementById("t-due").value;

            if (t_title.trim() !== "" && t_des.trim() !== "" && t_due.trim() !== ""){
                data = {
                    "title" : t_title,
                    "description" :t_des,
                    "due" : t_due
                };
                console.log(data);
                todoListComponent.createData(data)
                .then(res => {
                    alert(res.msg);
                })
            }
            else{
                alert ("輸入不可為空")
            }
        }

        function update_data(){
            let table =document.getElementById("data-table");
            let items = table.querySelectorAll("td");
            let id = items[0].textContent;
            let title = items[1].textContent;
            let des = items[2].textContent;
            let due = items[3].textContent;

            let data = {
                "title":title,
                "description":des,
                "due":due
            };

            console.log(data);
            console.log("id" , id);

            todoListComponent.updateData(data, id)
            .then(res => {
                if (res.ok){
                    alert("更新成功");
                }
            })
            .catch(error => {
                console.log(error);
            });
        }


    </script>


    
    <div class="container" style="margin:20px;">
        <div class="row">
            <div class="col">
                <div class="input-group">
                    <div class="dropdown">
                        <button class="btn btn-secondary dropdown-toggle" type="button" id="action" data-bs-toggle="dropdown" aria-expanded="false">
                            Action
                        </button>
                        <ul class="dropdown-menu" aria-labelledby="action">
                            <li><a id="get-all" class="dropdown-item" href="#" onclick=doAction(event)>取得所有待辦事項</a></li>
                            <li><a id="get-single" class="dropdown-item" href="#" onclick=doAction(event)>根據 id 取得待辦事項</a></li>
                            <li><a id="create" class="dropdown-item" href="#" onclick=doAction(event)>新增待辦事項</a></li>
                            <li><a id="update" class="dropdown-item" href="#" onclick=doAction(event)>更新待辦事項</a></li>
                            <li><a id="delete" class="dropdown-item" href="#" onclick=doAction(event)>刪除待辦事項</a></li>
                        </ul>
                    </div>
                    <input class="form-control" type="text" id="input" visibility="hidden">
                    <button class="btn btn-primary" type="reset" id="input_bt" onclick="bt_event()">search</button>
                </div>
            </div>
        </div>
        <div class="row" style="margin-top:20px;" id="create-data">
            
            <div class="col">
                <div class="input-group">
                    <span class="input-group-text">項目名稱</span>
                    <input id="t-title" type="text" class="form-control" placeholder=""/>
                </div>
            </div>
            <div class="col">
                <div class="input-group">
                    <span class="input-group-text">描述</span>
                    <input id="t-des" type="text" class="form-control" placeholder=""/>
                </div>
            </div>
            <div class="col">
                <div class="input-group">
                    <span class="input-group-text">截止日期</span>
                    <input id="t-due" type="text" class="form-control" placeholder=""/>
                </div>
            </div>
            <div class="col">
                <button id="create-bt" class="btn btn-primary" onclick="create_event()">新增</button>
            </div>
        </div>

        <!-- data table  -->
        <div class="row" style="margin-top:20px;" id="todolist-table">
            <div class="col">
                <table id="data-table" class='table caption-top table-light table_font table-hover table-bordered table-striped'>
                    
                </table>
            </div>
        </div>
        <div class="row">
            <div class="col">
                <button type="button" id="update-bt" class="btn btn-primary" onclick="update_data()">更新</button>
            </div>
        </div>
    </div>

    <script>
        setWidgetVisible(false, false, false);
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