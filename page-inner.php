<?php
/*
Template Name: Inner Page
*/
?>
<?php get_header() ?>

	<div id="content">
		<div id="main" role="main">


			<?php
			// check if the flexible content field has rows of data
			 if( have_rows('layout') ): ?>

			     <?php // loop through the rows of data
			     while ( have_rows('layout') ) : the_row(); ?>

			         <?php if( get_row_layout() == '1_column' ): ?>

					    <div class="container-fluid" style="background-color:<?php the_sub_field('background_color') ?>">
					     	<div class="row">
					      		<div class="col-12">

							       <h2 class="<?php if( get_sub_field('center_headline') == true ) { echo 'text-center'; } ?>">

							        <?php echo get_sub_field('headline'); ?>
							         
							          </h2>


							       <?php echo get_sub_field('column'); ?>
					       
					      		</div>
					     	</div>
					    </div>

			         <?php endif; ?>

			     <?php endwhile; ?>

			 <?php else : ?>

			     // no layouts found

			 <?php endif; ?>




            <?php // Output centered items 
			if(have_rows('flex_boxes')) : ?>
				<h3 class="box-head text-center"><?php the_field('flex_boxes_title'); ?></h3>
				<div class="flex-container"><!-- Begin flex-container -->
				<?php while (have_rows('flex_boxes')) : the_row();
					$image = get_sub_field('image');
					$textarea = get_sub_field('textarea');
				
					?>
					<div class="flex-item">
						<img src="<?php echo $image['url']; ?>" />
						<p><?php echo $textarea; ?></p>
					</div>
				<?php endwhile;

			endif;

				?>
			</div><!-- End flex-container -->


            <?php // Output centered items 
			if(have_rows('flex_boxes')) : ?>
				<h3 class="box-head text-center"><?php the_field('flex_boxes_title_2'); ?></h3>
				<div class="flex-container"><!-- Begin flex-container -->
				<?php while (have_rows('flex_boxes_2')) : the_row();
					$image = get_sub_field('image');
					$textarea = get_sub_field('textarea');
				
					?>
					<div class="flex-item">
						<img src="<?php echo $image['url']; ?>" />
						<p><?php echo $textarea; ?></p>
					</div>
				<?php endwhile;

			endif;

				?>
			</div><!-- End flex-container -->

            <?php // Output centered items 
			if(have_rows('flex_boxes')) : ?>
				<h3 class="box-head text-center"><?php the_field('flex_boxes_title_3'); ?></h3>
				<div class="flex-container"><!-- Begin flex-container -->
				<?php while (have_rows('flex_boxes_3')) : the_row();
					$image = get_sub_field('image');
					$textarea = get_sub_field('textarea');
				
					?>
					<div class="flex-item">
						<img src="<?php echo $image['url']; ?>" />
						<p><?php echo $textarea; ?></p>
					</div>
				<?php endwhile;

			endif;

				?>
			</div><!-- End flex-container -->

            <?php // Output centered items 
			if(have_rows('flex_boxes')) : ?>
				<h3 class="box-head text-center"><?php the_field('flex_boxes_title_4'); ?></h3>
				<div class="flex-container"><!-- Begin flex-container -->
				<?php while (have_rows('flex_boxes_4')) : the_row();
					$image = get_sub_field('image');
					$textarea = get_sub_field('textarea');
				
					?>
					<div class="flex-item">
						<img src="<?php echo $image['url']; ?>" />
						<p><?php echo $textarea; ?></p>
					</div>
				<?php endwhile;

			endif;

				?>
			</div><!-- End flex-container -->



            <?php // Output centered items 
			if(have_rows('flex_boxes')) : ?>
				<h3 class="box-head text-center"><?php the_field('flex_boxes_title_5'); ?></h3>
				<div class="flex-container"><!-- Begin flex-container -->
				<?php while (have_rows('flex_boxes_5')) : the_row();
					$image = get_sub_field('image');
					$textarea = get_sub_field('textarea');
				
					?>
					<div class="flex-item">
						<img src="<?php echo $image['url']; ?>" />
						<p><?php echo $textarea; ?></p>
					</div>
				<?php endwhile;

			endif;

				?>
			</div><!-- End flex-container -->			


            <?php // Output centered items 
			if(have_rows('flex_boxes')) : ?>
				<h3 class="box-head text-center"><?php the_field('flex_boxes_title_6'); ?></h3>
				<div class="flex-container">

				<!-- Begin flex-container -->
				<?php while (have_rows('flex_boxes_6')) : the_row(); 
					

					$image = get_sub_field('image');
					$textarea = get_sub_field('textarea');
					$bg_img = get_sub_field('bg_image');
					?>

				  

					<div class="flex-item">
						<img src="<?php echo $image['url']; ?>" />
						<p><?php echo $textarea; ?></p>
					</div>
				<?php endwhile;

			endif;

				?>
			</div><!-- End flex-container -->			

			<div id="stories" class="article-tiles">
				<div class="container">
					<h2><?= trans('Stories you may be interested in:', 'Des histoires qui pourraient vous intéresser :') ?></h2>
					<div class="preview">
						<div class="row tiles"><?php get_random_tiles() ?></div>
						<button type="button" class="link">
							<?= trans('See all stories', 'Voir toutes les histoires') ?>
						</button>
					</div>
				</div>
				<article-tiles class="hidden article-tiles" endpoint="<?= admin_url("admin-ajax.php?action=home_tiles"); ?>">
					<?php
						$categories = get_categories([
							'post_type' => 'post',
						]);
					?>
					<?php if (count($categories)): ?>
						<div class="filters">
							<div class="inner">
								<div class="heading">
									<span class="hidden-xs">
										<?= trans('Filter articles:', 'Filtrer les articles&nbsp;:') ?>
									</span>
									<span class="visible-xs-block" data-toggle="collapse" data-target="#article-filter-collapse">
										<?= trans('Filter articles below', 'Filtrer les articles') ?>
										<i class="fa fa-caret-down" aria-hidden="true"></i>
									</span>
								</div>
								<div id="article-filter-collapse">
									<button ng-class="{active: !selector}" ng-click="filter()">
										<?= trans('All articles', 'Tous les articles') ?>
									</button>
									<?php foreach ($categories as $category): 
										if( $category->name == 'Uncategorized') continue; ?>
										<?php $selector = ".term-{$category->term_id}" ?>
										<button ng-class="{active: selector=='<?= $selector ?>'}" ng-click="filter('<?= $selector ?>')" data-filter="<?= $selector ?>" data-slug="<?= $category->slug ?>">
											<?= $category->name ?>
										</button>
									<?php endforeach ?>
								</div>
							</div>
						</div>
					<?php endif ?>
					<div class="container">
						<div class="row tiles"><?php get_home_tiles() ?></div>
						<div infinite-scroll="more()" infinite-scroll-disabled="disableLoading">
							<submit-button class="more" type="button" ng-hide="!loading"><?= trans('Loading', 'Chargement') ?></submit-button>
						</div>
					</div>
				</article-tiles>
			</div>

		</div>
	</div>

<?php get_footer() ?>