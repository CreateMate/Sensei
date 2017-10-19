<!DOCTYPE html>
<html>
  <head>
    <meta charset="UTF-8">
    <title><?php print $title; ?></title>

	<meta property="og:title" content="Sensei | Web Application with amazing facts" />
	<meta property="og:type" content="article" />
	<meta property="og:url" content="http://sensei.pe.hu/" />
	<meta property="og:image" content="" /> 
	<meta property="article:author" content="https://www.facebook.com/United_brains" />
	<meta property="og:site_name" content="Sensei" />
	<meta property="og:description" content="Sensei | Web Application with amazing facts. Find out some really interesting facts about the world, history, celebrities, and many more." />

	
	<link rel="apple-touch-icon" sizes="57x57" href="<?php echo base_url();?>images/apple-icon-57x57.png">
        <link rel="apple-touch-icon" sizes="60x60" href="<?php echo base_url();?>images/apple-icon-60x60.png">
        <link rel="apple-touch-icon" sizes="72x72" href="<?php echo base_url();?>images/apple-icon-72x72.png">
        <link rel="apple-touch-icon" sizes="76x76" href="<?php echo base_url();?>images/apple-icon-76x76.png">
        <link rel="apple-touch-icon" sizes="114x114" href="<?php echo base_url();?>images/apple-icon-114x114.png">
        <link rel="apple-touch-icon" sizes="120x120" href="<?php echo base_url();?>images/apple-icon-120x120.png">
        <link rel="apple-touch-icon" sizes="144x144" href="<?php echo base_url();?>images/apple-icon-144x144.png">
        <link rel="apple-touch-icon" sizes="152x152" href="<?php echo base_url();?>images/apple-icon-152x152.png">
        <link rel="apple-touch-icon" sizes="180x180" href="<?php echo base_url();?>images/apple-icon-180x180.png">
        <link rel="icon" type="image/png" sizes="192x192"  href="<?php echo base_url();?>images/android-icon-192x192.png">
        <link rel="icon" type="image/png" sizes="32x32" href="<?php echo base_url();?>images/favicon-32x32.png">
        <link rel="icon" type="image/png" sizes="96x96" href="<?php echo base_url();?>images/favicon-96x96.png">
        <link rel="icon" type="image/png" sizes="16x16" href="<?php echo base_url();?>images/favicon-16x16.png">
        <link rel="manifest" href="<?php echo base_url();?>images/manifest.json">
        <meta name="msapplication-TileColor" content="#ffffff">
        <meta name="msapplication-TileImage" content="<?php echo base_url();?>images/ms-icon-144x144.png">
        <meta name="theme-color" content="#ffffff">
	
	<meta name="viewport" content="width=device-width, initial-scale=1.0"/>
        <link href='https://fonts.googleapis.com/css?family=Damion|Kaushan+Script' rel='stylesheet' type='text/css'/>
        
    <?php if(isset($meta)): ?>
        <?php print meta($meta); ?>
    <?php endif; ?>
    
     <?php if(isset($links) && !empty($links)): ?>
            <?php foreach($links as $link):?>
                <?php print $link; ?>
            <?php endforeach; ?>
        <?php endif; ?>
    <script type="text/javascript">var base_url="<?php echo $base_url; ?>";</script>
    
  </head>