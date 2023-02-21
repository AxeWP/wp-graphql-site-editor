<?php
/**
 * The Template Part Area GraphQL DataLoader.
 *
 * @package WPGraphQL\SiteEditor\Data\Loader
 */

namespace WPGraphQL\SiteEditor\Data\Loader;

use Exception;
use WPGraphQL\Data\Loader\AbstractDataLoader;
use WPGraphQL\Model\Model;
use WPGraphQL\SiteEditor\Model\TemplatePartArea;

/**
 * Class TemplatePartAreaLoader
 *
 * @package WPGraphQL\Data\Loader
 */
class TemplatePartAreaLoader extends AbstractDataLoader {

	const LOADER_NAME = 'template-part-area';

	/**
	 * @param mixed $entry The Template aart area.
	 * @param mixed $key Unused.
	 *
	 * @return Model|TemplatePartArea
	 * @throws \Exception .
	 */
	protected function get_model( $entry, $key ) {
		return new TemplatePartArea( $entry );
	}

	/**
	 * Given an array of template part area keys, load the associated template part areas from the plugin registry.
	 *
	 * @param array $keys .
	 *
	 * @return array
	 */
	public function loadKeys( array $keys ) {
		$areas = get_allowed_block_template_part_areas();

		$loaded = [];
		if ( ! empty( $areas ) && is_array( $areas ) ) {
			foreach ( $keys as $key ) {
				// get the index for $areas['area'] that matches the key.
				$index = array_search( $key, array_column( $areas, 'area' ) );

				$loaded[ $key ] = false !== $index && ! empty( $areas[ $index ] ) ? $areas[ $index ] : null;
			}
		}

		return $loaded;
	}
}
