<?php
/**
 * The Template for displaying all single posts
 *
 * @package WordPress
 * @subpackage Twenty_Twelve
 * @since Twenty Twelve 1.0
 */
?>
<?php get_header(); ?>

<?php if ( has_post_thumbnail() ) {the_post_thumbnail('full');} ?>
<?php echo get_post_meta($post->ID, "_name_of_post_type_field_one", true); ?>
<?php echo get_post_meta($post->ID, "_name_of_post_type_field_two", true); ?>
<?php echo get_post_meta($post->ID, "_name_of_post_type_field_three", true); ?>
<?php echo get_post_meta($post->ID, "_name_of_post_type_field_four", true); ?>
<?php echo get_post_meta($post->ID, "_name_of_post_type_field_five", true); ?>

	<div id="primary" class="site-content">
		<div id="content" role="main">
			
			<!--<?php while ( have_posts() ) : the_post(); ?>
				<div class="entry-content">
					<?php the_content(); ?>
				</div> .entry-content 
			<?php endwhile; ?>-->

		</div><!-- #content -->
	</div><!-- #primary -->

<?php get_sidebar(); ?>
<?php get_footer(); ?>
