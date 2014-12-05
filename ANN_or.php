<?php

require_once 'ANN/Loader.php';

use ANN\Network;
use ANN\Values;
use ANN\NetworkGraph;

/**
 * Description of learning_and
 *
 * @author frasiek
 */
class ANN_or {

    protected $network;

    const NETWORK_PATH = "./networks/or.dat";
    const NETWORK_VALUES_PATH = "./networks/values_or.dat";
    const NETWORK_IMAGE = "./networks/or.png";

    function __construct() {
        $this->createOrLoadNetwork();
    }
    
    public function getName(){
        return "OR";
    }

    protected function createOrLoadNetwork() {
        try {
            $this->network = Network::loadFromFile(self::NETWORK_PATH);
        } catch (Exception $e) {
            $this->network = new Network(1, 2, 1);
            $values = new Values();

            $values->train()
                    ->input(0, 0)->output(0)
                    ->input(0, 1)->output(1)
                    ->input(1, 0)->output(1)
                    ->input(1, 1)->output(1);

            $values->saveToFile(self::NETWORK_VALUES_PATH);
        }
    }
    
    public function train(){
        $objValues = Values::loadFromFile(self::NETWORK_VALUES_PATH);
        $this->network->setValues($objValues);
        
        $this->network->train();
        $this->network->saveToFile(self::NETWORK_PATH);
    }
    
    public function getImagePath(){
        if(!file_exists(self::NETWORK_IMAGE)){
            $objNetworkImage = new NetworkGraph($this->network);
            $objNetworkImage->saveToFile(self::NETWORK_IMAGE);
        }
        return self::NETWORK_IMAGE;
    }
    
    public function isTrainingComplete(){
        return $this->network->trained();
    }
    
    public function getInfo(){
        ob_start();
        $this->network->printNetwork();
        $return = ob_get_contents();
        ob_clean();
        
        return $return;
    }
    
    public function setValues($objValues){
        $this->network->setValues($objValues);
    }
    
    public function getOutputs(){
        return $this->network->getOutputs();
    }

}
