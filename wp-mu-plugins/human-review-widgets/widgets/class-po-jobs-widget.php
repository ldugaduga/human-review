<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Repeater;

class Human_Review_Po_Jobs_Widget extends Widget_Base {

	public function get_name() {
		return 'human-review-po-jobs';
	}

	public function get_title() {
		return __( 'HR: Built For Two Jobs', 'human-review' );
	}

	public function get_icon() {
		return 'eicon-image-box';
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
				'default' => 'Built for two jobs',
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
			'image_alt',
			array(
				'label'   => __( 'Image Alt Text', 'human-review' ),
				'type'    => Controls_Manager::TEXT,
				'default' => '',
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
			'checklist',
			array(
				'label'       => __( 'Checklist', 'human-review' ),
				'type'        => Controls_Manager::TEXTAREA,
				'default'     => '',
				'description' => __( 'One item per line.', 'human-review' ),
			)
		);

		$repeater->add_control(
			'button_text',
			array(
				'label'   => __( 'Button Text', 'human-review' ),
				'type'    => Controls_Manager::TEXT,
				'default' => '',
			)
		);

		$repeater->add_control(
			'button_link',
			array(
				'label'   => __( 'Button Link', 'human-review' ),
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
				'description' => __( 'Cards alternate text/image sides on desktop.', 'human-review' ),
				'default'     => array(
					array(
						'image'       => array( 'url' => HUMAN_REVIEW_WIDGETS_URL . '/assets/img/how-it-works/customer-review.png' ),
						'image_alt'   => 'Customer reading reviews on her phone in a cafe',
						'title'       => 'Customer Review',
						'description' => 'Replace generic star ratings with honest, verifiable reviews from real buyers. Collect written and video testimonials that build trust.',
						'checklist'   => "Verified purchasers only\nVideo + written responses\nEmbed anywhere on your site",
						'button_text' => 'Start collecting reviews',
						'button_link' => array( 'url' => '#' ),
					),
					array(
						'image'       => array( 'url' => HUMAN_REVIEW_WIDGETS_URL . '/assets/img/how-it-works/product-research.png' ),
						'image_alt'   => 'Researcher reviewing analytics on a desktop monitor',
						'title'       => 'Product Research & Testing',
						'description' => 'Validate ideas, test prototypes, and understand why people buy — before you ship. Get structured feedback from people who match your audience.',
						'checklist'   => "Audience-matched participants\nUsability + concept testing\nActionable insight summaries",
						'button_text' => 'Run a study',
						'button_link' => array( 'url' => '#' ),
					),
				),
			)
		);

		$this->end_controls_section();
	}

	protected function render() {
		$settings = $this->get_settings_for_display();
		?>
		<section class="relative bg-white isolate">
			<div class="texture-bg absolute inset-x-0 top-20 h-[780px] opacity-30 -z-10" aria-hidden="true"></div>
			<div class="max-w-[1280px] mx-auto px-6 lg:px-0 py-20 lg:py-[100px] flex flex-col gap-10 lg:gap-14">
				<h2 class="font-display font-semibold text-[36px] leading-[42px] sm:text-[44px] sm:leading-[52px] lg:text-[56px] lg:leading-[64px] tracking-[-0.03em] text-[#242424] text-center"><?php echo esc_html( $settings['heading'] ); ?></h2>
				<div class="flex flex-col gap-10">
					<?php
					foreach ( $settings['cards'] as $i => $card ) :
						// Odd cards put the image on the left; on mobile the image is always on top.
						$image_first = 1 === $i % 2;
						$items       = array_filter( array_map( 'trim', preg_split( '/\r\n|\r|\n/', $card['checklist'] ) ) );
						?>
						<div class="flex flex-col lg:flex-row bg-white border border-[rgba(24,29,39,0.12)] rounded-[22px] p-2.5" style="border-radius: 22px;">
							<?php if ( ! empty( $card['image']['url'] ) ) : ?>
								<img src="<?php echo esc_url( $card['image']['url'] ); ?>" alt="<?php echo esc_attr( $card['image_alt'] ); ?>" class="<?php echo $image_first ? '' : 'lg:order-2 '; ?>w-full lg:w-[536px] shrink-0 aspect-[536/420] object-cover rounded-[12px]" style="border-radius: 12px;" />
							<?php endif; ?>
							<div class="<?php echo $image_first ? '' : 'lg:order-1 '; ?>flex-1 flex flex-col justify-center p-5 sm:p-10">
								<h3 class="font-display font-semibold text-[26px] leading-[34px] sm:text-[32px] sm:leading-10 tracking-[-0.736px] text-[#181D27] mb-2.5"><?php echo esc_html( $card['title'] ); ?></h3>
								<p class="text-[#535862] text-[16px] leading-[25px] mb-6"><?php echo esc_html( $card['description'] ); ?></p>
								<?php if ( $items ) : ?>
									<ul class="flex flex-col gap-[15px] mb-6">
										<?php foreach ( $items as $item ) : ?>
											<li class="flex items-center gap-3">
												<span class="w-5 h-5 rounded-full bg-[#22C55E] flex items-center justify-center shrink-0">
													<svg width="11" height="11" viewBox="0 0 16 16" fill="none"><path d="M3 8.5L6.5 12L13 4.5" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/></svg>
												</span>
												<span class="text-[#0F172A] text-[16px] leading-[20px] font-medium"><?php echo esc_html( $item ); ?></span>
											</li>
										<?php endforeach; ?>
									</ul>
								<?php endif; ?>
								<?php if ( $card['button_text'] ) : ?>
									<a href="<?php echo esc_url( $card['button_link']['url'] ); ?>" class="self-start inline-flex items-center gap-[9px] bg-orange hover:bg-orange-600 transition text-white font-bold text-[16px] leading-6 px-7 py-[15px] rounded-full border border-[#FF853D]" style="border-radius: 9999px; box-shadow: 0px 10px 26px -10px rgba(255, 109, 24, 0.5);"><?php echo esc_html( $card['button_text'] ); ?></a>
								<?php endif; ?>
							</div>
						</div>
					<?php endforeach; ?>
				</div>
			</div>
		</section>
		<?php
	}
}
