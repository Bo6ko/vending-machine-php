<!DOCTYPE html>
<html lang="bg">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Vending Machine</title>
    <link rel="stylesheet" type="text/css" href="./css/style.css">
    <script src="./js/jquery.min.js"></script>
    <script src="./js/main.js"></script>
</head>
<body>
    <h1>Vending Machine</h1>

    <h2>Автомат с продукти</h2>
    <div class="vendingMacine">
        <div>
            <span>Монети: </span>
            <button class="putCoinBtn">0.05</button>
            <button class="putCoinBtn">0.10</button>
            <button class="putCoinBtn">0.20</button>
            <button class="putCoinBtn">0.50</button>
            <button class="putCoinBtn">1</button>
        </div>
        <p>Баланс: <span id="balance">0</span></p>
        <div id="drinksList"></div>
        <div>
            <p>
                Тук за купуване на стоката го направих да се въвежда стоката с инпут поле, за да може да се 
                симулира тази част от задачата: "съобщения за грешна напитĸа". Т.е при изписване на грешна напитка,
                която не съществува в машината - да дава съобщение за грешка.
            </p>
            <p>Иначе по-правилно според мен е купуването на стока от машината да става с клик върху продукта</p>
            <input id="buyDrink" type="text" name="putCoin" />
            <button id="buyDrinkBtn">Купи напитка</button>
            <br/><br/>
            <button id="getCoinsBtn">Вземи ресто</button>
        </div>
    </div>
    
    <br/><br/><br/>
    <hr/>
    <br/>

    <h2>Административна част</h2>
    <h3>Добавяне на напитки в машината</h3>
    <div class="addDrink">
        <input type="text" name="drinkName" placeholder="Drink" />
        <input type="number" name="drinkQuantity" placeholder="Quantity" />
        <input type="text" name="drinkPrice" placeholder="Price" />
        <button id="addDrinkBtn">Добавяне на напитка</button>
    </div>
    <br/><br/>

    <h2>Редактиране и изтриване на напитки от машината</h2>
    <h3>Изберете напитка и тогава може да я редактирате или изтриете</h3>
    <p id="selectedDrink">Няма избрана напитка</p>
    <div class="updateDrink">
        <input type="text" name="drinkName" placeholder="Drink" />
        <input type="number" name="drinkQuantity" placeholder="Quantity" />
        <input type="text" name="drinkPrice" placeholder="Price" />
        <button id="updateDrinkBtn">Редактиране на напитка</button>
        <button id="deleteDrinkBtn">Изтриване на напитка</button>
    </div>
    <br/><br/><br/>
    
</body>
</html>
