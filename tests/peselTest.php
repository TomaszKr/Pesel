<?php

namespace Tests;

use TomaszKr\Pesel as Pesel;
use PHPUnit\Framework\TestCase;
use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\Attributes\CodeCoverageIgnore;
use Exception;

#[CodeCoverageIgnore]
class PeselTest extends TestCase
{
    #[DataProvider('invalidNumberDataProviderException')]
    public function testException(string|int $number) : void
    {
        $this->expectException(Exception::class);

        $pesel = new Pesel($number);
    }

    #[DataProvider('invalidNumberDataProvider')]
    public function testIsValidReturnsFalseWhenNumberIsInvalid(string $number) : void
    {
        $pesel = new Pesel($number);
        $this->assertFalse($pesel->isCorrect());
    }

    #[DataProvider('correctPesel')]
    public function testIsValidReturnsTrueWhenNumberIsCorrect(string $number) : void
    {
        $pesel = new Pesel($number);

        $getPesel = $pesel->getNumber();
        $this->assertTrue($pesel->isCorrect());

        $this->assertSame($getPesel, $pesel->getNumber());

        $this->assertInstanceOf(\DateTime::class, $pesel->getBirthday());
    }

    #[DataProvider('futerPesel')]
    public function testIsValidReturnsFalseWhenNumberIsInFutere(string $number) : void
    {
        $pesel = new Pesel($number);
        $this->assertFalse($pesel->isCorrectDateNow());
    }

    #[DataProvider('correctPesel')]
    public function testGender(string $number) : void
    {
        $pesel = new Pesel($number);

        $man = "man";
        $woman = "woman";

        $pesel
            ->setTextForMan($man)
            ->setTextForWoman($woman);

        $this->assertSame($man, $pesel->getTextForMan());
        $this->assertSame($woman, $pesel->getTextForWoman());

        if ($pesel->gender()) {
            $this->assertSame($man, $pesel->whatGender());
        } else {
            $this->assertSame($woman, $pesel->whatGender());
        }
    }

    #[DataProvider('futerPesel')]
    public function testMinAndMaxYear(string $number) : void
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
