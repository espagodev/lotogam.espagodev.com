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

//ajustes Empresa
 Route::get('ajustesEmpresa', 'AjustesEmpresaController@index')->name('ajustesEmpresa');

//comisiones
 Route::get('ajustes/comisiones/', 'ComisionesController@index')->name('comisiones');
 Route::post('comisiones', 'ComisionesController@store')->name('comisiones.store');

//montos globales
Route::get('ajustes/montosGlobales/', 'MontosGlobalesController@index')->name('montosGlobales');
Route::post('montosGlobales', 'MontosGlobalesController@store')->name('montosGlobales.store');

//montos individuales
Route::get('ajustes/montos/', 'MontosIndividualesController@index')->name('montosIndividuales');
Route::post('montosIndividuales', 'MontosIndividualesController@store')->name('montosIndividuales.store');

//numeros calientes
Route::get('ajustes/calientes', 'NumerosCalientesController@index')->name('NumerosCalientes');
Route::post('NumerosCalientes', 'NumerosCalientesController@store')->name('NumerosCalientes.store');

//premios
// Route::get('ajustes/premios', 'PremiosController@index')->name('premios');
// Route::post('premios', 'PremiosController@store')->name('premios.store');

//loterias empresa
Route::get('ajustes/loterias', 'EmpresaLoteriasController@index')->name('loteriasEmpresa');

//loterias superpale empresa
Route::get('ajustes/superpales', 'EmpresaSuperPaleController@index')->name('superPaleEmpresa');
Route::post('superPaleEmpresa', 'EmpresaSuperPaleController@store')->name('superPaleEmpresa.store');

//IMPRESORAS
//     Route::get('ajustes/impresoraPos', 'ImpresoraPosController@index')->name('impresoraPos');
// // Route::post('impresoraPos', 'ImpresoraPosController@store')->name('impresoraPos.store');
//     Route::resource('impresoraPos', 'ImpresoraPosController');
    //ajustes ticket

    Route::get('getEmpresaLoteriaEstado', 'EmpresaLoteriasController@getEmpresaLoteriaEstado');


    Route::prefix('ajustes')->group(function () {
        Route::get('impresoraPos/{impresora}', 'ImpresoraPosController@getModificarImpresoraPos');
        Route::resource('impresoraPos','ImpresoraPosController', ['except' => ['show','destroy','create','edit']]);
        Route::resource('formatoTicket', 'TicketConfiguracionController');
        Route::get('ajustesTicket/{esquema}', 'AppEsquemaTicketController@getModificarEsquema');
        Route::resource('ajustesTicket', 'AppEsquemaTicketController');
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
    Route::resource('loterias', 'LoteriasController');
    Route::resource('tiposDocumento','TiposDocumentoController', ['except' => ['show']]);
    Route::resource('mediosPago', 'MediosPagoController', ['except' => ['show']]);
    Route::resource('modalidades', 'ModalidadesController', ['except' => ['show']]);

    //ajustes bancas

    Route::get('ajustesBanca/{banca}', 'AjustesBancaController@index')->name('ajustesBanca');
    Route::get('ajustesBanca/ajsutes/{banca}', 'AjustesBancaController@bancaAjustes')->name('bancaAjustes');

    Route::get('ajustesBanca/comisiones/{banca}', 'BancaComisionController@index')->name('bancaComision');
    Route::post('ajustesBanca/comisiones', 'BancaComisionController@store')->name('bancaComision.store');


    Route::get('ajustesBanca/montosG/{banca}', 'BancaMontoGlobalController@index')->name('bancaMontoG');
    Route::post('ajustesBanca/montosG', 'BancaMontoGlobalController@store')->name('bancaMontoG.store');

    Route::get('ajustesBanca/montosI/{banca}', 'BancaMontoIndividualController@index')->name('bancaMontoI');
    Route::post('ajustesBanca/montosI', 'BancaMontoIndividualController@store')->name('bancaMontoI.store');

    Route::get('ajustesBanca/impresoraPos/{banca}', 'BancaImpresoraPosController@index')->name('bancaImpresoraPos');
    Route::post('ajustesBanca/impresoraPos', 'BancaImpresoraPosController@store')->name('bancaImpresoraPos.store');

    Route::get('ajustesBanca/loterias/{banca}', 'BancaLoteriasController@index')->name('bancaLoterias');
    Route::post('ajustesBanca/loterias', 'BancaLoteriasController@store')->name('bancaLoterias.store');

    Route::get('ajustesBanca/superpale/{banca}', 'BancaSuperPaleController@index')->name('bancaSuperPale');
    Route::post('ajustesBanca/superpale', 'BancaSuperPaleController@store')->name('bancaSuperPale.store');

    Route::get('ajustesBanca/modalidades/{banca}', 'BancaModalidadesController@index')->name('bancaModalidades');
    Route::post('ajustesBanca/modalidades', 'BancaModalidadesController@store')->name('bancaModalidades.store');



    /**
     * consultas ticketDetalle
     */

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


    Route::get('/sells/{transaction_id}/print', 'SellPosController@printInvoice')->name('sell.printInvoice');

});
