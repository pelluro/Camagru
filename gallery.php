<?php
$pictures=$dbConnector->getPictures();
?>
<div class="panel panel-warning">
    <div class="panel-heading">Gallery</div>
    <div class="panel-body" align="center">
        <?php
        if($pictures == null)
        {
            echo "No picture in Gallery";
        }
        else {
            ?>
            <button type="button" class="btn btn-default btn-sm" onclick="Previous();">&lt;</button>
            <?php
            $count = 0;
            foreach ($pictures as $picture) {
                ?>
                <a id="pic_<?=$count?>" href="photos.php?id=<?=$picture->getID();?>" <?php if($count++>=5) echo "style='display: none;'";?>>
                <img src="./img/<?= $picture->filename ?>" width="120" height="120"/>
                </a>
                <?php
            }?>
            <button type="button" class="btn btn-default btn-sm" onclick="Next();">&gt;</button>
            <span id="currentPage">1</span>/<span id="maxPage"><?=floor($count/5)+1?></span>
        <?php
        }
        ?>
    </div>
</div>
<script type="text/javascript">
    function Previous() {
        var currentPage = parseInt(document.getElementById("currentPage").innerHTML);
        if(currentPage > 1)
        {
            for (var i = (currentPage - 1) * 5; i < currentPage * 5; i++)
            {
                var img = document.getElementById("pic_"+i);
                if(img != null)
                    img.style.display="none";
            }
            currentPage--;
            for (i = (currentPage - 1) * 5; i < currentPage * 5; i++)
            {
                img = document.getElementById("pic_"+i);
                if(img != null)
                    img.style.display="inline";
            }
            document.getElementById("currentPage").innerHTML = currentPage;
        }
    }

    function Next() {
        var currentPage = parseInt(document.getElementById("currentPage").innerHTML);
        var maxPage = parseInt(document.getElementById("maxPage").innerHTML);
        if(currentPage < maxPage)
        {
            for (var i = (currentPage-1) * 5; i < currentPage * 5; i++)
            {
                var img = document.getElementById("pic_"+i);
                if(img != null)
                    img.style.display="none";
            }
            currentPage++;
            for (i = (currentPage-1) * 5; i < currentPage * 5; i++)
            {
                img = document.getElementById("pic_"+i);
                if(img != null)
                    img.style.display="inline";
            }
            document.getElementById("currentPage").innerHTML = currentPage;
        }
    }
</script>