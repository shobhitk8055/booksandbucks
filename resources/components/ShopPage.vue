<template>
    <div class="container-fluid mt-5">
        <!-- Section tittle -->
        <div class="row justify-content-center">
            <div class="col-xl-7 col-lg-8 col-md-10">
                <div class="section-tittle mb-70 text-center">
                    <h2>Shop</h2>
                    <p>Book & Stationary</p>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-xl-3 col-lg-4 col-md-2" >

                <table class="table table-bordered">
                    <thead>
                    <th style="color:#FF0000">
                        Categories
                    </th>
                    </thead>
                    <tbody>
                    <tr>
                        <td>
                            <form class="form-check">
                                <div v-for="category in categories">
                                    <input class="form-check-input"
                                           type="checkbox"
                                           :value="category.id"
                                           :id="category.name"
                                            v-model="selectedCategories"
                                    >
                                    <label class="form-check-label" :for="category.name">
                                        {{category.name}}
                                    </label>
                                </div>
                            </form>
                        </td>
                    </tr>
                    </tbody>
                </table>
                <table class="table table-bordered" v-if="isBook()">
                    <thead>
                    <th style="color:#FF0000">
                        Genres
                    </th>
                    </thead>
                    <tbody>
                    <tr>
                        <td>
                            <form class="form-check">
                                <div v-for="genre in genres">
                                    <input class="form-check-input"
                                           type="checkbox"
                                           :value="genre.id"
                                           :id="genre.name"
                                           v-model="selectedGenres"
                                    >
                                    <label class="form-check-label" :for="genre.name">
                                        {{genre.name}}
                                    </label>
                                </div>
                            </form>
                        </td>
                    </tr>
                    </tbody>
                </table>
                <table class="table table-bordered">
                    <thead>
                    <th style="color:#FF0000">
                    Price Range
                    </th>
                    </thead>
                    <tbody>
                    <tr>
                        <td>
                                <div class="form-group">
                                    <label for="formControlRange" style="float:left;">
                                        Rs {{parseInt(min)}} - {{parseInt(max)}}
                                    </label>
                                    <span style="float:right;">
                                        Max: {{range===null ? parseInt(min) : parseInt(range)}} ₹
                                    </span>
                                    <input v-model="range"
                                           type="range"
                                           :max="max"
                                           :min="min"
                                           class="form-control-range"
                                           id="formControlRange">
                                </div>
                        </td>
                    </tr>
                    </tbody>
                </table>
                <table class="table table-bordered">
                    <thead>
                    <th style="color:#FF0000">
                        Filters
                    </th>
                    </thead>
                    <tbody>
                    <tr>
                        <td>
                            <ul>
                            <li><a v-on:click="filter = 'L2H'"
                                   class="filterButton"
                                   :class="filter === 'L2H' ? 'text-primary' : 'text-dark'">
                                Price high to low
                            </a></li>
                            <li><a v-on:click="filter = 'H2L'"
                                   class="filterButton"
                                   :class="filter === 'H2L' ? 'text-primary' : 'text-dark'">
                                Price low to high
                            </a></li>
                            <li><a v-on:click="filter = 'NF'"
                                   class="filterButton"
                                   :class="filter === 'NF' ? 'text-primary' : 'text-dark'">
                                Newest First
                            </a></li>
                            </ul>
                        </td>
                    </tr>
                    </tbody>
                </table>
            </div>
            <div class="col-xl-8 col-lg-4 col-md-6" >
                <!--<h2 class="mb-3">Fantasy</h2>-->
                <div class="row">
                    <div class="col-xl-4 col-lg-4 col-md-6 col-sm-6"
                         v-for="product in getProducts()">
                        <div class="single-popular-items mb-50 text-center">
                            <a :href="'/product/'+product.slug">
                            <div class="popular-img">
                                <img v-bind:src="getImageURL(product.id)" alt="">
                            </div></a>
                            <div class="popular-caption">
                                <h4 style="padding-top: 15px;">
                                    <a style="color:#444444" :href="'/product/'+product.slug">{{product.name}}</a>
                                </h4>    ₹ {{ numberFormat(product.price) }}
                            </div>
                            <form  method="post" action="/add-to-cart">
                                <input type="hidden" name="slug" :value="product.slug" />
                                <input type="hidden" name="_token" :value="csrf" />

                                <input type="hidden" name="qty" value="1" />
                                <button style="width: 100%; background-color: #0b0b0b; padding-top:10px; padding-bottom: 10px; color:white;" type="submit" >
                                    Add to cart
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        props: ['product', 'image', 'csrf', 'category',
                'category_product', 'genre', 'genre_books',
                'are_book', 'selected', 'select_genre'],
        data() {
            return {
                selectedCategories: [],
                selectedGenres: [],
                products: JSON.parse(this.product),
                categories: JSON.parse(this.category),
                genres: JSON.parse(this.genre),
                max: 0,
                min:1000,
                filter: "none",
                range: null,
                areBooks: null,
                selectedCategory: null,
            }
        },
        mounted() {
            this.range = null;
            this.max = this.getRange(this.products,'max');
            this.min = this.getRange(this.products,'min');
            if (this.selected){
                this.selectedCategories.push(this.selected);
            }
            if (this.select_genre){
                this.selectedGenres.push(parseInt(this.select_genre));
            }
        },
        methods: {
            getImageURL(id){
                let images = JSON.parse(this.image);
                for (let i =0;i<images.length;i++){
                    if (images[i].product_id === id){
                        return "/storage/" + images[i].path
                    }
                }
            },
            numberFormat(price){
                return parseInt(price,10).toFixed(2);
            },
            getProducts: function () {
                let pro_cat = JSON.parse(this.category_product);
                let pro_gen = JSON.parse(this.genre_books);
                if (this.selectedCategories.length === 0) {
                    return this.removeSame(this.removeMinimum(this.filterProducts(this.products, this.filter)));
                }else {
                    let productIds = [];
                    let products = [];

                    for (let i = 0; i < pro_cat.length; i++) {
                        for (let j = 0; j < this.selectedCategories.length; j++) {
                            if (pro_cat[i].category_id === parseInt(this.selectedCategories[j])) {
                                productIds.push(pro_cat[i].product_id);
                            }
                        }
                    }
                    if (this.isBook()) {
                        if (this.selectedGenres.length !== 0) 
                        productIds = [];
                        for (let i = 0; i < pro_gen.length; i++) {
                            for (let j = 0; j < this.selectedGenres.length; j++) {
                                if (pro_gen[i].genre_id === this.selectedGenres[j]) {
                                    productIds.push(this.getProductId(pro_gen[i].book_id));
                                }
                            }
                        }
                    }

                    for (let i = 0; i < productIds.length; i++) {
                        for (let j = 0; j < this.products.length; j++) {
                            if (productIds[i] === this.products[j].id) {
                                products.push(this.products[j]);
                            }
                        }
                    }
                    return this.removeSame(this.removeMinimum(this.filterProducts(products,this.filter)));
                }
            },
            getProductId(bookId){
                let products = this.products;
                for (let i=0;i<products.length;i++){
                    if (products[i].book_id===bookId){
                        return products[i].id;
                    }
                }
            },
            filterProducts(products,filter){
                switch (filter) {
                    case "none":
                        return products;
                    case "H2L":
                        return products.sort(function (a,b) {
                            if( a.price < b.price){ return -1; }
                            else if( a.price > b.price){ return 1; }
                            else{ return 0; }
                        });
                    case "L2H":
                        return products.sort(function (a,b) {
                            if(a.price > b.price){ return -1; }
                            else if(a.price < b.price){ return 1; }
                            else{ return 0; }
                        });
                    case "NF":
                        return products.sort(function (a,b) {
                            if (a.created_at > b.created_at){ return -1; }
                            else if(a.created_at < b.created_at){ return 1; }
                            else{ return 0; }
                        })
                }
            },
            getRange(products,parameter){
                let min = products[0].price, max = products[0].price;
                for (let i = 1, len=products.length; i < len; i++) {
                    let v = products[i].price;
                    min = (v < min) ? v : min;
                    max = (v > max) ? v : max;
                }
                if (parameter === "max"){ return max; }
                if (parameter === "min"){ return min; }
            },
            removeMinimum(products){
                let max = this.range;
                if (max!==null){
                    let allProducts = [];
                    for (let i=0;i<products.length;i++){
                        if (products[i].price <= max+1){
                            allProducts.push(products[i]);
                        }
                    }
                    return allProducts;
                }else {
                    return products;
                }
            },
            removeSame(products){
                let jsonObject = products.map(JSON.stringify);
                let uniqueSet = new Set(jsonObject);
                let uniqueArray = Array.from(uniqueSet).map(JSON.parse);
                return uniqueArray;
            },
            isBook(){
                return this.selectedCategories.includes("1") || this.selectedCategories.includes(1);
            }
        },

    }
</script>
<style>
    .filterButton{
        color:black;
        cursor: pointer;
    }
    .active{
        color:blue;
    }
</style>