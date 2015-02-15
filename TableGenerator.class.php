<?php
// generates HTML table based on PHP array
class TableGenerator 
{
    private $_html = '';
    private $_array;
    private $_rows;
    private $_cols;
    public function __construct($array, $rows, $cols) {
        $this->_rows = $rows;
        $this->_cols = $cols;
        $this->_array = $array;
        $this->_html .= '<table>';
        for ($i = 0; $i < $rows; $i++)
        {
            $this->_html .= $this->generateRowHTML($i);
        }
        $this->_html .= '</table>';
    }
    
    public function getHTML() {
        return $this->_html;
    }
    
    private function generateRowHTML($rowNumber)
    {
        $output = '<tr>';
        for ($i = 0; $i < $this->_cols; $i++)
        {
            $output .= '<td>'.$this->_array[$rowNumber][$i].'</td>';
        }
        $output .= '</tr>';
        return $output;
    }
}
?>