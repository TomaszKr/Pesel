<?php

namespace Tests;

use TomaszKr\Pesel as Pesel;
use PHPUnit\Framework\TestCase;
use Exception;

/*
* @codeCoverageIgnore
*/
class PeselTest extends TestCase
{
    /**
     * @dataProvider invalidNumberDataProviderException
     * @param string $number
     */
    public function testException($number) : void
    {
        $this->expectException(Exception::class);

        $pesel = new Pesel($number);
    }
    /**
     * @dataProvider invalidNumberDataProvider
     * @param string $number
     */
    public function testIsValidReturnsFalseWhenNumberIsInvalid($number) : void
    {
        $pesel = new Pesel($number);
        $this->assertFalse($pesel->isCorrect());
    }
    
    /**
     * @dataProvider correctPesel
     * @param string $number
     */
    public function testIsValidReturnsTrueWhenNumberIsCorrect($number) : void
    {
        $pesel = new Pesel($number);
        
        $getPesel = $pesel->getNumber();
        $this->assertTrue($pesel->isCorrect());
        
        $this->assertEquals($getPesel,$pesel->getNumber());
        
        $this->assertInstanceOf(\DateTime::class,$pesel->getBirthday());
    }
    
    /**
     * @dataProvider futerPesel
     * @param string $number
     */
    public function testIsValidReturnsFalseWhenNumberIsInFutere($number) : void
    {
        $pesel = new Pesel($number);
        $this->assertFalse($pesel->isCorrectDateNow());
    }
    
    /**
     * @dataProvider correctPesel
     * @param string $number
     */
    public function testGender($number) : void
    {
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
    public function testMinAndMaxYear($number) : void
    {
        $pesel = new Pesel($number);

        $min = new \DateTime('1900-01-01');
        $max = new \DateTime('2030-12-31');

        $pesel
        ->setMinYear($min)
        ->setMaxYear($max);

        $this->assertFalse($pesel->isCorrectYear());
    }
    
    public static function invalidNumberDataProviderException() : array
    {
        return [
            [1234],
            ['1234'],
            ['aaaa'],
            ['aaaaaaaaaaa'],
            
        ];
    }
    public static function invalidNumberDataProvider() : array
    {
      return [
        ['96100612532'],
        ['61122500187'],
        ['78091501150'],
        ['00000000000'],
        ['11111111111'],
    ];
  }
    
    public static function correctPesel() : array
    {
        return [
            ["07241619910"],
            ["92062315954"],
            ["97080303491"],
            ["51040616540"],
            ["50880919415"],
            ["00921116660"],
            ["00280116406"],
            ["00851409494"],
            ["00012407325"]
        ];
    }
    
    public static function futerPesel() : array
    {
        return [
            ["04722615764"],
            ["85501212017"],
            ["92492415635"],
            ["04722615764"],
            ["00631107455"]
        ];
    }
}