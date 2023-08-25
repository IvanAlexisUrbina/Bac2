<?php

namespace Models\Order;

use Models\MasterModel;

Class OrderModel extends MasterModel
{

     
    public function consultOrders()
    {
        $sql = "SELECT `order`.*,order_states.*
        FROM `order`
        INNER JOIN order_states 
        ON `order`.order_state_id=order_states.order_state_id";
        $params = [];
        $Orders = $this->select($sql, $params);
        return $Orders;
    }

    public function consultOrderById($id)
    {   
        $result = $this->selectById('`order`', 'order_id', $id);
        return $result;
    }


    public function consultOrdersClients(){
        $sql = "SELECT `order`.*,order_states.*, company.c_id, company.c_name
        FROM `order`
        INNER JOIN users 
        ON users.u_id = `order`.u_id
        INNER JOIN order_states 
        ON `order`.order_state_id=order_states.order_state_id
        INNER JOIN company 
        ON company.c_id=users.c_id";
        $params = [];
        $orders = $this->select($sql, $params);
        return $orders;
    }

    public function insertExtraAttributeOrder( $order_attrs_name, $order_attrs_desc, $order_id)
    {
        $sql = "INSERT INTO extra_attributes_order (order_attrs_name, order_attrs_desc, order_id)
                VALUES (:order_attrs_name, :order_attrs_desc, :order_id)";
        $params = [
            ':order_attrs_name' => $order_attrs_name,
            ':order_attrs_desc' => $order_attrs_desc,
            ':order_id' => $order_id,
        ];
        $this->insert($sql, $params);
    }
    
    public function updateStatesOrder($order_id, $order_state_id)
    {
        $sql = "UPDATE `order` SET order_state_id = :order_state_id 
        WHERE order_id = :order_id";
        $params = [
            ':order_state_id' => $order_state_id,
            ':order_id' => $order_id,
        ];
    
        $this->update($sql, $params);
    }
    
    public function insertOrder($name, $desc, $payment_method, $company, $shipping_address, $email, $phone, $comments, $cedula_nit,$subtotal,$iva,$total,$url, int $u_id,int $order_state_id=1)
    {
        $sql = "INSERT INTO `order` (order_name, order_desc, order_payment_method, order_company, order_shipping_address, order_email, order_phone, order_comments, order_cedula_nit,order_subtotal,order_iva,order_total,order_url_document, u_id,order_state_id)
                VALUES (:name, :desc, :payment_method, :company, :shipping_address, :email, :phone, :comments, :cedula_nit,:order_subtotal,:order_iva,:order_total,:order_url_document,:u_id,:order_state_id)";
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
            ':order_subtotal' => $subtotal,
            ':order_iva' => $iva,
            ':order_total' => $total,
            ':order_url_document' => $url,
            ':u_id' => $u_id,
            ':order_state_id' => $order_state_id,
        ];

        $this->insert($sql, $params);
    }
    

    public function insertOrderArticle($order_id, $ar_id, $quantity, $priceNormal, $discountPercentajeOrPrice, $discountPrice)
{
    $sql = "INSERT INTO order_articles (order_id, ar_id, orderart_quantity, orderart_pricenormal, orderart_discountPercentajeOrPrice, orderart_discountPrice)
            VALUES (:order_id, :ar_id, :quantity, :priceNormal, :discountPercentajeOrPrice, :discountPrice)";
    $params = [
        ':order_id' => $order_id,
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