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

    /**
     * the battle function
     * the battle ends when one of the warriors loses his health or
     * there are made 20 turns
     * return - void
     */
    public function battle() {

        ob_start();

        $this->init();

        while( ($this->turns > 0) && ($this->orderus->health > 0) && ($this->beast->health > 0) ) {

            $flag = $this->fight();

            //decremnt number of turns
            $this->turns--;


            //Just for demo
            echo "Turn: ".(20 - $this->turns) . ' <br />';
            echo "<strong>".$this->current_defender->name."</strong> has attacked <br />";
            if($flag) {
                echo $this->current_attacker->name . ' got luck <br />';
            }

            echo "<span style='color:green'>Orderus</span> health: ".$this->orderus->health . '<br />';
            echo "<span style='color:red'>Beast </span>health: ".$this->beast->health . '<br />';
            echo "Damage: " . $this->damage . '<br />';
            echo "--------------------------------------<br />";
            //END - Just for Demo
        }

        ob_end_flush();
    }

    /**
     * init the battle
     * first attack is made by the fastest or the luckiest
     */
    private function init() {

        if($this->orderus->speed == $this->beast->speed) {
            $this->current_attacker = ($this->orderus->luck > $this->beast->luck) ? $this->orderus : $this->beast;
        } else{
            $this->current_attacker = ($this->orderus->speed > $this->beast->speed) ? $this->orderus : $this->beast;
        }

        $this->current_defender = $this->get_opposite($this->orderus, $this->beast, $this->current_attacker);
    }

    /**
     * the fight
     * here is made the attack and the defence and also
     * is changed the battle state - who attacks and who defends
     * return flag true if warrior got luck
     */
    private function fight() {

        $flag = FALSE;

        if( !$this->check_probability($this->current_defender->luck) ) {

            $this->attack();
            $this->defend();

            $this->health_subtracting($this->damage);
        } else {
            $flag = TRUE;
        }

        $this->current_defender = $this->current_attacker;
        $this->current_attacker = $this->get_opposite($this->orderus, $this->beast, $this->current_attacker);

        return $flag;
    }

    /**
     * the attack of the battle
     * set the defender damage
     */
    private function attack() {

        $this->damage = $this->current_attacker->attack($this->current_attacker->strength, $this->current_defender->defence);

    }

    /**
     * the defend of the battle
     * set the defender damage
     */
    private function defend() {

        $this->damage = $this->current_defender->defend($this->damage);

    }

    /**
     * function updates current defender warrior's health status by
     * subtracting damage from his health
     * @param1 - $damage
     */
    private function health_subtracting($damage) {

        $this->current_defender->health -= $damage;

    }

    /**
     * check probability of having an attack
     * $param1 - $chance
     * return TRUE/FALSE
     */
    private function check_probability($chance) {

        if(rand(1,100) <= $chance) {
            return TRUE;
        } else {
            return FALSE;
        }

    }

    /**
     * gets the opposite participant/warrior
     * @param1 - attacker
     * @param2 - defender
     * @param3 - current attacker
     * return the opposite of current attacker
     */
    private function get_opposite( $attacker, $defender, $current_attacker ) {

        if($current_attacker->name == $attacker->name)
            return $defender;
        elseif($current_attacker->name == $defender->name)
            return  $attacker;
        else return $current_attacker;
    }

} 