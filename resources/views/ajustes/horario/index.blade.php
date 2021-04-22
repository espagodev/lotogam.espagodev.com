@extends('layouts.app')
    @section('content')
     <div class="row pt-2 pb-2">
        <div class="col-sm-9">
		    <h4 class="page-title">Ajustes Empresa</h4>
		{{-- <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="javaScript:void();">Bulona</a></li>
            <li class="breadcrumb-item"><a href="javaScript:void();">Pages</a></li>
            <li class="breadcrumb-item active" aria-current="page">Blank Page</li>
        </ol> --}}
	   </div>
        <div class="col-sm-3">
            <div class="btn-group float-sm-right">
                {{-- <button type="button" class="btn btn-primary waves-effect waves-primary" data-toggle="modal" data-target="#nuevo"><i class="fa fa-plus mr-1"></i> Nueva Loteria</button> --}}
                {{-- <button type="button" class="btn btn-light dropdown-toggle dropdown-toggle-split waves-effect waves-light" data-toggle="dropdown">
                <span class="caret"></span>
                </button>
                <div class="dropdown-menu">
                <a href="javaScript:void();" class="dropdown-item">Action</a>
                <a href="javaScript:void();" class="dropdown-item">Another action</a>
                <a href="javaScript:void();" class="dropdown-item">Something else here</a>
                <div class="dropdown-divider"></div>
                <a href="javaScript:void();" class="dropdown-item">Separated link</a>
                </div> --}}
            </div>
        </div>
     </div>

        <div class="row">
             <div class="col-lg-4">
                 @include('ajustes._sidebar')
            </div>
            <div class="col-lg-8">
                <div class="card">
                    <div class="card-body">
                            <div class="table-responsive">
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th scope="col">Valor %</th>
                                            <th scope="col">Estado</th>

                                        </tr>
                                    </thead>
                                </table>
                            </div>
                    </div>
                </div>
            </div>
      </div><!--End Row-->
   @endsection
