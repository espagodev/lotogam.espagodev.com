<?php

namespace App\Http\Controllers;

use App\Services\MarketService;
use App\Utils\BancaUtil;
use Illuminate\Http\Request;
use App\Utils\Reportes;
use App\Utils\Util;
use Carbon\Carbon;
use DataTables;

class ReportesController extends Controller
{
    protected $reportes;
    protected $util;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(

        MarketService $marketService,
        Reportes $reportes,
        Util $util
    ) {
        $this->reportes = $reportes;
        $this->util = $util;
        $this->middleware('auth');
        parent::__construct($marketService);
    }

    /**
     *Reporte de ventas
     *
     * @return \Illuminate\Http\Response
     */
    public function reporteVentas(Request $request)
    {

        if ($request->ajax()) {

            if ((session()->get('user.TipoUsuario') == 2) || (session()->get('user.useSupervisor') == 1)) {
                $data = $request->only(['start_date', 'end_date',  'loterias_id', 'users_id', 'estado', 'promocion', 'bancas_id']);
            } else if (session()->get('user.TipoUsuario') == 3) {
                $data = $request->only(['start_date', 'end_date', 'loterias_id', 'estado', 'promocion']);
                $data['bancas_id'] = !empty($request->bancas_id) ? $request->bancas_id : session()->get('user.banca');
                $data['users_id'] = !empty($request->users_id) ? $request->users_id : session()->get('user.id');
            }
            $data['empresas_id'] = session()->get('user.emp_id');

            $reporteVentas = $this->reportes->getReporteVentas($data);

            return $datatable = dataTables::of($reporteVentas)

                ->editColumn('lot_nombre', function ($row) {
                    return '<a data-loteria=' . $row->loterias_id . ' href="#" class="detalle-ventas">' . $row->lot_nombre  . ' (' . $row->lot_abreviado . ')  </a>';
                })
                ->editColumn('venta', function ($row) {
                    $venta = $row->total_venta ? $row->total_venta : 0;
                    return '<span class="display_currency venta"  data-orig-value="' . $venta . '" data-currency_symbol = true>' . $venta . '</span>';
                })
                ->editColumn('venta_promo', function ($row) {
                    $ventaPromo = $row->total_venta_promo ? $row->total_venta_promo : 0;
                    return '<span class="display_currency venta_promo"  data-orig-value="' . $ventaPromo . '" data-currency_symbol = true>' . $ventaPromo . '</span>';
                })
                ->editColumn('comision', function ($row) {
                    $comision = $row->total_comision ? $row->total_comision : 0;
                    return '<span class="display_currency comision" data-orig-value="' . $comision . '" data-currency_symbol = true>' . $comision . '</span>';
                })
                ->editColumn('ganado', function ($row) {
                    $ganado = $row->total_premios ? $row->total_premios : 0;
                    return '<span class="display_currency premios" data-orig-value="' . $ganado . '" data-currency_symbol = true>' . $ganado . '</span>';
                })
                ->editColumn('premios_promo', function ($row) {
                    $premioPromo = $row->total_premios_promo ? $row->total_premios_promo : 0;
                    return '<span class="display_currency premios_promo" data-orig-value="' . $premioPromo . '" data-currency_symbol = true>' . $premioPromo . '</span>';
                })
                ->editColumn('ganancia', function ($row) {
                    $totalGanancia =  $row->total_venta - $row->total_comision - $row->total_premios;
                    $ganancia = $totalGanancia ? $totalGanancia : 0;
                    return '<span class="display_currency ganancia" data-orig-value="' . $ganancia . '" data-currency_symbol = true>' . $ganancia . '</span>';
                })
                ->rawColumns(['lot_nombre', 'venta', 'venta_promo', 'comision', 'ganado', 'premios_promo', 'ganancia'])
                ->make(true);
        }


        $empresas_id = session()->get('user.emp_id');

        if(session()->get('user.useSupervisor') == 1){
            $bancas = BancaUtil::bancasSupervisor(session()->get('user.id'));
        }else{
            $bancas = BancaUtil::forDropdown($empresas_id);
        }
        
        $loterias =  $this->reportes->getloteriasEmpresaReporte($empresas_id);
        $estadosTicket = Util::estadosTicket();
        $estadosPromocionTicket = Util::estadosPromocionTicket();
        $usuarios =  $this->marketService->getUsuariosEmpresa($empresas_id);

        return view('reportes/reporte-ventas', compact('bancas', 'loterias', 'estadosPromocionTicket', 'estadosTicket', 'usuarios'));
    }

