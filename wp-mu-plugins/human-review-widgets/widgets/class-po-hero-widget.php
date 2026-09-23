<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

use Elementor\Widget_Base;
use Elementor\Controls_Manager;

class Human_Review_Po_Hero_Widget extends Widget_Base {

	public function get_name() {
		return 'human-review-po-hero';
	}

	public function get_title() {
		return __( 'HR: Product Hero', 'human-review' );
	}

	public function get_icon() {
		return 'eicon-header';
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
			'badge_text',
			array(
				'label'   => __( 'Badge Text', 'human-review' ),
				'type'    => Controls_Manager::TEXT,
				'default' => 'Product',
			)
		);

		$this->add_control(
			'heading',
			array(
				'label'       => __( 'Heading', 'human-review' ),
				'type'        => Controls_Manager::TEXTAREA,
				'rows'        => 2,
				'default'     => "One platform for\nreal human feedback",
				'description' => __( 'Line breaks apply from tablet up; mobile wraps naturally.', 'human-review' ),
			)
		);

		$this->add_control(
			'subcopy',
			array(
				'label'       => __( 'Subcopy', 'human-review' ),
				'type'        => Controls_Manager::TEXTAREA,
				'default'     => "Request reviews, run product research, and get authentic\nvideo responses from verified people — all from a single dashboard.",
				'description' => __( 'Line breaks apply on desktop only.', 'human-review' ),
			)
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_buttons',
			array( 'label' => __( 'Buttons', 'human-review' ) )
		);

		$this->add_control(
			'primary_text',
			array(
				'label'   => __( 'Primary Button Text', 'human-review' ),
				'type'    => Controls_Manager::TEXT,
				'default' => 'Get started today',
			)
		);

		$this->add_control(
			'primary_link',
			array(
				'label'   => __( 'Primary Button Link', 'human-review' ),
				'type'    => Controls_Manager::URL,
				'default' => array( 'url' => '#' ),
			)
		);

		$this->add_control(
			'secondary_text',
			array(
				'label'   => __( 'Secondary Button Text', 'human-review' ),
				'type'    => Controls_Manager::TEXT,
				'default' => 'See the platform',
			)
		);

		$this->add_control(
			'secondary_link',
			array(
				'label'   => __( 'Secondary Button Link', 'human-review' ),
				'type'    => Controls_Manager::URL,
				'default' => array( 'url' => '#' ),
			)
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_image',
			array( 'label' => __( 'Dashboard Preview', 'human-review' ) )
		);

		$this->add_control(
			'image',
			array(
				'label'   => __( 'Image', 'human-review' ),
				'type'    => Controls_Manager::MEDIA,
				'default' => array( 'url' => HUMAN_REVIEW_WIDGETS_URL . '/assets/img/product-overview/dashboard.svg' ),
			)
		);

		$this->add_control(
			'image_alt',
			array(
				'label'   => __( 'Image Alt Text', 'human-review' ),
				'type'    => Controls_Manager::TEXT,
				'default' => 'The Human Review dashboard showing active requests, reviews in progress and recent requests',
			)
		);

