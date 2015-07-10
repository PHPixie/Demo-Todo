<?php

return array(
    'relationships' => array(
        array(
            'type'  => 'oneToMany',
            'owner' => 'project',
            'items' => 'task',
            'itemsOptions' => array(
                'onOwnerDelete' => 'delete'
            )
        )
    )
);