    public function reporteTickets(Request $request)
    {

        if ($request->ajax()) {

            if ((session()->get('user.TipoUsuario') == 2) || (session()->get('user.useSupervisor') == 1)) {
                $data = $request->only(['start_date', 'end_date',  'loterias_id', 'users_id', 'estado', 'promocion', 'bancas_id']);
                $isAnular = 0;
            } else if (session()->get('user.TipoUsuario') == 3) {
                $data = $request->only(['start_date', 'end_date', 'loterias_id', 'estado', 'promocion']);
                $data['bancas_id'] = !empty($request->bancas_id) ? $request->bancas_id : session()->get('user.banca');
                $data['users_id'] = !empty($request->users_id) ? $request->users_id : session()->get('user.id');
            }
            $data['empresas_id'] = session()->get('user.emp_id');

            $reporteTickets = $this->reportes->getReporteTickets($data);

            return $datatable = dataTables::of($reporteTickets)
                ->editColumn('loteria', '$loteria')
                // ->editColumn('tic_ticket', function ($row) {
                //     return '<a data-ticket=' . $row->id . ' href="#" class="detalle-ticket">' . $row->tic_ticket  . ' </a>';
                // })
                ->editColumn('tic_fecha_sorteo', '{{@format_datetime($tic_fecha_sorteo)}}')
                ->editColumn('tic_apostado', function ($row) {
                    if ($row->tic_promocion == 1) {
                        $tic_apostado = $row->tic_apostado ? $row->tic_apostado : 0;
                        return '<span class="display_currency" data-orig-value="' . $tic_apostado . '" data-currency_symbol = true>' . $tic_apostado . '</span><span class="badge badge-info m-1">** Promocion **</span>';
                    } else {
                        $tic_apostado = $row->tic_apostado ? $row->tic_apostado : 0;
                        return '<span class="display_currency" data-orig-value="' . $tic_apostado . '" data-currency_symbol = true>' . $tic_apostado . '</span>';
                    }
                })
                ->editColumn('tic_ganado', function ($row) {
                    $tic_ganado = $row->tic_ganado ? $row->tic_ganado : 0;
                    return '<span class="display_currency tic_ganado" data-orig-value="' . $tic_ganado . '" data-currency_symbol = true>' . $tic_ganado . '</span>';
                })
                ->addColumn('tic_estado', function ($row) {
                    if ($row->tic_estado == 1) {
                        return '<h5<span class="badge badge-light m-1">Normal</span></h5>';
                    } else if ($row->tic_estado == 2) {
                        return '<h5<span class="badge badge-success m-1">Premiado</span></h5>';
                    } else if ($row->tic_estado == 3) {
                        return '<h5<span class="badge badge-info m-1">Pagado</span></h5>';
                    } else {
                        return '<h5<span class="badge badge-danger m-1">Anulado</span></h5>';
                    }
                })
                ->addColumn('action', function ($row) {
                    if (session()->get('user.TipoUsuario') == 2) {
                        $isAnular = 0;
                    } elseif (session()->get('user.TipoUsuario') == 3) {
                        $isAnular = BancaUtil::calcularMinutos($row->tic_fecha_sorteo);
                    }
                    $estado = '';
                    if ($row->tic_estado == 1) {
                        $estado .= '   <button type="button" data-href="' . action('Ticket\TicketController@show', [$row->id]) . '"  class="btn btn-sm btn-outline-info btn-modal"
                                    data-container=".view_register"><i class="fa fa-eye"></i> </button>

                                     <a href="#" data-href="' . route('pos.printTicket', [$row->id]) . '" class="btn btn-sm btn-outline-warning print-invoice"
                                    ><i class="fa fa-print"></i></a>

                                ';
                    } else if ($row->tic_estado == 2) {
                        $estado .= '<button type="button" data-href="' . action('Ticket\TicketController@show', [$row->id]) . '"  class="btn btn-sm btn-outline-info btn-modal"
                                    data-container=".view_register"><i class="fa fa-eye"></i> </button>

                                <button type="button" href="' . action('Ticket\TicketController@getTicketPremiado', [$row->id]) . '"  class="btn btn-sm btn-outline-success view_ticket_modal  no-print">
                        <i class="fa fa-money"></i> </button>';
                    } else if ($row->tic_estado == 3) {
                        $estado .= '<button type="button" data-href="' . action('Ticket\TicketController@show', [$row->id]) . '"  class="btn btn-sm btn-outline-info btn-modal"
                                    data-container=".view_register"><i class="fa fa-eye"></i> </button>';
                    } else {
                        $estado .= '<button type="button" data-href="' . action('Ticket\TicketController@show', [$row->id]) . '"  class="btn btn-sm btn-outline-info btn-modal"
                                    data-container=".view_register"><i class="fa fa-eye"></i> </button>
                            ';
                    }

                    $estado .= ' <button type="button" data-href="' . action('Ticket\TicketController@showDuplicarTicket', [$row->id]) . '" class="btn btn-sm btn-outline-secondary btn-modal"
                                data-container=".view_register"><i class="fa fa-clone"></i></button>';

                    if (($isAnular == 0) && $row->tic_estado != 0) {
                        $estado .= ' <button type="button" href="' . action('Ticket\TicketController@getAnularTicket', [$row->id]) . '" class="btn btn-sm btn-outline-danger anular_ticket_modal"
                                    ><i class="fa fa-window-close"></i></button>';
                    }

                    return $estado;
                })

                ->rawColumns(['action', 'tic_ticket', 'tic_apostado', 'tic_ganado', 'tic_fecha_sorteo', 'tic_fecha_pago', 'tic_estado'])
                ->make(true);
        }


        $empresas_id = session()->get('user.emp_id');

        if(session()->get('user.useSupervisor') == 1){
            $bancas = BancaUtil::bancasSupervisor(session()->get('user.id'));
        }else{
            $bancas = BancaUtil::forDropdown($empresas_id);
        }
        
        $loterias =  $this->reportes->getloteriasEmpresaReporte($empresas_id);
        $usuarios =  $this->marketService->getUsuariosEmpresa($empresas_id);
        $estadosTicket = Util::estadosTicket();
        $estadosPromocionTicket = Util::estadosPromocionTicket();

        return view('reportes/reporte-tickets', compact('bancas', 'loterias', 'estadosTicket', 'estadosPromocionTicket', 'usuarios'));
    }

