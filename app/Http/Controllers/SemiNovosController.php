<?php

namespace App\Http\Controllers;

use Laravel\Lumen\Routing\Controller as BaseController;

use Illuminate\Http\Request;

use \GuzzleHttp\Client;
use Symfony\Component\CssSelector\CssSelectorConverter;
use Symfony\Component\DomCrawler\Crawler;

class SemiNovosController extends BaseController
{
    public function search(Request $request) {
        $url = $this->createUrl($request);

        $client = new \GuzzleHttp\Client();
        
        $html = $client->get($url);
        $html = $html->getBody()->getContents();

        $crawler = new Crawler($html);

        $data = $crawler->filter('div.anuncio-container > div.anuncio-thumb-new')->each(function ($content) {            
            $adLink = "https://seminovos.com.br".$content->filter('a[class="thumbnail"]')->attr('href');
            $adTitle = $content->filter('div.content > div.card-body > div.card-header > h4')->text();
            $adInfo = $content->filter('div.content > div.card-body > div.card-header > div.card-description > span')->text();
            return [
                "adLink" => $adLink,
                "adTitle" => $adTitle,
                "adInfo" => $adInfo
            ];
        });
        
        return json_encode($data);
           
    }

    public function searchAd(Request $request){
        $url = $request->url;
        
        $client = new \GuzzleHttp\Client();
        
        $html = $client->get($url);
        $html = $html->getBody()->getContents();

        $crawler = new Crawler($html);
        
        $adTitle = $crawler->filter('h1[itemprop="name"]')->text();
        $adInfo = $crawler->filter('p[class="desc"]')->text();
        $yearModelAd = $crawler->filter('span[itemprop="modelDate"]')->text();        
        $mileageAd = $crawler->filter('span[itemprop="mileageFromOdometer"]')->text();        
        $transmissionAd = $crawler->filter('span[title="Tipo de transmissão"]')->text();        
        $amountPortsAd = $crawler->filter('span[title="Portas"]')->text();        
        $fuelTypeAd = $crawler->filter('span[itemprop="fuelType"]')->text();        
        $colorAd = $crawler->filter('span[title="Cor do veículo"]')->text();
        
        $data = [
            "adTitle" => $adTitle,
            "adLink" => $url,
            "adInfo" => $adInfo,
            "yearModelAd" => $yearModelAd,
            "mileageAd" => $mileageAd,
            "transmissionAd" => $transmissionAd,
            "amountPortsAd" => $amountPortsAd,
            "fuelTypeAd" => $fuelTypeAd,
            "colorAd" => $colorAd
        ];

        return json_encode($data);
        
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
        
        // https://seminovos.com.br/carro/audi/100/ano-2020-2021/preco-4000-100000/particular-origem/revenda-origem/novo-estado/seminovo-estado
                
        $url = $baseUrl.$arrParam["vehicleType"]."/".$arrParam["vehicleBrand"]."/".$arrParam["vehicleModel"]."/"
               ."ano-".$arrParam["initialYear"]."-".$arrParam["finalYear"]."/preco-".$arrParam["initialPrice"]
               ."-".$arrParam["finalPrice"];
        
        return $url;
                
    }
}
