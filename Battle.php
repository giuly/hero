<?php

class Battle {

    private $orderus;
    private $beast;
    private $turns;
    private $current_attacker;
    private $damage;

    public function __construct(Warrior $orderus, Warrior $beast) {

        $this->orderus = $orderus;
        $this->beast   = $beast;
        $this->turns   = 20;
    }

    public function battle() {

        $this->init();

        while( ($this->turns > 0) && ($this->orderus->health > 0) && ($this->beast->health > 0) ) {

            //check if first attacker is Orderus
            if($this->current_attacker == $this->orderus->name) {
                //Orderus attacks - Beast defends
                $attack = $this->orderus->name;
                $defend = $this->beast->name;
                $this->current_attacker = $this->beast->name;
            } else {
                //Beast attacks - Orderus defends
                $attack = $this->beast->name;
                $defend = $this->orderus->name;
                $this->current_attacker = $this->orderus->name;
            }

            if( !$this->check_probability($this->$defend->luck) ) {
                echo $this->$defend->name . ' got lucky now <br />';
                continue;
            } else {
                $this->damage = $this->$attack->attack($this->$attack->strength, $this->$defend->defence);
                $this->damage = $this->$defend->defend($this->damage);
                $this->$defend->health -= $this->damage;
            }

            echo "Orderus Stats: ";
            echo '<pre>';
            print_r($this->orderus);
            echo '<br />';

            echo "Beast Stats: ";
            echo '<pre>';
            print_r($this->beast);

            echo '--------------------------------------------------------------------------<br /><br />';

            //decremnt number of turns
            $this->turns--;
        }

    }

    private function init() {
        //init the battle
        //first attack is made by the fastest or the luckiest
        if($this->orderus->speed == $this->beast->speed) {
            $this->current_attacker = ($this->orderus->luck > $this->beast->luck) ? $this->orderus->name : $this->beast->name;
        } else{
            $this->current_attacker = ($this->orderus->speed > $this->beast->speed) ? $this->orderus->name : $this->beast->name;
        }
    }

    private function check_probability($chance) {
        //check for probability to produce an event
        if(rand(1,100) <= $chance) {
            return TRUE;
        } else {
            return FALSE;
        }

    }

} 