<!-- business information here -->
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <!-- <link rel="stylesheet" href="style.css"> -->
        <title>Receipt-{{$receipt_details->invoice_no}}</title>
    </head>
    <body>
        <div class="ticket">
        	<div class="text-box">

        	@if(!empty($receipt_details->logo))
        		<img class="logo" src="{{$receipt_details->logo}}" alt="Logo">
        	@endif
        	<!-- Logo -->
            <p class="@if(!empty($receipt_details->logo)) text-with-image @else centered @endif">
            	<!-- Header text -->
            	@if(!empty($receipt_details->header_text))
            		<span class="headings">{!! $receipt_details->header_text !!}</span>
					<br/>
				@endif

				<!-- business information here -->
				@if(!empty($receipt_details->display_name))
					<span class="headings">
						{{$receipt_details->display_name}}
					</span>
					<br/>
				@endif

				@if(!empty($receipt_details->address))
					{!! $receipt_details->address !!}
					<br/>
				@endif
				<!-- Title of receipt -->
				@if(!empty($receipt_details->invoice_heading))
					<br/><span class="sub-headings">{!! $receipt_details->invoice_heading !!}</span>
				@endif
			</p>
			</div>
			<div class="textbox-info">
				<p class="f-left"><strong>{!! $receipt_details->invoice_no_prefix !!}</strong></p>
				<p class="f-right">
					{{$receipt_details->invoice_no}}
				</p>
			</div>
            <div class="textbox-info">
				<p class="f-left"><strong>{!! $receipt_details->pin_no_prefix !!}</strong></p>
				<p class="f-right">
					{{$receipt_details->pin_no}}
				</p>
			</div>
			<div class="textbox-info">
				<p class="f-left"><strong>{!! $receipt_details->date_label !!}</strong></p>
				<p class="f-right">
					{{$receipt_details->invoice_date}}
				</p>
			</div>
            @if(!empty($receipt_details->loteria))
				<p class="centered">
					<strong>{!! $receipt_details->loteria !!}</strong>
				</p>
			@endif



                @foreach ($receipt_details->lines as $key => $line)

                $arrayQ = array();
                $arrayPL = array();
                $arrayTP = array();
                $arraySP = array();

				$line = (array)$line;

				@if(!empty($line['modalidad']) == '1')
					$arrayQ[] = $line;
				@endif
				@if(!empty($line['modalidad']) == '2')
					$arrayPL[] = $line;
				@endif
				@if(!empty($line['modalidad']) == '3')
					$arrayTP[] = $line;
				@endif
				@if(!empty($line['modalidad']) == '4')
					$arraySP[] = $line;
				@endif

			@endforeach



            {{-- <table style="margin-top: 10px !important" class="border-bottom width-100 table-f-12 mb-10">
                <thead class="border-bottom-dotted">
                    <tr>
                        <th class="serial_number">#</th>
                        <th class="description" width="30%">
                        	{{$receipt_details->table_product_label}}
                        </th>
                        <th class="quantity text-right">
                        	{{$receipt_details->table_qty_label}}
                        </th>
                        @if(empty($receipt_details->hide_price))
                        <th class="unit_price text-right">
                        	{{$receipt_details->table_unit_price_label}}
                        </th>
                        <th class="price text-right">{{$receipt_details->table_subtotal_label}}</th>
                        @endif
                    </tr>
                </thead>
                <tbody>
                	@forelse($receipt_details->lines as $line)
	                    <tr>
	                        <td class="serial_number" style="vertical-align: top;">
	                        	{{$loop->iteration}}
	                        </td>
	                        <td class="description">
	                        	{{$line['name']}} {{$line['product_variation']}} {{$line['variation']}}
	                        	@if(!empty($line['sub_sku'])), {{$line['sub_sku']}} @endif @if(!empty($line['brand'])), {{$line['brand']}} @endif @if(!empty($line['cat_code'])), {{$line['cat_code']}}@endif
	                        	@if(!empty($line['product_custom_fields'])), {{$line['product_custom_fields']}} @endif
	                        	@if(!empty($line['sell_line_note']))
	                        	<br>
	                        	<span class="f-8">
	                        	{{$line['sell_line_note']}}
	                        	</span>
	                        	@endif
	                        	@if(!empty($line['lot_number']))<br> {{$line['lot_number_label']}}:  {{$line['lot_number']}} @endif
	                        	@if(!empty($line['product_expiry'])), {{$line['product_expiry_label']}}:  {{$line['product_expiry']}} @endif
	                        </td>
	                        <td class="quantity text-right">{{$line['quantity']}} {{$line['units']}}</td>
	                        @if(empty($receipt_details->hide_price))
	                        <td class="unit_price text-right">{{$line['unit_price_inc_tax']}}</td>
	                        <td class="price text-right">{{$line['line_total']}}</td>
	                        @endif
	                    </tr>
	                    @if(!empty($line['modifiers']))
							@foreach($line['modifiers'] as $modifier)
								<tr>
									<td>
										&nbsp;
									</td>
									<td>
			                            {{$modifier['name']}} {{$modifier['variation']}}
			                            @if(!empty($modifier['sub_sku'])), {{$modifier['sub_sku']}} @endif @if(!empty($modifier['cat_code'])), {{$modifier['cat_code']}}@endif
			                            @if(!empty($modifier['sell_line_note']))({{$modifier['sell_line_note']}}) @endif
			                        </td>
									<td class="text-right">{{$modifier['quantity']}} {{$modifier['units']}} </td>
									@if(empty($receipt_details->hide_price))
									<td class="text-right">{{$modifier['unit_price_inc_tax']}}</td>
									<td class="text-right">{{$modifier['line_total']}}</td>
									@endif
								</tr>
							@endforeach
						@endif
                    @endforeach
                    <tr>
                    	<td colspan="5">&nbsp;</td>
                    </tr>
                </tbody>
            </table>
			 --}}

				<div class="flex-box">
					<p class="width-50 text-right sub-headings">
						{!! $receipt_details->total_label !!}
					</p>
					<p class="width-50 text-right sub-headings">
						{{$receipt_details->total}}
					</p>
				</div>





            {{-- @if(!empty($receipt_details->additional_notes))
	            <p class="centered" >
	            	{!! nl2br($receipt_details->additional_notes) !!}
	            </p>
            @endif --}}



			@if(!empty($receipt_details->footer_text))
				<p class="centered">
					{!! $receipt_details->footer_text !!}
				</p>
			@endif

            {{-- Barcode --}}
			@if($receipt_details->show_barcode)
				<br/>
				<img class="center-block" src="data:image/png;base64,{{DNS1D::getBarcodePNG($receipt_details->invoice_no, 'C128', 2,30,array(39, 48, 54), true)}}">
			@endif
        </div>
        <!-- <button id="btnPrint" class="hidden-print">Print</button>
        <script src="script.js"></script> -->
    </body>
