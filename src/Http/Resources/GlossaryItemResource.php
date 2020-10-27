<?php

namespace App\Glossary\Http\Resources;

use WP_Post;

class GlossaryItemResource
{
    public function __construct(WP_Post $post)
    {
        $this->post = $post;
    }
    public function toArray()
    {
        return [
            'term' => $this->post->post_title,
            'definition' => get_field('definition', $this->post->ID),
            'aliases' => collect(get_field('aliases', $this->post->ID))->map(function (array $post) {
                return $post['alias'];
            })
        ];
    }
}
