<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

use Elementor\Widget_Base;
use Elementor\Controls_Manager;

class Human_Review_Hiw_Hero_Widget extends Widget_Base {

	public function get_name() {
		return 'human-review-hiw-hero';
	}

	public function get_title() {
		return __( 'HR: Hero (How it Works)', 'human-review' );
	}

	public function get_icon() {
		return 'eicon-slider-3d';
	}

	public function get_categories() {
		return array( 'human-review' );
	}

	protected function register_controls() {
		$this->start_controls_section(
			'section_content',
			array( 'label' => __( 'Content', 'human-review' ) )
		);

		$this->add_control(
			'badge_text',
			array(
				'label'   => __( 'Badge Text', 'human-review' ),
				'type'    => Controls_Manager::TEXT,
				'default' => 'How it works',
			)
		);

		$this->add_control(
			'heading',
			array(
				'label'   => __( 'Heading', 'human-review' ),
				'type'    => Controls_Manager::TEXT,
				'default' => 'Real human feedback in four simple steps',
			)
		);

		$this->add_control(
			'subcopy',
			array(
				'label'   => __( 'Subcopy', 'human-review' ),
				'type'    => Controls_Manager::TEXTAREA,
				'default' => 'From request to response, we\'ve built a platform that makes getting authentic insights fast, easy, and completely transparent.',
			)
		);

		$this->add_control(
			'button_text',
			array(
				'label'   => __( 'Button Text', 'human-review' ),
				'type'    => Controls_Manager::TEXT,
				'default' => 'Get started now',
			)
		);

		$this->add_control(
			'button_link',
			array(
				'label'   => __( 'Button Link', 'human-review' ),
				'type'    => Controls_Manager::URL,
				'default' => array( 'url' => '#' ),
			)
		);

		$this->end_controls_section();
	}

	protected function render() {
		$settings = $this->get_settings_for_display();
		?>
		<section class="bg-[#F9FAFB]">
			<div class="max-w-[1280px] mx-auto px-6 py-16 lg:pt-[160px] lg:px-0 lg:pb-24 flex flex-col items-start gap-8">
				<span class="box-border inline-flex flex-row justify-center items-center px-4 py-1.5 bg-gradient-to-b from-white to-[#F1F1F1] border border-[#EEEEEE] rounded-full text-[12px] font-semibold tracking-[0.1em] text-[#10182B] uppercase">
					<?php echo esc_html( $settings['badge_text'] ); ?>
				</span>
				<h1 class="font-display font-semibold text-[40px] leading-[44px] tracking-[-1.6px] sm:text-[56px] sm:leading-[60px] sm:tracking-[-2.4px] lg:text-[64px] lg:leading-[68px] lg:tracking-[-2.6px] xl:text-[84px] xl:leading-[84px] xl:tracking-[-3.84px] text-[#0F172A] max-w-4xl">
					<?php echo esc_html( $settings['heading'] ); ?>
				</h1>
				<div class="w-full flex flex-col sm:flex-row sm:items-center gap-6">
					<p class="text-[#5D6370] text-[18px] sm:text-[20px] leading-[30px] max-w-2xl flex-1">
						<?php echo esc_html( $settings['subcopy'] ); ?>
					</p>
					<a href="<?php echo esc_url( $settings['button_link']['url'] ); ?>" class="shrink-0 inline-flex items-center gap-2.5 bg-orange hover:bg-orange-600 transition text-white font-bold text-[16px] pl-7 pr-2 py-[15px] rounded-full border border-[#FF853D] shadow-[0px_10px_26px_-10px_rgba(255,109,24,0.5)]" style="box-shadow: 0px 10px 26px -10px rgba(255, 109, 24, 0.5);">
						<?php echo esc_html( $settings['button_text'] ); ?>
						<span class="flex items-center justify-center w-8 h-8 rounded-full bg-white/15">
							<svg width="14" height="14" viewBox="0 0 16 16" fill="none"><path d="M3.5 8H12.5M12.5 8L8.5 4M12.5 8L8.5 12" stroke="white" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round"/></svg>
						</span>
					</a>
				</div>
			</div>
		</section>
		<?php
	}
}
