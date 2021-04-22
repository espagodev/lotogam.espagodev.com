<div class="modal fade  no-print" id="recent_transactions_modal" tabindex="-1" role="dialog" aria-labelledby="modalTitle">
	<div class="modal-dialog modal-xl" role="document">
		<div class="modal-content">
			<div class="modal-header">
                 <h3 class="modal-title">Tickets Recientes</h3>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
			</div>
			<div class="modal-body">
                  <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-12 col-xs-12 col-sm-12 col-md-12">
                                <div class="form-group">
                                    <strong>Rango de Fechas:</strong>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="fa fa-calendar"></i></span>
                                        </div>
                                        <input type="text" name="date_range" id="spr_date_filter" placeholder="Seleccione un rango de fechas" readonly>

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                  </div>

                <div class="modal-body">
                    <div class="card">
                    <div class="table-responsive">
                            <table class="table table-condensed  table-striped "  id="reporte_tickets">
                                <thead>
                                    <tr>
                                        <th>Fecha</th>
                                        <th>Ticket</th>
                                        <th>Loteria</th>
                                        <th>Numeros</th>
                                        <th>Apostado</th>
                                        <th>Estado</th>
                                        <th>Opciones</th>
                                    </tr>
                                </thead>
                            </table>
                        </div>
                    </div>
                </div>
			</div>
			<div class="modal-footer">
			    <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
			</div>
		</div><!-- /.modal-content -->
	</div><!-- /.modal-dialog -->
</div>
