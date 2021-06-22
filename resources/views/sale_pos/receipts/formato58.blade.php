<!-- business information here -->
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <!-- <link rel="stylesheet" href="style.css"> -->
        <title>Ticket # {{$detalle_ticket->invoice_no}}</title>
    </head>
    <body>
        <div class="ticket">

        	@if(!empty($detalle_ticket->logo))
        		<img  style="max-height: 100px; width:100px" src="{{$detalle_ticket->logo}}" alt="Logo">
        	@endif
            <div class="text-box">
        	<!-- Logo -->
            <p class="centered">
            	<!-- Header text -->
            	@if(!empty($detalle_ticket->header_text))
            		<span class="headings">{!! $detalle_ticket->header_text !!}</span>
					<br/>
				@endif
                <!-- Logo -->
                <p class="centered">
                    <!-- Header text -->
                    @if(!empty($detalle_ticket->header_text))
                        <span class="headings">{!! $detalle_ticket->header_text !!}</span>
                        <br/>
                    @endif

                    <!-- business information here -->
                    @if(!empty($detalle_ticket->display_name))
                        <span class="headings">
                            {{$detalle_ticket->display_name}}
                        </span>
                        <br/>
                    @endif
                    @if(!empty($detalle_ticket->slogan))
                        <span class="slogan margin-bottom">
                            {{$detalle_ticket->slogan}}
                        </span>
                        <br/>
                    @endif

                    @if(!empty($detalle_ticket->address))
                        {!! $detalle_ticket->address !!}
                    @endif
                    <!-- Title of receipt -->
                    @if(!empty($detalle_ticket->invoice_heading))
                        {!! $detalle_ticket->invoice_heading !!}
                    @endif

                    <!-- Title of receipt -->
                    @if(!empty($detalle_ticket->invoice_heading))
                        <br/><span class="sub-headings">{!! $detalle_ticket->invoice_heading !!}</span>
                    @endif

			</p>
			</div>
             @if(!empty($detalle_ticket->copia_label))
				 <div class='centered margin-bottom'>
                    <p><strong>{!! $detalle_ticket->copia_label !!}</strong></p>
                    <p><strong>Fecha: {{$detalle_ticket->copia_date}} </strong></p>
                    <p><strong>******* ***** *******</strong></p>
                </div>
                 <br>
			    @endif
            <div class="flex-box">

                    <p class="f-left"><strong>{!! $detalle_ticket->date_label !!}</strong></p>
                    <p class="f-right"><strong>{{$detalle_ticket->invoice_date}}</strong></p>

                    <p class="f-left"><strong>{!! $detalle_ticket->time_label !!}</strong></p>
                    <p class="f-right"><strong>{{$detalle_ticket->time_date}}</strong></p>

            </div>
            @if(!empty($detalle_ticket->sorteo_label))
            <div class="flex-box">
                    <p class="f-left"><strong>{!! $detalle_ticket->sorteo_label !!}</strong></p>
                    <p class="f-right"><strong>{{$detalle_ticket->sorteo_date}}</strong></p>
            </div>
            @endif
            <div class="flex-box">

                <p class="f-left"><strong>{!! $detalle_ticket->invoice_no_prefix !!}</strong></p>
                <p class="f-right"><strong>{{$detalle_ticket->invoice_no}}</strong></p>

                    @if($isAnular == 0)
                <p class="f-left"><strong>{!! $detalle_ticket->pin_no_prefix !!}</strong></p>
                <p class="f-right"><strong>{{$detalle_ticket->pin_no}}</strong></p>
                @endif
            </div>
            </div>
            <div class="textbox-info centered">
                @if(!empty($detalle_ticket->loteria))
                        <strong> {!! $detalle_ticket->loteria !!}</strong>
                @endif
            </div>
            @php
                $arrayQ = array();
                $arrayPL = array();
                $arrayTP = array();
                $arraySP = array();
            @endphp

            @foreach ($detalle_ticket->lines as $line)

                    @if ($line['modalidad'] == '1')
                           @php $arrayQ[] = $line; @endphp
                   @endif
                    @if ($line['modalidad'] == '2')
                        @php $arrayPL[] = $line; @endphp
                   @endif
                    @if ($line['modalidad'] == '3')
                        @php $arrayTP[] = $line; @endphp
                   @endif
                    @if ($line['modalidad'] == '4')
                        @php $arraySP[] = $line; @endphp
                   @endif

            @endforeach

            @if(count($arrayQ) != 0)
                <div class='flex-box border-top'><strong>Quiniela</strong></div>
                    @foreach ($arrayQ as $jugada)
                            <div class="textbox-info">
                                <p class="f-left"><strong>{{ $jugada['apuesta'] }}</strong></p>
                                <p class="f-right"><strong>{{ $jugada['valor'] }}</strong></p>
                            </div>
                    @endforeach
            @endif
            @if(count($arrayPL) != 0)
                <div class='flex-box border-top'><strong>Pales</strong></div>
                    @foreach ($arrayPL as $jugada)
                            <div class="textbox-info">
                                 <p class="f-left"><strong>{{ $jugada['apuesta'] }}</strong></p>
                                <p class="f-right"><strong>{{ $jugada['valor'] }}</strong></p>
                            </div>
                    @endforeach
            @endif
            @if(count($arrayTP) != 0)
                <div class='flex-box border-top'><strong>Tripletas</strong></div>
                    @foreach ($arrayTP as $jugada)
                            <div class="textbox-info">
                                <p class="f-left"><strong>{{ $jugada['apuesta'] }}</strong> </p>
                                <p class="f-right"><strong>{{ $jugada['valor'] }}</strong></p>
                            </div>
                    @endforeach
            @endif
            @if(count($arraySP) != 0)
                <div class='flex-box border-top'><strong>SuperPale</strong></div>
                    @foreach ($arraySP as $jugada)
                            <div class="textbox-info">
                                 <p class="f-left"><strong>{{ $jugada['apuesta'] }}</strong> </p>
                                <p class="f-right"><strong>{{ $jugada['valor'] }}</strong></p>
                            </div>
                    @endforeach
            @endif
            <br>
             <div class="centered border-top border-bottom">
                <p>
                    <strong>**{!! $detalle_ticket->total_label !!}</strong>
                    <strong>{{$detalle_ticket->total}}**</strong>
                </p>
            </div>
            <br/>
            @if(!empty($detalle_ticket->promocion_label))
				 <div class='centered'>
                    <p><strong>{!! $detalle_ticket->promocion_label !!}</strong></p>
                </div>
                 <br>
			@endif
            @if(!empty($detalle_ticket->estado_label))
				 <div class='centered margin-bottom'>
                    <p><strong> {!! $detalle_ticket->estado_label !!} </strong></p>
                </div>
                 <br>
			@endif
                <br>
            	@if(!empty($detalle_ticket->footer_text))
                    <p class="centered margin-bottom">
                        <strong> {!! $detalle_ticket->footer_text !!}  </strong>
                    </p>
                <br>
			    @endif

            {{-- Barcode --}}
			@if($detalle_ticket->tcon_show_barcode)
                <div class="centered margin-bottom">
				    <img  src="data:image/png;base64,{{DNS1D::getBarcodePNG($detalle_ticket->barcode, 'C39', 1,40,array(0, 0, 0), true)}}">
                 </div>
			@endif
            <br/>
                <!-- business information here -->
            @if(!empty($detalle_ticket->tcon_nota_informativa))
                <span class="nota margin-bottom">
                    {{$detalle_ticket->tcon_nota_informativa}}
                </span>

            @endif
        </div>
        <br>
    </body>