    public function reportePremiados(Request $request)
    {
        if ($request->ajax()) {

            if ((session()->get('user.TipoUsuario') == 2) || (session()->get('user.useSupervisor') == 1)) {
                $data = $request->only(['start_date', 'end_date',  'loterias_id', 'users_id', 'bancas_id']);
            } else if (session()->get('user.TipoUsuario') == 3) {
                $data = $request->only(['start_date', 'end_date',  'loterias_id']);
                $data['bancas_id'] = !empty($request->bancas_id) ? $request->bancas_id : session()->get('user.banca');
                $data['users_id'] = !empty($request->users_id) ? $request->users_id : session()->get('user.id');
            }
            $data['empresas_id'] = session()->get('user.emp_id');

            $reportePremiados = $this->reportes->getReportePremiados($data);

            return $datatable = dataTables::of($reportePremiados)
                // ->editColumn('tic_ticket', function ($row) {
                //     return '<a data-ticket=' . $row->id . ' href="#" class="detalle-ticket">' . $row->tic_ticket  . ' </a>';
                // })
                ->editColumn('tic_fecha_sorteo', '{{@format_datetime($tic_fecha_sorteo)}}')
                // ->editColumn('loteria', '$loteria')
                ->editColumn('tic_apostado', function ($row) {
                    $tic_apostado = $row->tic_apostado ? $row->tic_apostado : 0;
                    return '<span class="display_currency" data-orig-value="' . $tic_apostado . '" data-currency_symbol = true>' . $tic_apostado . '</span>';
                })
                ->editColumn('tic_ganado', function ($row) {
                    $tic_ganado = $row->tic_ganado ? $row->tic_ganado : 0;
                    return '<span class="display_currency tic_ganado" data-orig-value="' . $tic_ganado . '" data-currency_symbol = true>' . $tic_ganado . '</span>';
                })
                ->addColumn('tic_estado', function ($row) {
                    if ($row->tic_estado == 1) {
                        return '<span class="time-to-now">Activo</span>';
                    } else if ($row->tic_estado == 2) {
                        return '<span class="time-to-now">Premiado</span>';
                    } else if ($row->tic_estado == 3) {
                        return '<span class="time-to-now">Pagado</span>';
                    } else {
                        return '<span class="time-to-now">Anulado</span>';
                    }
                })
                ->editColumn('tic_fecha_pago',  '@if(!empty($tic_fecha_pago)) {{@format_datetime($tic_fecha_pago)}} @else   @endif')
                ->addColumn('action', function ($row) {
                    if ($row->tic_estado == 2) {
                        return '<button type="button" href="' . action('Ticket\TicketController@getTicketPremiado', [$row->id]) . '"  class="btn btn-sm  btn-outline-success view_ticket_modal  no-print">
                        <i class="fa fa-money"></i> </button>';
                    } else {
                        return '<button type="button" data-href="' . action('Ticket\TicketController@show', [$row->id]) . '"  class="btn btn-sm btn-outline-info btn-modal"
                                    data-container=".view_register"><i class="fa fa-eye"></i> </button>';
                    }
                })
                ->rawColumns(['action', 'tic_apostado', 'tic_ganado', 'tic_estado'])
                ->make(true);
        }


        $empresas_id = session()->get('user.emp_id');

        if(session()->get('user.useSupervisor') == 1){
            $bancas = BancaUtil::bancasSupervisor(session()->get('user.id'));
        }else{
            $bancas = BancaUtil::forDropdown($empresas_id);
        }
        $loterias =  $this->reportes->getloteriasEmpresaReporte($empresas_id);
        $estadosTicket = Util::estadosTicket();
        $estadosPromocionTicket = Util::estadosPromocionTicket();
        $usuarios =  $this->marketService->getUsuariosEmpresa($empresas_id);

        return view('reportes/reporte-premiados', compact('bancas', 'loterias', 'estadosPromocionTicket', 'estadosTicket', 'usuarios'));
    }

