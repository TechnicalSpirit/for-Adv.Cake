<?php

namespace tests;

use ForAdvCake\Reverator;
use PHPUnit\Framework\TestCase;

final class ReveratorTest extends TestCase
{
    public function test_letter_case(): void
    {
        $reverator = new Reverator();
        $reversWord = $reverator->revertCharacters("Bba");
        $expected = "Abb";

        $this->assertEquals($expected,$reversWord);
    }

    public function test_commas(): void
    {
        $reverator = new Reverator();
        $reversWord = $reverator->revertCharacters("Bba, Fg,");
        $expected = "Abb, Gf,";

        $this->assertEquals($expected,$reversWord);
    }

    public function test_points(): void
    {
        $reverator = new Reverator();
        $reversWord = $reverator->revertCharacters("Bba. a");
        $expected = "Abb. a";

        $this->assertEquals($expected,$reversWord);
    }

    public function test_points_2(): void
    {
        $reverator = new Reverator();
        $reversWord = $reverator->revertCharacters("Bba.bBa.bbA");
        $expected = "Abb.aBb.abB";

        $this->assertEquals($expected,$reversWord);
    }

    public function test_final(): void
    {
        $reverator = new Reverator();
        $reversWord = $reverator->revertCharacters("Привет! Давно не виделись.");
        $expected = "Тевирп! Онвад ен ьсиледив.";

        $this->assertEquals($expected,$reversWord);
    }
}

