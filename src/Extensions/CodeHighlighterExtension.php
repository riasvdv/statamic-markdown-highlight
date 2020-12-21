<?php

namespace Rias\MarkdownHighlight\Extensions;

use League\CommonMark\Block\Element\FencedCode;
use League\CommonMark\Block\Element\IndentedCode;
use League\CommonMark\Block\Parser\FencedCodeParser;
use League\CommonMark\ConfigurableEnvironmentInterface;
use League\CommonMark\Extension\ExtensionInterface;
use Spatie\CommonMarkHighlighter\FencedCodeRenderer;
use Spatie\CommonMarkHighlighter\IndentedCodeRenderer;

final class CodeHighlighterExtension implements ExtensionInterface
{
    public $autodetectLanguages;

    public function __construct(?string $autodetectLanguages)
    {
        $this->autodetectLanguages = $autodetectLanguages ? explode(' ', $autodetectLanguages) : [];
    }

    public function register(ConfigurableEnvironmentInterface $environment)
    {
        $environment
          ->addBlockRenderer(FencedCode::class, new FencedCodeRenderer($this->autodetectLanguages), 10)
          ->addBlockRenderer(IndentedCode::class, new IndentedCodeRenderer($this->autodetectLanguages), 20);
    }
}
