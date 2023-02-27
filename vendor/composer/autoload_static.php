<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInit2295e5a77a3e5bf1a19224863508fc5e
{
    public static $files = array (
        'a935e04f223db22af08abbb3d56c8fbb' => __DIR__ . '/../..' . '/access-functions.php',
    );

    public static $prefixLengthsPsr4 = array (
        'W' => 
        array (
            'WPGraphQL\\SiteEditor\\' => 21,
        ),
        'A' => 
        array (
            'AxeWP\\GraphQL\\' => 14,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'WPGraphQL\\SiteEditor\\' => 
        array (
            0 => __DIR__ . '/../..' . '/src',
        ),
        'AxeWP\\GraphQL\\' => 
        array (
            0 => __DIR__ . '/..' . '/axepress/wp-graphql-plugin-boilerplate/src',
        ),
    );

    public static $classMap = array (
        'Composer\\InstalledVersions' => __DIR__ . '/..' . '/composer/InstalledVersions.php',
        'WPGraphQL\\SiteEditor\\Connection\\TemplateConnection' => __DIR__ . '/../..' . '/src/Connection/TemplateConnection.php',
        'WPGraphQL\\SiteEditor\\Connection\\TemplatePartAreaConnection' => __DIR__ . '/../..' . '/src/Connection/TemplatePartAreaConnection.php',
        'WPGraphQL\\SiteEditor\\Connection\\TemplatePartConnection' => __DIR__ . '/../..' . '/src/Connection/TemplatePartConnection.php',
        'WPGraphQL\\SiteEditor\\CoreSchemaFilters' => __DIR__ . '/../..' . '/src/CoreSchemaFilters.php',
        'WPGraphQL\\SiteEditor\\Data\\Connection\\TemplateConnectionResolver' => __DIR__ . '/../..' . '/src/Data/Connection/TemplateConnectionResolver.php',
        'WPGraphQL\\SiteEditor\\Data\\Connection\\TemplatePartAreaConnectionResolver' => __DIR__ . '/../..' . '/src/Data/Connection/TemplatePartAreaConnectionResolver.php',
        'WPGraphQL\\SiteEditor\\Data\\Connection\\TemplatePartConnectionResolver' => __DIR__ . '/../..' . '/src/Data/Connection/TemplatePartConnectionResolver.php',
        'WPGraphQL\\SiteEditor\\Data\\Loader\\TemplateLoader' => __DIR__ . '/../..' . '/src/Data/Loader/TemplateLoader.php',
        'WPGraphQL\\SiteEditor\\Data\\Loader\\TemplatePartAreaLoader' => __DIR__ . '/../..' . '/src/Data/Loader/TemplatePartAreaLoader.php',
        'WPGraphQL\\SiteEditor\\Data\\Loader\\TemplatePartLoader' => __DIR__ . '/../..' . '/src/Data/Loader/TemplatePartLoader.php',
        'WPGraphQL\\SiteEditor\\Fields\\RootQuery' => __DIR__ . '/../..' . '/src/Fields/RootQuery.php',
        'WPGraphQL\\SiteEditor\\Main' => __DIR__ . '/../..' . '/src/Main.php',
        'WPGraphQL\\SiteEditor\\Model\\Template' => __DIR__ . '/../..' . '/src/Model/Template.php',
        'WPGraphQL\\SiteEditor\\Model\\TemplatePart' => __DIR__ . '/../..' . '/src/Model/TemplatePart.php',
        'WPGraphQL\\SiteEditor\\Model\\TemplatePartArea' => __DIR__ . '/../..' . '/src/Model/TemplatePartArea.php',
        'WPGraphQL\\SiteEditor\\TypeRegistry' => __DIR__ . '/../..' . '/src/TypeRegistry.php',
        'WPGraphQL\\SiteEditor\\Type\\Enum\\TemplatePartAreaEnum' => __DIR__ . '/../..' . '/src/Type/Enum/TemplatePartAreaEnum.php',
        'WPGraphQL\\SiteEditor\\Type\\Enum\\TemplatePartIdTypeEnum' => __DIR__ . '/../..' . '/src/Type/Enum/TemplatePartIdTypeEnum.php',
        'WPGraphQL\\SiteEditor\\Type\\WPObject\\Template' => __DIR__ . '/../..' . '/src/Type/WPObject/Template.php',
        'WPGraphQL\\SiteEditor\\Type\\WPObject\\TemplatePart' => __DIR__ . '/../..' . '/src/Type/WPObject/TemplatePart.php',
        'WPGraphQL\\SiteEditor\\Type\\WPObject\\TemplatePartArea' => __DIR__ . '/../..' . '/src/Type/WPObject/TemplatePartArea.php',
        'WPGraphQL\\SiteEditor\\Utils\\Utils' => __DIR__ . '/../..' . '/src/Utils/Utils.php',
        'WPGraphQL\\SiteEditor\\Vendor\\AxeWP\\GraphQL\\Abstracts\\ConnectionType' => __DIR__ . '/../..' . '/vendor-prefixed/axepress/wp-graphql-plugin-boilerplate/src/Abstracts/ConnectionType.php',
        'WPGraphQL\\SiteEditor\\Vendor\\AxeWP\\GraphQL\\Abstracts\\EnumType' => __DIR__ . '/../..' . '/vendor-prefixed/axepress/wp-graphql-plugin-boilerplate/src/Abstracts/EnumType.php',
        'WPGraphQL\\SiteEditor\\Vendor\\AxeWP\\GraphQL\\Abstracts\\FieldsType' => __DIR__ . '/../..' . '/vendor-prefixed/axepress/wp-graphql-plugin-boilerplate/src/Abstracts/FieldsType.php',
        'WPGraphQL\\SiteEditor\\Vendor\\AxeWP\\GraphQL\\Abstracts\\InputType' => __DIR__ . '/../..' . '/vendor-prefixed/axepress/wp-graphql-plugin-boilerplate/src/Abstracts/InputType.php',
        'WPGraphQL\\SiteEditor\\Vendor\\AxeWP\\GraphQL\\Abstracts\\InterfaceType' => __DIR__ . '/../..' . '/vendor-prefixed/axepress/wp-graphql-plugin-boilerplate/src/Abstracts/InterfaceType.php',
        'WPGraphQL\\SiteEditor\\Vendor\\AxeWP\\GraphQL\\Abstracts\\MutationType' => __DIR__ . '/../..' . '/vendor-prefixed/axepress/wp-graphql-plugin-boilerplate/src/Abstracts/MutationType.php',
        'WPGraphQL\\SiteEditor\\Vendor\\AxeWP\\GraphQL\\Abstracts\\ObjectType' => __DIR__ . '/../..' . '/vendor-prefixed/axepress/wp-graphql-plugin-boilerplate/src/Abstracts/ObjectType.php',
        'WPGraphQL\\SiteEditor\\Vendor\\AxeWP\\GraphQL\\Abstracts\\Type' => __DIR__ . '/../..' . '/vendor-prefixed/axepress/wp-graphql-plugin-boilerplate/src/Abstracts/Type.php',
        'WPGraphQL\\SiteEditor\\Vendor\\AxeWP\\GraphQL\\Abstracts\\UnionType' => __DIR__ . '/../..' . '/vendor-prefixed/axepress/wp-graphql-plugin-boilerplate/src/Abstracts/UnionType.php',
        'WPGraphQL\\SiteEditor\\Vendor\\AxeWP\\GraphQL\\Helper\\Helper' => __DIR__ . '/../..' . '/vendor-prefixed/axepress/wp-graphql-plugin-boilerplate/src/Helper/Helper.php',
        'WPGraphQL\\SiteEditor\\Vendor\\AxeWP\\GraphQL\\Interfaces\\GraphQLType' => __DIR__ . '/../..' . '/vendor-prefixed/axepress/wp-graphql-plugin-boilerplate/src/Interfaces/GraphQLType.php',
        'WPGraphQL\\SiteEditor\\Vendor\\AxeWP\\GraphQL\\Interfaces\\Registrable' => __DIR__ . '/../..' . '/vendor-prefixed/axepress/wp-graphql-plugin-boilerplate/src/Interfaces/Registrable.php',
        'WPGraphQL\\SiteEditor\\Vendor\\AxeWP\\GraphQL\\Interfaces\\TypeWithConnections' => __DIR__ . '/../..' . '/vendor-prefixed/axepress/wp-graphql-plugin-boilerplate/src/Interfaces/TypeWithConnections.php',
        'WPGraphQL\\SiteEditor\\Vendor\\AxeWP\\GraphQL\\Interfaces\\TypeWithFields' => __DIR__ . '/../..' . '/vendor-prefixed/axepress/wp-graphql-plugin-boilerplate/src/Interfaces/TypeWithFields.php',
        'WPGraphQL\\SiteEditor\\Vendor\\AxeWP\\GraphQL\\Interfaces\\TypeWithInputFields' => __DIR__ . '/../..' . '/vendor-prefixed/axepress/wp-graphql-plugin-boilerplate/src/Interfaces/TypeWithInputFields.php',
        'WPGraphQL\\SiteEditor\\Vendor\\AxeWP\\GraphQL\\Interfaces\\TypeWithInterfaces' => __DIR__ . '/../..' . '/vendor-prefixed/axepress/wp-graphql-plugin-boilerplate/src/Interfaces/TypeWithInterfaces.php',
        'WPGraphQL\\SiteEditor\\Vendor\\AxeWP\\GraphQL\\Traits\\TypeNameTrait' => __DIR__ . '/../..' . '/vendor-prefixed/axepress/wp-graphql-plugin-boilerplate/src/Traits/TypeNameTrait.php',
        'WPGraphQL\\SiteEditor\\Vendor\\AxeWP\\GraphQL\\Traits\\TypeResolverTrait' => __DIR__ . '/../..' . '/vendor-prefixed/axepress/wp-graphql-plugin-boilerplate/src/Traits/TypeResolverTrait.php',
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInit2295e5a77a3e5bf1a19224863508fc5e::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInit2295e5a77a3e5bf1a19224863508fc5e::$prefixDirsPsr4;
            $loader->classMap = ComposerStaticInit2295e5a77a3e5bf1a19224863508fc5e::$classMap;

        }, null, ClassLoader::class);
    }
}
