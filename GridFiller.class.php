<?php
// todo: snaking puzzles
class GridFiller
{
    private $_grid;
    private $_rows;
    private $_cols;
    private $_words;
    private $_numberOfWords;
    
    public function __construct($words, $rows, $cols)
    {
        // rows & cols must be positive integers - TODO verification
        // $words must be an array (or not?)
        $this->_rows = $rows;
        $this->_cols = $cols;
        $this->_numberOfWords = count($words);
        $this->_words = $words;
        
        $this->generateEmptyGrid();
        $this->insertWords();
        $this->fillGridWithRandomLetters();
    }
    public function getGrid()
    {
        //$rows = 5;
        //$cols = 5;
        //if ($this->isCellEmpty(2, 3)) echo "CELL IS EMPTY! HELP";
        //else echo "CELL IS FILLED! LOL";
        //$this->fillGridWithRandomLetters();
        //echo '<pre>';
        //print_r($this->_grid);
        //echo '</pre>';
        return $this->_grid;
    }
    
    private function insertWords()
    {
        // na razie tylko pionowo i poziomo
        foreach ($this->_words as $word)
        {
            // 1. losuj pole startowe
            // 2. losuj tryb 
            // 3. ustaw slowo zgodnie z trybem
            // ROZBUDOWAC IS CELL EMPTY o to zeby sprawdzala czy literka ok
            while(!$this->putWord($word)) {} 
        }
    }
    
    private function putWord($word, $setting = 2)
    {
        $setting = mt_rand(1, 2);
        $row = mt_rand(0, $this->_rows - 1);
        $col = mt_rand(0, $this->_cols - 1);
        $len = strlen($word);
        switch ($setting)
        {
            case 1: // poziomo-prawo
                if ($len <= $this->_cols - $col and $this->isLineEmpty($row, $col, $len, 2))
                {
                    for ($i = $col; $i < $col + $len; $i++)
                    {
                        $j = $i - $col;
                        $this->_grid[$row][$i] = $word[$j];
                    }
                    return true;
                }
                break;
            // pionowo
            case 2:
                if ($len <= $this->_rows - $row and $this->isLineEmpty($row, $col, $len, 3))
                {
                    for ($i = $row; $i < $row + $len; $i++)
                    {
                        $j = $i - $row;
                        $this->_grid[$i][$col] = $word[$j];
                    }
                    return true;
                }
                break;
        }
        return false; // nie udalo sie umiescic slowa
    }
    
    private function isCellEmpty($row, $col)
    {
        if ($this->_grid[$row][$col])
            return false;
        else
            return true;
    }
    
    private function isLineEmpty($row, $col, $len, $dir)
    {
        // TODO: Ukosne i wspaki!
        // zgodnie z zegarem: gora- 1, prawo - 2, dol - 3, lewo - 4.
        switch ($dir)
        {
            /*case 1: // pionowo-gora (wspak)
                for ($i = $row; $i < $row + $len; $i++)
                {
                    if (!$this->isCellEmpty($i, $col)) return false;
                }
                break;*/
            case 2: // poziomo-prawo
                for ($i = $col; $i < $col + $len; $i++)
                {
                    if (!$this->isCellEmpty($row, $i)) return false;
                }
                break;
            case 3: // pionowo-dol
                for ($i = $row; $i < $row + $len; $i++)
                {
                    if (!$this->isCellEmpty($i, $col)) return false;
                }
                break;
            /*case 4: // poziomo-lewo (wspak)
                for ($i = $col; $i < $col + $len; $i++)
                {
                    if (!$this->isCellEmpty($row, $i)) return false;
                }
                break;*/
        }
        return true;
    }
    
    private function generateEmptyGrid()
    {
        $this->_grid = array();
        for ($i = 0; $i < $this->_rows; $i++)
        {
            $this->_grid[] = array_fill(0, $this->_cols, NULL);
        }
    }
    
    private function fillGridWithRandomLetters()
    {
        for ($i = 0; $i < $this->_rows; $i++)
        {
            for ($j = 0; $j < $this->_cols; $j++)
            {
                if ($this->isCellEmpty($i, $j))
                    $this->_grid[$i][$j] = $this->randomizeLetter();
            }
        }
    }
    
    private function randomizeLetter()
    {
        $letters = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $max = strlen($letters) - 1;
        $n = mt_rand(0, $max);
        return $letters[$n];
    }
}
?>