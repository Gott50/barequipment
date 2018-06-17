<?php
/**
 * Template used to display product content on single pages.
 *
 * @package storefront
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}


global $product;
if ( empty( $product ) || ! $product->is_visible() ) {
	?>
    <style>
        .site-header,
        .site-branding,
        .site-search,
        .woocommerce-breadcrumb,
        .site-footer,
        .product_meta,
        .related.products {
            display: none !important;
        }


        .site-content {
            margin-top: 4.235801032em;
        }

        .star-rating span::before {
            color: #ffc100;
        }

        @media (max-width: 568px) {
            .site-content,
            .single-product div.product .woocommerce-product-gallery,
            .single-product div.product p.price,
            .single-product div.product .woocommerce-product-rating,
            .stock.in-stock {
                margin: 0;
            }
            .onsale {
                margin: 14px 0 0 0;
            }
        }

    </style>
<?php
}

/**
 * Hook Woocommerce_before_single_product.
 *
 * @hooked wc_print_notices - 10
 */
do_action( 'woocommerce_before_single_product' );

if ( post_password_required() ) {
	echo get_the_password_form(); // WPCS: XSS ok.
	return;
}
?>
<div id="product-<?php the_ID(); ?>" <?php post_class(); ?>>

	<?php
	/**
	 * Hook: woocommerce_before_single_product_summary.
	 *
	 * @hooked woocommerce_show_product_sale_flash - 10
	 * @hooked woocommerce_show_product_images - 20
	 */
	do_action( 'woocommerce_before_single_product_summary' );
	?>

    <div class="summary entry-summary">
		<?php
		/**
		 * Hook: Woocommerce_single_product_summary.
		 *
		 * @hooked woocommerce_template_single_title - 5
		 * @hooked woocommerce_template_single_rating - 10
		 * @hooked woocommerce_template_single_price - 10
		 * @hooked woocommerce_template_single_add_to_cart - 19
		 * @hooked woocommerce_template_single_excerpt - 20
		 * @hooked woocommerce_template_single_meta - 40
		 * @hooked woocommerce_template_single_sharing - 50
		 * @hooked WC_Structured_Data::generate_product_data() - 60
		 */
		remove_action( "woocommerce_single_product_summary", "woocommerce_template_single_add_to_cart",30 );
		add_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_add_to_cart', 19 );
		do_action( 'woocommerce_single_product_summary' );
		?>
    </div>

	<?php
	/**
	 * Hook: woocommerce_after_single_product_summary.
	 *
	 * @hooked woocommerce_output_product_data_tabs - 10
	 * @hooked woocommerce_upsell_display - 15
	 * @hooked woocommerce_output_related_products - 20
	 */
	do_action( 'woocommerce_after_single_product_summary' );
	?>
</div>

<?php do_action( 'woocommerce_after_single_product' ); ?>
