<?php

namespace App\Http\Controllers;

use App\Models\CatastroData;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\PriceRequest;

class SpotController extends Controller
{
    private $catastroData;
    const SUCCESS_RESPONSE = 200;
    public function __construct(
        CatastroData $catastroData
    ){
        $this->catastroData = $catastroData;
    }

    /**
     * @author Kareem Lorenzana
     * @created 2022-07-22
     * @desc return the avergage, min and max of list the constructions
     * @params string $zipCode, string $aggregate, App\Http\Requests\PriceRequest $request
     * 
     */
    public function priceM2($zipCode, $aggregate, PriceRequest $request){
        
        $data = $this->catastroData->checkPrice($zipCode);
        
        $data = $data->select(
            "codigo_postal",
             DB::raw("round((valor_suelo/superficie_terreno)- subsidio )
        as price_unit"),
            DB::raw("round((valor_suelo/superficie_construccion)- subsidio ) as price_unit_construction"),
        )
        ->groupBy("codigo_postal", "price_unit", "price_unit_construction");
        
        switch ($aggregate) {
            case 'max':
                $total = DB::table( DB::raw("({$data->toSql()}) as total") )
                    ->mergeBindings($data->getQuery())->select(
                    DB::raw("'$aggregate' as type"),
                    DB::raw("max(total.price_unit) as price_unit"), 
                    DB::raw("max(total.price_unit_construction) as price_unit_construction"),
                    DB::raw("count(total.codigo_postal) as elements"))->first();
                break;
            case 'min':
                $total = DB::table( DB::raw("({$data->toSql()}) as total") )
                    ->mergeBindings($data->getQuery())->select(
                    DB::raw("'$aggregate' as type"),
                    DB::raw("min(total.price_unit) as price_unit"), 
                    DB::raw("min(total.price_unit_construction) as price_unit_construction"),
                    DB::raw("count(total.codigo_postal) as elements"))->first();
                break;
            case 'avg':
                $total = DB::table( DB::raw("({$data->toSql()}) as total") )
                    ->mergeBindings($data->getQuery())->select(
                    DB::raw("'$aggregate' as type"),
                    DB::raw("round(avg(total.price_unit) )as price_unit"), 
                    DB::raw("round(avg(total.price_unit_construction)) as price_unit_construction"),
                    DB::raw("count(total.codigo_postal) as elements"))->first();
                break;
            
            default:
                $total = (object)[];
                break;
        }

        $response = (object)[
            "status" =>  true,
            "payload" => $total
        ];

        return response()->json($response, self::SUCCESS_RESPONSE);

    }
}
