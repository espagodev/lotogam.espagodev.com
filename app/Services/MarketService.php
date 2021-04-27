<?php

namespace App\Services;

use App\Traits\AuthorizesMarketRequests;
use App\Traits\ConsumesExternalServices;
use App\Traits\InteractsWithMarketResponses;

class MarketService
{
    use ConsumesExternalServices, AuthorizesMarketRequests, InteractsWithMarketResponses;

    /**
     * The url from which send the requests
     * @var string
     */
    protected $baseUri;

    public function __construct()
    {
        $this->baseUri = config('services.market.base_uri');
    }

    /**
     * * Retrieve a user information from the API
     * @return stdClass
     */
    public function getUserInformation()
    {
        return $this->makeRequest('GET', "me");
    }

    //LOTERIAS
    public function getUsuariosEmpresa($empresas_id)
    {
        return $this->makeRequest('GET', "getUsuariosEmpresa/{$empresas_id}");
    }

    /**
     * * Retrieve a user information from the API
     * @return stdClass
     */
    public function getUserPermission()
    {
        return $this->makeRequest('GET', "roles");
    }


    //LOTERIAS
    public function getLoterias()
    {
        return $this->makeRequest('GET', 'loterias');
    }

    //LOTERIAS
    public function getLoteria($loteria)
    {
        return $this->makeRequest('GET', "loterias/{$loteria}");
    }

    public function nuevaLoteria($data)
    {

        return $this->makeRequest(
            'POST',
            "loterias",
            [],
            $data,
            [],
            $hasFile = true
        );
    }

    //Modificar Loteria
    public function ModificarLoteria($loteria, $data)
    {

        $data['_method'] = 'PUT';

        return $this->makeRequest(
            'POST',
            "loterias/{$loteria}",
            [],
            $data,
            [],
            $hasFile = isset($data['lot_imagen'])
        );
    }


    public function nuevaLoteriaSuperpale($data)
    {

        return $this->makeRequest(
            'POST',
            "loteriasSuperPale",
            $data,
            [],
            [],
            false
        );
    }

    //MODALIDADES
    public function getModalidades()
    {
        return $this->makeRequest('GET', 'modalidades');
    }

    public function nuevaModalidad($data)
    {

        return $this->makeRequest(
            'POST',
            "modalidades",
            $data,
            [],
            [],
            false
        );
    }

    //Modificar Modalidades
    public function ModificarModalidades($modalidades, $data)
    {

        $data['_method'] = 'PUT';

        return $this->makeRequest(
            'POST',
            "modalidades/{$modalidades}",
            [],
            $data,
            [],
            false
        );
    }

    //MEDIOS DE PAGO
    public function getMediosPago()
    {
        return $this->makeRequest('GET', 'mediosPago');
    }

    public function nuevoMedioPago($data)
    {

        return $this->makeRequest(
            'POST',
            "mediosPago",
            $data,
            [],
            [],
            false
        );
    }

    //Modificar Medio de pago
    public function ModificarMediosPago($mediopago, $data)
    {

        $data['_method'] = 'PUT';

        return $this->makeRequest(
            'POST',
            "mediosPago/{$mediopago}",
            [],
            $data,
            [],
            false
        );
    }

    //RESULTADOS
    public function getResultados()
    {
        return $this->makeRequest('GET', 'resultados');
    }

     public function getResultadosEmpresa($empresa)
    {
        return $this->makeRequest('GET', "resultados/{$empresa}/empresa");
    }



     public function getResultadosFecha1($fecha, $loteria, $empresa)
    {

        return $this->makeRequest('GET', "resultados/{$fecha}/fecha/{$loteria}/empresa/{$empresa}/dia");

    }

    public function nuevoResultado($data)
    {

        return $this->makeRequest(
            'POST',
            "resultados",
            $data,
            [],
            [],
            false
        );
    }

    //PLANES
    public function getPlanes()
    {
        return $this->makeRequest('GET', 'planes');
    }

    public function nuevoPlan($data)
    {

        return $this->makeRequest(
            'POST',
            "planes",
            $data,
            [],
            [],
            false
        );
    }
    public function getPlan($plan)
    {
        return $this->makeRequest('GET', "planes/{$plan}");
    }

    //Modificar plan
    public function ModificarPlan($plan, $data)
    {

        $data['_method'] = 'PUT';

        return $this->makeRequest(
            'POST',
            "planes/{$plan}",
            [],
            $data,
            []
        );
    }

