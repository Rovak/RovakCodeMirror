<?php

namespace RovakCodeMirror\View\Plugin;

use InvalidArgumentException;
use RovakCodeMirror\Options\Editor as EditorOptions;
use Zend\Form\ElementInterface;
use Zend\Form\View\Helper\AbstractHelper;

/**
 * Code Mirror
 */
class CodeMirror extends AbstractHelper
{
    /**
     * Array with modes which are already loaded
     * 
     * @var array 
     */
    protected $loadedModes = array();
    protected $editors = array();
    protected $init = false;
    protected $libraryPath;
    protected $id = 1;

    public function __construct($options)
    {
        $this->setOptions($options);
    }

    /**
     * @return EditorOptions
     */
    public function getOptions()
    {
        return $this->options;
    }

    /**
     * @param EditorOptions $options
     */
    public function setOptions(EditorOptions $options)
    {
        $this->options = $options;
    }

    /**
     * @return string
     */
    public function getLibraryPath()
    {
        if (null == $this->libraryPath) {
            $this->libraryPath = $this->getView()->basePath($this->getOptions()->getLibPath());
        }

        return $this->libraryPath;
    }

    /**
     * Init core files
     */
    public function initLibrary()
    {
        if ($this->init) {
            return false;
        }

        $view = $this->getView();
        $basePath = $this->getLibraryPath();
 
        $view->headLink()->appendStylesheet($basePath . '/lib/codemirror.css' );
        $view->headScript()->appendFile($basePath . '/lib/codemirror.js' );
        
        $this->init = true;
    }

    /**
     * @param string $content
     * @param array $options
     * @return string
     */
    public function __invoke($content, array $options = array())
    {
        $view = $this->getView();
        $editor = array();
        
        $this->initLibrary();

        if (isset($options['mode'])) {
            $editor['mode'] = $options['mode'];
            $this->loadMode($options['mode']);
        }

        if ($content instanceof ElementInterface) {
            return $view->formTextarea($content);
        }

        $editor['id'] = "codemirror-" . ++$this->id;

        $view->inlineScript()->appendScript($this->generateEditorScript(array(
            'mode'  => $editor['mode'],
            'id'    => $editor['id'],
        )));

        return sprintf(
            '<textarea id="%s">%s</textarea>', 
            $editor['id'], 
            $view->escapeHtml($content)
        );
    }

    /**
     * Load a mode
     * 
     * @param string $mode
     */
    protected function loadMode($mode)
    {
        if (isset($this->loadedModes[$mode])) {
            return true;
        }

        if (null == ($cfg = $this->getOptions()->getMode($mode))) {
            throw new InvalidArgumentException('Unknown mode ' . $mode);
        }

        $this->loadedModes[$mode] = TRUE;

        if (isset($cfg['deps'])) {
            $deps = is_array($cfg['deps']) ? $cfg['deps'] : array($cfg['deps']);
            foreach ($deps as $dependency) {
                $this->loadMode($dependency);
            }
        }

        $basePath = $this->getLibraryPath();

        // Load dependend javascript files
        if (isset($cfg['js'])) {
            foreach ($cfg['js'] as $file) {
                $this->getView()->inlineScript()->appendFile($basePath . '/mode/' . $file);
            }
        }

        // Load dependent css files
        if (isset($cfg['css'])) {
            foreach ($cfg['css'] as $file) {
                $this->getView()->headLink()->appendStylesheet($basePath . '/mode/' . $file);
            }
        }
    }

    /**
     * Load multiple modes
     * 
     * @param string $mode
     */
    protected function loadModes(array $modes)
    {
        foreach ($modes as $mode) {
            $this->loadMode($mode);
        }
    }

    /**
     * Generate javascript code to build an editor
     * 
     * @param array $options
     * @return string
     */
    public function generateEditorScript($options = array())
    {
        $json = array(
            'mode' => $options['mode'],
        );

        return <<<SCRIPT
CodeMirror.fromTextArea(document.getElementById("{$options['id']}"), {
    lineNumbers: true,
    matchBrackets: true,
    mode: "{$options['mode']}",
    indentUnit: 4,
    indentWithTabs: true,
    enterMode: "keep",
    tabMode: "shift"
});
SCRIPT;
    }

}