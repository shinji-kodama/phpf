<p class="bro" style="border-bottom:brown 1px solid">Message</p>

<?php 
    if($friend_flg!=1){
        include('not_friend.html');
    }else{
        include('msg_ajax.html');
    }
?>
