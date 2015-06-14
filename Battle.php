<?php

class Battle {

    private $orderus;
    private $beast;
    private $turns;

    private $current_attacker;
    private $current_defender;
    private $damage;

    public function __construct(Warrior $orderus, Warrior $beast) {

        $this->orderus = $orderus;
        $this->beast   = $beast;
        $this->turns   = 20;
    }

    public function battle() {

        $this->init();

        while( ($this->turns > 0) && ($this->orderus->health > 0) && ($this->beast->health > 0) ) {

            $this->fight();

            //decremnt number of turns
            $this->turns--;
        }

    }

    private function init() {
        //init the battle
        //first attack is made by the fastest or the luckiest
        if($this->orderus->speed == $this->beast->speed) {
            $this->current_attacker = ($this->orderus->luck > $this->beast->luck) ? $this->orderus : $this->beast;
        } else{
            $this->current_attacker = ($this->orderus->speed > $this->beast->speed) ? $this->orderus : $this->beast;
        }

        $this->current_defender = $this->get_opposite($this->orderus, $this->beast, $this->current_attacker);
    }

    private function fight() {

        if( !$this->check_probability($this->current_defender->luck) ) {

            $this->attack();
            $this->defend();

            $this->health_subtracting($this->damage);
        }

        $this->current_defender = $this->current_attacker;
        $this->current_attacker = $this->get_opposite($this->orderus, $this->beast, $this->current_attacker);
    }

    private function attack() {
        $this->damage = $this->current_attacker->attack($this->current_attacker->strength, $this->current_defender->defence);
    }

    private function defend() {
        $this->damage = $this->current_defender->defend($this->damage);
    }

    private function health_subtracting($damage) {
        $this->current_defender->health -= $damage;
    }

    private function check_probability($chance) {
        //check for probability to produce an event
        if(rand(1,100) <= $chance) {
            return TRUE;
        } else {
            return FALSE;
        }

    }

    private function get_opposite( $attacker, $defender, $current_attacker ) {
        if($current_attacker->name == $attacker->name)
            return $defender;
        elseif($current_attacker->name == $defender->name)
            return  $attacker;
        else return $current_attacker;
    }

} 