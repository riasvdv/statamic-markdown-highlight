<?php

namespace Rias\MarkdownHighlight;

use Rias\MarkdownHighlight\Fieldtypes\MarkdownHighlight;
use Statamic\Providers\AddonServiceProvider;

class ServiceProvider extends AddonServiceProvider
{
    protected $fieldtypes = [
        MarkdownHighlight::class,
    ];

    public function boot()
    {
        parent::boot();

        $this->mergeConfigFrom(__DIR__.'/../config/markdown-highlight.php', 'statamic.markdown-highlight');

        $this->publishes([
            __DIR__.'/../config/markdown-highlight.php' => config_path('statamic/markdown-highlight.php'),
        ], 'statamic-markdown-highlight-config');
    }
}
