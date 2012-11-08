<?php

namespace RovakCodeMirror;

return array(
    'factories' => array(
        'codemirror' => function($sm) {
            $sm = $sm->getServiceLocator();
            return new View\Plugin\CodeMirror($sm->get('codemirror_editor_options'));
        },
    ),
);