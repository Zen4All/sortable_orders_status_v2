<?php
// -----
// Part of the "Sortable Orders Status" plugin by lat9, for Zen Cart's v1.5.6 and later.
// Copyright (c) 2015-2019 Vinos de Frutas Tropicales
//
$autoLoadConfig[200][] = array(
    'autoType'  => 'class',
    'loadFile'  => 'observers/SortableOrdersStatusObserver.php',
    'classPath' => DIR_WS_CLASSES
);
$autoLoadConfig[200][] = array(
    'autoType'   => 'classInstantiate',
    'className'  => 'SortableOrdersStatusObserver',
    'objectName' => 'soso'
);
