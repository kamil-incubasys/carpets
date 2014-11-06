				<aside id="sidebar">
					<h3>HANDMADE CARPET GALLERY</h3>
					<ul class="sidenav">
						<li><a href="#">History</a></li>
						<li><a href="#">Objective</a></li>
						<li><a href="#">Services</a></li>
					</ul>
                                        <?php if ( is_active_sidebar( 'left-sidebar' ) ) : ?>
                                                <ul id="sidebar">
                                                        <?php dynamic_sidebar( 'left-sidebar' ); ?>
                                                </ul>
                                        <?php endif; ?>
				</aside>
<?php // wp_list_categories(); ?>
<?php // wp_list_pages(); ?>