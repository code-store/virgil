<?php
ob_start();
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">


    <?php
    error_reporting(E_ERROR);
    include 'config.php';
    session_start();


    //----------------- GETTING THE LANGUAGE SETTINGS -------------------------------//
    $SQL2 = "SELECT * FROM webpages_settings WHERE webpages_settings.id = 1";
    $result2 = mysql_query($SQL2);

    $res2 = mysql_fetch_assoc($result2);
    $frontend_languages = $res2['frontend_languages'];
    $default_language = $res2['default_language'];

    $frontend_languages = explode("|", $frontend_languages);



    $lang = $_GET['lang'];

    if ($_GET['lang']) {
        $_SESSION['siteLanguage123'] = $_GET['lang'];
    }

    if ($lang == "" || !$lang) {
        if (isset($_SESSION['siteLanguage123'])) {
            $lang = $_SESSION['siteLanguage123'];
        } else {
            $lang = $default_language;
        }
    }

    ///echo $lang;


    $locale = "locale/" . strtolower($lang) . "_" . strtoupper($lang) . ".csv";

    $res = file_get_contents($locale);
    $res = explode("\n", $res);

    $lang_array = array();

    foreach ($res as $word) {
        $words = explode("| ", $word);

        $lang_array[$words[0]] = $words[1];
    }

    //----------------- GETTING THE LANGUAGE SETTINGS -------------------------------//









    $url = $_GET['url'];

    $sql = "SELECT * FROM webpages WHERE urlinput='" . $url . "' AND language='" . strtoupper($lang) . "'";
    $result = mysql_query($sql);

    while ($db_field = mysql_fetch_assoc($result)) {
        $meta_t = $db_field['meta_t'];
        $meta_d = $db_field['meta_d'];
        $is_home = $db_field['is_home'];
        $text = $db_field['text'];
        $pagename = $db_field['file'];
        $pageide = $db_field['PageID'];
        $template = $db_field['template'];
    }

    $sql = "SELECT * FROM webpages_elements WHERE id=1";
    $result = mysql_query($sql);

    while ($db_field = mysql_fetch_assoc($result)) {
        $footer = $db_field['footer'];
        $sidebar = $db_field['sidebar'];
        $header = $db_field['header'];
        $gen_settings = $db_field['gen_settings'];
        $custom_menu = $db_field['custom_menu'];
        $social = $db_field['social'];
        $slider = $db_field['slider'];
    }
    ?>

    <head>



        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <title><?php echo $meta_t; ?></title>
        <meta name="description" content="<?php echo $meta_d; ?>" />
        <meta name="robots" content="INDEX,FOLLOW" />
        <base href="<?php echo $Site_Url?>" />
        <link rel="stylesheet" href="./css/bootstrap.css" type="text/css" media="screen">
            <link rel="stylesheet" href="./css/bootstrap-responsive.css" type="text/css" media="screen">
                <link rel="stylesheet" href="./css/styles.css" type="text/css" media="screen">
                    <link rel="stylesheet" href="./css/colors.css" type="text/css" media="screen">
                        <link rel="stylesheet" href="./css/prettyPhoto.css" type="text/css" media="all">

                            <!-- HTML5 shim, for IE6-8 support of HTML5 elements -->
                            <!--[if lt IE 9]>
                                      <script src="./js/new/html5.js"></script>
                                      <script src="./js/new/css3-mediaqueries.js"></script>
                                    <![endif]-->

                            <script src="./js/css_browser_selector.js" type="text/javascript"></script>
                            <script type="text/javascript" src="./js/ajaxScripts.js"></script>

                            <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.8.1/jquery.min.js"></script>

                            <script type="text/javascript" src="./js/responsive/css3-mediaqueries.js"></script>
                            <script type="text/javascript" src="./js/responsive/easyTooltip.js"></script>
                            <script type="text/javascript" src="./js/responsive/script.js"></script>



                            <link type="text/css" href="assets/css/simple_menu.css"  rel="stylesheet" />		
                            <script type="text/javascript" src="assets/js/simple_menu.js"></script>


                            <!-- Templates Switcher -->
                            <link type="text/css" rel="stylesheet" href="../../templates_switcher/css/changer.css"/>
                            <script type="text/javascript" src="../../templates_switcher/js/script.js" ></script>
                            <!-- End Templates Switcher -->





 <!--<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js" type="text/javascript"></script>
         <script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.10.2/jquery-ui.min.js" type="text/javascript"></script>-->
                            <script src="./js/new/menu.js" type="text/javascript"></script>
                            <script src="./js/new/jquery.flexslider.min.js" type="text/javascript"></script>
                            <script src="./js/new/jquery.easing.min.js" type="text/javascript"></script>
                            <script src="./js/new/jquery.prettyPhoto.js" type="text/javascript"></script>
                            <script src="./js/new/jquery.jtwt.min.js" type="text/javascript"></script>
                            <script src="./js/new/init.js" type="text/javascript"></script>


                            <link rel="stylesheet" href="./widgets/newsletter/newsletter.css"/>
                            <link rel="stylesheet" href="./widgets/left_navigation/left_navigation.css"/>
                            <link rel="stylesheet" href="./widgets/flexbanner/flexbanner.css"/>
                            <link rel="stylesheet" href="./widgets/flexbanner2/flexbanner2.css"/>


                            <link rel="stylesheet" href="./widgets/gallery/gallery.css" />
                            <script type="text/javascript" src="./js/jquery.fancybox.js?v=2.1.4"></script>
                            <link rel="stylesheet" type="text/css" href="./css/jquery.fancybox.css?v=2.1.4" media="screen" />
                            <script type="text/javascript">
                                $(document).ready(function() {
                                    $(".fancybox").fancybox();
                                });
                            </script>
                            <script type="text/javascript">
                                $(document).ready(function()
                                {
                                    /******************
                                     COOKIE NOTICE
                                     ******************/
                                    if (getCookie('show_cookie_message') != 'no')
                                    {
                                        $('#cookie_box').show();
                                    }

                                    $('.cookie_box_close').click(function()
                                    {
                                        $('#cookie_box').animate({opacity: 0}, "slow");
                                        setCookie('show_cookie_message', 'no');
                                        return false;
                                    });
                                });

                                function setCookie(cookie_name, value)
                                {
                                    document.cookie = cookie_name + "=" + escape(value);
                                }

                                function getCookie(cookie_name)
                                {
                                    if (document.cookie.length > 0)
                                    {
                                        cookie_start = document.cookie.indexOf(cookie_name + "=");
                                        if (cookie_start != -1)
                                        {
                                            cookie_start = cookie_start + cookie_name.length + 1;
                                            cookie_end = document.cookie.indexOf(";", cookie_start);
                                            if (cookie_end == -1)
                                            {
                                                cookie_end = document.cookie.length;
                                            }
                                            return unescape(document.cookie.substring(cookie_start, cookie_end));
                                        }
                                    }
                                    return "";
                                }
                            </script>


