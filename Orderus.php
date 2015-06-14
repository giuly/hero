<?php
include_once('Warrior.php');

class Orderus extends Warrior{

    private $twiceChance = 10;
    private $shieldChance = 20;

    public function  attack($attacker_strength, $defender_defence) {

        $damage = parent::attack($attacker_strength, $defender_defence);
        if($this->rapid_strike()) {
            $damage *=2;
        }

        return $damage;
    }

    public function defend($damage) {

        if($this->magic_shield()) {
            $damage /= 2;
        }

        return $damage;
    }

    //Orderus skills

    /*
     * rapid strike - strike twice while it's his turn to attack and
     * there is a 10% chance he use this skill
     * return TRUE/FALSE
     * */
    private  function rapid_strike() {
        //rapid strike skill
        if(rand(1,100) <= $this->twiceChance) {
            return TRUE;
        } else {
            return FALSE;
        }
    }

    /*
     * magic shiled - it takes only a half of the usual damage when he is attacked and
     * there are 20% chances of using this skill
     * return TRUE/FALSE
     * */
    private function magic_shield() {
        //magic shield defense skill
        if(rand(1,100) <= $this->shieldChance) {
            return TRUE;
        } else {
            return FALSE;
        }
    }

    public function set_name() {
        $this->name = 'orderus';
    }

} 