<?php
// Flexible-Banner Widget
// by Facebook-Shopper
?>

<div id="widget_gallery">
    <header class="sidebar-title"><h3><?php echo $lang_array['Gallery Block:']; ?></h3></header>

    <div class="widget_content">

<?php
if ($handle2 = opendir('widgets/gallery/images')) {
    while (false !== ($entry2 = readdir($handle2))) {
        if ($entry2 != "." && $entry2 != "..") {
            ?>
                    <a class="fancybox" rel="group" href="./widgets/gallery/images/<?php echo $entry2; ?>" title="">
                        <img src="./widgets/gallery/images/<?php echo $entry2; ?>" alt="" />
                    </a>
            <?php
        }
    }
    closedir($handle2);
}
?>		

    </div>

</div>