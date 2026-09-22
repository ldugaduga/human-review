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
		<section class="bg-white">
			<div class="max-w-[1280px] mx-auto px-6 lg:px-10 py-20 lg:py-24">
				<div class="text-center max-w-xl mx-auto mb-14">
					<h2 class="font-display font-semibold text-[32px] leading-[38px] sm:text-[40px] sm:leading-[46px] lg:text-[56px] lg:leading-[64px] text-[#0F172A] mb-4"><?php echo esc_html( $settings['heading'] ); ?></h2>
					<p class="text-ink/55 text-[16px] leading-relaxed"><?php echo esc_html( $settings['subheading'] ); ?></p>
				</div>

				<div class="grid grid-cols-2 md:grid-cols-4 gap-6 mb-10">
					<?php foreach ( $settings['members'] as $member ) : ?>
						<div>
							<?php if ( ! empty( $member['photo']['url'] ) ) : ?>
								<img src="<?php echo esc_url( $member['photo']['url'] ); ?>" alt="<?php echo esc_attr( $member['name'] ); ?>" class="w-full aspect-[3/4] object-cover rounded-2xl mb-4" />
							<?php endif; ?>
							<h3 class="font-display font-bold text-[16px] text-ink"><?php echo esc_html( $member['name'] ); ?></h3>
							<p class="text-ink/50 text-[13.5px]"><?php echo esc_html( $member['role'] ); ?></p>
						</div>
					<?php endforeach; ?>
				</div>

				<div class="bg-ink rounded-3xl px-8 sm:px-12 py-10 flex flex-col md:flex-row items-start md:items-center justify-between gap-8">
					<div class="max-w-md">
						<h3 class="font-display font-bold text-white text-[19px] mb-2"><?php echo esc_html( $settings['verify_heading'] ); ?></h3>
						<p class="text-white/50 text-[14px] leading-relaxed"><?php echo esc_html( $settings['verify_text'] ); ?></p>
					</div>
					<div class="flex items-center gap-10 shrink-0">
						<?php foreach ( $settings['stats'] as $stat ) : ?>
							<div>
								<p class="font-display font-extrabold text-orange text-[34px] leading-none mb-1"><?php echo esc_html( $stat['value'] ); ?></p>
								<p class="text-white/40 text-[11px] tracking-[0.1em] uppercase"><?php echo esc_html( $stat['label'] ); ?></p>
							</div>
						<?php endforeach; ?>
					</div>
				</div>
			</div>
		</section>
		<?php
	}
}
