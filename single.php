<?php


get_header(); ?>


<?php

 if(have_posts()){

 	while(have_posts()):the_post();
    the_title();

    	if ( comments_open() || get_comments_number() ) {
						comments_template();
					}
 	endwhile;
 }

?>

<?php // get_sidebar('content'); ?>


<?php
get_sidebar();
get_footer();
