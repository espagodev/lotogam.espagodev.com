<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('/auth/login');
});


Auth::routes(['register' => false, 'reset' => false ]);

Route::middleware(['SetSessionData', 'timezone'])->group(function () {

Route::get('/home', 'HomeController@index')->name('home');

Route::get('/home/get-totals', 'HomeController@getTotals');

Route::get('/dashboard/getVentasMes', 'HomeController@getVentasMes');

Route::get('/dashboard/getVentasMesPrint', 'HomeController@getVentasMesPrint');

Route::get('/dashboard/getTickesPremiados', 'HomeController@getTickesPremiados');

// Route::get('/', 'WelcomeController@showWelcomePage')->name('welcome');

Route::get('authorization', 'Auth\LoginController@authorization')->name('authorization');

    //SELECT
    Route::get('select/getbancas', 'BancasController@getbancas');
    Route::get('select/getusuarios', 'UsuariosController@getusuarios');
    //Route::get('publisher/getequipos', 'PublisherController@getequipos')->name('getequipos');


//ajustes Empresa
 Route::get('ajustesEmpresa', 'AjustesEmpresaController@index')->name('ajustesEmpresa');


//numeros calientes
Route::get('ajustes/calientes', 'NumerosCalientesController@index')->name('NumerosCalientes');
Route::post('NumerosCalientes', 'NumerosCalientesController@store')->name('NumerosCalientes.store');
 Route::get('getNumerosCalientesEstado', 'NumerosCalientesController@getNumerosCalientesEstado');
 Route::get('getNumerosCalientesDelete/{resultado_id}', 'NumerosCalientesController@getNumerosCalientesDelete');


//loterias empresa
Route::get('ajustes/loterias', 'EmpresaLoteriasController@index')->name('loteriasEmpresa');

//loterias superpale empresa

Route::get('ajustes/superpales', 'EmpresaSuperPaleController@index')->name('superPaleEmpresa');
Route::post('superPaleEmpresa', 'EmpresaSuperPaleController@store')->name('superPaleEmpresa.store');
Route::get('getSuperPaleEmpresaDelete/{loterias_id}', 'EmpresaSuperPaleController@getSuperPaleEmpresaDelete');
Route::get('superPaleEmpresa/{loteria_id}', 'EmpresaSuperPaleController@getModificarLoteriaSuperPale');
Route::resource('superPaleEmpresa','EmpresaSuperPaleController', ['except' => ['show','destroy','create','edit']]);

//IMPRESORAS
//     Route::get('ajustes/impresoraPos', 'ImpresoraPosController@index')->name('impresoraPos');
// // Route::post('impresoraPos', 'ImpresoraPosController@store')->name('impresoraPos.store');
//     Route::resource('impresoraPos', 'ImpresoraPosController');
    //ajustes ticket


    Route::get('activarDesactivarLoteria/{loterias_id}', 'EmpresaLoteriasController@activarDesactivarLoteria');


    Route::prefix('ajustes')->group(function () {


        Route::get('comisiones/{comision}', 'ComisionesController@getModificarComision');
        Route::get('getNuevaComision', 'ComisionesController@getNuevaComision');
        Route::resource('comisiones', 'ComisionesController');

        Route::get('montosGlobales/{montoGlobal}', 'MontosGlobalesController@getModificarMontoGlobal');
        Route::get('getNuevoMontoGlobal', 'MontosGlobalesController@getNuevoMontoGlobal');
        Route::resource('montosGlobales', 'MontosGlobalesController');

        Route::get('montosIndividuales/{montoIndividual}', 'MontosIndividualesController@getModificarMontoIndividual');
        Route::get('getNuevoMontoIndividual', 'MontosIndividualesController@getNuevoMontoIndividual');
        Route::resource('montosIndividuales', 'MontosIndividualesController');


        Route::get('impresoraPos/{impresora}', 'ImpresoraPosController@getModificarImpresoraPos');
        Route::resource('impresoraPos','ImpresoraPosController', ['except' => ['show','destroy','create','edit']]);

        Route::resource('formatoTicket', 'TicketConfiguracionController');
        Route::get('ajustesTicket/{esquema}', 'AppEsquemaTicketController@getModificarEsquema');
        Route::resource('ajustesTicket', 'AppEsquemaTicketController');
        Route::get('ajustesComunes', 'EmpresasController@ajustesComunes')->name('ajustesComunes');
        Route::resource('premios', 'PremiosController');
        Route::resource('ajustesLoterias', 'EmpresaLoteriasController');
    });


    /**
     *
     * validaciones resultados
     */

    Route::get('getNuevoResultado', 'ResultadosController@getNuevoResultado');
    Route::resource('resultados', 'ResultadosController', ['except' => ['show']]);
    Route::get('validaHoraCierre', 'ResultadosController@validaHoraCierre');
    Route::post('guardarResultados', 'ResultadosController@guardarResultados');

    Route::resource('appConfigEmpresas', 'AppConfigEmpresasController');
    Route::resource('appConfigFacturas', 'AppConfigFacturasController');

    Route::resource('empresas', 'EmpresasController');
    Route::resource('planes', 'PlanesController');
    Route::resource('bancas', 'BancasController');
    Route::resource('usuarios', 'UsuariosController');
    Route::resource('suscripcion', 'SuscripcionController');

    Route::get('loterias/{loteria}', 'LoteriasController@getModificarLoteria');
    Route::get('getNuevaLoteria', 'LoteriasController@getNuevaLoteria');
    Route::resource('loterias', 'LoteriasController');

    Route::resource('tiposDocumento','TiposDocumentoController', ['except' => ['show']]);
    Route::resource('mediosPago', 'MediosPagoController', ['except' => ['show']]);
    Route::resource('modalidades', 'ModalidadesController', ['except' => ['show']]);

    //ajustes bancas

    Route::get('ajustesBanca/{banca}', 'AjustesBancaController@index')->name('ajustesBanca');
    Route::put('updateAjustesImpresion/{banca}', 'AjustesBancaController@updateAjustesImpresion')->name('updateAjustesImpresion');
    Route::put('updateAjustesAdicionales/{banca}', 'AjustesBancaController@updateAjustesAdicionales')->name('updateAjustesAdicionales');
    Route::get('ajustesBanca/{banca}', 'AjustesBancaController@index')->name('ajustesBanca');
    Route::get('ajustesBanca/ajsutes/{banca}', 'AjustesBancaController@bancaAjustes')->name('bancaAjustes');

    Route::get('ajustesBanca/comisiones/{banca}', 'BancaComisionController@index')->name('bancaComision');
    Route::post('ajustesBanca/comisiones', 'BancaComisionController@store')->name('bancaComision.store');


    Route::get('ajustesBanca/montos/{banca}', 'BancaMontosController@index')->name('bancaMonto');

    Route::get('ajustesBanca/impresoraPos/{banca}', 'BancaImpresoraPosController@index')->name('bancaImpresoraPos');


    Route::get('ajustesBanca/loterias/{banca}', 'BancaLoteriasController@index')->name('bancaLoterias');
    Route::post('ajustesBanca/loterias', 'BancaLoteriasController@store')->name('bancaLoterias.store');

    Route::get('ajustesBanca/superpale/{banca}', 'BancaSuperPaleController@index')->name('bancaSuperPale');
    Route::post('ajustesBanca/superpale', 'BancaSuperPaleController@store')->name('bancaSuperPale.store');

    Route::get('ajustesBanca/modalidades/{banca}', 'BancaModalidadesController@index')->name('bancaModalidades');
    Route::post('ajustesBanca/modalidades', 'BancaModalidadesController@store')->name('bancaModalidades.store');



    /**
     * consultas ticketDetalle
     */

    Route::get('validar', 'Temp\ApuestaDetalleTempController@getvalidarMontos');
    Route::get('validarLoteriaSeleccionada', 'Temp\ApuestaDetalleTempController@getvalidarLoteriaSeleccionada');

    Route::resource('apuestaTemp', 'Temp\ApuestaTempController', ['only' => ['index']]);
    Route::get('duplicarTicket/{ticket}', 'Temp\ApuestaDetalleTempController@duplicarTicket');
    Route::resource('apuestaDetalleTemp', 'Temp\ApuestaDetalleTempController', ['only' => ['index', 'store', 'update', 'destroy']]);

    Route::delete('eliminarApuesta/{jugada}', 'Temp\ApuestaDetalleTempController@eliminarApuesta');
    Route::delete('eliminar/{banca}/jugadas/{usuario}', 'Temp\ApuestaDetalleTempController@eliminarJugadas');
    // Route::resource('TicketDetalle', 'Ticket\TicketDetalleController', ['only' => ['index', 'store', 'update', 'destroy']]);



    Route::get('pos/getHorarioLoteriasDia', 'PosController@getHorarioLoteriasDia');
    Route::get('pos/getLoteriasSuperPale', 'PosController@getLoteriasSuperPale');

    Route::get('pos/getLoteriasSuperPale', 'PosController@getLoteriasSuperPale');

    Route::get('/pos/{ticket}/ticket', 'PosController@printTicket')->name('pos.printTicket');
    Route::resource('pos','PosController', ['except' => ['edit', 'show', 'destroy']]);


    /**
     * control de Jugadas
     */

    Route::resource('controlJugadas', 'ControlJugadas\ControlJugadasController', ['only' => ['index']]);

    /**
     * Reportes
     */
    Route::get('reportes/reporte-ventas', 'ReportesController@reporteVentas');
    Route::get('reportes/reporte-premiados', 'ReportesController@reportePremiados');
    Route::get('reportes/reporte-tickets', 'ReportesController@reporteTickets');
    Route::get('reportes/reporte-modalidades', 'ReportesController@reporteModalidades');
    Route::get('reportes/reporte-resultados', 'ReportesController@reporteResultados');
    Route::get('reportes/reporte-jugadas', 'ReportesController@reporteJugadas');
    Route::get('reportes/reporte-registros', 'ReportesController@getReporteRegistro');

    Route::get('reportes/informe-ventas-pagos', 'ReportesController@informeVentasPagos');

    /**
     * Reportes Detalle
     */
    Route::get('reportes/reporte-ventas-detalle', 'ReportesController@reporteVentasDetalle');
    Route::get('reportes/reporte-resultados-detalle', 'ReportesController@reporteResultadosDetalle');
    Route::get('reportes/reporte-modalidades-detalle', 'ReportesController@reporteModalidadesDetalle');
    Route::get('reportes/reporte-tickets-detalle', 'ReportesController@reporteTicketsDetalle');


    /**
    *imprimir reportes
    */
    Route::get('reportes/getVentasPrint', 'ReportesController@getVentasPrint');
    /**
     * RESULTADOS POR FECHA
     */
    Route::get('/resultados/resultados-fecha', 'ResultadosController@getResultadosFecha');
    Route::get('getResultadosFechaPrint', 'ResultadosController@getResultadosFechaPrint');
    Route::get('getResultadosDelete/{resultado_id}', 'ResultadosController@getResultadosDelete');

    /**
     * MODIFICAR ESTADOS
     */

    //tickets
    Route::get('anularTicket/{ticket}', 'Ticket\TicketController@getAnularTicket');
    Route::get('ticketPremiado/{ticket}', 'Ticket\TicketController@getTicketPremiado');
    Route::get('pagarTicket/{ticket}/Premiado', 'Ticket\TicketController@getPagarTicketPremiado');
    Route::get('/ticketAnular', 'Ticket\TicketController@getTicketAnular');
    Route::get('/pagarPremio', 'Ticket\TicketController@getPagarPremio');
    Route::get('showDuplicarTicket/{ticket}', 'Ticket\TicketController@showDuplicarTicket');

    Route::resource('Ticket', 'Ticket\TicketController');

    /**
     * CAJA REGISTRADORA
     */

    Route::get('/caja-registradora/detalle-registro', 'CajaRegistradoraController@getDetalleRegistro');
    Route::get('/caja-registradora/cerrar-registro/{id?}', 'CajaRegistradoraController@getCerrarRegistro');
    Route::post('/caja-registradora/cerra-registro', 'CajaRegistradoraController@postCerrarRegistro');
    Route::resource('caja-registradora', 'CajaRegistradoraController');

    Route::post('/caja-registradora/getprogressbar', 'CajaRegistradoraController@getProgressBar');

    Route::resource('caja-registradora-detalle', 'CajaRegistradoraDetalleController');

    //CUADRE DE CAJA
    Route::get('/caja_general/getCajaGeneralDetalle', 'CajaGeneralController@getCajaGeneralDetalle');
    Route::get('/caja_general/getCajaGeneral', 'CajaGeneralController@getCajaGeneral');
    Route::resource('cuadre-caja', 'CajaGeneralController', ['except' => ['show']]);



});
