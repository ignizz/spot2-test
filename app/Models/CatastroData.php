<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class CatastroData extends Model
{
    use HasFactory;

    const CONSTRUCTION_USES = [
        1,2,3,4,5,6,7
    ];

    const AGGREGATE = [
        "min",
        "max",
        "avg"
    ];
    protected $table = "catastro_data";

    /**
     * @author Kareem Lorenzana
     * @created 2022-07-22
     * @desc return string use de construction code for query in the database
     * @param int $code
     * @return string
     */
    public function constructionUse($code){
        switch ($code) {
            case 1:
                return "Áreas verdes";
                break;
            case 2:
                return "Centro de barrio";
                break;
            case 3:
                return "Equipamiento";
                break;
            case 4:
                return "Habitacional";
                break;
            case 5:
                return "Habitacional y comercial";
                break;
            case 6:
                return "Industrial";
                break;
            case 7:
                return "Sin Zonificación";
                break;
            
            default:
                return null;
                break;
        }
    }

    /**
     * gets by zipcode
     * @author Kareem Lorenzana
     * @creted 2022-07-22
     * @params Illuminate\Database\Eloquent\Builder $query, string $zipCode, int aggregate, App\Http\Requests\PriceRequest $request
     * @return Illuminate\Database\Eloquent\Builder
     */
    public function scopeCheckPrice(Builder $query, $zipCode){
        $constructionUse = $this->constructionUse(request()->construction_type);
        return  $query->where("codigo_postal", $zipCode)
        ->where("uso_construccion", $constructionUse)
        ->where("superficie_terreno", ">", 0)
        ->where("superficie_construccion", ">", 0)
        ->where("valor_suelo", ">", "0");

    }

}