</html>

<style type="text/css">
.f-8 {
	font-size: 8px !important;
}
@media print {
	* {
    	font-size: 12px;
    	font-family: 'Times New Roman';
    	word-break: break-all;
	}
	.f-8 {
		font-size: 8px !important;
	}

.headings{
	font-size: 16px;
	font-weight: 700;
	text-transform: uppercase;
	white-space: nowrap;
}

.sub-headings{
	font-size: 15px !important;
	font-weight: 700 !important;
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

td.serial_number, th.serial_number{
	width: 5%;
    max-width: 5%;
}

td.description,
th.description {
    width: 35%;
    max-width: 35%;
    word-break: break-all;
}

td.quantity,
th.quantity {
    width: 15%;
    max-width: 15%;
    word-break: break-all;
}
td.unit_price, th.unit_price{
	width: 25%;
    max-width: 25%;
    word-break: break-all;
}

td.price,
th.price {
    width: 20%;
    max-width: 20%;
    word-break: break-all;
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
    max-width: inherit;
    width: auto;
}

    .hidden-print,
    .hidden-print * {
        display: none !important;
    }
}
.table-info {
	width: 100%;
}
.table-info tr:first-child td, .table-info tr:first-child th {
	padding-top: 8px;
}
.table-info th {
	text-align: left;
}
.table-info td {
	text-align: right;
}
.logo {
	float: left;
	width:35%;
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
	margin-bottom: 0px;
	white-space: nowrap;
}

.table-f-12 th, .table-f-12 td {
	font-size: 12px;
	word-break: break-word;
}

.bw {
	word-break: break-word;
}
</style>
