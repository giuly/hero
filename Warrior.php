<?php

abstract class  Warrior {

    public $name;
    public $health;
    public $strength;
    public $defence;
    public $speed;
    public $luck;

    public function __construct($params) {

        foreach($params as $key =>$value) {
            $this->$key = $value;
        }

        $this->set_name();
    }

    /**
     * the attack function - calculate the damage by subtracting defender's defence from attacker's strength
     * @param1 - $attacker_strength
     * @param2 - $defender_defence
     * return  - damage
     * */
    public function attack($attacker_strength, $defender_defence) {

        return (int)($attacker_strength - $defender_defence);

    }

    /**
     * the defend function
     * @param1 - $damage
     * return - $damage
     * */
    public function defend($damage) {

        return $damage;

    }

    /**
     * set the warrior's name
     * */
    abstract public function set_name();
} 