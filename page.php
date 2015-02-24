<?php
/*
Template Name: Default
*/
get_header(); ?>

<?php
$options = get_option( 'pu_theme_options' );
echo $options['pu_address'];
?>
<div id="main-content" class="main-content">
	<?php
				while ( have_posts() ) : the_post();
				the_content();

				if(has_post_thumbnail()){
					the_post_thumbnail();
				}
					endwhile;
					?>

</div>
<?php
$args = array('post_type'=>'post','posts_per_page' => 5);

$myposts = get_posts( $args );
foreach ( $myposts as $post ) : setup_postdata( $post ); ?>
	<li>
		<a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
		
				<?php if ( ! post_password_required() && ( comments_open() || get_comments_number() ) ) :
			?>
			<span class="comments-link"><?php comments_popup_link( __( 'Leave a comment' ), __( '1 Comment' ), __( '% Comments' ) ); ?></span>
			<?php
				endif;?>

	</li>
<?php endforeach; 
wp_reset_postdata();?>

<?php

get_footer();
