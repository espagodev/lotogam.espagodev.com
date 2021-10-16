<div class="modal-dialog modal-lg" role="document">
        <div class="modal-content border-info">

            <div class="modal-header bg-info">
                <h3 class="modal-title text-white">Clonar Banca</h3>
                <button type="button" class="close text-white no-print" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            </div>
            <form method="post" action="{{ route('bancaDuplicada.store')}}"  id="store"> 
                <input type="hidden" name="ban_url" value="{{ $ban_url }}">
             @csrf
             <div class="modal-body">
                   @include('bancas.partials.form_clonar')
            </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger no-print"
                        data-dismiss="modal"><i class="fa fa-times"></i> Cerrar
                    </button>
                     <button class="btn btn-success" type="submit"><i class="fa fa-clone" aria-hidden="true"></i> Clonar</button>

                </div>
             </form>
        </div><!-- /.modal-content -->
</div><!-- /.modal-dialog -->



