<?php
namespace App\Glossary;

use App\Glossary\Http\GlossaryTermsController;
use Illuminate\Support\ServiceProvider;
use WordPlate\Acf\Fields\Repeater;
use WordPlate\Acf\Fields\Text;
use WordPlate\Acf\Fields\Textarea;
use WordPlate\Acf\Location;

class GlossaryServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->app->bind(GlossaryTermsController::class, function () {
            return new GlossaryTermsController;
        });

        $this->registerDataModels();
        $this->registerAttributes();
        $this->registerJsonEndpoints();
    }

    private function registerDataModels()
    {
        register_extended_post_type(
            'glossary_item',
            ['supports' => ['title']],
            ['slug' => 'glossary-item']
        );
    }

    private function registerAttributes()
    {
        register_extended_field_group([
            'title'     => 'Glossary Item',
            'fields' => [
                Textarea::make('Definition'),
                Repeater::make('Aliases')
                    ->buttonLabel('Add Alias')
                    ->fields([
                        Text::make('Alias')
                    ])
            ],
            'location' => [
                Location::if('post_type', 'glossary_item'),
            ],
            'position' => 'acf_after_title',
            'style' => 'block',
            'hide_on_screen' => ['excerpt', 'discussion', 'comments', 'featured_image', 'revisions', 'send_trackbacks'],
        ]);
    }

    private function registerJsonEndpoints()
    {
        add_action('rest_api_init', function () {
            register_rest_route('glossary/v1', 'terms', [
                'methods'             => 'GET',
                'callback'            => [$this->app->get(GlossaryTermsController::class), 'index']
            ]);
            // new GlossaryTermsController
        });
    }
}
