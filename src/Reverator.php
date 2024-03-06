<?php

namespace ForAdvCake;

use InvalidArgumentException;

final class Reverator
{
    public function revertCharacters(string $word):string
    {
        $lowerWord = $this->makeLower($word);
        $separatedWords =  $this->splitBySpace($word);
        $lowerWords =  $this->splitBySpace($lowerWord);

        $reversWords = [];
        for($word_count = 0;$word_count < count($lowerWords); $word_count++)
        {
            $reversWords[] = $this->reversWord(
                $this->splitByLetters($separatedWords[$word_count]),
                $this->splitByLetters($lowerWords[$word_count]));
        }

        return rtrim(implode($reversWords));
    }

    private function reversWord(array $current_word, array $current_word_by_letters): string
    {
        $reversWord = $this->reversLetters($current_word,
            $current_word_by_letters);
        return $reversWord;
    }

    private function reversLetters(array $originalWordLetters, array $lowerWordLetters):string
    {
        $subWord = [];
        for($index = 0; $index < count($lowerWordLetters); $index++)
        {
            if($this->isPunctuation($lowerWordLetters[$index]))
            {
                $reversLetters = array_reverse($subWord);
                $saveWordLetters = $this->saveRegister($originalWordLetters,
                    $reversLetters );

                $subOriginalWord = array_slice($originalWordLetters,
                    $index+1,
                    count($originalWordLetters) - count($reversLetters));

                $subWordLetters = array_slice($lowerWordLetters,
                    $index+1,
                    count($lowerWordLetters) - count($reversLetters));

                $word = implode($saveWordLetters);
                $punctuation = $lowerWordLetters[$index];
                $sub_word = $this->reversLetters($subOriginalWord,$subWordLetters);

                return $word.$punctuation.$sub_word;
            }
            $subWord[] = $lowerWordLetters[$index];
        }
        $reversLetters = array_reverse($subWord);
        $lowerWordLetters = $this->saveRegister($originalWordLetters,
            $reversLetters );

        $reversWord = implode($lowerWordLetters);

        return $reversWord. " ";
    }

    private function saveRegister(array $word,array $reversWord):array
    {
        for($index = 0;$index < count($reversWord);$index++)
        {
            if(!$this->isLowerLetter($word[$index]))
            {
                $reversWord[$index] = $this->makeBig($reversWord[$index]);
            }
        }
        return $reversWord;
    }

    private function makeBig(string $word):string
    {
        return mb_convert_case($word, MB_CASE_TITLE, 'UTF-8');
    }

    private function makeLower(string $word):string
    {
        return mb_strtolower($word, "UTF-8");
    }
    private function isLowerLetter(string $letter) : bool {
        $lowerLetter = mb_strtolower($letter, "UTF-8");
        return $letter === $lowerLetter;
    }

    private function splitByLetters(string $word): array
    {
        return mb_str_split($word, 1, 'UTF-8');
    }

    private function splitBySpace(string $word): array
    {
        return explode(' ', $word);
    }

    private function isPunctuation($letter): bool {
        return preg_match('/[\p{P}]/u', $letter);;
    }
}