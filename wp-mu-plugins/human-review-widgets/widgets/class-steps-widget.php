<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Repeater;

/**
 * Fixed to exactly 4 steps: the dashed connector uses a CSS Grid row-span
 * technique (row-start-1..row-end-4) whose class names must appear literally
 * in this file for Tailwind's content scanner to compile them - they can't
 * be built dynamically from a loop index.
 */
class Human_Review_Steps_Widget extends Widget_Base {

	public function get_name() {
		return 'human-review-steps';
	}

	public function get_title() {
		return __( 'HR: Steps (4, fixed)', 'human-review' );
	}

	public function get_icon() {
		return 'eicon-number-field';
	}

	public function get_categories() {
		return array( 'human-review' );
	}

	protected function register_controls() {
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

		$this->add_control(
			'steps',
			array(
				'label'       => __( 'Steps (exactly 4)', 'human-review' ),
				'type'        => Controls_Manager::REPEATER,
				'fields'      => $repeater->get_controls(),
				'title_field' => '{{{ title }}}',
				'default'     => array(
					array(
						'icon'        => array( 'url' => HUMAN_REVIEW_WIDGETS_URL . '/assets/img/how-it-works/icon-01.svg' ),
						'title'       => 'Create a request',
						'description' => 'Tell us exactly what you need reviewed or tested. You can define your target audience, set specific tasks or questions, and choose the format of the feedback you need.',
					),
					array(
						'icon'        => array( 'url' => HUMAN_REVIEW_WIDGETS_URL . '/assets/img/how-it-works/icon-02.svg' ),
						'title'       => 'We match you with verified real people',
						'description' => 'Our matching engine finds the best people in our network for your project. Every single participant is identity-verified—no bots, no fakes, ever.',
					),
					array(
						'icon'        => array( 'url' => HUMAN_REVIEW_WIDGETS_URL . '/assets/img/how-it-works/icon-03.svg' ),
						'title'       => 'They review or test',
						'description' => 'Reviewers interact with your product and provide honest, raw feedback. This includes written summaries, ratings, and video or audio recordings depending on your request.',
					),
					array(
						'icon'        => array( 'url' => HUMAN_REVIEW_WIDGETS_URL . '/assets/img/how-it-works/icon-04.svg' ),
						'title'       => 'You get honest feedback and media',
						'description' => 'Review all responses and high-quality media files directly in your dashboard. Export findings or share clips with your team immediately.',
					),
				),
			)
		);

		$this->end_controls_section();
	}

	private function step_number( $index ) {
		return str_pad( $index + 1, 2, '0', STR_PAD_LEFT );
	}

	private function render_card( $step, $row_start_class ) {
		$icon_url = ! empty( $step['icon']['url'] ) ? $step['icon']['url'] : '';
		?>
		<div class="<?php echo esc_attr( $row_start_class ); ?> flex items-center justify-between gap-[15.3px] max-w-[1032px] min-h-[208px] bg-white border border-[#F3F4F6] rounded-2xl p-9" style="box-shadow: 0px 1px 2px rgba(0,0,0,0.05), inset 0px -4px 24px rgba(0,0,0,0.03);">
			<div>
				<h3 class="font-display font-semibold text-[24px] sm:text-[28px] leading-[34px] text-[#0F172A] mb-4"><?php echo esc_html( $step['title'] ); ?></h3>
				<p class="text-[#6B7280] text-[16px] sm:text-[18px] leading-[28px] max-w-lg"><?php echo esc_html( $step['description'] ); ?></p>
			</div>
			<?php if ( $icon_url ) : ?>
				<img src="<?php echo esc_url( $icon_url ); ?>" alt="" class="shrink-0 w-16 h-16 sm:w-[100px] sm:h-[100px]" />
			<?php endif; ?>
		</div>
		<?php
	}

	protected function render() {
		$settings = $this->get_settings_for_display();
		$steps    = $settings['steps'];
		// Pad to exactly 4 so a shortened list in the editor doesn't break the grid.
		while ( count( $steps ) < 4 ) {
			$steps[] = array( 'icon' => array(), 'title' => '', 'description' => '' );
		}
		?>
		<section class="bg-white">
			<div class="max-w-[1120px] mx-auto px-6 lg:px-10 py-20 lg:py-24">
				<div class="grid grid-cols-[64px_1fr] gap-x-6 gap-y-6">
					<!-- connector: one dashed line spanning the full rail column, behind every circle -->
					<div class="col-start-1 row-start-1 row-end-4 flex justify-center">
						<span class="w-0 h-full border-l-2 border-dashed border-[#B6BFD1]"></span>
					</div>
					<div class="col-start-1 row-start-4 self-start flex justify-center -mt-6">
						<span class="w-0 h-14 border-l-2 border-dashed border-[#B6BFD1]"></span>
					</div>

					<span class="col-start-1 row-start-1 self-start relative z-10 w-16 h-16 rounded-full border-[1.33px] border-[#EEEEEE] bg-white flex items-center justify-center text-[20px] font-semibold leading-[26px] tracking-[1.6px] uppercase text-[#6B7280]"><?php echo esc_html( $this->step_number( 0 ) ); ?></span>
					<?php $this->render_card( $steps[0], 'col-start-2 row-start-1' ); ?>

					<span class="col-start-1 row-start-2 self-start relative z-10 w-16 h-16 rounded-full border-[1.33px] border-[#EEEEEE] bg-white flex items-center justify-center text-[20px] font-semibold leading-[26px] tracking-[1.6px] uppercase text-[#6B7280]"><?php echo esc_html( $this->step_number( 1 ) ); ?></span>
					<?php $this->render_card( $steps[1], 'col-start-2 row-start-2' ); ?>

					<span class="col-start-1 row-start-3 self-start relative z-10 w-16 h-16 rounded-full border-[1.33px] border-[#EEEEEE] bg-white flex items-center justify-center text-[20px] font-semibold leading-[26px] tracking-[1.6px] uppercase text-[#6B7280]"><?php echo esc_html( $this->step_number( 2 ) ); ?></span>
					<?php $this->render_card( $steps[2], 'col-start-2 row-start-3' ); ?>

					<span class="col-start-1 row-start-4 self-start relative z-10 w-16 h-16 rounded-full border-[1.33px] border-[#EEEEEE] bg-white flex items-center justify-center text-[20px] font-semibold leading-[26px] tracking-[1.6px] uppercase text-[#6B7280]"><?php echo esc_html( $this->step_number( 3 ) ); ?></span>
					<?php $this->render_card( $steps[3], 'col-start-2 row-start-4' ); ?>
				</div>
			</div>
		</section>
		<?php
	}
}
