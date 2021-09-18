<?php

namespace App\Http\Controllers\ControlJugadas;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Services\MarketService;
use App\Utils\BancaUtil;
use App\Utils\Reportes;

class ControlJugadasController extends Controller
{
    public function __construct(MarketService $marketService)
    {
        $this->middleware('auth');

        parent::__construct($marketService);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users_id = session()->get('user.id');
        $empresas_id = session()->get('user.emp_id');

        if(session()->get('user.useSupervisor') == 1){
            $bancas = BancaUtil::bancasSupervisor(session()->get('user.id'));
        }else{
            $bancas = BancaUtil::forDropdown($empresas_id);
        }

        $loterias =  Reportes::getloteriasEmpresaReporte($empresas_id);
        return view('controlJugadas.index')->with(['loterias' => $loterias,'bancas' => $bancas,]);

    }
}
