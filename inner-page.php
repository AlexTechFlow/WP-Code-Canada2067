<?php
/*
Template Name: Inner Page
*/
?>

<?php get_header() ?>
	<div id="content">
		<div id="main" role="main">

			<?php 
    		echo get_post_meta($post->ID, 'featured_content', true)
			?>

			<?php while (have_rows('','option')) : the_row() ?>

				<?php if (get_row_layout() === 'video'): ?>
					<div class="content-block content-block--video" style="background-color:<?php the_sub_field('background_colour') ?>">
						<div class="column">
							<div class="column-container content" data-mh="content-block--video">
								<?php the_sub_field('content') ?>
							</div>
						</div>
						<div class="column">
							<div class="video" data-mh="content-block--video">
								<?php if ($video = get_sub_field('video_url')): ?>
									<?= apply_filters('embed_oembed_html', wp_oembed_get($video)) ?>
								<?php endif ?>
							</div>
						</div>
					</div>
				<?php endif ?>

				<?php if (get_row_layout() === 'ways_to_contribute'): ?>
					<div class="content-block content-block--ways-to-contribute">
						<div class="container">
							<h2>
								<img src="<?php the_sub_image_field('photo') ?>" alt="">
								<?php the_sub_field('title') ?>
							</h2>
							<div class="row ways">
								<?php while (have_rows('ways')) : the_row() ?>
									<div class="col-sm-4" data-mh="ways-to-contribute">
										<div class="step"><?php the_row_index() + 1 ?></div>
										<?php the_sub_field('content') ?>
									</div>
								<?php endwhile ?>
							</div>
						</div>
					</div>
				<?php endif ?>

				<?php if (get_row_layout() === 'free_text'): ?>
					<style type="text/css">
					#content-block--free-text--<?php the_row_index() ?> .content,
					#content-block--free-text--<?php the_row_index() ?> .content h2,
					#content-block--free-text--<?php the_row_index() ?> .content a {color:<?php the_sub_field('foreground_colour') ?>}
					</style>
					<div id="content-block--free-text--<?php the_row_index() ?>" class="content-block content-block--free-text" style="background-color:<?php the_sub_field('background_colour') ?>">
						<?php foreach (['column1', 'column2'] as $column): ?>
							<?php if (get_sub_field('content_column') === $column): ?>
								<div class="column">
									<div class="column-container content">
										<div class="inner"><?= do_shortcode(get_sub_field('content')) ?></div>
									</div>
								</div>
							<?php else: ?>
								<div class="column visuals" style="<?php the_sub_image_field('background_image','full',true) ?>">
									<img src="<?php the_sub_image_field('foreground_image') ?>" alt="">
									&nbsp;
								</div>
							<?php endif ?>
						<?php endforeach ?>
					</div>
				<?php endif ?>


				<?php if (get_row_layout() === 'free_section_block'): ?>
					<div id="content-block--free-section-block--<?php the_row_index() ?>" class="content-block content-free-section-block <?php the_sub_field('container_css_class'); ?>" style="background-color:<?php the_sub_field('background_colour') ?>; background-image: url('<?php the_sub_field('background_image'); ?>')">
						<div class="container">
							<?php echo do_shortcode(get_sub_field('content')) ?>
						</div>
					</div>
				<?php endif ?>


			<?php endwhile ?>




			<div id="maincontent"></div>

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
			</div><!-- End div id="stories" -->


		</div><!--End div id="content" -->
	</div><!--End id="main" role="main" -->
<?php get_footer() ?>
