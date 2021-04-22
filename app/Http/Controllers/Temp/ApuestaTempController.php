<?php

namespace App\Http\Controllers\Temp;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Utils\Tickets;

class ApuestaTempController extends Controller
{
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


}
