<?php
/**
 * The Template Part GraphQL DataLoader.
 *
 * @package WPGraphQL\SiteEditor\Data\Loader
 */

namespace WPGraphQL\SiteEditor\Data\Loader;

use Exception;
use WPGraphQL\Data\Loader\AbstractDataLoader;
use WPGraphQL\Model\Model;
use WPGraphQL\SiteEditor\Model\TemplatePart;
use WPGraphQL\SiteEditor\Utils\Utils;

/**
 * Class TemplatePartLoader
 *
 * @package WPGraphQL\Data\Loader
 */
class TemplatePartLoader extends AbstractDataLoader {

	const LOADER_NAME = 'template-part';

	/**
	 * @param mixed $entry The Template part area.
	 * @param mixed $key Unused.
	 *
	 * @return Model|TemplatePart
	 * @throws \Exception .
	 */
	protected function get_model( $entry, $key ) {
		/**
		 * If there's a Post Author connected to the post, we need to resolve the
		 * user as it gets set in the globals via `setup_post_data()` and doing it this way
		 * will batch the loading so when `setup_post_data()` is called the user
		 * is already in the cache.
		 * 
		 * @var \WPGraphQL\AppContext $context
		 */
		$context = $this->context;

		if ( ! empty( $entry->author ) && absint( $entry->author ) ) {
			$user_id = $entry->author;
			$context->get_loader( 'user' )->load_deferred( $user_id );
		}

		return new TemplatePart( $entry );
	}

	/**
	 * Given an array of Template Part slugs, load the associated template parts from the registry.
	 *
	 * @param array $keys .
	 *
	 * @return array
	 */
	public function loadKeys( array $keys ) {
		if ( empty( $keys ) ) {
			return $keys;
		}

		$loaded = [];
		foreach ( $keys as $key ) {
			$template_part = Utils::get_block_template_part( $key );

			$loaded[ $key ] = ! empty( $template_part ) ? $template_part : null;
		}

		return $loaded;
	}
}
