<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Repeater;

class Human_Review_Unfiltered_Truth_Widget extends Widget_Base {

	public function get_name() {
		return 'human-review-unfiltered-truth';
	}

	public function get_title() {
		return __( 'HR: Unfiltered Truth', 'human-review' );
	}

	public function get_icon() {
		return 'eicon-testimonial';
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
				'default' => 'Unfiltered truth, delivered.',
			)
		);

		$this->add_control(
			'subcopy',
			array(
				'label'   => __( 'Subcopy', 'human-review' ),
				'type'    => Controls_Manager::TEXTAREA,
				'default' => 'Every project results in a structured set of qualitative data that you can use immediately.',
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
					array( 'text' => 'Detailed written feedback' ),
					array( 'text' => 'Standardised ratings & scores' ),
					array( 'text' => 'Video and audio recordings' ),
				),
			)
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_card',
			array( 'label' => __( 'Respondent Card', 'human-review' ) )
		);

		$this->add_control(
			'card_label',
			array(
				'label'   => __( 'Label', 'human-review' ),
				'type'    => Controls_Manager::TEXT,
				'default' => 'Respondent',
			)
		);

		$this->add_control(
			'card_image',
			array(
				'label'   => __( 'Image', 'human-review' ),
				'type'    => Controls_Manager::MEDIA,
				'default' => array( 'url' => HUMAN_REVIEW_WIDGETS_URL . '/assets/img/how-it-works/respondent.png' ),
			)
		);

		$this->add_control(
			'card_image_alt',
			array(
				'label'   => __( 'Image Alt Text', 'human-review' ),
				'type'    => Controls_Manager::TEXT,
				'default' => 'Respondent giving feedback on camera',
			)
		);

		$this->end_controls_section();
	}

	protected function render() {
		$settings   = $this->get_settings_for_display();
		$image_url  = ! empty( $settings['card_image']['url'] ) ? $settings['card_image']['url'] : HUMAN_REVIEW_WIDGETS_URL . '/assets/img/how-it-works/respondent.png';
		?>
		<section class="bg-white texture-bg">
			<div class="max-w-[1280px] mx-auto px-6 lg:px-10 py-20 lg:py-24 grid lg:grid-cols-2 gap-16 items-center">
				<div>
					<h2 class="font-display font-semibold text-[32px] leading-[38px] sm:text-[40px] sm:leading-[46px] lg:text-[56px] lg:leading-[64px] text-[#0F172A] mb-6"><?php echo esc_html( $settings['heading'] ); ?></h2>
					<p class="text-ink/60 text-[15.5px] leading-relaxed max-w-md mb-8"><?php echo esc_html( $settings['subcopy'] ); ?></p>
					<ul class="space-y-4">
						<?php foreach ( $settings['checklist'] as $item ) : ?>
							<li class="flex items-center gap-3">
								<span class="w-5 h-5 rounded-full bg-green-500 flex items-center justify-center shrink-0">
									<svg width="11" height="11" viewBox="0 0 16 16" fill="none"><path d="M3 8.5L6.5 12L13 4.5" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/></svg>
								</span>
								<span class="text-ink text-[15px] font-medium"><?php echo esc_html( $item['text'] ); ?></span>
							</li>
						<?php endforeach; ?>
					</ul>
				</div>

				<div class="flex justify-center">
					<div class="w-full max-w-2xl flex flex-col items-start bg-white border-[1.11px] border-[rgba(30,20,102,0.08)] rounded-[28px] overflow-hidden">
						<div class="w-full flex items-center gap-2.5 px-8 py-3.5">
							<span class="w-2.5 h-2.5 shrink-0 bg-orange"></span>
							<span class="font-display font-semibold text-[23px] leading-none tracking-[-0.736px] text-[#0F0A2E]"><?php echo esc_html( $settings['card_label'] ); ?></span>
						</div>
						<img src="<?php echo esc_url( $image_url ); ?>" alt="<?php echo esc_attr( $settings['card_image_alt'] ); ?>" class="w-full min-h-[320px] aspect-[16/10] object-cover" />
					</div>
				</div>
			</div>
		</section>
		<?php
	}
}
