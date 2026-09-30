<?php
class ShoppingCart {
    private array $items = [];

    public function __construct() {
        if (isset($_SESSION['cart']) && is_array($_SESSION['cart'])) {
            $this->items = $_SESSION['cart'];
        }
    }

    public function addToCart(int $productId, int $quantity = 1): void {
        if (isset($this->items[$productId])) {
            $this->items[$productId] += $quantity;
        } else {
            $this->items[$productId] = $quantity;
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

    public function getTotal(array $catalogById): float {
        $total = 0.0;
        foreach ($this->items as $id => $quantity) {
            if (isset($catalogById[$id])) {
                $total += (float)$catalogById[$id]['price'] * $quantity;
            }
        }
        return $total;
    }

    private function save(): void {
        $_SESSION['cart'] = $this->items;
    }
}