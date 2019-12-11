<?php

namespace App\Http\Controllers;

use App\InicioSesion;
use App\TipoUsuario;
use App\User;
use App\VistasDescargasLibros;
use App\VistasDescargasRevistas;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class EstadisticasController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function indexUsuarios()
    {   
        $año=date("Y");
        $mes=date("m");
     
        $años=[
        "0" => "2018",
        "1" => "2019",
        "2" => "2020",
        "3" => "2021",
        "4" => "2022"
        ];
        $meses=[
            "1" =>["num" =>"1","nom" =>"ENERO"],
            "2" =>["num" =>"2","nom" =>"FEBRERO"],
            "3" =>["num" =>"3","nom" =>"MARZO"],
            "4" =>["num" =>"4","nom" =>"ABRIL"],
            "5" =>["num" =>"5","nom" =>"MAYO"],
            "6" =>["num" =>"6","nom" =>"JUNIO"],
            "7" =>["num" =>"7","nom" =>"JULIO"],
            "8" =>["num" =>"8","nom" =>"AGOSTO"],
            "9" =>["num" =>"9","nom" =>"SEPTIEMBRE"],
            "10" =>["num" =>"10","nom" =>"OCTUBRE"],
            "11" =>["num" =>"11","nom" =>"NOVIEMBRE"],
            "12" =>["num" =>"12","nom" =>"DICIEMBRE"]
        ];
        return view('theme.estadisticas.usuarios',compact('año','mes','años','meses'));
    }

    public function getUltimoDiaMes($año,$mes){
        return date("d",(mktime(0,0,0,$mes+1,1,$año)-1));
    }

    public function getUsuarios($año,$mes){
        $primer_dia=1;
        if($mes==0){
            $ultimo_dia=$this->getUltimoDiaMes($año,12);
            $fecha_inicial=date("Y-m-d H:i:s", strtotime($año."-1-".$primer_dia) );
            $fecha_final=date("Y-m-d H:i:s", strtotime($año."-12-".$ultimo_dia) );
            return User::whereBetween('created_at', [$fecha_inicial,  $fecha_final])->where('is_admin','0')->get();
        }else{
            $ultimo_dia=$this->getUltimoDiaMes($año,$mes);
            $fecha_inicial=date("Y-m-d H:i:s", strtotime($año."-".$mes."-".$primer_dia) );
            $fecha_final=date("Y-m-d H:i:s", strtotime($año."-".$mes."-".$ultimo_dia) );
            return User::whereBetween('created_at', [$fecha_inicial,  $fecha_final])->where('is_admin','0')->get();
        }
    }

    public function registros_mes($año,$mes)
    {
        $usuarios=$this->getUsuarios($año,$mes);
        
        if ($mes==0) {
            for($m=1;$m<=12;$m++){
                $registros[$m]=0;     
            }
            foreach($usuarios as $usuario){
            $mesU=intval(date("m",strtotime($usuario->created_at) ) );
            $registros[$mesU]++;    
            }
            $data=array("totaldias"=>"12", "registrosdia" =>$registros);
        }else{  
            $ultimo_dia=$this->getUltimoDiaMes($año,$mes);
            for($d=1;$d<=$ultimo_dia;$d++){
                $registros[$d]=0;     
            }
            foreach($usuarios as $usuario){
            $diasel=intval(date("d",strtotime($usuario->created_at) ) );
            $registros[$diasel]++;    
            }
            $data=array("totaldias"=>$ultimo_dia, "registrosdia" =>$registros);
        }

        return   json_encode($data);
    }

    public function registrosTipo_mes($año,$mes){
        $usuarios=$this->getUsuarios($año,$mes);
        $tipos=TipoUsuario::orderBy('id')->get();
        $numtipos=count($tipos);

        foreach($tipos as $tipo){
            $arregloTipos[$tipo->nombre]=0;
        }

        foreach($usuarios as $usuario){
            $tipo=$usuario->tipousuario->nombre;
            $arregloTipos[$tipo]++;
        }

        $data=array("cantTipos"=>$numtipos,"tipos"=>$tipos,"registrospormes" =>$arregloTipos);
        return   json_encode($data);
    }

    public function inicioSesionTipo($año,$mes){
        $sesiones=$this->getSesiones($año,$mes);
        $tipos=TipoUsuario::orderBy('id')->get();
        $numtipos=count($tipos);

        foreach($tipos as $tipo){
            $arregloTipos[$tipo->nombre]=0;
        }

        foreach($sesiones as $sesion){
            $tipo=$sesion->tipouser;
            $arregloTipos[$tipo]++;
        }

        $data=array("cantTipos"=>$numtipos,"tipos"=>$tipos,"registrospormes" =>$arregloTipos);
        return   json_encode($data);
    }

    public function getSesiones($año,$mes){
        $primer_dia=1;
        if($mes==0){
            $ultimo_dia=$this->getUltimoDiaMes($año,12);
            $fecha_inicial=date("Y-m-d H:i:s", strtotime($año."-1-".$primer_dia) );
            $fecha_final=date("Y-m-d H:i:s", strtotime($año."-12-".$ultimo_dia) );
            return InicioSesion::whereBetween('created_at', [$fecha_inicial,  $fecha_final])->get();
        }else{
            $ultimo_dia=$this->getUltimoDiaMes($año,$mes);
            $fecha_inicial=date("Y-m-d H:i:s", strtotime($año."-".$mes."-".$primer_dia) );
            $fecha_final=date("Y-m-d H:i:s", strtotime($año."-".$mes."-".$ultimo_dia) );
            return InicioSesion::whereBetween('created_at', [$fecha_inicial,  $fecha_final])->get();
        }
    }

    //----------------------ARCHVIOS---------------------------------------------------------

    public function indexArchivos()
    {   
        $año=date("Y");
        $mes=date("m");
        $años=[
        "0" => "2018",
        "1" => "2019",
        "2" => "2020",
        "3" => "2021",
        "4" => "2022"
        ];
        $meses=[
            "1" =>["num" =>"1","nom" =>"ENERO"],
            "2" =>["num" =>"2","nom" =>"FEBRERO"],
            "3" =>["num" =>"3","nom" =>"MARZO"],
            "4" =>["num" =>"4","nom" =>"ABRIL"],
            "5" =>["num" =>"5","nom" =>"MAYO"],
            "6" =>["num" =>"6","nom" =>"JUNIO"],
            "7" =>["num" =>"7","nom" =>"JULIO"],
            "8" =>["num" =>"8","nom" =>"AGOSTO"],
            "9" =>["num" =>"9","nom" =>"SEPTIEMBRE"],
            "10" =>["num" =>"10","nom" =>"OCTUBRE"],
            "11" =>["num" =>"11","nom" =>"NOVIEMBRE"],
            "12" =>["num" =>"12","nom" =>"DICIEMBRE"]
        ];
        return view('theme.estadisticas.archivos',compact('año','mes','años','meses'));
    }

    public function visitas_mes($año,$mes){
        
        $libros=$this->getLibros($año,$mes,'visitas',0);
        $revistas=$this->getRevistas($año,$mes,'visitas',0);
        
        if ($mes==0) {
            for($m=1;$m<=12;$m++){
                $registrosLibros[$m]=0; 
                $registrosRevistas[$m]=0;     
            }
            foreach($libros as $libro){
                $mesU=intval(date("m",strtotime($libro->created_at) ) );
                $registrosLibros[$mesU]++;    
            }
            foreach($revistas as $revista){
                $mesU=intval(date("m",strtotime($revista->created_at) ) );
                $registrosRevistas[$mesU]++;    
            }
            $data=array("totaldias"=>"12", "registrosLibros" =>$registrosLibros,
            "registrosRevistas" =>$registrosRevistas);
        }else{  
            $ultimo_dia=$this->getUltimoDiaMes($año,$mes);
            for($d=1;$d<=$ultimo_dia;$d++){
                $registrosLibros[$d]=0; 
                $registrosRevistas[$d]=0;        
            }
            foreach($libros as $libro){
                $mesU=intval(date("d",strtotime($libro->created_at) ) );
                $registrosLibros[$mesU]++;    
            }
            foreach($revistas as $revista){
                $mesU=intval(date("d",strtotime($revista->created_at) ) );
                $registrosRevistas[$mesU]++;    
            }
            $data=array("totaldias"=>$ultimo_dia, "registrosLibros" =>$registrosLibros,
            "registrosRevistas" =>$registrosRevistas);
        }

        return   json_encode($data);
    }

    public function descargas_mes($año,$mes){
        
        $libros=$this->getLibros($año,$mes,'descargas',0);
        $revistas=$this->getRevistas($año,$mes,'descargas',0);
        
        if ($mes==0) {
            for($m=1;$m<=12;$m++){
                $registrosLibros[$m]=0; 
                $registrosRevistas[$m]=0;     
            }
            foreach($libros as $libro){
                $mesU=intval(date("m",strtotime($libro->created_at) ) );
                $registrosLibros[$mesU]++;    
            }
            foreach($revistas as $revista){
                $mesU=intval(date("m",strtotime($revista->created_at) ) );
                $registrosRevistas[$mesU]++;    
            }
            $data=array("totaldias"=>"12", "registrosLibros" =>$registrosLibros,
            "registrosRevistas" =>$registrosRevistas);
        }else{  
            $ultimo_dia=$this->getUltimoDiaMes($año,$mes);
            for($d=1;$d<=$ultimo_dia;$d++){
                $registrosLibros[$d]=0; 
                $registrosRevistas[$d]=0;        
            }
            foreach($libros as $libro){
                $mesU=intval(date("d",strtotime($libro->created_at) ) );
                $registrosLibros[$mesU]++;    
            }
            foreach($revistas as $revista){
                $mesU=intval(date("d",strtotime($revista->created_at) ) );
                $registrosRevistas[$mesU]++;    
            }
            $data=array("totaldias"=>$ultimo_dia, "registrosLibros" =>$registrosLibros,
            "registrosRevistas" =>$registrosRevistas);
        }

        return   json_encode($data);
    }

    public function getLibros($año,$mes,$tipo){
        $primer_dia=1;
        if($mes==0){
            $ultimo_dia=$this->getUltimoDiaMes($año,12);
            $fecha_inicial=date("Y-m-d H:i:s", strtotime($año."-1-".$primer_dia) );
            $fecha_final=date("Y-m-d H:i:s", strtotime($año."-12-".$ultimo_dia) );
          
            if($tipo=='visitas'){
                return VistasDescargasLibros::whereBetween('created_at', [$fecha_inicial,  $fecha_final])
                    ->where('tipo_accion','vista')
                    ->get();
            }else{
                return VistasDescargasLibros::whereBetween('created_at', [$fecha_inicial,  $fecha_final])
                    ->where('tipo_accion','descarga')
                    ->get();
            }
        
        }else{
            $ultimo_dia=$this->getUltimoDiaMes($año,$mes);
            $fecha_inicial=date("Y-m-d H:i:s", strtotime($año."-".$mes."-".$primer_dia) );
            $fecha_final=date("Y-m-d H:i:s", strtotime($año."-".$mes."-".$ultimo_dia) );
           
            if($tipo=='visitas'){
                return VistasDescargasLibros::whereBetween('created_at', [$fecha_inicial,  $fecha_final])
                    ->where('tipo_accion','vista')
                    ->get();
            }else{
                return VistasDescargasLibros::whereBetween('created_at', [$fecha_inicial,  $fecha_final])
                    ->where('tipo_accion','descarga')
                    ->get();
            }
        
        }
    }

    public function getRevistas($año,$mes,$tipo){
        $primer_dia=1;
        if($mes==0){
            $ultimo_dia=$this->getUltimoDiaMes($año,12);
            $fecha_inicial=date("Y-m-d H:i:s", strtotime($año."-1-".$primer_dia) );
            $fecha_final=date("Y-m-d H:i:s", strtotime($año."-12-".$ultimo_dia) );
           
            if($tipo=='visitas'){
                return VistasDescargasRevistas::whereBetween('created_at', [$fecha_inicial,  $fecha_final])
                ->where('tipo_accion','vista')
                ->get();
            }else{
                return VistasDescargasRevistas::whereBetween('created_at', [$fecha_inicial,  $fecha_final])
                ->where('tipo_accion','descarga')
                ->get();
            }
            
        }else{
            $ultimo_dia=$this->getUltimoDiaMes($año,$mes);
            $fecha_inicial=date("Y-m-d H:i:s", strtotime($año."-".$mes."-".$primer_dia) );
            $fecha_final=date("Y-m-d H:i:s", strtotime($año."-".$mes."-".$ultimo_dia) );
           
            if($tipo=='visitas'){
                return VistasDescargasRevistas::whereBetween('created_at', [$fecha_inicial,  $fecha_final])
                ->where('tipo_accion','vista')
                ->get();
            }else{
                return VistasDescargasRevistas::whereBetween('created_at', [$fecha_inicial,  $fecha_final])
                ->where('tipo_accion','descarga')
                ->get();
            }
        
        }
    }

    public function top_visitas_mes_libros($año,$mes){
        
        $primer_dia=1;
        if($mes==0){
            $ultimo_dia=$this->getUltimoDiaMes($año,12);
            $fecha_inicial=date("Y-m-d H:i:s", strtotime($año."-1-".$primer_dia) );
            $fecha_final=date("Y-m-d H:i:s", strtotime($año."-12-".$ultimo_dia) );
        }else{
            $ultimo_dia=$this->getUltimoDiaMes($año,$mes);
            $fecha_inicial=date("Y-m-d H:i:s", strtotime($año."-".$mes."-".$primer_dia) );
            $fecha_final=date("Y-m-d H:i:s", strtotime($año."-".$mes."-".$ultimo_dia) );
            }
        $libros = DB::table('libros as a')
                ->join('vistas_descargas_libros as b', 'b.id_libro', '=', 'a.id')
                ->whereBetween('b.created_at', [$fecha_inicial,  $fecha_final])
                ->where('b.tipo_accion', 'vista')
                ->select('a.nombre', DB::raw('count(*) as cant_visitas'))
                ->groupBy('a.nombre')
                ->orderBy('cant_visitas','desc')
                ->take(5)
                ->get();        

        return   json_encode($libros);
    }

    public function top_visitas_mes_revistas($año,$mes){
        
        $primer_dia=1;
        if($mes==0){
            $ultimo_dia=$this->getUltimoDiaMes($año,12);
            $fecha_inicial=date("Y-m-d H:i:s", strtotime($año."-1-".$primer_dia) );
            $fecha_final=date("Y-m-d H:i:s", strtotime($año."-12-".$ultimo_dia) );
        }else{
            $ultimo_dia=$this->getUltimoDiaMes($año,$mes);
            $fecha_inicial=date("Y-m-d H:i:s", strtotime($año."-".$mes."-".$primer_dia) );
            $fecha_final=date("Y-m-d H:i:s", strtotime($año."-".$mes."-".$ultimo_dia) );
        }
        $revistas = DB::table('revistas as a')
                ->join('vistas_descargas_revistas as b', 'b.id_revista', '=', 'a.id')
                ->whereBetween('b.created_at', [$fecha_inicial,  $fecha_final])
                ->where('b.tipo_accion', 'vista')
                ->select('a.nombre', DB::raw('count(*) as cant_visitas'))
                ->groupBy('a.nombre')
                ->orderBy('cant_visitas','desc')
                ->take(5)
                ->get();        

        return   json_encode($revistas);
    }
    
    public function top_descargas_mes_libros($año,$mes){
        
        $primer_dia=1;
        if($mes==0){
            $ultimo_dia=$this->getUltimoDiaMes($año,12);
            $fecha_inicial=date("Y-m-d H:i:s", strtotime($año."-1-".$primer_dia) );
            $fecha_final=date("Y-m-d H:i:s", strtotime($año."-12-".$ultimo_dia) );
        }else{
            $ultimo_dia=$this->getUltimoDiaMes($año,$mes);
            $fecha_inicial=date("Y-m-d H:i:s", strtotime($año."-".$mes."-".$primer_dia) );
            $fecha_final=date("Y-m-d H:i:s", strtotime($año."-".$mes."-".$ultimo_dia) );
            }
        $libros = DB::table('libros as a')
                ->join('vistas_descargas_libros as b', 'b.id_libro', '=', 'a.id')
                ->whereBetween('b.created_at', [$fecha_inicial,  $fecha_final])
                ->where('b.tipo_accion', 'descarga')
                ->select('a.nombre', DB::raw('count(*) as cant_visitas'))
                ->groupBy('a.nombre')
                ->orderBy('cant_visitas','desc')
                ->take(5)
                ->get();        

        return   json_encode($libros);
    }

    public function top_descargas_mes_revistas($año,$mes){
        
        $primer_dia=1;
        if($mes==0){
            $ultimo_dia=$this->getUltimoDiaMes($año,12);
            $fecha_inicial=date("Y-m-d H:i:s", strtotime($año."-1-".$primer_dia) );
            $fecha_final=date("Y-m-d H:i:s", strtotime($año."-12-".$ultimo_dia) );
        }else{
            $ultimo_dia=$this->getUltimoDiaMes($año,$mes);
            $fecha_inicial=date("Y-m-d H:i:s", strtotime($año."-".$mes."-".$primer_dia) );
            $fecha_final=date("Y-m-d H:i:s", strtotime($año."-".$mes."-".$ultimo_dia) );
        }
        $revistas = DB::table('revistas as a')
                ->join('vistas_descargas_revistas as b', 'b.id_revista', '=', 'a.id')
                ->whereBetween('b.created_at', [$fecha_inicial,  $fecha_final])
                ->where('b.tipo_accion', 'descarga')
                ->select('a.nombre', DB::raw('count(*) as cant_visitas'))
                ->groupBy('a.nombre')
                ->orderBy('cant_visitas','desc')
                ->take(5)
                ->get();        

        return   json_encode($revistas);
    }
}
