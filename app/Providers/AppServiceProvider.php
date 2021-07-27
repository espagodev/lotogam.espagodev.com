<?php

namespace App\Providers;

use Illuminate\Support\Facades\Blade;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\View;


class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Schema::defaultStringLength(191);

        $asset_v = config('constants.asset_version', 1);
        View::share('asset_v', $asset_v);

        //Blade directive to format number into required format.
        Blade::directive('num_format', function ($expression) {
            return "number_format($expression, config('constants.currency_precision', 2), session('currency')['decimal_separator'], session('currency')['thousand_separator'])";
        });

        //Blade directive to format quantity values into required format.
        Blade::directive('format_quantity', function ($expression) {
            return "number_format($expression, config('constants.quantity_precision', 2), session('currency')['decimal_separator'], session('currency')['thousand_separator'])";
        });

        //Directiva Blade para devolver la clase apropiada según el estado de la transacción
        Blade::directive('ticket_status', function ($status) {
            return "<?php if($status == '1'){
                echo 'bg-aqua';
            }elseif($status == 'pending'){
                echo 'bg-red';
            }elseif ($status == 'received') {
                echo 'bg-light-green';
            }elseif ($status == 'received') {
                echo 'bg-light-green';
            }elseif ($status == 'received') {
                echo 'bg-light-green';
            }elseif ($status == 'received') {
                echo 'bg-light-green';
            }?>";
        });

        //Blade directive to return appropiate class according to transaction status
        Blade::directive('payment_status', function ($status) {
            return "<?php if($status == 'partial'){
                echo 'bg-aqua';
            }elseif($status == 'due'){
                echo 'bg-red';
            }elseif ($status == 'paid') {
                echo 'bg-light-green';
            }?>";
        });



        //Blade directive to convert.
        Blade::directive('format_date', function ($date) {
            if (!empty($date)) {
                return "\Carbon::createFromTimestamp(strtotime($date))->format(session('business.date_format'))";
            } else {
                return null;
            }
        });

        //Blade directive to convert.
        Blade::directive('format_time', function ($date) {
            if (!empty($date)) {
                $time_format = 'h:i A';
                if (session('business.time_format') == 24) {
                    $time_format = 'H:i';
                }
                return "\Carbon::createFromTimestamp(strtotime($date))->format('$time_format')";
            } else {
                return null;
            }
        });

        Blade::directive('format_datetime', function ($date) {
            if (!empty($date)) {
                $time_format = 'h:i ';
                if (session('business.time_format') == 24) {
                    $time_format = 'H:i';
                }

                return "\Carbon::createFromTimestamp(strtotime($date))->format(session('business.date_format') . ' ' . '$time_format')";
            } else {
                return null;
            }
        });

    }
}
