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

## Fields

- Phone
- Fax
- Mobile
- E-Mail
- URL

```php
<?php
$phone = get_post_meta( $post->ID, 'contact-phone', TRUE );
$fax = get_post_meta( $post->ID, 'contact-fax', TRUE );
$mobile = get_post_meta( $post->ID, 'contact-mobile', TRUE );
$email = get_post_meta( $post->ID, 'contact-email', TRUE );
$url = get_post_meta( $post->ID, 'contact-url', TRUE );
```

## Hooks

### Filter

- `wp-meta-box-contact/identifier` - Change meta box id
- `wp-meta-box-contact/label` - Change meta box label
- `wp-meta-box-contact/phone-{$postType}` - Hide phone field for \$postType
- `wp-meta-box-contact/fax-{$postType}` - Hide fax field for \$postType
- `wp-meta-box-contact/mobile-{$postType}` - Hide mobile field for \$postType
- `wp-meta-box-contact/email-{$postType}` - Hide email field for \$postType
- `wp-meta-box-contact/url-{$postType}` - Hide url field for \$postType

#### Example

```php
<?php
add_filter('wp-meta-box-contact-phone', '__return_false');
```

## Action

- `wp-meta-contact/before` - Add fields before the phone field
- `wp-meta-contact/after` - Add fields after the url field
- `wp-meta-contact/save` - Save custom fields

## ToDo

- Template tags
- REST API Support

## Changelog

### v.2.0.0 - 2020-01-15

- Changed: Namespaced hooks
- Changed: Removed redundant hooks
- Fixed: Broke URL field

### v1.0.0 - 2020-01-14

- Initial release
