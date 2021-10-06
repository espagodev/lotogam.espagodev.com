<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Services\MarketService;
use App\Utils\Util;
use Yajra\DataTables\Facades\DataTables;

class BalanceController extends Controller
{

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
     * Shows register details modal.
     *
     * @param  void
     * @return \Illuminate\Http\Response
     */
    public function getBalances(Request $request)
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

        
            $balances =  $this->marketService->getBalances($data);
       
            return $datatable = DataTables::of($balances)         
                ->editColumn('users_id', function ($row) {
                    return  $row->name;
                })
                ->editColumn('cgc_balance_inicial', function ($row) {
                return '<span class="display_currency" data-currency_symbol="true">' .
                    $row->cgc_balance_inicial . '</span>';
                })
                ->editColumn('cgc_total_entradas', function ($row) {
                    return '<span class="display_currency" data-currency_symbol="true">' .
                        $row->cgc_total_entradas . '</span>';
                 })
                ->editColumn('cgc_total_salidas', function ($row) {
                    return '<span class="display_currency" data-currency_symbol="true">' .
                        $row->cgc_total_salidas . '</span>';
                })
                ->editColumn('cgc_total_comisiones', function ($row) {
                    return '<span class="display_currency" data-currency_symbol="true">' .
                        $row->cgc_total_comisiones . '</span>';
                })
                ->editColumn('cgc_total_venta_neta', function ($row) {
                    return '<span class="display_currency" data-currency_symbol="true">' .
                        $row->cgc_total_venta_neta . '</span>';
                })
                ->editColumn('cgc_total_premios', function ($row) {
                    return '<span class="display_currency" data-currency_symbol="true">' .
                        $row->cgc_total_premios . '</span>';
                })
                ->editColumn('disponible', function ($row) { 
                    return '<span class="display_currency" data-currency_symbol="true">' .
                        $row->ban_limite_venta . '</span>';
                })
                ->editColumn('cgc_balance_final', function ($row) {
                    return '<span class="display_currency" data-currency_symbol="true">' .
                        $row->cgc_balance_final . '</span>';
                })
                // ->editColumn('cgc_total_venta', function ($row) {
                //     return '<span class="display_currency" data-currency_symbol="true">' .
                //         $row->cgc_total_venta . '</span>';
                // })
                ->editColumn('cgc_total_venta', function ($row) {
                  return '<span class="display_currency" data-currency_symbol="true">' .
                                             $row->cgc_total_venta . '</span>';
                                       
                                    
                                
                })
                ->editColumn('cgc_fecha_movimiento', function ($row) {
                    return $this->util->format_date($row->cgc_fecha_movimiento, false);
                })

                ->rawColumns([ 'cgc_balance_inicial','cgc_total_entradas','cgc_total_salidas','cgc_total_venta','cgc_total_venta_neta','cgc_total_comisiones','cgc_total_premios','cgc_balance_final','cgc_fecha_movimiento','disponible'])
            ->make(true);

        }

    }
}
