<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Repeater;

class Human_Review_Contact_Widget extends Widget_Base {

	public function get_name() {
		return 'human-review-contact';
	}

	public function get_title() {
		return __( 'HR: Contact (Hero + Form)', 'human-review' );
	}

	public function get_icon() {
		return 'eicon-form-horizontal';
	}

	public function get_categories() {
		return array( 'human-review' );
	}

	protected function register_controls() {
		$this->start_controls_section(
			'section_intro',
			array( 'label' => __( 'Intro', 'human-review' ) )
		);

		$this->add_control(
			'badge_text',
			array(
				'label'   => __( 'Badge Text', 'human-review' ),
				'type'    => Controls_Manager::TEXT,
				'default' => 'Reviewed on Clutch 4.9/5.0',
			)
		);

		$this->add_control(
			'heading',
			array(
				'label'   => __( 'Heading', 'human-review' ),
				'type'    => Controls_Manager::TEXT,
				'default' => 'Let\'s get your users',
			)
		);

		$this->add_control(
			'heading_highlight',
			array(
				'label'   => __( 'Heading Highlight (orange)', 'human-review' ),
				'type'    => Controls_Manager::TEXT,
				'default' => 'talking.',
			)
		);

		$this->add_control(
			'subcopy',
			array(
				'label'   => __( 'Subcopy', 'human-review' ),
				'type'    => Controls_Manager::TEXTAREA,
				'default' => 'Tell us about your project or get help with an existing booking. We\'ll take it from there.',
			)
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_steps',
			array( 'label' => __( 'What Happens Next', 'human-review' ) )
		);

		$this->add_control(
			'steps_label',
			array(
				'label'   => __( 'Label', 'human-review' ),
				'type'    => Controls_Manager::TEXT,
				'default' => 'What happens next :',
			)
		);

		$steps_repeater = new Repeater();
		$steps_repeater->add_control(
			'text',
			array(
				'label'   => __( 'Text', 'human-review' ),
				'type'    => Controls_Manager::TEXT,
				'default' => '',
			)
		);

		$this->add_control(
			'steps',
			array(
				'label'       => __( 'Steps', 'human-review' ),
				'type'        => Controls_Manager::REPEATER,
				'fields'      => $steps_repeater->get_controls(),
				'title_field' => '{{{ text }}}',
				'default'     => array(
					array( 'text' => 'Fill a short brief. Takes about 2 minutes.' ),
					array( 'text' => 'An expert reviews it and reaches out the same day.' ),
					array( 'text' => 'Get a clear research plan within 24 hours.' ),
				),
			)
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_testimonial',
			array( 'label' => __( 'Testimonial', 'human-review' ) )
		);

		$this->add_control(
			'quote',
			array(
				'label'   => __( 'Quote', 'human-review' ),
				'type'    => Controls_Manager::TEXTAREA,
				'default' => 'Super responsive, detail-oriented, and great planners. Definitely recommend working with this amazing team!',
			)
		);

		$this->add_control(
			'quote_photo',
			array(
				'label'   => __( 'Photo', 'human-review' ),
				'type'    => Controls_Manager::MEDIA,
				'default' => array( 'url' => HUMAN_REVIEW_WIDGETS_URL . '/assets/img/teams/elena-01.jpg' ),
			)
		);

		$this->add_control(
			'quote_name',
			array(
				'label'   => __( 'Name', 'human-review' ),
				'type'    => Controls_Manager::TEXT,
				'default' => 'Megan Love',
			)
		);

		$this->add_control(
			'quote_role',
			array(
				'label'   => __( 'Role / Company', 'human-review' ),
				'type'    => Controls_Manager::TEXT,
				'default' => 'VP Marketing, Axero Solution',
			)
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_logos',
			array( 'label' => __( 'Trusted By', 'human-review' ) )
		);

		$this->add_control(
			'logos_label',
			array(
				'label'   => __( 'Label', 'human-review' ),
				'type'    => Controls_Manager::TEXT,
				'default' => 'Trusted by teams at :',
			)
		);

		$logos_repeater = new Repeater();
		$logos_repeater->add_control(
			'logo',
			array(
				'label' => __( 'Logo', 'human-review' ),
				'type'  => Controls_Manager::MEDIA,
			)
		);
		$logos_repeater->add_control(
			'name',
			array(
				'label'   => __( 'Company Name (alt text)', 'human-review' ),
				'type'    => Controls_Manager::TEXT,
				'default' => '',
			)
		);

		$logo_defaults = array();
		foreach ( array( 'IBM', 'Microsoft', 'GitLab', 'Notion', 'Figma', 'Loom' ) as $brand ) {
			$logo_defaults[] = array(
				'logo' => array( 'url' => HUMAN_REVIEW_WIDGETS_URL . '/assets/img/contact/' . strtolower( $brand ) . '.png' ),
				'name' => $brand,
			);
		}

		$this->add_control(
			'logos',
			array(
				'label'       => __( 'Logos', 'human-review' ),
				'type'        => Controls_Manager::REPEATER,
				'fields'      => $logos_repeater->get_controls(),
				'title_field' => '{{{ name }}}',
				'default'     => $logo_defaults,
			)
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_form',
			array( 'label' => __( 'Form', 'human-review' ) )
		);

		$this->add_control(
			'form_heading',
			array(
				'label'   => __( 'Heading', 'human-review' ),
				'type'    => Controls_Manager::TEXT,
				'default' => 'Tell us what you need.',
			)
		);

		$this->add_control(
			'form_subcopy',
			array(
				'label'   => __( 'Subcopy', 'human-review' ),
				'type'    => Controls_Manager::TEXT,
				'default' => 'We\'ll get back to you faster than you think.',
			)
		);

		$this->add_control(
			'general_tab_label',
			array(
				'label'   => __( 'General Tab Label', 'human-review' ),
				'type'    => Controls_Manager::TEXT,
				'default' => 'General Enquiry',
			)
		);

		$this->add_control(
			'general_shortcode',
			array(
				'label'       => __( 'General Form Shortcode', 'human-review' ),
				'type'        => Controls_Manager::TEXTAREA,
				'rows'        => 2,
				'placeholder' => '[contact-form-7 id="123"]',
				'description' => __( 'Shortcode from your form plugin (Contact Form 7, WPForms, Gravity Forms, or [elementor-template id="…"]).', 'human-review' ),
			)
		);

		$this->add_control(
			'support_tab_label',
			array(
				'label'   => __( 'Support Tab Label', 'human-review' ),
				'type'    => Controls_Manager::TEXT,
				'default' => 'Support & Help',
			)
		);

		$this->add_control(
			'support_shortcode',
			array(
				'label'       => __( 'Support Form Shortcode', 'human-review' ),
				'type'        => Controls_Manager::TEXTAREA,
				'rows'        => 2,
				'description' => __( 'Leave empty to hide the tabs and show only the general form.', 'human-review' ),
			)
		);

		$this->add_control(
			'trust_left',
			array(
				'label'   => __( 'Footer Note (left)', 'human-review' ),
				'type'    => Controls_Manager::TEXT,
				'default' => 'Privacy Protected',
			)
		);

		$this->add_control(
			'trust_right',
			array(
				'label'   => __( 'Footer Note (right)', 'human-review' ),
				'type'    => Controls_Manager::TEXT,
				'default' => 'Replies within 24 hours',
			)
		);

		$this->end_controls_section();
	}

