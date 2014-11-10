			</div>
		</div>
		<footer id="footer">
			<div class="holder">
				<div class="f-content">
					<div class="image-area">
						<img src="<?php bloginfo('template_directory') ?>/assets/images/carpet-logo.png" alt="">
					</div>
					<div class="text-area">
						<h3>Handmade Carpet Gallery offers the widest range of carpets on the market </h3>
						<p>For several years Handmade Carpet Gallery has had the broadest and most diverse selection of hand-knotted and hand-woven carpets on the market. Here you'll find everything from the most exclusive to the more traditional nomadic and village carpets. Our strategy is to offer our customers a carefully composed online selection of quality carpets at the best price. By providing simple and easy-navigation, we want to make it easy for you to find the carpet(s) you are looking for. In our comprehensive selection you will find lots of high quality Oriental, Persian, Kilims, Designer and Contemporary carpets to choose from. The shop is full of carpets in different prices, colours, shapes and sizes and we offer a variety of oblong, round, oval and square carpets to name a few. Thanks to our wide selection and high level of personalised service we have managed to build up a clientele of thousands of satisfied repeat customers. We welcome you to come try us out!</p>
					</div>
				</div>
				<ul class="payment-list">
					<li><img src="<?php bloginfo('template_directory') ?>/assets/images/logo1.png" alt=""></li>
					<li><img src="<?php bloginfo('template_directory') ?>/assets/images/logo2.png" alt=""></li>
					<li><img src="<?php bloginfo('template_directory') ?>/assets/images/logo3.png" alt=""></li>
					<li><img src="<?php bloginfo('template_directory') ?>/assets/images/logo4.png" alt=""></li>
					<li><img src="<?php bloginfo('template_directory') ?>/assets/images/logo5.png" alt=""></li>
					<li><img src="<?php bloginfo('template_directory') ?>/assets/images/logo6.png" alt=""></li>
				</ul>
			</div>
			
		</footer>
		<div class="info-area">
				
				<?php
					$defaults = array(										
						'container_class' => 'holder',
						'menu_class' => 'fnav',
						'items_wrap'      => '<ul class="%2$s">%3$s</ul><span class="info">(65) 67349500 | <a href="mailto:info@handmadecarpetgallery.com">info@hanmadecarpetgallery.com</a></span>'
						
					);

					wp_nav_menu( $defaults );

?>

				<!-- <div class="holder">
					<ul class="fnav">
						
					<li><a href="<?php echo get_site_url(); ?>">About</a></li>
					<li><a href="#">Contact</a></li>
					<li><a href="#">FAQ</a></li>
					<li><a href="#">Inspiration</a></li>
					<li><a href="#">Store Directory</a></li>
					<li><a href="#">Terms &amp; Conditions</a></li>
					</ul>
				<span class="info">(65) 67349500 | <a href="mailto:info@handmadecarpetgallery.com">info@hanmadecarpetgallery.com</a></span>
				</div> -->
			</div>
	</div>
        <?php // wp_footer(); ?>
        <script>
        (function($){
            $(document).ready(function () {
                $('.nstSlider').nstSlider({
                    "left_grip_selector": ".leftGrip",
                    "right_grip_selector": ".rightGrip",
                    "value_bar_selector": ".bar",
                    "value_changed_callback": function(cause, leftValue, rightValue) {
                        $('.leftLabel').text(leftValue);
                        $('.rightLabel').text(rightValue);
                        $( '#min_price' ).val(leftValue);
                        $( '#max_price' ).val(rightValue);
                    },
                });
            });
            })(jQuery);

            // Call methods and such...
            // var highlightMin = Math.random() * 20,
            //     highlightMax = highlightMin + Math.random() * 80;
            // $('.nstSlider').nstSlider('highlight_range', highlightMin, highlightMax);
        </script>
</body>
</html>