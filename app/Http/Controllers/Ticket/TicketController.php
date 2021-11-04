<?php

namespace App\Http\Controllers\Ticket;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Utils\FormatoTickets;
use App\Utils\Tickets;
use App\Services\MarketService;
use App\Utils\BancaUtil;
use App\Utils\TicketAgrupado;
use App\Utils\TransactionUtil;

class TicketController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
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
        $users_id = request()->session()->get('user.id');
        $ticket = Tickets::TicketBanca($users_id);

        return $ticket->id;
    }


    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($tickets_id)
    {
        $empresas_id = session()->get('user.emp_id');
        $bancas_id =  session()->get('user.banca');

        $resultado = $this->marketService->getTicket($tickets_id);

        $promocion = $resultado[0]->tic_promocion;
        $estado = $resultado[0]->tic_estado;

        $jugadas = $this->marketService->getTicketDetalle($tickets_id);

        if (session()->get('user.TipoUsuario') == 2) {
             $isAnular = 0;
        } else if (session()->get('user.TipoUsuario') == 3) {
            $parametros =  $this->marketService->getParametrosBanca($bancas_id);
            $isAnular = BancaUtil::calcularMinutos($resultado[0]->tic_fecha_sorteo, $parametros->ban_tiempo_anular);
        }

        $ticket = FormatoTickets::receiptContent($empresas_id, $resultado, $bancas_id, $jugadas, $isAnular);
        
        return view('ticket.tiket_detalle')->with(compact('ticket', 'tickets_id', 'isAnular', 'promocion','estado'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function getTicketPremiado($tickets_id)
    {
        $empresas_id = session()->get('user.emp_id');
        $bancas_id =  session()->get('user.banca');

        $resultado = $this->marketService->getTicket($tickets_id);
       
        $jugadas = $this->marketService->getTicketDetallePremiado($tickets_id);

        $jugada = $this->marketService->getTicketDetalle($tickets_id);

        if (session()->get('user.TipoUsuario') == 2) {
            $isAnular = 0;
        } else if (session()->get('user.TipoUsuario') == 3) {
            $parametros =  $this->marketService->getParametrosBanca($bancas_id);
            $isAnular = BancaUtil::calcularMinutos($resultado[0]->tic_fecha_sorteo, $parametros->ban_tiempo_anular);
        }

        $ticket = FormatoTickets::receiptContent($empresas_id, $resultado, $bancas_id, $jugada, $isAnular );
        
        return view('ticket.tiket_premiado')->with(compact('ticket', 'tickets_id', 'resultado', 'jugadas', 'isAnular'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function getPagarTicketPremiado($tickets_id)
    {
        $empresas_id = session()->get('user.emp_id');
        $bancas_id =  session()->get('user.banca');

        $ticket = $this->marketService->getTicket($tickets_id);


        return view('ticket.tiket_premiado_pagar')->with(compact('tickets_id', 'ticket'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function getPagarPremio(Request $request)
    {
        if ($request->ajax()) {

            $data['tickets_id'] = $request->get('tickets_id');
            $data['pin'] = $request->get('pin');
            $data['premio'] = $request->get('premio');
            $data['empresas_id'] = session()->get('user.emp_id');
            $data['users_id'] = session()->get('user.id');

            $data = $this->marketService->getTicketPin($data);

            return response()->json($data);

        }
    }


    public function getAnularTicket($tickets_id)
    {

        $empresas_id = session()->get('user.emp_id');
        $bancas_id =  session()->get('user.banca');

        $ticket = $this->marketService->getTicket($tickets_id);

        $jugadas = $this->marketService->getTicketDetalle($tickets_id);

        if (session()->get('user.TipoUsuario') == 2) {
            $isAnular = 0;
        } else if (session()->get('user.TipoUsuario') == 3) {
            $parametros =  $this->marketService->getParametrosBanca($bancas_id);
            $isAnular = BancaUtil::calcularMinutos($ticket[0]->tic_fecha_sorteo, $parametros->ban_tiempo_anular);
        }

        $ticket = FormatoTickets::receiptContent($empresas_id, $ticket, $bancas_id,$jugadas, $isAnular);

        return view('ticket.tiket_anular')->with(compact('ticket', 'tickets_id','ticket', 'isAnular'));
    }

         /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function getTicketAnular(Request $request)
    {
        if ($request->ajax()) {
            // dd($request);
            $tickets_id = $request->get('tickets_id');
            $tia_detalle = $request->get('detalle');
            $pin = $request->get('pin');

            $empresas_id = session()->get('user.emp_id');
            $bancas_id =  session()->get('user.banca');
            $users_id =  request()->session()->get('user.id');
            
            $data = $this->marketService->getTicketAnular($empresas_id, $tickets_id, $pin, $users_id,  $tia_detalle);

            return response()->json($data);

        }


    }

    /**
     * MOSTRAR TICKET 
     */
    public function showDuplicarTicket($tickets_id)
    {
        $empresas_id = session()->get('user.emp_id');
        $bancas_id =  session()->get('user.banca');

        $ticket = $this->marketService->getTicket($tickets_id);

        $promocion = $ticket[0]->tic_promocion;
        $estado = $ticket[0]->tic_estado;

        $jugadas = $this->marketService->getTicketDetalle($tickets_id);

        if (session()->get('user.TipoUsuario') == 2) {
            $isAnular = 0;
        } else if (session()->get('user.TipoUsuario') == 3) {
            $parametros =  $this->marketService->getParametrosBanca($bancas_id);
            $isAnular = BancaUtil::calcularMinutos($ticket[0]->tic_fecha_sorteo, $parametros->ban_tiempo_anular);
        }

        $ticket = FormatoTickets::receiptContent($empresas_id, $ticket, $bancas_id, $jugadas, $isAnular);

        return view('ticket.tiket_duplicar')->with(compact('ticket', 'tickets_id', 'isAnular', 'promocion', 'estado'));
    }

    /**
     * MOSTRAR TICKET AGRUPADO
     */
    public function showAgrupado($tickets_agrupado)
    {
  
        $data['empresas_id'] = session()->get('user.emp_id');
        $data['bancas_id'] =  session()->get('user.banca');
        $data['users_id'] = session()->get('user.id');
        $data['tipoUsuario'] = session()->get('user.TipoUsuario');
        $data['ticketAgrupado'] = $tickets_agrupado;
        $data['ticket_copia'] =  true;
        $data['printer_type'] =  'browser';

        $detalle_ticket = $this->marketService->getTicketAgrupado($data);
    
        return view('ticket.tiket_agrupado')->with(compact('detalle_ticket','tickets_agrupado'));
    }

    /**
     * Imprimir ticket agrupado
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function printTicketAgrupado($tickets_agrupado)
    {
       
        if (request()->ajax()) {
            try {
                $output = [
                    'success' => 0,
                    'msg' => "Algo salió mal, por favor intente de nuevo más tarde"
                ];

                $data['ticketAgrupado'] = $tickets_agrupado;
                $data['empresas_id'] = session()->get('user.emp_id');
                $data['bancas_id'] =  session()->get('user.banca');
                $data['ticket_copia'] =  true;
                $data['printer_type'] =  'browser';

                $detalle_ticket = $this->marketService->getTicketAgrupado($data);

                $layout = 'sale_pos.receipts.formatoAgrupadoCopia58';                     
                $receipt['html_content'] = view($layout, compact('detalle_ticket'))->render();  
                
                if (!empty($receipt)) {              
                    $output = ['success' => 1, 'receipt' => $receipt];
                }
            } catch (\Exception $e) {
                \Log::emergency("File:" . $e->getFile() . "Line:" . $e->getLine() . "Message:" . $e->getMessage());

                $output = [
                    'success' => 0,
                    'msg' => "Algo salió mal, Error al imprimir"
                ];
            }

            return $output;
        }
    }
}
