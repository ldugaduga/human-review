<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Repeater;

class Human_Review_Po_Dashboard_Widget extends Widget_Base {

	public function get_name() {
		return 'human-review-po-dashboard';
	}

	public function get_title() {
		return __( 'HR: Your Dashboard', 'human-review' );
	}

	public function get_icon() {
		return 'eicon-device-laptop';
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
			'heading',
			array(
				'label'   => __( 'Heading', 'human-review' ),
				'type'    => Controls_Manager::TEXT,
				'default' => 'Your dashboard',
			)
		);

		$this->add_control(
			'subcopy',
			array(
				'label'   => __( 'Subcopy', 'human-review' ),
				'type'    => Controls_Manager::TEXTAREA,
				'default' => 'Manage every request, track bookings, and review responses in one place. No spreadsheets, no back-and-forth emails.',
			)
		);

		$repeater = new Repeater();

		$repeater->add_control(
			'text',
			array(
				'label'   => __( 'Text', 'human-review' ),
				'type'    => Controls_Manager::TEXT,
				'default' => __( 'Checklist item', 'human-review' ),
			)
		);

		$this->add_control(
			'checklist',
			array(
				'label'       => __( 'Checklist', 'human-review' ),
				'type'        => Controls_Manager::REPEATER,
				'fields'      => $repeater->get_controls(),
				'title_field' => '{{{ text }}}',
				'default'     => array(
					array( 'text' => 'Create and manage review requests' ),
					array( 'text' => 'Track bookings and payouts in real time' ),
					array( 'text' => 'Browse and download video recordings' ),
				),
			)
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_image',
			array( 'label' => __( 'Background Image', 'human-review' ) )
		);

		$this->add_control(
			'image',
			array(
				'label'       => __( 'Image', 'human-review' ),
				'type'        => Controls_Manager::MEDIA,
				'default'     => array( 'url' => HUMAN_REVIEW_WIDGETS_URL . '/assets/img/product-overview/free-macbook-air.png' ),
				'description' => __( 'Fills the section on desktop (anchored right); shown below the text on mobile.', 'human-review' ),
			)
		);

		$this->add_control(
			'image_alt',
			array(
				'label'   => __( 'Image Alt Text', 'human-review' ),
				'type'    => Controls_Manager::TEXT,
				'default' => 'Media library in The Human Review dashboard, shown on a laptop',
			)
		);

		$this->end_controls_section();
	}

	protected function render() {
		$settings  = $this->get_settings_for_display();
		$image_url = ! empty( $settings['image']['url'] ) ? $settings['image']['url'] : HUMAN_REVIEW_WIDGETS_URL . '/assets/img/product-overview/free-macbook-air.png';
		?>
		<section class="relative bg-[#4A4A4A] overflow-hidden">
			<div class="relative z-10 max-w-[1280px] mx-auto px-6 lg:px-0 py-16 lg:py-[100px] lg:min-h-[648px] flex items-center">
				<div class="max-w-[458px] flex flex-col gap-[30px]">
					<div class="flex flex-col gap-4">
						<h2 class="font-display font-semibold text-[44px] leading-[50px] sm:text-[56px] sm:leading-[64px] lg:text-[64px] lg:leading-[72px] text-white"><?php echo esc_html( $settings['heading'] ); ?></h2>
						<p class="text-white text-[18px] leading-[28px]"><?php echo esc_html( $settings['subcopy'] ); ?></p>
					</div>
					<ul class="flex flex-col gap-3">
						<?php foreach ( $settings['checklist'] as $item ) : ?>
							<li class="flex items-center gap-3">
								<span class="w-5 h-5 rounded-full bg-[#22C55E] flex items-center justify-center shrink-0">
									<svg width="11" height="11" viewBox="0 0 16 16" fill="none"><path d="M3 8.5L6.5 12L13 4.5" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/></svg>
								</span>
								<span class="text-white text-[16px] leading-[20px] font-medium"><?php echo esc_html( $item['text'] ); ?></span>
							</li>
						<?php endforeach; ?>
					</ul>
				</div>
			</div>
			<img src="<?php echo esc_url( $image_url ); ?>" alt="<?php echo esc_attr( $settings['image_alt'] ); ?>" class="block lg:absolute lg:inset-0 w-full h-auto lg:h-full object-cover object-right" />
		</section>
		<?php
	}
}
