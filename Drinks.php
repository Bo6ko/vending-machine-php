<?php

class Drinks {
    private $drinks = [
        ['product' => 'Coca-Cola', 'quantity' => 5, 'price' => 1.25],
        ['product' => 'Pepsi', 'quantity' => 2, 'price' => 1.15],
        ['product' => 'Water', 'quantity' => 3, 'price' => 0.75],
        ['product' => 'Sprite', 'quantity' => 0, 'price' => 1.00],
        ['product' => 'Fanta', 'quantity' => 1, 'price' => 1.10]
    ];

    function getAll() {
        return $this->drinks;
    }

    function add($drink) {
        $this->drinks[] = $drink;
        return $this->drinks;
    }
    function update($drinkName, $updatedDrink) {
        $findedDrink = $this->findDrinkByName($drinkName);
        if ($findedDrink !== null) {
            $this->drinks[$findedDrink['index']] = $updatedDrink;
        }
        return $this->drinks;
    }
    function delete($drinkName) {
        $findedDrink = $this->findDrinkByName($drinkName);
        if ($findedDrink !== null) {
            unset($this->drinks[$findedDrink['index']]);
            $this->drinks = array_values($this->drinks);
        }
        return $this->drinks;
    }

    public function findDrinkByName($drinkName) {
        foreach ($this->drinks as $index => $item) {
            if ( $item['product'] === trim($drinkName) ) {
                return ['index' => $index, 'item' => $item];
            }
        }
        return null;
    }

    function reset() {
        return $this->drinks;
    }
}
