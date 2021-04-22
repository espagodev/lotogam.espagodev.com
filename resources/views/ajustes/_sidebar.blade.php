 <div class="card">
    <div class="card-body">
        <ul class="list-group">
                @component('components.sidebar', [
                    'route' => 'ajustesEmpresa',
                    'icon' => 'fa fa-cog',
                    'title' => 'Ajustes de la Empresa' ])
                @endcomponent

                @component('components.sidebar', [
                        'route' => 'ajustesTicket.index',
                        'icon' => 'fa fa-cogs',
                        'title' => 'Ajustes Tickets' ])
                @endcomponent

                @component('components.sidebar', [
                        'route' => 'formatoTicket.index',
                        'icon' => 'fa fa-cogs',
                        'title' => 'Diseño de  Tickets' ])
                @endcomponent


                @component('components.sidebar', [
                    'route' => 'comisiones',
                    'icon' => 'fa fa-percent',
                    'title' => 'Comisiones'])
                @endcomponent

                 @component('components.sidebar', [
                    'route' => 'montosGlobales',
                    'icon' => 'fa fa-hashtag',
                    'title' => 'Montos Globales'])
                @endcomponent

                @component('components.sidebar', [
                    'route' => 'montosIndividuales',
                    'icon' => 'fa fa-hashtag',
                    'title' => 'Montos Individuales'])
                @endcomponent

                @component('components.sidebar', [
                    'route' => 'NumerosCalientes',
                    'icon' => 'fa fa-fire',
                    'title' => 'Numeros Calientes'])
                @endcomponent

                @component('components.sidebar', [
                    'route' => 'premios.index',
                    'icon' => 'fa fa-gift',
                    'title' => 'Listado de Premios'])
                @endcomponent

                @component('components.sidebar', [
                    'route' => 'ajustesLoterias.index',
                    'icon' => 'fa fa-tag',
                    'title' => 'Listado de Loterias'])
                @endcomponent

                @component('components.sidebar', [
                    'route' => 'superPaleEmpresa',
                    'icon' => 'fa fa-tags',
                    'title' => 'Loterias SuperPale'])
                @endcomponent

                {{-- @component('components.sidebar', [
                    'route' => 'horario',
                    'icon' => 'fa fa-hourglass',
                    'title' => 'Horario'])
                @endcomponent --}}

                @component('components.sidebar', [
                    'route' => 'impresoraPos',
                    'icon' => 'fa fa-print',
                    'title' => 'Impresoras Pos'])
                @endcomponent

            </ul>
    </div>
</div>
