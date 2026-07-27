<?php
/**
 * Title: Landing
 * Slug: patterns-cosmoswp/landing
 * Template Types: front-page
 * Post Types: page
 * Description: A layout template for displaying the main landing front page.
 *
 * @package    Patterns_CosmosWP
 * @subpackage Patterns_CosmosWP/patterns
 * @since      1.0.0
 */

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
?>
<!-- wp:group {"metadata":{"patternName":"patterns-cosmoswp/landing","name":"Landing"},"className":"pwp-child-reset","layout":{"type":"default"}} -->
<div class="wp-block-group pwp-child-reset">
	
	<!-- wp:cover {"overlayColor":"secondary","isUserOverlayColor":true,"minHeight":90,"minHeightUnit":"vh","contentPosition":"top center","className":"cwp-strt-hero","layout":{"type":"constrained"}} -->
	<div class="wp-block-cover has-custom-content-position is-position-top-center cwp-strt-hero" style="min-height:90vh"><span aria-hidden="true" class="wp-block-cover__background has-secondary-background-color has-background-dim-100 has-background-dim"></span><div class="wp-block-cover__inner-container">
		<!-- wp:columns {"verticalAlignment":"center","align":"wide","style":{"spacing":{"blockGap":{"left":"120px"},"padding":{"top":"var:preset|spacing|80"}}}} -->
		<div class="wp-block-columns alignwide are-vertically-aligned-center" style="padding-top:var(--wp--preset--spacing--80)">
			<!-- wp:column {"verticalAlignment":"center"} -->
			<div class="wp-block-column is-vertically-aligned-center">
				<!-- wp:group {"style":{"spacing":{"padding":{"right":"var:preset|spacing|80"},"blockGap":"var:preset|spacing|40"}},"layout":{"type":"constrained"}} -->
				<div class="wp-block-group" style="padding-right:var(--wp--preset--spacing--80)">
				<!-- wp:heading {"level":1,"style":{"typography":{"fontStyle":"normal","fontWeight":"800","fontSize":"56px","lineHeight":1.4}},"textColor":"default"} -->
				<h1 class="wp-block-heading has-default-color has-text-color" style="font-size:56px;font-style:normal;font-weight:800;line-height:1.4">
					<?php esc_html_e( 'Design Your Idea', 'cosmoswp' ); ?>
				</h1>
				<!-- /wp:heading -->
				<!-- wp:buttons {"layout":{"type":"flex","flexWrap":"nowrap"}} -->
				<div class="wp-block-buttons">
					

					<!-- wp:button {"className":"is-style-fill","style":{"spacing":{"padding":{"left":"var:preset|spacing|40","right":"var:preset|spacing|40","top":"var:preset|spacing|20","bottom":"var:preset|spacing|20"}},"typography":{"textTransform":"uppercase","letterSpacing":"1px"}}} -->
						<div class="wp-block-button is-style-fill"><a class="wp-block-button__link wp-element-button" style="padding-top:var(--wp--preset--spacing--20);padding-right:var(--wp--preset--spacing--40);padding-bottom:var(--wp--preset--spacing--20);padding-left:var(--wp--preset--spacing--40);letter-spacing:1px;text-transform:uppercase"><?php esc_html_e( 'Get Started', 'cosmoswp' ); ?></a></div>
						<!-- /wp:button -->

				</div>
				<!-- /wp:buttons -->
				</div>
				<!-- /wp:group -->
			</div>
			<!-- /wp:column -->
			<!-- wp:column {"verticalAlignment":"center"} -->
			<div class="wp-block-column is-vertically-aligned-center">
				<!-- wp:image {"scale":"cover","sizeSlug":"full","linkDestination":"none","align":"center"} -->
				<figure class="wp-block-image aligncenter size-full"><img
				src="<?php echo esc_url( get_template_directory_uri() ); ?>/assets/img/featuredimage.png"
				alt="" style="object-fit:cover" /></figure>
				<!-- /wp:image -->
			</div>
			<!-- /wp:column -->
		</div>
		<!-- /wp:columns --></div></div>
	<!-- /wp:cover -->

	<!-- wp:group {"align":"full","layout":{"type":"constrained"}} -->
	<div class="wp-block-group alignfull">
		<!-- wp:group {"align":"full","className":"cwp-strt-cont-shape","style":{"spacing":{"margin":{"top":"-235px"},"padding":{"right":"0px","left":"0px","top":"0px","bottom":"0px"}},"dimensions":{"minHeight":"220px"},"background":{"backgroundImage":{"url":"<?php echo esc_url( get_template_directory_uri() ); ?>/assets/img/f-image.png","source":"file","title":"f-image"},"backgroundSize":"110%","backgroundAttachment":"scroll","backgroundPosition":"50% 0"}},"layout":{"type":"default"}} -->
		<div class="wp-block-group alignfull cwp-strt-cont-shape" style="min-height:220px;margin-top:-235px;padding-top:0px;padding-right:0px;padding-bottom:0px;padding-left:0px"></div>
		<!-- /wp:group -->
	</div>
	<!-- /wp:group -->
	<!-- wp:group {"align":"full","style":{"spacing":{"padding":{"top":"var:preset|spacing|40","bottom":"var:preset|spacing|80"},"blockGap":"0px"}},"backgroundColor":"default","layout":{"type":"constrained"}} -->
	<div class="wp-block-group alignfull has-default-background-color has-background" style="padding-top:var(--wp--preset--spacing--40);padding-bottom:var(--wp--preset--spacing--80)">
		<!-- wp:columns {"align":"wide","style":{"spacing":{"padding":{"top":"var:preset|spacing|30"},"blockGap":"var:preset|spacing|30"}}} -->
		<div class="wp-block-columns alignwide" style="padding-top:var(--wp--preset--spacing--30)">
		<!-- wp:column -->
		<div class="wp-block-column">
			<!-- wp:group {"style":{"spacing":{"blockGap":"30px"}},"backgroundColor":"default","layout":{"type":"flex","flexWrap":"nowrap","verticalAlignment":"top"}} -->
			<div class="wp-block-group has-default-background-color has-background">
				<!-- wp:image {"width":"80px","sizeSlug":"full","linkDestination":"none","style":{"color":{"duotone":"var:preset|duotone|primary"}}} -->
				<figure class="wp-block-image size-full is-resized"><img src="<?php echo esc_url( get_template_directory_uri() ); ?>/assets/img/fa-lightbulb-regular-pink.png" alt="" style="width:80px"/></figure>
				<!-- /wp:image -->
				<!-- wp:group {"style":{"spacing":{"blockGap":"var:preset|spacing|10"}},"layout":{"type":"constrained"}} -->
				<div class="wp-block-group">
				<!-- wp:heading {"level":5,"style":{"typography":{"lineHeight":"1","fontStyle":"normal","fontWeight":"700","fontSize":"18px"}}} -->
					<h5 class="wp-block-heading" style="font-size:18px;font-style:normal;font-weight:700;line-height:1"><?php esc_html_e( 'Business Consultancy', 'cosmoswp' ); ?></h5>
				<!-- /wp:heading -->

					<!-- wp:paragraph -->
					<p>
					<?php
						esc_html_e(
							'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut',
							'cosmoswp'
						);
						?>
					</p>
					<!-- /wp:paragraph -->
				</div>
				<!-- /wp:group -->
			</div>
			<!-- /wp:group -->
		</div>
		<!-- /wp:column -->
		<!-- wp:column -->
		<div class="wp-block-column">
			<!-- wp:group {"style":{"spacing":{"blockGap":"30px"}},"backgroundColor":"default","layout":{"type":"flex","flexWrap":"nowrap","verticalAlignment":"top"}} -->
			<div class="wp-block-group has-default-background-color has-background">
				<!-- wp:image {"width":"80px","sizeSlug":"full","linkDestination":"none","style":{"color":{"duotone":"var:preset|duotone|primary"}}} -->
				<figure class="wp-block-image size-full is-resized"><img src="<?php echo esc_url( get_template_directory_uri() ); ?>/assets/img/fa-chart-line-solid-pink.png" alt="" style="width:80px"/></figure>
				<!-- /wp:image -->
				<!-- wp:group {"style":{"spacing":{"blockGap":"var:preset|spacing|10"}},"layout":{"type":"constrained"}} -->
				<div class="wp-block-group">
					<!-- wp:heading {"level":5,"style":{"typography":{"lineHeight":"1","fontStyle":"normal","fontWeight":"700","fontSize":"18px"}}} -->
					<h5 class="wp-block-heading" style="font-size:18px;font-style:normal;font-weight:700;line-height:1"><?php esc_html_e( 'Help To Grow Business', 'cosmoswp' ); ?></h5>
					<!-- /wp:heading -->
					<!-- wp:paragraph -->
					<p>
					<?php
						esc_html_e(
							'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut',
							'cosmoswp'
						);
						?>
					</p>
					<!-- /wp:paragraph -->
				</div>
				<!-- /wp:group -->
			</div>
			<!-- /wp:group -->
		</div>
		<!-- /wp:column -->
		<!-- wp:column -->
		<div class="wp-block-column">
			<!-- wp:group {"style":{"spacing":{"blockGap":"30px"}},"backgroundColor":"default","layout":{"type":"flex","flexWrap":"nowrap","verticalAlignment":"top"}} -->
			<div class="wp-block-group has-default-background-color has-background">
				<!-- wp:image {"width":"80px","sizeSlug":"full","linkDestination":"none","style":{"color":{"duotone":"var:preset|duotone|primary"}}} -->
				<figure class="wp-block-image size-full is-resized"><img src="<?php echo esc_url( get_template_directory_uri() ); ?>/assets/img/fa-headphones-solid-pink.png" alt="" style="width:80px"/></figure>
				<!-- /wp:image -->
				<!-- wp:group {"style":{"spacing":{"blockGap":"var:preset|spacing|10"}},"layout":{"type":"constrained"}} -->
				<div class="wp-block-group">
					<!-- wp:heading {"level":5,"style":{"typography":{"lineHeight":"1","fontStyle":"normal","fontWeight":"700","fontSize":"18px"}}} -->
					<h5 class="wp-block-heading" style="font-size:18px;font-style:normal;font-weight:700;line-height:1"><?php esc_html_e( 'Help To Grow Business', 'cosmoswp' ); ?></h5>
					<!-- /wp:heading -->
					<!-- wp:paragraph -->
					<p>
					<?php esc_html_e( 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut', 'cosmoswp' ); ?>
					</p>
					<!-- /wp:paragraph -->
				</div>
				<!-- /wp:group -->
			</div>
			<!-- /wp:group -->
		</div>
		<!-- /wp:column -->
		</div>
		<!-- /wp:columns -->
	</div>
	<!-- /wp:group -->
	<!-- wp:group {"align":"full","style":{"spacing":{"padding":{"top":"var:preset|spacing|80","bottom":"var:preset|spacing|80"},"blockGap":"0"}},"backgroundColor":"tertiary","layout":{"type":"constrained"}} -->
	<div class="wp-block-group alignfull has-tertiary-background-color has-background" id="about" style="padding-top:var(--wp--preset--spacing--80);padding-bottom:var(--wp--preset--spacing--80)">
		<!-- wp:columns {"verticalAlignment":"center","align":"wide","style":{"spacing":{"blockGap":{"top":"var:preset|spacing|30","left":"var:preset|spacing|80"}}}} -->
		<div class="wp-block-columns alignwide are-vertically-aligned-center">
		<!-- wp:column {"verticalAlignment":"center"} -->
		<div class="wp-block-column is-vertically-aligned-center">
			<!-- wp:image {"sizeSlug":"full","linkDestination":"none","style":{"border":{"radius":"5px"}} -->
			<figure class="wp-block-image size-full"><img src="<?php echo esc_url( get_template_directory_uri() ); ?>/assets/img/img-2.jpg" alt="" style="border-radius:5px"/></figure>
			<!-- /wp:image -->
		</div>
		<!-- /wp:column -->
		<!-- wp:column {"verticalAlignment":"center","style":{"spacing":{"blockGap":"var:preset|spacing|30"}}} -->
		<div class="wp-block-column is-vertically-aligned-center">
			<!-- wp:group {"style":{"spacing":{"blockGap":"var:preset|spacing|10"}},"layout":{"type":"constrained"}} -->
			<div class="wp-block-group">
				<!-- wp:heading {"level":6,"style":{"typography":{"textTransform":"uppercase","fontSize":"13px","fontStyle":"normal","fontWeight":"500","letterSpacing":"1px"}}} -->
					<h6 class="wp-block-heading" style="font-size:13px;font-style:normal;font-weight:500;letter-spacing:1px;text-transform:uppercase"><?php esc_html_e( 'Powerful, not overpowering', 'cosmoswp' ); ?></h6>
				<!-- /wp:heading -->
				<!-- wp:heading {"style":{"spacing":{"margin":{"top":"0"}}}} -->
					<h2 class="wp-block-heading" style="margin-top:0">
					<?php esc_html_e( 'Marketing that gets great results', 'cosmoswp' ); ?>
				</h2>
				<!-- /wp:heading -->
				<!-- wp:paragraph {"align":"left"} -->
				<p class="has-text-align-left">
					<?php
					esc_html_e('Lorem ipsum dolor sit amet, consectetur adipisicing elit. Quas voluptatem maiores eaque similique non distinctio voluptates perspiciatis omnis, repellendus ipsa aperiam, laudantium voluptatum nulla?.',
					'cosmoswp');
					?>
				</p>
				<!-- /wp:paragraph -->
			</div>
			<!-- /wp:group -->
			<!-- wp:buttons {"layout":{"type":"flex","justifyContent":"left"}} -->
			<div class="wp-block-buttons">
				
				<!-- wp:button {"className":"is-style-fill","style":{"spacing":{"padding":{"left":"var:preset|spacing|20","right":"var:preset|spacing|20","top":"var:preset|spacing|10","bottom":"var:preset|spacing|10"}},"typography":{"textTransform":"uppercase","letterSpacing":"1px"}}} -->
					<div class="wp-block-button is-style-fill"><a class="wp-block-button__link wp-element-button" style="padding-top:var(--wp--preset--spacing--10);padding-right:var(--wp--preset--spacing--20);padding-bottom:var(--wp--preset--spacing--10);padding-left:var(--wp--preset--spacing--20);letter-spacing:1px;text-transform:uppercase"><?php esc_html_e( 'About us', 'cosmoswp' ); ?></a></div>
					<!-- /wp:button -->
			</div>
			<!-- /wp:buttons -->
		</div>
		<!-- /wp:column -->
		</div>
		<!-- /wp:columns -->
	</div>
	<!-- /wp:group -->
	<!-- wp:group {"align":"full","style":{"spacing":{"blockGap":"var:preset|spacing|50","padding":{"top":"var:preset|spacing|80","bottom":"var:preset|spacing|80"}}},"backgroundColor":"default","layout":{"type":"constrained"}} -->
	<div class="wp-block-group alignfull has-default-background-color has-background" id="services" style="padding-top:var(--wp--preset--spacing--80);padding-bottom:var(--wp--preset--spacing--80)">
		<!-- wp:group {"style":{"spacing":{"blockGap":"var:preset|spacing|10"}},"layout":{"type":"constrained"}} -->
		<div class="wp-block-group">
		
			<!-- wp:heading {"textAlign":"center","level":6,"style":{"typography":{"textTransform":"uppercase","fontSize":"13px","fontStyle":"normal","fontWeight":"500","letterSpacing":"1px"}}} -->
		<h6 class="wp-block-heading has-text-align-center" style="font-size:13px;font-style:normal;font-weight:500;letter-spacing:1px;text-transform:uppercase"><?php esc_html_e( 'Powerful, not overpowering', 'cosmoswp' ); ?></h6>
		<!-- /wp:heading -->
		<!-- wp:heading {"textAlign":"center","style":{"spacing":{"margin":{"top":"0"}}}} -->
		<h2 class="wp-block-heading has-text-align-center" style="margin-top:0">
			<?php esc_html_e( 'Connecting your business with the world', 'cosmoswp' ); ?>
		</h2>
		<!-- /wp:heading -->
		<!-- wp:paragraph {"align":"center"} -->
		<p class="has-text-align-center">
			<?php
			esc_html_e('Lorem ipsum dolor sit amet, consectetur adipisicing elit. Quas voluptatem maiores eaque similique non distinctio voluptates perspiciatis omnis, repellendus ipsa aperiam, laudantium voluptatum nulla?.',
			'cosmoswp');
			?>
		</p>
		<!-- /wp:paragraph -->
		</div>
		<!-- /wp:group -->

		<!-- wp:group {"align":"wide","layout":{"type":"grid","minimumColumnWidth":null,"columnCount":3}} -->
		<div class="wp-block-group alignwide"><!-- wp:image {"lightbox":{"enabled":true},"sizeSlug":"full","linkDestination":"none","className":"is-style-default","style":{"border":{"radius":"5px"},"color":{"duotone":"unset"}}} -->
		<figure class="wp-block-image size-full has-custom-border is-style-default"><img src="<?php echo esc_url( get_template_directory_uri() ); ?>/assets/img/img-4.jpg" alt="" style="border-radius:5px"/></figure>
		<!-- /wp:image -->

		<!-- wp:image {"lightbox":{"enabled":true},"sizeSlug":"full","linkDestination":"none","className":"is-style-default","style":{"border":{"radius":"5px"},"color":{"duotone":"unset"}}} -->
		<figure class="wp-block-image size-full has-custom-border is-style-default"><img src="<?php echo esc_url( get_template_directory_uri() ); ?>/assets/img/img-7.jpg" alt="" style="border-radius:5px"/></figure>
		<!-- /wp:image -->

		<!-- wp:image {"lightbox":{"enabled":true},"sizeSlug":"full","linkDestination":"none","className":"is-style-default","style":{"border":{"radius":"5px"},"color":{"duotone":"unset"}}} -->
		<figure class="wp-block-image size-full has-custom-border is-style-default"><img src="<?php echo esc_url( get_template_directory_uri() ); ?>/assets/img/img-5.jpg" alt="" style="border-radius:5px"/></figure>
		<!-- /wp:image -->

		<!-- wp:image {"lightbox":{"enabled":true},"sizeSlug":"full","linkDestination":"none","className":"is-style-default","style":{"border":{"radius":"5px"},"color":{"duotone":"unset"}}} -->
		<figure class="wp-block-image size-full has-custom-border is-style-default"><img src="<?php echo esc_url( get_template_directory_uri() ); ?>/assets/img/img-2.jpg" alt="" style="border-radius:5px;object-fit:cover"/></figure>
		<!-- /wp:image -->

		<!-- wp:image {"lightbox":{"enabled":true},"sizeSlug":"full","linkDestination":"none","className":"is-style-default","style":{"border":{"radius":"5px"},"color":{"duotone":"unset"}}} -->
		<figure class="wp-block-image size-full has-custom-border is-style-default"><img src="<?php echo esc_url( get_template_directory_uri() ); ?>/assets/img/img-3.jpg" alt="" style="border-radius:5px"/></figure>
		<!-- /wp:image -->

		<!-- wp:image {"lightbox":{"enabled":true},"sizeSlug":"full","linkDestination":"none","className":"is-style-default","style":{"border":{"radius":"5px"},"color":{"duotone":"unset"}}} -->
		<figure class="wp-block-image size-full has-custom-border is-style-default"><img src="<?php echo esc_url( get_template_directory_uri() ); ?>/assets/img/img-6.jpg" alt="" style="border-radius:5px"/></figure>
		<!-- /wp:image --></div>
		<!-- /wp:group -->        

		<!-- wp:buttons {"layout":{"type":"flex","justifyContent":"center"}} -->
		<div class="wp-block-buttons">
		<!-- wp:button {"className":"is-style-fill","style":{"spacing":{"padding":{"left":"var:preset|spacing|80","right":"var:preset|spacing|80","top":"var:preset|spacing|10","bottom":"var:preset|spacing|10"}},"typography":{"textTransform":"uppercase","letterSpacing":"1px"}}} -->
		<div class="wp-block-button is-style-fill"><a class="wp-block-button__link wp-element-button" style="padding-top:var(--wp--preset--spacing--20);padding-right:var(--wp--preset--spacing--60);padding-bottom:var(--wp--preset--spacing--20);padding-left:var(--wp--preset--spacing--60);letter-spacing:1px;text-transform:uppercase"><?php esc_html_e( 'All Services', 'cosmoswp' ); ?></a></div>
		<!-- /wp:button -->

		</div>
		<!-- /wp:buttons -->
	</div>
	<!-- /wp:group -->
	<!-- wp:group {"align":"full","style":{"spacing":{"padding":{"bottom":"var:preset|spacing|80"}}},"backgroundColor":"default","layout":{"type":"constrained"}} -->
	<div class="wp-block-group alignfull has-default-background-color has-background" style="padding-bottom:var(--wp--preset--spacing--80)">
		<!-- wp:columns {"align":"wide","style":{"spacing":{"blockGap":{"left":"var:preset|spacing|80"}}}} -->
		<div class="wp-block-columns alignwide">
		<!-- wp:column {"verticalAlignment":"top","width":"25%"} -->
		<div class="wp-block-column is-vertically-aligned-top" style="flex-basis:25%">
			<!-- wp:group {"style":{"spacing":{"padding":{"top":"var:preset|spacing|30","bottom":"var:preset|spacing|30","left":"var:preset|spacing|30","right":"var:preset|spacing|30"},"blockGap":"0"},"dimensions":{"minHeight":""},"layout":{"selfStretch":"fixed","flexSize":"300px"}},"layout":{"type":"flex","orientation":"vertical","justifyContent":"center","verticalAlignment":"center"}} -->
			<div class="wp-block-group" style="padding-top:var(--wp--preset--spacing--30);padding-right:var(--wp--preset--spacing--30);padding-bottom:var(--wp--preset--spacing--30);padding-left:var(--wp--preset--spacing--30)">
				<!-- wp:heading {"className":"has-text-align-center has-base-color has-text-color has-x-large-font-size"} -->
				<h2 class="wp-block-heading has-text-align-center has-base-color has-text-color has-x-large-font-size">
					<?php esc_html_e( '20+', 'cosmoswp' ); ?>
				</h2>
				<!-- /wp:heading -->
				<!-- wp:paragraph {"align":"center"} -->
				<p class="has-text-align-center"><?php esc_html_e( 'Winning Award', 'cosmoswp' ); ?></p>
				<!-- /wp:paragraph -->
			</div>
			<!-- /wp:group -->
		</div>
		<!-- /wp:column -->
		<!-- wp:column {"verticalAlignment":"top","width":"25%"} -->
		<div class="wp-block-column is-vertically-aligned-top" style="flex-basis:25%">
			<!-- wp:group {"style":{"spacing":{"padding":{"top":"var:preset|spacing|30","bottom":"var:preset|spacing|30","left":"var:preset|spacing|30","right":"var:preset|spacing|30"},"blockGap":"0px"},"dimensions":{"minHeight":""},"layout":{"selfStretch":"fixed","flexSize":"300px"}},"layout":{"type":"flex","orientation":"vertical","justifyContent":"center","verticalAlignment":"center"}} -->
			<div class="wp-block-group" style="padding-top:var(--wp--preset--spacing--30);padding-right:var(--wp--preset--spacing--30);padding-bottom:var(--wp--preset--spacing--30);padding-left:var(--wp--preset--spacing--30)">
				<!-- wp:heading {"className":"has-text-align-center has-base-color has-text-color has-x-large-font-size"} -->
				<h2 class="wp-block-heading has-text-align-center has-base-color has-text-color has-x-large-font-size">
					<?php esc_html_e( '100K+', 'cosmoswp' ); ?>
				</h2>
				<!-- /wp:heading -->
				<!-- wp:paragraph {"align":"center"} -->
				<p class="has-text-align-center"><?php esc_html_e( 'Happy Customers', 'cosmoswp' ); ?></p>
				<!-- /wp:paragraph -->
			</div>
			<!-- /wp:group -->
		</div>
		<!-- /wp:column -->
		<!-- wp:column {"verticalAlignment":"top","width":"25%"} -->
		<div class="wp-block-column is-vertically-aligned-top" style="flex-basis:25%">
			<!-- wp:group {"style":{"spacing":{"padding":{"top":"var:preset|spacing|30","bottom":"var:preset|spacing|30","left":"var:preset|spacing|30","right":"var:preset|spacing|30"},"blockGap":"0"},"dimensions":{"minHeight":""},"layout":{"selfStretch":"fixed","flexSize":"300px"}},"layout":{"type":"flex","orientation":"vertical","justifyContent":"center","verticalAlignment":"center"}} -->
			<div class="wp-block-group" style="padding-top:var(--wp--preset--spacing--30);padding-right:var(--wp--preset--spacing--30);padding-bottom:var(--wp--preset--spacing--30);padding-left:var(--wp--preset--spacing--30)">
				<!-- wp:heading {"className":"has-text-align-center has-base-color has-text-color has-x-large-font-size"} -->
				<h2 class="wp-block-heading has-text-align-center has-base-color has-text-color has-x-large-font-size">
					<?php esc_html_e( '20M+', 'cosmoswp' ); ?>
				</h2>
				<!-- /wp:heading -->
				<!-- wp:paragraph {"align":"center"} -->
				<p class="has-text-align-center"><?php esc_html_e( 'Working Hours', 'cosmoswp' ); ?></p>
				<!-- /wp:paragraph -->
			</div>
			<!-- /wp:group -->
		</div>
		<!-- /wp:column -->
		<!-- wp:column {"verticalAlignment":"top","width":"25%"} -->
		<div class="wp-block-column is-vertically-aligned-top" style="flex-basis:25%">
			<!-- wp:group {"style":{"spacing":{"padding":{"top":"var:preset|spacing|30","bottom":"var:preset|spacing|30","left":"var:preset|spacing|30","right":"var:preset|spacing|30"},"blockGap":"0"},"dimensions":{"minHeight":""},"layout":{"selfStretch":"fixed","flexSize":"300px"}},"layout":{"type":"flex","orientation":"vertical","justifyContent":"center","verticalAlignment":"center"}} -->
			<div class="wp-block-group" style="padding-top:var(--wp--preset--spacing--30);padding-right:var(--wp--preset--spacing--30);padding-bottom:var(--wp--preset--spacing--30);padding-left:var(--wp--preset--spacing--30)">
				<!-- wp:heading {"className":"has-text-align-center has-base-color has-text-color has-x-large-font-size"} -->
				<h2 class="wp-block-heading has-text-align-center has-base-color has-text-color has-x-large-font-size">
					<?php esc_html_e( '100+', 'cosmoswp' ); ?>
				</h2>
				<!-- /wp:heading -->
				<!-- wp:paragraph {"align":"center"} -->
				<p class="has-text-align-center"><?php esc_html_e( 'Completed Projects', 'cosmoswp' ); ?></p>
				<!-- /wp:paragraph -->
			</div>
			<!-- /wp:group -->
		</div>
		<!-- /wp:column -->
		</div>
		<!-- /wp:columns -->
	</div>
	<!-- /wp:group -->
	<!-- wp:group {"align":"full","style":{"spacing":{"blockGap":"var:preset|spacing|50","padding":{"top":"var:preset|spacing|80","bottom":"var:preset|spacing|80"}}},"backgroundColor":"tertiary","layout":{"type":"constrained"}} -->
	<div class="wp-block-group alignfull has-tertiary-background-color has-background" id="team" style="padding-top:var(--wp--preset--spacing--80);padding-bottom:var(--wp--preset--spacing--80)">
		<!-- wp:group {"align":"full","style":{"spacing":{"blockGap":"0px"}},"layout":{"type":"constrained"}} -->
		<div class="wp-block-group alignfull">
		<!-- wp:columns {"align":"wide"} -->
		<div class="wp-block-columns alignwide">
			<!-- wp:column -->
			<div class="wp-block-column">
				<!-- wp:group {"className":"alignwide","style":{"spacing":{"blockGap":"var:preset|spacing|10"}},"layout":{"type":"constrained"}} -->
				<div class="wp-block-group alignwide">            
					<!-- wp:heading {"level":6,"style":{"typography":{"textTransform":"uppercase","fontSize":"13px","fontStyle":"normal","fontWeight":"500","letterSpacing":"1px"}}} -->
				<h6 class="wp-block-heading" style="font-size:13px;font-style:normal;font-weight:500;letter-spacing:1px;text-transform:uppercase"><?php esc_html_e( 'Powerful, not overpowering', 'cosmoswp' ); ?></h6>
				<!-- /wp:heading -->
				<!-- wp:heading {"style":{"spacing":{"margin":{"top":"0"}}}} -->
					<h2 class="wp-block-heading" style="margin-top:0"><?php esc_html_e( 'Increase your productivity with digital tools created for you', 'cosmoswp' ); ?></h2>
					<!-- /wp:heading -->
				</div>
				<!-- /wp:group -->
			</div>
			<!-- /wp:column -->
			<!-- wp:column -->
			<div class="wp-block-column"></div>
			<!-- /wp:column -->
		</div>
		<!-- /wp:columns -->
		<!-- wp:columns {"verticalAlignment":"top","align":"wide"} -->
		<div class="wp-block-columns alignwide are-vertically-aligned-top">
			<!-- wp:column {"verticalAlignment":"top"} -->
			<div class="wp-block-column is-vertically-aligned-top">
				<!-- wp:group {"layout":{"type":"constrained"}} -->
				<div class="wp-block-group">
					<!-- wp:paragraph {"align":"left"} -->
					<p class="has-text-align-left"><?php esc_html_e( 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Quas voluptatem maiores eaque similique non distinctio voluptates perspiciatis omnis, repellendus ipsa aperiam, laudantium voluptatum nulla?', 'cosmoswp' ); ?></p>
					<!-- /wp:paragraph -->
				</div>
				<!-- /wp:group -->
			</div>
			<!-- /wp:column -->
			<!-- wp:column {"verticalAlignment":"top"} -->
			<div class="wp-block-column is-vertically-aligned-top">
				<!-- wp:paragraph -->
				<p class="has-text-align-left"><?php esc_html_e( 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Quas voluptatem maiores eaque similique non distinctio voluptates perspiciatis omnis, repellendus ipsa aperiam, laudantium voluptatum nulla?', 'cosmoswp' ); ?></p>
				<!-- /wp:paragraph -->
				<!-- wp:group {"style":{"spacing":{"blockGap":"0"}},"layout":{"type":"constrained"}} -->
			<div class="wp-block-group"><!-- wp:heading {"level":5,"className":"has-base-color has-text-color","style":{"typography":{"lineHeight":"1.5","textTransform":"uppercase","fontStyle":"normal","fontWeight":"600","fontSize":"14px"}}} -->
			<h5 class="wp-block-heading has-base-color has-text-color" style="font-size:14px;font-style:normal;font-weight:600;line-height:1.5;text-transform:uppercase"><?php esc_html_e( 'John Doe', 'cosmoswp' ); ?></h5>
			<!-- /wp:heading -->

			<!-- wp:paragraph {"align":"left","style":{"typography":{"fontSize":"14px"}}} -->
			<p class="has-text-align-left" style="font-size:14px"><?php esc_html_e( 'CEO &amp; Founder', 'cosmoswp' ); ?></p>
			<!-- /wp:paragraph --></div>
			<!-- /wp:group -->
				
			</div>
			<!-- /wp:column -->
		</div>
		<!-- /wp:columns -->
		</div>
		<!-- /wp:group -->
		<!-- wp:columns {"align":"wide"} -->
		<div class="wp-block-columns alignwide">
		<!-- wp:column -->
		<div class="wp-block-column">
			<!-- wp:group {"style":{"border":{"radius":"5px"},"spacing":{"blockGap":"0"}},"backgroundColor":"default","layout":{"type":"default"}} -->
			<div class="wp-block-group has-default-background-color has-background" style="border-radius:5px">
				<!-- wp:image {"sizeSlug":"full","linkDestination":"none","align":"center","style":{"border":{"radius":{"topLeft":"5px","topRight":"5px"}}}} -->
				<figure class="wp-block-image aligncenter size-full has-custom-border"><img src="<?php echo esc_url( get_template_directory_uri() ); ?>/assets/img/img-9.jpg" alt="" style="border-top-left-radius:5px;border-top-right-radius:5px"/></figure>
				<!-- /wp:image -->
				<!-- wp:group {"style":{"spacing":{"padding":{"top":"var:preset|spacing|40","bottom":"var:preset|spacing|40","left":"var:preset|spacing|20","right":"var:preset|spacing|20"},"blockGap":"0"}},"layout":{"type":"default"}} -->
				<div class="wp-block-group"
					style="padding-top:var(--wp--preset--spacing--40);padding-right:var(--wp--preset--spacing--20);padding-bottom:var(--wp--preset--spacing--40);padding-left:var(--wp--preset--spacing--20)">
					<!-- wp:heading {"textAlign":"center","level":5,"style":{"typography":{"fontSize":"18px","fontStyle":"normal","fontWeight":"600"}}} -->
					<h5 class="wp-block-heading has-text-align-center" style="font-size:18px;font-style:normal;font-weight:600"><?php esc_html_e( 'David Parker', 'cosmoswp' ); ?></h5>
					<!-- /wp:heading -->

					<!-- wp:paragraph {"align":"center"} -->
					<p class="has-text-align-center"><?php esc_html_e( 'Chief Executive Officer', 'cosmoswp' ); ?> </p>
					<!-- /wp:paragraph -->

					<!-- wp:social-links {"iconColor":"secondary","iconColorValue":"#293e5d","size":"has-normal-icon-size","align":"center","className":"is-style-logos-only","style":{"spacing":{"margin":{"top":"var:preset|spacing|20"}}}} -->
					<ul class="wp-block-social-links aligncenter has-normal-icon-size has-icon-color is-style-logos-only"
						style="margin-top:var(--wp--preset--spacing--20)"><!-- wp:social-link {"url":"#","service":"twitter"} /-->

						<!-- wp:social-link {"url":"#","service":"instagram"} /-->

						<!-- wp:social-link {"url":"#","service":"whatsapp"} /-->
					</ul>
					<!-- /wp:social-links -->
				</div>
				<!-- /wp:group -->
			</div>
			<!-- /wp:group -->
		</div>
		<!-- /wp:column -->
		<!-- wp:column -->
		<div class="wp-block-column">
			<!-- wp:group {"style":{"border":{"radius":"5px"},"spacing":{"blockGap":"0"}},"backgroundColor":"default","layout":{"type":"default"}} -->
			<div class="wp-block-group has-default-background-color has-background" style="border-radius:5px">
				<!-- wp:image {"sizeSlug":"full","linkDestination":"none","align":"center","style":{"border":{"radius":{"topLeft":"5px","topRight":"5px"}}}} -->
				<figure class="wp-block-image aligncenter size-full has-custom-border"><img
						src="<?php echo esc_url( get_template_directory_uri() ); ?>/assets/img/img-8.jpg"
						alt="" style="border-top-left-radius:5px;border-top-right-radius:5px" /></figure>
				<!-- /wp:image -->
				<!-- wp:group {"style":{"spacing":{"padding":{"top":"var:preset|spacing|40","bottom":"var:preset|spacing|40","left":"var:preset|spacing|20","right":"var:preset|spacing|20"},"blockGap":"0"}},"layout":{"type":"default"}} -->
				<div class="wp-block-group"
					style="padding-top:var(--wp--preset--spacing--40);padding-right:var(--wp--preset--spacing--20);padding-bottom:var(--wp--preset--spacing--40);padding-left:var(--wp--preset--spacing--20)">
					<!-- wp:heading {"textAlign":"center","level":5,"style":{"typography":{"fontSize":"18px","fontStyle":"normal","fontWeight":"600"}}} -->
					<h5 class="wp-block-heading has-text-align-center" style="font-size:18px;font-style:normal;font-weight:600">
						<?php esc_html_e( 'Jane Moon', 'cosmoswp' ); ?>
					</h5>
					<!-- /wp:heading -->

					<!-- wp:paragraph {"align":"center"} -->
					<p class="has-text-align-center">
						<?php esc_html_e( 'Vice President', 'cosmoswp' ); ?>
					</p>
					<!-- /wp:paragraph -->

					<!-- wp:social-links {"iconColor":"secondary","iconColorValue":"#293e5d","size":"has-normal-icon-size","align":"center","className":"is-style-logos-only","style":{"spacing":{"margin":{"top":"var:preset|spacing|20"}}}} -->
					<ul class="wp-block-social-links aligncenter has-normal-icon-size has-icon-color is-style-logos-only"
						style="margin-top:var(--wp--preset--spacing--20)"><!-- wp:social-link {"url":"#","service":"twitter"} /-->

						<!-- wp:social-link {"url":"#","service":"instagram"} /-->

						<!-- wp:social-link {"url":"#","service":"whatsapp"} /-->
					</ul>
					<!-- /wp:social-links -->
				</div>
				<!-- /wp:group -->
			</div>
			<!-- /wp:group -->
		</div>
		<!-- /wp:column -->
		<!-- wp:column -->
		<div class="wp-block-column">
			<!-- wp:group {"style":{"border":{"radius":"5px"},"spacing":{"blockGap":"0"}},"backgroundColor":"default","layout":{"type":"default"}} -->
			<div class="wp-block-group has-default-background-color has-background" style="border-radius:5px">
				<!-- wp:image {"sizeSlug":"full","linkDestination":"none","align":"center","style":{"border":{"radius":{"topLeft":"5px","topRight":"5px"}}}} -->
				<figure class="wp-block-image aligncenter size-full has-custom-border"><img
						src="<?php echo esc_url( get_template_directory_uri() ); ?>/assets/img/img-10.jpg"
						alt="" style="border-top-left-radius:5px;border-top-right-radius:5px" /></figure>
				<!-- /wp:image -->
				<!-- wp:group {"style":{"spacing":{"padding":{"top":"var:preset|spacing|40","bottom":"var:preset|spacing|40","left":"var:preset|spacing|20","right":"var:preset|spacing|20"},"blockGap":"0"}},"layout":{"type":"default"}} -->
				<div class="wp-block-group"
					style="padding-top:var(--wp--preset--spacing--40);padding-right:var(--wp--preset--spacing--20);padding-bottom:var(--wp--preset--spacing--40);padding-left:var(--wp--preset--spacing--20)">
					<!-- wp:heading {"textAlign":"center","level":5,"style":{"typography":{"fontSize":"18px","fontStyle":"normal","fontWeight":"600"}}} -->
					<h5 class="wp-block-heading has-text-align-center" style="font-size:18px;font-style:normal;font-weight:600">
						<?php esc_html_e( 'Paul Franky', 'cosmoswp' ); ?>
					</h5>
					<!-- /wp:heading -->

					<!-- wp:paragraph {"align":"center"} -->
					<p class="has-text-align-center">
						<?php esc_html_e( 'Chief Financial Officer', 'cosmoswp' ); ?>
					</p>
					<!-- /wp:paragraph -->

					<!-- wp:social-links {"iconColor":"secondary","iconColorValue":"#293e5d","size":"has-normal-icon-size","align":"center","className":"is-style-logos-only","style":{"spacing":{"margin":{"top":"var:preset|spacing|20"}}}} -->
					<ul class="wp-block-social-links aligncenter has-normal-icon-size has-icon-color is-style-logos-only"
						style="margin-top:var(--wp--preset--spacing--20)"><!-- wp:social-link {"url":"#","service":"twitter"} /-->

						<!-- wp:social-link {"url":"#","service":"instagram"} /-->

						<!-- wp:social-link {"url":"#","service":"whatsapp"} /-->
					</ul>
					<!-- /wp:social-links -->
				</div>
				<!-- /wp:group -->
			</div>
			<!-- /wp:group -->
		</div>
		<!-- /wp:column -->
		<!-- wp:column -->
		<div class="wp-block-column">
			<!-- wp:group {"style":{"border":{"radius":"5px"},"spacing":{"blockGap":"0"}},"backgroundColor":"default","layout":{"type":"default"}} -->
			<div class="wp-block-group has-default-background-color has-background" style="border-radius:5px">
				<!-- wp:image {"sizeSlug":"full","linkDestination":"none","align":"center","style":{"border":{"radius":{"topLeft":"5px","topRight":"5px"}}}} -->
				<figure class="wp-block-image aligncenter size-full has-custom-border"><img
						src="<?php echo esc_url( get_template_directory_uri() ); ?>/assets/img/img-11.jpg"
						alt="" style="border-top-left-radius:5px;border-top-right-radius:5px" /></figure>
				<!-- /wp:image -->
				<!-- wp:group {"style":{"spacing":{"padding":{"top":"var:preset|spacing|40","bottom":"var:preset|spacing|40","left":"var:preset|spacing|20","right":"var:preset|spacing|20"},"blockGap":"0"}},"layout":{"type":"default"}} -->
				<div class="wp-block-group"
					style="padding-top:var(--wp--preset--spacing--40);padding-right:var(--wp--preset--spacing--20);padding-bottom:var(--wp--preset--spacing--40);padding-left:var(--wp--preset--spacing--20)">
					<!-- wp:heading {"textAlign":"center","level":5,"style":{"typography":{"fontSize":"18px","fontStyle":"normal","fontWeight":"600"}}} -->
					<h5 class="wp-block-heading has-text-align-center" style="font-size:18px;font-style:normal;font-weight:600">
						<?php esc_html_e( 'Paul Franky', 'cosmoswp' ); ?>
					</h5>
					<!-- /wp:heading -->

					<!-- wp:paragraph {"align":"center"} -->
					<p class="has-text-align-center">
						<?php esc_html_e( 'Chief Financial Officer', 'cosmoswp' ); ?>
					</p>
					<!-- /wp:paragraph -->

					<!-- wp:social-links {"iconColor":"secondary","iconColorValue":"#293e5d","size":"has-normal-icon-size","align":"center","className":"is-style-logos-only","style":{"spacing":{"margin":{"top":"var:preset|spacing|20"}}}} -->
					<ul class="wp-block-social-links aligncenter has-normal-icon-size has-icon-color is-style-logos-only"
						style="margin-top:var(--wp--preset--spacing--20)"><!-- wp:social-link {"url":"#","service":"twitter"} /-->

						<!-- wp:social-link {"url":"#","service":"instagram"} /-->

						<!-- wp:social-link {"url":"#","service":"whatsapp"} /-->
					</ul>
					<!-- /wp:social-links -->
				</div>
				<!-- /wp:group -->
			</div>
			<!-- /wp:group -->
		</div>
		<!-- /wp:column -->
		</div>
		<!-- /wp:columns -->
	</div>
	<!-- /wp:group -->
	<!-- wp:group {"align":"full","style":{"spacing":{"padding":{"top":"var:preset|spacing|80","bottom":"var:preset|spacing|80"},"blockGap":"var:preset|spacing|60"}},"backgroundColor":"default","layout":{"type":"constrained"}} -->
	<div class="wp-block-group alignfull has-default-background-color has-background" style="padding-top:var(--wp--preset--spacing--80);padding-bottom:var(--wp--preset--spacing--80)">
		<!-- wp:group {"style":{"spacing":{"blockGap":"var:preset|spacing|10"}},"layout":{"type":"constrained"}} -->
		<div class="wp-block-group">
		
		<!-- wp:heading {"textAlign":"center","level":6,"style":{"typography":{"textTransform":"uppercase","fontSize":"13px","fontStyle":"normal","fontWeight":"500","letterSpacing":"1px"}}} -->
		<h6 class="wp-block-heading has-text-align-center" style="font-size:13px;font-style:normal;font-weight:500;letter-spacing:1px;text-transform:uppercase"><?php esc_html_e( 'Powerful, not overpowering', 'cosmoswp' ); ?></h6>
		<!-- /wp:heading -->
			<!-- wp:heading {"textAlign":"center","style":{"spacing":{"margin":{"top":"0"}}}} -->
		<h2 class="wp-block-heading has-text-align-center" style="margin-top:0"><?php esc_html_e( 'Clients really love us', 'cosmoswp' ); ?></h2>
		<!-- /wp:heading -->
		<!-- wp:paragraph {"align":"center"} -->
		<p class="has-text-align-center"><?php esc_html_e( 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Quas voluptatem maiores eaque similique non distinctio voluptates perspiciatis omnis, repellendus ipsa aperiam, laudantium voluptatum nulla?.', 'cosmoswp' ); ?></p>
		<!-- /wp:paragraph -->
		</div>
		<!-- /wp:group -->
		<!-- wp:columns {"className":"alignwide"} -->
		<div class="wp-block-columns alignwide">
		<!-- wp:column {"width":"20%"} -->
		<div class="wp-block-column" style="flex-basis:20%">
			<!-- wp:image {"width":"100px","sizeSlug":"full","linkDestination":"none","align":"center"} -->
			<figure class="wp-block-image aligncenter size-full is-resized"><img src="<?php echo esc_url( get_template_directory_uri() ); ?>/assets/img/logo-1.png" alt="" style="width:100px"/></figure>
			<!-- /wp:image -->
		</div>
		<!-- /wp:column -->
		<!-- wp:column {"width":"20%"} -->
		<div class="wp-block-column" style="flex-basis:20%">
			<!-- wp:image {"width":"100px","sizeSlug":"full","linkDestination":"none","align":"center"} -->
			<figure class="wp-block-image aligncenter size-full is-resized"><img src="<?php echo esc_url( get_template_directory_uri() ); ?>/assets/img/logo-2.png" alt="" style="width:100px"/></figure>
			<!-- /wp:image -->
		</div>
		<!-- /wp:column -->
		<!-- wp:column {"width":"20%"} -->
		<div class="wp-block-column" style="flex-basis:20%">
			<!-- wp:image {"width":"100px","sizeSlug":"full","linkDestination":"none","align":"center"} -->
			<figure class="wp-block-image aligncenter size-full is-resized"><img src="<?php echo esc_url( get_template_directory_uri() ); ?>/assets/img/logo-3.png" alt="" style="width:100px"/></figure>
			<!-- /wp:image -->
		</div>
		<!-- /wp:column -->
		<!-- wp:column {"width":"20%"} -->
		<div class="wp-block-column" style="flex-basis:20%">
			<!-- wp:image {"width":"100px","sizeSlug":"full","linkDestination":"none","align":"center"} -->
			<figure class="wp-block-image aligncenter size-full is-resized"><img src="<?php echo esc_url( get_template_directory_uri() ); ?>/assets/img/logo-4.png" alt="" style="width:100px"/></figure>
			<!-- /wp:image -->
		</div>
		<!-- /wp:column -->
		<!-- wp:column {"width":"20%"} -->
		<div class="wp-block-column" style="flex-basis:20%">
			<!-- wp:image {"width":"100px","sizeSlug":"full","linkDestination":"none","align":"center"} -->
			<figure class="wp-block-image aligncenter size-full is-resized"><img src="<?php echo esc_url( get_template_directory_uri() ); ?>/assets/img/logo-5.png" alt="" style="width:100px"/></figure>
			<!-- /wp:image -->
		</div>
		<!-- /wp:column -->
		</div>
		<!-- /wp:columns -->
	</div>
	<!-- /wp:group -->
	<!-- wp:cover {"url":"<?php echo esc_url( get_template_directory_uri() ); ?>/assets/img/img-2.jpg","dimRatio":50,"isDark":false,"align":"full","style":{"spacing":{"padding":{"top":"var:preset|spacing|80","right":"var:preset|spacing|30","bottom":"var:preset|spacing|80","left":"var:preset|spacing|30"}},"elements":{"link":{"color":{"text":"var:preset|color|default"}}}},"textColor":"default","layout":{"type":"constrained"}} -->
	<div class="wp-block-cover alignfull is-light has-default-color has-text-color has-link-color" style="padding-top:var(--wp--preset--spacing--80);padding-right:var(--wp--preset--spacing--30);padding-bottom:var(--wp--preset--spacing--80);padding-left:var(--wp--preset--spacing--30)" id="contact">
		<img class="wp-block-cover__image-background" src="<?php echo esc_url( get_template_directory_uri() ); ?>/assets/img/img-2.jpg" alt="" data-object-fit="cover"/><span aria-hidden="true" class="wp-block-cover__background has-background-dim"></span>
		<div class="wp-block-cover__inner-container">
		<!-- wp:group {"style":{"spacing":{"padding":{"right":"var:preset|spacing|80","left":"var:preset|spacing|80"}}},"layout":{"type":"constrained","wideSize":"","contentSize":""}} -->
		<div class="wp-block-group" style="padding-right:var(--wp--preset--spacing--80);padding-left:var(--wp--preset--spacing--80)">
			<!-- wp:group {"style":{"spacing":{"blockGap":"var:preset|spacing|10"}},"layout":{"type":"constrained"}} -->
			<div class="wp-block-group">
				<!-- wp:heading {"textAlign":"center"} -->
				<h2 class="wp-block-heading has-text-align-center"><?php esc_html_e( 'Setting up your website only takes a few minutes', 'cosmoswp' ); ?></h2>
				<!-- /wp:heading -->
				<!-- wp:paragraph {"align":"center"} -->
				<p class="has-text-align-center"><?php esc_html_e( 'Lorem ipsum dolor sit amet, consectetur adipisicing elit.Quas voluptatem maiores eaque similique non distinctio voluptates perspiciatis omnis', 'cosmoswp' ); ?></p>
				<!-- /wp:paragraph -->
			</div>
			<!-- /wp:group -->
			<!-- wp:group {"align":"full","className":"pw-form-style-1","layout":{"type":"constrained","wideSize":"300px"}} -->
			<div class="wp-block-group alignfull pw-form-style-1">
				<!-- wp:shortcode -->
				<?php esc_html_e( 'Add Contact form shortcode', 'cosmoswp' ); ?>
				<!-- /wp:shortcode -->
			</div>
			<!-- /wp:group -->
		</div>
		<!-- /wp:group -->
		</div>
	</div>
	<!-- /wp:cover -->
	<!-- wp:group {"align":"full","style":{"spacing":{"padding":{"top":"var:preset|spacing|80","bottom":"var:preset|spacing|80"},"blockGap":"var:preset|spacing|60"}},"backgroundColor":"default","layout":{"type":"constrained"}} -->
	<div class="wp-block-group alignfull has-default-background-color has-background" id="blog" style="padding-top:var(--wp--preset--spacing--80);padding-bottom:var(--wp--preset--spacing--80)">
		<!-- wp:group {"style":{"spacing":{"blockGap":"var:preset|spacing|10"}},"layout":{"type":"constrained"}} -->
		<div class="wp-block-group">
		<!-- wp:heading {"textAlign":"center","level":6,"style":{"typography":{"textTransform":"uppercase","fontSize":"13px","fontStyle":"normal","fontWeight":"500","letterSpacing":"1px"}}} -->
		<h6 class="wp-block-heading has-text-align-center" style="font-size:13px;font-style:normal;font-weight:500;letter-spacing:1px;text-transform:uppercase"><?php esc_html_e( 'Latest News', 'cosmoswp' ); ?></h6>
		<!-- /wp:heading -->
			<!-- wp:heading {"textAlign":"center","style":{"spacing":{"margin":{"top":"0"}}}} -->
		<h2 class="wp-block-heading has-text-align-center" style="margin-top:0">
			<?php esc_html_e( 'Find out the latest marketing news', 'cosmoswp' ); ?>
		</h2>
		<!-- /wp:heading -->
		
		
		
		<!-- wp:paragraph {"align":"center"} -->
		<p class="has-text-align-center"><?php esc_html_e( 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Quas voluptatem maiores eaque similique non distinctio voluptates perspiciatis omnis, repellendus ipsa aperiam, laudantium voluptatum nulla?.', 'cosmoswp' ); ?></p>
		<!-- /wp:paragraph -->
		</div>
		<!-- /wp:group -->
		<!-- wp:query {"queryId":6,"query":{"perPage":3,"pages":0,"offset":0,"postType":"post","order":"asc","orderBy":"date","author":"","search":"","exclude":[],"sticky":"exclude","inherit":false},"align":"wide"} -->
		<div class="wp-block-query alignwide">
		<!-- wp:post-template {"layout":{"type":"grid","columnCount":3}} -->
		<!-- wp:post-featured-image {"style":{"border":{"radius":"5px"},"spacing":{"margin":{"bottom":"var:preset|spacing|20"}}}} /-->
		<!-- wp:post-title {"level":5,"isLink":true} /-->
		<!-- wp:post-excerpt {"moreText":"Read more","excerptLength":20} /-->
		<!-- /wp:post-template -->
		</div>
		<!-- /wp:query -->
	</div>
	<!-- /wp:group -->
</div>
<!-- /wp:group -->
