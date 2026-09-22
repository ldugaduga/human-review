<?php
/**
 * Fallback template (required by WordPress). Not used for About or
 * How-it-works, which have their own page-*.php templates.
 */
get_header();
?>

  <div class="max-w-[1280px] mx-auto px-6 lg:px-10 py-20">
    <?php if ( have_posts() ) : ?>
      <?php while ( have_posts() ) : the_post(); ?>
        <article class="mb-12">
          <h1 class="font-display font-extrabold text-[34px] text-ink mb-4"><?php the_title(); ?></h1>
          <div class="prose text-ink/70"><?php the_content(); ?></div>
        </article>
      <?php endwhile; ?>
    <?php else : ?>
      <p class="text-ink/60">Nothing found.</p>
    <?php endif; ?>
  </div>

<?php get_footer(); ?>
