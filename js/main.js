$(document).ready(function () {
    $.ajax({
        url: 'services.php',
        type: 'POST',
        data: {
            action: 'clearSession'
        },
        success: function (data) {
            try {
                const response = JSON.parse(data);
                listDrinks(response.drinks);
            } catch (e) {
                console.error('Parsing error:', e);
            }
        },
        error: function (xhr, status, error) {
            console.error('Error:', error);
        }
    });

    function viewDrinks() {
        $.ajax({
            url: 'services.php',
            type: 'POST',
            data: {
                action: 'viewDrinks'
            },
            success: function (data) {
                try {
                    const response = JSON.parse(data);
                    listDrinks(response.drinks);
                } catch (e) {
                    console.error('Parsing error:', e);
                }
            },
            error: function (xhr, status, error) {
                console.error('Error:', error);
            }
        });
    }
    viewDrinks();

    function listDrinks(drinks) {
        if (drinks) {
            let drinksHtml = '';
            drinks.forEach(function (drink) {
                drinksHtml += "<div class='drinkItem'>" +
                    "<p><span class='drinkName'>" + drink.product + "</span></p>" +
                    "<p>Количество: <span class='drinkQuantity'>" + drink.quantity + "</span></p>" +
                    "<p>Цена: <span class='drinkPrice'>" + drink.price + "</span> лв.</p>" +
                "</div>";
            });
            $('#drinksList').html(drinksHtml);
        }
    }

    $('.putCoinBtn').click(function () {
        const coinValue = $(this).text();
        $.ajax({
            url: 'services.php',
            type: 'POST',
            data: {
                action: 'putCoin',
                coin: coinValue
            },
            success: function (data) {
                try {
                    const response = JSON.parse(data);
                    $('#balance').html(response.amount);
                } catch (e) {
                    console.error('Parsing error:', e);
                }
            },
            error: function (xhr, status, error) {
                console.error('Error:', error);
            }
        });
    });

    $('#getCoinsBtn').click(function () {
        $.ajax({
            url: 'services.php',
            type: 'POST',
            data: {
                action: 'getCoins'
            },
            success: function (data) {
                try {
                    alert("Ресто: " + $('#balance').text());
                    $('#balance').html(0);
                } catch (e) {
                    console.error('Parsing error:', e);
                }
            },
            error: function (xhr, status, error) {
                console.error('Error:', error);
            }
        });
    });

    $('#buyDrinkBtn').click(function () {
        const drink = $('#buyDrink').val();
        if (drink.trim() !== '') {
            $.ajax({
                url: 'services.php',
                type: 'POST',
                data: {
                    action: 'buyDrink',
                    drink: drink
                },
                success: function (data) {
                    try {
                        const response = JSON.parse(data);
                        alert(response.result);
                        if (response.data) {
                            console.log(response.data)
                            const diff = $('#balance').text() - response.data.price;
                            $('#balance').html(diff.toFixed(2));
                        }
                    } catch (e) {
                        console.error('Parsing error:', e);
                    }
                },
                error: function (xhr, status, error) {
                    console.error('Error:', error);
                }
            });
        } else {
            alert('Полето за въвеждане на стока е задължително!');
        }
    });

    $(document).on('click', '.drinkItem', function() {
        $('#selectedDrink').addClass('selected');
        $('#selectedDrink').html($(this).find('.drinkName').text());

        $('.updateDrink').find('input[name="drinkName"]').val($(this).find('.drinkName').text());
        $('.updateDrink').find('input[name="drinkQuantity"]').val($(this).find('.drinkQuantity').text());
        $('.updateDrink').find('input[name="drinkPrice"]').val($(this).find('.drinkPrice').text());
    });

    $('#addDrinkBtn').click(function () {
        const drinkName = $('.addDrink').find('input[name="drinkName"]').val().trim();
        const drinkQuantity = $('.addDrink').find('input[name="drinkQuantity"]').val().trim();
        const drinkPrice = $('.addDrink').find('input[name="drinkPrice"]').val().trim();

        if ( drinkName !== '' && drinkQuantity !== '' && drinkPrice !== '' ) {
            const drink = {
                'product': drinkName, 
                'quantity': drinkQuantity, 
                'price': drinkPrice
            }
            $.ajax({
                url: 'services.php',
                type: 'POST',
                data: {
                    action: 'add',
                    drink: drink
                },
                success: function (data) {
                    try {
                        const response = JSON.parse(data);
                        listDrinks(response.drinks);
                    } catch (e) {
                        console.error('Parsing error:', e);
                    }
                },
                error: function (xhr, status, error) {
                    console.error('Error:', error);
                }
            });
        } else {
            alert('Полетата за напитка име, количество и цена са задължителни');
        }
    });

    $('#updateDrinkBtn').click(function () {
        const drinkName = $('#selectedDrink').text().trim();
        const updatedDrinkName = $('.updateDrink').find('input[name="drinkName"]').val().trim();
        const updatedDrinkQuantity = $('.updateDrink').find('input[name="drinkQuantity"]').val().trim();
        const updatedDrinkPrice = $('.updateDrink').find('input[name="drinkPrice"]').val().trim();

        if ( updatedDrinkName !== '' && updatedDrinkQuantity !== '' && updatedDrinkPrice !== '' ) {
            const updatedDrink = {
                'product': updatedDrinkName, 
                'quantity': updatedDrinkQuantity, 
                'price': updatedDrinkPrice
            }
            $.ajax({
                url: 'services.php',
                type: 'POST',
                data: {
                    action: 'update',
                    drinkName: drinkName,
                    updatedDrink: updatedDrink
                },
                success: function (data) {
                    try {
                        const response = JSON.parse(data);
                        listDrinks(response.drinks);
                    } catch (e) {
                        console.error('Parsing error:', e);
                    }
                },
                error: function (xhr, status, error) {
                    console.error('Error:', error);
                }
            });
        } else {
            alert('Трябва първо да изберете стока');
        }
    });

    $('#deleteDrinkBtn').click(function () {
        const drinkName = $('#selectedDrink').text().trim();
        const updatedDrinkName = $('.updateDrink').find('input[name="drinkName"]').val().trim();
        const updatedDrinkQuantity = $('.updateDrink').find('input[name="drinkQuantity"]').val().trim();
        const updatedDrinkPrice = $('.updateDrink').find('input[name="drinkPrice"]').val().trim();

        if ( updatedDrinkName !== '' && updatedDrinkQuantity !== '' && updatedDrinkPrice !== '' ) {
            $.ajax({
                url: 'services.php',
                type: 'POST',
                data: {
                    action: 'delete',
                    drinkName: drinkName,
                },
                success: function (data) {
                    try {
                        const response = JSON.parse(data);
                        listDrinks(response.drinks);
                        $('#selectedDrink').removeClass('selected');
                        $('#selectedDrink').html(drinkName + ' - Продукта е изтрит!');

                        $('.updateDrink').find('input[name="drinkName"]').val('');
                        $('.updateDrink').find('input[name="drinkQuantity"]').val('');
                        $('.updateDrink').find('input[name="drinkPrice"]').val('');
                    } catch (e) {
                        console.error('Parsing error:', e);
                    }
                },
                error: function (xhr, status, error) {
                    console.error('Error:', error);
                }
            });
        } else {
            alert('Трябва първо да изберете стока');
        }
    });
});