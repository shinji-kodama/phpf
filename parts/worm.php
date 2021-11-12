<?php

//1.  DB接続します
$pdo = db_conn();

//２．自分から相手への友達申請状況を確認
$sql="SELECT friend_flg
FROM friend_table
WHERE name_send=:name AND name_recieve=:worm";
$stmt = $pdo->prepare($sql);
$stmt->bindValue(':name', $name);
$stmt->bindValue(':worm', $worm);
$status = $stmt->execute();

//３．データをfriend_flgに格納

if($status==false) {
  sql_error($stmt);
}else{
    $res2 = $stmt->fetch();
    $friend_flg = $res2['friend_flg'];
}


//４．相手から自分への友達申請状況も確認
$sql="SELECT friend_flg
FROM friend_table
WHERE name_send=:worm AND name_recieve=:name";
$stmt = $pdo->prepare($sql);
$stmt->bindValue(':name', $name);
$stmt->bindValue(':worm', $worm);
$status = $stmt->execute();

if($status==false) {
    sql_error($stmt);
}else{
    $res2 = $stmt->fetch();
    if(isset($res2['friend_flg'])){
        $from_worm = 0;
    };
}


if($name==$worm){
    $disp = "log_out";
}else{
    if(!isset($friend_flg)){
        if($from_worm===0){
            $disp= "☆友達になる";
        }else{
            $disp = "☆友達申請";
        }
    }else if($friend_flg==1){
        $disp = "🌟友達です";
        $style_f = ' style="background:red"'; 
    }else if($friend_flg==0){
        $disp = "🌟申請済";
    }
}


// messageとEdit
if($name==$worm){
    $item4 = 'Prof_Edit';
}else{
    $item4 = 'Message';
}

?>



<div class="row">
    <div class="col-sm-12" style="width:auto;height:auto;position:relative;padding:0;">
        <img id="photo_bg" src="<?=h($img_bg)?>" alt="" style="width:100%;height:auto;border-radius:0px;">
        <div style="position:absolute;height:150px;width:150px;bottom:-20px;left:24px;">
            <img id="photo_fc" src="<?=h($img)?>" alt="" style="border-radius:50%;width:100%;height:100%;border:solid white 2px;z-index:9999;">
        </div>
    </div>
</div>
<div class="row bro" style="z-index:0;">
    <div class="col-sm-12" style="position:relative">
        <p id="worm_name" style="font-size:24px;">NAME</p>
        <div id="fav_btn" class="lbro abs hov" style="cursor: pointer;position:absolute;top:50%;transform:translateY(-50%);right:16px;border-radius:8px;width:100px;height:24px;">
            <p id="favorite"<?=h($style_f)?>><?=h($disp)?></p>
        </div>
    </div>
</div>
<div class="row bro">
    <div class="col-sm-3 bdr hov">
        <p id="book">BookShelf</p>
    </div>
    <div id="prof" class="col-sm-3 bdr hov">
        <p>Profile</p>
    </div>
    <div id="rev" class="col-sm-3 bdr hov">
        <p>Reviews</p>
    </div>    
    <div id="msg" class="col-sm-3 hov">
        <p><?=$item4?></p>
    </div>    
</div>
<div id="">
    <?php
    if(!isset($page)){
        include('bookshelf.html');
    }else if($page == 'prof'){
        include('prof.php');
    }else if($page == 'rev'){
        include('review.html');
    }else if($page == 'msg'){
        if($worm==$name){
            include('prof_edit.php');
        }else{
            include('msg.php');
        }   
    }
    ?>
</div>


<script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
    <script>
       let from_worm = '<?php echo $from_worm; ?>'

        // 個別ページ内の項目をクリックイベントで表示
        const book_btn = document.getElementById('book');
        const prof_btn = document.getElementById('prof');
        const rev_btn  = document.getElementById('rev');
        const msg_btn  = document.getElementById('msg');

        book_btn.addEventListener('click',function(){
            location.href = "worms.php?worm="+worm+"";
        });
        prof_btn.addEventListener('click',function(){
            location.href = "worms.php?worm="+worm+"&page=prof";
        });
        rev_btn.addEventListener('click',function(){
            location.href = "worms.php?worm="+worm+"&page=rev";
        });
        msg_btn.addEventListener('click',function(){
            location.href = "worms.php?worm="+worm+"&page=msg";
        });
        


        

        //ここからAJAX処理(友達申請)
        const favorite = document.getElementById('favorite');
        
        favorite.addEventListener('click',function(){
            let term = favorite.innerHTML;
            let f_flg;
            if(term.indexOf('友達です')!==-1){       //友達
                f_flg = 1; 
            }else if(term.indexOf('☆友達')!==-1){   //未申請
                if(from_worm==='0'){
                    f_flg = 3;                      //相手から申請されてる
                }else{
                    f_flg = 2;                      //相手からも申請されてない
                }
            }else if(term.indexOf('申請')!==-1){                                  //申請済
                f_flg = 0;
            }else if(term=='log_out'){
                location.href = 'logout.php';
            }
            console.log(f_flg);
            const data_worm = {
                worm:worm,
                name:name,
                f_flg:f_flg
            }

            //Ajax（非同期通信）
            axios.get('parts/f_worm.php', {
                params:data_worm
            })
            .then(function (response) {
                document.querySelector("#favorite").innerHTML=response.data;
            }).catch(function (error) {
                console.log(error);//通信Error
            }).then(function () {
                console.log("Last");//通信OK/Error後に処理を必ずさせたい場合
            });

        })




        // alert(worm);
        const name_place = document.getElementById('worm_name');
        name_place.innerHTML = worm;

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