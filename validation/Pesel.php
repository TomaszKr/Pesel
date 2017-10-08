<?php

namespace Validation;

/**
 * PESEL
 * 
 * @author Tomasz Król <tomasz46@gmail.com>
 */
class Pesel
{
    /**
     * Max lenght in PESEL
     */
    CONST MAX_LENGHT = 11; 
    
    /**
     * WEIGHT for position in PESEL
     */
    CONST WEIGHTS = [1, 3, 7, 9, 1, 3, 7, 9, 1, 3, 1];
    
    /**
     * Return points for set gender
     */
    CONST MAN = 1;
    CONST WOMAN = 0;
    
    /**
     * Text for gender MAN
     *
     * @var string
     */
    private $man = "Man";
    
    /**
     * Text for gender WOMAN
     *
     * @var string
     */
    private $woman = "Woman";
    
    /**
     * Number Pesel
     *
     * @var int
     */
    private $number;
    
    /**
     * Constructor
     * 
     * @param string $number        Number "Pesel"
     */
    public function __construct(string $number){
        $this->number = $number;
    }
    
    /**
     * Check is it correct
     * 
     * @see Pesel::isCorrectLenght()
     * @see Pesel::isCorrectNumber()
     * @see Pesel::isCorrectDataNow()
     * @see Pesel::valid()
     * 
     * @return bool
     */
    public function isCorrect() : bool
    {
        return $this->isCorrectLenght() 
                && $this->isCorrectNumber() 
                && $this->isCorrectDateNow()
                ? $this->valid() : false;
    }
    
    /**
     * Valid correct "PESEL"
     *
     * @return bool
     */
    public function valid() : bool
    {
        $sum = 0;
           foreach(self::WEIGHTS as $key=>$val){
               $sum += $val * $this->number[$key];
           }
        $mod = $sum % 10;
        return $mod == 0 && $sum>0;
    }
        
    /**
     * Valid correct lenght
     *
     * @return bool
     */
    public function isCorrectLenght() : bool
    {
        return self::MAX_LENGHT == strlen($this->number);
    }
    
    /**
     * Valid is it only number
     *
     * @return bool
     */
    public function isCorrectNumber() : bool
    {
        return ctype_digit($this->number);
    }
    
    /**
     * Valid is not future pesel
     *
     * @return bool
     */
    public function isCorrectDateNow() : bool
    {
        return (new \DateTime()) > $this->getBirthday();
    }
    
    /**
     * Get birthday in correct "Pesel"
     * 
     * @return \DateTime
     */
    public function getBirthday() : \DateTime
    {
        $year = $this->getYear();
        $month = $this->getMonth();
        $day =  $this->number[4].$this->number[5];   
        
        return new \DateTime($year."-".$month."-".$day);
    }
    
    /**
     * Get month in correct "Pesel"
     *
     * @return string
     */
    private function getMonth() : string
    {    
        $isPass = $this->number[2] % 2 == 0;
        if($isPass){
            return "0".$this->number[3];
        }else{
            return "1".$this->number[3];
        }
    }
    
    /**
     * Get year
     * 
     * @return string
     */
    private function getYear() : string
    {
        $year = 0000;
        switch($this->number[2]){
            case 0:
            case 1:
                $year = 1900;
                break;
            case 2:
            case 3:
                $year = 2000;
                break;    
            case 4:
            case 5:
                $year = 2100;
                break;
            case 6:
            case 7:
                $year = 2200;
                break;
            case 8:
            case 9:
                $year = 1800;
                break;
        }
        
        return $year + ($this->number[0].$this->number[1]);
    }
    
    /**
     * Set number "Pesel"
     *
     * @param string $number
     * @return Pesel
     */
    public function setNumber($number) : Pesel
    {
        $this->number = $number;
        
        return $this;
    }
    
    /**
     * Get number "Pesel"
     *
     * @return int
     */
    public function getNumber() : int
    {
        return $this->number;
    }

    /**
     * Set text that will be geneder MAN
     *
     * @param [type] $man
     * @return Pesel
     */
    public function setTextForMan($man) : Pesel
    {
        $this->man = $man;
        
        return $this;
    }

    /**
     * Set text that will be gender WOMAN
     *
     * @param [type] $woman
     * @return Pesel
     */
    public function setTextForWoman($woman) : Pesel
    {
        $this->woman = $woman;
        
        return $this;
    }

    /**
     * Get text gender MAN
     *
     * @return string
     */
    public function getTextForMan() : string
    {
        return $this->man;
    }

    /**
     * Get text gender WOMAN
     *
     * @return string
     */
    public function getTextForWoman() : string
    {
        return $this->woman;
    }

    /**
     * Return gender for int
     * 
     * 0 = WOMAN
     * 1 = MAN
     *
     * @return int
     */
    public function gender() : int
    {
        return $this->number[9] % 2 == self::MAN? self::MAN : self::WOMAN;
    }
    
    /**
     * Return gender for text that will be MAN or WOMAN
     * 
     * @see PESEL::gender()
     *
     * @return string
     */
    public function whatGender() : string
    {
        return $this->gender()? $this->man : $this->woman;
    }
    
}
