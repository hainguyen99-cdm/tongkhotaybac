<?php
/**
 * Delecious recipes SEO handler class.
 * 
 * @package Delicious_Recipes
 */
namespace WP_Delicious;

defined( 'ABSPATH' ) || exit;

/**
 * Handle the SEO for frontend of Delicious_Recipes plugin
 * 
 * @since 1.0.0
 */
class Delicious_SEO {
    /**
	 * Constructor.
	 */
	public function __construct() {
		$this->init();
    }
    
    /**
	 * Initialization.
	 *
	 * @since 1.0.0
	 * @access private
	 *
	 * @return void
	 */
	private function init() {
		
		// Initialize hooks.
		$this->init_hooks();

		// Allow 3rd party to remove hooks.
		do_action( 'wp_delicious_seo_unhook', $this );
	}

	/**
	 * Initialize hooks.
	 *
	 * @since 1.0.0
	 * @access private
	 *
	 * @return void
	 */
	private function init_hooks() {

		//json ld recipe schema for display on Google Search and as a Guided Recipe on the Assistant.
        add_action( 'wp_delicious_guided_recipe_schema', array( $this, 'json_ld' ) );

	}

	/**
	 * json ld for single recipe.
	 *
	 * @since 1.0.0
	 * @access public
	 *
	 * @return void
	 */
	public function json_ld(){

		$schema_values_json = json_encode( $this->schema_values() );

		$schema_html = '<script type="application/ld+json">';
			$schema_html .= $schema_values_json;
		$schema_html .= '</script>';

		echo apply_filters( 'wp_delicious_guided_recipe_schema_html', $schema_html );

    }
    
