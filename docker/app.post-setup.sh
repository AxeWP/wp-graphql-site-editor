#!/bin/bash

# Activate wp-graphql
wp plugin install wp-graphql --allow-root --activate

# Install WPGraphQL Content Blocks and Activate
	if ! $( wp plugin is-installed wp-graphql-content-blocks ); then
		wp plugin install https://github.com/wpengine/wp-graphql-content-blocks/archive/refs/heads/main.zip --allow-root
		cd $WP_CORE_DIR/wp-content/plugins/wp-graphql-content-blocks
		composer install --no-dev --no-interaction --no-progress --optimize-autoloader
		cd $WP_CORE_DIR
	fi
	wp plugin activate wp-graphql-content-blocks --allow-root

wp plugin activate wp-graphql-site-editor --allow-root

# Set pretty permalinks.
wp rewrite structure '/%year%/%monthnum%/%postname%/' --allow-root

wp option update site_editor_registration_skip 1 --allow-root

wp db export "${DATA_DUMP_DIR}/dump.sql" --allow-root

# If maintenance mode is active, de-activate it
if $(wp maintenance-mode is-active --allow-root); then
	echo "Deactivating maintenance mode"
	wp maintenance-mode deactivate --allow-root
fi
