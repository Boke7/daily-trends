<?php
/**
 * Created by PhpStorm.
 * User: Dani
 * Date: 04/11/2019
 */

require_once 'model/trend.php';

class TrendController{

    private $model;

    public function __CONSTRUCT(){
        $this->model = new Trend();
    }

    public function get_feed($periodicos)
    {

        //Primero quiero saber si hay noticias de hoy

        $hoy = $this->model->Listar();

        if(empty($hoy)){
            foreach ($periodicos as $periodico) {
                $rss_feed = simplexml_load_file($periodico['url']);

                if (!empty($rss_feed)) {
                    $i = 0;
                    foreach ($rss_feed->channel->item as $feed_item) {
                        if($i<5){

                            $noticia = new Trend();

                            $noticia->title = str_replace(["'",'""'], "",$feed_item->title);
                            $noticia->source = $feed_item->link;
                            $noticia->body = $feed_item->description;
                            $noticia->publisher = $periodico['nombre'];

                            $this->model->Registrar($noticia);

                            $i++;
                        }
                    }
                }
            }
        }
    }

    public function Index(){
        require_once 'view/header.php';
        require_once 'view/trend/trends.php';
        require_once 'view/footer.php';
    }

    public function Crud(){
        $noticia = new Trend();

        if(isset($_REQUEST['id'])){
            $noticia = $this->model->ListarTrend($_REQUEST['id']);
        }

        require_once 'view/header.php';
        require_once 'view/trend/trend-edit.php';
        require_once 'view/footer.php';
    }

    public function Guardar(){
        $noticia = new Trend();

        $noticia->id = $_REQUEST['id'];
        $noticia->title = str_replace(["'",'""'], "",$_REQUEST['title']);
        $noticia->body = $_REQUEST['body'];
        $noticia->source = $_REQUEST['source'];
        $noticia->publisher = $_REQUEST['publisher'];

        $noticia->id > 0
            ? $this->model->Actualizar($noticia)
            : $this->model->Registrar($noticia);

        header('Location: index.php');
    }

    public function Eliminar(){
        $this->model->Eliminar($_REQUEST['id']);
        header('Location: index.php');
    }
}