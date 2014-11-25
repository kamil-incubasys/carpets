<?php if (!is_page('delivery') && !is_page('Home') && !is_page('testimonials') && !is_page('checkout') && !is_page('faq') && !is_page('gallery') && !is_page('interior-design') && !is_page('login') && !is_page('maintenance') && !is_page('terms-and-conditions') && !is_page('My Account') && !is_page('cart') && !is_page('custom-made')): ?>
    <aside id="sidebar">
        <?php if (is_page('design')): ?>
            <h3>NEED AN EXPERT OPINION?</h3>
            <p>Not everyone can be an interior design expert; which is why we’ve sorted that out for you. </p>
            <p>Our free interior design consultation will help you decide which carpet is best for your house – to
                really make it a home.</p>
        <?php elseif (is_page('about-us')): ?>
            <h3>HANDMADE CARPET GALLERY</h3>
            <ul class="sidenav">
                <li><a href="#">History</a></li>
                <li><a href="#">Objective</a></li>
                <li><a href="#">Services</a></li>
            </ul>

        <?php
        elseif (is_page('store')): ?>
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
        <?php elseif(is_page('register')):?>
            <h3>CREATE AN ACCOUNT</h3>
            <div class="block">
                <p>To expedite future checkouts and receive emails.</p>
            </div>

        <?php
        else: ?>
            <?php if (is_active_sidebar('home_right_1')) : ?>
                <div id="primary-sidebar" class="primary-sidebar widget-area category_checkboxes" role="complementary">
                    <?php dynamic_sidebar('home_right_1'); ?>
                </div>
            <?php endif; ?>
        <?php endif; ?>
    </aside>
<?php endif; ?>
<?php if (is_active_sidebar('home_right_2')) : ?>
    <div id="secondary-sidebar">
        <?php dynamic_sidebar('home_right_2'); ?>
    </div>
<?php endif; ?>
<?php // wp_list_categories(); ?>
<?php // wp_list_pages(); ?>