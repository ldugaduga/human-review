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
		<section class="bg-surface">
			<div class="max-w-[1280px] mx-auto px-6 lg:px-10 py-16 lg:py-20 flex flex-col lg:flex-row lg:items-center gap-10">
				<div class="flex-1">
					<span class="box-border inline-flex flex-row justify-center items-start w-[138px] h-[30px] px-4 py-1.5 mb-6 bg-gradient-to-b from-white to-[#F1F1F1] border border-[#EEEEEE] rounded-full text-[11px] font-semibold tracking-[0.12em] text-ink/60 uppercase">
						<?php echo esc_html( $settings['badge_text'] ); ?>
					</span>
					<h1 class="font-display font-semibold text-[40px] leading-[44px] tracking-[-1.6px] sm:text-[56px] sm:leading-[60px] sm:tracking-[-2.4px] lg:text-[64px] lg:leading-[68px] lg:tracking-[-2.6px] xl:text-[84px] xl:leading-[84px] xl:tracking-[-3.84px] text-[#0F172A] mb-6">
						<?php echo esc_html( $settings['heading'] ); ?>
					</h1>
					<p class="text-ink/60 text-[16px] leading-relaxed max-w-xl">
						<?php echo esc_html( $settings['subcopy'] ); ?>
					</p>
				</div>

				<a href="<?php echo esc_url( $settings['button_link']['url'] ); ?>" class="shrink-0 self-center inline-flex items-center gap-2.5 bg-orange hover:bg-orange-600 transition text-white font-semibold text-[15px] pl-6 pr-2 py-2 rounded-full">
					<?php echo esc_html( $settings['button_text'] ); ?>
					<span class="flex items-center justify-center w-8 h-8 rounded-full bg-ink/15">
						<svg width="14" height="14" viewBox="0 0 16 16" fill="none"><path d="M3.5 8H12.5M12.5 8L8.5 4M12.5 8L8.5 12" stroke="white" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round"/></svg>
					</span>
				</a>
			</div>
		</section>
		<?php
	}
}
