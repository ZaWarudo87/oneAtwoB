<!DOCTYPE html>
<head>
    <title>1A2B - Profile</title>
    <meta charset="utf-8">
    <link rel="stylesheet" href="style.css">
    <style></style>
    <script type='text/javascript'>
        function logout(){
            if(window.confirm("確定要登出嗎？")){
                window.location.assign("logout.php");
            }
        }
        function erro(){
            window.alert("帳號遺失。");
            window.location.assign('index.php');
        }
        function modify(){
            document.getElementById('nickname').disabled = false;
            document.getElementById('message').disabled = false;
            document.getElementById('can').style = "display: inline;";
            document.getElementById('cant').style = "display: none;";
        }
        function cance(){
            if(window.confirm("確定要取消修改嗎？")){
                window.location.assign("setting.php");
            }
        }
        function subm(){
            var spec = /\\|\/|:|\*|\?|\"|\'|\<|\>|\|/;
            var n = document.getElementById('nickname').value;
            var m = document.getElementById('message').value;
            if(n.length <= 0 || n.length > 20 || spec.test(n)){
                window.alert("無法使用此暱稱！");
                return;
            }
            if(m.length > 100 || spec.test(m)){
                window.alert("請勿使用特殊符號、過多文字！");
                return;
            }
            if(window.confirm("確定要修改資料嗎？")){
                document.ok.submit();
            }
        }
        function keyCheck(e){
            if(e.keyCode == 13){
                subm();
            }
        };
        function dele(){
            if(window.confirm("確定要「永久刪除」帳號嗎？！")){
                window.location.assign("deleteAccount.php");
            }
        }
    </script>
</head>
<body>
    <header>
        <input type="button" value="1A2B" class="title" onclick="window.location.assign('index.php');">
        <div class="hd">
            <input type="button" value="排行榜" class="hb" onclick="window.location.assign('rank.php');">
            <?php
            session_start();
            if(isset($_SESSION['login'])){
                echo "<input type='button' value=\"帳號：{$_SESSION['login']}\" class='hb' onclick='window.location.assign(\"setting.php\");'>";
            }else{
                echo "<script>window.location.assign('index.php');</script>";
            }
            ?>
            <input type='button' value='登出' class='hb' onclick='logout();'>
        </div>
    </header>
    <section>
        <h2>帳號資訊</h2>
        <hr>
        <?php
            require_once "connect.php";

            if(isset($_POST['nickname'])){
                mysqli_query($conn, "UPDATE accounts SET nickname=\"{$_POST['nickname']}\", message=\"{$_POST['message']}\" WHERE nickname=\"{$_SESSION['login']}\"");
                if(mysqli_error($conn)){
                    echo "<script>window.alert('修改失敗\n');</script>";
                    echo mysqli_error($conn);
                }else{
                    echo "<script>window.alert('修改成功！');</script>";
                    $_SESSION['login'] = $_POST['nickname'];
                    echo "<script>window.location.assign('setting.php');</script>";
                }
            }

            $result = mysqli_query($conn, "SELECT * FROM accounts WHERE nickname=\"{$_SESSION['login']}\"");
            if(mysqli_num_rows($result) > 0){
                $fetch = mysqli_fetch_array($result);
                echo "
                <p>你的最佳紀錄：{$fetch['best']}次</p>
                <p>你的平均次數：{$fetch['average']}次</p>
                <hr>
                <form method='post' action='setting.php' name='ok'>
                    <t>暱稱：</t><input type='text' name='nickname' id='nickname' value=\"{$fetch['nickname']}\" disabled='true' onkeypress='keyCheck(event);'><br>
                    <t>留言：</t><input type='text' name='message' id='message' placeholder='尚未留言...' value=\"{$fetch['message']}\" disabled='true' onkeypress='keyCheck(event);'><br>
                    <span id='can' style='display: none;'>
                        <input type='button' id='sub' value='送出修改' class='button' onclick='subm();'>
                        <input type='button' id='canc' value='取消' class='button' onclick='cance();'>
                    </span>
                </form>
                ";
            }else{
                echo "<script>erro();</script>";
            }
        ?>
        <span id='cant' style='display: inline;'>
            <input type="button" id="modify" value="修改資料" class="button" onclick="modify();">
            <input type="button" id="dele" value="刪除帳號" class="button" onclick="dele();">
        </span>
    </section>
    <footer>© Copyright&nbsp<a>奇奇怪怪的網站</a> - <a href="index.php">1A2B</a>&nbspSince 2023</footer>
</body>