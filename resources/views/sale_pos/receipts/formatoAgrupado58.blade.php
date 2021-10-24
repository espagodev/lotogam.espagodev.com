<!-- business information here -->
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <!-- <link rel="stylesheet" href="style.css"> -->
        <title>Ticket Agrupado</title>
    </head>
    <body>
        <div class="ticket">

            @if(!empty($detalle_ticket->logo))
            <div class="centered margin-bottom">                    
                <img  src="{{$detalle_ticket->logo}}" alt="Logo">
             </div>        		
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
                        <span class="headings">
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

            </div>
             <table style="padding-top: 5px !important" class="width-100 table-f-12">
                <thead>
                    <tr>
                        <td class="description"><strong>Loteria</strong></td>
                        <td class="description"><strong>Ticket</strong></td>
                        <td class="description"><strong>Pin</strong></td>
                    </tr>
                </thead>
                <tbody>
                     @foreach ($detalle_ticket->tickets as $ticket)
                            <tr>
                                 <td class="descriptionLote"><strong>{{ $ticket['loteria'] }}</strong></td>
                                 <td class="description"><strong>{{ $ticket['ticket'] }}</strong></td>
                                <td class="description"><strong>{{ $ticket['pin'] }}</strong></td>
                            </tr>
                    @endforeach
                </tbody>
            </table>

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
                <p><strong>******* PROMOCION *******</strong></p>
                </div>
                 <br>
			    @endif

            	@if(!empty($detalle_ticket->footer_text))
				<p class="centered">
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
                <span class="nota">
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

td.description,
th.description {
    width: 25%;
    max-width: 25%;
}

td.descriptionLote
 {
    width: 50%;
    max-width: 50%;
}

/* .table-f-12 th, .table-f-12 td {
	font-size: 11px;
	word-break: break-word;
} */

</style>
