<?php
session_start();
?>
<!DOCTYPE html>
<head>
    <title>1A2B</title>
    <meta charset="utf-8">
    <link rel="stylesheet" href="style.css">
    <style></style>
    <script type='text/javascript'>
        var data = {};
        var theAns = "";
        var rou = 0;
    
        function randAns(){
            theAns = "";
            for(var i = 0; i < 4; i++){
                theAns += Math.floor(Math.random() * 10).toString();
            }
        }
        function reseto(win){
            if(win){
                window.alert('答對了，恭喜！遊戲結束。');
                document.getElementById('round').value = rou;
                document.gg.submit();
            }else{
                if(window.confirm("確定要提前結束遊戲嗎？\n提前結束的話，將計入失敗場次。")){
                    window.alert(`遊戲結束。答案是 ${theAns}`);
                    document.getElementById('round').value = 0;
                    document.gg.submit();
                }
            }
            rou = 0;
            randAns();
        }
        function logout(){
            if(window.confirm("確定要登出嗎？")){
                window.location.assign("logout.php");
            }
        }
        function entered(){
            var inAns = document.getElementById('ans').value;
            var ediAns = theAns;
            var reg = /\d{4}/;
            var a = 0, b = 0;
            if(reg.exec(inAns) != inAns){
                console.log(reg.exec(inAns));
                window.alert("請輸入四位數！");
                return;
            }
            for(var i = 0; i < 4; i++){
                if(inAns[i] == theAns[i]){
                    a++;
                }
            }
            for(var i = 0; i < 4; i++){
                for(var j = 0; j < 4; j++){
                    if(inAns[i] == ediAns[j]){
                        b++;
                        inAns = inAns.slice(0, i) + 'a' + inAns.slice(i+1, 5);
                        ediAns = ediAns.slice(0, j) + 'b' + ediAns.slice(j+1, 5);
                    }
                }
            }
            b -= a;
            document.getElementById('histo').innerHTML += `${++rou}| ${document.getElementById('ans').value} -&gt ${a}A${b}B<br>`;
            if(a == 4){
                reseto(1);
            }
            document.getElementById('ans').value = "";
        }
        function keyCheck(e){
            if(e.keyCode == 13){
                entered();
            }
        };

        randAns();
    </script>
</head>
<body>
    <header>
        <input type="button" value="1A2B" class="title" onclick="window.location.assign('index.php');">
        <div class="hd">
            <input type="button" value="排行榜" class="hb" onclick="window.location.assign('rank.php');">
            <?php
            if(isset($_SESSION['login'])){
                echo "
                <input type='button' value=\"帳號：{$_SESSION['login']}\" class='hb' onclick='window.location.assign(\"setting.php\");'>
                <input type='button' value='登出' class='hb' onclick='logout();'>
                ";
                if(isset($_POST['round'])){
                    require_once "connect.php";
                    $theV = intval($_POST['round']);

                    $result = mysqli_query($conn, "SELECT * FROM accounts WHERE nickname=\"{$_SESSION['login']}\"");
                    if(mysqli_num_rows($result) == 1){
                        $fetch = mysqli_fetch_array($result);

                        $best = $fetch['best'];
                        if($best == 0 || $theV > 0 && $theV < $best){
                            mysqli_query($conn, "UPDATE accounts SET best={$theV} WHERE nickname=\"{$_SESSION['login']}\"");
                        }
                        $detail = json_decode($fetch['detail'], true);
                        $len = 0;
                        $average = 0;
                        $rate = 0;
                        foreach($detail as $k => $v){
                            $len++;
                            $v = intval($v);
                            if($v > 0){
                                $average += $v;
                            }else{
                                $rate--;
                            }
                        }
                        if($theV > 0){
                            $average += $theV;
                        }else{
                            $rate--;
                        }
                        $detail[$len] = $theV;
                        $len++;
                        $rate += $len;
                        $average /= $rate;
                        $average = number_format($average, 2);
                        $rate /= $len;
                        $rate = number_format($rate, 2);
                        $detailE =json_encode($detail, JSON_FORCE_OBJECT);
                        mysqli_query($conn, "UPDATE accounts SET detail='{$detailE}' WHERE nickname=\"{$_SESSION['login']}\"");
                        echo mysqli_error($conn);
                        mysqli_query($conn, "UPDATE accounts SET average={$average} WHERE nickname=\"{$_SESSION['login']}\"");
                        mysqli_query($conn, "UPDATE accounts SET rate={$rate} WHERE nickname=\"{$_SESSION['login']}\"");
                        
                        echo "<script>window.alert('遊戲紀錄儲存成功！');</script>";
                    }else{
                        echo "<script>window.alert('此帳號已遺失，無法儲存遊戲資料...');</script>";
                    }
                    echo "<script>window.location.assign('index.php');</script>";
                }
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
        <?php
        if(!isset($_SESSION['login'])){
            echo "<p>系統提示：登入以保存遊戲進度。</p>";
        }
        ?>
        <p>
            遊戲規則：<br>
            猜中答案的4位數即可獲勝。<br>
            答案4個數字為0~9，可能重複。<br>
            猜測的答案中，數字位置與值皆對為A，只有值有出現但位置錯誤為B。
        </p>
        <div class="canv">
            <t id="histo">
            </t>
            <span>
                <t>請輸入4位數：</t>
                <input type="text" id="ans" class="inputText" onkeypress="keyCheck(event);">
                <input type="button" class="button" value="送出" onclick="entered();">
                <input type="button" class="button" value="重新開始" onclick="reseto(0);">
            </span>
        </div>
        <form method="post" action="index.php" name="gg">
            <input type="hidden" name="round" id="round" value="">
        </form>
    </section>
    <footer>© Copyright&nbsp<a>奇奇怪怪的網站</a> - <a href="index.php">1A2B</a>&nbspSince 2023</footer>
</body>