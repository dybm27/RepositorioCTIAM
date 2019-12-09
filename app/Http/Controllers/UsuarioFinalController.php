<?php

namespace App\Http\Controllers;

use App\AudioVisual;
use App\Libro;
use App\Revista;
use App\Slider;
use Illuminate\Http\Request;
use \Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;

class UsuarioFinalController extends Controller
{
    public function index(){
        $sliders=Slider::query()->where('estado','visible')->get();
        return view('usuariofinal.inicio.index', compact('sliders'));
    }

    public function multimedia(){
        
        $libros=Libro::query()->where('estado','visible');
        $items=Revista::query()->where('estado','visible')
        ->union($libros)
        ->orderBy('created_at','desc') 
        ->get()->toArray();
     
        $results = $this->paginacion('page1',12,$items);

        $audiovisuales=AudioVisual::query()->where('estado','visible')
        ->orderBy('created_at','desc')
        ->get()->toArray();

        $videos=$this->paginacion( 'page2',8,$audiovisuales);
        
        return view('usuariofinal.multimedia.index', compact('results','videos'));
    }

    public function paginacion($pageN,$paginas,$array){
        $page = Input::get($pageN, 1);
        $paginate = $paginas;
    
        $offSet = ($page * $paginate) - $paginate;
        $itemsForCurrentPage = array_slice($array, $offSet, $paginate, true);
        return new LengthAwarePaginator($itemsForCurrentPage, count($array), $paginate, $page,
        ['path' => Paginator::resolveCurrentPath(),
        'pageName' => $pageN]);
    }

    public function multimediaLibros(){
        $libros=Libro::query()->where('estado','visible')
        ->orderBy('created_at','desc') 
        ->get()
        ->toArray();
       
        $results = $this->paginacion('page1',12,$libros);
        $tipo='libros';
        return view('usuariofinal.multimedia.index2', compact('results','tipo'));
    }

    public function multimediaRevistas(){
        $revistas=Revista::query()->where('estado','visible')
        ->orderBy('created_at','desc') 
        ->get()
        ->toArray();
       
        $results = $this->paginacion('page1',12,$revistas);
        $tipo='revistas';
        return view('usuariofinal.multimedia.index2', compact('results','tipo'));
    }
}
