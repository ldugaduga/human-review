<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Repeater;

class Human_Review_Footer_Widget extends Widget_Base {

	public function get_name() {
		return 'human-review-footer';
	}

	public function get_title() {
		return __( 'HR: Footer', 'human-review' );
	}

	public function get_icon() {
		return 'eicon-footer';
	}

	public function get_categories() {
		return array( 'human-review' );
	}

	private function link_repeater() {
		$repeater = new Repeater();
		$repeater->add_control(
			'label',
			array(
				'label'   => __( 'Label', 'human-review' ),
				'type'    => Controls_Manager::TEXT,
				'default' => __( 'Link', 'human-review' ),
			)
		);
		$repeater->add_control(
			'link',
			array(
				'label'   => __( 'Link', 'human-review' ),
				'type'    => Controls_Manager::URL,
				'default' => array( 'url' => '#' ),
			)
		);
		return $repeater;
	}

	protected function register_controls() {
		$this->start_controls_section(
			'section_cta_banner',
			array( 'label' => __( 'Ready for real feedback? (CTA)', 'human-review' ) )
		);

		$this->add_control(
			'cta_banner_texture',
			array(
				'label'   => __( 'Background Texture', 'human-review' ),
				'type'    => Controls_Manager::MEDIA,
				'default' => array( 'url' => HUMAN_REVIEW_WIDGETS_URL . '/assets/img/cta-texture.png' ),
			)
		);

		$this->add_control(
			'cta_banner_heading',
			array(
				'label'   => __( 'Heading', 'human-review' ),
				'type'    => Controls_Manager::TEXT,
				'default' => 'Ready for real feedback?',
			)
		);

		$this->add_control(
			'cta_banner_text',
			array(
				'label'   => __( 'Subcopy', 'human-review' ),
				'type'    => Controls_Manager::TEXTAREA,
				'default' => 'Our core team is dedicated to building the world\'s most trusted supply of human feedback.',
			)
		);

		$this->add_control(
			'cta_banner_button_text',
			array(
				'label'   => __( 'Button Text', 'human-review' ),
				'type'    => Controls_Manager::TEXT,
				'default' => 'Book a Demo',
			)
		);

		$this->add_control(
			'cta_banner_button_link',
			array(
				'label'   => __( 'Button Link', 'human-review' ),
				'type'    => Controls_Manager::URL,
				'default' => array( 'url' => '#' ),
			)
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_brand',
			array( 'label' => __( 'Brand & Socials', 'human-review' ) )
		);

		$this->add_control(
			'logo',
			array(
				'label'   => __( 'Logo', 'human-review' ),
				'type'    => Controls_Manager::MEDIA,
				'default' => array( 'url' => HUMAN_REVIEW_WIDGETS_URL . '/assets/img/footer-logo.svg' ),
			)
		);

		$this->add_control(
			'socials',
			array(
				'label'       => __( 'Stay Connected Links', 'human-review' ),
				'type'        => Controls_Manager::REPEATER,
				'fields'      => $this->link_repeater()->get_controls(),
				'default'     => array(
					array( 'label' => 'Instagram', 'link' => array( 'url' => '#' ) ),
					array( 'label' => 'LinkedIn', 'link' => array( 'url' => '#' ) ),
				),
				'title_field' => '{{{ label }}}',
			)
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_newsletter',
			array( 'label' => __( 'Newsletter', 'human-review' ) )
		);

		$this->add_control(
			'newsletter_text',
			array(
				'label'   => __( 'Newsletter Text', 'human-review' ),
				'type'    => Controls_Manager::TEXT,
				'default' => 'Stay up to date with all things 3rdUp',
			)
		);

		$this->end_controls_section();

		foreach ( array(
			'col1' => array( 'title' => 'More Info', 'items' => array( 'Process', 'Team', 'Offerings', '3rdUp AI' ) ),
			'col2' => array( 'title' => 'Say Hello', 'items' => array( 'hello@3rdup.com' ) ),
			'col3' => array( 'title' => 'Free Downloads', 'items' => array( 'Year Marketing Calender', 'Phone Sales Course' ) ),
		) as $key => $col ) {
			$this->start_controls_section(
				"section_{$key}",
				array( 'label' => sprintf( __( 'Column: %s', 'human-review' ), $col['title'] ) )
			);

			$this->add_control(
				"{$key}_title",
				array(
					'label'   => __( 'Column Title', 'human-review' ),
					'type'    => Controls_Manager::TEXT,
					'default' => $col['title'],
				)
			);

			$default_items = array();
			foreach ( $col['items'] as $label ) {
				$default_items[] = array(
					'label' => $label,
					'link'  => array( 'url' => ( false !== strpos( $label, '@' ) ) ? 'mailto:' . $label : '#' ),
				);
			}

			$this->add_control(
				"{$key}_items",
				array(
					'label'       => __( 'Links', 'human-review' ),
					'type'        => Controls_Manager::REPEATER,
					'fields'      => $this->link_repeater()->get_controls(),
					'default'     => $default_items,
					'title_field' => '{{{ label }}}',
				)
			);

			$this->end_controls_section();
		}

		$this->start_controls_section(
			'section_cta',
			array( 'label' => __( 'Try Free Demo', 'human-review' ) )
		);

		$this->add_control(
			'cta_title',
			array(
				'label'   => __( 'Column Title', 'human-review' ),
				'type'    => Controls_Manager::TEXT,
				'default' => 'Try Free Demo',
			)
		);

		$this->add_control(
			'cta_text',
			array(
				'label'   => __( 'Button Text', 'human-review' ),
				'type'    => Controls_Manager::TEXT,
				'default' => 'Book a Call',
			)
		);

		$this->add_control(
			'cta_link',
			array(
				'label'   => __( 'Button Link', 'human-review' ),
				'type'    => Controls_Manager::URL,
				'default' => array( 'url' => '#' ),
			)
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_legal',
			array( 'label' => __( 'Legal', 'human-review' ) )
		);

		$this->add_control(
			'terms_text',
			array(
				'label'   => __( 'Terms Text', 'human-review' ),
				'type'    => Controls_Manager::TEXT,
				'default' => 'Terms and Privacy',
			)
		);

		$this->add_control(
			'copyright_text',
			array(
				'label'   => __( 'Copyright Text', 'human-review' ),
				'type'    => Controls_Manager::TEXT,
				'default' => 'Copyright 3rd-up System 2026',
			)
		);

		$this->end_controls_section();
	}

