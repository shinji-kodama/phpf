<p class="bro" style="border-bottom:brown 1px solid;">Profile</p>
<div style="display:flex;justify-content:center;">
    <div style="width:150px;flex-shrink:0;">

        <p class="bro" style="text-align:left">Name</p>
        <p class="bro" style="text-align:left">Address</p>
        <p class="bro" style="text-align:left">Age</p>
        <p class="bro" style="text-align:left">Favorite Book</p>
        <p class="bro" style="text-align:left">Favorite Author</p>
        <p class="bro" style="text-align:left">self introduction</p>
    </div>
    <div>
        <p class="bro">：</p>
        <p class="bro">：</p>
        <p class="bro">：</p>
        <p class="bro">：</p>
        <p class="bro">：</p>
        <p class="bro">：</p>
    </div>
    <div>
        <p class="bro" style="text-align:left">　<?=h($res['name'])?></p>
        <p class="bro" style="text-align:left">　<?=h($res['address'])?></p>
        <p class="bro" style="text-align:left">　<?=h($res['age'])?></p>
        <p class="bro" style="text-align:left">　<?=h($res['no1book'])?></p>
        <p class="bro" style="text-align:left">　<?=h($res['fav_author'])?></p>
        <p class="bro" style="text-align:left;white-space:pre-wrap;margin-left:16px"><?=h($res['intro'])?></p>
    </div>
</div>

