<?php
/*
Template Name: Home
*/
get_header(); ?>
<?php get_sidebar('static'); ?>
				<section id="home_template">
                                    <div class="col-details">
                                        <?php
$args = array(  
    'post_type' => 'product',  
    'meta_key' => '_featured',  
    'meta_value' => 'yes',  
    'posts_per_page' => 4
);  
  
$featured_query = new WP_Query( $args );  
      
if ($featured_query->have_posts()) :   
  
    while ($featured_query->have_posts()) :   
      
        $featured_query->the_post();  
          
        $product = get_product( $featured_query->post->ID );  
          
        // Output product information here  
        wc_get_template_part( 'content', 'product' );
          
    endwhile;  
      
endif;  
  
wp_reset_query(); // Remember to reset
                                    ?>    
                                        </div>
                                    <div class="collection-area">
                                        <?php the_content(); ?>
                                        <div class="img-hold">
                                            <a href="<?php echo get_site_url(); ?>/custom-made">
						<img src="http://carpets.incubasys.com/wp-content/uploads/2014/11/img-31.jpg" alt="">
						<span class="caption">Custom Made</span>
                                            </a>
					</div>
                                    </div>
				</section>
<style>
    #main h2 {
        display: none;
    }
</style>
<?php get_footer(); ?>