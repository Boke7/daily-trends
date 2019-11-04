<?php
/**
 * Created by PhpStorm.
 * User: Dani
 * Date: 04/11/2019
 */

class trend
{
    private $pdo;

    public $id;
    public $title;
    public $body;
    public $source;
    public $publisher;

    public function __CONSTRUCT()
    {
        try
        {
            $this->pdo = Database::connect();
        }
        catch(Exception $e)
        {
            die($e->getMessage());
        }
    }

    /*
     * Obtengo todas las noticias de la BD del día de hoy
     */
    public function Listar()
    {
        try
        {
            $fecha_inicio = date('Y-m-d 00:00:00');

            $fecha_fin = date('Y-m-d 23:59:59');

            $stm = $this->pdo->prepare("SELECT * FROM noticias WHERE fecha between'".$fecha_inicio."' and '".$fecha_fin."';");
            $stm->execute();

            if($stm->rowCount()>0){
                return $stm->fetchAll(PDO::FETCH_OBJ);
            }else{
                return [];
            }

        }
        catch(Exception $e)
        {
            die($e->getMessage());
        }
    }

    /*
     * Verifico si una noticia ya existe
     */
    public function Verificar($titulo)
    {
        $stm = $this->pdo->prepare("SELECT * FROM noticias WHERE title LIKE '".$titulo."';");
        $stm->execute();

        if($stm->rowCount()>0){
            return true;
        }else{
            return false;
        }

    }

    /*
     * Obtengo la noticia con ese ID
     */
    public function ListarTrend($id)
    {
        try
        {
            $stm = $this->pdo
                ->prepare("SELECT * FROM noticias WHERE id = ?");


            $stm->execute(array($id));
            return $stm->fetch(PDO::FETCH_OBJ);
        } catch (Exception $e)
        {
            die($e->getMessage());
        }
    }

    /*
    * Elimino una noticia
    */
    public function Eliminar($id)
    {
        try
        {
            $stm = $this->pdo
                ->prepare("DELETE FROM noticias WHERE id = ?");

            $stm->execute(array($id));
        } catch (Exception $e)
        {
            die($e->getMessage());
        }
    }

    /*
    * Actualizo una noticia
    */
    public function Actualizar($data)
    {
        try
        {
            //Primero verifico que no exista la noticia

            $existe = $this->Verificar($data->title);

            if(!$existe) {

                $sql = "UPDATE noticias SET 
                            title          = ?, 
                            source        = ?,
                            body        = ?,
                            publisher            = ?
                        WHERE id = ?";

                $this->pdo->prepare($sql)
                    ->execute(
                        array(
                            $data->title,
                            $data->source,
                            $data->body,
                            $data->publisher
                        )
                    );
            }else{
                die('Esta noticia ya existe');
            }
        } catch (Exception $e)
        {
            die($e->getMessage());
        }
    }

    /*
    * Creo una noticia desde 0
    */
    public function Registrar(Trend $data)
    {
        try
        {
            //Primero verifico que no exista la noticia

            $existe = $this->Verificar($data->title);

            if(!$existe) {
                $sql = "INSERT INTO noticias (title,source,body,publisher) 
		        VALUES (?, ?, ?, ?)";

                $this->pdo->prepare($sql)
                    ->execute(
                        array(
                            $data->title,
                            $data->source,
                            $data->body,
                            $data->publisher
                        )
                    );
            }else{
                die('Esta noticia ya existe');
            }
        } catch (Exception $e)
        {
            die($e->getMessage());
        }
    }

}