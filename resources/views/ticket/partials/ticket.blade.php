 <div class="containerTicket lista-scroll no-print">
        <div class="invoice">
            <div  class="receipt">
            <div class="text-box">

            @if(!empty($receipt_details->logo))
                <img class="logos centered" src="{{$receipt_details->logo}}" alt="Logo">
            @endif
            <!-- Logo -->
            <p class="centered">
                <!-- Header text -->
                @if(!empty($receipt_details->header_text))
                    <{!! $receipt_details->header_text !!}
                @endif

                <!-- business information here -->
                @if(!empty($receipt_details->display_name))
                        {{$receipt_details->display_name}}
                @endif

                @if(!empty($receipt_details->address))
                    {!! $receipt_details->address !!}
                @endif
                <!-- Title of receipt -->
                @if(!empty($receipt_details->invoice_heading))
                    {!! $receipt_details->invoice_heading !!}
                @endif
            </p>
            </div>
            <div class="flex-box-encabezado">
                <div class="textbox-info">
                    <p class="f-left"><strong>{!! $receipt_details->date_label !!}</strong></p>
                    <p class="f-right"> {{$receipt_details->invoice_date}}</p>
                </div>

                <div class="textbox-info">
                    <p class="f-left"><strong>{!! $receipt_details->time_label !!}</strong></p>
                    <p class="f-right"> {{$receipt_details->time_date}}</p>
                </div>
            </div>
            <div class="flex-box">
                    <div class="textbox-info">
                    <p class="f-left"><strong>{!! $receipt_details->sorteo_label !!} </strong></p>
                    <p class="f-right"> {{$receipt_details->sorteo_date}}</p>
                </div>
            </div>
            <div class="flex-box">
                <div class="textbox-info">
                    <p class="f-left"><strong>{!! $receipt_details->invoice_no_prefix !!}</strong></p>
                    <p class="f-right"> {{$receipt_details->invoice_no}}</p>
                </div>
                    @if ($isAnular == 0)
                <div class="textbox-info">
                    <p class="f-left"><strong>{!! $receipt_details->pin_no_prefix !!}</strong></p>
                    <p class="f-right"> {{$receipt_details->pin_no}}</p>
                </div>
                    @endif

            </div>

            <div class="textbox-info centered">
                @if(!empty($receipt_details->loteria))
                        <strong> {!! $receipt_details->loteria !!}</strong>
                @endif
            </div>
                {!! $receipt_details->lines !!}

            <div class="centered">
                <p>
                    <strong>{!! $receipt_details->total_label !!}</strong>
                    <strong>{{$receipt_details->total}}</strong>
                </p>
            </div>
                <br>

                {!! $receipt_details->promocion_label !!}

                    {!! $receipt_details->estado_label !!}


            @if(!empty($receipt_details->footer_text))
                <p class="centered">
                    {!! $receipt_details->footer_text !!}
                </p>
            @endif

            {{-- Barcode --}}
            @if($receipt_details->tcon_show_barcode)
                <br/>
                <img class="center-block" src="data:image/png;base64,{{DNS1D::getBarcodePNG($receipt_details->invoice_no, 'C128', 2,30,array(39, 48, 54), true)}}">
            @endif
            </div>
        </div>
    </div>