<?php include('custom_widget_css.php'); ?>






<?php
$SQL2 = "SELECT * FROM webpages_settings WHERE webpages_settings.id = 1";
$result2 = mysql_query($SQL2);

while ($db_field2 = mysql_fetch_assoc($result2)) {
    $menubg = $db_field2['menu_bg'];
    $menubg_hover = $db_field2['menu_bg_hover'];
    $menu_textc = $db_field2['menu_textc'];
    $menu_textc_hover = $db_field2['menu_textc_hover'];

    $header_bg = $db_field2['header_bg'];
    $header_height = $db_field2['header_height'];
    $header_text = $db_field2['header_text'];
    $header_img = $db_field2['header_img'];

    $banner_slider_bg = $db_field2['banner_slider_bg'];
    $banner_slider_height = $db_field2['banner_slider_height'];

    $footer_bg = $db_field2['footer_bg'];
    $footer_textc = $db_field2['footer_textc'];
}

$imgpos = strpos($menubg, ".");
?>	

                            <style type="text/css">

                                #custommenu1{	
                                    /*<?php if ($imgpos > 0) { ?>
                                                background:url('./images/backgrounds/<?php echo $menubg; ?>');
<?php } else { ?>
                                                background:#<?php echo $menubg; ?>;
<?php } ?>*/
                                    height:64px;
                                }


                            </style>



                            <!-- AddThis Smart Layers BEGIN -->
                            <!-- Go to http://www.addthis.com/get/smart-layers to customize -->
                            <script type="text/javascript" src="//s7.addthis.com/js/300/addthis_widget.js#pubid=ra-521b3aba1cce668c"></script>
                            <script type="text/javascript">
                                addthis.layers({
                                    'theme': 'transparent',
                                    'share': {
                                        'position': 'left',
                                        'numPreferredServices': 5
                                    },
                                    /*'recommended': {
                                        'title': 'Recommended for you:'
                                    }*/
                                });
                            </script>
                            <!-- AddThis Smart Layers END -->



