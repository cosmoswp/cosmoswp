<?php
/**
 * Template Part of edd archive - Main Content
 *
 * @package CosmosWP
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( have_posts() ) :
	// Get archive elements settings.
	$edd_archive_list_elements = cosmoswp_get_theme_options( 'edd-archive-grid-elements' );
	$edd_archive_list_elements = apply_filters( 'cosmoswp_edd_archive_list_elements', $edd_archive_list_elements );

	if ( ! is_array( $edd_archive_list_elements ) || empty( $edd_archive_list_elements ) ) {
		return;
	}

	$edd_archive_show_sort_bar  = cosmoswp_get_theme_options( 'edd-archive-show-sort-bar' );
	$edd_archive_default_view   = cosmoswp_get_theme_options( 'edd-archive-default-view' );
	$edd_archive_elements_align = cosmoswp_get_theme_options( 'edd-archive-elements-align' );
	$edd_archive_show_grid_list = cosmoswp_get_theme_options( 'edd-archive-show-grid-list' );
	?>
	<div class="grid-row cosmoswp-edd-grid-row <?php echo esc_attr( $edd_archive_default_view ); ?>">
		<div class="grid-12">
			<div class="cwp-edd-archive-toolbar">
				<?php if ( $edd_archive_show_grid_list ) : ?>
					<div class="cwp-edd-view-switcher">
						<span class="cwp-trigger-grid <?php echo esc_attr( cosmoswp_get_correct_fa_font( 'fas fa-th' ) ); ?> <?php echo 'grid' === $edd_archive_default_view ? 'active' : ''; ?>"></span>
						<span class="cwp-trigger-list <?php echo esc_attr( cosmoswp_get_correct_fa_font( 'fas fa-list' ) ); ?> <?php echo 'list' === $edd_archive_default_view ? 'active' : ''; ?>"></span>
					</div>
				<?php endif; ?>
				
				<?php
				if ( $edd_archive_show_sort_bar ) {
					echo cosmoswp_edd_sorting(); //phpcs:ignore
				}
				?>
			</div>
		</div>

		<?php
		while ( have_posts() ) :
			the_post();
			global $post;
			$columns = cosmoswp_get_theme_options( 'edd-show-downloads-per-row' );
			$columns = json_decode( $columns, true );

			$grid_classes = array(
				esc_attr( cosmoswp_get_l_grid_class( $columns['desktop'] ) ),
				esc_attr( cosmoswp_get_grid_class( $columns['tablet'] ) ),
				esc_attr( cosmoswp_get_s_grid_class( $columns['mobile'] ) ),
				esc_attr( $edd_archive_elements_align ),
			);
			?>
			<div id="download-<?php the_ID(); ?>" <?php post_class( implode( ' ', $grid_classes ) ); ?>>
				<div class="cwp-image-box cwp-list-image-box">
					<div class="cwp-elements">
						<a href="<?php the_permalink(); ?>">
							<?php the_post_thumbnail( 'full' ); ?>
						</a>
					</div>
				</div>
				
				<div class="cwp-product-content">
					<?php
					foreach ( $edd_archive_list_elements as $element ) :
						if ( 'image' === $element ) :
							?>
							<div class="cwp-image-box cwp-elements">
								<a href="<?php the_permalink(); ?>">
									<?php the_post_thumbnail( 'full' ); ?>
								</a>
							</div>
							<?php
						elseif ( 'cats' === $element ) :
							echo wp_kses_post( get_the_term_list( get_the_ID(), 'download_category', '<div class="cwp-edd-cat cwp-elements">', ',', '</div>' ) );
						elseif ( 'tags' === $element ) :
							echo wp_kses_post( get_the_term_list( get_the_ID(), 'download_tag', '<div class="cwp-edd-tag cwp-elements">', ',', '</div>' ) );
						elseif ( 'author' === $element ) :
							?>
							<div class="cwp-elements"><?php echo esc_html( get_the_author() ); ?></div>
						<?php elseif ( 'published-date' === $element ) : ?>
							<div class="cwp-elements"><?php echo esc_html( get_the_date() ); ?></div>
						<?php elseif ( 'title' === $element ) : ?>
							<header class="entry-header cwp-elements">
								<h2 class="entry-title"><a href="<?php the_permalink(); ?>" rel="bookmark"><?php the_title(); ?></a></h2>
							</header>
						<?php elseif ( 'price' === $element && ! edd_has_variable_prices( get_the_ID() ) ) : ?>
							<div class="cwp-edd-price cwp-elements"><?php echo esc_html( edd_get_download_price( get_the_ID() ) ); ?></div>
							<?php
						elseif ( 'cart' === $element ) :
							echo edd_get_purchase_link();//phpcs:ignore
						elseif ( 'excerpt' === $element ) :
							?>
							<div class="entry-excerpt">
								<?php
								$length = cosmoswp_get_theme_options( 'edd-archive-content-length' );
								if ( ! $length ) {
									echo wp_kses_post( strip_shortcodes( $post->post_excerpt ) );
								} else {
									echo wp_kses_post( wp_trim_words( strip_shortcodes( $post->post_excerpt ), $length ) );
								}
								?>
							</div>
						<?php elseif ( 'content' === $element ) : ?>
							<div class="entry-content">
								<?php
								the_content();
								wp_link_pages(
									array(
										'before' => '<div class="page-links">' . __( 'Pages:', 'cosmoswp' ),
										'after'  => '</div>',
									)
								);
								?>
							</div>
							<?php
						endif;
					endforeach;
					?>
				</div>
			</div>
		<?php endwhile; ?>
	</div>

	<div class="grid-row">
		<div class="grid-12">
			<div class="cwp-edd-pagination">
				<?php do_action( 'cosmoswp_action_edd_navigation' ); ?>
			</div>
		</div>
	</div>
	<?php
else :
	get_template_part( './template-parts/content', 'none' );
endif;
