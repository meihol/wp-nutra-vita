<?php
namespace iFolders\Blocks;

defined( 'ABSPATH' ) || exit;

use iFolders\Models\FoldersModel;

class GalleryBlock {
    public function __construct() {
        add_action( 'init', [ $this, 'init' ] );
    }

    public function init() {
        register_block_type( IFOLDERS_PLUGIN_PATH . '/assets/blocks/galleryblock/block.json', [ 'render_callback' => [ $this, 'renderBlock' ] ] );

        $globals = [
            'data' => [
                'imageSizes' => [
                    'thumbnail' => esc_html__( 'Thumbnail', 'ifolders' ),
                    'medium' => esc_html__( 'Medium', 'ifolders' ),
                    'large' => esc_html__( 'Large', 'ifolders' ),
                    'full' => esc_html__( 'Full size', 'ifolders' )
                ],
            ],
            'api' => [
                'nonce' => wp_create_nonce( 'wp_rest' ),
                'url' => esc_url_raw( rest_url( IFOLDERS_PLUGIN_REST_URL ) )
            ]
        ];

        wp_localize_script( 'ifolders-image-gallery-editor-script', 'iFoldersGalleryBlock', $globals);
    }

    public function renderBlock( $attributes = [] ) {
        $folder = null;
        $columns = 4;
        $max = 8;
        $imageSize = 'thumbnail';
        $className = null;

        if ( !is_array( $attributes ) ) {
            $attributes = [];
        }

        foreach ( $attributes as $key => $value ) {
            if ( !$key || $value === '') {
                continue;
            }

            $key = strtolower( $key );

            switch ( $key ) {
                case 'folder': {
                    $folder = intval( $value );
                } break;
                case 'columns': {
                    $columns = intval( $value );
                } break;
                case 'max': {
                    $max = intval( $value );
                } break;
                case 'imagesize': {
                    $imageSize = $value;
                } break;
                case 'classname': {
                    $className = sanitize_html_class( $value );
                } break;
            }
        }

        if ( empty( $folder ) ) {
            return '<div class="components-notice is-warning"><div class="components-notice__content"><p>' . esc_html__( 'No folder selected.', 'ifolders' ) . '</p></div></div>';
        }

        $attachment_ids = FoldersModel::getAttachments( $folder, $max );

        if ( !count( $attachment_ids ) ) {
            return '<div class="components-notice is-warning"><div class="components-notice__content"><p>' . esc_html__( 'The selected folder has no items.', 'ifolders' ) . '</p></div></div>';
        }

        ob_start();

        $classes = ['ifolders-gallery-block'];
        if ( !empty( $className ) ) {
            $classes[] = $className;
        }

        echo '<div class="' . esc_attr( implode( ' ', $classes ) ) . '">';
        for ($column = 1; $column <= $columns; $column++) {
            echo '<div class="ifolders-gallery-block__column">';

            $attachment_column_key = $column;
            foreach ( $attachment_ids as $attachment_key => $attachment_id ) {
                if ( ($attachment_key + 1) == $attachment_column_key ) {
                    $imageUrl = wp_get_attachment_url( $attachment_id );

                    if ( $imageUrl ) {
                        echo '<figure class="ifolders-gallery-block__item">';
                        echo wp_get_attachment_image( $attachment_id, $imageSize, false );
                        echo '</figure>';
                    }

                    $attachment_column_key += $columns;
                }
            }

            echo '</div>';
        }
        echo '</div>';

        return ob_get_clean();
    }
}