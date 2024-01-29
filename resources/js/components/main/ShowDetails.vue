<script>
import axios from "axios";

export default {
    name:"ShowDetails",
    mounted() {
        $(document).trigger('change')
        this.getProduct()
    },

    data() {
        return {
            product: 0,
        }
    },

    methods: {
        getProduct() {
            axios
                .get(`http://127.0.0.1:8888/api/admin/products/${this.$route.params.id}`)
                .then(res => {
                    console.log(res)
                    this.product = res.data.data
                })
                .catch(error => {
                    console.log(error)
                })
        }
    }
}
</script>

<template>
    <main class="main">
        <div class="main__product-info product-info">
            <div class="product-info__container _container">
                <div class="product-info__images images">
                    <div class="images__body">
                        <div class="images__gallery gallery">
                            <div class="gallery__image active _ibg">
                                <img :src="product.image_url" :alt="product.title">
                            </div>
                            <div v-for="image in product.product_images" class="gallery__image _ibg">
                                <img :src="image.url" :alt="product.title">
                            </div>
                        </div>
                        <div class="images__carousel carousel">
                            <button class="carousel__button _arrow-prev" type="button">
                                <svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                                     xmlns="http://www.w3.org/2000/svg">
                                    <path d="M15 18L9 12L15 6" stroke="black" stroke-width="2"
                                          stroke-linecap="round" stroke-linejoin="round" />
                                </svg>
                            </button>
                            <div class="carousel__main-images main-images">
                                <div class="main-images__image active _ibg">
                                    <img :src="product.image_url" :alt="product.title">
                                </div>
                                <div v-for="image in product.product_images" class="main-images__image _ibg">
                                    <img :src="image.url" :alt="product.title">
                                </div>
                            </div>
                            <button class="carousel__button _arrow-next" type="button">
                                <svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                                     xmlns="http://www.w3.org/2000/svg">
                                    <path d="M9 18L15 12L9 6" stroke="black" stroke-width="2" stroke-linecap="round"
                                          stroke-linejoin="round" />
                                </svg>
                            </button>
                        </div>
                    </div>
                </div>
                <div class="main__details details">
                    <div class="details__body">
                        <div class="details__header-block header-block">
                            <h2 class="header-block__title">{{ product.title }}</h2>
                            <div class="header-block__subtitle subtitle">
                                <span class="subtitle__article">Артикул:</span>
                                <span class="subtitle__article-num">{{ product.article }}</span>
                            </div>
                        </div>
                        <div class="details__content">
                            <span class="details__price">{{ product.price}} р.</span>
                            <div class="details__size-block size-block">
                                <span class="size-block__title">Размер:</span>
                                <ul class="size-block__list">
                                    <li v-for="size in product.sizes" class="size-block__button-wrapper">
                                        <button class="size-block__button" type="button">{{ size.title }}</button>
                                    </li>
                                </ul>
                            </div>
                            <button class="details__cart-button _button" type="submit"></button>
                        </div>
                        <div class="details__description">
                            <p>{{ product.description }}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
</template>

<style>

</style>
