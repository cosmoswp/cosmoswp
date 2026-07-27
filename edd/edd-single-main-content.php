<?php
/**
 * Template Part of edd single - Main Content
 *
 * @package CosmosWP
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$edd_single_elements      = cosmoswp_get_theme_options( 'edd-single-elements' );
$edd_single_side_elements = cosmoswp_get_theme_options( 'edd-single-side-elements' );

if ( ! is_array( $edd_single_elements ) || empty( $edd_single_elements ) ) {
	return;
}

$thumbnail_size = cosmoswp_get_theme_options( 'edd-img-size' );

while ( have_posts() ) :
	the_post();
	global $post;
	?>
	<div id="download-<?php the_ID(); ?>" <?php post_class(); ?>>
		<div class="cosmoswp-edd-single-grid-row">
			<div class="cwp-edd-download-gallery-content">
				<?php
				if ( 'disable' !== $thumbnail_size && has_post_thumbnail() ) {
					?>
					<div class="cwp-image-box cwp-elements">
						<a href="<?php the_permalink(); ?>">
							<?php the_post_thumbnail( $thumbnail_size ); ?>
						</a>
					</div>
					<?php
				}
				foreach ( $edd_single_elements as $element ) :
					if ( 'cats' === $element ) :
						echo wp_kses_post(
							get_the_term_list(
								get_the_ID(),
								'download_category',
								'<div class="cwp-edd-cat cwp-elements">',
								',',
								'</div>'
							)
						);
					elseif ( 'tags' === $element ) :
						echo wp_kses_post(
							get_the_term_list(
								get_the_ID(),
								'download_tag',
								'<div class="cwp-edd-tag cwp-elements">',
								'',
								'</div>'
							)
						);
					elseif ( 'author' === $element ) :
						?>
						<div class="download-author cwp-elements">
							<div class="download-author-box">
								<div class="download-author-avatar">
									<?php
									$author_id = $post->post_author;
									echo get_avatar(
										get_the_author_meta( 'user_email', $author_id ),
										'',
										'',
										'edd-author-alt'
									);
									?>
								</div>
								<ul>
									<li class="download-author-detail">
										<span class="download-author-name">
											<?php esc_html_e( 'Author:', 'cosmoswp' ); ?>
										</span>
										<span class="download-author-value">
											<?php echo esc_html( get_the_author() ); ?>
										</span>
									</li>
									<li class="download-author-signupdate">
										<span class="download-author-name">
											<?php esc_html_e( 'Author since:', 'cosmoswp' ); ?>
										</span>
										<?php $registered_date = get_userdata( $author_id )->user_registered; ?>
										<span class="download-author-value">
											<?php echo esc_html( wp_date( 'M d, Y', strtotime( $registered_date ) ) ); ?>
										</span>
									</li>
								</ul>
							</div>
						</div>
						<?php
					elseif ( 'published-date' === $element ) :
						echo esc_html( get_the_date() );
					elseif ( 'title' === $element ) :
						?>
						<header class="entry-header cwp-elements">
							<h2 class="entry-title">
								<a href="<?php the_permalink(); ?>" rel="bookmark">
									<?php the_title(); ?>
								</a>
							</h2>
						</header>
					<?php elseif ( 'price' === $element && ! edd_has_variable_prices( get_the_ID() ) ) : ?>
						<div class="cwp-elements cwp-edd-price">
							<?php echo esc_html( edd_get_download_price( get_the_ID() ) ); ?>
						</div>
					<?php elseif ( 'cart' === $element ) : ?>
						<div class="cwp-elements cwp-edd-cart">
							<?php echo edd_get_purchase_link(); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
						</div>
					<?php elseif ( 'excerpt' === $element ) : ?>
						<div class="entry-excerpt">
							<?php
							$length = cosmoswp_get_theme_options( 'edd-single-content-length' );
							if ( ! $length ) {
								echo wp_kses_post( strip_shortcodes( $post->post_excerpt ) );
							} else {
								echo wp_kses_post(
									wp_trim_words(
										strip_shortcodes( $post->post_excerpt ),
										$length
									)
								);
							}
							?>
						</div>
					<?php elseif ( 'content' === $element ) : ?>
						<div class="entry-content cwp-elements">
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

			<?php if ( is_array( $edd_single_side_elements ) && ! empty( $edd_single_side_elements ) ) : ?>
				<div class="cosmoswp-edd-single-sidebar">
					<?php
					foreach ( $edd_single_side_elements as $element ) :
						if ( 'cats' === $element ) :
							echo wp_kses_post(
								get_the_term_list(
									get_the_ID(),
									'download_category',
									'<div class="cwp-edd-cat cwp-elements">',
									',',
									'</div>'
								)
							);
						elseif ( 'tags' === $element ) :
							echo wp_kses_post(
								get_the_term_list(
									get_the_ID(),
									'download_tag',
									'<div class="cwp-edd-tag cwp-elements">',
									'',
									'</div>'
								)
							);
						elseif ( 'author' === $element ) :
							?>
							<div class="download-author cwp-elements">
								<div class="download-author-box">
									<div class="download-author-avatar">
										<?php
										$author_id = $post->post_author;
										echo get_avatar(
											get_the_author_meta( 'user_email', $author_id ),
											'',
											'',
											'edd-author-alt'
										);
										?>
									</div>
									<ul>
										<li class="download-author-detail">
											<span class="download-author-name">
												<?php esc_html_e( 'Author:', 'cosmoswp' ); ?>
											</span>
											<span class="download-author-value">
												<?php echo esc_html( get_the_author() ); ?>
											</span>
										</li>
										<li class="download-author-signupdate">
											<span class="download-author-name">
												<?php esc_html_e( 'Author since:', 'cosmoswp' ); ?>
											</span>
											<?php $registered_date = get_userdata( $author_id )->user_registered; ?>
											<span class="download-author-value">
												<?php echo esc_html( wp_date( 'M d, Y', strtotime( $registered_date ) ) ); ?>
											</span>
										</li>
									</ul>
								</div>
							</div>
							<?php
						elseif ( 'published-date' === $element ) :
							echo esc_html( get_the_date() );
						elseif ( 'title' === $element ) :
							?>
							<header class="entry-header cwp-elements">
								<h2 class="entry-title">
									<a href="<?php the_permalink(); ?>" rel="bookmark">
										<?php the_title(); ?>
									</a>
								</h2>
							</header>
						<?php elseif ( 'price' === $element && ! edd_has_variable_prices( get_the_ID() ) ) : ?>
							<div class="cwp-elements cwp-edd-price">
								<?php echo esc_html( edd_get_download_price( get_the_ID() ) ); ?>
							</div>
						<?php elseif ( 'cart' === $element ) : ?>
							<div class="cwp-elements cwp-edd-cart">
								<?php echo edd_get_purchase_link(); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
							</div>
						<?php elseif ( 'excerpt' === $element ) : ?>
							<div class="entry-excerpt">
								<?php
								$length = cosmoswp_get_theme_options( 'edd-single-content-length' );
								if ( ! $length ) {
									echo wp_kses_post( strip_shortcodes( $post->post_excerpt ) );
								} else {
									echo wp_kses_post(
										wp_trim_words(
											strip_shortcodes( $post->post_excerpt ),
											$length
										)
									);
								}
								?>
							</div>
						<?php elseif ( 'content' === $element ) : ?>
							<div class="entry-content cwp-elements">
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
			<?php endif; ?>
		</div>
	</div>
	<?php
endwhile;