    public function reporteResultados(Request $request)
    {
        if ($request->ajax()) {

            if ((session()->get('user.TipoUsuario') == 2) || (session()->get('user.useSupervisor') == 1)) {
                $data = $request->only(['start_date', 'end_date',  'loterias_id', 'users_id', 'bancas_id']);
            } else if (session()->get('user.TipoUsuario') == 3) {
                $data = $request->only(['start_date', 'end_date',  'loterias_id']);
                $data['bancas_id'] = !empty($request->bancas_id) ? $request->bancas_id : session()->get('user.banca');
                $data['users_id'] = !empty($request->users_id) ? $request->users_id : session()->get('user.id');
            }
            $data['empresas_id'] = session()->get('user.emp_id');

            $reporteResultados = $this->reportes->getReporteResultados($data);

            return $datatable = dataTables::of($reporteResultados)

                ->editColumn('loteria', function ($row) {
                    return '<a data-loteria=' . $row->loterias_id . ' data-fecha=' . $row->res_fecha . ' href="#" class="detalle-resultados">' . $row->lot_nombre  . ' (' . $row->lot_abreviado . ')  </a>';
                })
                ->editColumn('lot_nombre', function ($row) {
                    return $row->lot_nombre . ' (' . $row->lot_abreviado . ')';
                })
                ->editColumn('res_fecha', '{{@format_date($res_fecha)}}')
                ->addColumn('action', function ($row) {
                    $action = '';
                    $action .= '<button data-href="' . action('ResultadosController@getResultadosDelete', [$row->id]) . '" class="btn btn-xs btn-danger delete_resultado_button"><i class="fa fa-trash"></i></button>
                    ';
                    return  $action;
                })


                ->rawColumns(['loteria', 'res_fecha', 'action'])
                ->make(true);
        }


        $empresas_id = session()->get('user.emp_id');
        $loterias =  $this->reportes->getloteriasEmpresaReporte($empresas_id);

        return view('reportes/reporte-resultados', compact('loterias'));
    }

