<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Repeater;

class Human_Review_Po_Steps_Widget extends Widget_Base {

	public function get_name() {
		return 'human-review-po-steps';
	}

	public function get_title() {
		return __( 'HR: Product How It Works', 'human-review' );
	}

	public function get_icon() {
		return 'eicon-bullet-list';
	}

	public function get_categories() {
		return array( 'human-review' );
	}

	protected function register_controls() {
		$this->start_controls_section(
			'section_heading',
			array( 'label' => __( 'Heading', 'human-review' ) )
		);

		$this->add_control(
			'heading',
			array(
				'label'   => __( 'Heading', 'human-review' ),
				'type'    => Controls_Manager::TEXT,
				'default' => 'How it works',
			)
		);

		$this->add_control(
			'subcopy',
			array(
				'label'   => __( 'Subcopy', 'human-review' ),
				'type'    => Controls_Manager::TEXTAREA,
				'default' => 'Our process is built for speed without compromising on verification.',
			)
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_steps',
			array( 'label' => __( 'Steps', 'human-review' ) )
		);

		$repeater = new Repeater();

		$repeater->add_control(
			'icon',
			array(
				'label' => __( 'Icon', 'human-review' ),
				'type'  => Controls_Manager::MEDIA,
			)
		);

		$repeater->add_control(
			'title',
			array(
				'label'   => __( 'Title', 'human-review' ),
				'type'    => Controls_Manager::TEXT,
				'default' => __( 'Step title', 'human-review' ),
			)
		);

		$repeater->add_control(
			'description',
			array(
				'label'   => __( 'Description', 'human-review' ),
				'type'    => Controls_Manager::TEXTAREA,
				'default' => '',
			)
		);

		$icon_url = HUMAN_REVIEW_WIDGETS_URL . '/assets/img/how-it-works/icon-0';

		$this->add_control(
			'steps',
			array(
				'label'       => __( 'Steps', 'human-review' ),
				'type'        => Controls_Manager::REPEATER,
				'fields'      => $repeater->get_controls(),
				'title_field' => '{{{ title }}}',
				'default'     => array(
					array(
						'icon'        => array( 'url' => $icon_url . '1.svg' ),
						'title'       => 'Create a request',
						'description' => 'Describe what you need reviewed or tested and set your criteria.',
					),
					array(
						'icon'        => array( 'url' => $icon_url . '2.svg' ),
						'title'       => 'We match verified people',
						'description' => 'Real humans matched to your audience, not bots or freelancers.',
					),
					array(
						'icon'        => array( 'url' => $icon_url . '3.svg' ),
						'title'       => 'They review & test',
						'description' => 'Participants leave written feedback and optional video responses.',
					),
					array(
						'icon'        => array( 'url' => $icon_url . '4.svg' ),
						'title'       => 'Get feedback & media',
						'description' => 'Collect insights and authentic clips ready for your website.',
					),
				),
			)
		);

		$this->end_controls_section();
	}

	protected function render() {
		$settings = $this->get_settings_for_display();
		?>
		<section class="bg-gradient-to-b from-[#F3F3F3] to-white">
			<div class="max-w-[1280px] mx-auto px-6 lg:px-0 pt-16 pb-16 lg:pt-[90px] lg:pb-[60px] flex flex-col lg:flex-row gap-10 lg:gap-16">
				<div class="lg:w-[467px] shrink-0 flex flex-col gap-5">
					<h2 class="font-display font-semibold text-[36px] leading-[42px] sm:text-[44px] sm:leading-[52px] lg:text-[56px] lg:leading-[64px] text-[#0F172A]"><?php echo esc_html( $settings['heading'] ); ?></h2>
					<p class="text-[#0F172A] text-[18px] leading-[28px] max-w-[360px]"><?php echo esc_html( $settings['subcopy'] ); ?></p>
				</div>
				<div class="flex-1 flex flex-col">
					<?php foreach ( $settings['steps'] as $i => $step ) : ?>
						<div class="flex items-start gap-5 sm:gap-7 py-7 border-t border-[#F3F4F6] last:border-b">
							<?php if ( ! empty( $step['icon']['url'] ) ) : ?>
								<img src="<?php echo esc_url( $step['icon']['url'] ); ?>" alt="" class="shrink-0 w-14 h-14 sm:w-16 sm:h-16" />
							<?php endif; ?>
							<div class="flex flex-col gap-3 sm:gap-4 min-w-0">
								<h3 class="flex items-baseline gap-3 sm:gap-4">
									<span class="font-display font-semibold text-[16px] sm:text-[20px] leading-5 tracking-[1.2px] text-[#94A3B8]"><?php echo esc_html( sprintf( '%02d.', $i + 1 ) ); ?></span>
									<span class="font-display font-semibold text-[22px] leading-[28px] sm:text-[32px] sm:leading-9 text-[#0F172A]"><?php echo esc_html( $step['title'] ); ?></span>
								</h3>
								<p class="text-[#6B7280] text-[16px] sm:text-[18px] leading-[28px]"><?php echo esc_html( $step['description'] ); ?></p>
							</div>
						</div>
					<?php endforeach; ?>
				</div>
			</div>
		</section>
		<?php
	}
}
