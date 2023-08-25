<?php

namespace Models\Quote;

use Models\MasterModel;


Class QuoteModel extends MasterModel
{


    public function consultQuotes($c_id)
    {
        // Consulta para obtener los usuarios de una compañía específica
        $sql = "SELECT * FROM users WHERE c_id=:c_id";
        $params = [':c_id' => $c_id];
        $users = $this->select($sql, $params);
    
        // Array para almacenar los IDs de los usuarios seleccionados
        $userIDs = [];
    
        // Recorremos los usuarios y almacenamos sus IDs en el array
        foreach ($users as $user) {
            $userIDs[] = $user['u_id'];
        }
    
        // Consulta para obtener las cotizaciones de los usuarios seleccionados
        $sql = "SELECT quotes.*,quotes_states.*
                FROM quotes
                INNER JOIN quotes_states
                ON quotes.quote_state_id=quotes_states.quote_state_id
                WHERE u_id IN (" . implode(',', $userIDs) . ")";
        $params = [];
        $quotes = $this->select($sql, $params);
    
        return $quotes;
    }

    public function consultArticlesOfTheQuote($quo_id){
        $sql = "SELECT * FROM quote_articles 
                WHERE quo_id = :id";
        $params = [':id' => $quo_id];
        $articles = $this->select($sql, $params);
        return $articles;
    }

        public function consultQuoteById($id)
    {
        $sql = "SELECT * FROM quotes WHERE quo_id = :id";
        $params = [':id' => $id];
        $quote = $this->select($sql, $params);
        return $quote;
    }


    public function consultQuotesClients(){
        $sql = "SELECT quotes.*, company.c_id, company.c_name
        FROM quotes
        INNER JOIN users 
        ON users.u_id = quotes.u_id
        INNER JOIN company 
        ON company.c_id=users.c_id";
        $params = [];
        $quotes = $this->select($sql, $params);
        return $quotes;
    }


    public function insertExtraAttributeQuote( $quote_attrs_name, $quote_attrs_desc, $quo_id)
    {
        $sql = "INSERT INTO extra_attributes_quotes (quote_attrs_name, quote_attrs_desc, quo_id)
                VALUES (:quote_attrs_name, :quote_attrs_desc, :quo_id)";
        $params = [
            ':quote_attrs_name' => $quote_attrs_name,
            ':quote_attrs_desc' => $quote_attrs_desc,
            ':quo_id' => $quo_id,
        ];
        $this->insert($sql, $params);
    }
    

        public function insertQuote($name, $desc, $payment_method, $company, $shipping_address, $email, $phone, $comments, $cedula_nit,$subtotal,$iva,$total, $quo_url_document, $u_id,$quote_state_id=1)
    {
        $sql = "INSERT INTO quotes (quo_name, quo_desc, quo_payment_method, quo_company, quo_shipping_address, quo_email, quo_phone, quo_comments, quo_cedula_nit,quo_subtotal,quo_iva,quo_total,quo_url_document, u_id,quote_state_id)
                VALUES (:name, :desc, :payment_method, :company, :shipping_address, :email, :phone, :comments, :cedula_nit,:quo_subtotal,:quo_iva,:quo_total,:quo_url_document,:u_id,:quote_state_id)";
        $params = [
            ':name' => $name,
            ':desc' => $desc,
            ':payment_method' => $payment_method,
            ':company' => $company,
            ':shipping_address' => $shipping_address,
            ':email' => $email,
            ':phone' => $phone,
            ':comments' => $comments,
            ':cedula_nit' => $cedula_nit,
            ':quo_subtotal' => $subtotal,
            ':quo_iva' => $iva,
            ':quo_total' => $total,
            ':quo_url_document' => $quo_url_document,
            ':u_id' => $u_id,
            ':quote_state_id'=>$quote_state_id
        ];

        $this->insert($sql, $params);
    }

    public function insertQuoteArticle($quo_id, $ar_id, $quantity, $priceNormal, $discountPercentajeOrPrice, $discountPrice)
{
    $sql = "INSERT INTO quote_articles (quo_id, ar_id, quoart_quantity, quoart_pricenormal, quoart_discountPercentajeOrPrice, quoart_discountPrice)
            VALUES (:quo_id, :ar_id, :quantity, :priceNormal, :discountPercentajeOrPrice, :discountPrice)";
    $params = [
        ':quo_id' => $quo_id,
        ':ar_id' => $ar_id,
        ':quantity' => $quantity,
        ':priceNormal' => $priceNormal,
        ':discountPercentajeOrPrice' => $discountPercentajeOrPrice,
        ':discountPrice' => $discountPrice,
    ];
    $this->insert($sql, $params);
}






} 


?>