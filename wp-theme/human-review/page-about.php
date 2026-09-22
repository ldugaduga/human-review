<?php
/**
 * Template Name: About
 */

get_header();
$img = get_template_directory_uri() . '/assets/img/';
?>

  <!-- Hero -->
  <section class="bg-surface">
    <div class="max-w-[1280px] mx-auto px-6 lg:px-10 py-16 lg:py-20 grid lg:grid-cols-2 gap-12 items-center">
      <div>
        <span class="box-border inline-flex flex-row justify-center items-start w-[138px] h-[30px] px-4 py-1.5 mb-6 bg-gradient-to-b from-white to-[#F1F1F1] border border-[#EEEEEE] rounded-full text-[11px] font-semibold tracking-[0.12em] text-ink/60 uppercase">
          Our Mission
        </span>
        <h1 class="font-display font-extrabold text-[44px] sm:text-[52px] leading-[1.08] tracking-tight text-ink mb-6">
          Built on real<br />human feedback.
        </h1>
        <p class="text-ink/60 text-[17px] leading-relaxed max-w-md mb-8">
          We're here to bridge the gap between AI-generated noise and genuine human intuition. Truth is our only product.
        </p>
        <a href="#" class="inline-flex items-center gap-2.5 bg-orange hover:bg-orange-600 transition text-white font-semibold text-[15px] pl-6 pr-2 py-2 rounded-full">
          Get started today
          <span class="flex items-center justify-center w-8 h-8 rounded-full bg-ink/15">
            <svg width="14" height="14" viewBox="0 0 16 16" fill="none"><path d="M3.5 8H12.5M12.5 8L8.5 4M12.5 8L8.5 12" stroke="white" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round"/></svg>
          </span>
        </a>
      </div>

      <div class="flex justify-center lg:justify-end">
        <img src="<?php echo esc_url( $img . 'hero-map.svg' ); ?>" alt="Global network of verified reviewers" class="w-full max-w-[500px] h-auto" />
      </div>
    </div>
  </section>

  <!-- Why we exist -->
  <section class="bg-white">
    <div class="max-w-[1280px] mx-auto px-6 lg:px-10 py-20 lg:py-24 grid lg:grid-cols-2 gap-16 items-center">
      <div>
        <h2 class="font-display font-extrabold text-[34px] sm:text-[38px] leading-tight text-ink mb-6">Why we exist</h2>
        <div class="space-y-4 text-ink/60 text-[15.5px] leading-relaxed mb-8">
          <p>In a world increasingly flooded with AI-generated content, fake reviews, and vanity metrics, finding the truth has become harder than ever. Businesses are making critical decisions based on data that doesn't always have a soul.</p>
          <p>The Human Review was born from a simple realization: human intuition is the one thing AI can't fake. We saw a gap where companies needed honest, unfiltered feedback from real people to build products that actually matter.</p>
          <p>Our platform ensures that every piece of feedback you receive comes from a verified, identity-checked human who genuinely fits your audience profile.</p>
        </div>
        <a href="#" class="inline-flex items-center px-6 py-3 rounded-full bg-ink text-white text-[15px] font-semibold hover:bg-ink/90 transition">Book a Demo</a>
      </div>

      <div class="flex justify-center">
        <img src="<?php echo esc_url( $img . 'why-exist.svg' ); ?>" alt="A reviewer writing detailed feedback notes" class="w-full max-w-[500px] h-auto" />
      </div>
    </div>
  </section>

  <!-- What we believe -->
  <section class="bg-surface">
    <div class="max-w-[1280px] mx-auto px-6 lg:px-10 py-20 lg:py-24">
      <div class="text-center max-w-xl mx-auto mb-12">
        <h2 class="font-display font-extrabold text-[34px] sm:text-[38px] leading-tight text-ink mb-4">What we believe</h2>
        <p class="text-ink/55 text-[16px]">The values that guide our network every day.</p>
      </div>

      <div class="bg-white rounded-3xl border border-ink/10 grid sm:grid-cols-3 divide-y sm:divide-y-0 sm:divide-x divide-ink/10 overflow-hidden">
        <div class="p-10">
          <img src="<?php echo esc_url( $img . 'icon1.svg' ); ?>" alt="" class="w-16 h-16 mb-6" />
          <h3 class="font-display font-bold text-[18px] text-ink mb-2">Real people over bots</h3>
          <p class="text-ink/55 text-[14.5px] leading-relaxed">We prioritize human intuition over algorithmic efficiency. If it can be automated, it's not a review.</p>
        </div>
        <div class="p-10">
          <img src="<?php echo esc_url( $img . 'icon2.svg' ); ?>" alt="" class="w-16 h-16 mb-6" />
          <h3 class="font-display font-bold text-[18px] text-ink mb-2">Honesty over metrics</h3>
          <p class="text-ink/55 text-[14.5px] leading-relaxed">We don't optimize for 5-star ratings, we optimize for the truth, even when it's hard to hear.</p>
        </div>
        <div class="p-10">
          <img src="<?php echo esc_url( $img . 'icon3.svg' ); ?>" alt="" class="w-16 h-16 mb-6" />
          <h3 class="font-display font-bold text-[18px] text-ink mb-2">Fast without shortcuts</h3>
          <p class="text-ink/55 text-[14.5px] leading-relaxed">We move at the speed of business, but we never cut corners on verification or quality checks.</p>
        </div>
      </div>
    </div>
  </section>

  <!-- The humans behind the reviews -->
  <section class="bg-white">
    <div class="max-w-[1280px] mx-auto px-6 lg:px-10 py-20 lg:py-24">
      <div class="text-center max-w-xl mx-auto mb-14">
        <h2 class="font-display font-extrabold text-[34px] sm:text-[38px] leading-tight text-ink mb-4">The humans behind the reviews</h2>
        <p class="text-ink/55 text-[16px] leading-relaxed">Our core team is dedicated to building the world's most trusted supply of human feedback.</p>
      </div>

      <div class="grid grid-cols-2 md:grid-cols-4 gap-6 mb-10">
        <div>
          <img src="<?php echo esc_url( $img . 'teams/alex-1.jpg' ); ?>" alt="Alex Rivera" class="w-full aspect-[3/4] object-cover rounded-2xl mb-4" />
          <h3 class="font-display font-bold text-[16px] text-ink">Alex Rivera</h3>
          <p class="text-ink/50 text-[13.5px]">Founder &amp; CEO</p>
        </div>
        <div>
          <img src="<?php echo esc_url( $img . 'teams/sarah-01.jpg' ); ?>" alt="Sarah Jenkins" class="w-full aspect-[3/4] object-cover rounded-2xl mb-4" />
          <h3 class="font-display font-bold text-[16px] text-ink">Sarah Jenkins</h3>
          <p class="text-ink/50 text-[13.5px]">Head of Research</p>
        </div>
        <div>
          <img src="<?php echo esc_url( $img . 'teams/marcus-01.jpg' ); ?>" alt="Marcus Thorne" class="w-full aspect-[3/4] object-cover rounded-2xl mb-4" />
          <h3 class="font-display font-bold text-[16px] text-ink">Marcus Thorne</h3>
          <p class="text-ink/50 text-[13.5px]">Director of Trust &amp; Safety</p>
        </div>
        <div>
          <img src="<?php echo esc_url( $img . 'teams/elena-01.jpg' ); ?>" alt="Elena Vance" class="w-full aspect-[3/4] object-cover rounded-2xl mb-4" />
          <h3 class="font-display font-bold text-[16px] text-ink">Elena Vance</h3>
          <p class="text-ink/50 text-[13.5px]">Head of Network</p>
        </div>
      </div>

      <div class="bg-ink rounded-3xl px-8 sm:px-12 py-10 flex flex-col md:flex-row items-start md:items-center justify-between gap-8">
        <div class="max-w-md">
          <h3 class="font-display font-bold text-white text-[19px] mb-2">How we verify our reviewers</h3>
          <p class="text-white/50 text-[14px] leading-relaxed">Every member of our 12,000+ person network undergoes government-grade ID verification and a manual profile review before being matched with any project.</p>
        </div>
        <div class="flex items-center gap-10 shrink-0">
          <div>
            <p class="font-display font-extrabold text-orange text-[34px] leading-none mb-1">12k+</p>
            <p class="text-white/40 text-[11px] tracking-[0.1em] uppercase">Verified people</p>
          </div>
          <div>
            <p class="font-display font-extrabold text-orange text-[34px] leading-none mb-1">24h</p>
            <p class="text-white/40 text-[11px] tracking-[0.1em] uppercase">Avg. turnaround</p>
          </div>
        </div>
      </div>
    </div>
  </section>

<?php
get_template_part( 'template-parts/cta' );
get_footer();