    public function reporteModalidades(Request $request)
    {
        if ($request->ajax()) {

            if ((session()->get('user.TipoUsuario') == 2) || (session()->get('user.useSupervisor') == 1)) {
                $data = $request->only(['start_date', 'end_date',  'loterias_id', 'users_id', 'bancas_id']);
            } else if (session()->get('user.TipoUsuario') == 3) {
                $data = $request->only(['start_date', 'end_date',  'loterias_id']);
                $data['bancas_id'] = !empty($request->bancas_id) ? $request->bancas_id : session()->get('user.banca');
                $data['users_id'] = !empty($request->users_id) ? $request->users_id : session()->get('user.id');
            }
            $data['empresas_id'] = session()->get('user.emp_id');

            $reporteModalidades = $this->reportes->getReporteModalidades($data);

            $output['quinielas_vendidas'] = !empty($reporteModalidades[0]->totalModalidad) ? $reporteModalidades[0]->totalModalidad : 0;
            $output['total_quinielas'] =    !empty($reporteModalidades[0]->valorModalidad) ? $reporteModalidades[0]->valorModalidad : 0;
            $output['pale_vendido'] =       !empty($reporteModalidades[1]->totalModalidad) ? $reporteModalidades[1]->totalModalidad : 0;
            $output['total_pales'] =        !empty($reporteModalidades[1]->valorModalidad) ? $reporteModalidades[1]->valorModalidad : 0;
            $output['tripletas_vendidas'] = !empty($reporteModalidades[2]->totalModalidad) ? $reporteModalidades[2]->totalModalidad : 0;
            $output['total_tripletas'] =    !empty($reporteModalidades[2]->valorModalidad) ? $reporteModalidades[2]->valorModalidad : 0;
            $output['superpale_vendido'] =  !empty($reporteModalidades[3]->totalModalidad) ? $reporteModalidades[3]->totalModalidad : 0;
            $output['total_superpales'] =   !empty($reporteModalidades[3]->valorModalidad) ? $reporteModalidades[3]->valorModalidad : 0;

            return $output;
        }


        $empresas_id = session()->get('user.emp_id');
        if(session()->get('user.useSupervisor') == 1){
            $bancas = BancaUtil::bancasSupervisor(session()->get('user.id'));
        }else{
            $bancas = BancaUtil::forDropdown($empresas_id);
        }
        $loterias =  $this->reportes->getloteriasEmpresaReporte($empresas_id);
        $estadosTicket = Util::estadosTicket();
        $estadosPromocionTicket = Util::estadosPromocionTicket();
        $usuarios =  $this->marketService->getUsuariosEmpresa($empresas_id);

        return view('reportes/reporte-modalidades', compact('bancas', 'loterias', 'estadosPromocionTicket', 'estadosTicket', 'usuarios'));
    }

    public function reporteJugadas(Request $request)
    {
        if ($request->ajax()) {

            if ((session()->get('user.TipoUsuario') == 2) || (session()->get('user.useSupervisor') == 1)) {  
                $data = $request->only(['start_date', 'end_date',  'loterias_id', 'users_id', 'estado', 'promocion',  'bancas_id']);
            } else if (session()->get('user.TipoUsuario') == 3) {
                $data = $request->only(['start_date', 'end_date',  'loterias_id']);
                $data['bancas_id'] = !empty($request->bancas_id) ? $request->bancas_id : session()->get('user.banca');
                $data['users_id'] = !empty($request->users_id) ? $request->users_id : session()->get('user.id');
            }

            $data['empresas_id'] = session()->get('user.emp_id');
            
            $reporteJugadas = $this->reportes->getReporteJugadas($data);
            return $datatable = dataTables::of($reporteJugadas)

                ->editColumn('cnj_fecha', '{{@format_date($cnj_fecha)}}')
                ->rawColumns(['cnj_fecha'])
                ->make(true);


            // return $output;
        }


        $empresas_id = session()->get('user.emp_id');
        if(session()->get('user.useSupervisor') == 1){
            $bancas = BancaUtil::bancasSupervisor(session()->get('user.id'));
        }else{
            $bancas = BancaUtil::forDropdown($empresas_id);
        }
        $estadosTicket = Util::estadosTicket();
        $estadosPromocionTicket = Util::estadosPromocionTicket();
        $usuarios =  $this->marketService->getUsuariosEmpresa($empresas_id);

        return view('reportes/reporte-modalidades', compact('bancas', 'estadosPromocionTicket', 'estadosTicket', 'usuarios'));
    }

