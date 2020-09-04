<?php
class Model{
    function __construct()
    {
    R::setup( 'mysql:host=localhost;dbname=db754992598','root', '' ); //for both mysql or mariaDB
    //R::setup( 'mysql:host=inventorymedical.db.11557681.hostedresource.com;dbname=inventorymedical','inventorymedical','Medical2016!'); //for both mysql or mariaDB
    }

    public function insert($table,$data){
        // print_r($data);
    $base_table = R::dispense( $table );
    R::begin();
    try{
      foreach ($data as $key => $value) {
        //echo $key."_".$value;
        $base_table->$key = $value;
        // $book->rating = 10;
      }
        $id = R::store( $base_table );
        R::commit();
    }
    catch(Exception $e) {
        R::rollback();
    }
    return $id;
    }

    public function select($table,$id){
        $result=R::getAll("SELECT * FROM $table WHERE id = :id", array(':id' => $id));
        print_r($result);
    }

    public function update($table,$data,$id){
    $base_table = R::load($table,$id);
    R::begin();
    try{
      foreach ($data as $key => $value) {
        //echo $key."_".$value;
        $base_table->$key = $value;
        // $book->rating = 10;
      }
        $id = R::store( $base_table );
        R::commit();
    }
    catch( Exception $e ) {
        R::rollback();
    }
     return $id;
    }

    // public function delete($table,$id){
    // $base_table = R::load($table,$id);
    // R::begin();
    // try{
    //     $id = R::trash( $base_table );
    //     R::commit();
    // }
    // catch( Exception $e ) {
    //     R::rollback();
    // }
    //  return $id;
    // }
////new/////
public function delete2($table,$id){
    $base_table = R::load($table,$id);
    R::begin();
    try{
        $id = R::trash( $base_table );
        R::commit();
    }
    catch( Exception $e ) {
        R::rollback();
    }
     return $id;
    }
////////////
    public function update_item_price($id,$val){
        $ids=$id;
        $value=$val;
     $rest=R::exec("UPDATE stockitems SET last_price='$value' WHERE id='$ids'");
     if($rest=='1'){
     return '10';
     }else{
     return '20';  
     }
    }

    public function update_item_quantity($id,$qty){
        $ids=$id;
        $value=$qty;
     $rest=R::exec("UPDATE stockitems SET quantity=quantity+'$value' WHERE id='$ids'");
     if($rest=='1'){
     return '10';
     }else{
     return '20';  
     }
    } 
    
    public function update_item_quantity_4($id,$qty){
        $ids=$id;
        $value=$qty;
     $rest=R::exec("UPDATE stockitems SET quantity=quantity-'$value' WHERE id='$ids'");
     if($rest=='1'){
     return '10';
     }else{
     return '20';  
     }
    }   

    public function update_item_quantity_2($id,$qty,$level){
        $ids=$id;
        $value=$qty;
     if($level==1){
     $rest=R::exec("UPDATE stockitems SET quantity=quantity-'$value' WHERE id='$ids'");
     }else if($level==2){
     $rest=R::exec("UPDATE stockitems SET quantity=quantity+'$value' WHERE id='$ids'");
     }else if($level==3){
      return '10';
     }
     if($rest=='1'){
     return '10';
     }else{
     return '20';  
     }
    }

    public function update_item_quantity_22($id,$qty,$level){
        $ids=$id;
        $value=$qty;
     if($level==1){
     $rest=R::exec("UPDATE stockitems SET quantity=quantity+'$value' WHERE id='$ids'");
     }else if($level==2){
     $rest=R::exec("UPDATE stockitems SET quantity=quantity-'$value' WHERE id='$ids'");
     }else if($level==3){
      return '10';
     }
     if($rest=='1'){
     return '10';
     }else{
     return '20';  
     }
    }

    public function update_item_quantity_3($act_item,$new_item,$act_qty,$new_qty){
    $rest=R::exec("UPDATE stockitems SET quantity=quantity-'$act_qty' WHERE id='$act_item'");
     if($rest=='1'){
     $rr=R::exec("UPDATE stockitems SET quantity=quantity+'$new_qty' WHERE id='$new_item'");
         if($rr=='1'){
         return '10';
         }else{
         return '20';  
         }
     }else{
     return '20';  
     } 
    }

    public function update_item_quantity_33($act_item,$new_item,$act_qty,$new_qty){
    $rest=R::exec("UPDATE stockitems SET quantity=quantity+'$act_qty' WHERE id='$act_item'");
     if($rest=='1'){
     $rr=R::exec("UPDATE stockitems SET quantity=quantity-'$new_qty' WHERE id='$new_item'");
         if($rr=='1'){
         return '10';
         }else{
         return '20';  
         }
     }else{
     return '20';  
     } 
    }

    public function get_patient($id){
        $rs=R::getAll("SELECT first_name FROM customers WHERE id='$id'");
        if($rs){
            foreach ($rs as $value) {
                return $value['first_name'];
            }
        }
    }

    public function get_count($table){
        $rs=R::getAll("SELECT COUNT(id) as cnt FROM $table");
        if($rs){
            foreach ($rs as $value) {
                return $value['cnt'];
            }
        }    
    }
}
?>