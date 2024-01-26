<script>
import axios from "axios";

export default {
    name:"Index",
    mounted() {
        $(document).trigger('change')
        this.getProducts()
    },

    data() {
        return {
            products: [],
            hover: false,
        }
    },

    methods: {
        getProducts() {
            axios
                .get('http://127.0.0.1:8888/api/admin/products')
                .then(res => {
                    console.log(res)
                    this.products = res.data.data
                })
                .catch(error => {
                    console.log(error)
                })
        },
    }
}
</script>

<template>
    <main class="main">
        <div class="main__products products">
            <div class="products__container _container">
                <div class="products__body">
                    <div v-for="product in products" class="products__column">
                        <div class="products__item-product item-product">
                            <router-link :to="{name: 'product', params: {id: product.id}}" class="item-product__link">
                                <div class="item-product__item-image _ibg">
                                    <img :src="product.image_url" @mouseover="hover=true" @mouseleave="hover=false" :alt="product.title">
                                </div>
                                <div class="item-product__content">
                                    <h3 class="item-product__title">{{ product.title }}</h3>
                                    <span class="item-product__price">{{ product.price }} р.</span>
                                </div>
                            </router-link>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="main__pagination pagination">
            <div class="pagination__container _container">
                <ul class="pagination__body">
                    <li class="pagination__button">
                        <a href="#" class="pagination__link _button-svg">
                            <svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                                 xmlns="http://www.w3.org/2000/svg">
                                <path d="M15 18L9 12L15 6" stroke="#3d3d3d" stroke-width="2" stroke-linecap="round"
                                      stroke-linejoin="round" />
                            </svg>
                        </a>
                    </li>
                    <li class="pagination__button">
                        <a href="#" class="pagination__link _button-svg">1</a>
                    </li>
                    <li class="pagination__button">
                        <a href="#" class="pagination__link _button-svg">2</a>
                    </li>
                    <li class="pagination__button">
                        <a href="#" class="pagination__link _button-svg">3</a>
                    </li>
                    <li class="pagination__button">
                        <a href="#" class="pagination__link _button-svg">4</a>
                    </li>
                    <li class="pagination__button">
                        <a href="#" class="pagination__link _button-svg">
                            <svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                                 xmlns="http://www.w3.org/2000/svg">
                                <path d="M9 18L15 12L9 6" stroke="#3d3d3d" stroke-width="2" stroke-linecap="round"
                                      stroke-linejoin="round" />
                            </svg>
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </main>
</template>

<style>

</style>
