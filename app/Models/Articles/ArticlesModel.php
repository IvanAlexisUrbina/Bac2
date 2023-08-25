<?php
namespace Models\Articles;
use Models\MasterModel;
Class ArticlesModel extends MasterModel
{

    public function consultArticles()
    {
        $sql = "SELECT ar_id,ar_name,ar_code,ar_desc,color_id,ar_measurement_value,ar_img_url,ar_data_url,ar_characteristics,mt_id,cat_id
                FROM articles";
            $params = [];
            $articles = $this->select($sql, $params);
        return $articles;
    }

    public function consultArticleById($id)
    {   
        $result = $this->selectById('articles', 'ar_id', $id);
        return $result;
    }
    

    public function insertArticle( $ar_id,$name, $description,$code,$characteristics,$measurement_value, $color, $img_url,$data_url,$mt_id,$cat_id,$sbcat_id,$status_id=1 )
    {
        $sql = "INSERT INTO articles (ar_id,ar_name, ar_desc,ar_code,ar_characteristics,color_id,ar_measurement_value, ar_img_url,ar_data_url,mt_id,cat_id,sbcat_id,status_id)
                VALUES (:ar_id,:name, :description,:code,:characteristics, :color,:measurement_value, :img_url,:data_url,:mt_id,:cat_id,:sbcat_id,:status_id)";
        $params = [
            ':ar_id' => $ar_id,
            ':name' => $name,
            ':description' => $description,
            ':code' => $code,
            ':characteristics' => $characteristics,
            ':color' => $color,
            ':measurement_value' => $measurement_value,
            ':img_url' => $img_url,
            ':data_url' => $data_url,
            ':mt_id' => $mt_id ,
            ':cat_id' => $cat_id ,
            ':sbcat_id' => $sbcat_id ,
            ':status_id' => $status_id 
        ];
        $this->insert($sql, $params);
    }
    
    public function deleteArticle($id)
    {
        $sql = "DELETE FROM articles WHERE ar_id = :id";
        $params = [
            ':id' => $id
        ];
        $this->delete($sql, $params);
    }
    
    public function updateArticle($id, $name, $description, $color, $value, $img_url,$cat_id,$sbcat_id,$mt_id,$charac,$data_url)
    {
        $sql = "UPDATE articles 
                SET ar_name = :name, ar_desc = :description, color_id = :color,
                ar_measurement_value = :value,ar_characteristics=:charac,ar_img_url = :img_url,ar_data_url=:data_url, cat_id=:cat_id,sbcat_id=:sbcat_id,mt_id=:mt_id
                WHERE ar_id = :id";
        $params = [
            ':id' => $id,
            ':name' => $name,
            ':description' => $description,
            ':color' => $color,
            ':value' => $value,
            ':img_url' => $img_url,
            ':cat_id'=>$cat_id,
            ':sbcat_id'=>$sbcat_id,
            ':mt_id'=>$mt_id,
            ':charac'=>$charac,
            ':data_url'=>$data_url
        ];
        $this->update($sql, $params);
    }
    
    public function getArticleUrls($ar_id)
    {
        $sql = "SELECT ar_data_url, ar_img_url FROM articles WHERE ar_id = :ar_id";
        $params = [':ar_id' => $ar_id];
        $result = $this->select($sql, $params);

        if ($result && count($result) > 0) {
            return $result[0];
        }

        return null;
    }

} 


?>