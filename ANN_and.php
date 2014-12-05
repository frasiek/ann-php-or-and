<?php

require_once 'ANN/Loader.php';
require_once 'ANN_or.php';
use ANN\Network;
use ANN\Values;
use ANN\NetworkGraph;

/**
 * Description of learning_and
 *
 * @author frasiek
 */
class ANN_and extends ANN_or{

    protected $network;

    const NETWORK_PATH = "./networks/and.dat";
    const NETWORK_VALUES_PATH = "./networks/values_and.dat";
    const NETWORK_IMAGE = "./networks/and.png";

    
    public function getName(){
        return "AND";
    }

    protected function createOrLoadNetwork() {
        try {
            $this->network = Network::loadFromFile(self::NETWORK_PATH);
        } catch (Exception $e) {
            $this->network = new Network(1, 2, 1);
            $values = new Values();

            $values->train()
                    ->input(0, 0)->output(0)
                    ->input(0, 1)->output(0)
                    ->input(1, 0)->output(0)
                    ->input(1, 1)->output(1);

            $values->saveToFile(self::NETWORK_VALUES_PATH);
        }
    }
}
