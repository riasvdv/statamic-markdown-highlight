<?php

namespace Rias\MarkdownHighlight\Fieldtypes;

use Spatie\CommonMarkShikiHighlighter\HighlightCodeExtension;
use Statamic\Fieldtypes\Markdown as MarkdownFieldtype;
use Statamic\Facades\Markdown as MarkdownManager;

class MarkdownHighlight extends MarkdownFieldtype
{
    protected $icon = 'code-block';
    protected $component = 'markdown';
    protected $indexComponent = 'markdown';

    protected function configFieldItems(): array
    {
        return array_merge((new parent)->configFieldItems(), [
            'autodetect_languages' => [
                'display' => __('Auto-detect Languages'),
                'instructions' => __('Space-separated list of languages to detect (leave empty to detect all)'),
                'type' => 'text',
                'width' => 100,
            ],
        ]);
    }

    public function augment($value)
    {
        if (is_null($value)) {
            return '';
        }

        $cacheKey = md5($value) . config('statamic.markdown-highlight.theme');

        if (! config('statamic.markdown-highlight.cache')) {
            cache()->forget($cacheKey);
        }

        return cache()->rememberForever($cacheKey, function () use ($value) {
            /** @var \Statamic\Markdown\Parser */
            $parser = MarkdownManager::parser(
                $this->config('parser', 'default')
            );

            $parser = $parser->newInstance()->addExtension(function () {
                return new HighlightCodeExtension(config('statamic.markdown-highlight.theme', 'github-light'));
            });

            if ($this->config('automatic_line_breaks')) {
                $parser = $parser->withAutoLineBreaks();
            }

            if ($this->config('escape_markup')) {
                $parser = $parser->withMarkupEscaping();
            }

            if ($this->config('automatic_links')) {
                $parser = $parser->withAutoLinks();
            }

            if ($this->config('smartypants')) {
                $parser = $parser->withSmartPunctuation();
            }

            return $parser->parse((string) $value);
        });
    }
}
