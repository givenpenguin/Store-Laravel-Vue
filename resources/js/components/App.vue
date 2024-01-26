<script>

export default {
    name: 'App',
    mounted() {
        $(document).trigger('change')
    },
}
</script>

<template>
    <div class="wrapper">
        <header class="header">
            <div class="header__main-menu main-menu">
                <div class="main-menu__container _container">
                    <router-link :to="{name: 'home'}" class="main-menu__logo">évanouir</router-link>
                    <nav class="main-menu__menu menu">
                        <ul class="menu__list">
                            <li class="menu__item">
                                <div class="menu__link link">
                                    <div class="link__button cart-button">
                                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                                             xmlns="http://www.w3.org/2000/svg">
                                            <path
                                                d="M8 22C8.55228 22 9 21.5523 9 21C9 20.4477 8.55228 20 8 20C7.44772 20 7 20.4477 7 21C7 21.5523 7.44772 22 8 22Z"
                                                stroke="black" stroke-width="2" stroke-linecap="round"
                                                stroke-linejoin="round" />
                                            <path
                                                d="M19 22C19.5523 22 20 21.5523 20 21C20 20.4477 19.5523 20 19 20C18.4477 20 18 20.4477 18 21C18 21.5523 18.4477 22 19 22Z"
                                                stroke="black" stroke-width="2" stroke-linecap="round"
                                                stroke-linejoin="round" />
                                            <path
                                                d="M2.05005 2.04999H4.05005L6.71005 14.47C6.80763 14.9248 7.06072 15.3315 7.42576 15.6198C7.7908 15.9082 8.24495 16.0603 8.71005 16.05H18.49C18.9452 16.0493 19.3865 15.8933 19.7411 15.6078C20.0956 15.3224 20.3422 14.9245 20.4401 14.48L22.09 7.04999H5.12005"
                                                stroke="black" stroke-width="2" stroke-linecap="round"
                                                stroke-linejoin="round" />
                                        </svg>
                                        <span class="cart-button__counter">0</span>
                                    </div>
                                </div>
                            </li>
                            <li class="menu__item">
                                <div class="menu__link link">
                                    <div class="link__button profile-button">
                                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                                             xmlns="http://www.w3.org/2000/svg">
                                            <path
                                                d="M18 20C18 18.4087 17.3679 16.8826 16.2426 15.7574C15.1174 14.6321 13.5913 14 12 14C10.4087 14 8.88258 14.6321 7.75736 15.7574C6.63214 16.8826 6 18.4087 6 20"
                                                stroke="black" stroke-width="2" stroke-linecap="round"
                                                stroke-linejoin="round" />
                                            <path
                                                d="M12 14C14.2091 14 16 12.2091 16 10C16 7.79086 14.2091 6 12 6C9.79086 6 8 7.79086 8 10C8 12.2091 9.79086 14 12 14Z"
                                                stroke="black" stroke-width="2" stroke-linecap="round"
                                                stroke-linejoin="round" />
                                            <path
                                                d="M12 22C17.5228 22 22 17.5228 22 12C22 6.47715 17.5228 2 12 2C6.47715 2 2 6.47715 2 12C2 17.5228 6.47715 22 12 22Z"
                                                stroke="black" stroke-width="2" stroke-linecap="round"
                                                stroke-linejoin="round" />
                                        </svg>
                                    </div>
                                </div>
                            </li>
                        </ul>
                    </nav>
                </div>
            </div>
            <div class="header__drawer-closer"></div>
            <div class="header__drawer drawer">
                <div class="drawer__container _container">
                    <div class="drawer__body">
                        <div class="drawer__header-block header-block">
                            <h2 class="header-block__title">Корзина</h2>
                            <div class="header-block__cancel _button-svg">
                                <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M18 6L6 18" stroke="#3d3d3d" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                    <path d="M6 6L18 18" stroke="#3d3d3d" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                </svg>
                            </div>
                        </div>
                        <div class="drawer__items">
                            <div class="drawer__column">
                                <div class="drawer__item-cart item-cart">
                                    <a href="show-details.html" class="item-cart__link">
                                        <div class="item-cart__wrapper">
                                            <div class="item-cart__image _ibg">
                                                <img src="/assets/images/photos/bomber1.png" alt="bomber">
                                            </div>
                                            <div class="item-cart__content">
                                                <h3 class="item-cart__title">Bomber</h3>
                                                <p class="item-cart__info">
                                                    <span class="item-cart__count">2 X</span>
                                                    <span class="item-cart__price">6200 р.</span>
                                                </p>
                                            </div>
                                        </div>
                                    </a>
                                    <div class="item-cart__remove _button-svg">
                                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <path d="M18 6L6 18" stroke="#3d3d3d" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                            <path d="M6 6L18 18" stroke="#3d3d3d" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                        </svg>
                                    </div>
                                </div>
                            </div>
                            <div class="drawer__column">
                                <div class="drawer__item-cart item-cart">
                                    <a href="show-details.html" class="item-cart__link">
                                        <div class="item-cart__wrapper">
                                            <div class="item-cart__image _ibg">
                                                <img src="/assets/images/photos/bomber1.png" alt="bomber">
                                            </div>
                                            <div class="item-cart__content">
                                                <h3 class="item-cart__title">Bomber</h3>
                                                <p class="item-cart__info">
                                                    <span class="item-cart__count">2 X</span>
                                                    <span class="item-cart__price">6200 р.</span>
                                                </p>
                                            </div>
                                        </div>
                                    </a>
                                    <div class="item-cart__remove _button-svg">
                                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <path d="M18 6L6 18" stroke="#3d3d3d" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                            <path d="M6 6L18 18" stroke="#3d3d3d" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                        </svg>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="drawer__amount-block amount-block-drawer">
                            <div class="amount-block-drawer__total">
                                <span class="amount-block-drawer__text">Итого:</span><span class="amount-block-drawer__amount">12400 р.</span>
                            </div>
                            <a href="cart.html" class="amount-block-drawer__button _button">Оформить заказ</a>
                        </div>
                    </div>
                </div>
            </div>
        </header>

       <router-view></router-view>

        <footer class="footer">
            <div class="footer__bottom">
                <div class="footer__container _container">
                    <div class="footer__body">
                        <div class="footer__copyright">
                            <span>ÉVANOUIR © {{ new Date().getFullYear() }}</span>
                        </div>
                    </div>
                </div>
            </div>
        </footer>
    </div>
</template>

<style>
    span {
        margin: 2px;
    }
</style>
