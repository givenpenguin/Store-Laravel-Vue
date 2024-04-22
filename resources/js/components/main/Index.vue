<script>
import axios from "axios";
import {updateSliderPrice, updateSliderRange} from "../../../../public/assets/js/price-slider.js";
import {activeMenu, toggleMenu} from "../../../../public/assets/js/menu.js";

export default {
    name: 'Index',
    mounted() {
        $(document).trigger('change')
        this.getData()
    },
    data() {
        return {
            hover: false,
            isLoaded: false,
            isSidebarOn: false,
            selectedFilters: [],

            products: [],
            filterList: [],
            pricesList: [],

            title: "",
            categories: [],
            sizes: [],
            prices: [],
            sortMethod: "default",

            pagination: [],
            originalProducts: [],
        }
    },
    methods: {
        toggleMenu,
        activeMenu,
        updateSliderRange,
        updateSliderPrice,

        async getData() {
            this.isLoaded = false
            await this.getProducts()
            await this.getFilterList()
            this.isLoaded = true
        },
        async getProducts(page = 1) {
            const {data} = await axios
                .post('http://127.0.0.1:8888/api/admin/products', {
                    'title': this.title,
                    'categories': this.categories,
                    'sizes': this.sizes,
                    'prices': this.prices,
                    'page': page,
                })
            this.products = data.data
            this.pagination = data.meta
            this.originalProducts = [...this.products]
        },
        async getFilterList() {
            const {data} = await axios
                .get('http://127.0.0.1:8888/api/admin/products/filters');
            this.filterList = data
            this.pricesList = data.price
            this.prices = [data.price.min, data.price.max]
        },
        sortProducts() {
            switch (this.sortMethod) {
                case 'price_up':
                    this.products.sort((a, b) => b.price - a.price)
                    break;
                case 'price_down':
                    this.products.sort((a, b) => a.price - b.price)
                    break;
                default:
                    this.products = [...this.originalProducts]
                    break;
            }
        }
    }
}
</script>

