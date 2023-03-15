<?php
session_start();
?>
<!DOCTYPE html>
<head>
    <title>1A2B - Log In</title>
    <meta charset="utf-8">
    <link rel="stylesheet" href="style.css">
    <style></style>
    <script type='text/javascript'>
        function clea(){
            if(window.confirm("確定要清除全部格子嗎？")){
                document.getElementById('account').value = "";
                document.getElementById('password').value = "";
            }
        }
        function subm(){
            var spec = /\\|\/|:|\*|\?|\"|\'|\<|\>|\|/;
            var a = document.getElementById('account').value;
            var p = document.getElementById('password').value;
            if(!/@/.test(a) || spec.test(a)){
                window.alert("請輸入有效電子郵件！");
                return;
            }
            if(p.length < 6 || p.length > 20 || spec.test(p)){
                window.alert("無效密碼！");
                return;
            }
            document.login.submit();
        }
        function keyCheck(e){
            if(e.keyCode == 13){
                subm();
            }
        };
    </script>
</head>
<body>
    <header>
        <input type="button" value="1A2B" class="title" onclick="window.location.assign('index.php');">
    </header>
    <section>
        <h2>登入</h2>
        <hr>
        <form method="post" action="login.php" name="login">
            <t>電子郵件：</t><input type="text" id="account" name="account" onkeypress="keyCheck(event);"><br>
            <t>密碼：</t><input type="password" id="password" name="password" onkeypress="keyCheck(event);"><br>
            <input type="hidden" id="mode" name="mode">
            <input type="button" class="button" value="登入" onclick="subm();">
            <input type="button" class="button" value="清除" onclick="clea();">
            <input type="button" class="button" value="取消" onclick="window.location.assign('index.php');">
        </form>
    </section>
    <?php
        if(isset($_SESSION['login'])){
            echo "<script>window.location.assign('index.php');</script>";
        }
        if(isset($_POST['account'])){
            require_once "connect.php";
            
            $result = mysqli_query($conn, "SELECT * FROM accounts WHERE account=\"{$_POST['account']}\" AND password=\"{$_POST['password']}\"");
            if(mysqli_num_rows($result) == 1){
                $_SESSION['login'] = mysqli_fetch_array($result)['nickname'];
                echo "<script>window.location.assign('index.php');</script>";
            }else{
                echo "<script>window.alert('帳號密碼錯誤！');</script>";
            }
        }
    ?>
    <footer>© Copyright&nbsp<a>奇奇怪怪的網站</a> - <a href="index.php">1A2B</a>&nbspSince 2023</footer>
</body>