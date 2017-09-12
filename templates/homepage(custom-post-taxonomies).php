<?php
/**
 * Template Name: Front Page Template
 *
 */
get_header(); ?>
	<div id="primary" class="homepage site-content">
		<div class="container-fluid">
			<section class="hero">
				<img src="<?= get_stylesheet_directory_uri().'/assets/images/melati-beach-resort-samui-3.jpg'?>" alt="" class="d-block mx-auto img-fluid">
			</section>
			<section class="featured-resorts">
				<div class="container">
					<h2 class="display-4 text-center">Featured Resorts</h2>
					<div class="resort-categories">
						<div class="row justify-content-center">
							<?php
								$terms = get_terms([
								    'taxonomy' => 'resort_countries',
								    'hide_empty' => false,
								    'order' => DESC
								]);
								if($terms) {
									foreach ( $terms as $term) {
										$image = get_field('country-image', 'resort_countries_'.$term->term_id); 
										$counter = ($counter == 3) ? 1 : ($counter + 1); ?>
										<div class="col-md-3 <?php if($counter != 1) echo 'ml-md-auto '; ?>col-8 mb-5">
											<a href="<?= get_term_link($term->term_id) ?>">
												<?php if($image){
											 	echo '<img src="'.$image['url'].'" alt="'.$term->name.'" class="img-fluid w-100">';
												} ?>
												<h3 class="display-4 text-center"><?= $term->name; ?></h3>
											</a>
										</div>
							<?php
									}
								}
							?>
						</div>
					</div>
				</div>
			</section>
		</div><!-- .container-fluid -->
	</div><!-- .primary -->
<?php get_footer(); ?>
