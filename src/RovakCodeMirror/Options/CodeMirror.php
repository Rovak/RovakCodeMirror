<?php

namespace RovakCodeMirror\Options;

use Zend\Stdlib\AbstractOptions;

/**
 * Editor options
 */
class CodeMirror extends AbstractOptions
{

    protected $theme;
    protected $indentUnit;
    protected $smartIndent;
    protected $tabSize;
    protected $indentWithTabs;
    protected $electricChars;
    protected $autoClearEmptyLines;
    protected $lineWrapping;
    protected $lineNumbers;
    protected $firstLineNumber;
    protected $gutter;
    protected $fixedGutter;
    protected $readOnly;
    protected $matchBrackets;
    protected $cursorBlinkRate;
    protected $undoDepth;

}