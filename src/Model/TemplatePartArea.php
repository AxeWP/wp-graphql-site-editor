<?php
/**
 * Template Part Area Model class
 *
 * @package \WPGraphQL\SiteEditor\Model
 */

namespace WPGraphQL\SiteEditor\Model;

use GraphQLRelay\Relay;
use WPGraphQL\Model\Model;
use WPGraphQL\SiteEditor\Data\Loader\TemplatePartAreaLoader;
use WPGraphQL\SiteEditor\Utils\Utils;
use WP_Block_Template;

/**
 * Class - TemplatePartArea
 */
class TemplatePartArea extends Model {
	/**
	 * {@inheritDoc}
	 *
	 * @var array<string, mixed>
	 */
	protected $data;

	/**
	 * Constructor.
	 *
	 * @param array<string, mixed> $area .
	 *
	 * @throws \Exception .
	 */
	public function __construct( array $area ) {
		$this->data = $area;

		parent::__construct();
	}

	/**
	 * Initializes the object
	 *
	 * @return void
	 */
	protected function init() {
		if ( empty( $this->fields ) ) {
			$this->fields = [
				'area'               => fn (): ?string => $this->data['area'] ?? null,
				'areaTag'            => fn (): ?string => $this->data['area_tag'] ?? null,
				'id'                 => fn (): ?string => ! empty( $this->data['area'] ) ? Relay::toGlobalId( TemplatePartAreaLoader::LOADER_NAME, $this->data['area'] ) : null,
				'description'        => fn (): ?string => $this->data['description'] ?? null,
				'icon'               => fn (): ?string => $this->data['icon'] ?? null,
				'label'              => fn (): ?string => $this->data['label'] ?? null,
				'activeTemplatePart' => fn (): ?WP_Block_Template => ! empty( $this->data['area'] ) ? Utils::get_block_template_part( $this->data['area'] ) : null,
			];
		}
	}
}
