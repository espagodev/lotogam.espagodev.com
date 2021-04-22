<?php

namespace App\Http\Controllers;

use App\Utils\BancaUtil;
use Illuminate\Http\Request;

use App\Utils\HomeReports;
use App\Utils\Reportes;
use Carbon\Carbon;

class HomeController extends Controller
{
    /**
     * All Utils instance.
     *
     */

     protected $homeReports;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(

        HomeReports $homeReports
    )
    {
        $this->homeReports = $homeReports;
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $empresas_id = session()->get('user.emp_id');

        $date_filters['this_month']['start'] = date('Y-m-01');
        $date_filters['this_month']['end'] = date('Y-m-t');
        $date_filters['this_week']['start'] = date('Y-m-d', strtotime('monday this week'));
        $date_filters['this_week']['end'] = date('Y-m-d', strtotime('sunday this week'));

        //ventas para bancas individuales
        $bancas = BancaUtil::forDropdown($empresas_id);
        // dd($bancas);

        return view('home', compact('date_filters' , 'bancas'));
    }

    /**
     * Retrieves purchase and sell details for a given time period.
     *
     * @return \Illuminate\Http\Response
     */
    public function getTotals()
    {
        if (request()->ajax()) {
            $start = request()->start;
            $end = request()->end;
            $bancas_id = request()->bancas_id;
            $empresas_id = session()->get('user.emp_id');
            $users_id = Null;

            $purchase_details = $this->homeReports->getPurchaseTotals($empresas_id, $start, $end, $bancas_id);


            $output['total_tickets'] = !empty($purchase_details->total_tickets) ? $purchase_details->total_tickets : 0;
            $output['total_sell'] =    !empty($purchase_details->total_apostado) ? $purchase_details->total_apostado : 0;
            $output['invoice_due'] =   !empty($purchase_details->total_comision) ? $purchase_details->total_comision : 0;
            $output['total_expense'] = !empty($purchase_details->total_sin_comision) ? $purchase_details->total_sin_comision : 0;


            return $output;
        }
    }

    public function getVentasMes(Request $request)
    {
        if ($request->ajax()) {



            $TotalVenta = 0;
            $TotalComision = 0;
            $TotalGanado = 0;
            $TotalGanancia = 0;


            $data = $request->only(['start_date', 'end_date', 'bancas_id', 'loterias_id', 'users_id']);
            $data['empresas_id'] = session()->get('user.emp_id');

            $reporteVentas = Reportes::getReporteVentas($data);

            $output = '';
            foreach ($reporteVentas as  $detalle) {

                $TotalVenta = $TotalVenta + $detalle->venta;
                $TotalComision = $TotalComision + $detalle->comision;
                $TotalGanado = $TotalGanado +$detalle->ganado;
                $TotalGanancia = $TotalGanancia + $detalle->ganancia;

                $output .= '<tr>' .
                '<td>' . $detalle->lot_nombre . '</td>' .
                '<td class="text-center"><span class="display_currency" data-orig-value=' . $detalle->venta . ' data-currency_symbol=true> ' . $detalle->venta . '</td>' .
                '<td class="text-center"><span class="display_currency" data-orig-value=' . $detalle->comision . ' data-currency_symbol=true> ' . $detalle->comision . '</td>' .
                '<td class="text-center"><span class="display_currency" data-orig-value=' . $detalle->ganado . ' data-currency_symbol=true> ' . $detalle->ganado . '</td>' .
                '<td class="text-center"><span class="display_currency" data-orig-value=' . $detalle->ganancia . ' data-currency_symbol=true> ' . $detalle->ganancia . '</td>' .
                '</tr>';
            }
                $output .= '<tr>' .
                '<td><h5> Total Venta </h5> </td>' .
            '<td class="text-center"><h5><span class="display_currency" data-orig-value=' . $TotalVenta . ' data-currency_symbol=true> ' . $TotalVenta . '</h5> </td>' .
                '<td class="text-center"><h5><span class="display_currency" data-orig-value=' . $TotalComision . ' data-currency_symbol=true> ' . $TotalComision . '</h5> </td>' .
                '<td class="text-center"><h5><span class="display_currency" data-orig-value=' . $TotalGanado . ' data-currency_symbol=true> ' . $TotalGanado . '</h5> </td>' .
                '<td class="text-center"><h5><span class="display_currency" data-orig-value=' . $TotalGanancia . ' data-currency_symbol=true> ' . $TotalGanancia . '</h5> </td>' .
                '</tr>';
            return $output;
        }
    }

    public function getVentasMesPrint(Request $request)
    {

        if ($request->ajax()) {

            $empresas_id = session()->get('user.emp_id');

            $bancas_id = $request->get('bancas_id', null);
            $users_id = $request->get('users_id', null);

            $start_date = $request->get('start_date');
            $end_date = $request->get('end_date');

            $data = Reportes::getReporteVentasPrint($empresas_id, $start_date, $end_date, $bancas_id, $users_id);

            $output = ['success' => 1, 'receipt' => $data];

            return $output;
        }
    }

    public function getTickesPremiados(Request $request)
    {
        if ($request->ajax()) {

            $data = $request->only(['start_date', 'end_date', 'bancas_id', 'loterias_id', 'users_id', 'estado', 'promocion']);
            $data['empresas_id'] = session()->get('user.emp_id');

            $reportePremiados =  Reportes::getReportePremiados($data);

            $output = '';
            foreach ($reportePremiados as  $detalle) {

                $tic_fecha_sorteo =  Carbon::createFromFormat('Y-m-d', $detalle->tic_fecha_sorteo)->format('d/m/Y');

                $output .= '<tr>' .
                    // '<td> <a href="#" class="print-ticket" data-href="' . route('pos.printTicket', [$detalle->id]) . '">' . $detalle->tic_ticket . '</a></td>' .
                    '<td> <a href="' .  action("Ticket\TicketController@getTicketPremiado", [$detalle->id])  . '" class="view_ticket_modal  no-print" >' . $detalle->tic_ticket . '</a></td>' .
                '<td class="text-center">' . $tic_fecha_sorteo . '</td>' .
                '<td>' . $detalle->lot_nombre . '</td>' .
                // '<td class="text-center"><span class="display_currency" data-orig-value=' . $detalle->tic_apostado . ' data-currency_symbol=true> ' . $detalle->tic_apostado . '</td>' .
                // '<td class="text-center"><span class="display_currency" data-orig-value=' . $detalle->tic_ganado . ' data-currency_symbol=true> ' . $detalle->tic_ganado . '</td>' .
                '</tr>';
            }

            return $output;
        }
    }


}
