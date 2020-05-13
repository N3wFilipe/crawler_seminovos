<?php

namespace App\Http\Controllers;

use Laravel\Lumen\Routing\Controller as BaseController;

use Illuminate\Http\Request;

use Symfony\Component\DomCrawler\Crawler;

class SemiNovosController extends BaseController
{
    public function search(Request $request) {
     
        $baseUrl = 'https://seminovos.com.br/';

        $url = $this->createUrl($baseUrl, $request);

        $html = file_get_contents($url);

        $adsHtml = explode('<div class="anuncio-container">', $html);

        unset($adsHtml[0]);

        $arrReturn = [];

        foreach ($adsHtml as $e) {
            $initialElement = explode('<div class="anuncio-thumb-new anuncio-card-new ">', $e);
            
            // $adLink = explode('<div class="anuncio-thumb-new anuncio-card-new ">', $initialElement[0]);
            // $adLink = explode("<figure>",$adLink[$i]);
            // $adLink = explode("\n", $adLink[0]);
            // $adLink = explode("<a href=", $adLink[1]);
            // $adLink = explode('"', $adLink[1]);
            // $adLink = explode('/', $adLink[1]);
            // $adLink = $adLink[1];
            
            var_dump($e);
        }
        
    }

    public function createUrl($baseUrl, $request){

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
