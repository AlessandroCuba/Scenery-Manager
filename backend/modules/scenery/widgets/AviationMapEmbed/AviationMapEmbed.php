<?php

/**
 * @copyright Copyright &copy; Manuel Gonzalez Prieto, 2017
 * @package yii2-AviationMapEmbed-widget
 * @version 1.0.0
 */

/*
 * @var string $classContainer
 * @var string $idContainer 
 * @var integer $witdhContainer 
 * @var integer $heightContainer
 * 
 */

namespace backend\modules\scenery\widgets\AviationMapEmbed;

use yii\base\Widget;
use yii\helpers\Html;
use yii\base\InvalidParamException;

class AviationMapEmbed extends Widget{
    
    public $latitude;   
    public $longitude;  
    public $zoomMap = 3;
    public $class = '';
        
    public $divId;
    public $myId = 'sm_0587';
    
    const URL_SKYVECTOR = 'http://skyvector.com/api/lchart?';
    const HEIHGT = 200;
    const IMG_FLUID = 'img-fluid';
    
    /* ====== Type Maps Constant*/
    const VFR_SEC = 'v';   // VFR Sectional
    const VFR_TAC = 't';   // VFR TAC
    const IFR_LOW = 'l';   // IFR Low Enroute
    const IFR_HIGH = 'h';  // IFR High Enroute
    const IFR_AREA = 'a';  // IFR area
    const HELI = 'c';      // Heli
    
    public $typeMap = self::VFR_SEC;
    
    public function init() {
        parent::init();
        if (empty($this->latitude) && empty($this->longitude)){
            if(isset($this->latitude) && isset($this->longitude)){
                throw new InvalidParamException("The longitude ({$this->longitude}) or latitude ({$this->latitude}) are empty or null.");
        }}
        if($this->zoomMap < 1 || $this->zoomMap >10){
            throw new InvalidParamException("The Zoom have to be between 1 and 10");
        }
    }
    
    public function run() {
        
        $classContainer = (empty($this->class) && isset($this->class)) ? self::IMG_FLUID : $this->class ;
        $idContainer    = (empty($this->divId) && isset($this->divId)) ? $this->divId : $this->myId;
        
        switch ($this->typeMap) {
            case self::VFR_SEC:
                $nameMap = 'VFR Sectional';
            break;
            case self::VFR_TAC:
                $nameMap = 'VFR TAC';
            break;
            case self::IFR_HIGH:
                $nameMap = 'IFR High Altitude';
            break;
            case self::IFR_LOW:
                $nameMap = 'IFR Low Altitude';
            break;
            case self::IFR_AREA:
                $nameMap = 'IFR Area';
            break;
            case self::HELI:
                $nameMap = 'Helic Map';
            break;
        }
        
        return $this->render('view', [
            'divId'             => $idContainer,
            'classContainer'    => $classContainer,
            'idContainer'       => $idContainer,
            'zoomMap'           => $this->zoomMap,
            'typeMap'           => $this->typeMap,
            'nameMap'           => $nameMap,
        ]);
    }
}