    //PREMIOS
    public function getPremios()
    {
        return $this->makeRequest('GET', 'premios');
    }

    public function getPremiosEmpresa($empresa)
    {
        return $this->makeRequest('GET', "premios/{$empresa}/empresa");
    }

    public function getPremio($premio)
    {
        return $this->makeRequest('GET', "premios/{$premio}");
    }

    public function nuevoPremio($data)
    {

        return $this->makeRequest(
            'POST',
            "premios",
            $data,
            [],
            [],
            false
        );
    }

    //Modificar Usuarios
    public function ModificarPremio($premio, $data)
    {

        $data['_method'] = 'PUT';

        return $this->makeRequest(
            'POST',
            "premios/{$premio}",
            [],
            $data,
            []
        );
    }


    //TIPOS DE DOCUMENTO
    public function getTipoDocumento()
    {
        return $this->makeRequest('GET', 'tiposDocumento');
    }

    public function nuevoTipoDocumento($data)
    {

        return $this->makeRequest(
            'POST',
            "tiposDocumento",
            $data,
            [],
            [],
            false
        );
    }

    //Modificar tipo Documento
    public function ModificarTipoDocumento($tipoDocumento, $data)
    {

        $data['_method'] = 'PUT';

        return $this->makeRequest(
            'POST',
            "tiposDocumento/{$tipoDocumento}",
            [],
            $data,
            [],
           false
        );
    }

    //EMPRESAS
    public function getEmpresas()
    {
        return $this->makeRequest('GET', 'empresas');
    }

    // EMPRESA DETALLE
    public function getEmpresaDetalle($empresa)
    {
        // dd($empresa);
        return $this->makeRequest('GET', "getEmpresaDetalle/{$empresa}");
    }


    // EMPRESA MONEDA
    public function getEmpresaMoneda($empresa)
    {
        // dd($empresa);
        return $this->makeRequest('GET', "empresa/{$empresa}/moneda");
    }

    public function nuevaEmpresa($data)
    {

        return $this->makeRequest(
            'POST',
            "empresas",
            [],
            $data,
            [],
            true
        );
    }

    //Modificar Banca
    public function ModificarEmpresa($empresa, $data)
    {

        $data['_method'] = 'PUT';

        return $this->makeRequest(
            'POST',
            "empresas/{$empresa}",
            [],
            $data,
            [],
            $hasFile = isset($data['emp_imagen'])
        );
    }

    //appConfigEmpresas
    public function getAppConfigEmpresas()
    {
        return $this->makeRequest('GET', 'appConfigEmpresas');
    }

    public function nuevaAppConfigEmpresas($data)
    {

        return $this->makeRequest(
            'POST',
            "appConfigEmpresas",
            $data,
            [],
            [],
            false
        );
    }

    //appConfigFacturas
    public function getAppConfigFacturas()
    {
        return $this->makeRequest('GET', 'appConfigFacturas');
    }

    public function nuevaAppConfigFacturas($data)
    {

        return $this->makeRequest(
            'POST',
            "appConfigFacturas",
            $data,
            [],
            [],
            false
        );
    }

 //appConfigTickets
    public function nuevaAppConfigTickets($data)
    {

        return $this->makeRequest(
            'POST',
            "appConfigTickets",
            [],
            $data,
            [],
            $hasFile = true
        );
    }

    //appConfigTickets
    public function nuevaAppEsquemaTickets($data)
    {
        return $this->makeRequest(
            'POST',
            "appEsquemaTickets",
            $data,
            [],
            [],
            false
        );
    }

     //appConfigTickets editar
    public function getAppEsquemaTickets($id)
    {
        return $this->makeRequest('GET', "appEsquemaTickets/{$id}");
    }


     //appConfigTickets editar
    public function ModificarAppEsquemaTickets($id, $data)
    {
        $data['_method'] = 'PUT';
        return $this->makeRequest(
            'POST',
            "appEsquemaTickets/{$id}",
            $data,
            [],
            [],
            false
        );
    }


    //appConfigTickets Banca
    public function getAppEsquemaTicketsBanca($banca)
    {
        return $this->makeRequest('GET', "appEsquemaTickets/{$banca}/banca");
    }


    //appConfigTickets EMPRESA
    public function getAppConfigTicketsEmpresa($empresas_id)
    {
        return $this->makeRequest('GET', "getAppConfigTicketsEmpresa/{$empresas_id}");
    }

    //appConfigTickets EMPRESA
    public function getAppEsquemaTicketsEmpresa($empresa)
    {
        return $this->makeRequest('GET', "appEsquemaTickets/{$empresa}/empresa");
    }

