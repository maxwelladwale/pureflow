<?php
/**
 * The main template file
 *
 * @package PureFlow
 */

if (!defined('ABSPATH')) {
    exit;
}

get_header();
?>

<main class="max-w-[1440px] mx-auto px-6 py-12">
    <div class="max-w-4xl mx-auto">
        <?php
        if (have_posts()) :
            while (have_posts()) :
                the_post();
                ?>
                <article id="post-<?php the_ID(); ?>" <?php post_class('mb-12'); ?>>
                    <h2 class="text-3xl font-bold mb-4">
                        <a href="<?php the_permalink(); ?>" class="hover:text-primary">
                            <?php the_title(); ?>
                        </a>
                    </h2>
                    <div class="prose max-w-none">
                        <?php the_content(); ?>
                    </div>
                </article>
                <?php
            endwhile;
            
            the_posts_navigation();
        else :
            ?>
            <p><?php esc_html_e('No content found', 'pureflow'); ?></p>
            <?php
        endif;
        ?>
    </div>
</main>

<?php
get_footer();
