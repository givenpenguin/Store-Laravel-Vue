<script>

export default {
    name: 'Cart',
    mounted() {
        this.getProductsInCart()
    },

    data() {
        return {
            productsInCart: [],
            productsQty: 0,
            productsAmount: 0,

            deliveryPrice: 0,
            discount: 0,
        }
    },

    methods: {
        getActualDataInCart() {
            this.productsQty = 0
            this.productsAmount = 0

            if(this.productsInCart) {
                this.productsInCart.forEach(item => {
                    this.productsQty += item.quantity
                    this.productsAmount += item.price * item.quantity
                })
            }
        },
        getProductsInCart() {
            this.productsInCart = JSON.parse(localStorage.getItem('cart'))
            this.getActualDataInCart()
        },
        updateQtyProduct(product, action, event = null) {
            const productIndex = this.productsInCart.indexOf(product)
            const currentQty = this.productsInCart[productIndex].quantity

            if (action === 'increase') {
                currentQty <= 99 ? this.productsInCart[productIndex].quantity += 1 : ''
            }

            if (action === 'decrease') {
                currentQty > 1 ? this.productsInCart[productIndex].quantity -= 1 : ''
            }

            if (action === 'input') {
                const eventValue = parseInt(event.target.value);

                if (eventValue <= 99 && eventValue >= 1) {
                    this.productsInCart[productIndex].quantity = eventValue
                } else {
                    this.productsInCart[productIndex].quantity = null;
                    this.productsInCart[productIndex].quantity = currentQty;
                }
            }
            localStorage.setItem('cart', JSON.stringify(this.productsInCart))
            this.getActualDataInCart()
            this.$store.commit('counterValue', { counter: this.productsQty })
        },
        removeProductFromCart(product) {
            const indexToRemove = this.productsInCart.indexOf(product)

            this.productsInCart.splice(indexToRemove, 1)

            localStorage.setItem('cart', JSON.stringify(this.productsInCart))
            this.getActualDataInCart()
            this.$store.commit('counterValue', { counter: this.productsQty })
        },
    }
}
</script>

