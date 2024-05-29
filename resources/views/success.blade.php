<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="{{ asset('storage/css/nav.css')}}">
    <link rel="stylesheet" href="{{ asset('storage/css/success.css')}}">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Document</title>
</head>
<body>
    <header>
        <div class="menu_block">
            <div class="menu_button">
                <div class="first"></div>
                <div class="second"></div>
                <div class="third"></div>
            </div>
            <div class="gender">
                <a href="{{ route('shop') }}"><p class="gender_label" id="woman-section-btn">Каталог</p></a>
            </div>
        </div>

        <div class="logo">
            <a href="{{ route('home') }}"><p class="logo_label">Patience</p></a>
        </div>

        <div class="account_block">
            <img class="account_button favorite" src="{{ asset('assets/ui_icons/favorite.png') }}">
            @if (auth()->user())
                <img class="account_button account" src="{{ asset('assets/ui_icons/account_auth.png') }}">
            @else
                <img class="account_button account" src="{{ asset('assets/ui_icons/account.png') }}">
            @endif
            <img class="account_button shoppingBag" src="{{ asset('assets/ui_icons/shoppingBag.png') }}">
        </div>
    </header>

    <div class="cart_block">
        <div class="cart_menu">
            <div class="cart_label">
                <p>Корзина товаров</p>
            </div>
            <div class="cart_cross">
                <img src="{{ asset('storage/assets/ui_icons/cross_black.png') }}">
            </div>
        </div>
        <div class="cart_container">
            @if (auth()->user())
            @foreach ($carts as $cart_item)
            @if (auth()->user()->id == $cart_item->user_id)
            @foreach ($products as $product) 
            @if ($product->id == $cart_item->product_id)
            <div class="cart_item" data-product-id="{{ $cart_item->product_id }}">
                <?php
                    $image = $images->where('product_id', $product->id)->first();
                    $imageUrl = asset('storage/'.$image->url);
                ?>
                <img src="{{ $imageUrl }}">
                <div class="cart_item_desc">
                    <p class="cart_item_name">{{ $product->product_name }}</p>
                    <p class="article">Артикул: {{ $product->id }}</p>
                    <div class="product_quantity_container">
                        <p class="cart_item_count">Количество товара:  </p>
                        <div class="counter">
                            <div class="counter_minus">
                                <p>-</p>
                            </div>
                            <div class="counter_value">
                                <p id="quantity_value">{{ $cart_item->quantity }}</p>
                            </div>
                            <div class="counter_plus">
                                <p>+</p>
                            </div>
                            <input hidden id="product_quantity" class="product_quantity" type="number" name="product_quantity" value="{{ $cart_item->quantity }}}">
                        </div>
                    </div>
                    <div class="product_size_container">
                        <p>Размер</p>
                        @foreach($sizes as $size)
                            @if ($cart_item->size_id == $size->id)
                                <p class="cart_product_size">{{ $size->size }}</p>
                            @endif
                        @endforeach
                    </div>
                    <div class="cart_item_footer">
                        <p class="cart_item_price">{{ $product->price }} ₽</p>
                        <div class="cart_item_buttons">
                            <img class="favorite_icon" src="{{ asset('storage/assets/ui_icons/favorite.png') }}">
                            <img class="trash_icon" src="{{ asset('storage/assets/ui_icons/trash.png') }}">
                        </div>
                    </div>
                </div>
            </div>
            @endif
            @endforeach
            @endif
            @endforeach
            @endif
        </div>
        <div class="cart_footer">
            <div class="cart_total_price">
                <p class="total_price_label">Итого </p>
                <p class="total_price">{{ $total_price }} ₽</p>
            </div>
            <a href="{{ route('order.confirm') }}"><button class="_button">Оформить заказ</button></a>
        </div>
    </div>

    <div class="burger_menu">
        <div class="cross_button">
            <img src="{{ asset('assets/ui_icons/cross.png') }}">
        </div>
        <p class="menu_item">Новинки</p>
        <p class="menu_item">Популярное</p>
        <p class="menu_item">Аксессуары</p>
        <p class="menu_item">Акции</p>
    </div>

    <div class="login_block">
            <div class="login_button_container">
                <div class="switch_buttons">
                    <button class="switch login">Вход</button>
                    <button class="switch register">Регистрация</button>
                    <div class="toggle_line"></div>
                </div>
                <div class="cross_btn">
                    <img src="{{ asset('assets/ui_icons/cross_black.png') }}">
                </div>
            </div>
       
            <div class="account_block">
                <form class="login_form form" method="GET" action="{{ route('login') }}">
                    @csrf
                    <input class="_input" type="text" name="email_login" placeholder="Введите ваш e-mail">
                    <div class="error_container"><p  class="error"></p></div>
                    <input class="_input" type="password" name="password_login" placeholder="Введите пароль">
                    <div class="error_container"><p  class="error"></p></div>
                    <button  type="submit" class="_button">ВОЙТИ</button>
                    <p class="login_description">Нажимая на кнопку «Войти», Вы подтверждаете, что ознакомлены с Политикой конфиденциальности</p>
                </form> 
                <form class="registration form" method="POST" action="{{ route('register') }}">
                    @csrf
                    <input class="_input" name="name" type="text" placeholder="Введите ваше имя">
                    <div class="error_container"><p id="name-error" class="error"></p></div>

                    <input class="_input" name="phone" type="text" placeholder="Номер телефона">
                    <div class="error_container"><p id="phone-error" class="error"></p></div>

                    <input class="_input" name="email" type="text" placeholder="Введите ваш e-mail">
                    <div class="error_container"><p id="email-error" class="error"></p></div>

                    <input class="_input" name="birthday" type="date" placeholder="Дата рождения">
                    <div class="error_container"><p class="error"></p></div>
                    <input class="_input" name="password" type="password" placeholder="Введите пароль">
                    <div class="error_container"><p class="error"></p></div>
                    <input class="_input" type="text" placeholder="Повторите пароль">
                    <div class="error_container"><p class="error"></p></div>
                    <button class="_button" type="submit" onclick="submitForm()">СОЗДАТЬ АККАУНТ</button>
                    <p class="login_description">Регистрируясь, Вы присоединяетесь к Правилам работы магазина и подтверждаете, что ознакомлены с Политикой конфиденциальности</p>
                </form>        
            </div>
    </div>

    <div class="modal_container">
        <div class="modal_background">
            <div class="success_modal">
                <div class="time_line"></div>
                <div class="success_message">
                    <h1>Пользователь успешно зарегистрирован!</h1>
                    <p>Теперь все ваши покупки будут отображаться в корзине</p>
                </div>
            </div>
        </div>

        <div class="add_product_modal">
            <p>Товар добавлен в корзину</p>
        </div>
    </div>

    <script>
        const menu_btn = document.querySelector('.menu_button');
        const cross_btn = document.querySelector('.cross_button');

        menu_btn.addEventListener('click', function() {
            var burger = document.querySelector('.burger_menu');

            burger.classList.toggle('active');
        });

        cross_btn.addEventListener('click', function() {
            var burger = document.querySelector('.burger_menu');

            burger.classList.toggle('active');
        });
    </script>

    <script>
        const login = document.querySelector('.login');
        const reg = document.querySelector('.register');
        const modal_win = document.querySelector('.login_form');
        const login_form = document.querySelector('.login_form');
        const registration_form = document.querySelector('.registration');
        let elementsAdded = false;

        login.addEventListener('click', function() {
            var line = document.querySelector('.toggle_line');
            line.classList.remove('switched');
            login_form.style.display = 'block';
            registration_form.style.display = 'none';
        });

        reg.addEventListener('click', function() {
            var line = document.querySelector('.toggle_line');
            line.classList.add('switched');
            login_form.style.display = 'none';
            registration_form.style.display = 'block';
        });
    </script>

    <script>
        const account_btn = document.querySelector('.account');
        let burger = document.querySelector('.login_block');
        const acc_cross_btn = document.querySelector('.cross_btn');

        account_btn.addEventListener('click', function() {
            burger.classList.toggle('active');
        });

        acc_cross_btn.addEventListener('click', function() {
            burger.classList.toggle('active');
            const errorElements = document.querySelectorAll('.error');
            errorElements.forEach(element => {
                element.textContent = '';
            });
            const inputElements = document.querySelectorAll('._input');
            inputElements.forEach(element => {
                element.style.borderBottom = '1px solid rgb(165, 165, 165)';
            });
        });
    </script>

    <script>
        const cart_btn = document.querySelector('.shoppingBag');
        let cart = document.querySelector('.cart_block');
        const cart_cross_btn = document.querySelector('.cart_cross');

        cart_btn.addEventListener('click', function() {
            

            cart.classList.toggle('active');
        });

        cart_cross_btn.addEventListener('click', function() {

            cart.classList.toggle('active');
        });

        function submitForm() {
            event.preventDefault();

            let form = document.querySelector('.registration');
            let formData = new FormData(form);

            fetch('/registration', {
                method: 'POST',
                body: formData,
            })
            .then(response => response.json())
            .then(data => {

                document.querySelector('input[name="name"]').style.borderBottom = '1px solid rgb(165, 165, 165)';
                document.querySelector('input[name="phone"]').style.borderBottom = '1px solid rgb(165, 165, 165)';
                document.querySelector('input[name="email"]').style.borderBottom = '1px solid rgb(165, 165, 165)';

                if (data.errors) {
                    if (data.errors.name) {
                        document.getElementById('name-error').textContent = data.errors.name[0];
                        document.querySelector('input[name="name"]').style.borderBottom = '1px solid red';
                    }
                    if (data.errors.phone) {
                        document.getElementById('phone-error').textContent = data.errors.phone[0];
                        document.querySelector('input[name="phone"]').style.borderBottom = '1px solid red';
                    }
                    if (data.errors.email) {
                        document.getElementById('email-error').textContent = data.errors.email[0];
                        document.querySelector('input[name="email"]').style.borderBottom = '1px solid red';
                    }
                } else if (data.success) {
                    const successModal = document.querySelector('.success_modal');
                    var timeLine = document.querySelector('.time_line');
                    const login_block = document.querySelector('.login_block');
                    const modal_background = document.querySelector('.modal_background');

                    modal_background.style.display = 'block';
                    successModal.classList.add('active');
                    timeLine.classList.add('active');
                    login_block.classList.remove('active');
                    // Через 5 секунд скрываем модальное окно
                    setTimeout(() => {
                        successModal.classList.remove('active');
                        timeLine.classList.remove('active');
                    }, 3000);
                    form.reset();
                }
            })
            .catch((error) => {
                console.error('Error:', error);
            });
        }



    </script>

    <script>
        document.addEventListener("DOMContentLoaded", function () {
            document.getElementById("add_cart").addEventListener('click', function() {
                console.log("+");
                var sizeId =  document.querySelector(".selected").dataset.sizeId;
                var productId = document.querySelector(".product_info").dataset.productId;

                    fetch('/cart/add', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                        },
                        body: JSON.stringify({
                            product_id: productId,
                            size_id: sizeId,
                            quantity: 1
                        })
                    })
                    .then(response => response.json())
                    .then(data => {
                        if (data.success) {
                            const add_modal = document.querySelector('.add_product_modal');
                            updateCart(data.cart);
                            add_modal.style.display = 'block';
                            setTimeout(() => {
                                add_modal.style.display = 'none';
                            }, 3000);
                        } else {
                            alert("Failed to add product to cart.");
                        }
                    })
                    .catch(error => console.error('Error:', error));
                });
            });

            function addEventListenersToCart() {
                const trashIcons = document.querySelectorAll('.trash_icon');
    
                trashIcons.forEach(icon => {
                    icon.addEventListener('click', function() {
                    const productId = this.closest('.cart_item').dataset.productId;

                    fetch(`/cart/${productId}`, {
                        method: 'DELETE',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': '{{ csrf_token() }}'
                        }
                    })
                    .then(response => response.json())
                    .then(data => {
                        if (data.success) {
                            // Успешно удалено из базы данных
                            this.closest('.cart_item').remove();
                            document.querySelector('.total_price').textContent = data.totalPrice + ' ₽';
                        } else {
                            alert('Произошла ошибка при удалении товара.');
                        }
                    })
                    .catch(error => {
                        console.error('Ошибка удаления товара:', error);
                    });
                });
            });

            const counterContainers = document.querySelectorAll(".counter");

            counterContainers.forEach(function(container) {
                const quantityValue = container.querySelector(".counter_value p");

                // Обработчик нажатия на кнопку минус
                container.querySelector(".counter_minus").addEventListener("click", function() {
                    let quantity = parseInt(quantityValue.textContent);
                    let quantity_input = container.querySelector(".product_quantity");
                    if (quantity > 1) {
                        quantity--;
                        quantityValue.textContent = quantity;
                        quantity_input.setAttribute('value', quantity);
                        quantity_input.dispatchEvent(new Event('change'));
                    }
                });

                // Обработчик нажатия на кнопку плюс
                container.querySelector(".counter_plus").addEventListener("click", function() {
                    let quantity = parseInt(quantityValue.textContent);
                    let quantity_input = container.querySelector(".product_quantity");
                    quantity++;
                    quantityValue.textContent = quantity;
                    quantity_input.setAttribute('value', quantity);
                    quantity_input.dispatchEvent(new Event('change'));
                });
            });

            const quantityInputs = document.querySelectorAll('.product_quantity');

            quantityInputs.forEach(input => {
                input.addEventListener('change', function() {
                    const quantity = this.value;
                    const productId = this.closest('.cart_item').dataset.productId;

                    fetch('{{ route('cart.updateQuantity') }}', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': '{{ csrf_token() }}'
                        },
                        body: JSON.stringify({
                            product_id: productId,
                            quantity: quantity
                        })
                    })
                    .then(response => response.json())
                    .then(data => {
                        if (data.success) {
                            document.querySelector('.total_price').textContent = data.totalPrice + ' ₽';
                        } else {
                            alert('Произошла ошибка при обновлении количества.');
                        }
                    });
                });
            });
            }

            function updateCart(cart) {
                const cartContainer = document.querySelector('.cart_container');
                cartContainer.innerHTML = '';

                cart.items.forEach(cartItem => {
                    const cartItemElement = document.createElement('div');
                    cartItemElement.classList.add('cart_item');
                    cartItemElement.dataset.productId = cartItem.product_id;
                    cartItemElement.innerHTML = `
                        <img src="${cartItem.image_url}">
                        <div class="cart_item_desc">
                            <p class="cart_item_name">${cartItem.product_name}</p>
                            <p class="article">Артикул: ${cartItem.product_id}</p>
                            <div class="product_quantity_container">
                                <p class="cart_item_count">Количество товара:  </p>
                                <div class="counter">
                                    <div class="counter_minus">
                                        <p>-</p>
                                    </div>
                                    <div class="counter_value">
                                        <p id="quantity_value">${cartItem.quantity}</p>
                                    </div>
                                    <div class="counter_plus">
                                        <p>+</p>
                                    </div>
                                    <input hidden id="product_quantity" class="product_quantity" type="number" name="product_quantity" value="${cartItem.quantity}">
                                </div>
                            </div>
                            <div class="product_size_container">
                                <p>Размер</p>
                                <p class="cart_product_size">${cartItem.size_name}</p>
                            </div>
                            <div class="cart_item_footer">
                                <p class="cart_item_price">${cartItem.price} ₽</p>
                                <div class="cart_item_buttons">
                                    <img class="favorite_icon" src="{{ asset('storage/assets/ui_icons/favorite.png') }}">
                                    <img class="trash_icon" src="{{ asset('storage/assets/ui_icons/trash.png') }}">
                                </div>
                            </div>
                        </div>
                    `;
                    cartContainer.appendChild(cartItemElement);
                });

                document.querySelector('.total_price').textContent = cart.total_price + ' ₽';

                addEventListenersToCart();
            }
    </script>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            addEventListenersToCart();
        });
    </script>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const sizeArea = document.querySelector('.size_container');

            if (sizeArea) {
                document.querySelectorAll('.size_item').forEach(size => {
                    size.addEventListener('click', function() {
                        var other = document.querySelectorAll('.size_item').forEach(other_size => 
                        {
                            other_size.classList.remove('selected');
                        });

                        this.classList.add('selected');
                    });
                });
            }
        });
    </script>

    <script>
        document.addEventListener("DOMContentLoaded", function () {
            document.querySelectorAll(".size_button").forEach(button => {
                button.addEventListener("click", function () {
                    const productId = this.closest(".product").dataset.productId;
                    console.log(productId);
                    const sizeId = this.dataset.sizeId;
                    console.log(sizeId);

                    fetch('/cart/add', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                        },
                        body: JSON.stringify({
                            product_id: productId,
                            size_id: sizeId,
                            quantity: 1
                        })
                    })
                    .then(response => response.json())
                    .then(data => {
                        if (data.success) {
                            const add_modal = document.querySelector('.add_product_modal');
                            updateCart(data.cart);
                            add_modal.style.display = 'block';
                            setTimeout(() => {
                                add_modal.style.display = 'none';
                            }, 3000);
                        } else {
                            alert("Failed to add product to cart.");
                        }
                    })
                    .catch(error => console.error('Error:', error));
                });
            });

            function updateCart(cart) {
                const cartContainer = document.querySelector('.cart_container');
                cartContainer.innerHTML = '';

                cart.items.forEach(cartItem => {
                    const cartItemElement = document.createElement('div');
                    cartItemElement.classList.add('cart_item');
                    cartItemElement.dataset.productId = cartItem.product_id;
                    cartItemElement.innerHTML = `
                        <img src="${cartItem.image_url}">
                        <div class="cart_item_desc">
                            <p class="cart_item_name">${cartItem.product_name}</p>
                            <p class="article">Артикул: ${cartItem.product_id}</p>
                            <div class="product_quantity_container">
                                <p class="cart_item_count">Количество товара:  </p>
                                <div class="counter">
                                    <div class="counter_minus">
                                        <p>-</p>
                                    </div>
                                    <div class="counter_value">
                                        <p id="quantity_value">${cartItem.quantity}</p>
                                    </div>
                                    <div class="counter_plus">
                                        <p>+</p>
                                    </div>
                                    <input hidden id="product_quantity" class="product_quantity" type="number" name="product_quantity" value="${cartItem.quantity}">
                                </div>
                            </div>
                            <div class="product_size_container">
                                <p>Размер</p>
                                <p class="cart_product_size">${cartItem.size_name}</p>
                            </div>
                            <div class="cart_item_footer">
                                <p class="cart_item_price">${cartItem.price} ₽</p>
                                <div class="cart_item_buttons">
                                    <img class="favorite_icon" src="{{ asset('storage/assets/ui_icons/favorite.png') }}">
                                    <img class="trash_icon" src="{{ asset('storage/assets/ui_icons/trash.png') }}">
                                </div>
                            </div>
                        </div>
                    `;
                    cartContainer.appendChild(cartItemElement);
                });

                document.querySelector('.total_price').textContent = cart.total_price + ' ₽';

                addEventListenersToCart();
            }
        });

        function addEventListenersToCart() {
            const trashIcons = document.querySelectorAll('.trash_icon');
    
            trashIcons.forEach(icon => {
                icon.addEventListener('click', function() {
                const productId = this.closest('.cart_item').dataset.productId;

                fetch(`/cart/${productId}`, {
                    method: 'DELETE',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    }
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        // Успешно удалено из базы данных
                        this.closest('.cart_item').remove();
                        document.querySelector('.total_price').textContent = data.totalPrice + ' ₽';
                    } else {
                        alert('Произошла ошибка при удалении товара.');
                    }
                })
                .catch(error => {
                    console.error('Ошибка удаления товара:', error);
                });
            });
            });

            const counterContainers = document.querySelectorAll(".counter");

            counterContainers.forEach(function(container) {
                const quantityValue = container.querySelector(".counter_value p");

                // Обработчик нажатия на кнопку минус
                container.querySelector(".counter_minus").addEventListener("click", function() {
                    let quantity = parseInt(quantityValue.textContent);
                    let quantity_input = container.querySelector(".product_quantity");
                    if (quantity > 1) {
                        quantity--;
                        quantityValue.textContent = quantity;
                        quantity_input.setAttribute('value', quantity);
                        quantity_input.dispatchEvent(new Event('change'));
                    }
                });

                // Обработчик нажатия на кнопку плюс
                container.querySelector(".counter_plus").addEventListener("click", function() {
                    let quantity = parseInt(quantityValue.textContent);
                    let quantity_input = container.querySelector(".product_quantity");
                    quantity++;
                    quantityValue.textContent = quantity;
                    quantity_input.setAttribute('value', quantity);
                    quantity_input.dispatchEvent(new Event('change'));
                });
            });

            const quantityInputs = document.querySelectorAll('.product_quantity');

            quantityInputs.forEach(input => {
                input.addEventListener('change', function() {
                    const quantity = this.value;
                    const productId = this.closest('.cart_item').dataset.productId;

                    fetch('{{ route('cart.updateQuantity') }}', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': '{{ csrf_token() }}'
                        },
                        body: JSON.stringify({
                            product_id: productId,
                            quantity: quantity
                        })
                    })
                    .then(response => response.json())
                    .then(data => {
                        if (data.success) {
                            document.querySelector('.total_price').textContent = data.totalPrice + ' ₽';
                        } else {
                            alert('Произошла ошибка при обновлении количества.');
                        }
                    });
                });
            });
            }
    </script>

</body>
</html>