<?php
include 'VendingMachine.php';
include 'Drinks.php';

session_start();

if (!isset($_SESSION['vendingMachine'])) {
    $drinks = new Drinks();
    $_SESSION['vendingMachine'] = new VendingMachine('лв.', $drinks);
}

$vendingMachine = $_SESSION['vendingMachine'];

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['action'])) {
    switch ($_POST['action']) {
        case 'viewDrinks':
            echo json_encode(['drinks' => $vendingMachine->viewDrinks(), JSON_UNESCAPED_UNICODE]);
            break;

        case 'putCoin':
            $coin = isset($_POST['coin']) ? floatval($_POST['coin']) : 0;
            $vendingMachine->putCoin($coin);
            echo json_encode(['amount' => number_format($vendingMachine->viewAmount(), 2), JSON_UNESCAPED_UNICODE]);
            break;

        case 'buyDrink':
            $drinks = $vendingMachine->getDrinksInstance();
            $drink = $drinks->findDrinkByName($_POST['drink'])['item'];
            if ( $drink === null ) { 
                echo json_encode(['result' => 'Няма такава напитка в машината'], JSON_UNESCAPED_UNICODE); 
                exit;
            }

            if ( $drink['quantity'] === 0 ) { 
                echo json_encode(['result' => 'Изчерпано количество'], JSON_UNESCAPED_UNICODE); 
                exit;
            }

            $result = $vendingMachine->buyDrink($drink);
            echo json_encode($result);
            break;

        case 'getCoins':
            $vendingMachine->getCoins();
            break;

        case 'clearSession':
            session_unset();
            $drinks = $vendingMachine->getDrinksInstance();
            echo json_encode(['drinks' => $drinks->reset(), JSON_UNESCAPED_UNICODE]);
            break;
    }
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['action'])) {
    switch ($_POST['action']) {
        case 'add':
            $drinks = $vendingMachine->getDrinksInstance();
            $newDrinks = $drinks->add($_POST['drink']);
            echo json_encode(['drinks' => $newDrinks, JSON_UNESCAPED_UNICODE]);
            break;

        case 'update':
            $drinks = $vendingMachine->getDrinksInstance();
            $updatedDrinks = $drinks->update($_POST['drinkName'], $_POST['updatedDrink']);
            echo json_encode(['drinks' => $updatedDrinks, JSON_UNESCAPED_UNICODE]);
            break;

        case 'delete':
            $drinks = $vendingMachine->getDrinksInstance();
            $newDrinks = $drinks->delete($_POST['drinkName']);
            echo json_encode(['drinks' => $newDrinks, JSON_UNESCAPED_UNICODE]);
            break;
    }
}
