<?php

namespace RovakCodeMirror;

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
