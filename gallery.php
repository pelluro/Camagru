<?php
$pictures=$dbConnector->getPictures();
?>
<div class="panel panel-warning">
    <div class="panel-heading">Gallery</div>
    <div class="panel-body">
        <?php
        if($pictures == null)
        {
            echo "No picture in Gallery";
        }
        else {
            foreach ($pictures as $picture) {
                ?>
                <a href="photos.php?id=<?=$picture->getID();?>">
                <img src="./img/<?= $picture->filename ?>" width="80" height="80"/>
                </a>
                <?php
            }
        }
        ?>
    </div>
</div>