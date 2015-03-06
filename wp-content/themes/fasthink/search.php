<?php 
/**
 * KENTOOZ SEARCH PAGE TEMPLATE
**/
if (isset($_REQUEST['s'])) {
$termstring = urldecode($_REQUEST['s']);
} else {
$termstring = '';}
get_header(); ?>
	<section class="col-md-12">
	<div class="row">
	<?php if ( ot_get_option('ktz_sb_layout') == 'left' ) : get_sidebar(); endif; ?>
		<div role="main" class="main col-md-9">
		<section class="new-content">
		<div class="ktz-titlepage"><h1><?php printf( '<span class="ktz-blocktitle">' . __( 'Search Results for: %s', ktz_theme_textdomain ), '' . get_search_query() . '</span>' ); ?></h1>		</div>
<?php echo spp(get_search_query());?>		
<?php if ( have_posts() ) : 
		while ( have_posts() ) : the_post();
			if ( ot_get_option('ktz_content_layout') == 'layout_blog' ) :
			get_template_part( 'content', 'mini' );
			else :
			get_template_part( 'content', get_post_format() );
			endif;
		endwhile; ?>
		<nav id="nav-index">
			<?php ktz_navigation(); ?>
		</nav>
		<?php else : $termstring = $s;
		if (ot_get_option('ktz_agc_activated') == "yes") {
	if ($s!='') {
	$googleresults = perform_google_web_search($termstring);
	if (is_array($googleresults))
	{
	foreach ($googleresults as $result) {
	$link = urldecode(CleanFileNameBan(strip_tags($result['Oriurl'])));
		print '<div class="box-post ktz-agc-search">';
		print '<h2><a href="'.get_search_link(CleanFileNameBan(hilangkan_spesial_karakter($result['title']))).'">'.CleanFileNameBan(hilangkan_spesial_karakter($result['title'])).'</a></h2>';
		print '<p>'.CleanFileNameBan(hilangkan_spesial_karakter($result['abstract'])).'</p>';
		print '<p>Sumber: '.$result['Oriurl'].'</p>';
		print '</div>';
		}
	}
	} 
	} else {
	
	echo spp(get_search_query());
	} 
	endif; ?>
		</section>
		</div>
	<?php get_sidebar(); ?>
	</div>
	</section>
<?php get_footer(); ?>
