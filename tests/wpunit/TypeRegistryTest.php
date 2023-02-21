<?php

use WPGraphQL\SiteEditor\TypeRegistry;

/**
 * Tests TypeRegistry.
 */
class TypeRegistryTest extends \Codeception\TestCase\WPTestCase {

	/**
	 * {@inheritDoc}
	 */
	public function setUp(): void {
		parent::setUp();
	}

	/**
	 * {@inheritDoc}
	 */
	public function tearDown(): void {
		parent::tearDown();
	}

	/**
	 * Tests TypeRegistry::truncate()
	 *
	 * @uses WPGraphQL\SiteEditor\TypeRegistry::init()
	 */
	public function test_get_registered_types() {
		$registry = TypeRegistry::get_registered_types();

		$this->assertNotEmpty( $registry );
	}

}
