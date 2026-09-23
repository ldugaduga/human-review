<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Repeater;

class Human_Review_Faq_Widget extends Widget_Base {

	public function get_name() {
		return 'human-review-faq';
	}

	public function get_title() {
		return __( 'HR: FAQ Accordion', 'human-review' );
	}

	public function get_icon() {
		return 'eicon-faq';
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
				'default' => 'Frequently asked questions',
			)
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_background',
			array( 'label' => __( 'Section Background', 'human-review' ) )
		);

		$this->add_control(
			'background_type',
			array(
				'label'   => __( 'Background Type', 'human-review' ),
				'type'    => Controls_Manager::SELECT,
				'default' => 'texture',
				'options' => array(
					'texture' => __( 'Textured', 'human-review' ),
					'color'   => __( 'Custom Color', 'human-review' ),
				),
			)
		);

		$this->add_control(
			'background_color',
			array(
				'label'     => __( 'Background Color', 'human-review' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#F3F4F9',
				'condition' => array(
					'background_type' => 'color',
				),
			)
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_items',
			array( 'label' => __( 'Questions', 'human-review' ) )
		);

		$repeater = new Repeater();

		$repeater->add_control(
			'question',
			array(
				'label'   => __( 'Question', 'human-review' ),
				'type'    => Controls_Manager::TEXT,
				'default' => __( 'Question', 'human-review' ),
			)
		);

		$repeater->add_control(
			'answer',
			array(
				'label'   => __( 'Answer', 'human-review' ),
				'type'    => Controls_Manager::TEXTAREA,
				'default' => '',
			)
		);

		$repeater->add_control(
			'open_by_default',
			array(
				'label'   => __( 'Open by Default', 'human-review' ),
				'type'    => Controls_Manager::SWITCHER,
				'default' => '',
			)
		);

		$this->add_control(
			'items',
			array(
				'label'       => __( 'Questions', 'human-review' ),
				'type'        => Controls_Manager::REPEATER,
				'fields'      => $repeater->get_controls(),
				'title_field' => '{{{ question }}}',
				'default'     => array(
					array(
						'question'        => 'How do I know what budget is right for me?',
						'answer'          => 'We can help you! Just book a call with us and we\'ll recommend a budget for you based on your team\'s needs as well as your expected design volume and velocity. Let\'s find the best option, together.',
						'open_by_default' => 'yes',
					),
					array(
						'question' => 'What is the minimum commitment?',
						'answer'   => 'There\'s no long-term contract required—you can start with a single project and scale up whenever you\'re ready.',
					),
					array(
						'question' => 'How does the onboarding work?',
						'answer'   => 'A dedicated specialist walks you through your first request, helps define your target audience, and gets your project live within a day.',
					),
					array(
						'question' => 'What billing options do you offer?',
						'answer'   => 'Choose monthly or pay-as-you-go billing, with invoicing available for annual plans.',
					),
					array(
						'question' => 'What happens if I don\'t use all of my budget in a month?',
						'answer'   => 'Unused budget rolls over to the next month, so you never lose what you\'ve already paid for.',
					),
					array(
						'question' => 'How much does a typical design project cost?',
						'answer'   => 'Most projects range from a few hundred to a few thousand dollars depending on scope, audience size, and turnaround time.',
					),
				),
			)
		);

		$this->end_controls_section();
	}

	protected function render() {
		$settings        = $this->get_settings_for_display();
		$background_type = ! empty( $settings['background_type'] ) ? $settings['background_type'] : 'texture';

		if ( 'color' === $background_type ) {
			$bg_color      = ! empty( $settings['background_color'] ) ? $settings['background_color'] : '#F3F4F9';
			$section_class = '';
			$section_style = 'background-color: ' . $bg_color . ';';
		} else {
			$section_class = 'bg-[#F9FAFB]';
			$section_style = '';
		}
		?>
		<section class="<?php echo esc_attr( $section_class ); ?>"<?php echo $section_style ? ' style="' . esc_attr( $section_style ) . '"' : ''; ?>>
			<div class="max-w-[1092px] mx-auto px-6 lg:px-0 py-20 lg:py-24 flex flex-col items-center gap-16">
				<div class="flex flex-col items-center gap-5 max-w-[500px] text-center">
					<h2 class="font-display font-semibold text-[36px] sm:text-[44px] lg:text-[56px] leading-[1.15] tracking-[-0.03em] text-[#242424]"><?php echo esc_html( $settings['heading'] ); ?></h2>
				</div>

				<div class="w-full flex flex-col gap-3">
					<?php foreach ( $settings['items'] as $item ) : ?>
						<?php
						$is_open   = ( 'yes' === $item['open_by_default'] );
						$item_cls  = $is_open ? 'bg-[#FFE4D5] rounded-xl px-5 py-5' : 'bg-[#FCFCFC] border border-[#EBEAEA] rounded-xl px-5 py-4';
						$text_cls  = $is_open ? 'text-orange' : 'text-[#141414]';
						?>
						<details <?php echo $is_open ? 'open' : ''; ?> class="group <?php echo esc_attr( $item_cls ); ?> transition">
							<summary class="flex items-center justify-between gap-8 cursor-pointer list-none marker:hidden">
								<span class="font-display font-semibold text-[17px] sm:text-[18px] leading-[1.2] <?php echo esc_attr( $text_cls ); ?>"><?php echo esc_html( $item['question'] ); ?></span>
								<span class="shrink-0 w-[26px] h-[26px] flex items-center justify-center <?php echo esc_attr( $text_cls ); ?> text-[22px] leading-none">
									<span class="group-open:hidden">+</span>
									<span class="hidden group-open:inline">&minus;</span>
								</span>
							</summary>
							<p class="text-[#4B4B4B] text-[15px] sm:text-[16px] leading-[1.5] tracking-[-0.03em] mt-4"><?php echo esc_html( $item['answer'] ); ?></p>
						</details>
					<?php endforeach; ?>
				</div>
			</div>
		</section>
		<?php
	}
}
