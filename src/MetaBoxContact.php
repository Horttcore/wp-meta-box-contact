<?php
namespace RalfHortt\MetaBoxContact;

use Horttcore\MetaBoxes\MetaBox;
use RalfHortt\TranslatorService\Translator;

class MetaBoxContact extends MetaBox
{
    
    function __construct(array $screen = [], string $context = 'advanced', string $priority = 'default')
    {
        $this->identifier = apply_filters( 'wp-meta-box-contact-meta-box-identifier', 'contact-data');
        $this->name = apply_filters( 'wp-meta-box-contact-meta-box-label', __('Contact', 'wp-meta-box-contact'));
        $this->screen = $screen;
        $this->context = $context;
        $this->priority = $priority;
    }

    public function register(): void
    {
        parent::register();

        (new Translator('wp-meta-box-contact', dirname(plugin_basename(__FILE__)).'/languages/'))->register();
    }

	function render(\WP_Post $post): void 
	{
		$phone = get_post_meta( $post->ID, '_contact-phone', TRUE );
		$fax = get_post_meta( $post->ID, '_contact-fax', TRUE );
		$mobile = get_post_meta( $post->ID, '_contact-mobile', TRUE );
		$email = get_post_meta( $post->ID, '_contact-email', TRUE );
		$url = get_post_meta( $post->ID, '_contact-url', TRUE );
		?>
        <table class="form-table">

            <?php do_action( 'wp-meta-contact-data-before' ) ?>

            <?php if ( apply_filters('wp-meta-box-contact-phone',  true) || apply_filters('wp-meta-box-contact-phone-' . $post->post_type, true ) ) { ?>
                <tr>
                    <th><label for="wp-meta-box-contact-phone"><?php _e( 'Phone', 'wp-meta-box-contact' ) ?></label></th>
                    <td><input type="text" name="wp-meta-box-contact-phone" id="wp-meta-box-contact-phone" value="<?= esc_attr($phone) ?>"></td>
                </tr>
            <?php } ?>

            <?php if ( apply_filters('wp-meta-box-contact-fax',  true) || apply_filters('wp-meta-box-contact-fax-' . $post->post_type, true ) ) { ?>
                <tr>
                    <th><label for="wp-meta-box-contact-fax"><?php _e( 'Fax', 'wp-meta-box-contact' ) ?></label></th>
                    <td><input type="text" name="wp-meta-box-contact-fax" id="wp-meta-box-contact-fax" value="<?= esc_attr($fax) ?>"></td>
                </tr>
            <?php } ?>

            <?php if ( apply_filters('wp-meta-box-contact-mobile',  true) || apply_filters('wp-meta-box-contact-mobile-' . $post->post_type, true ) ) { ?>
                <tr>
                    <th><label for="wp-meta-box-contact-mobile"><?php _e( 'Mobile', 'wp-meta-box-contact' ) ?></label></th>
                    <td><input type="text" name="wp-meta-box-contact-mobile" id="wp-meta-box-contact-mobile" value="<?= esc_attr($mobile) ?>"></td>
                </tr>
            <?php } ?>

            <?php if ( apply_filters('wp-meta-box-contact-email',  true) || apply_filters('wp-meta-box-contact-email-' . $post->post_type, true ) ) { ?>
                <tr>
                    <th><label for="wp-meta-box-contact-email"><?php _e( 'E-Mail', 'wp-meta-box-contact' ) ?></label></th>
                    <td><input type="email" name="wp-meta-box-contact-email" id="wp-meta-box-contact-email" value="<?= esc_attr($email) ?>"></td>
                </tr>
            <?php } ?>

            <?php if ( apply_filters('wp-meta-box-contact-email',  true) || apply_filters('wp-meta-box-contact-email-' . $post->post_type, true ) ) { ?>
                <tr>
                    <th><label for="wp-meta-box-contact-url"><?php _e( 'URL', 'wp-meta-box-contact' ) ?></label></th>
                    <td><input type="url" name="wp-meta-box-contact-url" id="wp-meta-box-contact-url" value="<?= esc_attr($url) ?>"></td>
                </tr>
            <?php } ?>

            <?php do_action( 'wp-meta-contact-data-after' ) ?>

        </table>
		<?php
	}

	function save(int $postId): void
	{
        if ( apply_filters('wp-meta-box-contact-phone',  true) || apply_filters('wp-meta-box-contact-phone-' . $post->post_type, true) ) {
            update_post_meta( $postId, '_contact-phone', sanitize_text_field($_POST['wp-meta-box-contact-phone']) );
        }

        if ( apply_filters('wp-meta-box-contact-fax',  true) || apply_filters('wp-meta-box-contact-fax-' . $post->post_type, true) ) {
            update_post_meta( $postId, '_contact-fax', sanitize_text_field($_POST['wp-meta-box-contact-fax']) );
        }

        if ( apply_filters('wp-meta-box-contact-mobile',  true) || apply_filters('wp-meta-box-contact-mobile-' . $post->post_type, true) ) {
            update_post_meta( $postId, '_contact-mobile', sanitize_text_field($_POST['wp-meta-box-contact-mobile']) );
        }

        if ( apply_filters('wp-meta-box-contact-email',  true) || apply_filters('wp-meta-box-contact-email-' . $post->post_type, true) ) {
            update_post_meta( $postId, '_contact-email', sanitize_email($_POST['wp-meta-box-contact-email']) );
        }

        if ( apply_filters('wp-meta-box-contact-url',  true) || apply_filters('wp-meta-box-contact-email-' . $post->post_type, true) ) {
            update_post_meta( $postId, '_contact-url', esc_url_raw($_POST['wp-meta-box-contact-url']) );
        }

        do_action( 'wp-meta-contact-save', $postId, $post);
	}
}