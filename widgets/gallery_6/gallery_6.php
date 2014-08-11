<?php
// Flexible-Banner Widget
// by Facebook-Shopper

?>

<div id="widget_gallery_6" class="widget-galleries">
    <header class="sidebar-title"><h3><?php echo $lang_array['Gallery Block:']; ?></h3></header>

    <div class="widget_content">

<?php
if ($handle2 = opendir('widgets/gallery_6/images')) {
    while (false !== ($entry2 = readdir($handle2))) {
        if ($entry2 != "." && $entry2 != "..") {
            ?>
                    <a class="fancybox" rel="group" href="./widgets/gallery_6/images/<?php echo $entry2; ?>" title="">
                        <img src="./widgets/gallery_6/images/<?php echo $entry2; ?>" alt="" />
                    </a>
            <?php
        }
    }
    closedir($handle2);
}
?>		

    </div>

</div>