<?php

namespace App\Http\Controllers;

use Laravel\Lumen\Routing\Controller as BaseController;

use Illuminate\Http\Request;

class SemiNovosController extends BaseController
{
    public function search(Request $request) {
     
        $url = $this->createUrl($request);

        $html = file_get_contents($url);

        $adsHtml = explode('<div class="anuncio-container">', $html);

        unset($adsHtml[0]);
        
        foreach ($adsHtml as $e) {
            dd($e);
        }
        
    }

    public function createUrl($request){

        $baseUrl = 'https://seminovos.com.br/';
        $arrParam = [];
        //String values
        $arrParam["vehicleType"] = $request->vehicleType;
        $arrParam["vehicleBrand"] = $request->vehicleBrand;
        $arrParam["vehicleModel"] = $request->vehicleModel;
        
        //Int Values
        $arrParam["initialYear"] = $request->initialYear;
        $arrParam["finalYear"] = $request->finalYear;
        $arrParam["initialPrice"] = $request->initialPrice;
        $arrParam["finalPrice"] = $request->finalPrice;
                
        //GeneralParameters
        // Order By
        // 2 = Maior Relevância
        // 3 = Maior Preço
        // 4 = Menor Preço
        // 5 = Mais Novo
        // 6 = Mais Antigo
        $arrParam["orderBy"] = $request->orderBy;
        $arrParam["records"] = $request->records;
        
        
        // https://seminovos.com.br/carro/audi/100/ano-2020-2021/preco-4000-100000/particular-origem/revenda-origem/novo-estado/seminovo-estado
                
        $url = $baseUrl.$arrParam["vehicleType"]."/".$arrParam["vehicleBrand"]."/".$arrParam["vehicleModel"]."/"
               ."ano-".$arrParam["initialYear"]."-".$arrParam["finalYear"]."preco-".$arrParam["initialPrice"]
               ."-".$arrParam["finalPrice"]."?ordenarPor=".$arrParam["orderBy"]."&ampregistrosPagina=".$arrParam["records"];
        
        return $url;
        
    }
}
