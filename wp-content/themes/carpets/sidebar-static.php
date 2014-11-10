				<?php if (!is_page('delivery') && !is_page('collection') && !is_page('testimonials') && !is_page('checkout') ):?>
                                <aside id="sidebar">
                                    <?php if (is_page('design')):?>
                                    	<h3>NEED AN EXPERT OPINION?</h3>
					<p>Not everyone can be an interior design expert; which is why we’ve sorted that out for you. </p>
                                        <p>Our free interior design consultation will help you decide which carpet is best for your house – to really make it a home.</p>
                                    <?php elseif (is_page('home')): ?>
                                        <h3>HANDMADE CARPET GALLERY</h3>
                                        <ul class="sidenav">
                                                <li><a href="#">History</a></li>
                                                <li><a href="#">Objective</a></li>
                                                <li><a href="#">Services</a></li>
                                        </ul>
                                    <?php elseif (is_page('store')): ?>
                                        <h3>Singapore</h3>
					<div class="block">
						<strong>Address</strong>
						<address>
							133-135 Tanglin Road, <br>
							Tudor Court<br>
							Singapore 247925
						</address>
					</div>
					<div class="block">
						<strong>Telephone</strong>
						<p>(65) 67349500</p>
					</div>
					<div class="block">
						<strong>Office Hours</strong>
						<p>Mon - Sat 11:00 to 19:00</p>
					</div>
					<div class="block">
						<strong>General Inquiry</strong>
						<p><a href="mailto:info@handmadecarpetgallery.com">info@handmadecarpetgallery.com</a></p>
					</div>
                                    <?php else: ?>
                                        <?php if ( is_active_sidebar( 'home_right_1' ) ) : ?>
                                            <div id="primary-sidebar" class="primary-sidebar widget-area category_checkboxes" role="complementary">
                                                <?php dynamic_sidebar( 'home_right_1' ); ?>
                                            </div>
                                        <?php endif; ?>
                                    <?php endif; ?>  
                                    	 <div class="leftLabel"></div>
        <div class="rightLabel"></div>
                                            <div class="nstSlider" 
            data-range_min="0" data-range_max="100"   
            data-cur_min="10"  data-cur_max="90">     <!-- 2.1. add data attributes for the range: the min/max values the user can select -->
                                                      <!-- 2.2. add the slider values: the initial values within the range the grips should be initially set at -->

            <div class="highlightPanel"></div>        <!-- 2.3. (optional) you can use this in combination
                                                                with highlight_range if you need to, or
                                                                you can just omit it. Also, you can move
                                                                this element after as well if you want to
                                                                highlight above the slider grips -->

            <div class="bar"></div>                   <!-- 2.4. (optional) this is the bar that fills the
                                                                area between the left and the right grip -->
                                                                
            <div class="leftGrip"></div>              <!-- 2.5  the left grip -->
            <div class="rightGrip"></div>             <!-- 2.6  (optional) the right grip. Just omit if 
                                                                you don't need one -->
        </div>

        <!-- These two are actually exernal to the plugin, but you are likely to need them... the plugin
             does the math, but it's up to you to update the content of these two elements. -->
       
				</aside>
                                <?php endif; ?>
<?php // wp_list_categories(); ?>
<?php // wp_list_pages(); ?>