<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Repeater;

class Human_Review_Header_Widget extends Widget_Base {

	public function get_name() {
		return 'human-review-header';
	}

	public function get_title() {
		return __( 'HR: Header', 'human-review' );
	}

	public function get_icon() {
		return 'eicon-header';
	}

	public function get_categories() {
		return array( 'human-review' );
	}

	protected function register_controls() {
		$this->start_controls_section(
			'section_logo',
			array( 'label' => __( 'Logo', 'human-review' ) )
		);

		$this->add_control(
			'logo',
			array(
				'label'   => __( 'Logo', 'human-review' ),
				'type'    => Controls_Manager::MEDIA,
				'default' => array(
					'url' => HUMAN_REVIEW_WIDGETS_URL . '/assets/img/logo.svg',
				),
			)
		);

		$this->add_control(
			'logo_link',
			array(
				'label'   => __( 'Logo Link', 'human-review' ),
				'type'    => Controls_Manager::URL,
				'default' => array( 'url' => home_url( '/' ) ),
			)
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_nav',
			array( 'label' => __( 'Navigation', 'human-review' ) )
		);

		$repeater = new Repeater();

		$repeater->add_control(
			'label',
			array(
				'label'   => __( 'Label', 'human-review' ),
				'type'    => Controls_Manager::TEXT,
				'default' => __( 'Menu item', 'human-review' ),
			)
		);

		$repeater->add_control(
			'link',
			array(
				'label'   => __( 'Link', 'human-review' ),
				'type'    => Controls_Manager::URL,
				'default' => array( 'url' => '#' ),
			)
		);

		$repeater->add_control(
			'is_active',
			array(
				'label'   => __( 'Mark as current page', 'human-review' ),
				'type'    => Controls_Manager::SWITCHER,
				'default' => '',
			)
		);

		$this->add_control(
			'nav_items',
			array(
				'label'       => __( 'Nav Links', 'human-review' ),
				'type'        => Controls_Manager::REPEATER,
				'fields'      => $repeater->get_controls(),
				'default'     => array(
					array( 'label' => 'How it works', 'link' => array( 'url' => home_url( '/how-it-works/' ) ) ),
					array( 'label' => 'Solutions', 'link' => array( 'url' => '#' ) ),
					array( 'label' => 'Pricing', 'link' => array( 'url' => '#' ) ),
					array( 'label' => 'About', 'link' => array( 'url' => home_url( '/about/' ) ) ),
				),
				'title_field' => '{{{ label }}}',
			)
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_buttons',
			array( 'label' => __( 'Buttons', 'human-review' ) )
		);

		$this->add_control(
			'login_text',
			array(
				'label'   => __( 'Log In Text', 'human-review' ),
				'type'    => Controls_Manager::TEXT,
				'default' => 'Log in',
			)
		);

		$this->add_control(
			'login_link',
			array(
				'label'   => __( 'Log In Link', 'human-review' ),
				'type'    => Controls_Manager::URL,
				'default' => array( 'url' => '#' ),
			)
		);

		$this->add_control(
			'signup_text',
			array(
				'label'   => __( 'Sign Up Text', 'human-review' ),
				'type'    => Controls_Manager::TEXT,
				'default' => 'Sign up free',
			)
		);

		$this->add_control(
			'signup_link',
			array(
				'label'   => __( 'Sign Up Link', 'human-review' ),
				'type'    => Controls_Manager::URL,
				'default' => array( 'url' => '#' ),
			)
		);

		$this->end_controls_section();
	}

