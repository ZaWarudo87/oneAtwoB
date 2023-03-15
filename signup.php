<?php
session_start();
?>
<!DOCTYPE html>
<head>
    <title>1A2B - Sign Up</title>
    <meta charset="utf-8">
    <link rel="stylesheet" href="style.css">
    <style></style>
    <script type='text/javascript'>
        function clea(){
            if(window.confirm("確定要清除全部格子嗎？")){
                document.getElementById('nickname').value = "";
                document.getElementById('account').value = "";
                document.getElementById('password').value = "";
                document.getElementById('checkpw').value = "";
            }
        }
        function subm(){
            var spec = /\\|\/|:|\*|\?|\"|\'|\<|\>|\|/;
            var n = document.getElementById('nickname').value;
            var a = document.getElementById('account').value;
            var p = document.getElementById('password').value;
            if(n.length <= 0 || n.length > 20 || spec.test(n)){
                window.alert("無法使用此暱稱！");
                return;
            }
            if(!/@/.test(a) || spec.test(a)){
                window.alert("請輸入有效電子郵件！");
                return;
            }
            if(p.length < 6 || p.length > 20 || spec.test(p)){
                window.alert("密碼不符合規則！");
                return;
            }
            if(p != document.getElementById('checkpw').value){
                window.alert("密碼與確認密碼不同！");
                return;
            }
            document.signup.submit();
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
        <h2>註冊帳號</h2>
        <hr>
        <form method="post" action="signup.php" name="signup">
            <t>暱稱：</t><input type="text" id="nickname" name="nickname" placeholder="20字以內，可包含大小寫英數字、底線" onkeypress="keyCheck(event);"><br>
            <t>電子郵件：</t><input type="text" id="account" name="account" onkeypress="keyCheck(event);"><br>
            <t>密碼：</t><input type="password" id="password" name="password" placeholder="6~20位，可包含大小寫英數字、底線" onkeypress="keyCheck(event);"><br>
            <t>確認密碼：</t><input type="password" id="checkpw" onkeypress="keyCheck(event);"><br>
            <input type="button" class="button" value="註冊" onclick="subm();">
            <input type="button" class="button" value="清除" onclick="clea();">
            <input type="button" class="button" value="取消" onclick="window.location.assign('index.php');">
        </form>
    </section>
    <?php
        if(isset($_SESSION['login'])){
            echo "<script>window.location.assign('index.php');</script>";
        }
        if(isset($_POST['nickname'])){
            require_once "connect.php";
            
            if(mysqli_num_rows(mysqli_query($conn, "SELECT * FROM accounts WHERE account=\"{$_POST['account']}\" AND password=\"{$_POST['password']}\"")) > 0){
                echo "<script>window.alert('此帳號已被註冊！');</script>";
            }else{
                mysqli_query($conn, "INSERT INTO accounts(nickname, account, password, message, best, average, rate, detail) VALUES (\"{$_POST['nickname']}\", \"{$_POST['account']}\", \"{$_POST['password']}\", '', 0, 0, 0, '{}')");
                if(mysqli_error($conn)){
                    echo "<script>window.alert('註冊失敗\n');</script>";
                    echo mysqli_error($conn);
                }else{
                    echo "<script>window.alert('註冊成功！\n即將自動登入');</script>";
                    $_SESSION['login'] = $_POST['nickname'];
                    echo "<script>window.location.assign('index.php');</script>";
                }
            }
        }
    ?>
    <footer>© Copyright&nbsp<a>奇奇怪怪的網站</a> - <a href="index.php">1A2B</a>&nbspSince 2023</footer>
</body>