<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Repeater;

class Human_Review_Beliefs_Widget extends Widget_Base {

	public function get_name() {
		return 'human-review-beliefs';
	}

	public function get_title() {
		return __( 'HR: What We Believe', 'human-review' );
	}

	public function get_icon() {
		return 'eicon-info-circle-o';
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
				'default' => 'What we believe',
			)
		);

		$this->add_control(
			'subheading',
			array(
				'label'   => __( 'Subheading', 'human-review' ),
				'type'    => Controls_Manager::TEXT,
				'default' => 'The values that guide our network every day.',
			)
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_cards',
			array( 'label' => __( 'Cards', 'human-review' ) )
		);

		$repeater = new Repeater();

		$repeater->add_control(
			'icon',
			array(
				'label'   => __( 'Icon', 'human-review' ),
				'type'    => Controls_Manager::MEDIA,
			)
		);

		$repeater->add_control(
			'title',
			array(
				'label'   => __( 'Title', 'human-review' ),
				'type'    => Controls_Manager::TEXT,
				'default' => __( 'Card title', 'human-review' ),
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

		$this->add_control(
			'cards',
			array(
				'label'       => __( 'Cards', 'human-review' ),
				'type'        => Controls_Manager::REPEATER,
				'fields'      => $repeater->get_controls(),
				'title_field' => '{{{ title }}}',
				'default'     => array(
					array(
						'icon'        => array( 'url' => HUMAN_REVIEW_WIDGETS_URL . '/assets/img/icon1.svg' ),
						'title'       => 'Real people over bots',
						'description' => 'We prioritize human intuition over algorithmic efficiency. If it can be automated, it\'s not a review.',
					),
					array(
						'icon'        => array( 'url' => HUMAN_REVIEW_WIDGETS_URL . '/assets/img/icon2.svg' ),
						'title'       => 'Honesty over metrics',
						'description' => 'We don\'t optimize for 5-star ratings, we optimize for the truth, even when it\'s hard to hear.',
					),
					array(
						'icon'        => array( 'url' => HUMAN_REVIEW_WIDGETS_URL . '/assets/img/icon3.svg' ),
						'title'       => 'Fast without shortcuts',
						'description' => 'We move at the speed of business, but we never cut corners on verification or quality checks.',
					),
				),
			)
		);

		$this->end_controls_section();
	}

	protected function render() {
		$settings = $this->get_settings_for_display();
		?>
		<section class="bg-[#F9FAFB]">
			<div class="max-w-[1280px] mx-auto px-6 py-20 lg:py-[100px] lg:px-0">
				<div class="text-center max-w-xl mx-auto mb-12">
					<h2 class="font-display font-semibold text-[32px] leading-[38px] sm:text-[40px] sm:leading-[46px] lg:text-[56px] lg:leading-[64px] text-[#0F172A] mb-4"><?php echo esc_html( $settings['heading'] ); ?></h2>
					<p class="text-[#0F172A] text-[18px] leading-[28px]"><?php echo esc_html( $settings['subheading'] ); ?></p>
				</div>

				<div class="bg-white rounded-3xl border border-ink/10 grid sm:grid-cols-3 divide-y sm:divide-y-0 sm:divide-x divide-ink/10 overflow-hidden">
					<?php foreach ( $settings['cards'] as $card ) : ?>
						<div class="p-9">
							<?php if ( ! empty( $card['icon']['url'] ) ) : ?>
								<img src="<?php echo esc_url( $card['icon']['url'] ); ?>" alt="" class="w-16 h-16 mb-9" />
							<?php endif; ?>
							<h3 class="font-display font-semibold text-[24px] leading-[32px] text-[#0F172A] mb-4"><?php echo esc_html( $card['title'] ); ?></h3>
							<p class="text-[#6B7280] text-[18px] leading-[28px]"><?php echo esc_html( $card['description'] ); ?></p>
						</div>
					<?php endforeach; ?>
				</div>
			</div>
		</section>
		<?php
	}
}
