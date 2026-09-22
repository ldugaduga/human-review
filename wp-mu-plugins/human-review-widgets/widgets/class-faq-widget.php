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
		$settings = $this->get_settings_for_display();
		?>
		<section class="bg-surface texture-bg">
			<div class="max-w-[820px] mx-auto px-6 lg:px-10 py-20 lg:py-24">
				<h2 class="font-display font-semibold text-[32px] leading-[38px] sm:text-[40px] sm:leading-[46px] lg:text-[56px] lg:leading-[64px] text-[#0F172A] text-center mb-12"><?php echo esc_html( $settings['heading'] ); ?></h2>

				<div class="space-y-3">
					<?php foreach ( $settings['items'] as $item ) : ?>
						<?php $is_open = ( 'yes' === $item['open_by_default'] ); ?>
						<details <?php echo $is_open ? 'open' : ''; ?> class="group bg-white open:bg-orange/10 border border-ink/8 open:border-orange/20 rounded-2xl px-6 py-5 transition">
							<summary class="flex items-center justify-between cursor-pointer list-none marker:hidden">
								<span class="font-display font-semibold text-[15.5px] text-ink group-open:text-orange"><?php echo esc_html( $item['question'] ); ?></span>
								<span class="shrink-0 ml-4 text-ink/60 group-open:text-orange text-[20px] leading-none">
									<span class="group-open:hidden">+</span>
									<span class="hidden group-open:inline">&minus;</span>
								</span>
							</summary>
							<p class="text-ink/60 text-[14.5px] leading-relaxed mt-3"><?php echo esc_html( $item['answer'] ); ?></p>
						</details>
					<?php endforeach; ?>
				</div>
			</div>
		</section>
		<?php
	}
}
