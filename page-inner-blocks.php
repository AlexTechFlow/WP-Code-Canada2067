<?php
/**
 * Template Name: Page Inner Blocks
 */

function getCardItemClassFor2Colums($index, $is_column_2 = false) {
	if($index == 0 && $is_column_2) {
		return 'col-sm-offset-2';
	}
	return '';
}

?>
<?php get_header() ?>
 
	<div id="content" class="block_main">
		<div id="main" role="main">
		<?php while ( have_posts() ) : the_post(); ?>
				
			
			<?php while (have_rows('inner_page_blocks')) : the_row() ?>

				<?php if(  get_row_layout() == 'hero_section'): ?>
					<div style="background-color: <?php the_sub_field('background_color'); ?>; background-image: url(<?php the_sub_field('background_image'); ?>);" class="block_sections hero_block <?php the_sub_field('container_css_class'); ?>">
						<div class="container">
							<div class="row">
								<div class="col-sm-12">
									<h2><?php the_sub_field('section_title'); ?></h2>
									<div class="hero_content">
										<?php the_sub_field('section_html'); ?>
									</div>
								</div>
							</div>
						</div>
					</div>
				<?php elseif (get_row_layout() == 'card_sections__2_columns' || get_row_layout() == 'card_sections__3_columns') : ?>
					
					<?php
						$card_class = 'col-sm-4';
						$card_item_2 = false;
						if(get_row_layout() == 'card_sections__2_columns') {
							$card_item_2 = true;
						}
					?>

					<div style="background-color: <?php the_sub_field('background_color'); ?>; background-image: url(<?php the_sub_field('background_image'); ?>);" class="block_sections card_sections <?php the_sub_field('container_css_class'); ?>">
						<div class="container"> 
							<div class="row">
								<div class="col-sm-12">
									<h2 class="text-center"><?php the_sub_field('section_title'); ?></h2>
									<div class="row">
										<?php $cards = get_sub_field('card_details'); ?>
										<?php foreach ($cards as $card_index => $card) : ?>
										<div class="<?php echo $card_class; ?> <?php echo getCardItemClassFor2Colums($card_index, $card_item_2); ?> card_details">
											<img src="<?php echo $card['card_image']; ?>" class="img-responsive card_image" />
											<div class="card_content">
												<?php echo $card['card_content']; ?>
											</div>
										</div>
										<?php endforeach; ?>
									</div>
								</div>
							</div>
						</div>
					</div>


				<?php elseif(  get_row_layout() == 'image_stack_blocks'): ?>
					<div style="background-color: <?php the_sub_field('background_color'); ?>; background-image: url(<?php the_sub_field('background_image'); ?>);" class="block_sections image_stacks <?php the_sub_field('container_css_class'); ?>">
						<div class="container">
							
							<?php $counter = 0; ?>
							<?php while ( have_rows('image_block_details') ) : the_row(); ?>
							<?php $counter++; ?>
								<div class="stack_image_card image_block_<?php echo $counter; ?>">
									<div class="stack_featured">
										<img src="<?php the_sub_field('featured_image'); ?>" class="img-responsive" />
									</div>
									<div class="img_stack_content_block">
										<img class="img_stack_icon" src="<?php the_sub_field('icon'); ?>" />
										<p class="img_stack_content">
											<b><?php the_sub_field('title'); ?></b><br />
											<?php the_sub_field('sub_title'); ?>
										</p>
									</div>
								</div>
							<?php endwhile; ?>
							
						</div>
					</div>
				<?php endif; ?>

			<?php endwhile; ?>


			<div style="background-color: <?php the_field('dl_background_color'); ?>; background-image: url(<?php the_field('dl_background_image'); ?>);" class="block_sections <?php the_field('dl_container_css_class'); ?>">
				<div class="container">
					<div class="row">
						<div class="col-sm-12">
							<div class="dl_section_top">
								<?php the_field('dl_section_title'); ?>
							</div>
							<div class="do_contents">
								<div class="row">
								<?php while ( have_rows('downloads') ) : the_row(); ?>

									<div class="col-sm-4 single_download">
										<img src="<?php the_sub_field('download_image'); ?>" class="img-responsive dl_thumb" />
										<div class="dl_title">
											<?php the_sub_field('download_title'); ?>
										</div>
										<div class="dl_button">
											<a target="_blank" href="<?php the_sub_field('download_url'); ?>"><img src="<?php the_field('dl_button_image') ?>" /></a>
										</div>
									</div>
        							
    							<?php endwhile; ?>
    							</div>
							</div>
						</div>
					</div>
				</div>
			</div>


		<?php endwhile; ?>




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
