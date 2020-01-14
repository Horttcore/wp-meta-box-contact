# WordPress Meta Box Contact data

## Installation

`composer require ralfhortt/wp-meta-box-contact`

## Usage

```php
/*
new MetaBoxContact(
    array $screen = [],
    string $context = 'advanced',
    string $priority = 'default'
)
*/
```

### Serviceloader

```php
use RalfHortt\MetaBoxContact\MetaBoxContact;

PluginFactory::create()
    ->addService(MetaBoxContact::class, ['page'], 'advanced', 'default')
    ->boot();
```

### Standalone

```php
use RalfHortt\MetaBoxContact\MetaBoxContact;

(new MetaBoxContact(['page'], 'advanced', 'default' ))->register();
```

## Hooks

### Filter

- `wp-meta-box-contact-meta-box-identifier` - Change meta box id
- `wp-meta-box-contact-meta-box-label` - Change meta box label
- `wp-meta-box-contact-phone` - Hide all phone fields
- `wp-meta-box-contact-phone-{$postType}` - Hide phone field for \$postType
- `wp-meta-box-contact-fax` - Hide all fax fields
- `wp-meta-box-contact-fax-{$postType}` - Hide fax field for \$postType
- `wp-meta-box-contact-mobile` - Hide all mobile fields
- `wp-meta-box-contact-mobile-{$postType}` - Hide mobile field for \$postType
- `wp-meta-box-contact-email` - Hide all email fields
- `wp-meta-box-contact-email-{$postType}` - Hide email field for \$postType
- `wp-meta-box-contact-url` - Hide all url fields
- `wp-meta-box-contact-url-{$postType}` - Hide url field for \$postType

#### Example

```php
<?php
add_filter('wp-meta-box-contact-phone', '__return_false');
```

## Action

- `wp-meta-contact-data-before` - Add fields before the phone field
- `wp-meta-contact-data-after` - Add fields after the url field
- `wp-meta-contact-save` - Save custom fields

## Changelog

### v1.0.0 - 2020-01-14

- Initial release
