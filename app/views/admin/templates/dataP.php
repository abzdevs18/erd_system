
<?php foreach($data['place'] AS $place) : ?>
<div style="width:100%;height:200px;background:url('<?=URL_ROOT;?>/img/places/<?=$place->place_img?>');background-size:cover;">
</div>
<div class="places-preview">
    <h2><?=$place->name?></h2>
    <span><?=$place->address?></span>
</div>
<?php endforeach; ?>