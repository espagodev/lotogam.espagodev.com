<?php

namespace App\Http\Controllers\Ticket;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Utils\FormatoTickets;
use App\Utils\Tickets;
use App\Services\MarketService;
use App\Utils\BancaUtil;

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

        $ticket = $this->marketService->getTicket($tickets_id);

        $promocion = $ticket[0]->tic_promocion;
        $estado = $ticket[0]->tic_estado;

        $jugadas = $this->marketService->getTicketDetalle($tickets_id);

        if (session()->get('user.TipoUsuario') == 2) {
             $isAnular = 0;
        } else if (session()->get('user.TipoUsuario') == 3) {
            $parametros =  $this->marketService->getParametrosBanca($bancas_id);
            $isAnular = BancaUtil::calcularMinutos($ticket[0]->created_at, $parametros->ban_tiempo_anular);
        }

        $receipt_details = FormatoTickets::receiptContent($empresas_id, $ticket, $bancas_id, $jugadas, $isAnular);
        dd($receipt_details);
        return view('ticket.tiket_detalle')->with(compact('receipt_details', 'tickets_id', 'isAnular', 'promocion','estado'));
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

        $ticket = $this->marketService->getTicket($tickets_id);

        $jugadas = $this->marketService->getTicketDetallePremiado($tickets_id);

        $jugada = $this->marketService->getTicketDetalle($tickets_id);

        if (session()->get('user.TipoUsuario') == 2) {
            $isAnular = 0;
        } else if (session()->get('user.TipoUsuario') == 3) {
            $parametros =  $this->marketService->getParametrosBanca($bancas_id);
            $isAnular = BancaUtil::calcularMinutos($ticket[0]->created_at, $parametros->ban_tiempo_anular);
        }

        $receipt_details = FormatoTickets::receiptContent($empresas_id, $ticket, $bancas_id, $jugada, $isAnular );
        // dd($receipt_details, $tickets_id, $ticket, $jugadas, $isAnular);
        return view('ticket.tiket_premiado')->with(compact('receipt_details', 'tickets_id', 'ticket', 'jugadas', 'isAnular'));
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

            $tickets_id = $request->get('tickets_id');
            $pin = $request->get('pin');
            $premio = $request->get('premio');
            $empresas_id = session()->get('user.emp_id');
            $users_id = session()->get('user.id');

            $data = $this->marketService->getTicketPin($empresas_id, $users_id, $tickets_id, $pin, $premio);

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
            $isAnular = BancaUtil::calcularMinutos($ticket[0]->created_at, $parametros->ban_tiempo_anular);
        }

        $receipt_details = FormatoTickets::receiptContent($empresas_id, $ticket, $bancas_id,$jugadas, $isAnular);

        return view('ticket.tiket_anular')->with(compact('receipt_details', 'tickets_id','ticket', 'isAnular'));
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

            $tickets_id = $request->get('tickets_id');
            $tia_detalle = $request->get('detalle');
            $loterias_id = $request->get('loterias_id');
            $pin = $request->get('pin');

            $empresas_id = session()->get('user.emp_id');
            $bancas_id =  session()->get('user.banca');
            $users_id =  request()->session()->get('user.id');

            $data = $this->marketService->getTicketAnular($empresas_id, $tickets_id, $pin, $users_id, $bancas_id, $tia_detalle, $loterias_id);

            return response()->json($data);

        }


    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
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
            $isAnular = BancaUtil::calcularMinutos($ticket[0]->created_at, $parametros->ban_tiempo_anular);
        }

        $receipt_details = FormatoTickets::receiptContent($empresas_id, $ticket, $bancas_id, $jugadas, $isAnular);

        return view('ticket.tiket_duplicar')->with(compact('receipt_details', 'tickets_id', 'isAnular', 'promocion', 'estado'));
    }

}