	protected function render() {
		$settings = $this->get_settings_for_display();
		$logo_url = ! empty( $settings['logo']['url'] ) ? $settings['logo']['url'] : HUMAN_REVIEW_WIDGETS_URL . '/assets/img/logo.svg';
		$logo_href = ! empty( $settings['logo_link']['url'] ) ? $settings['logo_link']['url'] : home_url( '/' );
		$nav_items = ! empty( $settings['nav_items'] ) ? $settings['nav_items'] : array();
		?>
		<header class="w-full bg-[#F9FAFB] backdrop-blur-[6px] border-b border-[#F3F4F6] hr-header">
			<div class="max-w-[1280px] mx-auto flex items-center justify-between px-6 lg:px-0 py-5">
				<a href="<?php echo esc_url( $logo_href ); ?>" class="flex items-center gap-2 shrink-0">
					<img src="<?php echo esc_url( $logo_url ); ?>" alt="<?php echo esc_attr( get_bloginfo( 'name' ) ); ?>" class="h-7 w-auto" />
				</a>

				<nav class="hidden nav:flex items-center gap-8 text-[16px] font-medium text-[#0F172A]">
					<?php foreach ( $nav_items as $item ) : ?>
						<a href="<?php echo esc_url( $item['link']['url'] ); ?>" class="<?php echo ( 'yes' === $item['is_active'] ) ? 'text-orange' : 'hover:text-orange transition'; ?>"><?php echo esc_html( $item['label'] ); ?></a>
					<?php endforeach; ?>
				</nav>

				<div class="flex items-center gap-3 shrink-0">
					<a href="<?php echo esc_url( $settings['login_link']['url'] ); ?>" class="hidden sm:inline-flex items-center px-[16.8px] py-[9px] rounded-full border border-[#CCCCDC] text-[14px] font-medium text-[#0F172A] hover:bg-ink/5 transition"><?php echo esc_html( $settings['login_text'] ); ?></a>
					<a href="<?php echo esc_url( $settings['signup_link']['url'] ); ?>" class="hidden sm:inline-flex items-center px-[16.8px] py-[9px] rounded-full bg-[#0F172A] text-white text-[14px] font-semibold hover:bg-[#0F172A]/90 transition"><?php echo esc_html( $settings['signup_text'] ); ?></a>

					<button type="button" aria-label="Toggle menu" aria-expanded="false" class="hr-menu-btn nav:hidden flex items-center justify-center w-10 h-10 rounded-full hover:bg-ink/5 transition -mr-2">
						<svg class="hr-icon-open" width="22" height="22" viewBox="0 0 24 24" fill="none"><path d="M4 7H20M4 12H20M4 17H20" stroke="#12141C" stroke-width="1.8" stroke-linecap="round"/></svg>
						<svg class="hr-icon-close hidden" width="22" height="22" viewBox="0 0 24 24" fill="none"><path d="M6 6L18 18M18 6L6 18" stroke="#12141C" stroke-width="1.8" stroke-linecap="round"/></svg>
					</button>
				</div>
			</div>

			<div class="hr-mobile-menu hidden nav:hidden border-t border-ink/10 bg-white">
				<nav class="px-6 py-4 flex flex-col text-[16px] font-medium text-[#0F172A]">
					<?php foreach ( $nav_items as $item ) : ?>
						<a href="<?php echo esc_url( $item['link']['url'] ); ?>" class="block px-2 py-2.5 rounded-lg <?php echo ( 'yes' === $item['is_active'] ) ? 'bg-ink/5 text-orange' : 'hover:bg-ink/5 hover:text-orange transition'; ?>"><?php echo esc_html( $item['label'] ); ?></a>
					<?php endforeach; ?>
				</nav>
				<div class="px-6 pb-6 pt-2 flex flex-col gap-3 border-t border-ink/10">
					<a href="<?php echo esc_url( $settings['login_link']['url'] ); ?>" class="inline-flex items-center justify-center px-[16.8px] py-[9px] rounded-full border border-[#CCCCDC] text-[14px] font-medium text-[#0F172A] hover:bg-ink/5 transition"><?php echo esc_html( $settings['login_text'] ); ?></a>
					<a href="<?php echo esc_url( $settings['signup_link']['url'] ); ?>" class="inline-flex items-center justify-center px-[16.8px] py-[9px] rounded-full bg-[#0F172A] text-white text-[14px] font-semibold hover:bg-[#0F172A]/90 transition"><?php echo esc_html( $settings['signup_text'] ); ?></a>
				</div>
			</div>
		</header>
		<?php
	}
}