</html>
<style type="text/css">


@media print {
	* {
        font-size: 11px;
    	font-family: 'Arial';
    	word-break: break-all;
	}

    .pace  {
        display: none;
    }

   .pace-active
    {
        display: none;
    }
   .pace-activity
    {
        display: none;
    }

.headings{
	font-size: 14px;
	font-weight: 700;
	text-transform: uppercase;

}

.sub-headings{
	font-size: 13px;
	font-weight: 700;
}

.slogan{
	font-size: 12px;
	font-weight: 700;
}

.nota{
	font-size: 9px;
	font-weight:700;
}



.border-top{
    border-top: 1px solid #242424;
}
.border-bottom{
	border-bottom: 1px solid #242424;
}

.border-bottom-dotted{
	border-bottom: 1px dotted darkgray;
}

.margin-bottom{
    margin-bottom: 1em;
}

.centered {
    text-align: center;
    align-content: center;
}

.ticket {
    width: 100%;
    max-width: 100%;
}

img {
   display:block;
    margin:auto;
}

    .hidden-print,
    .hidden-print * {
        display: none !important;
    }
}

.logo {
float: left;
	padding: 10px;
}

.text-with-image {
	float: left;
	width:65%;
}
.text-box {
	width: 100%;
	height: auto;
}

    .f-right {
    float: right;
    width: 30%;

    }

    .f-left {
    float: left;

    }

.m-0 {
	margin:0;
}

.textbox-info {
	clear: both;
}

.textbox-info p {
	margin-bottom: 0px
}
.flex-box {
	display: flex;
	width: 100%;
}
.flex-box p {
	width: 50%;
	margin-bottom: 1px;
	white-space: nowrap;
}

</style>