<?php
//---------------------------------------------------------------------------------// 
//------- Google Analytics Code ---------------------------------------------------//

$sql = "SELECT * FROM webpages_settings WHERE webpages_settings.id = 1";
$result = mysql_query($sql);

while ($db_field = mysql_fetch_assoc($result)) {
    $google_analytics = $db_field['google_analytics'];
}

echo stripslashes($google_analytics);

//---------------------------------------------------------------------------------// 	
?>



                            </head>

                            <body>
                                <!--<div class="responsive-image"></div>-->


                                <?php /* ?><div id="cookie_box">
                                    <p><?php echo $lang_array['Our site requires cookies to ensure that you get the best user experience.']; ?> <a href="./cookies.html"><?php echo $lang_array['Click here']; ?> </a> <?php echo $lang_array['for more information.']; ?></p> 
                                    <a href="#" class="cookie_box_close">OK</a>
                                </div><?php */ ?>


                                <div class="mainWrap">
                                    <header class="wrap" style="height:<?php echo $header_height; ?>px; background:<?php if (strlen($header_bg) > 6) { ?>url('images/backgrounds/<?php echo $header_bg; ?>')<?php } else { ?>#<?php echo $header_bg; ?><?php } ?>;">
                                        <div class="container"> 
                                            <!-- verbouwing_log.jpg-->
                                            <a class="logo" href="./"><img src="<?php echo $header_img; ?>" alt=""></a>

                                            <nav id="nav-desktop">
<?php
include ("include/amms.class.php");
$amms = new amms;


$lang_s = strtolower($lang);

if ($lang_s == 'nl') {
    echo $amms->render_menu("main_menu", "top_nav", "horizontal", "menu");
} else {
    echo $amms->render_menu("main_menu_" . $lang_s, "top_nav", "horizontal", "menu");
}

//echo "main_menu_".$lang_s;
?>
                                            </nav>

                                            <!-- ==================================== LANGUAGE BAR ================================ -->

                                            <div class="languageBar" style="display:none;">
                                                <?php
                                                foreach ($frontend_languages as $langs) {
                                                    ?>
                                                    <a href="./<?php echo strtolower($langs); ?>/home.html" width="32" height="25">
                                                        <img src="./images/flags/<?php echo $langs; ?>.png" width="32" height="25" alt="<?php echo $langs; ?>" title="<?php echo $langs; ?>" <?php if ($lang_s == strtolower($langs)) {
                                                    echo "class='languageFlag selected'";
                                                } else {
                                                    echo "class='languageFlag'";
                                                } ?> />
                                                    </a>

                                                    <?php
                                                }
                                                ?>
                                            </div>

                                            <!-- ==================================== LANGUAGE BAR ================================ -->


                                        </div>
                                        <!--end container--> 
                                    </header>



                                    <div class="wrap">
                                        <div class="container home-apoint banner-top" <?php if ($url == 'home.html') {
                                                    echo "style='border:0px;'";
                                                } ?> >
                                            <div class="row">
                                                <div class="span12 home-apoint-text">
<?php if ($url != 'home.html') { ?>
                                                        <h2><?php echo $pagename; ?></h2>
<?php } ?>
                                                </div>
                                            </div>
                                            <!--end row--> 
                                        </div>
                                        <!--end container--> 
                                    </div>




<?php
$SQL2 = "SELECT * FROM webpages_settings WHERE webpages_settings.id = 1";
$result2 = mysql_query($SQL2);

$res2 = mysql_fetch_assoc($result2);
$slider_on_page = $res2['banner_slider_location'];
$slider_on_page = explode("|", $slider_on_page);

