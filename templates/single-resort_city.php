<?php
get_header(); ?>
	<div id="primary" class="site-content">
		<div class="container-fluid">
			<section class="hero">
			<?php
			$thumb = get_stylesheet_directory_uri().'/assets/images/melati-beach-resort-samui-3.jpg';
			if ( has_post_thumbnail( $post->ID ) ) :
				$thumb = get_the_post_thumbnail_url( $post->ID );
			endif;
			?>
				<img src="<?= $thumb ?>" alt="<?= $post->post_title ?>" class="d-block mx-auto img-fluid">
			</section>
			<section class="featured-resorts">
				<div class="container">
					<h2 class="display-4 text-center">Featured Resorts</h2>
					<div class="resort-categories text-center">
						<div class="row">
							<div class="col-md-11 mx-auto">
							<?php
							while (have_posts()):
								the_post(); ?>
									<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
										<div class="entry-content">
											<?php the_content(); ?>
										</div><!-- .entry-content -->
									</article><!-- #post -->
							<?php endwhile; ?>
							</div>
						</div>
					</div>
				</div>
			</section>
		</div><!-- .container-fluid -->
	</div><!-- .primary -->
<?php get_footer(); ?>