    //appConfigTickets EMPRESA
    public function getAppConfigTickets($empresas_id, $layout_id)
    {
        return $this->makeRequest('GET', "getAppConfigTickets/{$empresas_id}/{$layout_id}");
    }

    //nuevo ticket
    public function ModificarAppConfigTickets($config_tickets, $data)
    {

        $data['_method'] = 'PUT';

        return $this->makeRequest(
            'POST',
            "appConfigTickets/{$config_tickets}",
            [],
            $data,
            [],
            $hasFile = isset($data['tcon_logo'])
        );
    }



     //COMISIONES
    public function getComisiones()
    {
        return $this->makeRequest('GET', 'comisiones');
    }

    public function nuevaComision($data)
    {

        return $this->makeRequest(
            'POST',
            "comisiones",
            $data,
            [],
            [],
            false
        );
    }

     public function nuevaComisionBanca($data)
    {

        return $this->makeRequest(
            'POST',
            "comisionesBanca",
            $data,
            [],
            [],
            false
        );
    }

      //montos Globales
    public function getMontosGlobales()
    {
        return $this->makeRequest('GET', 'montosGlobales');
    }

    public function nuevoMontoGlobal($data)
    {

        return $this->makeRequest(
            'POST',
            "montosGlobales",
            $data,
            [],
            [],
            false
        );
    }


    public function nuevoMontoGlobalBanca($data)
    {

        return $this->makeRequest(
            'POST',
            "montosGlobalesBanca",
            $data,
            [],
            [],
            false
        );
    }

      //montos individuales
    public function getMontosIndividuales()
    {
        return $this->makeRequest('GET', 'montosindividuales');
    }

    public function nuevoMontoIndividual($data)
    {

        return $this->makeRequest(
            'POST',
            "montosindividuales",
            $data,
            [],
            [],
            false
        );
    }

     public function nuevoMontoIndividualBanca($data)
    {

        return $this->makeRequest(
            'POST',
            "montosindividualesBanca",
            $data,
            [],
            [],
            false
        );
    }

      //numeros calientes
    public function getNumerosCalientes()
    {
        return $this->makeRequest('GET', 'numerosCalientes');
    }

    public function nuevoNumeroCaliente($data)
    {

        return $this->makeRequest(
            'POST',
            "numerosCalientes",
            $data,
            [],
            [],
            false
        );
    }

    //numeros calientes  EMPRESA
    public function getNumeroCalienteEmpresa($apuesta,$empresa)
    {
        return $this->makeRequest('GET', "numero/{$apuesta}/caliente/{$empresa}/empresa");
    }

    //LOTERIAS EMPRESA
    public function  getLoteriasEmpresa($empresa)
    {
        return $this->makeRequest('GET', "loterias/{$empresa}/empresa");
    }

    public function  getLoteriasEmpresaFaltantes($empresa)
    {
        return $this->makeRequest('GET', "getloteriasEmpresa/{$empresa}");
    }
    //ESTADO LOTERIA EMPRESA
    public function  getEmpresaLoteriaEstado($data)
    {
        return $this->makeRequest('GET', "getEmpresaLoteriaEstado", $data);
    }

    //LOTERIAS SUPERPALE
    public function getLoteriasSuperpale($empresa)
    {
        return $this->makeRequest('GET', "superpale/{$empresa}/empresa");
    }

    //horario loteria
    public function ModificarHorarioLoteria($loteria, $data)
    {
        $data['_method'] = 'PUT';

         return $this->makeRequest(
            'POST',
            "HorarioLoterias/{$loteria}",
            [],
            $data,
            []
        );
    }

    public function nuevoHorarioLoteria($data)
    {
        // dd($data);
        return $this->makeRequest(
            'POST',
            "HorarioLoterias",
            $data,
            [],
            [],
            false
        );
    }

    public function getloteriaHorario($empresas_id, $loterias_id)
    {
        return $this->makeRequest('GET', "getloteriaHorario/{$empresas_id}/{$loterias_id}");
    }


    //IMPRESORA POS
    public function getImpresoras()
    {
        return $this->makeRequest('GET', 'ImpresorasPos');
    }

     public function getImpresorasEmpresa($empresa)
    {
        return $this->makeRequest('GET', "getImpresorasEmpresa/{$empresa}");
    }

    public function getImpresoraDetalle($impresora)
    {

        return $this->makeRequest('GET', "ImpresorasPos/{$impresora}");
    }

