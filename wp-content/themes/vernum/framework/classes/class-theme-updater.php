<?php

/**
 * SpyroPress API
 * Main file for all the api calls.
 *
 * @author 		SpyroSol
 * @category 	Core
 * @package 	Spyropress
 * @todo Requires a complete redo.
 */

class SpyropressThemeUpdater {

    function __construct() {

        add_action( 'admin_head', array( $this, 'update_theme' ) );
    }

    function update_theme() {

        if ( isset( $_REQUEST['page'] ) ) {
            // Sanitize page being requested.
            $_page = esc_attr( $_REQUEST['page'] );

            if ( 'spyropress-update' == $_page ) {
                //Setup Filesystem
                $method = get_filesystem_method();

                if ( isset( $_POST['spyropress_ftp_cred'] ) ) {
                    $cred = spyropress_decode( $_POST['spyropress_ftp_cred'] );
                    $filesystem = WP_Filesystem( $cred );
                }
                else {
                    $filesystem = WP_Filesystem();
                }

                if ( false == $filesystem && 'Proceed' != $_POST['upgrade'] ) {
                    add_error_message( sprintf( __( 'Failed: Filesystem preventing downloads. (%s)', 'spyropress' ), $method ) );
                    return;
                }

                if ( isset( $_REQUEST['spyropress_updater'] ) ) {

                    // Sanitize action being requested.
                    $_action = esc_attr( $_REQUEST['spyropress_updater'] );

                    if ( 'framework' == $_action ) {

                        // Download framework
                        global $spyropress;
                        $envato_code = get_option( '_spyropress_envato_verification' );
                        $envato_username = get_option( '_spyropress_envato_username' );
                        $download_link = $spyropress->api->generate_download_link( $envato_code, $envato_username, 'spyropress_theme_update' );
                        $temp_file_addr = $this->download_url( $download_link );

                        if ( is_wp_error( $temp_file_addr ) ) {
                            $error = esc_html( $temp_file_addr->get_error_code() );

                            //The source file was not found or is invalid
                            if ( 'http_no_url' == $error )
                                add_error_message( __( 'Failed: Invalid URL Provided', 'spyropress' ) );
                            else
                                add_error_message( sprintf( __( 'Failed: %s', 'spyropress' ), esc_html( $temp_file_addr->get_error_message() ) ) );

                            return;
                        }

                        // Unzip it
                        global $wp_filesystem;
                        $to = $wp_filesystem->wp_content_dir() . '/themes/' . get_option( 'template' );

                        $dounzip = unzip_file( $temp_file_addr, $to );
                        unlink( $temp_file_addr ); // Delete Temp File

                        if ( is_wp_error( $dounzip ) ) {
                            $error = esc_html( $dounzip->get_error_code() );
                            $data = $dounzip->get_error_data( $error );

                            switch ( $error ) {
                                case 'incompatible_archive':
                                    add_error_message( __( 'Failed: Incompatible archive', 'spyropress' ) );
                                    break;
                                case 'empty_archive':
                                    add_error_message( __( 'Failed: Empty Archive', 'spyropress' ) );
                                    break;
                                case 'mkdir_failed':
                                    add_error_message( __( 'Failed: mkdir Failure', 'spyropress' ) );
                                    break;
                                case 'copy_failed':
                                    add_error_message( __( 'Failed: Copy Failed', 'spyropress' ) );
                                    break;
                            }

                            return;
                        }

                        // Successfully Updated
                        $message = __( 'New framework successfully downloaded, extracted and updated.', 'spyropress' );
                        $message .= '<script type="text/javascript">
                            //<![CDATA[
                                window.location.replace("' . admin_url( 'admin.php?page=spyropress-update' ) .
                            '");
                            //]]>
                        </script>';
                        add_success_message( $message );
                    }
                }

            } // END UPDATE HERE
        }
    }
}

?>