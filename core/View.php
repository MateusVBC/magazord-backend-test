<?php
namespace MateusVBC\Magazord_Backend\Core;

class View
{
    private array $column;
    private array $row;
    private String $view;

    public function render(): void {
        $file = dirname(__DIR__) . "/App/View/" . $this->getView() . '.html';
        echo str_replace('%%crate_table', $this->createTable(), file_get_contents($file));
    }

    private function createTable() {
        $htmlTable = '<table> <thead> <tr>';
        foreach ($this->getColumn() as $column) {
            $htmlTable .= '<th>' .$column. '</th>\n';
        }
        $htmlTable .= '</tr></thead>  <tbody><tr></tr></tbody>';
        return $htmlTable;
    }

    protected function getView() {
        if(isset($this->View)){
            return $this->View;
        }
        else if(isset($_SESSION['view'])) {
            $this->View = $_SESSION['view'];
            return $this->View;
        }
        else {
            $_SESSION['view'] = Config::DEFAULT_VIEW;
            $this->getView();
        }
    }

    public function getRow() : array {
        return $this->row;
    }

    public function getColumn() : array {
        return $this->column;
    }

    public function setView($view) : void {
        $this->view = $view;
    }

    public function setRow($row) : void {
        $this->row = $row;
    }

    public function setColumn($column) : void {
        $this->column = $column;
    }
}