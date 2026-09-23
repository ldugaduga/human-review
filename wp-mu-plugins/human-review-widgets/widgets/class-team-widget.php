<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Repeater;

class Human_Review_Team_Widget extends Widget_Base {

	public function get_name() {
		return 'human-review-team';
	}

	public function get_title() {
		return __( 'HR: Humans Behind the Reviews', 'human-review' );
	}

	public function get_icon() {
		return 'eicon-person';
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
				'default' => 'The humans behind the reviews',
			)
		);

		$this->add_control(
			'subheading',
			array(
				'label'   => __( 'Subheading', 'human-review' ),
				'type'    => Controls_Manager::TEXTAREA,
				'default' => 'Our core team is dedicated to building the world\'s most trusted supply of human feedback.',
			)
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_members',
			array( 'label' => __( 'Team Members', 'human-review' ) )
		);

		$repeater = new Repeater();

		$repeater->add_control(
			'photo',
			array(
				'label' => __( 'Photo', 'human-review' ),
				'type'  => Controls_Manager::MEDIA,
			)
		);

		$repeater->add_control(
			'name',
			array(
				'label'   => __( 'Name', 'human-review' ),
				'type'    => Controls_Manager::TEXT,
				'default' => __( 'Full name', 'human-review' ),
			)
		);

		$repeater->add_control(
			'role',
			array(
				'label'   => __( 'Role', 'human-review' ),
				'type'    => Controls_Manager::TEXT,
				'default' => __( 'Role', 'human-review' ),
			)
		);

		$this->add_control(
			'members',
			array(
				'label'       => __( 'Team Members', 'human-review' ),
				'type'        => Controls_Manager::REPEATER,
				'fields'      => $repeater->get_controls(),
				'title_field' => '{{{ name }}}',
				'default'     => array(
					array(
						'photo' => array( 'url' => HUMAN_REVIEW_WIDGETS_URL . '/assets/img/teams/alex-1.jpg' ),
						'name'  => 'Alex Rivera',
						'role'  => 'Founder & CEO',
					),
					array(
						'photo' => array( 'url' => HUMAN_REVIEW_WIDGETS_URL . '/assets/img/teams/sarah-01.jpg' ),
						'name'  => 'Sarah Jenkins',
						'role'  => 'Head of Research',
					),
					array(
						'photo' => array( 'url' => HUMAN_REVIEW_WIDGETS_URL . '/assets/img/teams/marcus-01.jpg' ),
						'name'  => 'Marcus Thorne',
						'role'  => 'Director of Trust & Safety',
					),
					array(
						'photo' => array( 'url' => HUMAN_REVIEW_WIDGETS_URL . '/assets/img/teams/elena-01.jpg' ),
						'name'  => 'Elena Vance',
						'role'  => 'Head of Network',
					),
				),
			)
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_verify',
			array( 'label' => __( 'Verify Banner', 'human-review' ) )
		);

		$this->add_control(
			'verify_heading',
			array(
				'label'   => __( 'Heading', 'human-review' ),
				'type'    => Controls_Manager::TEXT,
				'default' => 'How we verify our reviewers',
			)
		);

		$this->add_control(
			'verify_text',
			array(
				'label'   => __( 'Text', 'human-review' ),
				'type'    => Controls_Manager::TEXTAREA,
				'default' => 'Every member of our 12,000+ person network undergoes government-grade ID verification and a manual profile review before being matched with any project.',
			)
		);

		$stats_repeater = new Repeater();

		$stats_repeater->add_control(
			'value',
			array(
				'label'   => __( 'Value', 'human-review' ),
				'type'    => Controls_Manager::TEXT,
				'default' => '12k+',
			)
		);

		$stats_repeater->add_control(
			'label',
			array(
				'label'   => __( 'Label', 'human-review' ),
				'type'    => Controls_Manager::TEXT,
				'default' => 'Verified people',
			)
		);

		$this->add_control(
			'stats',
			array(
				'label'       => __( 'Stats', 'human-review' ),
				'type'        => Controls_Manager::REPEATER,
				'fields'      => $stats_repeater->get_controls(),
				'title_field' => '{{{ value }}} - {{{ label }}}',
				'default'     => array(
					array( 'value' => '12k+', 'label' => 'Verified people' ),
					array( 'value' => '24h', 'label' => 'Avg. turnaround' ),
				),
			)
		);

		$this->end_controls_section();
	}

	protected function render() {
		$settings = $this->get_settings_for_display();
		?>
		<section class="bg-[#F9FAFB]">
			<div class="max-w-[1280px] mx-auto px-6 py-20 lg:py-[100px] lg:px-[104px]">
				<div class="text-center max-w-2xl mx-auto mb-16">
					<h2 class="font-display font-semibold text-[32px] leading-[38px] sm:text-[40px] sm:leading-[46px] lg:text-[56px] lg:leading-[64px] text-[#0F172A] mb-4"><?php echo esc_html( $settings['heading'] ); ?></h2>
					<p class="text-[#0F172A] text-[18px] leading-[28px]"><?php echo esc_html( $settings['subheading'] ); ?></p>
				</div>

				<div class="flex flex-col gap-3 mb-5">
					<div class="grid grid-cols-2 lg:grid-cols-4 gap-5">
						<?php foreach ( $settings['members'] as $member ) : ?>
							<?php if ( ! empty( $member['photo']['url'] ) ) : ?>
								<img src="<?php echo esc_url( $member['photo']['url'] ); ?>" alt="<?php echo esc_attr( $member['name'] ); ?>" class="w-full aspect-[293/380] object-cover rounded-2xl border border-[#F3F4F6] shadow-[0px_1px_2px_rgba(0,0,0,0.05)]" />
							<?php endif; ?>
						<?php endforeach; ?>
					</div>
					<div class="grid grid-cols-2 lg:grid-cols-4 gap-5">
						<?php foreach ( $settings['members'] as $member ) : ?>
							<div class="bg-white border border-[#F3F4F6] shadow-[0px_1px_2px_rgba(0,0,0,0.05)] rounded-2xl px-6 py-5">
								<h3 class="font-display font-semibold text-[22px] leading-[25px] text-[#0F172A] mb-2.5"><?php echo esc_html( $member['name'] ); ?></h3>
								<p class="text-[#6B7280] text-[16px] leading-[26px]"><?php echo esc_html( $member['role'] ); ?></p>
							</div>
						<?php endforeach; ?>
					</div>
				</div>

				<div class="bg-black border border-[#0F172A] rounded-2xl p-8 sm:p-12 flex flex-col lg:flex-row lg:items-center justify-between gap-8">
					<div class="max-w-[661px] flex flex-col gap-4">
						<h3 class="font-display font-semibold text-white text-[24px] sm:text-[26px] leading-[32px]"><?php echo esc_html( $settings['verify_heading'] ); ?></h3>
						<p class="text-[#9FABC7] text-[16px] leading-[26px]"><?php echo esc_html( $settings['verify_text'] ); ?></p>
					</div>
					<div class="flex items-center gap-4 sm:gap-[15px] shrink-0">
						<?php foreach ( $settings['stats'] as $stat ) : ?>
							<div class="flex flex-col gap-2">
								<p class="font-display font-medium text-orange text-[48px] leading-[48px]"><?php echo esc_html( $stat['value'] ); ?></p>
								<p class="text-white text-[14px] leading-[28px] uppercase"><?php echo esc_html( $stat['label'] ); ?></p>
							</div>
						<?php endforeach; ?>
					</div>
				</div>
			</div>
		</section>
		<?php
	}
}