    public function informeVentasPagos(Request $request)
    {

        if ($request->ajax()) {
            if ((session()->get('user.TipoUsuario') == 2) || (session()->get('user.useSupervisor') == 1)) {
                $data = $request->only(['start_date', 'end_date',  'loterias_id', 'users_id', 'bancas_id']);
            } else if (session()->get('user.TipoUsuario') == 3) {
                $data = $request->only(['start_date', 'end_date',  'loterias_id']);
                $data['bancas_id'] = !empty($request->bancas_id) ? $request->bancas_id : session()->get('user.banca');
                $data['users_id'] = !empty($request->users_id) ? $request->users_id : session()->get('user.id');
            }
            $data['empresas_id'] = session()->get('user.emp_id');

            $informeVentasPagos = $this->reportes->getInformeVentasPagos($data);

            // dd($informeVentasPagos->diferencia->neto_total);

            return [
                'total_venta' => $informeVentasPagos->ventas_detalle->total_venta,
                'total_venta_promo' => $informeVentasPagos->ventas_detalle->total_venta_promo,
                'total_venta_futuro' => $informeVentasPagos->ventas_detalle->total_venta_futuro,
                'total_premios' => $informeVentasPagos->ventas_detalle->total_premios,
                'total_premios_promo' => $informeVentasPagos->ventas_detalle->total_premios_promo,
                'total_comision' => $informeVentasPagos->ventas_detalle->total_comision,
                'total_pagado' => $informeVentasPagos->ventas_detalle->total_pagado,
                'total_pendiente_pago' => $informeVentasPagos->ventas_detalle->total_pendiente_pago,

                'neto_total' => $informeVentasPagos->diferencia->neto_total,

                'total_entrada' => $informeVentasPagos->cajaGeneral->total_entrada,
                'total_salida' => $informeVentasPagos->cajaGeneral->total_salida,
                'total_cupo' => $informeVentasPagos->cajaGeneral->total_cupo,

                'neto_faltante' => $informeVentasPagos->diferencia->neto_faltante,

                'gastos_banca' => '0',
                'balance_inicial' =>  $informeVentasPagos->diferencia->balance_inicial,

            ];

        }

        $empresas_id = session()->get('user.emp_id');
        if(session()->get('user.useSupervisor') == 1){
            $bancas = BancaUtil::bancasSupervisor(session()->get('user.id'));
        }else{
            $bancas = BancaUtil::forDropdown($empresas_id);
        }
        $usuarios =  $this->marketService->getUsuariosEmpresa($empresas_id);

        return view('reportes/informe-ventas-pagos', compact('bancas',  'usuarios'));
    }


    public function getReporteRegistro(Request $request)
    {

        if ($request->ajax()) {

            if ((session()->get('user.TipoUsuario') == 2) || (session()->get('user.useSupervisor') == 1)) {
                $data = $request->only(['start_date', 'end_date',  'loterias_id', 'users_id', 'estado',  'bancas_id']);
            } else if (session()->get('user.TipoUsuario') == 3) {
                $data = $request->only(['start_date', 'end_date', 'loterias_id', 'estado']);
                $data['bancas_id'] = !empty($request->bancas_id) ? $request->bancas_id : session()->get('user.banca');
                $data['users_id'] = !empty($request->users_id) ? $request->users_id : session()->get('user.id');
            }
            $data['empresas_id'] = session()->get('user.emp_id');

            $cajaRegistradora = $this->reportes->getCajaRegistradora($data);

            return $datatable = dataTables::of($cajaRegistradora)

                ->editColumn('created_at', function ($row) {
                    return $this->util->format_date($row->created_at, true);
                })

                ->editColumn('caj_hora_cierre', function ($row) {
                    if ($row->caj_estado == 'Cerrado') {
                        return $this->util->format_date($row->caj_hora_cierre, true);
                    } else {
                        return '';
                    }
                })
                ->editColumn('bancas_id', function ($row) {
                    return  $row->ban_cod . ' - ' . $row->ban_nombre;
                })
                ->editColumn('users_id', function ($row) {
                    return  $row->name ;
                })
                ->editColumn('caj_monto_cierre', function ($row) {
                    if ($row->caj_estado == 'Cerrado') {
                        return '<span class="display_currency" data-currency_symbol="true">' .
                            $row->caj_monto_cierre . '</span>';
                    } else {
                        return '';
                    }
                })
                ->addColumn('action', function ($row) {
                    if ($row->caj_estado == "Cerrado") {

                        return '<button type="button" data-href="'.action('CajaRegistradoraController@getDetalleRegistro', [$row->id]) .'" class="btn btn-sm btn-info btn-modal"
                    data-container=".view_register"><i class="fa fa-eye" aria-hidden="true"></i> Ver</button>';
                    } else {
                        return '<button type="button" data-href="' . action('CajaRegistradoraController@getDetalleRegistro', [$row->id]) . '" class="btn btn-sm btn-info btn-modal"
                    data-container=".view_register"><i class="fa fa-eye" aria-hidden="true"></i> Ver</button>
                    <button type="button" data-href="'.action('CajaRegistradoraController@getCerrarRegistro', [$row->id]).'" class="btn btn-sm btn-danger btn-modal"
                        data-container=".view_register"><i class="fa fa-window-close"></i> Cerrar</button>';
                    }
                })

                ->rawColumns(['action', 'caj_monto_cierre'])
                ->make(true);
        }
        $empresas_id = session()->get('user.emp_id');
        if(session()->get('user.useSupervisor') == 1){
            $bancas = BancaUtil::bancasSupervisor(session()->get('user.id'));
        }else{
            $bancas = BancaUtil::forDropdown($empresas_id);
        }
        $usuarios =  $this->marketService->getUsuariosEmpresa($empresas_id);
        $registroInformes = Util::registroInformes();

        return view('reportes/reporte-registros', compact('bancas', 'usuarios','registroInformes'));
    }