		$this->end_controls_section();
	}

	/**
	 * Escapes text and turns editor newlines into <br> tags carrying the given
	 * classes (e.g. "hidden sm:inline"), so narrow screens wrap naturally.
	 * Classes are passed whole so Tailwind's content scan can see them.
	 */
	private function lines( $text, $br_class ) {
		$parts = array_map( 'esc_html', preg_split( '/\r\n|\r|\n/', trim( $text ) ) );
		return implode( ' <br class="' . $br_class . '" />', $parts );
	}

	protected function render() {
		$settings  = $this->get_settings_for_display();
		$image_url = ! empty( $settings['image']['url'] ) ? $settings['image']['url'] : HUMAN_REVIEW_WIDGETS_URL . '/assets/img/product-overview/dashboard.svg';
		?>
		<section class="relative bg-[#F9FAFB] overflow-hidden">
			<div class="max-w-[1280px] mx-auto px-6 lg:px-0 pt-16 lg:pt-[87px] flex flex-col gap-10 lg:gap-12">
				<div class="flex flex-col items-start gap-8">
					<?php if ( $settings['badge_text'] ) : ?>
						<span class="inline-flex items-center px-4 py-1.5 bg-gradient-to-b from-white to-[#F1F1F1] border border-[#EEEEEE] rounded-full text-[12px] leading-4 font-semibold tracking-[1.2px] text-[#10182B] uppercase" style="border-radius: 9999px;"><?php echo esc_html( $settings['badge_text'] ); ?></span>
					<?php endif; ?>
					<div class="w-full flex flex-col lg:flex-row lg:items-end gap-8">
						<div class="flex-1 flex flex-col gap-5">
							<h1 class="font-display font-semibold text-[44px] leading-[46px] tracking-[-1.8px] sm:text-[64px] sm:leading-[66px] sm:tracking-[-2.8px] lg:text-[80px] lg:leading-[80px] lg:tracking-[-3.84px] text-[#0F172A] max-w-[760px]"><?php echo $this->lines( $settings['heading'], 'hidden sm:inline' ); // phpcs:ignore WordPress.Security.EscapeOutput -- escaped in lines(). ?></h1>
							<p class="text-[#0F172A] text-[18px] sm:text-[20px] leading-[30px] max-w-[640px]"><?php echo $this->lines( $settings['subcopy'], 'hidden lg:inline' ); // phpcs:ignore WordPress.Security.EscapeOutput -- escaped in lines(). ?></p>
						</div>
						<div class="flex flex-col sm:flex-row gap-4 lg:gap-5 shrink-0">
							<?php if ( $settings['primary_text'] ) : ?>
								<a href="<?php echo esc_url( $settings['primary_link']['url'] ); ?>" class="inline-flex items-center justify-center gap-[9px] bg-orange hover:bg-orange-600 transition text-white font-bold text-[16px] leading-6 px-7 py-[15px] rounded-full border border-[#FF853D]" style="border-radius: 9999px; box-shadow: 0px 10px 26px -10px rgba(255, 109, 24, 0.5);">
									<?php echo esc_html( $settings['primary_text'] ); ?>
									<svg width="15" height="15" viewBox="0 0 16 16" fill="none"><path d="M2 8H14M14 8L9.5 3.5M14 8L9.5 12.5" stroke="white" stroke-width="1.7" stroke-linecap="round" stroke-linejoin="round"/></svg>
								</a>
							<?php endif; ?>
							<?php if ( $settings['secondary_text'] ) : ?>
								<a href="<?php echo esc_url( $settings['secondary_link']['url'] ); ?>" class="inline-flex items-center justify-center px-7 py-[15px] rounded-full bg-white border border-[rgba(0,1,80,0.2)] backdrop-blur-[8px] text-[#000150] font-semibold text-[16px] leading-6 hover:bg-[#FFF7F2] transition" style="border-radius: 9999px;"><?php echo esc_html( $settings['secondary_text'] ); ?></a>
							<?php endif; ?>
						</div>
					</div>
				</div>

				<!-- Dashboard preview: framed screenshot that fades into the next section -->
				<div class="relative bg-white border border-[#E6E8EC] border-b-0 rounded-t-[20px] lg:rounded-t-[30px] pt-2.5 px-2.5 sm:pt-5 sm:px-5 overflow-hidden">
					<img src="<?php echo esc_url( $image_url ); ?>" alt="<?php echo esc_attr( $settings['image_alt'] ); ?>" class="block w-full h-auto rounded-t-[10px] lg:rounded-t-[14px]" />
				</div>
			</div>
			<div class="absolute inset-x-0 bottom-0 h-[124px] bg-gradient-to-b from-[rgba(243,243,243,0)] to-[#F3F3F3] pointer-events-none"></div>
		</section>
		<?php
	}
}
