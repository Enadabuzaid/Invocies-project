<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\invoice;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {

        $count_all=invoice::count();
        $count_invoice_1 = invoice::where('Value_Status','=',1)->count();
        $count_invoice_2 = invoice::where('Value_Status','=',2)->count();
        $count_invoice_3 = invoice::where('Value_Status','=',3)->count();

        $pers_invoice_1=($count_invoice_1/$count_all) *100;
        $pers_invoice_2=($count_invoice_2/$count_all) *100;
        $pers_invoice_3=($count_invoice_3/$count_all) *100;





        $chartjs = app()->chartjs
            ->name('barChartTest')
            ->type('bar')
            ->size(['width' => 400, 'height' => 200])
            ->labels(['الفواتير الغير  مدفوعة والفواتير المدفوعة ', 'اجمالي الفواتير والمدفوعة جزئياً'])
            ->datasets([
                [
                    "label" => "الفواتير الغير مدفوعة",
                    'backgroundColor' => ['#f05454', '#f58634'],
                    'data' => [$pers_invoice_2, $pers_invoice_3]
                ],
                [
                    "label" => "الفواتير المدفوعة",
                    'backgroundColor' => ['#8fd9a8', '#28b5b5'],
                    'data' => [$pers_invoice_1, 100]
                ]
            ])
            ->options([]);

        $chartjs2 = app()->chartjs
            ->name('pieChartTest')
            ->type('pie')
            ->size(['width' => 400, 'height' => 290])
            ->labels(['الفواتير الغير المدفوعة', 'الفواتير المدفوعة'])
            ->datasets([
                [
                    'backgroundColor' => ['#FF6384', '#8fd9a8'],
                    'hoverBackgroundColor' => ['#FF6384', '#8fd9a8'],
                    'data' => [$pers_invoice_2, $pers_invoice_1]
                ]
            ])
            ->options([]);

        $chartjs3 = app()->chartjs
            ->name('Doughnut ')
            ->type('doughnut')
            ->size(['width' => 400, 'height' => 200])
            ->labels(['الفواتير الغير المدفوعة', 'الفواتير المدفوعة','الفواتير المدفوعة جزئيا'])
            ->datasets([
                [
                    'backgroundColor' => ['#FF6384', '#8fd9a8','#f58634'],
                    'hoverBackgroundColor' => ['#FF6384', '#8fd9a8','#f58634'],
                    'data' => [$pers_invoice_2, $pers_invoice_1,$pers_invoice_3]
                ]
            ])
            ->options([]);


        return view('home',compact('chartjs','chartjs2','chartjs3'));
    }
}
