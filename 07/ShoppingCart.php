<?php
class ShoppingCart {
    private array $items = [];

    public function __construct() {
        if (isset($_SESSION['cart']) && is_array($_SESSION['cart'])) {
            $this->items = $_SESSION['cart'];
        }
    }

   
    public function addToCart(int $index, int $quantity = 1): void {
        if (isset($this->items[$index])) {
            $this->items[$index] += $quantity;
        } else {
            $this->items[$index] = $quantity;
        }

        $this->save();
    }

  
    public function getCart(): array {
        return $this->items;
    }

   
    public function clear(): void {
        $this->items = [];
        unset($_SESSION['cart']);
    }

    
    public function getTotal(array $catalog): float {
        $total = 0.0;
        foreach ($this->items as $index => $quantity) {
            if (isset($catalog[$index])) {
                $total += (float)$catalog[$index][1] * $quantity;
            }
        }
        return $total;
    }

    private function save(): void {
        $_SESSION['cart'] = $this->items;
    }
}