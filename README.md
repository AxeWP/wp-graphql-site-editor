# EXPERIMENTAL - WPGraphQL for Full Site Editor

🚨 NOTE: This is experimental software and should not be used in production if you don't know what you're doing. 🚨

Proof of Concept - adds support for block templates and global styles to the WPGraphQL schema. Uses [WPGraphQL Content Blocks](https://github.com/wpengine/wp-graphql-content-blocks).

* [Join the WPGraphQL community on Slack.](https://join.slack.com/t/wp-graphql/shared_invite/zt-3vloo60z-PpJV2PFIwEathWDOxCTTLA)
* [Documentation](#usage)

-----

![Packagist License](https://img.shields.io/packagist/l/axepress/wp-graphql-site-editor?color=green) ![Packagist Version](https://img.shields.io/packagist/v/axepress/wp-graphql-site-editor?label=stable) ![GitHub commits since latest release (by SemVer)](https://img.shields.io/github/commits-since/AxeWP/wp-graphql-site-editor/0.0.1) ![GitHub forks](https://img.shields.io/github/forks/AxeWP/wp-graphql-site-editor?style=social) ![GitHub Repo stars](https://img.shields.io/github/stars/AxeWP/wp-graphql-site-editor?style=social)<br />
![CodeQuality](https://img.shields.io/github/actions/workflow/status/axewp/wp-graphql-site-editor/code-quality.yml?branch=develop&label=Code%20Quality)
![Integration Tests](https://img.shields.io/github/actions/workflow/status/axewp/wp-graphql-site-editor/integration-testing.yml?branch=develop&label=Integration%20Testing)
![Coding Standards](https://img.shields.io/github/actions/workflow/status/axewp/wp-graphql-site-editor/code-standard.yml?branch=develop&label=WordPress%20Coding%20Standards)
[![Coverage Status](https://coveralls.io/repos/github/AxeWP/wp-graphql-site-editor/badge.svg?branch=develop)](https://coveralls.io/github/AxeWP/wp-graphql-site-editor?branch=develop)
-----

## System Requirements

* PHP 7.4+ || 8.0+ || 8.1+
* WordPress 5.7.0+
* WPGraphQL 1.13.0+ (probably earlier too)
* WPGraphQL Content Blocks 0.2.0
* FaustWP Plugin 0.8.6+

## Quick Install

1. Install & activate [WPGraphQL](https://www.wpgraphql.com/).
2. Install & activate [WPGraphQL Content Blocks](https://github.com/wpengine/wp-graphql-content-blocks).
3. Download the [latest release](https://github.com/AxeWP/wp-graphql-site-editor/releases) `.zip` file, upload it to your WordPress install, and activate the plugin.

### With Composer
@todo Add to packagist.

```console
composer require axepress/wp-graphql-site-editor
```

## Usage
@todo

## Testing

1. Update your `.env` file to your testing environment specifications.
2. Run `composer install-test-env` to create the test environment.
3. Run your test suite with [Codeception](https://codeception.com/docs/02-GettingStarted#Running-Tests).
E.g. `vendor/bin/codecept run wpunit` will run all WPUnit tests.

## Credits

<a href="https://github.com/AxeWP/wp-graphql-plugin-boilerplate">![Built with WPGraphQL Plugin Boilerplate](./assets/built-with.png)</a>