if (in_array($pageide, $slider_on_page)) {
    ?>

                                        <div class="wrap">
                                            <div class="flexslider-top" style="height:<?php echo $banner_slider_height; ?>px; background:<?php if (strlen($banner_slider_bg) > 6) { ?>url('images/backgrounds/<?php echo $banner_slider_bg; ?>')<?php } else { ?>#<?php echo $banner_slider_bg; ?><?php } ?>;">
                                                <div class="flex-viewport" style="overflow: hidden; position: relative;">
                                                    <ul class="slides" style="width: 1000%; margin-left: -1230px;">
                                        <?php
                                        $sql_banns = "SELECT * FROM banners WHERE language='" . strtoupper($lang) . "'";
                                        $result_banns = mysql_query($sql_banns);

                                        while ($db_field_banns = mysql_fetch_assoc($result_banns)) {
                                            echo '<li>';
                                            echo stripslashes($db_field_banns['content']);
                                            echo '</li>';
                                        }
                                        ?>
                                                            <!--<li> <a href="#"><img src="/templates/design-11/images/slider-1.jpg" alt=""></a>
                                                                    <div class="flex-caption"> <span>We take care of your teeth</span> </div>
                                                            </li>
                                                            <li> <a href="#"><img src="/templates/design-11/images/slider-2.jpg" alt=""></a>
                                                                    <div class="flex-caption"> <span>We take care of your teeth</span> </div>
                                                            </li>-->
                                                    </ul>
                                                </div>
                                                <ul class="flex-direction-nav">
                                                    <li><a class="flex-prev" href="#">Prev</a></li>
                                                    <li><a class="flex-next" href="#">Next</a></li>
                                                </ul>
                                            </div>
                                            <!--end flexslider--> 
                                        </div>
    <?php
}
?>

                                    <div class="content_ext">		
                                        <div class="pagecontent">
                                            <div class="pagecontent-inner" <?php if ($pagename == 'Home') { ?> style="float:none;"<?php } ?>>
<?php
include('./config.php');

