<?php

namespace App\View\Components;

use App\Models\Def;
use App\Models\Rol;
use App\Models\User;
use Illuminate\View\Component;
use Lang;

class Select extends Component
{
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct(
        public string $table,               // Tabla a buscar
        public string $name = '',          // Name
        public string $val = '',          // Item Seleccionado (si son varios son separados por ,)
        public string $conds = '',        // Multiples separado por ||
        public string $class = '',          // Classes extra
        public bool $req = false,         // Si es o no requerido
        public string $null = '',         // Valor nulo
        public bool $multiple = false,    // Multiple
        public int $start = 0,                // Inicio de la iteracion
        public int $end = 0,                // Fin de la iteracion
        public string $langPref = '',       // Prefijo del lang
        public bool $disabled = false,         // Si es o no disabled
        ){
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        $data = [];
        $id = 'id';
        $mSel = [];
        $showTxt = 'selectName';
        $extraData = [];
        switch($this->table){
            case "users": 
                $data = User::all();
                break;
            case "roles": 
                $data = Rol::all();
                break;
            case "lang":
                $data = [];
                for($i = $this->start; $i <= $this->end; $i++) $data[] = new Def(["name" => Lang::get('select.'.$this->langPref.'.'.$i), "id" => $i]);
                break;
            case "numbers":
                $data = [];
                for($i = $this->start; $i <= $this->end; $i++) $data[] = new Def(["name" => $i, "id" => $i]);
                break;
        }

        if ($this->multiple) $mSel = explode(',', $this->val); 
        
        return view('cms.components.select', ['data' => $data, 'id' => $id, 'showTxt' => $showTxt, 'mSel' => $mSel, 'extraData' => $extraData]);
    }
}
