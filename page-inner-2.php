<?php
/*
Template Name: Inner Page
*/
?>
<?php get_header() ?>

	<div id="content" class="container">
		<div id="main" role="main">

			<?php while (have_posts()) : the_post() ?>

				<!--<div class="breadcrumb">
					<a href="//<?= //home_url() ?>"><?= //trans('Home','Accueil'); ?></a> &gt; -->
                    <!-- <?php //if ($post->post_parent): ?>
						<a href="<?= //get_permalink($post->post_parent) ?>"><?= //get_the_title($post->post_parent) ?></a> &gt;
					<?php //endif ?>
					<a href="<?= //get_permalink() ?>"><?php //the_title() ?></a>
				</div> -->

				<div id="maincontent"></div>

				<article class="row">
					<header class="col-sm-12">
						<!-- <h1><?php //the_title() ?></h1> -->

						<?php if (get_featured_image()): ?>
							<div class="featured-image">
								<img src="<?php the_featured_image('full') ?>" alt="<?php the_featured_image_alt() ?>">
							</div>
						<?php endif ?>

					</header>
					<div class="col-sm-offset-2 col-sm-8">
						<?php the_content() ?>
					</div>
				</article>
                

                
                <section class="col-sm-12"><!-- Begin Custom Fields Content Here -->
                	<h1><?php the_title() ?></h1>
					<div><!-- Begin ACF Loops -->
						<?php
							// check if the flexible content field has rows of data
							if( have_rows('inner_page_content_section') ):

							     // loop through the rows of data
							    while ( have_rows('inner_page_content_section') ) : the_row();

							        if( get_row_layout() == 'featured_content_inner_page' ):

							        	the_sub_field('featured_content_text');

							        endif;

							    endwhile;

							else :
                           
								echo 'No layouts found.'
							   
							endif;

						?>
					</div><!-- End ACF Loops -->
			    </section><!-- End Custom Fields Content Here -->


			<?php endwhile ?>

		</div>
	</div>

<?php get_footer() ?>
