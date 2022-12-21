<?php 
namespace App\Helper;
class Cart {
    
    public $items = [];
    private $totalPrice = 0;
    private $totalQty = 0;

    public function __construct()
    {   
        
         $this->items = session('cart') ? session('cart') : [];   
    }
    public function add($product,$quantity=1)
    {
        $item=[
            'product_id' => $product->id,
            'name' => $product->name,
            'image' => $product->image,
            'price' => $product->sale_price>0 ? $product->sale_price : $product->price,
            'quantity' => $quantity
        ];

        if(isset($this->items[$product->id])){
            $this->items[$product->id]['quantity'] +=$quantity;
        } else {
            $this->items[$product->id]=$item;
        }
        session(['cart'=>$this->items]);
    }
    public function update($id,$quantity)
    {
        if(isset($this->items[$id])){
            $this->items[$id]['quantity'] =$quantity;
            session(['cart'=>$this->items]);
        }
    }
    
    public function delete($id)
    {
        // if(isset($this->items[$id])){
        //     $this->items[$id]['quantity'] =$quantity;
        //     session(['cart'=>$this->items]);
        // }
    }
    public function getContent()
    {
        return $this->items;
    }
}