<?php
session_start();

    if( ($_SESSION["role"] == "3") or empty($_SESSION) ){
         header("Location: /error404/");
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <form >
    <input type="text" name="name" placeholder="Name">
    <input type="text" name="surname" placeholder="Surname">
    <!-- <select name="lang" class="slct">
        <option value="ru">Русский</option>
        <option value="ua">Українська</option>
        <option value="en">English</option>
        <option value="it">Italiano</option>
    </select> -->
    <input type="text" name="lang" placeholder="Language">
    <input type="button" id="send" value="Search">
    </form>
    <table>
        <tr>
            <th>ID</th>
            <th>Login</th>
            <th>Name</th>
            <th>Surname</th>
            <th>Language</th>
            <th>Role</th>
        </tr>
        <tbody id="data">
        
        </tbody>
    </table>
</body>
<script type="text/javascript">
    
    var method = 'POST';
    var url = 'data.php';

    window.onload = function() {
        var inp_name = document.querySelector('input[name=name]');
        var inp_surname = document.querySelector('input[name=surname]');
        var inp_lang = document.querySelector('input[name=lang]');
        // var inp_lang = document.querySelector('input[name=lang]');
    
        document.querySelector('#send').onclick = function() {
            var params = 'name=' + inp_name.value + '&' + 'surname=' + inp_surname.value +
            '&' + 'lang=' + inp_lang.value;
            ajaxPost(params);
        }
    }
    
    function ajaxPost(params) {
        var request = new XMLHttpRequest();
        request.onreadystatechange = function()  {
            if (request.readyState == 4 && this.status == 200) {

                var data = JSON.parse(this.responseText);
                console.log(data);
                var html = "";
                if(data.length == 0){
                    alert("Sorry, no data found!");
                }
                for (var i = 0; i < data.length; i++){

                    var id = data[i].id;
                    var login = data[i].login;
                    var name = data[i].name;
                    var surname = data[i].surname;
                    var lang = data[i].lang;
                    var role = data[i].role;

                    html += "<tr>"
                    html += "<td>" + id + "</td>";
                    html += "<td>" + login + "</td>";
                    html += "<td>" + name + "</td>";
                    html += "<td>" + surname+ "</td>";
                    html += "<td>" + lang + "</td>";
                    html += "<td>" + role + "</td>";
                    html += "</tr>";
                }
                document.getElementById("data").innerHTML = html;
            }
        }
       
        request.open(method,url);
        request.setRequestHeader('Content-Type','application/x-www-form-urlencoded');
        request.send(params);
    }
</script>
</html>