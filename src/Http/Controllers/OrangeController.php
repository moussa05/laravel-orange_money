<?php

namespace Orange\Orange_Money\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use GuzzleHttp\Client;
use GuzzleHttp\Psr7\Response;
use Illuminate\Support\Facades\Http;

class OrangeController extends Controller
{
    //////////url_gateway le liens vers orange money////////////
    const baseUrl = "https://api.paiementorangemoney.com";

    /////////Date de la transaction auformat UTC////////////////
    private $datesh ;

    ///////Identifiant du partenaire (fourni par Orange)///////
    private $identifiant ;

    ////////Identifiant du site marchand (fourni par Orange)///
    private $site ;

    /////////Référence de la commande. Cette valeur doit être unique/////
    private  $ref_commande ;

    /////////Libellé de la commande /////////////////////////////////////
    private $commande ;
     
    ///////Total de la commande//////////////////////////////////////////
    private $total;

    /////////// Url de             //////////////////////////////////////
    private $success_URL;
     
    /////////////// Url      ///////////////////////////////
    private $cancel_URL;

    ////////////////                 //////////////////////////////////
    private $annulation_URL;
    ////////////
    private $hmac;

    public function __construct()
    {
        $this->identifiant = md5('2596366983');
        $this->site =  md5('1401606775');
        $this->ref_commande = 'OM201503WEBP001';
        $this->datesh = date('c');
        $cle_bin = pack("H*", "2210B9580F4C050028BAF1C2CD746CB6EBA98CA7C72F7B30EDDC9B1CBD947D59");
        $this->commande = "TEST Paiement par Orange Money ";
        $this->total = 1.0;
        $algo = "SHA512";
         
        $message = 
        "S2M_COMMANDE=$this->commande".
        "&S2M_DATEH=$this->datesh".
        "&S2M_HTYPE=$algo".
        "&S2M_IDENTIFIANT=$this->identifiant".
        "&S2M_REF_COMMANDE=$this->ref_commande".
        "&S2M_SITE=$this->site".
        "&S2M_TOTAL=$this->total";

        $this->hmac = strtoupper(hash_hmac(strtolower($algo),$message, $cle_bin));
    }
    public function index()
    {
     return $this->apiCall("voyage vers dakar","UGB vers Dakar",2200.0);
    }
    public function cancel()
    {
        $data = $_POST['ref_transaction'];
        return $this->apiCall("voyage vers dakar","UGB vers Dakar",2200.0);

    }
    /**
     * call of the API with the parameters: the referentil of the command, the command and the total sum
     */
    public function apiCall($refCommande,$commande,$somme)
    {
        $identifiant = md5(getenv("S2M_IDENTIFIANT"));
        $site = md5(getenv("S2M_SITE"));
        $cle_secrete =getenv("MARCHANT_KEEY");
        $algo = "SHA512";
        $dateh = date('c');
        $ref_commande = $refCommande;
        $total = $somme;
        $commande = $commande;
        $cle_bin = pack("H*", $cle_secrete);
        $message = "S2M_COMMANDE=$commande"."&S2M_DATEH=$dateh"."&S2M_HTYPE=$algo"."&S2M_IDENTIFIANT=$identifiant"."&S2M_REF_COMMANDE=$ref_commande"."&S2M_SITE=$site"."&S2M_TOTAL=$total";
        $hmacs = strtoupper(hash_hmac(strtolower($algo),$message, $cle_bin));
        return view ('orange::formular.paiement',[
            'S2M_IDENTIFIANT' => $identifiant,
            'S2M_SITE'        => $site,
            'S2M_REF_COMMANDE'=> $ref_commande,
            'S2M_COMMANDE'    =>$commande,
            'S2M_DATEH'       => $dateh,
            'S2M_TOTAL'       => $total,
            'S2M_HTYPE'       => $algo,
            'S2M_HMAC'        => $hmacs
        ]);
    }
}