    public function nuevaImpresora($data)
    {

        return $this->makeRequest(
            'POST',
            "ImpresorasPos",
            $data,
            [],
            [],
            false
        );
    }

    public function ModificarImpresora($impresora, $data)
    {

        $data['_method'] = 'PUT';

        return $this->makeRequest(
            'POST',
            "ImpresorasPos/{$impresora}",
            [],
            $data,
            []
        );
    }


    //IMPRESORA BANCADO

    public function getImpresorasBanca($banca)
    {
        return $this->makeRequest('GET', "impresora/{$banca}/banca");
    }

     //Monedas
    public function getMonedas()
    {
        return $this->makeRequest('GET', 'monedas');
    }

    //Bancas Empresa
     public function getListaBancaEmpresa($empresas_id)
    {
        return $this->makeRequest('GET', "getListaBancaEmpresa/{$empresas_id}");
    }

    public function getBancasEmpresa($empresas_id)
    {
        return $this->makeRequest('GET', "getBancasEmpresa/{$empresas_id}");
    }


      //bancas

    public function nuevaBanca($data)
    {
        return $this->makeRequest(
            'POST',
            "bancas",
            $data,
            [],
            [],
            false
        );
    }

    //Modificar Banca
    public function ModificarBanca($banca, $data)
    {

        $data['_method'] = 'PUT';

        return $this->makeRequest(
            'POST',
            "bancas/{$banca}",
            [],
            $data,
            []
        );
    }

    // //Usuarios Empresa
    // public function getUsuariosEmpresa($empresa)
    // {
    //     return $this->makeRequest('GET', "usuario/{$empresa}/empresa");
    // }


    //usuarios

    public function nuevoUsuario($data)
    {
        return $this->makeRequest(
            'POST',
            "usuarios",
            $data,
            [],
            [],
            false
        );
    }

    //Modificar Usuarios
    public function ModificarUsuario($usuario, $data)
    {

        $data['_method'] = 'PUT';

        return $this->makeRequest(
            'POST',
            "usuarios/{$usuario}",
            [],
            $data,
            []
        );
    }

    public function getUsuario($usuario)
    {
        return $this->makeRequest('GET', "usuarios/{$usuario}");
    }

    //LOTERIAS banca
    public function getLoteriasBanca($banca)
    {
        return $this->makeRequest('GET', "loterias/{$banca}/banca");
    }


    //Bancas Detalle
     public function getBancaDetalle($banca)
    {

        return $this->makeRequest('GET', "banca/{$banca}");
    }

    public function getBanca($banca)
    {
        return $this->makeRequest('GET', "getBancaDetalle/{$banca}");
    }

    public function getParametrosBanca($banca)
    {
        return $this->makeRequest('GET', "getParametrosBanca/{$banca}");
    }

        //comisiones EMPRESA
    public function getComisionesEmpresa($empresa)
    {
        return $this->makeRequest('GET', "comisiones/{$empresa}/empresa");
    }

    //comisiones banca
    public function getComisionesBanca($banca)
    {
        return $this->makeRequest('GET', "comisionesBanca/{$banca}");
    }

        //MONTOSGLOBALES EMPRESA
    public function getMontosGlobalesEmpresa($empresa)
    {
        return $this->makeRequest('GET', "montosGlobales/{$empresa}/empresa");
    }

         //MONTOSINDIVIDUALES EMPRESA
    public function getMontosIndividualesEmpresa($empresa)
    {
        return $this->makeRequest('GET', "montosIndividuales/{$empresa}/empresa");
    }

    //NUMEROS CALIENTES EMPRESA
    public function getNumerosCalientesEmpresa($empresa)
    {
        return $this->makeRequest('GET', "numerosCalientes/{$empresa}/empresa");
    }

    //LOTERIAS EMPRESA
    public function getTicketsEmpresa($empresa)
    {
        return $this->makeRequest('GET', "tickets/{$empresa}/empresa");
    }

    //nuevo ticket
    public function postNuevoTicket($data)
    {

        return $this->makeRequest(
            'POST',
            "tickets",
            $data,
            [],
            [],
            false
        );
    }

    //nuevo ticket
    public function ModificarTicket($ticket, $data)
    {

       $data['_method'] = 'PUT';

        return $this->makeRequest(
            'POST',
            "tickets/{$ticket}",
            [],
            $data,
            []
        );
    }



    /**
     * consultas para los tickets
     */