<template>
    <div class="main__content" :class="{disable:productsInCart.length === 0}">
        <div class="main__cart cart">
            <div class="cart__container _container">
                <div class="cart__header-block header-block">
                    <h2 class="header-block__title">Содержание корзины</h2>
                </div>
                <div class="cart__body">
                    <table class="cart__table table">
                        <thead class="table__header">
                        <tr class="table__row">
                            <td class="table__column">Наименование</td>
                            <td class="table__column">Размер</td>
                            <td class="table__column">Цена</td>
                            <td class="table__column">Количество</td>
                            <td class="table__column">Сумма</td>
                            <td class="table__column"></td>
                        </tr>
                        </thead>
                        <tbody class="table__body">
                            <template v-for="product in productsInCart">
                                <tr class="table__row">
                                    <td class="table__column column">
                                        <router-link :to="{name: 'product', params: {id: product.id}}" class="column__link">
                                            <div class="column__wrapper">
                                                <div class="column__image _ibg">
                                                    <img :src="product.image" :alt="product.title">
                                                </div>
                                                <h3 class="column__product">{{ product.title }}</h3>
                                            </div>
                                        </router-link>
                                    </td>
                                    <td class="table__column column">
                                        <span class="column__size">{{ product.size }}</span>
                                    </td>
                                    <td class="table__column column">
                                        <span class="column__price">{{ product.price }} р.</span>
                                    </td>
                                    <td class="table__column column">
                                        <div class="column__quantity quantity">
                                            <button class="quantity__button decrease-button _button-svg" type="button" @click.prevent="updateQtyProduct(product, 'decrease')">
                                                <svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                                                     xmlns="http://www.w3.org/2000/svg">
                                                    <path d="M5 12H19" stroke="black" stroke-width="2"
                                                          stroke-linecap="round" stroke-linejoin="round" />
                                                </svg>
                                            </button>
                                            <input class="quantity__value" :value="product.quantity" type="number" @blur="updateQtyProduct(product, 'input', $event)">
                                            <button class="quantity__button increase-button _button-svg" type="button" @click.prevent="updateQtyProduct(product, 'increase')">
                                                <svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                                                     xmlns="http://www.w3.org/2000/svg">
                                                    <path d="M5 12H19" stroke="black" stroke-width="2"
                                                          stroke-linecap="round" stroke-linejoin="round" />
                                                    <path d="M12 5V19" stroke="black" stroke-width="2"
                                                          stroke-linecap="round" stroke-linejoin="round" />
                                                </svg>
                                            </button>
                                        </div>
                                    </td>
                                    <td class="table__column column">
                                        <span class="column__subtotal">{{ product.price * product.quantity }} р.</span>
                                    </td>
                                    <td class="table__column column">
                                        <button @click.prevent="removeProductFromCart" class="column__remove _button-svg" type="button">
                                            <svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                                                 xmlns="http://www.w3.org/2000/svg">
                                                <path d="M18 6L6 18" stroke="#3d3d3d" stroke-width="2"
                                                      stroke-linecap="round" stroke-linejoin="round" />
                                                <path d="M6 6L18 18" stroke="#3d3d3d" stroke-width="2"
                                                      stroke-linecap="round" stroke-linejoin="round" />
                                            </svg>
                                        </button>
                                    </td>
                                </tr>
                            </template>
                        </tbody>
                    </table>
                    <div class="cart__subcart subcart">
                        <div class="subcart__promo-block promo-block">
                            <input class="promo-block__input" type="text" name="promo-code" placeholder="Промокод">
                            <button class="promo-block__button _button" type="submit">Подтвердить</button>
                        </div>
                        <div class="subcart__amount-block-subcart">
                            <div class="amount-block-subcart__total">
                                <span class="amount-block-subcart__text">Итого:&nbsp;</span>
                                <span class="amount-block-subcart__amount">{{ productsAmount }} р.</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="main__make-order make-order">
            <div class="make-order__container _container">
                <div class="make-order__header-block header-block">
                    <h2 class="header-block__title">Оформление заказа</h2>
                </div>
                <form class="make-order__body">
                    <h3 class="make-order__subtitle">Информация</h3>
                    <div class="make-order__row">
                        <table class="make-order__table table-order">
                            <tbody class="table-order__body">
                            <tr class="table-order__row">
                                <td class="table-order__column-order column-order">
                                    <span class="column-order__title">Фамилия*</span>
                                </td>
                                <td class="table-order__column-order column-order">
                                    <input class="column-order__input" required type="text" name="last-name">
                                </td>
                            </tr>
                            <tr class="table-order__row">
                                <td class="table-order__column-order column-order">
                                    <span class="column-order__title">Имя*</span>
                                </td>
                                <td class="table-order__column-order column-order">
                                    <input class="column-order__input" required type="text" name="first-name">
                                </td>
                            </tr>
                            <tr class="table-order__row">
                                <td class="table-order__column-order column-order">
                                    <span class="column-order__title">Отчество*</span>
                                </td>
                                <td class="table-order__column-order column-order">
                                    <input class="column-order__input" required type="text" name="second-name">
                                </td>
                            </tr>
                            <tr class="table-order__row">
                                <td class="table-order__column-order column-order">
                                    <span class="column-order__title">Телефон*</span>
                                </td>
                                <td class="table-order__column-order column-order">
                                    <input class="column-order__input" required type="tel" name="telephone-no">
                                </td>
                            </tr>
                            <tr class="table-order__row">
                                <td class="table-order__column-order column-order">
                                    <span class="column-order__title">Email*</span>
                                </td>
                                <td class="table-order__column-order column-order">
                                    <input class="column-order__input" required type="email" name="email">
                                </td>
                            </tr>
                            </tbody>
                        </table>
                        <table class="make-order__table table-order">
                            <tbody class="table-order__body">
                            <tr class="table-order__row">
                                <td class="table-order__column-order column-order">
                                    <span class="column-order__title">Город*</span>
                                </td>
                                <td class="table-order__column-order column-order">
                                    <input class="column-order__input" required type="text" name="city">
                                </td>
                            </tr>
                            <tr class="table-order__row">
                                <td class="table-order__column-order column-order">
                                    <span class="column-order__title">Улица*</span>
                                </td>
                                <td class="table-order__column-order column-order">
                                    <input class="column-order__input" required type="text" name="street">
                                </td>
                            </tr>
                            <tr class="table-order__row">
                                <td class="table-order__column-order column-order">
                                    <span class="column-order__title">Дом*</span>
                                </td>
                                <td class="table-order__column-order column-order">
                                    <input class="column-order__input" required type="tel" name="house-no">
                                </td>
                            </tr>
                            <tr class="table-order__row">
                                <td class="table-order__column-order column-order">
                                    <span class="column-order__title">Индекс*</span>
                                </td>
                                <td class="table-order__column-order column-order">
                                    <input class="column-order__input" required type="email" name="index">
                                </td>
                            </tr>
                            <tr class="table-order__row">
                                <td class="table-order__column-order column-order">
                                    <span class="column-order__title">Комментарий</span>
                                </td>
                                <td class="table-order__column-order column-order">
                                    <input class="column-order__input" type="text" name="comment">
                                </td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                    <h3 class="make-order__subtitle">Способ доставки</h3>
                    <div class="make-order__row">
                        <div class="make-order__check-block check-block">
                            <div class="check-block__body">
                                <div class="check-block__content">
                                    <input @click="deliveryPrice = 250" class="check-block__radio" type="radio" id="delivery1" name="delivery_type">
                                    <label for="delivery1" class="check-block__title">Почта России 250 р.</label>
                                </div>
                                <div class="check-block__content">
                                    <input @click="deliveryPrice = 350" class="check-block__radio" type="radio" id="delivery2" name="delivery_type">
                                    <label for="delivery2" class="check-block__title">СДЭК 350 р.</label>
                                </div>
                            </div>
                        </div>
                    </div>
                    <h3 class="make-order__subtitle">Способ оплаты</h3>
                    <div class="make-order__column">
                        <div class="make-order__check-block check-block">
                            <div class="check-block__body">
                                <div class="check-block__content">
                                    <input class="check-block__radio" type="radio" id="payment1" name="payment_type">
                                    <label for="payment1" class="check-block__title">Дебетовая карта (Visa, Mastercard,
                                        Мир)</label>
                                </div>
                            </div>
                        </div>
                        <div class="make-order__total-block total-block">
                            <div class="total-block__body">
                                <div class="total-block__content">
                                    <div class="total-block__amount">
                                        <span class="total-block__text">Товары:&nbsp;</span>
                                        <span class="total-block__cost">{{ productsAmount }} р.</span>
                                    </div>
                                    <div class="total-block__amount">
                                        <span class="total-block__text">Доставка:&nbsp;</span>
                                        <span class="total-block__cost">{{ deliveryPrice }} р.</span>
                                    </div>
                                    <div class="total-block__amount">
                                        <span class="total-block__text">Скидка:&nbsp;</span>
                                        <span class="total-block__cost">{{ discount }} р.</span>
                                    </div>
                                    <div class="total-block__total">
                                        <span class="total-block__text">Итоговая сумма:&nbsp;</span>
                                        <span class="total-block__cost">{{ productsAmount - deliveryPrice - discount }} р.</span>
                                    </div>
                                </div>
                                <button class="total-block__button _button" type="submit">Перейти к оплате</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <div class="main__message message" :class="{active:productsInCart.length === 0}">
        <div class="message__content cart-message__content">
            <div class="message__column">
                <div class="message__text">Корзина пуста</div>
            </div>
        </div>
    </div>
</template>

<style>

</style>
