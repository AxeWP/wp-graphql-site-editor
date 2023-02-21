<?php
/**
 * Template Part Area Model class
 *
 * @package \WPGraphQL\SiteEditor\Model
 */

namespace WPGraphQL\SiteEditor\Model;

use Exception;
use GraphQLRelay\Relay;
use WP_Block_Template;
use WPGraphQL\Model\Model;
use WPGraphQL\SiteEditor\Data\Loader\TemplateLoader;

/**
 * Class - Template
 * 
 * @property ?string $area
 * @property ?int $authorDatabaseId
 * @property ?string $authorId
 * @property ?string $content
 * @property ?int $databaseId
 * @property ?string $description
 * @property ?bool $hasThemeFile
 * @property ?string $id
 * @property ?string $ID
 * @property ?bool $isCustom
 * @property ?string $origin
 * @property ?array $contentTypes
 * @property ?string $slug
 * @property ?string $title
 * @property ?string $type
 */
class Template extends Model {
	/**
	 * {@inheritDoc}
	 *
	 * @var \WP_Block_Template
	 */
	protected $data;

	/**
	 * Constructor.
	 *
	 * @param \WP_Block_Template $template 
	 *
	 * @throws \Exception .
	 */
	public function __construct( \WP_Block_Template $template ) {
		$this->data = $template;

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
				'area'             => fn() : ?string => ! empty( $this->data->area ) ? $this->data->area : null,
				'authorDatabaseId' => fn() : ?int => ! empty( $this->data->author ) ? $this->data->author : null,
				'authorId'         => fn() : ?string => ! empty( $this->data->author ) ? Relay::toGlobalId( 'user', (string) $this->data->author ) : null,
				'content'          => fn() : ?string => ! empty( $this->data->content ) ? $this->data->content : null,
				'databaseId'       => fn() : ?int => ! empty( $this->data->wp_id ) ? $this->data->wp_id : null,
				'description'      => fn() : ?string => ! empty( $this->data->description ) ? $this->data->description : null,
				'hasThemeFile'     => fn() : bool => ! empty( $this->data->has_theme_file ),
				'id'               => fn() : ?string => ! empty( $this->data->id ) ? Relay::toGlobalId( TemplateLoader::LOADER_NAME, (string) $this->data->id ) : null,
				'ID'               => fn() : ?string => ! empty( $this->data->id ) ? $this->data->id : null,
				'isCustom'         => fn() : bool => ! empty( $this->data->is_custom ),
				'origin'           => fn() : ?string => ! empty( $this->data->origin ) ? $this->data->origin : null,
				'contentTypes'     => fn() : ?array => ! empty( $this->data->post_types ) ? $this->data->post_types : null,
				'slug'             => fn() : ?string => ! empty( $this->data->slug ) ? $this->data->slug : null,
				'status'           => fn() : ?string => ! empty( $this->data->status ) ? $this->data->status : null,
				'theme'            => fn() : ?string => ! empty( $this->data->theme ) ? $this->data->theme : null,
				'title'            => fn() : ?string => ! empty( $this->data->title ) ? $this->data->title : null,
				'type'             => fn() : ?string => ! empty( $this->data->type ) ? $this->data->type : null,
			];
		}
	}

}