if ($template != "") {

    //------------- WIDGETS THIS PAGE ------------------//

    $sql = "SELECT * FROM widgets_pages WHERE name='" . $template . "'";
    $result = mysql_query($sql);

    while ($db_field2 = mysql_fetch_assoc($result)) {
        $widgets = $db_field2['widgets'];
        $template_type = $db_field2['template_type'];
    }

    $widgets_array = explode("|", $widgets);

    $widgets_LEFT = array();
    $widgets_CENTER = array();
    $widgets_RIGHT = array();

    foreach ($widgets_array as $widget) {
        $location = substr($widget, 0, 1);
        $widget = substr($widget, 2);

        if ($location == "L") {
            array_push($widgets_LEFT, $widget);
        }
        if ($location == "C") {
            array_push($widgets_CENTER, $widget);
        }
        if ($location == "R") {
            array_push($widgets_RIGHT, $widget);
        }
    }




    //---------------------------------------------------------------------------------------------------------------------//		
    //---------------------------------------------------------------------------------------------------------------------//		
    //--------------------------------- 1 COLUMN --------------------------------------------------------------------------//
    //---------------------------------------------------------------------------------------------------------------------//										

    if ($template_type == "1column") {
        ?><div class='1col_widget' style='background:white;'><?php
                                                        foreach ($widgets_LEFT as $widget) {

                                                            $sist = substr($widget, 0, 5);

                                                            if ($sist != "syst_") {
                                                                $sql = "SELECT * FROM widgets WHERE identificator='" . $widget . "'";
                                                                $result = mysql_query($sql);

                                                                while ($db_field = mysql_fetch_assoc($result)) {
                                                                    $content = stripslashes($db_field['content']);

                                                                    // ---------- USER WIDGET INSERT -----------------//
                                                                    echo $content;
                                                                }
                                                            } else {
                                                                if ($handle = opendir('widgets')) {

                                                                    while (false !== ($entry = readdir($handle))) {
                                                                        if ($entry != "." && $entry != "..") {

                                                                            if ($widget == "syst_" . $entry) {
                                                                                // ----------- SYSTEM WIDGET or CONTACT FORM INSERT --------------//
                                                                                if ($entry != "contact_form") {
                                                                                    $content = file_get_contents('./widgets/' . $entry . '/' . $entry . '.php');
                                                                                    //print_r($content); 
                                                                                    include('./widgets/' . $entry . '/' . $entry . ".php");
                                                                                } else {
                                                                                    $sql = "SELECT * FROM webpages_elements";
                                                                                    $result = mysql_query($sql);

                                                                                    while ($db_field = mysql_fetch_assoc($result)) {
                                                                                        print_r(stripslashes($db_field['sidebar']));
                                                                                    }
                                                                                }
                                                                                //----------------------------------------------------------------//
                                                                            }
                                                                        }
                                                                    }
                                                                }
                                                            }
                                                        }

                                                        echo stripslashes($text);
                                                        ?></div><?php
                                                    }


                                                    //---------------------------------------------------------------------------------------------------------------------//		
                                                    //---------------------------------------------------------------------------------------------------------------------//		
                                                    //--------------------------------- 2 COLUMN - LEFT -------------------------------------------------------------------//
                                                    //---------------------------------------------------------------------------------------------------------------------//		


                                                    if ($template_type == "2columns-left") {
                                                        ?><div class='col2_left_left'><?php
                                                        $i = 0;
                                                        foreach ($widgets_LEFT as $widget) {
                                                            $i++;
                                                            $sist = substr($widget, 0, 5);

                                                            if ($sist != "syst_") {
                                                                $sql = "SELECT * FROM widgets WHERE identificator='" . $widget . "'";
                                                                $result = mysql_query($sql);

                                                                while ($db_field = mysql_fetch_assoc($result)) {
                                                                    $content = stripslashes($db_field['content']);
                                                                    $name = $db_field['name'];

                                                                    // ---------- USER WIDGET INSERT -----------------//
                                                                    echo "<div class='2col_left' style='display:block; overflow: hidden; clear: both;' >";
                                                                    echo '<div id="widget_flexbanner' . $i . '">';
                                                                    echo '<header class="sidebar-title"><h3>' . $name . '</h3></header>';
                                                                    echo '<div class="widget_content">';
                                                                    echo $content;
                                                                    echo '</div>';
                                                                    echo '</div>';
                                                                    echo "</div>";
                                                                }
                                                            } else {
                                                                if ($handle = opendir('widgets')) {
                                                                    while (false !== ($entry = readdir($handle))) {
                                                                        if ($widget == "syst_" . $entry) {
                                                                            // ----------- SYSTEM WIDGET or CONTACT FORM INSERT --------------//
                                                                            if ($entry != "contact_form") {
                                                                                $content = file_get_contents('./widgets/' . $entry . '/' . $entry . '.php');
                                                                                //print_r($content); 
                                                                                include('./widgets/' . $entry . '/' . $entry . ".php");
                                                                            } else {
                                                                                $sql = "SELECT * FROM webpages_elements";
                                                                                $result = mysql_query($sql);

                                                                                while ($db_field = mysql_fetch_assoc($result)) {
                                                                                    echo '<div id="widget_flexbanner' . $i . '">';
                                                                                    echo '<h4 class="widget_head"> Contact </h4>';
                                                                                    echo '<div class="widget_content" style="padding:0px;" >';
                                                                                    print_r(stripslashes($db_field['sidebar']));
                                                                                    echo '</div>';
                                                                                    echo '</div>';
                                                                                }
                                                                            }
                                                                            //----------------------------------------------------------------//
                                                                        }
                                                                    }
                                                                }
                                                            }
                                                        }
                                                        ?></div>

                                                        <div class='col2_left_center'><?php
                                                            foreach ($widgets_CENTER as $widget) {

                                                                $sist = substr($widget, 0, 5);

                                                                if ($sist != "syst_") {
                                                                    $sql = "SELECT * FROM widgets WHERE identificator='" . $widget . "'";
                                                                    $result = mysql_query($sql);

                                                                    while ($db_field = mysql_fetch_assoc($result)) {
                                                                        $content = stripslashes($db_field['content']);

                                                                        // ---------- USER WIDGET INSERT -----------------//
                                                                        echo "<div class='2col_center' style='display:block;'>" . $content . "</div>";
                                                                    }
                                                                } else {
                                                                    if ($handle = opendir('widgets')) {
                                                                        while (false !== ($entry = readdir($handle))) {
                                                                            if ($entry != "." && $entry != "..") {
                                                                                if ($widget == "syst_" . $entry) {
                                                                                    // ----------- SYSTEM WIDGET or CONTACT FORM INSERT --------------//
                                                                                    if ($entry != "contact_form") {
                                                                                        $content = file_get_contents('./widgets/' . $entry . '/' . $entry . '.php');
                                                                                        //print_r($content); 
                                                                                        include('./widgets/' . $entry . '/' . $entry . ".php");
                                                                                    } else {
                                                                                        $sql = "SELECT * FROM webpages_elements";
                                                                                        $result = mysql_query($sql);

                                                                                        while ($db_field = mysql_fetch_assoc($result)) {
                                                                                            print_r(stripslashes($db_field['sidebar']));
                                                                                        }
                                                                                    }
                                                                                    //----------------------------------------------------------------//
                                                                                }
                                                                            }
                                                                        }
                                                                    }
                                                                }
                                                            }

                                                            echo stripslashes($text);
                                                            ?></div><?php
                                                        }




                                                        //---------------------------------------------------------------------------------------------------------------------//		
                                                        //---------------------------------------------------------------------------------------------------------------------//		
                                                        //--------------------------------- 2 COLUMN - RIGHT ------------------------------------------------------------------//
                                                        //---------------------------------------------------------------------------------------------------------------------//	

                                                        if ($template_type == "2columns-right") {
                                                            ?><div class='col2_right_center'><?php
                                                            foreach ($widgets_LEFT as $widget) {
                                                                $sist = substr($widget, 0, 5);

                                                                if ($sist != "syst_") {
                                                                    $sql = "SELECT * FROM widgets WHERE identificator='" . $widget . "'";
                                                                    $result = mysql_query($sql);

                                                                    while ($db_field = mysql_fetch_assoc($result)) {
                                                                        $content = stripslashes($db_field['content']);

                                                                        // ---------- USER WIDGET INSERT -----------------//
                                                                        echo "<div class='2col_left' style='display:block;' >" . $content . "</div>";
                                                                    }
                                                                } else {
                                                                    if ($handle = opendir('widgets')) {
                                                                        while (false !== ($entry = readdir($handle))) {
                                                                            if ($entry != "." && $entry != "..") {
                                                                                if ($widget == "syst_" . $entry) {
                                                                                    // ----------- SYSTEM WIDGET or CONTACT FORM INSERT --------------//
                                                                                    if ($entry != "contact_form") {
                                                                                        echo "<BR>$entry.php<BR>";
                                                                                        $content = file_get_contents('./widgets/' . $entry . '/' . $entry . '.php');
                                                                                        //print_r($content); 
                                                                                        include('./widgets/' . $entry . '/' . $entry . ".php");
                                                                                    } else {
                                                                                        $sql = "SELECT * FROM webpages_elements";
                                                                                        $result = mysql_query($sql);

                                                                                        while ($db_field = mysql_fetch_assoc($result)) {
                                                                                            print_r(stripslashes($db_field['sidebar']));
                                                                                        }
                                                                                    }
                                                                                    //----------------------------------------------------------------//
                                                                                }
                                                                            }
                                                                        }
                                                                    }
                                                                }
                                                            }
                                                            echo stripslashes($text);
                                                            ?></div><?php
                                                            ?><div class='col2_right_right'><?php
                                                            foreach ($widgets_CENTER as $widget) {
                                                                $sist = substr($widget, 0, 5);

                                                                if ($sist != "syst_") {
                                                                    $sql = "SELECT * FROM widgets WHERE identificator='" . $widget . "'";
                                                                    $result = mysql_query($sql);

                                                                    while ($db_field = mysql_fetch_assoc($result)) {
                                                                        $content = stripslashes($db_field['content']);
                                                                        $name = $db_field['name'];

                                                                        // ---------- USER WIDGET INSERT -----------------//
                                                                        echo "<div class='2col_center' style='display:block;'>";
                                                                        echo '<div id="widget_flexbanner">';
                                                                        echo '<header class="sidebar-title"><h3>' . $name . '</h3></header>';
                                                                        echo '<div class="widget_content">';
                                                                        echo $content;
                                                                        echo '</div>';
                                                                        echo '</div>';
                                                                        echo "</div>";
                                                                    }
                                                                } else {
                                                                    if ($handle = opendir('widgets')) {
                                                                        while (false !== ($entry = readdir($handle))) {
                                                                            if ($entry != "." && $entry != "..") {
                                                                                if ($widget == "syst_" . $entry) {
                                                                                    // ----------- SYSTEM WIDGET or CONTACT FORM INSERT --------------//
                                                                                    if ($entry != "contact_form") {
                                                                                        $content = file_get_contents('./widgets/' . $entry . '/' . $entry . '.php');
                                                                                        //print_r($content); 
                                                                                        include('./widgets/' . $entry . '/' . $entry . ".php");
                                                                                    } else {
                                                                                        $sql = "SELECT * FROM webpages_elements";
                                                                                        $result = mysql_query($sql);

                                                                                        while ($db_field = mysql_fetch_assoc($result)) {
                                                                                            echo '<div id="widget_flexbanner">';
                                                                                            echo '<header class="sidebar-title"><h3>Contact</h3></header>';
                                                                                            echo '<div class="widget_content" style="padding:0px;" >';
                                                                                            print_r(stripslashes($db_field['sidebar']));
                                                                                            echo '</div>';
                                                                                            echo '</div>';
                                                                                        }
                                                                                    }
                                                                                    //----------------------------------------------------------------//
                                                                                }
                                                                            }
                                                                        }
                                                                    }
                                                                }
                                                            }
                                                            ?></div><?php
                                                        }



                                                        //---------------------------------------------------------------------------------------------------------------------//		
                                                        //---------------------------------------------------------------------------------------------------------------------//		
                                                        //--------------------------------- 3 COLUMN --------------------------------------------------------------------------//
                                                        //---------------------------------------------------------------------------------------------------------------------//		


                                                        if ($template_type == "3columns") {
                                                            ?><div class='col3_left'><?php
                                                            foreach ($widgets_LEFT as $widget) {
                                                                $sist = substr($widget, 0, 5);

                                                                if ($sist != "syst_") {
                                                                    $sql = "SELECT * FROM widgets WHERE identificator='" . $widget . "'";
                                                                    $result = mysql_query($sql);

                                                                    while ($db_field = mysql_fetch_assoc($result)) {
                                                                        $content = stripslashes($db_field['content']);
                                                                        $name = $db_field['name'];

                                                                        //---------- USER WIDGET INSERT -----------------//
                                                                        echo "<div class='3col_left' style='display:block;'>";
                                                                        echo '<div id="widget_flexbanner">';
                                                                        echo '<h4 class="widget_head"> ' . $name . ' </h4>';
                                                                        echo '<div class="widget_content">';
                                                                        echo $content;
                                                                        echo '</div>';
                                                                        echo '</div>';
                                                                        echo "</div>";
                                                                    }
                                                                } else {
                                                                    if ($handle = opendir('widgets')) {
                                                                        while (false !== ($entry = readdir($handle))) {
                                                                            if ($entry != "." && $entry != "..") {
                                                                                if ($widget == "syst_" . $entry) {
                                                                                    // ----------- SYSTEM WIDGET or CONTACT FORM INSERT --------------//
                                                                                    if ($entry != "contact_form") {
                                                                                        $content = file_get_contents('./widgets/' . $entry . '/' . $entry . '.php');
                                                                                        //print_r($content); 
                                                                                        include('./widgets/' . $entry . '/' . $entry . ".php");
                                                                                    } else {
                                                                                        $sql = "SELECT * FROM webpages_elements";
                                                                                        $result = mysql_query($sql);

                                                                                        while ($db_field = mysql_fetch_assoc($result)) {
                                                                                            echo '<div id="widget_flexbanner">';
                                                                                            echo '<h4 class="widget_head"> Contact </h4>';
                                                                                            echo '<div class="widget_content" style="padding:0px;" >';
                                                                                            print_r(stripslashes($db_field['sidebar']));
                                                                                            echo '</div>';
                                                                                            echo '</div>';
                                                                                        }
                                                                                    }
                                                                                    //----------------------------------------------------------------//
                                                                                }
                                                                            }
                                                                        }
                                                                    }
                                                                }
                                                            }
                                                            ?></div><?php
                                                            ?><div class='col3_center'><?php
                                                            foreach ($widgets_CENTER as $widget) {
                                                                $sist = substr($widget, 0, 5);

                                                                if ($sist != "syst_") {
                                                                    $sql = "SELECT * FROM widgets WHERE identificator='" . $widget . "'";
                                                                    $result = mysql_query($sql);

                                                                    while ($db_field = mysql_fetch_assoc($result)) {
                                                                        $content = stripslashes($db_field['content']);

                                                                        //---------- USER WIDGET INSERT -----------------//
                                                                        echo "<div class='3col_center' style='display:block;' >" . $content . "</div>";
                                                                    }
                                                                } else {
                                                                    if ($handle = opendir('widgets')) {
                                                                        while (false !== ($entry = readdir($handle))) {
                                                                            if ($entry != "." && $entry != "..") {
                                                                                if ($widget == "syst_" . $entry) {
                                                                                    // ----------- SYSTEM WIDGET or CONTACT FORM INSERT --------------//
                                                                                    if ($entry != "contact_form") {
                                                                                        $content = file_get_contents('./widgets/' . $entry . '/' . $entry . '.php');
                                                                                        //print_r($content);
                                                                                        include('./widgets/' . $entry . '/' . $entry . ".php");
                                                                                    } else {
                                                                                        $sql = "SELECT * FROM webpages_elements";
                                                                                        $result = mysql_query($sql);

                                                                                        while ($db_field = mysql_fetch_assoc($result)) {
                                                                                            print_r(stripslashes($db_field['sidebar']));
                                                                                        }
                                                                                    }
                                                                                    //----------------------------------------------------------------//
                                                                                }
                                                                            }
                                                                        }
                                                                    }
                                                                }
                                                            }
                                                            echo stripslashes($text);
                                                            ?></div><?php
                                                            ?><div class='col3_right'><?php
                                                            foreach ($widgets_RIGHT as $widget) {
                                                                $sist = substr($widget, 0, 5);

                                                                if ($sist != "syst_") {
                                                                    $sql = "SELECT * FROM widgets WHERE identificator='" . $widget . "'";
                                                                    $result = mysql_query($sql);

                                                                    while ($db_field = mysql_fetch_assoc($result)) {
                                                                        $content = stripslashes($db_field['content']);
                                                                        $name = $db_field['name'];

                                                                        //---------- USER WIDGET INSERT -----------------//
                                                                        echo "<div class='3col_right' style='display:block;'>";
                                                                        echo '<div id="widget_flexbanner">';
                                                                        echo '<h4 class="widget_head"> ' . $name . ' </h4>';
                                                                        echo '<div class="widget_content">';
                                                                        echo $content;
                                                                        echo '</div>';
                                                                        echo '</div>';
                                                                        echo "</div>";
                                                                    }
                                                                } else {
                                                                    if ($handle = opendir('widgets')) {
                                                                        while (false !== ($entry = readdir($handle))) {
                                                                            if ($entry != "." && $entry != "..") {
                                                                                if ($widget == "syst_" . $entry) {
                                                                                    // ----------- SYSTEM WIDGET or CONTACT FORM INSERT --------------//
                                                                                    if ($entry != "contact_form") {
                                                                                        $content = file_get_contents('./widgets/' . $entry . '/' . $entry . '.php');
                                                                                        include('./widgets/' . $entry . '/' . $entry . ".php");
                                                                                        //print_r($content); 
                                                                                    } else {
                                                                                        $sql = "SELECT * FROM webpages_elements";
                                                                                        $result = mysql_query($sql);

                                                                                        while ($db_field = mysql_fetch_assoc($result)) {
                                                                                            echo '<div id="widget_flexbanner">';
                                                                                            echo '<h4 class="widget_head" > Contact </h4>';
                                                                                            echo '<div class="widget_content" style="padding:0px;" >';
                                                                                            print_r(stripslashes($db_field['sidebar']));
                                                                                            echo '</div>';

                                                                                            echo '</div>';
                                                                                        }
                                                                                    }
                                                                                    //----------------------------------------------------------------//
                                                                                }
                                                                            }
                                                                        }
                                                                    }
                                                                }
                                                            }
                                                            ?></div><?php
                                                        }
                                                    }
                                                    ?>

                                            </div>
                                        </div>	
                                    </div>



                                    <footer class="wrap margin-block" style="background:#<?php echo $footer_bg; ?>; color:#<?php echo $footer_textc; ?>;">
                                        <div class="container">
                                                    <?php
                                                    $sqlfooter = "SELECT * FROM webpages WHERE file='Footer content'";
                                                    $resultfooter = mysql_query($sqlfooter);

                                                    while ($db_field2footer = mysql_fetch_assoc($resultfooter)) {
                                                        $contentfooter = stripslashes($db_field2footer['text']);
                                                    }
                                                    echo $contentfooter;
                                                    ?>
                                            <!--end row--> 
                                        </div>
                                        <!--end container--> 
                                    </footer>
                                    <!--end wrap-->

                                    <div class="wrap copy-holder">
                                        <div class="container">
                                            <div class="row">
                                                <div class="span12 copyright">
                                                    <img align="left" alt="" src="images/m_logo.png"><a href="http://www.mm-webmedia.nl/over/zoekmachine-marketing-mkb.php" target="_blank"> Zoekmachine Marketing MKB</a>
                                                </div>
                                                <!--end copyright--> 
                                            </div>
                                            <!--end row--> 
                                        </div>
                                        <!--end container--> 
                                    </div>
                                    <!--end wrap--> 
                                </div>


                                                <?php //include('../../templates_switcher/theme_changer.php'); ?>

                                                <?php ob_flush(); ?>
                            </body>
                            </html>