<?php

namespace Constructive\Glossary\Repositories;

use Constructive\Glossary\Http\Resources\GlossaryItemResource;
use Constructive\Glossary\Repositories\Interfaces\GlossaryItemRepositoryInterface;
use Illuminate\Support\Collection;
use WP_Post;

class GlossaryItemRepository implements GlossaryItemRepositoryInterface
{
    public function all() : Collection
    {
        $items = get_posts([
            'post_type' => 'glossary_item',
            'per_page' => -1
        ]);
        return collect($items)->map(function (WP_Post $post) {
            return (new GlossaryItemResource($post))->toArray();
        });
    }
}