    //TICKET BANCA
    // public function getTicketBanca($banca)
    // {
    //     return $this->makeRequest('GET', "ticket/{$banca}/banca");
    // }

    //TICKET
    public function getTicket($ticket)
    {

        return $this->makeRequest('GET', "getTicket/{$ticket}");
    }

    //TICKET DETALLE
    public function getTicketDetalle($ticket)
    {

        return $this->makeRequest('GET', "getTicketDetalle/{$ticket}");
    }



    //BORRAR JUGADA DE TICKET DETALLE
    public function deleteApuestaDetalleBanca($jugada)
    {

        return $this->makeRequest('DELETE', "eliminarApuesta/{$jugada}");
    }

    //BORRAR JUGADA DE TICKET DETALLE
    public function deleteApuestaTempDetalle($banca, $usuario)
    {
        return $this->makeRequest('DELETE', "eliminar/{$banca}/apuesta/{$usuario}");
    }

    public function getTicketDetalleJugada($usuario,$numero)
    {

        return $this->makeRequest('GET', "ticket/{$usuario}/detalle/{$numero}/jugada");
    }

    public function getDuplicarTicket($bancas_id, $users_id, $tickets_id)
    {

        return $this->makeRequest('GET', "getDuplicarTicket/{$bancas_id}/{$users_id}/{$tickets_id}");
    }

    //actualizar ticket detalle
    public function actualizarTicketDetalleBanca($ticket, $numero, $data, $nueva_comision)
    {

        return $this->makeRequest(
            'PUT',
            "ticket/{$ticket}/detalle/{$numero}/modificar/{$data}/comision/{$nueva_comision}"
        );
    }

    public function getMontoApuestaModalidad($banca, $modalidad)    {

        return $this->makeRequest('GET', "monto/{$banca}/individual/{$modalidad}/modalidad");
    }

    public function getMontoComisionModalidad($banca, $modalidad)
    {
        return $this->makeRequest('GET', "comision/{$banca}/modalidad/{$modalidad}/banca");
    }

    public function getMontosIndividualesBanca($banca)
    {

        return $this->makeRequest('GET', "montosindividualesBanca/{$banca}");
    }

    public function getMontoGlobalBanca($banca)
    {

        return $this->makeRequest('GET', "montosGlobalesBanca/{$banca}");
    }


    //actualizar apuesta detalle temp
    public function actualizarApuestaDetalleTemp($apuesta, $data)
    {

        $data['_method'] = 'PUT';
        // dd($apuesta, $data);
        return $this->makeRequest(
            'POST',
            "apuestaJugada/{$apuesta}",
            [],
            $data,
            []
        );

    }

    public function getApuestaDetalleTempJugada($banca, $usuario, $numero)
    {
        return $this->makeRequest('GET', "apuesta/{$banca}/detalle/{$usuario}/temporal/{$numero}/jugada");
    }

    //TICKET detalle temp
    public function getApuestaDetalleTemp($banca, $usuario)
    {

        return $this->makeRequest('GET', "apuesta/{$banca}/detalle/{$usuario}/temp");
    }

    //nuevo ticketdetalle
    public function nuevaApuestaTemp($data)
    {

        return $this->makeRequest(
            'POST',
            "apuestaTemp",
            $data,
            [],
            [],
            false
        );
    }

    //nuevo ticketdetalle
    public function nuevoTicketDetalleBanca($data)
    {

        return $this->makeRequest(
            'POST',
            "ticketsDetalle",
            $data,
            [],
            [],
            false
        );
    }

    //control juegos

    public function getConsultaControlJugada($usuario, $numero, $loteria, $fecha)
    {
        return $this->makeRequest('GET', "getConsultaControlJugada/{$usuario}/{$numero}/{$loteria}/{$fecha}");
    }

    //nuevo ticketdetalle
    public function nuevoControlJugadas($data)
    {

        return $this->makeRequest(
            'POST',
            "controlJugadas",
            $data,
            [],
            [],
            false
        );
    }

    //nuevo ticket
    public function actualizarControlJugadas($numero, $data)
    {

        $data['_method'] = 'PUT';

        return $this->makeRequest(
            'POST',
            "controlJugadas/{$numero}",
            [],
            $data,
            []
        );
    }

    public function getControlJugadas($usuario)
    {
        return $this->makeRequest('GET', "listado/{$usuario}/ControlJugadas");
    }

    //Horario Loteria
    public function getHorarioLoteriasBanca($banca, $dia)
    {
        return $this->makeRequest('GET', "horario/{$banca}/loteria/{$dia}/banca");
    }