	private function render_form_panel( $shortcode, $panel, $hidden ) {
		?>
		<div class="hr-contact-panel" data-panel="<?php echo esc_attr( $panel ); ?>" id="<?php echo esc_attr( $this->get_id() . '-' . $panel ); ?>" role="tabpanel"<?php echo $hidden ? ' hidden' : ''; ?>>
			<?php if ( trim( $shortcode ) ) : ?>
				<?php echo do_shortcode( $shortcode ); ?>
			<?php else : ?>
				<p class="text-[14px] text-[#8A8AA8]"><?php esc_html_e( 'Add your form plugin shortcode in the widget\'s Form settings.', 'human-review' ); ?></p>
			<?php endif; ?>
		</div>
		<?php
	}

	protected function render() {
		$settings  = $this->get_settings_for_display();
		$has_tabs  = ! empty( trim( (string) $settings['support_shortcode'] ) );
		$tabs      = array(
			'general' => array(
				'label' => $settings['general_tab_label'],
				'icon'  => '<svg width="18" height="18" viewBox="0 0 20 20" fill="none" aria-hidden="true"><rect x="2.5" y="4.5" width="15" height="11" rx="2" stroke="currentColor" stroke-width="1.25"/><path d="M3 5.5L10 11L17 5.5" stroke="currentColor" stroke-width="1.25" stroke-linecap="round" stroke-linejoin="round"/></svg>',
			),
			'support' => array(
				'label' => $settings['support_tab_label'],
				'icon'  => '<svg width="18" height="18" viewBox="0 0 20 20" fill="none" aria-hidden="true"><circle cx="10" cy="7.5" r="3" stroke="currentColor" stroke-width="1.25"/><path d="M4 17c0-3 2.5-5 6-5s6 2 6 5" stroke="currentColor" stroke-width="1.25" stroke-linecap="round"/></svg>',
			),
		);
		$logos     = array_filter(
			$settings['logos'],
			function ( $item ) {
				return ! empty( $item['logo']['url'] );
			}
		);
		?>
		<section class="hr-contact bg-white">
			<div class="max-w-[1280px] mx-auto px-6 lg:px-0 pt-12 pb-20 lg:pt-16 lg:pb-24 flex flex-col lg:grid lg:grid-cols-2 gap-12 lg:items-start">

				<div class="flex flex-col items-start gap-8 min-w-0">
					<?php if ( $settings['badge_text'] ) : ?>
						<span class="box-border inline-flex flex-row justify-center items-center px-4 py-1.5 gap-2 bg-gradient-to-b from-white to-[#F1F1F1] border border-[#EEEEEE] rounded-full text-[12px] font-semibold tracking-[0.1em] text-[#10182B] uppercase">
							<svg width="16" height="16" viewBox="0 0 20 20" fill="none" class="shrink-0" aria-hidden="true"><rect width="20" height="20" rx="5" fill="#17324D"/><path d="M6 10.5L8.5 13L14 7" stroke="white" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round"/></svg>
							<?php echo esc_html( $settings['badge_text'] ); ?>
						</span>
					<?php endif; ?>

					<div class="flex flex-col items-start gap-8">
						<h1 class="font-display font-semibold text-[40px] leading-[44px] tracking-[-1.6px] sm:text-[56px] sm:leading-[60px] sm:tracking-[-2.4px] lg:text-[64px] lg:leading-[68px] lg:tracking-[-2.6px] xl:text-[84px] xl:leading-[84px] xl:tracking-[-3.84px] text-[#0F172A]">
							<?php echo esc_html( $settings['heading'] ); ?>
							<?php if ( $settings['heading_highlight'] ) : ?>
								<span class="text-orange"><?php echo esc_html( $settings['heading_highlight'] ); ?></span>
							<?php endif; ?>
						</h1>
						<p class="text-[#5D6370] text-[18px] sm:text-[20px] leading-[30px] max-w-[574px]"><?php echo esc_html( $settings['subcopy'] ); ?></p>
					</div>

					<?php if ( ! empty( $settings['steps'] ) ) : ?>
						<div class="flex flex-col items-start gap-5">
							<p class="font-mono text-[13px] sm:text-[14px] tracking-[0.1em] uppercase text-[#8A8AA8]"><?php echo esc_html( $settings['steps_label'] ); ?></p>
							<div class="flex flex-col items-start gap-3.5">
								<?php foreach ( $settings['steps'] as $i => $step ) : ?>
									<div class="flex items-center gap-2">
										<span class="shrink-0 w-8 h-8 flex items-center justify-center bg-white border border-[#EEEEEE] rounded-full text-[12px] font-semibold tracking-[0.05em] uppercase text-[#6B7280]" style="border-radius: 9999px;"><?php echo esc_html( sprintf( '%02d', $i + 1 ) ); ?></span>
										<span class="font-display font-medium text-[17px] sm:text-[18px] leading-[26px] text-[#0F172A]"><?php echo esc_html( $step['text'] ); ?></span>
									</div>
								<?php endforeach; ?>
							</div>
						</div>
					<?php endif; ?>

					<?php if ( $settings['quote'] ) : ?>
						<div class="w-full max-w-[448px] flex items-start gap-4 p-4 bg-[#FBFCFD] border border-[#F1F5F9] rounded-xl" style="border-radius: 12px; box-shadow: 0px 1px 2px rgba(0,0,0,0.05);">
							<?php if ( ! empty( $settings['quote_photo']['url'] ) ) : ?>
								<div class="shrink-0 w-[50px] h-[50px] rounded-full bg-[#EEF0FF] border-[2px] border-white overflow-hidden flex items-center justify-center" style="border-radius: 9999px; box-shadow: 0 0 0 1.5px rgba(255,109,24,0.5), 0 9px 22px -7px rgba(15,10,46,0.38);">
									<img src="<?php echo esc_url( $settings['quote_photo']['url'] ); ?>" alt="<?php echo esc_attr( $settings['quote_name'] ); ?>" class="w-full h-full object-cover" />
								</div>
							<?php endif; ?>
							<div class="flex flex-col gap-3">
								<p class="text-[14px] leading-[22px] text-[#0F172A]">&ldquo;<?php echo esc_html( $settings['quote'] ); ?>&rdquo;</p>
								<div class="flex flex-col gap-1">
									<p class="font-display font-semibold text-[14px] leading-[18px] text-[#0F172A]"><?php echo esc_html( $settings['quote_name'] ); ?></p>
									<p class="font-mono text-[12px] leading-[20px] tracking-[0.05em] uppercase text-[#8A8AA8]"><?php echo esc_html( $settings['quote_role'] ); ?></p>
								</div>
							</div>
						</div>
					<?php endif; ?>

					<?php if ( $logos ) : ?>
						<div class="w-full flex flex-col items-start gap-5">
							<p class="font-mono text-[13px] sm:text-[14px] tracking-[0.1em] uppercase text-[#8A8AA8]"><?php echo esc_html( $settings['logos_label'] ); ?></p>
							<div class="w-full overflow-hidden [mask-image:linear-gradient(to_right,transparent,black_10%,black_90%,transparent)]">
								<!-- two identical copies so the -50% marquee loop is seamless -->
								<div class="hr-marquee-track flex items-center gap-16 w-max">
									<?php for ( $copy = 0; $copy < 2; $copy++ ) : ?>
										<div class="flex items-center gap-16 shrink-0"<?php echo $copy ? ' aria-hidden="true"' : ''; ?>>
											<?php foreach ( $logos as $item ) : ?>
												<img src="<?php echo esc_url( $item['logo']['url'] ); ?>" alt="<?php echo $copy ? '' : esc_attr( $item['name'] ); ?>" class="max-h-7 w-auto opacity-50" />
											<?php endforeach; ?>
										</div>
									<?php endfor; ?>
								</div>
							</div>
						</div>
					<?php endif; ?>
				</div>

				<div class="w-full bg-white border border-[#F1F5F9] rounded-2xl overflow-hidden" style="border-radius: 16px; box-shadow: 0px 20px 25px -5px rgba(0,0,0,0.1), 0px 8px 10px -6px rgba(0,0,0,0.1);">
					<?php if ( $has_tabs ) : ?>
						<div class="flex justify-center p-2">
							<div class="w-full flex items-stretch gap-1 p-0.5 bg-[#F5F6F8] rounded-[10px]" role="tablist" style="border-radius: 10px;">
								<?php foreach ( $tabs as $key => $tab ) : ?>
									<button type="button" role="tab" data-tab="<?php echo esc_attr( $key ); ?>" aria-controls="<?php echo esc_attr( $this->get_id() . '-' . $key ); ?>" aria-selected="<?php echo 'general' === $key ? 'true' : 'false'; ?>" class="hr-contact-tab flex-1 flex items-center justify-center gap-2 px-2 py-3 rounded-lg text-[16px] font-semibold capitalize transition">
										<?php echo $tab['icon']; // phpcs:ignore WordPress.Security.EscapeOutput -- static SVG above ?>
										<?php echo esc_html( $tab['label'] ); ?>
									</button>
								<?php endforeach; ?>
							</div>
						</div>
					<?php endif; ?>

					<div class="px-6 sm:px-8 pb-10 sm:pb-12 <?php echo $has_tabs ? 'pt-2' : 'pt-10 sm:pt-12'; ?> flex flex-col gap-10">
						<div class="flex flex-col gap-1">
							<h2 class="font-display font-semibold text-[28px] sm:text-[32px] leading-[38px] text-[#0F172A]"><?php echo esc_html( $settings['form_heading'] ); ?></h2>
							<p class="text-[#5D6370] text-[17px] sm:text-[18px] leading-[30px]"><?php echo esc_html( $settings['form_subcopy'] ); ?></p>
						</div>

						<div class="hr-contact-form">
							<?php
							$this->render_form_panel( (string) $settings['general_shortcode'], 'general', false );
							if ( $has_tabs ) {
								$this->render_form_panel( (string) $settings['support_shortcode'], 'support', true );
							}
							?>
						</div>

						<div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-3 pt-4 border-t border-[#F8FAFC]">
							<div class="flex items-center gap-2">
								<svg width="14" height="14" viewBox="0 0 16 16" fill="none" aria-hidden="true"><rect x="3" y="7" width="10" height="7" rx="1.5" stroke="#94A3B8" stroke-width="1.3"/><path d="M5.5 7V5a2.5 2.5 0 0 1 5 0v2" stroke="#94A3B8" stroke-width="1.3"/></svg>
								<span class="font-mono text-[12px] tracking-[0.08em] uppercase text-[#8A8AA8]"><?php echo esc_html( $settings['trust_left'] ); ?></span>
							</div>
							<div class="flex items-center gap-2">
								<svg width="14" height="14" viewBox="0 0 16 16" fill="none" aria-hidden="true"><circle cx="8" cy="8" r="6" stroke="#C0552B" stroke-width="1.3"/><path d="M8 5v3.2l2 1.3" stroke="#C0552B" stroke-width="1.3" stroke-linecap="round"/></svg>
								<span class="font-mono text-[12px] tracking-[0.08em] uppercase text-[#8A8AA8]"><?php echo esc_html( $settings['trust_right'] ); ?></span>
							</div>
						</div>
					</div>
				</div>

			</div>
		</section>
		<?php
	}
}
