<?php

class Elasticpress_related_posts
{
    /** @var Elasticpress_related_posts */
    public static $instance = null;

    public static function instance()
    {
        if(is_null(static::$instance))
            static::$instance = new static;

        return static::$instance;
    }

    private function __construct()
    {
        if(is_null(get_the_ID()))
            return;

        add_action( 'add_meta_boxes_post', [$this, 'add_meta_box'] );
    }


    public function add_meta_box()
    {
        add_meta_box( 'related_posts_meta_box', 'Related posts', [$this, 'build_meta_box'], null, 'side', 'low');
    }

    public function build_meta_box()
    {
        $args = [
            'more_like' => get_the_ID(),
            'posts_per_page' => 25,
            'ep_integrate'   => true,
        ];

        $query = new WP_Query( apply_filters( 'ep_find_related_args', $args ) );

        if ( !empty($query->posts) ) {
            $output = '';

            foreach($query->posts as $post) {

                $output .= '<p><a href="' . get_the_permalink($post->ID). '" target="_blank">' .$post->post_title . '</a>';

                $output .= '<a href="#" style="float:right" onclick="navigator.clipboard.writeText(\''. get_the_permalink($post->ID). '\'); return false;"><small>Copy</small></a>';
                $output .= '</p>';
            }

        } else {
            $output = 'No related posts found';
        }

        echo $output;
    }

}