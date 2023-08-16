<?php
namespace MateusVBC\Magazord_Backend\Core;

class View
{
    private array $column;
    private array $row = ['colunas' => [], 'valores' => []];
    private string $view;

    public function render(): void
    {
        $html = file_get_contents(dirname(__DIR__) . "/App/View/" . $this->getView() . '.phtml');
        if (str_contains($html, '%%create_table')) {
            $html = str_replace('%%create_table', $this->tableBuilder(), $html);
        }
        echo $html;
    }

    /**
     * Cria o html geral da tabela
     */
    private function tableBuilder()
    {
        $htmlTable = '<table> <thead> <tr>';
        foreach ($this->getColumn() as $column) {
            $htmlTable .= '<th>' . $column . '</th>';
        }
        $htmlTable .= '<th> Ações </th>';
        $htmlTable .= '</tr></thead>';

        $htmlTable .= $this->tableBodyBuilder();

        return $htmlTable;
    }

    /**
     * Contrói o corpo da tabela
     */
    private function tableBodyBuilder(): string
    {
        $htmlBody = '';

        $aText = fn($id, $name) =>
            '<a'
            . ' name = "'.$name.'"'
            . ' onclick=";'
            . ' if (' . $id . ' == ' . 'window.value || window.value == 0) {'
            . ' var input = document.createElement(\'input\');'
            . ' input.setAttribute(\'value\', this.firstChild.nodeValue);'
            . ' input.setAttribute(\'name\', this.getAttribute(\'name\'));'
            . ' this.parentNode.replaceChild(input, this);'
            . 'showButton(' . $id . ');}">';

        foreach ($this->getRow() as $row) {
            $htmlBodyValues = '';
            $emptyValue = false;
            foreach ($row as $column => $value) {
                $emptyValue = empty($value) || $emptyValue;
                $htmlBodyValues .= '<td> ' 
                    . ($column != 'id' ? $aText($row['id'], $column) : '') #Valida se é o Id, se for, não permite que vire um campo de texto ao clicar
                    . (!empty($value) ? $value : 'Desconhecido')
                    . '</a> </td>';
            }
            $htmlBodyValues .= '<td> ' . $this->getActionsRow($row) . '</td>';
            $htmlBody .= '<tr' . ($emptyValue ? ' class="disabled"' : '') . '>';
            $htmlBody .= $htmlBodyValues;
            $htmlBody .= '</tr>';
        }
        return $htmlBody;
    }

    protected function getActionsRow($row): string
    {
        $updateInputHtml = fn($name, $value) =>
            '<input'
            . ' type="hidden"'
            . ' name="' . $name . '"'
            . ' value="' . $value . '"'
            . '>';

        $actionsRow = '';
        foreach (Config::OPTIONS_COLUMNS as $value) {
            $actionsRow .= str_replace('?id?', $row['id'], $value);
        }
        return $actionsRow;
    }

    protected function getView()
    {
        $Session = new Session();
        if (isset($this->view)) {
            return $this->view;
        } else if ($Session->get('view')) {
            $this->view = $Session->get('view');
            return $this->view;
        } else {
            $Session->set('view', Config::DEFAULT_VIEW);
            $this->getView();
        }
    }

    public function getRow(): array
    {
        return $this->row;
    }

    public function getColumn(): array
    {
        return $this->column;
    }

    public function setView($view): void
    {
        $this->view = $view;
    }

    public function setRow($row): void
    {
        $this->row = $row;
    }

    public function setColumn($column): void
    {
        $this->column = $column;
    }
}