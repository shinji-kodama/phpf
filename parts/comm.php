<?php
session_start();
$c_name = $_GET['comm'];
$name = $_SESSION['name'];

if(isset($_GET['thread'])){
    $thread = $_GET['thread'];
}

//1.  DB接続します
$pdo = db_conn();

//２．コミュニティの基本情報を取得（表示用）
$sql="SELECT tc.com_name, tc.com_icon, tc.com_img, tc.com_intro
FROM community_table AS tc
WHERE com_name=:c_name";
$stmt = $pdo->prepare($sql);
$stmt->bindValue(':c_name', $c_name);
$status = $stmt->execute();

//３. 表示用の変数を整理

if($status==false) {
  sql_error($stmt);
}else{
    $r2 = $stmt->fetch();
    $c_icon = $r2['com_icon'];
    $c_img = $r2['com_img'];
    $c_intro = $r2['com_intro'];
}


//４．コミュニティへの参加状況を取得
$sql="SELECT com_name, com_usr_name
FROM com_usr_table
WHERE com_name=:c_name AND com_usr_name=:name";
$stmt = $pdo->prepare($sql);
$stmt->bindValue(':c_name', $c_name);
$stmt->bindValue(':name', $name);
$status = $stmt->execute();

if($status==false) {
    sql_error($stmt);
}else{
    $r3 = $stmt->fetch();
    if($r3){
        $join_flg = 1;
        $disp = '🌟JOINED';
    }else{
        $join_flg=0;
        $disp = '☆JOIN';
    }
}


// if($name==$worm){
//     $disp = "log_out";
// }else{
//     if(!isset($friend_flg)){
//         if($from_worm===0){
//             $disp= "☆友達になる";
//         }else{
//             $disp = "☆友達申請";
//         }
//     }else if($friend_flg==1){
//         $disp = "🌟友達です";
//         $style_f = ' style="background:red"'; 
//     }else if($friend_flg==0){
//         $disp = "🌟申請済";
//     }
// }


// // messageとEdit
// if($name==$worm){
//     $item4 = 'Prof_Edit';
// }else{
//     $item4 = 'Message';
// }

?>



<div class="row">
    <div class="col-sm-12" style="width:auto;height:auto;position:relative;padding:0;">
        <img id="photo_bg" src="<?=h($c_img)?>" alt="" style="width:100%;height:auto;border-radius:0px;">
        <div style="position:absolute;height:150px;width:150px;bottom:-20px;left:24px;">
            <img id="photo_fc" src="<?=h($c_icon)?>" alt="" style="border-radius:50%;width:100%;height:100%;border:solid white 2px;z-index:9999;">
        </div>
    </div>
</div>
<div class="row bro" style="z-index:0;">
    <div class="col-sm-12" style="position:relative">
        <p id="c_name" style="font-size:24px;"><?=h($c_name)?></p>
        <div id="join_btn" class="lbro abs hov" style="cursor: pointer;position:absolute;top:50%;transform:translateY(-50%);right:16px;border-radius:8px;width:100px;height:24px;">
            <p id="c_join"><?=h($disp)?></p>
        </div>
    </div>
    <p><?=$c_intro?></p>
</div>
<div class="row bro">
    <div class="col-sm-3 bdr hov">
        <p id="c_top">community Top</p>
    </div>
    <div id="c_book" class="col-sm-3 bdr hov">
        <p>recommend books</p>
    </div>
    <div id="c_member" class="col-sm-3 bdr hov">
        <p>Member</p>
    </div>    
    <div id="v_chat" class="col-sm-3 hov">
        <p>Voice chat</p>
    </div>    
</div>
<div id="include">
    <?php
    if(!isset($page)){
        if(isset($thread)){
            include('c_thread.php');
        }else{
            include('c_top.php');
        }
    }else if($page == 'book'){
        include('c_book.php');
    }else if($page == 'member'){
        include('c_member.php');
    }else if($page == 'chat'){
        include('v_chat.php');
    }   
    ?>
</div>


<script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
    <script>
        let c_name = '<?php echo h($c_name); ?>'
        let u_name = '<?php echo h($name); ?>'

        // 個別ページ内の項目をクリックイベントで表示
        const top_btn = document.getElementById('c_top');
        const book_btn = document.getElementById('c_book');
        const member_btn  = document.getElementById('c_member');
        const chat_btn  = document.getElementById('v_chat');

        top_btn.addEventListener('click',function(){
            location.href = "communities.php?comm="+c_name+"";
        });
        book_btn.addEventListener('click',function(){
            location.href = "communities.php?comm="+c_name+"&page=book";
        });
        member_btn.addEventListener('click',function(){
            location.href = "communities.php?comm="+c_name+"&page=member";
        });
        chat_btn.addEventListener('click',function(){
            location.href = "communities.php?comm="+c_name+"&page=chat";
        });
        


        

        //ここからAJAX処理(友達申請)
        const c_join = document.getElementById('c_join');
        
        c_join.addEventListener('click',function(){
            let term = c_join.innerHTML;
            let join_flg;
            if(term.indexOf('JOINED')!==-1){       //参加済み
                join_flg = 1; 
            }else if(term.indexOf('☆JOIN')!==-1){   //未参加
                join_flg = 0;
            }
            console.log(join_flg);
            const data_c_join = {
                comm:c_name,
                name:u_name,
                join_flg:join_flg
            }

            //Ajax（非同期通信）
            axios.get('parts/com_join.php', {
                params:data_c_join
            })
            .then(function (response) {
                document.querySelector("#c_join").innerHTML=response.data;
            }).catch(function (error) {
                console.log(error);//通信Error
            }).then(function () {
                console.log("Last");//通信OK/Error後に処理を必ずさせたい場合
            });

        })




        // // alert(worm);
        // const name_place = document.getElementById('worm_name');
        // name_place.innerHTML = worm;

        // const data_worm = {
        //     worm:worm,
        //     name:name
        // }

        // //Ajax（非同期通信）
        // axios.get('parts/home.php', {
        //     params:data
        // })
        // .then(function (response) {
        //     document.querySelector("#main").innerHTML=response.data;
        // }).catch(function (error) {
        //     console.log(error);//通信Error
        // }).then(function () {
        //     console.log("Last");//通信OK/Error後に処理を必ずさせたい場合
        // });
    
    </script>