    /**
     * Get schema values.
     *
     * @param boolean $recipe
     * @return void
     */
	private function schema_values(){

        global $recipe;

		$PrepTimeMins = "min" === $recipe->prep_time_unit ? $recipe->prep_time : $recipe->prep_time * 60;
		$CookTimeMins = "min" === $recipe->cook_time_unit ? $recipe->cook_time : $recipe->cook_time * 60;
		$RestTimeMins = "min" === $recipe->rest_time_unit ? $recipe->rest_time : $recipe->rest_time * 60;

		$total_time = absint( $PrepTimeMins ) + absint( $CookTimeMins ) + absint( $RestTimeMins );

        $cook_time           = delicious_recipes_time_format( $CookTimeMins, 'iso' );
        $prep_time           = delicious_recipes_time_format( $PrepTimeMins, 'iso' );
        $total_time          = delicious_recipes_time_format( $total_time, 'iso' );
        $description         = $recipe->recipe_description ? wp_strip_all_tags( $recipe->recipe_description, true ) : $recipe->name;
        $recipe_instructions = array();
        $recipe_ingredients  = array();
        $images              = array();
        
        if( has_post_thumbnail( $recipe->ID ) ) :
            $size1  = get_the_post_thumbnail_url( $recipe->ID, 'thumbnail' );
            $size2  = get_the_post_thumbnail_url( $recipe->ID, 'medium' );
            $size3  = get_the_post_thumbnail_url( $recipe->ID, 'large' );
            $images = array( $size1, $size2, $size3 );
        endif;


        if ( isset( $recipe->ingredients ) && ! empty( $recipe->ingredients ) ):
            foreach ( $recipe->ingredients as $ingredients ):
                if ( isset( $ingredients['ingredients'] ) && ! empty( $ingredients['ingredients'] ) ):
                    foreach ( $ingredients['ingredients'] as $ing ):
                        if( isset( $ing['ingredient'] )  && ! empty( $ing['ingredient'] ) ):
                            unset( $ing['notes'] );
                            $ingredient           = implode(' ', $ing );
							$ingredient           = strip_tags( preg_replace( "~(?:\[/?)[^/\]]+/?\]~s", '', $ingredient ) );
							$recipe_ingredients[] = $ingredient;
                        endif;
                    endforeach;
                endif;
            endforeach;
        endif;

        if ( isset( $recipe->instructions ) && ! empty( $recipe->instructions ) ):
            foreach( $recipe->instructions as $section ) :
                foreach ( $section['instruction'] as $dir ):
                    if( isset( $dir['instruction'])  && ! empty( $dir['instruction'] ) ):
                        $direction = strip_tags( preg_replace( "~(?:\[/?)[^/\]]+/?\]~s", '', $dir['instruction'] ) );
                        $name      = isset( $dir['instructionTitle'] ) ? strip_tags( preg_replace( "~(?:\[/?)[^/\]]+/?\]~s", '', $dir['instructionTitle'] ) ) : '';
                        $image     = isset( $dir['image_preview'] ) && '' != $dir['image_preview'] ? $dir['image_preview'] : '';
                        $recipe_instructions[] = array(
                            "@type" => "HowToStep",
                            "name"  => esc_html( $name ),
                            "text"  => $direction,
                            // "url"   => ,
                            "image" => $image
                        );
                    endif;
                endforeach;
            endforeach;
        endif;

        if( $recipe->rating != 0 ):
            $aggregateRating = array(
                '@type'       => 'AggregateRating',
                'ratingValue' => $recipe->rating,
                'ratingCount' => $recipe->rating_count
            );
        else:
            $aggregateRating = 0;
        endif;

        $video = array();

        if( $recipe->enable_video_gallery && isset( $recipe->video_gallery['0'] ) ) :
            $video_obj = $recipe->video_gallery['0'];

            if ( 'youtube' === $video_obj['vidType'] ) {
                $vid_url   = 'http://www.youtube.com/watch?v=' . $video_obj['vidID'];
                $image_url = "http://i3.ytimg.com/vi/{$video_obj['vidID']}/maxresdefault.jpg";
            } elseif( 'vimeo' === $video_obj['vidType'] ) {
                $vid_url   = 'http://vimeo.com/moogaloop.swf?clip_id=' . $video_obj['vidID'];
                $image_url = $video_obj['vidThumb'];
            }

            $video = array(
                '@type'        => 'VideoObject',
                'name'         => $recipe->name,
                'description'  => $description,
                'thumbnailUrl' => $image_url,
                'contentUrl'   => $vid_url,
                'uploadDate'   => $recipe->date_published
            );
        endif;

        $schema_array = false;

        $schema_array = apply_filters( 'wp_delicious_guided_recipe_schema_array', array(
            '@context' => 'https://schema.org',
            '@type'    => 'Recipe',
            'name'     => $recipe->name,
            'image'    => $images,
            'author'   => array(
                '@type' => 'Person',
                'name'  => $recipe->author),
			'datePublished'      => $recipe->date_published,
			'description'        => $description,
			'prepTime'           => $prep_time,
			'cookTime'           => $cook_time,
			'totalTime'          => $total_time,
			'recipeYield'        => $recipe->no_of_servings,
			'recipeCategory'     => $recipe->recipe_course,
			'recipeCuisine'      => $recipe->recipe_cuisine,
			'cookingMethod'      => $recipe->cooking_method,
			'keywords'           => $recipe->keywords,
			'recipeIngredient'   => $recipe_ingredients,
			'recipeInstructions' => $recipe_instructions,
			'aggregateRating'    => $aggregateRating,
			'nutrition'          => array(
                '@type'               => 'NutritionInformation',
                'calories'            => $recipe->nutrition['calories'] . ' calories',
                'carbohydrateContent' => $recipe->nutrition['totalCarbohydrate'] . ' grams',
                'cholesterolContent'  => $recipe->nutrition['cholesterol'] . ' milligrams',
                'fatContent'          => $recipe->nutrition['totalFat'] . ' grams',
                'fiberContent'        => $recipe->nutrition['dietaryFiber'] . ' grams',
                'proteinContent'      => $recipe->nutrition['protein'] . ' grams',
                'saturatedFatContent' => $recipe->nutrition['saturatedFat'] . ' grams',
                'servingSize'         => $recipe->nutrition['servingSize'],
                'sodiumContent'       => $recipe->nutrition['sodium'] . ' milligrams',
                'sugarContent'        => $recipe->nutrition['sugars'] . ' grams',
                'transFatContent'     => $recipe->nutrition['transFat'] . ' grams'
            ),
            'video'              => $video
        ), $recipe );

        return $schema_array;

    }

}
