<?php
/**
 * Class Helpers functions
 *
 * @since   1.0.4
 * @package Delicious_Recipes
 */

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Class for helper functions for structured data render.
 */
class Delicious_Recipes_Helpers {
    public function generateId( $prefix = '') {
		return $prefix !== '' ? uniqid( $prefix . '-' ) : uniqid();
	}

	public function render_attributes( $attributes ) {
		if ( empty( $attributes ) )
			return '';

		$render = '';

		if ( is_array( $attributes ) ) {
			foreach ( $attributes as $property => $value ) {
				$render .= sprintf( '%s="%s" ', $property, esc_attr( $value ) );
			}
		} elseif ( is_string( $attributes ) ) {
			$render = $attributes;
		}
		return trim( $render );
	}

	public function render_styles_attributes( $styles ) {
		if ( empty( $styles ) )
			return '';

		$render = '';
		
		if ( is_array( $styles ) ) {
			foreach ( $styles as $property => $value ) {
				$render .= sprintf( '%s: %s; ', $property, $value );
			}
		} elseif ( is_string( $styles ) ) {
			$render = $styles;
		}
		return trim( $render );
	}

	public function parse_block_settings( $attrs ) {
		$settings = isset( $attrs['settings'][0] ) ? $attrs['settings'][0] : array();
		$blockStyle = '';

		if ( !isset( $settings['headerAlign'] ) ) {
			$settings['headerAlign'] = 'left';
		}
		
		if ( !isset( $settings['custom_author_name'] ) ) {
			$settings['custom_author_name'] = '';
		}
		if ( !isset( $settings['displayServings'] ) ) {
			$settings['displayServings'] = '';
		}
		if ( !isset( $settings['displayPrepTime'] ) ) {
			$settings['displayPrepTime'] = '';
		}
		if ( !isset( $settings['displayCookingTime'] ) ) {
			$settings['displayCookingTime'] = true;
		}
		if ( !isset( $settings['displayTotalTime'] ) ) {
			$settings['displayTotalTime'] = true;
		}
		if ( !isset( $settings['displayCalories'] ) ) {
			$settings['displayCalories'] = true;
		}
		if ( !isset( $settings['ingredientsLayout'] ) ) {
			$settings['ingredientsLayout'] = '1-column';
		}

		if ( 'default' === $blockStyle ) {
			$settings['primary_color'] = '#222222';
		}
		elseif ( 'newdesign' === $blockStyle ) {
			$settings['primary_color'] = '#FFA921';
		}
		elseif ( 'simple' === $blockStyle ) {
			$settings['primary_color'] = '';
		}

		if ( !isset( $settings['print_btn'] ) ) {
			$settings['print_btn'] = true;
		}
		if ( !isset( $settings['pin_btn'] ) ) {
			$settings['pin_btn'] = true;
		}
		if ( !isset( $settings['pin_has_custom_image'] ) ) {
			$settings['pin_has_custom_image'] = false;
		}
		if ( !isset( $settings['pin_custom_image'] ) ) {
			$settings['pin_custom_image'] = array();
		}
		if ( !isset( $settings['hide_header_image'] ) ) {
			$settings['hide_header_image'] = false;
		}

		return $settings;
	}

	public function omit( array $array, array $paths ) {
		foreach ( $array as $key => $value ) {
			if ( in_array( $key, $paths ) ) {
				unset( $array[ $key ] );
			}
		}

		return $array;
	}

	public function getNumberFromString( $string ) {
		if ( ! is_string( $string ) ) {
			return false;
		}
		preg_match('/\d+/', $string, $matches);
		return $matches ? $matches[0] : 0;
	}

	public function convertMinutesToHours( $minutes, $returnArray = false ) {
		$output = '';
		$time = $this->getNumberFromString( $minutes );

		if ( ! $time ) {
			return $minutes;
		}
		
		$hours = floor( $time / 60 );
		$mins = ( $time % 60 );

		if ( $returnArray ) {
			if ( $hours ) {
				$array['hours']['value'] = $hours;
				$array['hours']['unit'] = _n( "hour", "hours", (int)$hours, "wpzoom-recipe-card" );
			}
			if ( $mins ) {
				$array['minutes']['value'] = $mins;
				$array['minutes']['unit'] = _n( "minute", "minutes", (int)$mins, "wpzoom-recipe-card" );
			}

			return $array;
		}

		if ( $hours ) {
			$output = $hours .' '. _n( "hour", "hours", (int)$hours, "wpzoom-recipe-card" );
		}

		if ( $mins ) {
			$output .= ' ' . $mins .' '. _n( "minute", "minutes", (int)$mins, "wpzoom-recipe-card" );
		}

		return $output;
	}

	public function convert_youtube_url_to_embed( $url ) {
		$embed_url = preg_replace("/\s*[a-zA-Z\/\/:\.]*youtube.com\/watch\?v=([a-zA-Z0-9\-_]+)([a-zA-Z0-9\/\*\-\_\?\&\;\%\=\.]*)/i","https://www.youtube.com/embed/$1?feature=oembed", $url );
		return $embed_url;
	}

	public function convert_vimeo_url_to_embed( $url ) {
		$embed_url = preg_replace("/\s*[a-zA-Z\/\/:\.]*vimeo.com\/([a-zA-Z0-9\-_]+)([a-zA-Z0-9\/\*\-\_\?\&\;\%\=\.]*)/i","https://player.vimeo.com/video/$1", $url );
		return $embed_url;
	}
}

