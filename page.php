<?php
/*
Template Name: Default
*/
get_header(); ?>

<?php
$options = get_option( 'pu_theme_options' );
echo $options['name'];
?>
<div id="main-content" class="main-content">
	<?php
				while ( have_posts() ) : the_post();
				the_content();
					endwhile;
					?>
<?php // get_sidebar('content'); ?>

</div>
<?php

get_footer();
