<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

use Elementor\Widget_Base;
use Elementor\Controls_Manager;

class Human_Review_Why_Exist_Widget extends Widget_Base {

	public function get_name() {
		return 'human-review-why-exist';
	}

	public function get_title() {
		return __( 'HR: Why We Exist', 'human-review' );
	}

	public function get_icon() {
		return 'eicon-post-content';
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
				'default' => 'Why we exist',
			)
		);

		$this->add_control(
			'body',
			array(
				'label'   => __( 'Body', 'human-review' ),
				'type'    => Controls_Manager::WYSIWYG,
				'default' => '<p>In a world increasingly flooded with AI-generated content, fake reviews, and vanity metrics, finding the truth has become harder than ever. Businesses are making critical decisions based on data that doesn\'t always have a soul.</p><p>The Human Review was born from a simple realization: human intuition is the one thing AI can\'t fake. We saw a gap where companies needed honest, unfiltered feedback from real people to build products that actually matter.</p><p>Our platform ensures that every piece of feedback you receive comes from a verified, identity-checked human who genuinely fits your audience profile.</p>',
			)
		);

		$this->add_control(
			'button_text',
			array(
				'label'   => __( 'Button Text', 'human-review' ),
				'type'    => Controls_Manager::TEXT,
				'default' => 'Book a Demo',
			)
		);

		$this->add_control(
			'button_link',
			array(
				'label'   => __( 'Button Link', 'human-review' ),
				'type'    => Controls_Manager::URL,
				'default' => array( 'url' => '#' ),
			)
		);

		$this->add_control(
			'image',
			array(
				'label'   => __( 'Image', 'human-review' ),
				'type'    => Controls_Manager::MEDIA,
				'default' => array( 'url' => HUMAN_REVIEW_WIDGETS_URL . '/assets/img/why-exist.svg' ),
			)
		);

		$this->add_control(
			'image_alt',
			array(
				'label'   => __( 'Image Alt Text', 'human-review' ),
				'type'    => Controls_Manager::TEXT,
				'default' => 'A reviewer writing detailed feedback notes',
			)
		);

		$this->end_controls_section();
	}

	protected function render() {
		$settings  = $this->get_settings_for_display();
		$image_url = ! empty( $settings['image']['url'] ) ? $settings['image']['url'] : HUMAN_REVIEW_WIDGETS_URL . '/assets/img/why-exist.svg';
		?>
		<section class="bg-white">
			<div class="max-w-[1280px] mx-auto px-6 py-20 lg:py-[120px] lg:px-0 flex flex-col lg:flex-row lg:items-end gap-12 lg:gap-[90px]">
				<div class="flex-1 flex flex-col items-start gap-8 max-w-[571px]">
					<h2 class="font-display font-semibold text-[32px] leading-[38px] sm:text-[40px] sm:leading-[46px] lg:text-[56px] lg:leading-[64px] text-[#0F172A]"><?php echo esc_html( $settings['heading'] ); ?></h2>
					<div class="text-[#0F172A] text-[17px] sm:text-[18px] leading-[26px] space-y-4">
						<?php echo wp_kses_post( $settings['body'] ); ?>
					</div>
					<a href="<?php echo esc_url( $settings['button_link']['url'] ); ?>" class="inline-flex items-center px-7 py-[15px] rounded-full bg-[#0F172A] border border-[#0F172A] shadow-[0px_10px_26px_-10px_rgba(15,23,42,0.5)] text-white text-[16px] font-bold hover:bg-[#0F172A]/90 transition" style="box-shadow: 0px 10px 26px -10px rgba(15, 23, 42, 0.5);"><?php echo esc_html( $settings['button_text'] ); ?></a>
				</div>

				<div class="flex justify-center lg:justify-end w-full lg:w-auto shrink-0">
					<img src="<?php echo esc_url( $image_url ); ?>" alt="<?php echo esc_attr( $settings['image_alt'] ); ?>" class="w-full max-w-[571px] h-auto" />
				</div>
			</div>
		</section>
		<?php
	}
}
