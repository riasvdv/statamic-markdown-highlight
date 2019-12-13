<?php

namespace Rias\MarkdownHighlight;

use League\CommonMark\Block\Element\FencedCode;
use League\CommonMark\Block\Element\IndentedCode;
use League\CommonMark\CommonMarkConverter;
use League\CommonMark\Environment;
use Spatie\CommonMarkHighlighter\FencedCodeRenderer;
use Spatie\CommonMarkHighlighter\IndentedCodeRenderer;
use Statamic\Fieldtypes\Markdown;

class MarkdownHighlight extends Markdown
{
    protected $icon = 'code-block';

    protected $configFields = [];

    public function augment($value)
    {
        $environment = Environment::createCommonMarkEnvironment()
            ->addBlockRenderer(FencedCode::class, new FencedCodeRenderer())
            ->addBlockRenderer(IndentedCode::class, new IndentedCodeRenderer());

        $commonMarkConverter = new CommonMarkConverter([], $environment);

        return $commonMarkConverter->convertToHtml($value);
    }

    public function component(): string
    {
        return 'markdown';
    }

    public function indexComponent(): string
    {
        return 'markdown';
    }
}
