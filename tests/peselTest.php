<?php

namespace Tests;

use Object\Pesel as Pesel;
use PHPUnit\Framework\TestCase;

/*
* @codeCoverageIgnore
*/
class PeselTest extends TestCase
{
    /**
     * @dataProvider invalidNumberDataProvider
     * @param string $number
     */
    public function testIsValidReturnsFalseWhenNumberIsInvalid($number)
    {
        $pesel = new Pesel($number);
        $this->assertFalse($pesel->isCorrect());
    }
    
    /**
     * @dataProvider correctPesel
     * @param string $number
     */
    public function testIsValidReturnsTrueWhenNumberIsCorrect($number)
    {
        $pesel = new Pesel($number);
        
        $getPesel = $pesel->getNumber();
        $this->assertTrue($pesel->isCorrect());
        
        $pesel->setNumber($number);
        
        $this->assertEquals($getPesel,$pesel->getNumber());
        
        $this->assertInstanceOf(\DateTime::class,$pesel->getBirthday());
    }
    
    /**
     * @dataProvider futerPesel()
     * @param string $number
     */
    public function testIsValidReturnsFalseWhenNumberIsInFutere($number)
    {
        $pesel = new Pesel($number);
        $this->assertFalse($pesel->isCorrectDateNow());
    }
    
    /**
     * @dataProvider correctPesel
     * @param string $number
     */
    public function testGender($number){
        $pesel = new Pesel($number);
        
        $man = "man";
        $woman = "woman";
        
        $pesel
            ->setTextForMan($man)
            ->setTextForWoman($woman);
        
        $this->assertEquals($man,$pesel->getTextForMan());
        $this->assertEquals($woman,$pesel->getTextForWoman());
        
        if($pesel->gender()){
            $this->assertEquals($man,$pesel->whatGender());
        }else{
            $this->assertEquals($woman,$pesel->whatGender());
        }
        
    }

    /**
     * @dataProvider futerPesel
     * @param string $number
     */
    public function testMinAndMaxYear($number){
        $pesel = new Pesel($number);

        $min = new \DateTime('1900-01-01');
        $max = new \DateTime('2020-01-01');

        $pesel
        ->setMinYear($min)
        ->setMaxYear($max);

        $this->assertFalse($pesel->isCorrectYear());
    }
    
    public function invalidNumberDataProvider()
    {
        return [
            [1234],
            ['1234'],
            ['aaaa'],
            ['11111111111'],
            ['aaaaaaaaaaa'],
            ['96100612532'],
            ['61122500187'],
            ['78091501150'],
            ['00000000000'],
        ];
    }
    
    public function correctPesel(){
        return [
            ["07241619910"],
            ["92062315954"],
            ["97080303491"],
            ["51040616540"],
            ["50880919415"],
            ["00921116660"]
        ];
    }
    
    public function futerPesel(){
        return [
            ["04722615764"],
            ["85501212017"],
            ["92492415635"],
            ["04722615764"]
        ];
    }
}