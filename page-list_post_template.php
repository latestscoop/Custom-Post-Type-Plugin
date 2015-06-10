<?php
/**
 * Template Name: Template - Lists posts
*/
?>
<?php get_header(); ?>

	<div id="primary" class="site-content">
		<div id="content" role="main">
			
			<?php while ( have_posts() ) : the_post(); ?>
				<?php get_template_part( 'content', 'page' ); ?>
				
                <!--Select Custom Post Type-->
				<?php $loop = new WP_Query( array( 'post_type' => 'name_of_post_type', 'posts_per_page' => 10 ) ); ?>

				<?php while ( $loop->have_posts() ) : $loop->the_post(); ?>
                	<?php echo the_permalink(); ?>
                    <?php echo get_the_title(); ?>
                    <?php if ( has_post_thumbnail() ) { the_post_thumbnail(); } ?>
					<?php echo get_post_meta($post->ID, "_name_of_post_type_field_one", true); ?>
					<?php echo get_post_meta($post->ID, "_name_of_post_type_field_two", true); ?>
					<?php echo get_post_meta($post->ID, "_name_of_post_type_field_three", true); ?>
					<?php echo get_post_meta($post->ID, "_name_of_post_type_field_four", true); ?>
					<?php echo get_post_meta($post->ID, "_name_of_post_type_field_five", true); ?>
				<?php endwhile; ?>
				
			<?php endwhile; // end of the loop. ?>

		</div><!-- #content -->
	</div><!-- #primary -->

<?php get_sidebar(); ?>
<?php get_footer(); ?>
