<?php

namespace RovakCodeMirror;

class Module
{

    public function onBootstrap($e)
    {
        
    }

    public function getConfig()
    {
        return include __DIR__ . '/config/module.config.php';
    }

    public function getAutoloaderConfig()
    {
        return array(
            'Zend\Loader\StandardAutoloader' => array(
                'namespaces' => array(
                    __NAMESPACE__ => __DIR__ . '/src/' . __NAMESPACE__,
                ),
            ),
        );
    }

    /**
     * @return array
     */
    public function getServiceConfig()
    {
        return array(
            'factories' => array(
                'codemirror_editor_options' => function($sm) {
                    $cfg = $sm->get('Config');
                    return new Options\Editor($cfg['codemirror']);
                },
                'codemirror_editor_service' => function($sm) {
                    return new Service\EditorManager($sm->get('codemirror_editor_options'));
                },
            ),
        );
    }

    /**
     * @return array
     */
    public function getViewHelperConfig()
    {
        return array(
            'factories' => array(
                'codemirror' => function($sm) {
                    $sm = $sm->getServiceLocator();
                    return new View\Plugin\CodeMirror($sm->get('codemirror_editor_options'));
                },
            ),
        );
    }

}
