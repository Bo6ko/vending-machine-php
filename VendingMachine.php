<?php

class VendingMachine {
    private $currency;
    // injected class Drinks
    private $drinks;
    private $amount = 0.0;

    public function __construct($currency, $drinks) {
        if ( !isset($currency) ) {
            die("Невалидни данни за валута.\n");
        }
        
        if (empty($drinks->getAll()) || !is_array($drinks->getAll())) {
            die("Невалидни напитки.\n");
        }

        $this->currency = $currency;
        $this->drinks = $drinks;
    }

    public function viewDrinks() {
        return $this->drinks->getAll();
    }

    public function putCoin($coin) {
        $this->amount += $coin;
        return number_format($this->amount, 2);
    }

    public function buyDrink($drink) {
        if ( $this->amount > $drink['price'] ) {
            $this->amount = $this->amount - $drink['price'];
            return [
                'result'    => "Успешно закупена напитка: {$drink['product']}",
                'data'      => $drink
            ];
        }

        $diff = $drink['price'] - $this->amount;
        return ['result' => "Не ви достигат {$diff} {$this->currency}, за да закупите стоката"];
    }

    public function getCoins() {
        session_destroy();
        $this->amount = 0;
    }

    public function viewAmount() {
        return $this->amount;
    }

    public function getDrinksInstance() {
        return $this->drinks;
    }

}
