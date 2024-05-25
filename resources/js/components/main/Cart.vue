<script>

import axios from "axios";

export default {
    name: 'Cart',
    mounted() {
        this.getProductsInCart()
    },

    data() {
        return {
            isPageLoaded: true,
            productsInCart: [],
            productsQty: 0,
            productsAmount: 0,
            productsAmountDiscount: 0,

            full_name: '',
            email: '',
            phone_number: '',
            city: '',
            street: '',
            building: '',
            flat: '',
            postal_code: '',
            comment: '',
            delivery_method: '',
            payment_method: '',

            deliveryPrice: 0,
            discount: 0,
        }
    },

    methods: {
        async createOrder() {
            this.isPageLoaded = false
            await axios
                .post('http://127.0.0.1:8888/api/orders', {
                    'products': this.productsInCart,

                    'full_name': this.full_name,
                    'email': this.email,
                    'phone_number': this.phone_number,
                    'city': this.city,
                    'street': this.street,
                    'building': this.building,
                    'flat': this.flat,
                    'postal_code': this.postal_code,
                    'comment': this.comment,

                    'delivery_method': this.delivery_method,
                    'payment_method': this.payment_method,

                    'amount_of_products': this.productsAmount,
                    'amount_of_discount': this.productsAmountDiscount,
                    'amount_of_delivery': this.deliveryPrice,
                    'total_price': (this.productsAmountDiscount + this.deliveryPrice),
                })
            localStorage.removeItem('cart')
            this.isPageLoaded = true
        },
        getActualDataInCart() {
            this.productsQty = 0
            this.productsAmount = 0
            this.productsAmountDiscount = 0

            if(this.productsInCart) {
                this.productsInCart.forEach(item => {
                    this.productsQty += item.quantity
                    this.productsAmount += item.price * item.quantity
                    this.productsAmountDiscount += Math.floor(item.price - (item.price * (item.discount / 100))) * item.quantity
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
            const sizeQty = this.productsInCart[productIndex].sizeQty

            if (action === 'increase') {
                currentQty <= 99 && currentQty < sizeQty ? this.productsInCart[productIndex].quantity += 1 : ''
            }

            if (action === 'decrease') {
                currentQty > 1 ? this.productsInCart[productIndex].quantity -= 1 : ''
            }

            if (action === 'input') {
                const eventValue = parseInt(event.target.value);

                if (eventValue <= 99 && currentQty < sizeQty && eventValue >= 1) {
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
    <div v-if="isPageLoaded">
        <div class="main__content" :class="{disabled:productsInCart.length === 0}">
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
                                            <div v-if="product.discount" class="column__price" :class="{disabled:product.discount}">{{ product.price }} р.</div>
                                            <div class="column__price">{{ Math.floor(product.price - (product.price * (product.discount / 100))) }} р.</div>
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
                                            <span v-if="product.discount" class="column__subtotal" :class="{disabled:product.discount}">{{ product.price * product.quantity }} р.</span>
                                            <span class="column__subtotal">{{ Math.floor(product.price - (product.price * (product.discount / 100))) * product.quantity }} р.</span>
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
                            <div class="subcart__amount-block-subcart">
                                <div class="amount-block-subcart__total">
                                    <span class="amount-block-subcart__text">Итого:&nbsp;</span>
                                    <span class="amount-block-subcart__amount" :class="{disabled:productsAmountDiscount !== productsAmount}">{{ productsAmount }} р.</span>
                                    <span v-if="productsAmountDiscount !== productsAmount" class="amount-block-subcart__amount">{{ productsAmountDiscount }} р.</span>
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
                                        <span class="column-order__title required-label">ФИО</span>
                                    </td>
                                    <td class="table-order__column-order column-order">
                                        <input class="column-order__input" v-model="full_name" required type="text" name="full-name">
                                    </td>
                                </tr>
                                <tr class="table-order__row">
                                    <td class="table-order__column-order column-order">
                                        <span class="column-order__title required-label">Email</span>
                                    </td>
                                    <td class="table-order__column-order column-order">
                                        <input class="column-order__input" v-model="email" required type="email" name="email">
                                    </td>
                                </tr>
                                <tr class="table-order__row">
                                    <td class="table-order__column-order column-order">
                                        <span class="column-order__title required-label">Телефон</span>
                                    </td>
                                    <td class="table-order__column-order column-order">
                                        <input class="column-order__input" v-model="phone_number" required type="tel" name="phone-number">
                                    </td>
                                </tr>
                                <tr class="table-order__row">
                                    <td class="table-order__column-order column-order">
                                        <span class="column-order__title required-label">Город</span>
                                    </td>
                                    <td class="table-order__column-order column-order">
                                        <input class="column-order__input" v-model="city" required type="text" name="city">
                                    </td>
                                </tr>
                                <tr class="table-order__row">
                                    <td class="table-order__column-order column-order">
                                        <span class="column-order__title required-label">Улица</span>
                                    </td>
                                    <td class="table-order__column-order column-order">
                                        <input class="column-order__input" v-model="street" required type="text" name="street">
                                    </td>
                                </tr>
                                <tr class="table-order__row">
                                    <td class="table-order__column-order column-order">
                                        <span class="column-order__title required-label">Дом</span>
                                    </td>
                                    <td class="table-order__column-order column-order">
                                        <input class="column-order__input" v-model="building" required type="text" name="building">
                                    </td>
                                </tr>
                                </tbody>
                            </table>
                            <table class="make-order__table table-order">
                                <tbody class="table-order__body">
                                <tr class="table-order__row">
                                    <td class="table-order__column-order column-order">
                                        <span class="column-order__title">Квартира/офис</span>
                                    </td>
                                    <td class="table-order__column-order column-order">
                                        <input class="column-order__input" v-model="flat" type="text" name="flat">
                                    </td>
                                </tr>
                                <tr class="table-order__row">
                                    <td class="table-order__column-order column-order">
                                        <span class="column-order__title building">Почтовый индекс</span>
                                    </td>
                                    <td class="table-order__column-order column-order">
                                        <input class="column-order__input" v-model="postal_code" type="text" name="postal_code">
                                    </td>
                                </tr>
                                <tr class="table-order__row">
                                    <td class="table-order__column-order column-order">
                                        <span class="column-order__title">Комментарий</span>
                                    </td>
                                    <td class="table-order__column-order column-order">
                                        <textarea class="column-order__input column-order__textarea" v-model="comment" name="comment"></textarea>
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
                                        <input @click="deliveryPrice = 250" value="Почта России" class="check-block__radio" v-model="delivery_method" type="radio" id="delivery1" name="delivery_type">
                                        <label for="delivery1" class="check-block__title">Почта России 250 р.</label>
                                    </div>
                                    <div class="check-block__content">
                                        <input @click="deliveryPrice = 350" value="EMS" class="check-block__radio" v-model="delivery_method" type="radio" id="delivery2" name="delivery_type">
                                        <label for="delivery2" class="check-block__title">EMS 350 р.</label>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <h3 class="make-order__subtitle">Способ оплаты</h3>
                        <div class="make-order__row">
                            <div class="make-order__check-block check-block">
                                <div class="check-block__body">
                                    <div class="check-block__content">
                                        <input class="check-block__radio" value="Дебетовая карта" v-model="payment_method" type="radio" id="payment1" name="payment_type">
                                        <label for="payment1" class="check-block__title">Дебетовая карта (Visa, Mastercard,
                                            Мир)</label>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="make-order__column">
                            <div class="make-order__total-block total-block">
                                <div class="total-block__body">
                                    <div class="total-block__content">
                                        <div class="total-block__amount">
                                            <span class="total-block__text">Товары:&nbsp;</span>
                                            <span class="total-block__cost">{{ productsAmount }} р.</span>
                                        </div>
                                        <div class="total-block__amount">
                                            <span class="total-block__text">Скидка:&nbsp;</span>
                                            <span class="total-block__cost">{{ productsAmount - productsAmountDiscount }} р.</span>
                                        </div>
                                        <div class="total-block__amount">
                                            <span class="total-block__text">Доставка:&nbsp;</span>
                                            <span class="total-block__cost">{{ deliveryPrice }} р.</span>
                                        </div>
                                        <div class="total-block__total">
                                            <span class="total-block__text">Итоговая сумма:&nbsp;</span>
                                            <span class="total-block__cost">{{ productsAmountDiscount + deliveryPrice }} р.</span>
                                        </div>
                                    </div>
                                    <button @click.prevent="createOrder()" class="total-block__button _button" type="submit">Перейти к оплате</button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <div v-else class="main__preloader preloader">
        <div class="preloader__spinner"></div>
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
    .required-label:after{
        content: '*';
        color: red;
    }
</style>
