<?php
/**
 * Loop Price
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     1.6.4
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

global $product;
?>

<?php if ( $price_html = $product->get_price_html() ) : 
        $attributes = $product->get_attributes();

        if ( !empty($attributes) ) {
            $i = 0;
            foreach ( $attributes as $attribute ) {
                
                if ($i < 3){
                    if ( $attribute['is_taxonomy'] ) {
                        // skip variations
                        if ( $attribute['is_variation'] ) {
                            continue;
                        }

                        // backwards compatibility for attributes which are registered as taxonomies
                        $terms = wp_get_post_terms( $product->id, $attribute['name'], 'all' );  

                        // get the taxonomy
                        $tax = $terms[0]->taxonomy;

                        // get the tax object
                        $tax_object = get_taxonomy($tax);

                        // get tax label
                        if ( isset ($tax_object->labels->name) ) {
                            $tax_label = $tax_object->labels->name;
                        } elseif ( isset( $tax_object->label ) ) {
                            $tax_label = $tax_object->label;
                        }

                        foreach ( $terms as $term ) {
                            $out .= '<li><span class="title">';
                            $out .= $tax_label . '</span><span class="val">';
                            $out .= $term->name . '</span></li>';
                        }
                    }
                    else {
                        // not a taxonomy
                        $out .= '<li><span class="title">'.$attribute['name'] . '</span><span class="val">';
                        $out .= $attribute['value'] . '</span></li>';
                    }
                }
                else{
                    break;
                }
                $i++;
            }
            echo $out;
        }
        ?>
        <li><span class="title">Price</span><span class="val"><?php echo $price_html; ?></span></li>
<?php endif; ?>