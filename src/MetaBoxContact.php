<?php

namespace RalfHortt\MetaBoxContact;

use Horttcore\MetaBoxes\MetaBox;
use RalfHortt\TranslatorService\Translator;

class MetaBoxContact extends MetaBox
{
    public function __construct(array $screen = [], string $context = 'advanced', string $priority = 'default')
    {
        $this->identifier = \apply_filters('wp-meta-box-contact/identifier', 'contact-data');
        $this->name = \apply_filters('wp-meta-box-contact/label', \__('Contact', 'wp-meta-box-contact'));
        $this->screen = $screen;
        $this->context = $context;
        $this->priority = $priority;
    }

    public function register(): void
    {
        parent::register();

        (new Translator('wp-meta-box-contact', dirname(\plugin_basename(__FILE__)).'/languages/'))->register();
    }

    public function render(\WP_Post $post): void
    {
        $phone = \get_post_meta($post->ID, '_contact-phone', true);
        $fax = \get_post_meta($post->ID, '_contact-fax', true);
        $mobile = \get_post_meta($post->ID, '_contact-mobile', true);
        $email = \get_post_meta($post->ID, '_contact-email', true);
        $url = \get_post_meta($post->ID, '_contact-url', true); ?>
        <table class="form-table">

            <?php \do_action('wp-meta-box-contact/before', $post) ?>

            <?php if (\apply_filters('wp-meta-box-contact/phone-'.$post->post_type, true)) { ?>
                <tr>
                    <th><label for="wp-meta-box-contact-phone"><?php \_e('Phone', 'wp-meta-box-contact') ?></label></th>
                    <td><input class="regular-text" type="text" name="wp-meta-box-contact-phone" id="wp-meta-box-contact-phone" value="<?= \esc_attr($phone) ?>"></td>
                </tr>
            <?php } ?>

            <?php if (\apply_filters('wp-meta-box-contact/fax-'.$post->post_type, true)) { ?>
                <tr>
                    <th><label for="wp-meta-box-contact-fax"><?php \_e('Fax', 'wp-meta-box-contact') ?></label></th>
                    <td><input class="regular-text" type="text" name="wp-meta-box-contact-fax" id="wp-meta-box-contact-fax" value="<?= \esc_attr($fax) ?>"></td>
                </tr>
            <?php } ?>

            <?php if (\apply_filters('wp-meta-box-contact/mobile-'.$post->post_type, true)) { ?>
                <tr>
                    <th><label for="wp-meta-box-contact-mobile"><?php \_e('Mobile', 'wp-meta-box-contact') ?></label></th>
                    <td><input class="regular-text" type="text" name="wp-meta-box-contact-mobile" id="wp-meta-box-contact-mobile" value="<?= \esc_attr($mobile) ?>"></td>
                </tr>
            <?php } ?>

            <?php if (\apply_filters('wp-meta-box-contact/email-'.$post->post_type, true)) { ?>
                <tr>
                    <th><label for="wp-meta-box-contact-email"><?php \_e('E-Mail', 'wp-meta-box-contact') ?></label></th>
                    <td><input class="regular-text" type="email" name="wp-meta-box-contact-email" id="wp-meta-box-contact-email" value="<?= \esc_attr($email) ?>"></td>
                </tr>
            <?php } ?>

            <?php if (\apply_filters('wp-meta-box-contact/url-'.$post->post_type, true)) { ?>
                <tr>
                    <th><label for="wp-meta-box-contact-url"><?php \_e('URL', 'wp-meta-box-contact') ?></label></th>
                    <td><input class="regular-text" type="url" name="wp-meta-box-contact-url" id="wp-meta-box-contact-url" value="<?= \esc_attr($url) ?>"></td>
                </tr>
            <?php } ?>

            <?php \do_action('wp-meta-box-contact/after', $post) ?>

        </table>
		<?php
    }

    public function save(int $postId, \WP_Post $post, bool $update): void
    {
        if (\apply_filters('wp-meta-box-contact-phone-'.$post->post_type, true)) {
            \update_post_meta($postId, '_contact-phone', \sanitize_text_field($_POST['wp-meta-box-contact-phone']));
        }

        if (\apply_filters('wp-meta-box-contact-fax-'.$post->post_type, true)) {
            \update_post_meta($postId, '_contact-fax', \sanitize_text_field($_POST['wp-meta-box-contact-fax']));
        }

        if (\apply_filters('wp-meta-box-contact-mobile-'.$post->post_type, true)) {
            \update_post_meta($postId, '_contact-mobile', \sanitize_text_field($_POST['wp-meta-box-contact-mobile']));
        }

        if (\apply_filters('wp-meta-box-contact-email-'.$post->post_type, true)) {
            \update_post_meta($postId, '_contact-email', \sanitize_email($_POST['wp-meta-box-contact-email']));
        }

        if (\apply_filters('wp-meta-box-contact-url-'.$post->post_type, true)) {
            \update_post_meta($postId, '_contact-url', \esc_url_raw($_POST['wp-meta-box-contact-url']));
        }

        \do_action('wp-meta-box-contact/save', $postId, $post);
    }
}
