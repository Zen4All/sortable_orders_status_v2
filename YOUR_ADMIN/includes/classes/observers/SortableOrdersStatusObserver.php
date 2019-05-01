<?php
// -----
// Part of the Sortable Orders Status plugin for Zen Carts v156 and later.
//
// Copyright (c) 2013-2019, Vinos de Frutas Tropicales (lat9)
//
if (!defined('IS_ADMIN_FLAG') || IS_ADMIN_FLAG !== true) {
   die('Illegal Access');
}

class SortableOrdersStatusObserver extends base 
{
    public function __construct() 
    {
        $this->attach(
            $this, 
            array( 
                /* Issued by /admin/orders.php */
                'NOTIFY_ADMIN_ORDERS_START_HTML', 
            )
        );
    }
  
    public function update(&$class, $eventID, $p1, &$p2, &$p3, &$p4) 
    {
        switch ($eventID) {
            // -----
            // Issued by Customers->Orders prior to the start of its HTML rendering.  Gives us the
            // opportunity to re-structure the GLOBAL array ($orders_statuses) used for the orders-status 
            // dropdowns to sort by the orders-status sort-order.
            //
            // No parameters are provided on the notification.
            //
            case 'NOTIFY_ADMIN_ORDERS_START_HTML':
                $statuses = $this->getSortedStatusQueryResult();
                $status_array = array();
                foreach ($statuses as $status) {
                    $status_array[] = array(
                        'id' => $status['orders_status_id'],
                        'text' => $status['orders_status_name'] . ' [' . $status['orders_status_id'] . ']',
                    );
                }
                $GLOBALS['orders_statuses'] = $status_array;
                break;
          
            default:
                break;
        }      
    }
    
    // -----
    // A common-use function to retrieve the sorted orders-status values from the database.
    //
    protected function getSortedStatusQueryResult()
    {
        return $GLOBALS['db']->Execute(
            "SELECT orders_status_id, orders_status_name
               FROM " . TABLE_ORDERS_STATUS . "
              WHERE language_id = " . (int)$_SESSION['languages_id'] . "
              ORDER BY sort_order ASC, orders_status_id ASC"
        );
    }
}
