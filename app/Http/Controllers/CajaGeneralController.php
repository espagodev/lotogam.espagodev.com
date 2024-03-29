<?php

namespace App\Http\Controllers;

use App\Utils\BancaUtil;
use Illuminate\Http\Request;
use App\Services\MarketService;
use App\Utils\Util;
use Yajra\DataTables\Facades\DataTables;

class CajaGeneralController extends Controller
{
    protected $util;
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(

        MarketService $marketService,
        Util $util
    ) {

        $this->middleware('auth');
        parent::__construct($marketService);
        $this->util = $util;
    }
    /** 
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $empresas_id = session()->get('user.emp_id');

        if(session()->get('user.useSupervisor') == 1){
            $bancas = BancaUtil::bancasSupervisor(session()->get('user.id'));
        }else{
            $bancas = BancaUtil::forDropdown($empresas_id);
        }
        
        $usuarios =  $this->marketService->getUsuariosEmpresa($empresas_id);
        $movimientosCaja = Util::movimientosCaja();
        return view('caja_general.index', compact('bancas',  'usuarios', 'movimientosCaja'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $empresas_id = session()->get('user.emp_id');

        if(session()->get('user.useSupervisor') == 1){
            $bancas = BancaUtil::bancasSupervisor(session()->get('user.id'));
        }else{
            $bancas = BancaUtil::forDropdown($empresas_id);
        }
        
        $usuarios =  $this->marketService->getUsuariosEmpresa($empresas_id);
        $movimientosCaja = Util::movimientosCaja();
        return view('caja_general.create', compact('bancas',  'usuarios', 'movimientosCaja'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request->all();
        $data['empresas_id'] = session()->get('user.emp_id');
        $data['users_movimiento_id'] = session()->get('user.id');

        $data = $this->marketService->postCajaGeneal($data);

        return redirect()
            ->route(
            'cuadre-caja.index'
            )
            ->with('success', ['El Registro se creo Satisfactoriamente']);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }


    /**
     * Shows register details modal.
     *
     * @param  void
     * @return \Illuminate\Http\Response
     */
    public function getCajaGeneral(Request $request)
    {
        if ($request->ajax()) {
            if (session()->get('user.TipoUsuario') == 2) {
                $data = $request->only(['start_date', 'end_date',  'users_id', 'bancas_id', 'movimiento']);
            } else if (session()->get('user.TipoUsuario') == 3) {
                $data = $request->only(['start_date', 'end_date', 'movimiento']);
                $data['bancas_id'] = !empty($request->bancas_id) ? $request->bancas_id : session()->get('user.banca');
                $data['users_id'] = !empty($request->users_id) ? $request->users_id : session()->get('user.id');
            }
            $data['empresas_id'] = session()->get('user.emp_id');

            $cajaGeneral =  $this->marketService->getCajaGeneral($data);


            return $datatable = DataTables::of($cajaGeneral)
                ->editColumn('cag_fecha_movimiento', function ($row) {
                    return $this->util->format_date($row->cag_fecha_movimiento, true);
                })
                ->editColumn('bancas_id', function ($row) {
                    return  $row->ban_cod . ' - ' . $row->ban_nombre;
                })
                ->editColumn('users_id', function ($row) {
                    return  $row->name;
                })
                ->editColumn('cag_monto', function ($row) {

                return '<span class="display_currency" data-currency_symbol="true">' .
                    $row->cag_monto . '</span>';

                })
                ->addColumn('action', function ($row) {
                    
                    if (session()->get('user.TipoUsuario') == 2) {
                        return '<button type="button" data-href="'.action('CajaGeneralController@getCajaGeneralDelete', [$row->id]) .'" class="btn btn-sm btn-danger delete_cajaGeneral_button"><i class="fa fa-trash" aria-hidden="true"></i></button>';
                    } 
                   
                })
                ->rawColumns(['cag_fecha_movimiento', 'cag_monto', 'action'])
            ->make(true);

        }

    }

    /**
     * Shows register details modal.
     *
     * @param  void
     * @return \Illuminate\Http\Response
     */
    public function getCajaGeneralDetalle(Request $request)
    {
        if ($request->ajax()) {
            if (session()->get('user.TipoUsuario') == 2) {
                $data = $request->only(['start_date', 'end_date',  'users_id', 'bancas_id','movimiento']);
            } else if (session()->get('user.TipoUsuario') == 3) {
                $data = $request->only(['start_date', 'end_date', 'movimiento']);
                $data['bancas_id'] = !empty($request->bancas_id) ? $request->bancas_id : session()->get('user.banca');
                $data['users_id'] = !empty($request->users_id) ? $request->users_id : session()->get('user.id');
            }
            $data['empresas_id'] = session()->get('user.emp_id');
            
            $getCajaGeneralDetalle = $this->marketService->getCajaGeneralDetalle($data);

            //   $total_neto =   ($getCajaGeneralDetalle->balance_inicial + $getCajaGeneralDetalle->detalle->total_entrada + $getCajaGeneralDetalle->totalNeto - $getCajaGeneralDetalle->detalle->total_salida);
                // $balance_inicial = $getCajaGeneralDetalle->balanceInicial->balance_inicial + $getCajaGeneralDetalle->balanceInicial->caja_inicial;
                // $balance_final =  $getCajaGeneralDetalle->balanceFinal->balance_final + $getCajaGeneralDetalle->balanceFinal->caja_final + $balance_inicial;
                // $total_venta = $getCajaGeneralDetalle->balanceFinal->balance_final;
                // $balance_inicial_anterior = $getCajaGeneralDetalle->balanceAnteriror->balance_inicial + $getCajaGeneralDetalle->balanceAnteriror->caja_inicial;

              
                return [
                'balance_inicial' => $getCajaGeneralDetalle->balance_inicial,
                'total_entradas' => $getCajaGeneralDetalle->total_entradas,
                'total_salidas' => $getCajaGeneralDetalle->total_salidas,
                // 'total_cupo' => $getCajaGeneralDetalle->total_cupo,
                'total_venta' => $getCajaGeneralDetalle->total_venta_neta,
                'balance_final' => $getCajaGeneralDetalle->balance_final
            ];
        }
    }

    public function getCajaGeneralDelete($id)
    {
        if (request()->ajax()) {

            $data = $this->marketService->deleteCajaGeneralDetalle($id);

            return response()->json($data);
        }
    }
}
