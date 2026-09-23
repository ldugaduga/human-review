<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Repeater;

class Human_Review_Help_Cards_Widget extends Widget_Base {

	public function get_name() {
		return 'human-review-help-cards';
	}

	public function get_title() {
		return __( 'HR: How We Can Help', 'human-review' );
	}

	public function get_icon() {
		return 'eicon-posts-grid';
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
				'default' => 'How we can help',
			)
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_cards',
			array( 'label' => __( 'Cards', 'human-review' ) )
		);

		$repeater = new Repeater();

		$repeater->add_control(
			'image',
			array(
				'label' => __( 'Image', 'human-review' ),
				'type'  => Controls_Manager::MEDIA,
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

		$repeater->add_control(
			'link_text',
			array(
				'label'   => __( 'Link Text', 'human-review' ),
				'type'    => Controls_Manager::TEXT,
				'default' => 'Learn more about reviews',
			)
		);

		$repeater->add_control(
			'link_url',
			array(
				'label'   => __( 'Link URL', 'human-review' ),
				'type'    => Controls_Manager::URL,
				'default' => array( 'url' => '#' ),
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
						'image'       => array( 'url' => HUMAN_REVIEW_WIDGETS_URL . '/assets/img/how-it-works/customer-review.png' ),
						'title'       => 'Customer Review',
						'description' => 'Authentic, verified reviews from real customers to build immediate trust and boost your conversion rates.',
						'link_text'   => 'Learn more about reviews',
						'link_url'    => array( 'url' => '#' ),
					),
					array(
						'image'       => array( 'url' => HUMAN_REVIEW_WIDGETS_URL . '/assets/img/how-it-works/product-research.png' ),
						'title'       => 'Product Research & Testing',
						'description' => 'Deep qualitative testing and research with people who match your ideal customer profile perfectly.',
						'link_text'   => 'Learn more about reviews',
						'link_url'    => array( 'url' => '#' ),
					),
				),
			)
		);

		$this->end_controls_section();
	}

	protected function render() {
		$settings = $this->get_settings_for_display();
		?>
		<section class="bg-white texture-bg">
			<div class="max-w-[1280px] mx-auto px-6 lg:px-10 py-20 lg:py-24">
				<h2 class="font-display font-semibold text-[32px] leading-[38px] sm:text-[40px] sm:leading-[46px] lg:text-[56px] lg:leading-[64px] text-[#0F172A] text-center mb-12"><?php echo esc_html( $settings['heading'] ); ?></h2>

				<div class="grid sm:grid-cols-2 gap-6">
					<?php foreach ( $settings['cards'] as $card ) : ?>
						<div class="flex flex-col items-center bg-white border border-[rgba(24,29,39,0.12)] rounded-[22px] p-3 pb-[10px]">
							<?php if ( ! empty( $card['image']['url'] ) ) : ?>
								<img src="<?php echo esc_url( $card['image']['url'] ); ?>" alt="<?php echo esc_attr( $card['title'] ); ?>" class="w-full aspect-[16/10] object-cover rounded-[12px]" style="border-radius: 12px;" />
							<?php endif; ?>
							<div class="w-full flex flex-col items-start px-[13px] pt-[26px] pb-[22px]">
								<h3 class="font-display font-semibold text-[24px] sm:text-[28px] leading-[36px] tracking-[-0.736px] text-[#181D27] mb-2.5"><?php echo esc_html( $card['title'] ); ?></h3>
								<p class="text-[#535862] text-[16px] leading-[25px] mb-5"><?php echo esc_html( $card['description'] ); ?></p>
								<a href="<?php echo esc_url( $card['link_url']['url'] ); ?>" class="inline-flex items-center gap-1.5 text-orange text-[16px] font-semibold hover:text-orange-600 transition">
									<?php echo esc_html( $card['link_text'] ); ?>
									<svg width="13" height="13" viewBox="0 0 16 16" fill="none"><path d="M3.5 8H12.5M12.5 8L8.5 4M12.5 8L8.5 12" stroke="currentColor" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round"/></svg>
								</a>
							</div>
						</div>
					<?php endforeach; ?>
				</div>
			</div>
		</section>
		<?php
	}
}
