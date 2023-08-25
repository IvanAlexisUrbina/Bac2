<?php

namespace Models\Stock;

use Models\MasterModel;

Class StockModel extends MasterModel
{

    public function consultStockArticleById($id)
    {   
        $result = $this->selectById('stock', 'ar_id', $id);
        return $result;
    }

    public function consultStockArticle(){
        $sql="SELECT articles.ar_name,articles.ar_desc,articles.ar_id,articles.ar_code,
              articles.color_id,articles.ar_img_url,stock.stock_lote,stock.stock_date_entry,stock.stock_expiration_date,
              stock.stock_quantity,prices.p_value,warehouse.wh_name,warehouse.wh_id
              FROM articles 
              INNER JOIN stock 
              ON articles.ar_id=stock.ar_id
              INNER JOIN prices
              ON prices.ar_id=articles.ar_id
              INNER JOIN warehouse
              ON stock.wh_id=warehouse.wh_id";
              
              $params = [];
        $articles = $this->select($sql, $params); 
        return $articles;
    }
    public function insertStock($quantity, $lote, $date_entry,$date_expiration,$ar_id,$wh_id )
    {
        $sql = "INSERT INTO stock (stock_name, stock_date,stock_Quantity,
                            stock_lote, stock_date_entry,stock_expiration_date,ar_id ,wh_id)
                VALUES (:stock_name, :stock_date,:stock_Quantity, :stock_lote,
                        :stock_date_entry, :stock_expiration_date,:ar_id,:wh_id)";
        $params = [
            ':stock_name' => "Stock " . date("Y-m-d"),
            ':stock_date' => time(),
            ':stock_Quantity' => $quantity,
            ':stock_lote' => $lote,
            ':stock_date_entry' => $date_entry,
            ':stock_expiration_date' => $date_expiration ,
            ':ar_id' => $ar_id ,
            ':wh_id' => $wh_id ,
        ];
        $this->insert($sql, $params);
    }

    public function consultQuantityArticlesImplicated(int $ar_id)
    {
        $sql = "SELECT SUM(orderart_quantity) AS total_quantity
                FROM order_articles
                WHERE ar_id = :ar_id";
    
        $params = [':ar_id' => $ar_id];
        $articles = $this->select($sql, $params);
    
        // Comprobar si hay resultados y si total_quantity no es nulo
        if (!empty($articles) && $articles[0]['total_quantity'] !== null) {
            return $articles[0]['total_quantity'];
        } else {
            // Si no hay resultados o total_quantity es nulo, retornar 0
            return 0;
        }
    }
    

    public function updateStock($stockId, $quantity, $lote, $date_entry, $date_expiration,$wh_id)
{
    $sql = "UPDATE stock
            SET stock_name = :stock_name,
                stock_date = :stock_date,
                stock_Quantity = :stock_Quantity,
                stock_lote = :stock_lote,
                stock_date_entry = :stock_date_entry,
                stock_expiration_date = :stock_expiration_date,
                wh_id = :wh_id
            WHERE stock_id = :stock_id";

    $params = [
        ':stock_name' => "Stock " . date("Y-m-d"),
        ':stock_date' => time(),
        ':stock_Quantity' => $quantity,
        ':stock_lote' => $lote,
        ':stock_date_entry' => $date_entry,
        ':stock_expiration_date' => $date_expiration,
        ':wh_id' => $wh_id,
        ':stock_id' => $stockId
    ];

    $this->update($sql, $params);
}


}

?>