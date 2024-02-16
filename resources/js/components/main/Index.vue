<script>
import axios from "axios";

export default {
    name:"Index",
    mounted() {
        $(document).trigger('change')
        this.getProducts()

        let rangeMin = 0;
        const range = document.querySelector(".slider__selected");
        const rangeDot = document.querySelectorAll(".slider__dot");
        const rangeValue = document.querySelectorAll(".slider__value");
        rangeDot.forEach((input) => {
            input.addEventListener("input", (event) => {
                let minDot = parseInt(rangeDot[0].value);
                let maxDot = parseInt(rangeDot[1].value);

                if(event.target === rangeDot[0]) {
                    rangeDot[0].style.zIndex = 1;
                    rangeDot[1].style.zIndex = 0;
                } else {
                    rangeDot[0].style.zIndex = 0;
                    rangeDot[1].style.zIndex = 1;
                }

                if (maxDot - minDot < rangeMin) {
                    if (event.target === rangeDot[0]) {
                        rangeDot[0].value = maxDot - rangeMin;
                    } else {
                        rangeDot[1].value = minDot + rangeMin;
                    }
                } else {
                    rangeValue[0].value = minDot;
                    rangeValue[1].value = maxDot;
                    range.style.left = (minDot / rangeDot[0].max) * 100 + "%";
                    range.style.right = 100 - (maxDot / rangeDot[1].max) * 100 + "%";
                }
            });
        });
        rangeValue.forEach((input) => {
            input.addEventListener("input", (event) => {
                let minValue = rangeValue[0].value;
                let maxValue = rangeValue[1].value;

                if (maxValue - minValue >= rangeMin) {
                    if (event.target === rangeValue[0]) {
                        rangeDot[0].value = minValue;
                        if (minValue > rangeDot[0].min) {
                            range.style.left = (minValue / rangeDot[0].max) * 100 + "%";
                        }
                    } else {
                        rangeDot[1].value = maxValue;
                        range.style.right = 100 - (maxValue / rangeDot[1].max) * 100 + "%";
                    }
                }

                if(minValue === "") {
                    range.style.left = (rangeDot[0].min + rangeDot[0].max) / 2 * 100 + "%";

                }
                if(maxValue === "") {
                    range.style.right = (rangeDot[0].min + rangeDot[0].max) / 2 * 100 + "%";
                }
            });
        });
    },

    data() {
        return {
            hover: false,
            products: [],
            pagination: [],
        }
    },

    methods: {
        getProducts(page = 1) {
            axios
                .get('http://127.0.0.1:8888/api/admin/products', {
                    'page': page,
                })
                .then(res => {
                    console.log(res)
                    this.products = res.data.data
                    this.pagination = res.data.meta
                })
                .catch(error => {
                    console.log(error)
                })
        },
    }
}
</script>

<template>
    <div class="main__content content">
        <div class="content__container _container">
            <div class="content__body">
                <div class="content__sidebar sidebar">
                    <div class="sidebar__arrows">
                        <div class="sidebar__arrow arrow-right">
                            <svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                                 xmlns="http://www.w3.org/2000/svg">
                                <path d="M9 18L15 12L9 6" stroke="#3d3d3d" stroke-width="2" stroke-linecap="round"
                                      stroke-linejoin="round" />
                            </svg>
                        </div>
                    </div>
                    <div class="sidebar__content">
                        <div class="sidebar__container">
                            <form class="sidebar__body">
                                <div class="sidebar__header-block header-block">
                                    <h2 class="header-block__title">Фильтрация</h2>
                                    <div class="header-block__cancel _button-svg">
                                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <path d="M18 6L6 18" stroke="#3d3d3d" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                            <path d="M6 6L18 18" stroke="#3d3d3d" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                        </svg>
                                    </div>
                                </div>
                                <div class="sidebar__columns">
                                    <div class="sidebar__column">
                                        <div class="sidebar__filter filter">
                                            <h3 class="filter__title">Категории</h3>
                                            <div class="filter__content">
                                                <label class="filter__option option">
                                                    <input class="option__check" type="checkbox" name="filter_option">
                                                    <span class="option__title">Футболки</span>
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="sidebar__column">
                                        <div class="sidebar__filter filter">
                                            <h3 class="filter__title">Цена</h3>
                                            <div class="filter__content slider">
                                                <div class="slider__range">
                                                    <span class="slider__selected"></span>
                                                </div>
                                                <div class="slider__input">
                                                    <input class="slider__dot" type="range" min="0" max="10000" value="0" step="10">
                                                    <input class="slider__dot" type="range" min="0" max="10000" value="10000" step="10">
                                                </div>
                                                <div class="slider__price">
                                                    <input class="slider__value" type="number" name="min" value="0">
                                                    <span class="slider__separator">&ndash;</span>
                                                    <input class="slider__value" type="number" name="max" value="10000">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="sidebar__button-block">
                                    <button class="sidebar__button _button" type="submit">Применить</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="content__products products">
                    <div class="products__container">
                        <div class="products__header">
                            <div class="products__search search">
                                <input class="search__field" type="text" name="search" placeholder="Поиск">
                                <span class="search__button">
                                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M11 19C15.4183 19 19 15.4183 19 11C19 6.58172 15.4183 3 11 3C6.58172 3 3 6.58172 3 11C3 15.4183 6.58172 19 11 19Z" stroke="black" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                        <path d="M21 21L16.7 16.7" stroke="black" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                    </svg>
                                </span>
                            </div>
                            <div class="products__sort sort">
                                <select class="sort__sort-select" name="sort">
                                    <option value="">Порядок: по умолчанию</option>
                                    <option value="">Цена: по возрастанию</option>
                                    <option value="">Цена: по убыванию</option>
                                    <option value="">Порядок: сначала новые</option>
                                    <option value="">Порядок: сначала старые</option>
                                </select>
                            </div>
                        </div>
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
            </div>
        </div>
    </div>
    <div class="main__pagination pagination">
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
                <li v-for="link in pagination.links" class="pagination__button">
                    <template v-if="Number(link.label) &&
                        (pagination.current_page - link.label < 2 && link.label - pagination.current_page < 2) ||
                        Number(link.label) === 1 || Number(link.label) === pagination.last_page">
                        <a @click.prevent="getProducts(link.label)" :class="link.active ? 'active' : ''" href="#" class="pagination__link _button-svg">{{ link.label }}</a>
                    </template>
                </li>
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
</template>

<style>

</style>
