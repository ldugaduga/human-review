<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Repeater;

class Human_Review_Po_Why_Widget extends Widget_Base {

	public function get_name() {
		return 'human-review-po-why';
	}

	public function get_title() {
		return __( 'HR: Why The Human Review', 'human-review' );
	}

	public function get_icon() {
		return 'eicon-info-box';
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
				'default' => 'Why The Human Review',
			)
		);

		$this->add_control(
			'subcopy',
			array(
				'label'   => __( 'Subcopy', 'human-review' ),
				'type'    => Controls_Manager::TEXTAREA,
				'default' => 'The values that guide our network every day.',
			)
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_values',
			array( 'label' => __( 'Values', 'human-review' ) )
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
				'default' => __( 'Value title', 'human-review' ),
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

		$icon_url = HUMAN_REVIEW_WIDGETS_URL . '/assets/img/product-overview/icon-0';

		$this->add_control(
			'values',
			array(
				'label'       => __( 'Values', 'human-review' ),
				'type'        => Controls_Manager::REPEATER,
				'fields'      => $repeater->get_controls(),
				'title_field' => '{{{ title }}}',
				'description' => __( 'Laid out 4 across on desktop, 2 on tablet, 1 on mobile.', 'human-review' ),
				'default'     => array(
					array(
						'icon'        => array( 'url' => $icon_url . '1.svg' ),
						'title'       => 'Verified real people',
						'description' => 'Every participant is identity-checked before they join.',
					),
					array(
						'icon'        => array( 'url' => $icon_url . '2.svg' ),
						'title'       => 'Honest feedback',
						'description' => 'No incentives to inflate — just genuine opinions.',
					),
					array(
						'icon'        => array( 'url' => $icon_url . '3.svg' ),
						'title'       => 'Fast turnaround',
						'description' => 'Get responses within days, not weeks.',
					),
					array(
						'icon'        => array( 'url' => $icon_url . '4.svg' ),
						'title'       => 'No AI / fake reviews',
						'description' => 'Authentic human voices you can stand behind.',
					),
				),
			)
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_logos',
			array( 'label' => __( 'Trusted By', 'human-review' ) )
		);

		$this->add_control(
			'logos_label',
			array(
				'label'   => __( 'Label', 'human-review' ),
				'type'    => Controls_Manager::TEXT,
				'default' => 'Trusted by the world’s best research teams',
			)
		);

		$logos_repeater = new Repeater();
		$logos_repeater->add_control(
			'logo',
			array(
				'label' => __( 'Logo', 'human-review' ),
				'type'  => Controls_Manager::MEDIA,
			)
		);
		$logos_repeater->add_control(
			'name',
			array(
				'label'   => __( 'Company Name (alt text)', 'human-review' ),
				'type'    => Controls_Manager::TEXT,
				'default' => '',
			)
		);

		$logo_defaults = array();
		foreach ( array( 'IBM', 'Microsoft', 'GitLab', 'Notion', 'Figma', 'Loom' ) as $brand ) {
			$logo_defaults[] = array(
				'logo' => array( 'url' => HUMAN_REVIEW_WIDGETS_URL . '/assets/img/contact/' . strtolower( $brand ) . '.png' ),
				'name' => $brand,
			);
		}

		$this->add_control(
			'logos',
			array(
				'label'       => __( 'Logos', 'human-review' ),
				'type'        => Controls_Manager::REPEATER,
				'fields'      => $logos_repeater->get_controls(),
				'title_field' => '{{{ name }}}',
				'description' => __( 'Leave empty to hide the logo strip.', 'human-review' ),
				'default'     => $logo_defaults,
			)
		);

		$this->end_controls_section();
	}

	protected function render() {
		$settings = $this->get_settings_for_display();
		$logos    = array_filter(
			$settings['logos'],
			function ( $item ) {
				return ! empty( $item['logo']['url'] );
			}
		);
		// Repeat the logos inside each marquee half until it is wider than any
		// desktop viewport, otherwise a gap shows before the loop restarts.
		$repeats = $logos ? max( 1, (int) ceil( 24 / count( $logos ) ) ) : 0;
		?>
		<section class="bg-[#F9FAFB]">
			<div class="max-w-[1280px] mx-auto px-6 lg:px-0 pt-20 lg:pt-[100px] flex flex-col items-center gap-12">
				<div class="flex flex-col items-center gap-5 text-center max-w-[678px]">
					<h2 class="font-display font-semibold text-[36px] leading-[42px] sm:text-[44px] sm:leading-[52px] lg:text-[56px] lg:leading-[64px] text-[#0F172A]"><?php echo esc_html( $settings['heading'] ); ?></h2>
					<p class="text-[#0F172A] text-[18px] leading-[28px]"><?php echo esc_html( $settings['subcopy'] ); ?></p>
				</div>
				<div class="w-full grid sm:grid-cols-2 lg:grid-cols-4 border border-[#F3F4F6] rounded-2xl overflow-hidden" style="border-radius: 16px; box-shadow: 0px 1px 2px rgba(0, 0, 0, 0.05);">
					<?php foreach ( $settings['values'] as $value ) : ?>
						<div class="flex flex-col gap-9 bg-[#F9FAFB] px-8 py-9 border-[#F3F4F6] border-b sm:[&:nth-child(odd)]:border-r lg:border-b-0 lg:border-r lg:last:border-r-0">
							<?php if ( ! empty( $value['icon']['url'] ) ) : ?>
								<img src="<?php echo esc_url( $value['icon']['url'] ); ?>" alt="" class="w-16 h-16" />
							<?php endif; ?>
							<div class="flex flex-col gap-4">
								<h3 class="font-display font-semibold text-[24px] leading-8 text-[#0F172A]"><?php echo esc_html( $value['title'] ); ?></h3>
								<p class="text-[#6B7280] text-[18px] leading-[28px]"><?php echo esc_html( $value['description'] ); ?></p>
							</div>
						</div>
					<?php endforeach; ?>
				</div>
			</div>

			<?php if ( $logos ) : ?>
				<div class="pt-20 pb-24 flex flex-col items-center gap-7">
					<p class="px-6 text-center font-mono text-[12px] leading-5 tracking-[1.4px] uppercase text-[#8A8AA8]"><?php echo esc_html( $settings['logos_label'] ); ?></p>
					<div class="w-full py-[22px] border-y border-[rgba(24,29,39,0.12)] overflow-hidden">
						<!-- two identical halves so the -50% marquee loop is seamless; pr-16 keeps spacing even across the seam -->
						<div class="hr-marquee-track flex w-max" style="animation-duration: 60s;">
							<?php for ( $copy = 0; $copy < 2; $copy++ ) : ?>
								<div class="flex items-center gap-16 pr-16 shrink-0"<?php echo $copy ? ' aria-hidden="true"' : ''; ?>>
									<?php for ( $r = 0; $r < $repeats; $r++ ) : ?>
										<?php foreach ( $logos as $item ) : ?>
											<img src="<?php echo esc_url( $item['logo']['url'] ); ?>" alt="<?php echo ( $copy || $r ) ? '' : esc_attr( $item['name'] ); ?>" class="max-h-7 w-auto shrink-0 opacity-50 grayscale" />
										<?php endforeach; ?>
									<?php endfor; ?>
								</div>
							<?php endfor; ?>
						</div>
					</div>
				</div>
			<?php endif; ?>
		</section>
		<?php
	}
}
