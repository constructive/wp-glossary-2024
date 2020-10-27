<?php

namespace App\Glossary\Repositories;

use App\Glossary\Http\Resources\GlossaryItemResource;
use App\Glossary\Repositories\Interfaces\GlossaryItemRepositoryInterface;
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
