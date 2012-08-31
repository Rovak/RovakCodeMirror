<?php

return array(
    'codemirror' => array(

        /**
         * Path to where the library is located
         */
        'lib_path' => '/../module/RovakCodeMirror/public/vendor/CodeMirror',

        /**
         * Available modes
         */
        'modes' => array(

            'php' => array(
                'mime'  => 'application/x-httpd-php',
                'deps'  => array( 'xml', 'javascript', 'css', 'clike' ),
                'js'    => array( 'php/php.js' )
            ),
            
            'xml' => array(
                'mime'  => 'application/xml',
                'js'    => array( 'xml/xml.js' )
            ),

            'javascript' => array(
                'mime'  => 'text/javascript',
                'js'    => array( 'javascript/javascript.js' )
            ),
            
            'html' => array(
                'mime'  => 'text/html',
                'deps'  => array( 'xml', 'javascript', 'css' ),
                'js'    => array( 'htmlmixed/htmlmixed.js' )
            ),
            
            'css' => array(
                'mime'  => 'text/css',
                'js'    => array( 'css/css.js' )
            ),
            
            'clike' => array(
                'mime'  => 'text/x-csrc',
                'js'    => array( 'clike/clike.js' )
            )
        ),
    ),
);