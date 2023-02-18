<?php

namespace TomaszKr;

use DateTime;

/**
 * PESEL
 * 
 * @author Tomasz Król <tomasz46@gmail.com>
 */
final class Pesel
{
    /**
     * Max lenght in PESEL
     * @var integer 
     */
    private const MAX_LENGHT = 11; 
    
    /**
     * WEIGHT for position in PESEL
     * @var array
     */
    private const WEIGHTS = [1, 3, 7, 9, 1, 3, 7, 9, 1, 3, 1];
    
    /**
     * Return points for set gender
     */
    private const MAN = 1;
    private const WOMAN = 0;
    
    /**
    * All years that maybe it used
    * @var array
    */
    private const YEAR = [
                  '1900',
                  '2000',
                  '2100',
                  '2200',
                  '1800'
                ];
    
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
     * Minimum year
     *
     * @var DateTime
     */
    private $minYear;

    /**
     * Maximum year
     *
     * @var DateTime
     */
    private $maxYear;
    

    public function __construct(
        private readonly string $number
    )
    {
        $this->minYear = new DateTime('1800-01-01');
        $this->maxYear = new DateTime();
        
        if(!$this->isCorrectLenght()){
          throw new \Exception("Incorrect lenght", 1);
        }
        
        if(!$this->isCorrectNumber() ){
          throw new \Exception("Must be only number", 1);
        }
    }
    
    /**
     * Check is it correct
     * 
     * @see Pesel::isCorrectLenght()
     * @see Pesel::isCorrectNumber()
     * @see Pesel::valid()
     * 
     * @return bool
     */
    public function isCorrect() : bool
    {
        return $this->valid();
    }
    
    /**
     * Valid correct "PESEL"
     *
     * @return bool
     */
    private function valid() : bool
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
        return (new DateTime()) > $this->getBirthday();
    }
    
    /**
     * Get birthday in correct "Pesel"
     * 
     * @return DateTime
     */
    public function getBirthday() : DateTime
    {
        $year = $this->getYear();
        $month = $this->getMonth();
        $day =  $this->number[4].$this->number[5];   
        
        return new DateTime($year."-".$month."-".$day);
    }
    
    /**
     * Get month in correct "Pesel"
     *
     * @return string
     */
    private function getMonth() : string
    {    
        return ($this->number[2] % 2).$this->number[3];
    }
    
    /**
     * Get year
     * 
     * @return string
     */
    private function getYear() : string
    {
        return self::YEAR[floor($this->number[2]/2)] + ($this->number[0].$this->number[1]);
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
     * @param string $man
     * @return Pesel
     */
    public function setTextForMan(string $man) : Pesel
    {
        $this->man = $man;
        
        return $this;
    }

    /**
     * Set text that will be gender WOMAN
     *
     * @param string $woman
     * @return Pesel
     */
    public function setTextForWoman(string $woman) : Pesel
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

    /**
     * Set maximum year
     *
     * @param DateTime $dateTime
     * @return Pesel
     */
    public function setMaxYear(DateTime $dateTime) : Pesel
    {
        $this->maxYear = $dateTime;
        return $this;
    }
    
    /**
     * Set minimum year
     *
     * @param DateTime $dateTime
     * @return Pesel
     */
    public function setMinYear(DateTime $dateTime) : Pesel
    {
        $this->minYear = $dateTime;
        return $this;
    }
    
    /**
     * Check correct year between min and max
     *
     * @return bool
     */
    public function isCorrectYear() : bool
    {
        return $this->minYear < $this->getBirthday() && $this->getBirthday() < $this->maxYear; 
    }
    
}
