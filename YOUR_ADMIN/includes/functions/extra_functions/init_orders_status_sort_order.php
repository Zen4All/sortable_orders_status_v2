<?php
// -----
// Part of the "Sortable Orders Status" for Zen Cart 1.5.6 and later.
//
// Copyright (C) 2015-2019, Vinos de Frutas Tropicales
//
if (!$sniffer->field_exists(TABLE_ORDERS_STATUS, 'sort_order')) {
    $db->Execute(
        "ALTER TABLE " . TABLE_ORDERS_STATUS . " 
           ADD sort_order int(11) NOT NULL default '0'"
    );
}