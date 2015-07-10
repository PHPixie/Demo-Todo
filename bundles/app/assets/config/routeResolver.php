<?php

return array(
    'type'      => 'group',
    'resolvers' => array(
        'view' => array(
            'type'     => 'pattern',
            'path'     => 'project/view/<id>',
            'defaults' => array(
                'processor' => 'project',
                'action'    => 'view'
            )
        ),
        'default' => array(
            'type'     => 'pattern',
            'path'     => '(<processor>(/<action>))',
            'defaults' => array(
                'processor' => 'project',
                'action'    => 'index'
            )
        )
    )
);