<?php
/*
Template Name: Full Width
*/

get_header(); ?>

				<!--<section id="content">-->
                                    <!--<?php if (have_posts()) : ?><?php while (have_posts()) : the_post(); ?>
                                    <h2><a href="<?php the_permalink() ?>" rel="bookmark" title="Permanent Link to <?php the_title(); ?>"><?php the_title(); ?></a></h2><small><?php the_time('F jS, Y') ?> by <?php the_author() ?> </small>
                                    <?php endwhile; ?>
                                    <?php else: ?><p>Sorry, there are no posts to display.</p>
                                    <?php endif; ?>-->
                                    <!--<div class="navigation">  <div class="alignleft"><?php previous_posts_link('&laquo; Previous Entries') ?></div>  <div class="alignright"><?php next_posts_link('Next Entries &raquo;') ?></div></div>-->
                                    <?php $id = get_the_ID();
                                    $post = get_page($id);
//                                    echo $post->_content;
                                    the_content();
                                    ?>
				<!--</section>-->
<?php get_footer(); ?>