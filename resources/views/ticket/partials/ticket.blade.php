 <div class="containerTicket lista-scroll">
    <div class="invoice">
        <div  class="receipt">
            <div class="text-box">

                @if(!empty($receipt_details->logo))
                    <img class="centered"  src="{{$receipt_details->logo}}" alt="Logo">
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
                <div class="flex-box">

                    <p class="f-left"><strong>{!! $receipt_details->date_label !!}</strong></p>
                    <p class="f-right"> {{$receipt_details->invoice_date}}</p>

                    <p class="f-left"><strong>{!! $receipt_details->time_label !!}</strong></p>
                    <p class="f-right"> {{$receipt_details->time_date}}</p>
                </div>


                <div class="flex-box">
                    <p class="f-left"><strong>{!! $receipt_details->sorteo_label !!} </strong></p>
                    <p class="f-right"> {{$receipt_details->sorteo_date}}</p>
                </div>

                <div class="flex-box">
                    <p class="f-left"><strong>{!! $receipt_details->invoice_no_prefix !!}</strong></p>
                    <p class="f-right"> {{$receipt_details->invoice_no}}</p>

                    @if ($isAnular == 0)
                        <p class="f-left"><strong>{!! $receipt_details->pin_no_prefix !!}</strong></p>
                        <p class="f-right"> {{$receipt_details->pin_no}}</p>
                     @endif
                </div>

            <div class="textbox-info centered">
                @if(!empty($receipt_details->loteria))
                        <strong> {!! $receipt_details->loteria !!}</strong>
                @endif
            </div>
                {!! $receipt_details->lines !!}
            <br>
            <div class="centered border-top">
                <p>
                    <strong>**{!! $receipt_details->total_label !!}</strong>
                    <strong>{{$receipt_details->total}}**</strong>
                </p>
            </div>
            <br>

                {!! $receipt_details->promocion_label !!}
                {!! $receipt_details->estado_label !!}

            @if(!empty($receipt_details->footer_text))
                <p class="centered">
                    {!! $receipt_details->footer_text !!}
                </p>
                <br/>
            @endif

            {{-- Barcode --}}
            @if($receipt_details->tcon_show_barcode)
                <strong><img  src="data:image/png;base64,{{DNS1D::getBarcodePNG($receipt_details->barcode, 'C39', 1,40,array(0, 0, 0), true)}}"> </strong>
            @endif
            <br/>
             @if(!empty($receipt_details->tcon_nota_informativa))
                <span class="nota">
                    {{$receipt_details->tcon_nota_informativa}}
                </span>
            @endif

            </div>
        </div>
    </div>