<template>
    <div v-if="isLoaded">
        <div class="main__content content">
            <div class="content__container _container">
                <div class="content__body">
                    <div class="content__sidebar sidebar">
                        <div class="sidebar__arrows">
                            <div class="sidebar__arrow arrow-right" @click="isSidebarOn = true">
                                <svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                                     xmlns="http://www.w3.org/2000/svg">
                                    <path d="M9 18L15 12L9 6" stroke="#3d3d3d" stroke-width="2" stroke-linecap="round"
                                          stroke-linejoin="round" />
                                </svg>
                            </div>
                        </div>
                        <div class="sidebar__content" :class="{active:isSidebarOn}">
                            <div class="sidebar__container">
                                <form class="sidebar__body">
                                    <div class="sidebar__header-block header-block">
                                        <h2 class="header-block__title">Фильтрация</h2>
                                        <div class="header-block__cancel _button-svg" @click="isSidebarOn = false">
                                            <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                <path d="M18 6L6 18" stroke="#3d3d3d" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                                <path d="M6 6L18 18" stroke="#3d3d3d" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                            </svg>
                                        </div>
                                    </div>
                                    <div class="sidebar__columns">
                                        <div class="sidebar__column">
                                            <div class="sidebar__filter filter">
                                                <div class="filter__header-block" :class="{active:activeMenu('categories')}" @click="toggleMenu('categories')">
                                                    <h3 class="filter__title">Категории</h3>
                                                    <div class="filter__closer">
                                                        <svg width="14" height="8" viewBox="0 0 14 8" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                            <path d="M1 1L7 7L13 1" stroke="black" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                                        </svg>
                                                    </div>
                                                </div>
                                                <div class="filter__content" :class="{active:activeMenu('categories')}">
                                                    <label v-for="category in filterList.categories" class="filter__option option">
                                                        <input :value="category.id" v-model="categories" class="option__check" type="checkbox" name="filter_option">
                                                        <span class="option__title">{{ category.title }}</span>
                                                    </label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="sidebar__column">
                                            <div class="sidebar__filter filter">
                                                <div class="filter__header-block" :class="{active:activeMenu('sizes')}" @click="toggleMenu('sizes')">
                                                    <h3 class="filter__title">Размеры</h3>
                                                    <div class="filter__closer">
                                                        <svg width="14" height="8" viewBox="0 0 14 8" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                            <path d="M1 1L7 7L13 1" stroke="black" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                                        </svg>
                                                    </div>
                                                </div>
                                                <div class="filter__content" :class="{active:activeMenu('sizes')}">
                                                    <label v-for="size in filterList.sizes" class="filter__option option">
                                                        <input :value="size.id" v-model="sizes" class="option__check" type="checkbox" name="filter_option">
                                                        <span class="option__title">{{ size.title }}</span>
                                                    </label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="sidebar__column">
                                            <div class="sidebar__filter filter">
                                                <div class="filter__header-block" :class="{active:activeMenu('prices')}" @click="toggleMenu('prices')">
                                                    <h3 class="filter__title">Цена</h3>
                                                    <div class="filter__closer">
                                                        <svg width="14" height="8" viewBox="0 0 14 8" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                            <path d="M1 1L7 7L13 1" stroke="black" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                                        </svg>
                                                    </div>
                                                </div>
                                                <div class="filter__content slider" :class="{active:activeMenu('prices')}">
                                                    <div class="slider__range">
                                                        <span class="slider__selected" ref="range"></span>
                                                    </div>
                                                    <div class="slider__input">
                                                        <input class="slider__dot" type="range" ref="rangeMin" @input="updateSliderRange" :min="pricesList.min" :max="pricesList.max" v-model="prices[0]" step="100">
                                                        <input class="slider__dot" type="range" ref="rangeMax" @input="updateSliderRange" :min="pricesList.min" :max="pricesList.max" v-model="prices[1]" step="100">
                                                    </div>
                                                    <div class="slider__price">
                                                        <input class="slider__value slider-min" type="number" ref="priceMin" name="min" @input="updateSliderPrice" :placeholder="pricesList.min">
                                                        <span class="slider__separator">&ndash;</span>
                                                        <input class="slider__value slider-max" type="number" ref="priceMax" name="max" @input="updateSliderPrice" :placeholder="pricesList.max">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="sidebar__button-block">
                                        <button @click.prevent="getProducts()" class="sidebar__button _button" type="submit">Применить</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    <div class="content__products products">
                        <div class="products__container">
                            <div class="products__header">
                                <div class="products__search search">
                                    <input class="search__field" type="text" name="search" placeholder="Поиск" v-model="title">
                                    <span @click="getProducts()" class="search__button">
                                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <path d="M11 19C15.4183 19 19 15.4183 19 11C19 6.58172 15.4183 3 11 3C6.58172 3 3 6.58172 3 11C3 15.4183 6.58172 19 11 19Z" stroke="black" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                            <path d="M21 21L16.7 16.7" stroke="black" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                        </svg>
                                    </span>
                                </div>
                                <div class="products__sort sort">
                                    <select @change="sortProducts" v-model="sortMethod" class="sort__sort-select" name="sort">
                                        <option value="default">Порядок: по умолчанию</option>
                                        <option value="price_up">Цена: по возрастанию</option>
                                        <option value="price_down">Цена: по убыванию</option>
                                    </select>
                                </div>
                            </div>
                            <div class="products__body" v-if="products.length !== 0">
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
                            <div class="products__pagination pagination" v-if="pagination.last_page > 1">
                                <div class="pagination__container _container">
                                    <ul class="pagination__body">
                                        <li class="pagination__button">
                                            <a @click.prevent="getProducts(pagination.current_page - 1)" v-if="pagination.current_page !== 1" href="#" class="pagination__link _button-svg">
                                                <svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                                                     xmlns="http://www.w3.org/2000/svg">
                                                    <path d="M15 18L9 12L15 6" stroke="#3d3d3d" stroke-width="2" stroke-linecap="round"
                                                          stroke-linejoin="round" />
                                                </svg>
                                            </a>
                                        </li>
                                        <template v-for="link in pagination.links">
                                            <template v-if="Number(link.label) &&
                                                (pagination.current_page - link.label < 2 && link.label - pagination.current_page < 2) ||
                                                Number(link.label) === 1 || Number(link.label) === pagination.last_page">
                                                <li class="pagination__button">
                                                    <a @click.prevent="getProducts(link.label)" :class={active:link.active} href="#" class="pagination__link _button-svg">{{ link.label }}</a>
                                                </li>
                                            </template>
                                        </template>
                                        <li class="pagination__button">
                                            <a @click.prevent="getProducts(pagination.current_page + 1)" v-if="pagination.current_page !== pagination.last_page" href="#" class="pagination__link _button-svg">
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
                            <div class="products__products-message products-message" :class="{active:products.length === 0}">
                                <div class="products-message__content">
                                    <div class="products-message__column">
                                        <div class="products-message__text">Товары не найдены</div>
                                    </div>
                                </div>
                            </div>
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

</style>
