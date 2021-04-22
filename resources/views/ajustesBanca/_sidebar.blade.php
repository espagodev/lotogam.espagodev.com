     <div class="card">
        <div class="card-body">
               <ul class="list-group">
                @component('components.sidebarBanca', [
                    'route' => 'ajustesBanca',
                    'icon' => 'fa fa-cog',
                    'title' => 'Ajuste de la Banca',
                    'banca' => $banca->ban_url ])
                @endcomponent

                 @component('components.sidebarBanca', [
                    'route' => 'bancaImpresoraPos',
                    'icon' => 'fa fa-print',
                    'title' => 'Ajustes de Impresiòn',
                    'banca' => $banca->ban_url])
                @endcomponent

                 @component('components.sidebarBanca', [
                    'route' => 'bancaAjustes',
                    'icon' => 'fa fa-snowflake-o',
                    'title' => 'Ajustes Adicionales',
                    'banca' => $banca->ban_url])
                @endcomponent

                @component('components.sidebarBanca', [
                    'route' => 'bancaComision',
                    'icon' => 'fa fa-percent',
                    'title' => 'Comisiones',
                    'banca' => $banca->ban_url])
                @endcomponent

                @component('components.sidebarBanca', [
                    'route' => 'bancaLoterias',
                    'icon' => 'fa  fa-bookmark',
                    'title' => 'Loterias',
                    'banca' => $banca->ban_url ])
                @endcomponent

                @component('components.sidebarBanca', [
                    'route' => 'bancaSuperPale',
                    'icon' => 'fa  fa-bookmark',
                    'title' => 'Loterias SuperPale',
                    'banca' => $banca->ban_url ])
                @endcomponent



                @component('components.sidebarBanca', [
                    'route' => 'bancaMontoG',
                    'icon' => 'fa fa-hashtag',
                    'title' => 'Montos Globales',
                    'banca' => $banca->ban_url])
                @endcomponent

                @component('components.sidebarBanca', [
                    'route' => 'bancaMontoI',
                    'icon' => 'fa fa-hashtag',
                    'title' => 'Montos Individual',
                    'banca' => $banca->ban_url])
                @endcomponent

                @component('components.sidebarBanca', [
                    'route' => 'bancaModalidades',
                    'icon' => 'fa fa-print',
                    'title' => 'Modalidades',
                    'banca' => $banca->ban_url])
                @endcomponent


            </ul>
        </div>
    </div>

