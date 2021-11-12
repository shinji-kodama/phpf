<?php
session_start();

// include('../funcs.php');
$name = $_SESSION['name'];

//1.  DB接続します
$pdo = db_conn();

$sql = "SELECT t1.com_name, t1.com_icon
FROM community_table AS t1
LEFT JOIN com_usr_table AS t2 ON t1.com_name = t2.com_name
WHERE t2.com_usr_name = :name";

$stmt = $pdo->prepare($sql);
$stmt->bindValue(':name', $name, PDO::PARAM_STR);
$status = $stmt->execute();

if($status==false) {
    sql_error($stmt);
}else{

    while( $r = $stmt->fetch(PDO::FETCH_ASSOC)){
        $c_name = h($r['com_name']);
        $c_icon = h($r['com_icon']);
        
        $view .= <<<EOF
        <a href="communities.php?comm={$c_name}">
            <div style="width:100%;display:flex;justify-content:strech;margin:8px;">
                <div style="width:50px;height:50px;flex-shrink: 0;">
                    <img style="width:100%;height:100%;border-radius:50%;" src="{$c_icon}">
                </div>
                <div>
                    <p style="width;auto;color:brown;font-size:14px;text-align:center;padding-top:15px;">{$c_name}</p>
                </div>
            </div>
        </a>

        EOF;
    }
}

?>




<style>
</style>

    <p class="bro"><br>Communities</p>
    <div style="width:100%;margin:8px auto;border:solid brown 1px;">
        <p class="bro"></p>
        <div id="recm_comm" class="">
            <?=$view?>
        </div>
    </div>
    
    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
    <script>
        // const data = {
        //     name:name
        // }

        // //Ajax（非同期通信）
        // axios.get('parts/recm_comm.php', {
        //     params:data
        // })
        // .then(function (response) {
        //     document.querySelector("#recm_worm").innerHTML=response.data;
        // }).catch(function (error) {
        //     console.log(error);//通信Error
        // }).then(function () {
        //     console.log("Last");//通信OK/Error後に処理を必ずさせたい場合
        // });
    
    </script>