	private function render_link_list( $items ) {
		foreach ( $items as $item ) {
			printf(
				'<li><a href="%1$s" class="hover:text-orange transition">%2$s</a></li>',
				esc_url( $item['link']['url'] ),
				esc_html( $item['label'] )
			);
		}
	}

	protected function render() {
		$settings = $this->get_settings_for_display();
		$logo_url = ! empty( $settings['logo']['url'] ) ? $settings['logo']['url'] : HUMAN_REVIEW_WIDGETS_URL . '/assets/img/footer-logo.svg';
		$texture_url = ! empty( $settings['cta_banner_texture']['url'] ) ? $settings['cta_banner_texture']['url'] : HUMAN_REVIEW_WIDGETS_URL . '/assets/img/cta-texture.png';
		?>
		<!-- Ready for real feedback? (CTA) -->
		<section class="relative bg-[#171717] overflow-hidden isolate">
			<img src="<?php echo esc_url( $texture_url ); ?>" alt="" class="absolute inset-0 w-full h-full object-cover object-bottom mix-blend-hard-light pointer-events-none select-none" style="inset: 0; width: 100%; height: 100%; object-fit: cover; object-position: bottom; mix-blend-mode: hard-light;" />
			<div class="relative max-w-[1280px] mx-auto px-6 lg:px-0 pt-24 pb-32 text-center">
				<h2 class="font-display font-semibold text-white text-[32px] leading-[38px] sm:text-[40px] sm:leading-[46px] lg:text-[56px] lg:leading-[64px] mb-4"><?php echo esc_html( $settings['cta_banner_heading'] ); ?></h2>
				<p class="text-white/70 text-[16px] sm:text-[18px] leading-relaxed max-w-md mx-auto mb-8"><?php echo esc_html( $settings['cta_banner_text'] ); ?></p>
				<a href="<?php echo esc_url( $settings['cta_banner_button_link']['url'] ); ?>" class="inline-flex items-center gap-2.5 bg-orange hover:bg-orange-600 transition text-white font-semibold text-[15px] pl-6 pr-2 py-2 rounded-full">
					<?php echo esc_html( $settings['cta_banner_button_text'] ); ?>
					<span class="flex items-center justify-center w-8 h-8 rounded-full bg-white/15">
						<svg width="14" height="14" viewBox="0 0 16 16" fill="none"><path d="M3.5 8H12.5M12.5 8L8.5 4M12.5 8L8.5 12" stroke="white" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round"/></svg>
					</span>
				</a>
			</div>
		</section>

		<footer class="bg-black text-white">
			<div class="max-w-[1280px] mx-auto bg-white">

				<div class="grid lg:grid-cols-[320px_1fr] gap-[3px] border-2 border-white p-[3px]">
					<div class="flex flex-col justify-between gap-16 p-10 lg:p-12 bg-black rounded-[5px]">
						<img src="<?php echo esc_url( $logo_url ); ?>" alt="<?php echo esc_attr( get_bloginfo( 'name' ) ); ?>" class="h-[12.8px] w-auto md:w-[230px] md:h-auto lg:w-auto lg:h-8" />
						<div>
							<p class="text-[11px] font-semibold tracking-[0.12em] uppercase text-white mb-4">Stay Connected</p>
							<ul class="space-y-2.5 text-[15px] text-white">
								<?php $this->render_link_list( $settings['socials'] ); ?>
							</ul>
						</div>
					</div>

					<div class="flex flex-col gap-[3px]">
						<div class="bg-black rounded-[5px] p-10 lg:p-12 flex flex-col sm:flex-row sm:items-center gap-8">
							<div class="flex-1">
								<p class="text-[16px] text-white mb-6"><?php echo esc_html( $settings['newsletter_text'] ); ?></p>
								<form class="flex flex-col sm:flex-row gap-[30px]" onsubmit="return false;">
									<div class="w-full sm:w-1/2">
										<input type="text" placeholder="First name*" class="w-full bg-transparent border-b border-white/30 py-2 text-[16px] text-white placeholder-white/40 focus:outline-none focus:border-orange" />
									</div>
									<div class="w-full sm:w-1/2">
										<input type="email" placeholder="Email*" class="w-full bg-transparent border-b border-white/30 py-2 text-[16px] text-white placeholder-white/40 focus:outline-none focus:border-orange" />
									</div>
								</form>
							</div>
							<button type="button" aria-label="Subscribe" class="shrink-0 self-center text-white hover:text-orange transition">
								<svg width="24" height="24" viewBox="0 0 16 16" fill="none"><path d="M3.5 8H12.5M12.5 8L8.5 4M12.5 8L8.5 12" stroke="currentColor" stroke-width="1.3" stroke-linecap="round" stroke-linejoin="round"/></svg>
							</button>
						</div>

						<div class="bg-black rounded-[5px] grid grid-cols-2 sm:grid-cols-4 gap-8 p-10 lg:p-12">
							<div>
								<p class="text-[11px] font-semibold tracking-[0.12em] uppercase text-white mb-4"><?php echo esc_html( $settings['col1_title'] ); ?></p>
								<ul class="space-y-2.5 text-[15px] text-white">
									<?php $this->render_link_list( $settings['col1_items'] ); ?>
								</ul>
							</div>
							<div>
								<p class="text-[11px] font-semibold tracking-[0.12em] uppercase text-white mb-4"><?php echo esc_html( $settings['col2_title'] ); ?></p>
								<ul class="space-y-2.5 text-[15px] text-white">
									<?php $this->render_link_list( $settings['col2_items'] ); ?>
								</ul>
							</div>
							<div>
								<p class="text-[11px] font-semibold tracking-[0.12em] uppercase text-white mb-4"><?php echo esc_html( $settings['col3_title'] ); ?></p>
								<ul class="space-y-2.5 text-[15px] text-white">
									<?php $this->render_link_list( $settings['col3_items'] ); ?>
								</ul>
							</div>
							<div>
								<p class="text-[11px] font-semibold tracking-[0.12em] uppercase text-white mb-4"><?php echo esc_html( $settings['cta_title'] ); ?></p>
								<a href="<?php echo esc_url( $settings['cta_link']['url'] ); ?>" class="inline-flex items-center gap-3 px-5 py-3 rounded-xl bg-white/10 text-white text-[14px] font-bold hover:bg-white/15 transition">
									<?php echo esc_html( $settings['cta_text'] ); ?>
									<svg width="14" height="14" viewBox="0 0 16 16" fill="none"><path d="M3.5 8H12.5M12.5 8L8.5 4M12.5 8L8.5 12" stroke="white" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/></svg>
								</a>
							</div>
						</div>
					</div>
				</div>

				<div class="bg-black rounded-[5px] mx-[5px] mt-[-1px] mb-[3px] px-10 py-3 flex flex-col sm:relative sm:flex-row sm:items-center gap-2 text-[11px] font-semibold tracking-[0.08em] text-white uppercase">
					<p><?php echo esc_html( $settings['terms_text'] ); ?></p>
					<p class="sm:absolute sm:left-1/2 sm:-translate-x-1/2"><?php echo esc_html( $settings['copyright_text'] ); ?></p>
				</div>
			</div>
		</footer>
		<?php
	}
}
