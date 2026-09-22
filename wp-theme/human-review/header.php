<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>" />
<meta name="viewport" content="width=device-width, initial-scale=1.0" />
<?php wp_head(); ?>
</head>
<body <?php body_class( 'bg-white text-ink antialiased' ); ?>>
<?php wp_body_open(); ?>

  <!-- Header -->
  <header class="w-full bg-white">
    <div class="max-w-[1280px] mx-auto flex items-center justify-between px-6 lg:px-10 py-5">
      <a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="flex items-center gap-2 shrink-0">
        <img src="<?php echo esc_url( get_template_directory_uri() . '/assets/img/logo.svg' ); ?>" alt="The Human Review" class="h-7 w-auto" />
      </a>

      <nav class="hidden md:flex items-center gap-9 text-[15px] font-medium text-ink/80">
        <?php foreach ( human_review_nav_links() as $label => $link ) : ?>
          <a href="<?php echo esc_url( $link['url'] ); ?>" class="<?php echo human_review_is_current( $link['slug'] ) ? 'text-ink' : 'hover:text-ink transition'; ?>"><?php echo esc_html( $label ); ?></a>
        <?php endforeach; ?>
      </nav>

      <div class="flex items-center gap-3 shrink-0">
        <a href="#" class="hidden sm:inline-flex items-center px-5 py-2.5 rounded-full border border-ink/15 text-[15px] font-medium text-ink hover:bg-ink/5 transition">Log in</a>
        <a href="#" class="hidden sm:inline-flex items-center px-5 py-2.5 rounded-full bg-ink text-white text-[15px] font-medium hover:bg-ink/90 transition">Sign up free</a>

        <button id="menu-btn" type="button" aria-label="Toggle menu" aria-expanded="false" aria-controls="mobile-menu" class="md:hidden flex items-center justify-center w-10 h-10 rounded-full hover:bg-ink/5 transition -mr-2">
          <svg id="icon-open" width="22" height="22" viewBox="0 0 24 24" fill="none"><path d="M4 7H20M4 12H20M4 17H20" stroke="#12141C" stroke-width="1.8" stroke-linecap="round"/></svg>
          <svg id="icon-close" width="22" height="22" viewBox="0 0 24 24" fill="none" class="hidden"><path d="M6 6L18 18M18 6L6 18" stroke="#12141C" stroke-width="1.8" stroke-linecap="round"/></svg>
        </button>
      </div>
    </div>

    <!-- Mobile menu panel -->
    <div id="mobile-menu" class="hidden md:hidden border-t border-ink/10 bg-white">
      <nav class="px-6 py-4 flex flex-col text-[15px] font-medium text-ink/80">
        <?php foreach ( human_review_nav_links() as $label => $link ) : ?>
          <a href="<?php echo esc_url( $link['url'] ); ?>" class="block px-2 py-2.5 rounded-lg <?php echo human_review_is_current( $link['slug'] ) ? 'bg-ink/5 text-ink' : 'hover:bg-ink/5 hover:text-ink transition'; ?>"><?php echo esc_html( $label ); ?></a>
        <?php endforeach; ?>
      </nav>
      <div class="px-6 pb-6 pt-2 flex flex-col gap-3 border-t border-ink/10">
        <a href="#" class="inline-flex items-center justify-center px-5 py-2.5 rounded-full border border-ink/15 text-[15px] font-medium text-ink hover:bg-ink/5 transition">Log in</a>
        <a href="#" class="inline-flex items-center justify-center px-5 py-2.5 rounded-full bg-ink text-white text-[15px] font-medium hover:bg-ink/90 transition">Sign up free</a>
      </div>
    </div>
  </header>
