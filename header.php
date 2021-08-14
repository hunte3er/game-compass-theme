<?php
/**
 * The header for our theme.
 *
 * Displays all of the <head> section and everything up till <div id="content">
 *
 * @package Game Compass Theme
 */
?><!DOCTYPE html>
<html <?php language_attributes(); ?> prefix="og: http://ogp.me/ns#">
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title><?php wp_title( '|', true, 'right' ); ?></title>
	<link rel="profile" href="http://gmpg.org/xfn/11">
	<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">
	<!-- 
	<link rel="apple-touch-icon" sizes="57x57" href="http://web.archive.org/web/20150225085459im_/http://game-compass.com/media/themes/game-compass-theme/xapple-touch-icon-57x57.png.pagespeed.ic.q-qeKiybzI.png">
      <link rel="apple-touch-icon" sizes="60x60" href="http://web.archive.org/web/20150225085459im_/http://game-compass.com/media/themes/game-compass-theme/xapple-touch-icon-60x60.png.pagespeed.ic.GQ0fyy1nZW.png">
      <link rel="apple-touch-icon" sizes="72x72" href="http://web.archive.org/web/20150225085459im_/http://game-compass.com/media/themes/game-compass-theme/xapple-touch-icon-72x72.png.pagespeed.ic.ZfAtvaRx8y.png">
      <link rel="apple-touch-icon" sizes="76x76" href="http://web.archive.org/web/20150225085459im_/http://game-compass.com/media/themes/game-compass-theme/xapple-touch-icon-76x76.png.pagespeed.ic.wff_AK11QU.png">
      <link rel="apple-touch-icon" sizes="114x114" href="http://web.archive.org/web/20150225085459im_/http://game-compass.com/media/themes/game-compass-theme/xapple-touch-icon-114x114.png.pagespeed.ic.tEZEh60o4s.png">
      <link rel="apple-touch-icon" sizes="120x120" href="http://web.archive.org/web/20150225085459im_/http://game-compass.com/media/themes/game-compass-theme/xapple-touch-icon-120x120.png.pagespeed.ic.j_Uyfd4PHt.png">
      <link rel="apple-touch-icon" sizes="144x144" href="http://web.archive.org/web/20150225085459im_/http://game-compass.com/media/themes/game-compass-theme/xapple-touch-icon-144x144.png.pagespeed.ic.Pq0JNFGy3C.png">
      <link rel="apple-touch-icon" sizes="152x152" href="http://web.archive.org/web/20150225085459im_/http://game-compass.com/media/themes/game-compass-theme/xapple-touch-icon-152x152.png.pagespeed.ic.NCjjtH-54g.png">
      <link rel="apple-touch-icon" sizes="180x180" href="http://web.archive.org/web/20150225085459im_/http://game-compass.com/media/themes/game-compass-theme/xapple-touch-icon-180x180.png.pagespeed.ic.6i4aPsho1O.png">
      <link rel="icon" type="image/png" href="http://web.archive.org/web/20150225085459im_/http://game-compass.com/media/themes/game-compass-theme/xfavicon-32x32.png.pagespeed.ic.X7vZxLC9FY.png" sizes="32x32">
      <link rel="icon" type="image/png" href="http://web.archive.org/web/20150225085459im_/http://game-compass.com/media/themes/game-compass-theme/xandroid-chrome-192x192.png.pagespeed.ic.jKJuVRKqVB.png" sizes="192x192">
      <link rel="icon" type="image/png" href="http://web.archive.org/web/20150225085459im_/http://game-compass.com/media/themes/game-compass-theme/xfavicon-96x96.png.pagespeed.ic.2I8TmZAvD3.png" sizes="96x96">
      <link rel="icon" type="image/png" href="http://web.archive.org/web/20150225085459im_/http://game-compass.com/media/themes/game-compass-theme/xfavicon-16x16.png.pagespeed.ic._cgbuSI36f.png" sizes="16x16">
      <link rel="manifest" href="/web/20150225085459/http://game-compass.com/manifest.json">
      <meta name="msapplication-TileColor" content="#00aba9">
      <meta name="msapplication-TileImage" content="/mstile-144x144.png">
      <meta name="theme-color" content="#ffffff">
	  <meta name="description" content="Play the best free online games. No matter if Mobile, Browser or Online Games, here you find, what you're looking for! ►Game Compass – Come.Find.Play.◄"/>
	  <link rel="publisher" href="https://plus.google.com/+Gamecompass-US"/>
	  meta property="article:publisher" content="http://facebook.com/GameCompassEn"/>
      <meta property="og:image" content="http://web.archive.org/web/20150225085459im_/http://game-compass.com/assets/en/fb.jpg"/>
       <link rel="alternate" hreflang="en" href="http://web.archive.org/web/20150225085459/http://game-compass.com/en"/>
      <link rel="alternate" hreflang="de" href="http://web.archive.org/web/20150225085459/http://game-compass.com/de"/>
      
	  -->
	<?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
	<div class="off-canvas-wrap" data-offcanvas><!-- Foundation .off-canvas-wrap start -->
		<div class="inner-wrap">
		
			<!-- mobile nav -->
			<nav class="tab-bar hide-for-large-up">
				<section class="left-small">
                    <a role="button" class="left-off-canvas-toggle menu-icon" href="#"><span></span></a>
				</section>
				<section class="middle tab-bar-section">
					<a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home">
						<img class="logo" src="<?php echo get_template_directory_uri();?>/images/logo.svg">
					</a>
				</section>
				<section class="right-small">
					<a role="button" class="top-off-canvas-toggle menu-icon" href="#"><span></span></a>
				</section>
			</nav>
			<!-- mobile nav end -->
						
			<a class="skip-link screen-reader-text" href="#content"><?php _e( 'Skip to content', 'game-compass-theme' ); ?></a>

			<!-- mobile search bar -->
			<aside class="top-off-canvas-menu">
				<?php get_search_form(); ?>
			</aside>
			<!-- mobile search bar end -->
			
			<!-- mobile off canvas menu -->
			<aside class="left-off-canvas-menu mm-menu mm-vertical mm-white mm-offcanvas">
				<ul class="off-canvas-list">
					<?php wp_nav_menu( array( 
						'theme_location' => 'offcanvas', 
						'container' => '', 
						'menu_class' => '', 
						'menu_id' => '', 
						'items_wrap' => '%3$s',
						'depth' => 1
					) ); ?>
				</ul>
			</aside>
			<!-- mobile off canvas menu end -->
			
			<!-- full page -->
			<div id="page" class="hfeed site">
				<div class="row show-for-large-up">
				
					<!-- top band -->
						<nav class="tab-bar top-header">
							<!-- left links -->
                           <section class="left">
                              <!-- <div class="menu-submenu-container"> -->
                                 <ul id="gc_top_nav_menu" class="inline-list">
                                    <li id="menu-item-339" class="menu-item menu-item-type-custom menu-item-object-custom current-menu-item current_page_item menu-item-home menu-item-339 active"><a href="http://web.archive.org/web/20150225085459/http://game-compass.com/en/">Home</a></li>
                                 </ul>
                              <!--</div>-->
                           </section>
						   <!-- left links end -->
                           
						   <!-- right links -->
						   <section class="right">
                              <!-- <div class="menu-social-menu-container">-->
                                 <ul id="gc_social_menu" class="inline-list">
                                    <li id="menu-item-334" class="menu-item menu-item-type-custom menu-item-object-custom menu-item-334"><a href="http://web.archive.org/web/20150225085459/https://www.facebook.com/GameCompassEn" onclick="__gaTracker('send', 'event', 'outbound-widget', 'http://web.archive.org/web/20150225085459/https://www.facebook.com/GameCompassEn', 'Facebook');" title="Follow us on Facebook!" target="_blank"><span class="gc-social-name">Facebook</span></a></li>
                                    <li id="menu-item-335" class="menu-item menu-item-type-custom menu-item-object-custom menu-item-335"><a href="http://web.archive.org/web/20150225085459/http://twitter.com/GameCompass" onclick="__gaTracker('send', 'event', 'outbound-widget', 'http://web.archive.org/web/20150225085459/http://twitter.com/GameCompass', 'Twitter');" title="Follow us on Twitter!" target="_blank"><span class="gc-social-name">Twitter</span></a></li>
                                    <li id="menu-item-336" class="menu-item menu-item-type-custom menu-item-object-custom menu-item-336"><a href="http://web.archive.org/web/20150225085459/https://plus.google.com/+Gamecompass-Germany/" onclick="__gaTracker('send', 'event', 'outbound-widget', 'http://web.archive.org/web/20150225085459/https://plus.google.com/+Gamecompass-Germany/', 'Google+');" title="Follow us on Google+!" target="_blank"><span class="gc-social-name">Google+</span></a></li>
                                    <li id="menu-item-338" class="menu-item menu-item-type-custom menu-item-object-custom menu-item-338"><a href="http://web.archive.org/web/20150225085459/https://www.youtube.com/channel/UCk1c0H8_U247D_ioxMwRUcA" onclick="__gaTracker('send', 'event', 'outbound-widget', 'http://web.archive.org/web/20150225085459/https://www.youtube.com/channel/UCk1c0H8_U247D_ioxMwRUcA', 'Youtube');" title="Subscribe to our YouTube Channel!" target="_blank"><span class="gc-social-name">Youtube</span></a></li>
                                    <li id="menu-item-337" class="menu-item menu-item-type-custom menu-item-object-custom menu-item-337"><a title="Subscribe to our Feed!" target="_blank" href="/web/20150225085459/http://game-compass.com/feed"><span class="gc-social-name">RSS</span></a></li>
                                    <li id="menu-item-340" class="menu-item menu-item-type-custom menu-item-object-custom menu-item-340"><a href="http://web.archive.org/web/20150225085459/mailto:webmaster@game-compass.com" onclick="__gaTracker('send', 'event', 'mailto', 'webmaster@game-compass.com');" title="Tell us your opinion!" target="_blank"><span class="gc-social-name">Mail</span></a></li>
                                 </ul>
                              <!-- </div>-->
                           </section>
						   <!-- right links end -->
                        </nav>
						<!-- top band end -->
						
						<!-- main header -->
						<header id="masthead" class="site-header" role="banner">
								<div class="large-2 xlarge-2 columns clear-fix small-centered">
									<div class="row site-branding">
										<h1 class="site-title">
											<a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?>
												<img class="" src="<?php echo get_template_directory_uri();?>/images/logo.svg">
											</a>
										</h1>
										<h2 class="text-center site-description"><?php bloginfo( 'description' ); ?></h2>
									</div>
								</div>
						</header>
						<!-- main haeder end -->
						<div class="top-bar">
						<section class="top-bar-section">
	<ul class="vertical f-dropdown menu" data-dropdown-menu style="max-width: 250px;" role="menu-bar">
  <li>
    <a href="#">Item 1</a>
    <ul class="vertical menu nested">
      <li><a href="#">Item 1A</a></li>
      <!-- ... -->
    </ul>
  </li>
  <li><a href="#">Item 2</a></li>
  <li><a href="#">Item 3</a></li>
  <li><a href="#">Item 4</a></li>
  <!-- ... -->
</ul>
						
						<!-- breadcrumbs -->
						<div class="row">
							<div class="small-12 columns">
								<div class="breadcrumbs">
									<?php if(function_exists('bcn_display'))
									{
										bcn_display();
									}?>
								</div>
							</div>
						</div>
						<!-- breadcrumbs end -->
				</div>
			</div>
		</div>
		<div class="row">
			<div id="content" class="site-content" role="main">