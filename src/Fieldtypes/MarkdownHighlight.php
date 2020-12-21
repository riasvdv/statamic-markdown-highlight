<?php

namespace Rias\MarkdownHighlight\Fieldtypes;

use Statamic\Fieldtypes\Markdown as MarkdownFieldtype;
use Statamic\Facades\Markdown as MarkdownManager;
use Rias\MarkdownHighlight\Extensions\CodeHighlighterExtension;

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
            return;
        }

        /** @var \Statamic\Markdown\Parser */
        $parser = MarkdownManager::parser(
            $this->config('parser', 'default')
        );

        $parser = $parser->newInstance()->addExtension(function () {
            return new CodeHighlighterExtension(
               $this->config('autodetect_languages')
            );
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
    }
}