    //Reporte Detalle

    public function reporteVentasDetalle(Request $request)
    {
        if ($request->ajax()) {

            if (session()->get('user.TipoUsuario') == 2) {
                $data = $request->only(['start_date', 'end_date',  'loterias_id', 'users_id', 'bancas_id']);
            } else if (session()->get('user.TipoUsuario') == 3) {
                $data = $request->only(['start_date', 'end_date', 'loterias_id']);
                $data['bancas_id'] = !empty($request->bancas_id) ? $request->bancas_id : session()->get('user.banca');
                $data['users_id'] = !empty($request->users_id) ? $request->users_id : session()->get('user.id');
            }
            $data['empresas_id'] = session()->get('user.emp_id');


            $reporteVentasDetalle = $this->reportes->getreporteVentasDetalle($data);

            $output = '';
            foreach ($reporteVentasDetalle as $key => $detalles) {

                $output .= '<tr>' .
                    '<td class="text-center">' . $detalles->tid_apuesta . '</td>' .
                    '<td class="text-center"><span class="display_currency" data-orig-value=' . $detalles->venta . ' data-currency_symbol=true> ' . $detalles->venta . '</span></td>' .
                    '<td class="text-center"><span class="display_currency" data-orig-value=' . $detalles->premio . ' data-currency_symbol=true> ' . $detalles->premio . '</span></td>' .
                    '</tr>';
            }

            return $output;
        }


        $empresas_id = session()->get('user.emp_id');
        $bancas = BancaUtil::forDropdown($empresas_id);

        return view('reportes/reporte-modalidades', compact('bancas'));
    }

    public function reporteResultadosDetalle(Request $request)
    {
        if ($request->ajax()) {

            if (session()->get('user.TipoUsuario') == 2) {
                $data = $request->only(['start_date', 'end_date',  'loterias_id', 'users_id', 'bancas_id']);
            } else if (session()->get('user.TipoUsuario') == 3) {
                $data = $request->only(['start_date', 'end_date', 'loterias_id']);
                $data['bancas_id'] = !empty($request->bancas_id) ? $request->bancas_id : session()->get('user.banca');
                $data['users_id'] = !empty($request->users_id) ? $request->users_id : session()->get('user.id');
            }
            $data['empresas_id'] = session()->get('user.emp_id');


            // $empresas_id = session()->get('user.emp_id');
            // $start_date = $request->get('start_date');
            // $end_date = $request->get('end_date');
            // $loterias_id = $request->get('loterias_id', null);


            $reporteResultadosDetalle = $this->reportes->getreporteResultadosDetalle($data);

            $output = '';
            foreach ($reporteResultadosDetalle as $key => $detalles) {

                $output .= '<tr>' .
                    '<td class="text-center">' . $detalles->tic_ticket . '</td>' .
                    '<td class="text-center">' . $detalles->tid_apuesta . '</td>' .
                    '<td class="text-center"><span class="display_currency" data-orig-value=' . $detalles->tid_ganado . ' data-currency_symbol=true> ' . $detalles->tid_ganado . '</span></td>' .
                    '</tr>';
            }

            return $output;
        }


        $empresas_id = session()->get('user.emp_id');
        $bancas = BancaUtil::forDropdown($empresas_id);

        return view('reportes/reporte-modalidades', compact('bancas'));
    }

