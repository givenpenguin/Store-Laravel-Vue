<script>
import axios from "axios"

export default {
    name: 'ShowDetails',
    async mounted() {
        await this.getProduct()
        this.setUrlImages()
        this.setDefaultSize()
        this.getProductsInCart()
    },

    data() {
        return {
            product: null,
            isLoaded: false,
            idSelectedSize: null,
            titleSelectedSize: null,

            images: {
                url: [],
                current_image: [],
            },
            productsInCart: [],
            productsQty: 0,
        }
    },

    methods: {
        async getProduct() {
            const {data} = await axios
                .get(`http://127.0.0.1:8888/api/admin/products/${this.$route.params.id}`)
            this.product = data.data
            this.isLoaded = true;
        },
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
        setUrlImages() {
            this.images.url.push(this.product.image_url)
            this.product.product_images.forEach((e) => {
                this.images.url.push(e.url)
            })
            this.images.current_image = 0
        },
        addToCart() {
            this.productsInCart = JSON.parse(localStorage.getItem('cart'))
            let newProduct = [
                {
                    'id': this.product.id,
                    'image': this.product.image_url,
                    'title': this.product.title,
                    'price': this.product.price,
                    'discount': this.product.discount,
                    'size': this.titleSelectedSize,
                    'quantity': 1
                }
            ]

            if (!this.productsInCart) {
                localStorage.setItem('cart', JSON.stringify(newProduct))
            } else {
                this.productsInCart.forEach(item => {
                    if (item.id === this.product.id && item.size === this.titleSelectedSize) {
                        item.quantity += 1
                        newProduct = null
                    }
                })

                Array.prototype.push.apply(this.productsInCart, newProduct)
                localStorage.setItem('cart', JSON.stringify(this.productsInCart))

                this.$store.commit('toggleDrawer', { isDrawerOpen: true })

                this.getProductsInCart()
                this.$store.commit('counterValue', { counter: this.productsQty })
            }
        },
        setDefaultSize() {
            this.idSelectedSize = this.product.sizes[0].id
            this.titleSelectedSize = this.product.sizes[0].title
        },
        setCurrentImage(image) {
            this.images.current_image = this.images.url.indexOf(image)
        },
        getNextImage() {
            this.images.current_image < this.images.url.length - 1 ? this.images.current_image += 1 : this.images.current_image = 0
        },
        getPreviousImage() {
            this.images.current_image > 0 ? this.images.current_image -= 1 : this.images.current_image = this.images.url.length - 1
        },
    }
}
</script>

<template>
    <div v-if="isLoaded">
            <div class="main__product-info product-info">
                <div class="product-info__container _container">
                    <div class="product-info__images images">
                        <div class="images__body">
                            <div class="images__gallery gallery">
                                <template v-for="image in images.url">
                                    <div class="gallery__image _ibg" :class="{active:image === images.url[images.current_image]}"
                                         @click.prevent="setCurrentImage(image)">
                                        <img :src="image" :alt="product.title">
                                    </div>
                                </template>
                            </div>
                            <div class="images__carousel carousel">
                                <button class="carousel__button _arrow-prev" type="button" @click.prevent="getPreviousImage">
                                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                                         xmlns="http://www.w3.org/2000/svg">
                                        <path d="M15 18L9 12L15 6" stroke="black" stroke-width="2"
                                              stroke-linecap="round" stroke-linejoin="round" />
                                    </svg>
                                </button>
                                <div class="carousel__main-images main-images">
                                    <template v-for="image in images.url">
                                        <div class="main-images__image _ibg" :class="{active:image === images.url[images.current_image]}">
                                            <img :src="image" :alt="product.title">
                                        </div>
                                    </template>
                                </div>
                                <button class="carousel__button _arrow-next" type="button" @click.prevent="getNextImage">
                                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                                         xmlns="http://www.w3.org/2000/svg">
                                        <path d="M9 18L15 12L9 6" stroke="black" stroke-width="2" stroke-linecap="round"
                                              stroke-linejoin="round" />
                                    </svg>
                                </button>
                            </div>
                        </div>
                    </div>
                    <div class="product-info__details details">
                        <div class="details__body">
                            <div class="details__header-block header-block">
                                <h2 class="header-block__title">{{ product.title }}</h2>
                                <div class="header-block__subtitle subtitle">
                                    <span class="subtitle__article">Артикул:</span>
                                    <span class="subtitle__article-num">{{ product.article }}</span>
                                </div>
                            </div>
                            <div class="details__content">
                                <div class="details__price-block">
                                    <span class="details__price" :class="{disabled:product.discount}">{{ product.price}} р.</span>
                                    <span v-if="product.discount" class="details__price">{{ Math.floor(product.price - (product.price * (product.discount / 100))) }} р.</span>
                                </div>
                                <div class="details__size-block size-block">
                                    <span class="size-block__title">Размер:</span>
                                    <ul class="size-block__list">
                                        <li v-for="size in product.sizes" class="size-block__button-wrapper">
                                            <button :class="{active:size.id === idSelectedSize}" @click="idSelectedSize=size.id; titleSelectedSize=size.title " class="size-block__button" type="button">{{ size.title }}</button>
                                        </li>
                                    </ul>
                                </div>
                                <button class="details__cart-button _button" :class="{'out-of-stock':product.quantity < 1}" type="submit" @click="addToCart"></button>
                            </div>
                            <div class="details__description">
                                <p>{{ product.description }}</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
    </div>
    <div v-else class="main__preloader preloader">
        <div class="preloader__spinner"></div>
    </div>
</template>

<style>
.details__description {
    white-space: pre-wrap;
}
</style>
