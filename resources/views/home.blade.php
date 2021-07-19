@extends('layouts.app')
@section('title','Dashboard')
@section('content')

    @include('dashboard.partials.datos')

    <div class="modal fade view_register no-print" tabindex="-1" role="dialog"
        aria-labelledby="gridSystemModalLabel">
    </div>

    <div class="modal fade ticket_modal v" tabindex="-1" role="dialog"
        aria-labelledby="gridSystemModalLabel">
    </div>

    <div class="modal fade pagar_premio_modal no-print" tabindex="-1" role="dialog"
        aria-labelledby="gridSystemModalLabel">
    </div>
@endsection
@section('scripts')
	<script src="{{ asset('js/dashboard/dashboard.js?v=' . $asset_v) }}"></script>
    <script src="{{ asset('js/ticket/ticket.js?v=' . $asset_v) }}"></script>

@endsection
