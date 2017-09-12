<?php
get_header(); ?>
	<div id="primary" class="site-content">
		<div class="container-fluid">
			<section class="hero">
				<img src="<?= get_stylesheet_directory_uri().'/assets/images/melati-beach-resort-samui-3.jpg'?>" alt="" class="d-block mx-auto img-fluid">
			</section>
			<section class="featured-resorts">
				<div class="container">
					<h2 class="display-4 text-center">Featured Resorts</h2>
					<div class="resort-categories">
						<div class="row">
							<div class="country-title mx-auto">
							<?php
							//get_queried_object_id = current tax ID
							$term = get_term( get_queried_object_id(), 'resort_countries' );
							$image = get_field('country-image', 'resort_countries_'.$term->term_id);
							if($image) {
					    		echo '<img src="'.$image['url'].'" alt="'.$term->name.'" class="country-thumb">';
							}
					    	echo '<h3 class="display-4 ml-4">'.$term->name.'</h3>'; ?>
				    		</div>
						</div>
						<div class="row mt-5 text-center justify-content-center">
						<?php 
						$pages = get_posts(array(
						    'post_type' => 'resort_city',
						    'posts_per_page' => -1,
						    'tax_query' => array(
						        array(
						            'taxonomy' => 'resort_countries',
						            'field' => 'id',
						            'terms' => $term - > term_id,
						            'include_children' => false
						        )
						    ),
						    'order' => 'ASC'
						));
						foreach ( $pages as $post ) : setup_postdata( $post ); ?>
							<div class="col-md-4">
								<a href="<?php the_permalink(); ?>" class="display-4 city-name">
								<?php
									$image = get_field('resort_menu_image');
									if ( $image ) :
										echo '<img src="'.$image['url'].'" alt="'.$image['alt'].'" class="d-block mx-auto img-fluid">';
									endif;
								 the_title(); ?>
								</a>
							</div>
				<?php	endforeach; 
						wp_reset_postdata(); ?>
						</div>
					</div>
				</div>
			</section>
		</div><!-- .container-fluid -->
	</div><!-- .primary -->
<?php get_footer(); ?>
