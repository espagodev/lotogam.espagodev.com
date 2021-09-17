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
        if(session()->get('user.useSupervisor') == 1){
            $bancas = BancaUtil::bancasSupervisor(session()->get('user.id'));
        }else{
            $bancas = BancaUtil::forDropdown($empresas_id);
        }


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

            if (session()->get('user.TipoUsuario') == 2) {
                $data = request()->only([ 'loterias_id', 'users_id', 'estado', 'promocion', 'bancas_id']);
            } else if (session()->get('user.TipoUsuario') == 3) {
                $data = request()->only(['loterias_id', 'estado', 'promocion']);
                $data['bancas_id'] = !empty(request()->bancas_id) ? request()->bancas_id : session()->get('user.banca');
                $data['users_id'] = !empty(request()->users_id) ? request()->users_id : session()->get('user.id');
            }

            $data['empresas_id'] = session()->get('user.emp_id');
            $data['start_date'] = request()->start;
            $data['end_date'] = request()->end;

            // $start = request()->start;
            // $end = request()->end;
            // $bancas_id = request()->bancas_id;
            // $empresas_id = session()->get('user.emp_id');
            // $users_id = Null;

            // $purchase_details = $this->homeReports->getPurchaseTotals($empresas_id, $start, $end, $bancas_id);

            $detalle_ventas = $this->homeReports->getPurchaseTotals($data);

            // dump($detalle_ventas);

            $output['total_tickets'] = $detalle_ventas->total_tickets;
            $output['total_venta'] =    $detalle_ventas->total_venta;
            $output['total_comision'] =  $detalle_ventas->total_comision;
            $output['total_premios'] = $detalle_ventas->total_premios;


            return $output;
        }
    }

    public function getVentasMes(Request $request)
    {
        if ($request->ajax()) {

            $TotalVenta = 0;
            $TotalVentaPromo = 0;
            $TotalComision = 0;
            $TotalPremios = 0;
            $TotalPremiosPromo = 0;
            $TotalGanancia = 0;

            if (session()->get('user.TipoUsuario') == 2) {
                $data =  $request->only(['start_date', 'end_date', 'users_id',  'bancas_id']);

            } else if (session()->get('user.TipoUsuario') == 3) {
                $data =  $request->only(['start_date', 'end_date', 'loterias_id', 'estado', 'promocion',]);
                $data['bancas_id'] = !empty( $request->bancas_id) ?  $request->bancas_id : session()->get('user.banca');
                $data['users_id'] = !empty( $request->users_id) ?  $request->users_id : session()->get('user.id');
            }

            $data['empresas_id'] = session()->get('user.emp_id');

            // $data = $request->only(['start_date', 'end_date', 'bancas_id', 'loterias_id', 'users_id']);
            // $data['empresas_id'] = session()->get('user.emp_id');

            $reporteVentas = Reportes::getReporteVentas($data);

            $output = '';
            foreach ($reporteVentas as  $detalle) {

                $ganancia = $detalle->total_venta - $detalle->total_comision - $detalle->total_premios_promo - $detalle->total_premios;
                $TotalVenta = $TotalVenta + $detalle->total_venta;
                $TotalVentaPromo = $TotalVentaPromo + $detalle->total_venta_promo;
                $TotalComision = $TotalComision + $detalle->total_comision;
                $TotalPremios = $TotalPremios + $detalle->total_premios;
                $TotalPremiosPromo = $TotalPremiosPromo + $detalle->total_premios_promo;

                $TotalGanancia = $TotalGanancia + $ganancia;

                $output .= '<tr>' .
                '<td>' . $detalle->lot_nombre . '</td>' .
                '<td class="text-center"><span class="display_currency" data-orig-value=' . $detalle->total_venta . ' data-currency_symbol=true> ' . $detalle->total_venta . '</td>' .
                '<td class="text-center"><span class="display_currency" data-orig-value=' . $detalle->total_venta_promo . ' data-currency_symbol=true> ' . $detalle->total_venta_promo . '</td>' .
                '<td class="text-center"><span class="display_currency" data-orig-value=' . $detalle->total_comision . ' data-currency_symbol=true> ' . $detalle->total_comision . '</td>' .
                '<td class="text-center"><span class="display_currency" data-orig-value=' . $detalle->total_premios . ' data-currency_symbol=true> ' . $detalle->total_premios . '</td>' .
                '<td class="text-center"><span class="display_currency" data-orig-value=' . $detalle->total_premios_promo . ' data-currency_symbol=true> ' . $detalle->total_premios_promo . '</td>' .
                '<td class="text-center"><span class="display_currency" data-orig-value=' . $ganancia . ' data-currency_symbol=true> ' . $ganancia . '</td>' .
                '</tr>';
            }
                $output .= '<tr>' .
                '<td><h5> Total Venta </h5> </td>' .
                '<td class="text-center"><h5><span class="display_currency" data-orig-value=' . $TotalVenta . ' data-currency_symbol=true> ' . $TotalVenta . '</h5> </td>' .
                '<td class="text-center"><h5><span class="display_currency" data-orig-value=' . $TotalVentaPromo . ' data-currency_symbol=true> ' . $TotalVentaPromo . '</h5> </td>' .
                '<td class="text-center"><h5><span class="display_currency" data-orig-value=' . $TotalComision . ' data-currency_symbol=true> ' . $TotalComision . '</h5> </td>' .
                '<td class="text-center"><h5><span class="display_currency" data-orig-value=' . $TotalPremios . ' data-currency_symbol=true> ' . $TotalPremios . '</h5> </td>' .
                '<td class="text-center"><h5><span class="display_currency" data-orig-value=' . $TotalPremiosPromo . ' data-currency_symbol=true> ' . $TotalPremiosPromo . '</h5> </td>' .
                '<td class="text-center"><h5><span class="display_currency" data-orig-value=' . $TotalGanancia . ' data-currency_symbol=true> ' . $TotalGanancia . '</h5> </td>' .
                '</tr>';
            return $output;
        }
    }

    public function getVentasMesPrint(Request $request){

        if ($request->ajax()) {
            try {
                $output = [
                    'success' => 0,
                    'msg' =>
                    'Algo salió Mal'
                ];

                if (session()->get('user.TipoUsuario') == 2) {
                    $data = $request->only(['users_id', 'bancas_id']);

                } else if (session()->get('user.TipoUsuario') == 3) {

                    $data['bancas_id'] = !empty($request->bancas_id) ? $request->bancas_id : session()->get('user.banca');
                    $data['users_id'] = !empty($request->users_id) ? $request->users_id : session()->get('user.id');
                }
                $data['empresas_id'] = session()->get('user.emp_id');
                $data['start_date'] = date('Y-m-01');
                $data['end_date'] = date('Y-m-t');


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

    public function getTickesPremiados(Request $request)
    {
        if ($request->ajax()) {

            if (session()->get('user.TipoUsuario') == 2) {
                $data =  $request->only(['start_date', 'end_date', 'users_id',  'bancas_id']);
            } else if (session()->get('user.TipoUsuario') == 3) {
                $data =  $request->only(['start_date', 'end_date', 'loterias_id', 'estado', 'promocion',]);
                $data['bancas_id'] = !empty($request->bancas_id) ?  $request->bancas_id : session()->get('user.banca');
                $data['users_id'] = !empty($request->users_id) ?  $request->users_id : session()->get('user.id');
            }

            $data['empresas_id'] = session()->get('user.emp_id');

            // $data = $request->only(['start_date', 'end_date', 'bancas_id', 'loterias_id', 'users_id', 'estado', 'promocion']);
            // $data['empresas_id'] = session()->get('user.emp_id');

            $reportePremiados =  Reportes::getReportePremiados($data);

            $output = '';
            foreach ($reportePremiados as  $detalle) {

                $tic_fecha_sorteo =  Carbon::createFromFormat('Y-m-d H:i:s', $detalle->tic_fecha_sorteo)->format('d/m/Y');
                if($detalle->tic_estado == '2'){
                    $output .= '<tr>' .
                    '<td> <a href="' .  action("Ticket\TicketController@getTicketPremiado", [$detalle->id])  . '" class="view_ticket_modal  no-print" >' . $detalle->tic_ticket . '</a></td>' .
                    '<td class="text-center">' . $tic_fecha_sorteo . '</td>' .
                    '<td>' . $detalle->lot_nombre . '</td>' .
                    '</tr>';
                }
            }

            return $output;
        }
    }


}
