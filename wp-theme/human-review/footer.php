  <!-- Footer -->
  <footer class="bg-black text-white">
    <div class="max-w-[1280px] mx-auto bg-white">

      <!-- mosaic card: white 2px frame with 3px gutters between black tiles -->
      <div class="grid lg:grid-cols-[320px_1fr] gap-[3px] border-2 border-white p-[3px]">
        <!-- left sidebar -->
        <div class="flex flex-col justify-between gap-16 p-10 lg:p-12 bg-black rounded-[5px]">
          <img src="<?php echo esc_url( get_template_directory_uri() . '/assets/img/footer-logo.svg' ); ?>" alt="The Human Review" class="h-8 w-auto" />
          <div>
            <p class="text-[11px] tracking-[0.12em] uppercase text-white/40 mb-4 font-medium">Stay Connected</p>
            <ul class="space-y-2.5 text-[15px] text-white/70">
              <li><a href="#" class="hover:text-white transition">Instagram</a></li>
              <li><a href="#" class="hover:text-white transition">LinkedIn</a></li>
            </ul>
          </div>
        </div>

        <!-- right column -->
        <div class="flex flex-col gap-[3px]">
          <div class="bg-black rounded-[5px] p-10 lg:p-12 flex flex-col sm:flex-row sm:items-center gap-8">
            <div class="flex-1">
              <p class="text-[16px] text-white/80 mb-6">Stay up to date with all things 3rdUp</p>
              <form class="flex flex-col sm:flex-row gap-[30px]">
                <div class="w-full sm:w-1/2">
                  <input type="text" placeholder="First name*" class="w-full bg-transparent border-b border-white/30 py-2 text-[16px] text-white placeholder-white/40 focus:outline-none focus:border-orange" />
                </div>
                <div class="w-full sm:w-1/2">
                  <input type="email" placeholder="Email*" class="w-full bg-transparent border-b border-white/30 py-2 text-[16px] text-white placeholder-white/40 focus:outline-none focus:border-orange" />
                </div>
              </form>
            </div>
            <button type="button" aria-label="Subscribe" class="shrink-0 self-center text-white/80 hover:text-orange transition">
              <svg width="24" height="24" viewBox="0 0 16 16" fill="none"><path d="M3.5 8H12.5M12.5 8L8.5 4M12.5 8L8.5 12" stroke="currentColor" stroke-width="1.3" stroke-linecap="round" stroke-linejoin="round"/></svg>
            </button>
          </div>

          <div class="bg-black rounded-[5px] grid grid-cols-2 sm:grid-cols-4 gap-8 p-10 lg:p-12">
            <div>
              <p class="text-[11px] tracking-[0.12em] uppercase text-white/40 mb-4 font-medium">More Info</p>
              <ul class="space-y-2.5 text-[15px] text-white/70">
                <li><a href="#" class="hover:text-white transition">Process</a></li>
                <li><a href="#" class="hover:text-white transition">Team</a></li>
                <li><a href="#" class="hover:text-white transition">Offerings</a></li>
                <li><a href="#" class="hover:text-white transition">3rdUp AI</a></li>
              </ul>
            </div>
            <div>
              <p class="text-[11px] tracking-[0.12em] uppercase text-white/40 mb-4 font-medium">Say Hello</p>
              <ul class="space-y-2.5 text-[15px] text-white/70">
                <li><a href="mailto:hello@3rdup.com" class="hover:text-white transition">hello@3rdup.com</a></li>
              </ul>
            </div>
            <div>
              <p class="text-[11px] tracking-[0.12em] uppercase text-white/40 mb-4 font-medium">Free Downloads</p>
              <ul class="space-y-2.5 text-[15px] text-white/70">
                <li><a href="#" class="hover:text-white transition">Year Marketing Calender</a></li>
                <li><a href="#" class="hover:text-white transition">Phone Sales Course</a></li>
              </ul>
            </div>
            <div>
              <p class="text-[11px] tracking-[0.12em] uppercase text-white/40 mb-4 font-medium">Try Free Demo</p>
              <a href="#" class="inline-flex items-center gap-3 px-5 py-3 rounded-xl bg-white/10 text-white text-[14px] font-semibold hover:bg-white/15 transition">
                Book a Call
                <svg width="14" height="14" viewBox="0 0 16 16" fill="none"><path d="M3.5 8H12.5M12.5 8L8.5 4M12.5 8L8.5 12" stroke="white" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/></svg>
              </a>
            </div>
          </div>
        </div>
      </div>

      <div class="bg-black rounded-[5px] mx-[5px] mt-[-1px] mb-[3px] px-10 py-3 flex flex-col sm:relative sm:flex-row sm:items-center gap-2 text-[11px] tracking-[0.08em] text-white/40 uppercase font-medium">
        <p>Terms and Privacy</p>
        <p class="sm:absolute sm:left-1/2 sm:-translate-x-1/2">Copyright 3rd-up System 2026</p>
      </div>
    </div>
  </footer>

<?php wp_footer(); ?>
</body>
</html>