    //Home reportes
    public function getHomereportes($empresas_id, $start_date, $end_date, $bancas_id, $users_id)
    {
        return $this->makeRequest('GET', "getPurchaseTotals/{$empresas_id}/{$start_date}/{$end_date}/{$bancas_id}/{$users_id}");
    }

    //Reportes
    public function getReporteVentas($data)
    {
        return $this->makeRequest('GET', "getReporteVentas",$data);
    }

    public function getReporteTickets($data)
    {
        return $this->makeRequest('GET',"getReporteTickets", $data);
    }

    public function getReportePremiados($data)
    {
        return $this->makeRequest('GET', "getReportePremiados", $data);
    }

    public function getReporteResultados($data)
    {
        return $this->makeRequest('GET', "getReporteResultados", $data);
    }

    public function getReporteModalidades($data)
    {

        return $this->makeRequest('GET', "getReporteModalidades", $data);
    }

        public function getReporteJugadas($data)
    {
        return $this->makeRequest('GET', "getReporteJugadas", $data);
    }

    //REPORTE DETALLES
    public function getreporteVentasDetalle($empresas_id, $start_date, $end_date, $bancas_id, $users_id, $loterias_id)
    {
        return $this->makeRequest('GET', "getreporteVentasDetalle/{$empresas_id}/{$start_date}/{$end_date}/{$loterias_id}/{$bancas_id}/{$users_id}");
    }

    public function getreporteResultadosDetalle($empresas_id, $start_date, $end_date, $loterias_id)
    {
        return $this->makeRequest('GET', "getreporteResultadosDetalle/{$empresas_id}/{$start_date}/{$end_date}/{$loterias_id}");
    }

    public function getreporteTicketsDetalle($empresas_id, $start_date, $end_date, $tickets_id)
    {
        return $this->makeRequest('GET', "getreporteTicketsDetalle/{$empresas_id}/{$start_date}/{$end_date}/{$tickets_id}");
    }

    public function getReporteModalidadesDetalle($data)
    {
        return $this->makeRequest('GET', "getReporteModalidadesDetalle", $data);
    }

    public function getResultadosFecha($empresas_id, $start_date, $end_date)
    {
        return $this->makeRequest('GET', "getResultadosFecha/{$empresas_id}/{$start_date}/{$end_date}");
    }

    public function getResultadosFechaPrint($empresas_id, $start_date, $end_date)
    {
        return $this->makeRequest('GET', "getResultadosFechaPrint/{$empresas_id}/{$start_date}/{$end_date}");
    }

    public function getReporteVentasPrint($data)
    {
        return $this->makeRequest('GET', "getReporteVentasPrint", $data);
    }

    //reportes utilidades
    public function getloteriasEmpresaReporte($empresas_id)
    {
        return $this->makeRequest('GET', "getloteriasEmpresaReporte/{$empresas_id}");
    }

    public function getloteriasEmpresaHorario($empresas_id)
    {
        return $this->makeRequest('GET', "getloteriasEmpresaHorario/{$empresas_id}");
    }

    //horario loterias empresa por dia
    public function  getHorarioLoteriasDia($empresas_id, $dia, $bancas_id)
    {
        return $this->makeRequest('GET', "getHorarioLoteriasDia/{$empresas_id}/{$dia}/{$bancas_id}");
    }

    /**
     * ESTADOS
     */

    public function getEstadoTiposDocumeno($tipoDocumento_id, $estado)
    {
        return $this->makeRequest('GET', "getEstadoTiposDocumeno/{$tipoDocumento_id}/{$estado}");
    }

    /**
     * TICKET BANCA
     */

    public function getGenerarTicket($empresas_id, $tickets_id, $bancas_id)
    {
        return $this->makeRequest('GET', "getGenerarTicket/{$empresas_id}/{$tickets_id}/{$bancas_id}");
    }

    public function getTicketPin($empresas_id, $tickets_id, $pin, $premio)
    {

        return $this->makeRequest('GET', "getTicketPin/{$empresas_id}/{$tickets_id}/{$pin}/{$premio}");
    }

    public function getTicketAnular($empresas_id, $tickets_id, $pin, $users_id, $bancas_id,$tia_detalle, $loterias_id)
    {

        return $this->makeRequest('GET', "getTicketAnular/{$empresas_id}/{$tickets_id}/{$pin}/{$users_id}/{$bancas_id}/{$tia_detalle}/{$loterias_id}");
    }


}
