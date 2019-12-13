<?php

namespace Rias\MarkdownHighlight;

use Rias\MarkdownHighlight\Tags\Highlight as HighlightTag;
use Statamic\Providers\AddonServiceProvider;

class ServiceProvider extends AddonServiceProvider
{
    protected $fieldtypes = [
        MarkdownHighlight::class,
    ];

    protected $tags = [
        HighlightTag::class,
    ];
}
