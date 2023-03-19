<!DOCTYPE html>
<head>
    <title>1A2B - Leaderboard</title>
    <meta charset="utf-8">
    <link rel="stylesheet" href="style.css">
    <style></style>
    <script type='text/javascript'>
        var data = [];
    
        function disp(mode){
            document.getElementById('mo').innerHTML = (mode == 1 ? "最佳紀錄" : "平均次數");

            var len = data.length;
            data.sort(function(a, b){
                return (a[mode] == b[mode] ? b[2] - a[2] : a[mode] - b[mode]);
            });

            for(var i = 0; i < len; i++){
                document.getElementById(`${i}x`).innerHTML = i+1;
                for(var j = 0; j < 4; j++){
                    document.getElementById(`${i}x${j}y`).innerHTML = data[i][(j == 1 ? mode : j)];
                }
            }
        }
        function logout(){
            if(window.confirm("確定要登出嗎？")){
                window.location.assign("logout.php");
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
                echo "
                <input type='button' value=\"帳號：{$_SESSION['login']}\" class='hb' onclick='window.location.assign(\"setting.php\");'>
                <input type='button' value='登出' class='hb' onclick='logout();'>
                ";
            }else{
                echo "
                <input type='button' value='註冊' class='hb' onclick='window.location.assign(\"signup.php\");'>
                <input type='button' value='登入' class='hb' onclick='window.location.assign(\"login.php\");'>
                ";
            }
            ?>
        </div>
    </header>
    <section>
        <span>
            <h2>排行榜</h2>
            <t>比序方式：</t>
            <input type="button" id="bestB" class="button" value="最佳紀錄" onclick="disp(1);">
            <input type="button" id="averB" class="button" value="平均次數" onclick="disp(4);">
        </span>
        <hr>
        <?php
            require_once "connect.php";

            $result = mysqli_query($conn, "SELECT * FROM accounts WHERE best > 0");
            if(mysqli_num_rows($result) > 0){
                echo "
                <table>
                    <thead>
                        <tr>
                            <td>排名</td>
                            <td>玩家</td>
                            <td id='mo'>成績</td>
                            <td>勝率</td>
                            <td>留言</td>
                        </tr>
                    </thead>
                    <tbody>
                ";
                $rank = 0;
                while($rows = mysqli_fetch_array($result)){
                    echo "
                    <script>
                        data[{$rank}] = [\"{$rows['nickname']}\", {$rows['best']}, {$rows['rate']}, \"{$rows['message']}\", {$rows['average']}];
                    </script>

                    <tr>
                        <td id='{$rank}x'></td>
                        <td id='{$rank}x0y'></td>
                        <td id='{$rank}x1y'></td>
                        <td id='{$rank}x2y'></td>
                        <td id='{$rank}x3y'></td>
                    </tr>
                    ";
                    $rank++;
                }
                echo "
                    </tbody>
                </table>

                <script>
                    disp(1);
                </script>
                ";
            }else{
                echo "<p>無資料。</p>";
            }
        ?>
    </section>
    <footer>© Copyright&nbsp<a>奇奇怪怪的網站</a> - <a href="index.php">1A2B</a>&nbspSince 2023</footer>
</body>