    public function reporteTicketsDetalle(Request $request)
    {
        if ($request->ajax()) {

            $empresas_id = session()->get('user.emp_id');
            $start_date = $request->get('start_date');
            $end_date = $request->get('end_date');
            $tickets_id = $request->get('tickets_id', null);


            $reporteTicketsDetalle = $this->reportes->getreporteTicketsDetalle($empresas_id, $start_date, $end_date, $tickets_id);

            $output = '';
            foreach ($reporteTicketsDetalle as $key => $detalles) {

                $output .= '<tr>' .
                    '<td class="text-center">' . $detalles->tid_apuesta . '</td>' .
                    '<td class="text-center"><span class="display_currency" data-orig-value=' . $detalles->tid_valor . ' data-currency_symbol=true> ' . $detalles->tid_valor . '</span></td>' .
                    '<td class="text-center"><span class="display_currency" data-orig-value=' . $detalles->tid_ganado . ' data-currency_symbol=true> ' . $detalles->tid_ganado . '</span></td>' .
                    '</tr>';
            }

            return $output;
        }


        $empresas_id = session()->get('user.emp_id');
        $bancas = BancaUtil::forDropdown($empresas_id);

        return view('reportes/reporte-modalidades', compact('bancas'));
    }

    public function reporteModalidadesDetalle(Request $request)
    {
        
        if ($request->ajax()) {

            $data = $request->only(['start_date', 'end_date', 'bancas_id', 'loterias_id', 'users_id', 'modalidades_id']);
            $data['empresas_id'] = session()->get('user.emp_id');


            $reporteModalidadesDetalle = $this->reportes->getReporteModalidadesDetalle($data);

            $output = '';
            foreach ($reporteModalidadesDetalle as $key => $detalles) {
                // $tid_fecha_sorteo =  Carbon::createFromFormat('Y-m-d', $detalles->tid_fecha_sorteo)->format(session('business.date_format'));
                // $tid_fecha_sorteo =  carbon::createFromFormat('Y-m-d H:i:s', $detalles->tic_fecha_sorteo)->tz('America/Santo_Domingo')->format('Y-m-d');

                $output .= '<tr>' .
                    '<td>' . $detalles->lot_nombre . '</td>' .
                    
                    '<td>' . $detalles->tid_apuesta . '</td>' .
                    '<td><span class="display_currency" data-orig-value=' . $detalles->valor . ' data-currency_symbol=true> ' . $detalles->valor . '</span></td>' .
                    '<td>' . $detalles->tid_fecha_sorteo . '</td>' .
                    '</tr>';
            }

            return $output;
        }


        $empresas_id = session()->get('user.emp_id');
        $bancas = BancaUtil::forDropdown($empresas_id);

        return view('reportes/reporte-modalidades', compact('bancas'));
    }

    //REPORTES PARA IMPRIMIRÁ

    public function getVentasPrint(Request $request)
    {

        if ($request->ajax()) {
            try {
                $output = [
                    'success' => 0,
                    'msg' =>
                    'Algo salió Mal'
                ];

                if (session()->get('user.TipoUsuario') == 2) {
                    $data = $request->only(['start_date', 'end_date',  'loterias_id', 'users_id', 'estado', 'promocion', 'bancas_id']);
                } else if (session()->get('user.TipoUsuario') == 3) {
                    $data = $request->only(['start_date', 'end_date', 'loterias_id', 'estado', 'promocion']);
                    $data['bancas_id'] = !empty($request->bancas_id) ? $request->bancas_id : session()->get('user.banca');
                    $data['users_id'] = !empty($request->users_id) ? $request->users_id : session()->get('user.id');
                }
                $data['empresas_id'] = session()->get('user.emp_id');

                $receipt = Reportes::getReporteVentasPrint($data);

                $formatoPdf = BancaUtil::HtmlContent($receipt);

                $output = ['success' => 1, 'receipt' => $formatoPdf];
            } catch (\Exception $e) {
                \Log::emergency("File:" . $e->getFile() . "Line:" . $e->getLine() . "Message:" . $e->getMessage());

                $output = [
                    'success' => 0,
                    'msg' => 'Algo salió Mal aqui'
                ];
            }
            return $output;
        }
    }
}
