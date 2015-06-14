<?php
include "Orderus.php";
include "Beast.php";
include "Battle.php";

$params = array(
     'orderus' => array(
            'health' => array(
                'min' => 70,
                'max' => 100
            ),
            'strength' => array(
                'min' => 70,
                'max' => 80
            ),
            'defence' => array(
                'min' => 45,
                'max' => 55
            ),
            'speed' => array(
                'min' => 40,
                'max' => 50
            ),
            'luck' => array(
                'min' => 10,
                'max' => 30
            ),
     ),
     'beast' => array(
            'health' => array(
                'min' => 60,
                'max' => 90
            ),
            'strength' => array(
                'min' => 60,
                'max' => 90
            ),
            'defence' => array(
                'min' => 40,
                'max' => 60
            ),
            'speed' => array(
                'min' => 40,
                'max' => 60
            ),
            'luck' => array(
                'min' => 25,
                'max' => 40
            )
     )
);

//generate random values for wariorr's properties
foreach($params as $warrior => $param) {
    foreach($param as $key =>$value) {
        $params[$warrior][$key] = get_rand($value['min'], $value['max']);
    }
}

/*
 * get_rand return random value between a min and max inputs
 * $param1 - min val
 * $param2 - max val
 * return value beteween min and max
 * */
function get_rand($start, $stop) {
    return rand($start, $stop);
}


$orderus = new Orderus($params['orderus']);
$beast = new Beast($params['beast']);

$battle = new Battle($orderus, $beast);
$battle->battle();

?>