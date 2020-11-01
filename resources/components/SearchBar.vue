<template>
    <div class="d-flex justify-content-center h-100">
        <div class="searchbar">
            <input class="search_input" type="text" v-model="product_name" name="" placeholder="Search...">
            <a href="#" class="search_icon pr-3 pt-1"><i class="fas fa-search"></i></a>
        </div>
        <div class="results">
            <div class="result" v-for="product in getProducts()">
                    <div class="row" v-on:click="goToProduct(product.slug)">
                        <div class="col-3">
                            <img style="width:34px; height: 50px" class="ml-2" :src="'/storage/'+getImageUrl(product.id)">
                        </div>
                        <div class="col-9">
                            <a href="/admin/customers/">
                                {{product.name}}
                            </a>
                            <p><i>{{getAuthor(product.book_id)}}</i></p>
                        </div>
                    </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        props: ['products','images','books'],
        data() {
            return {
                product_name: null,
                all_products: []
            }
        },
        methods:{
            goToProduct(slug){
                window.location.href = window.location.origin+"/product/"+slug;
            },
            getProducts(){
                let products = JSON.parse(this.products);
                let productsList = [];
                if(!this.product_name){
                    return [];
                }else{
                    let rg = new RegExp(this.product_name.toLowerCase());
                    for(let i =0;i<products.length;i++){
                        if(products[i].name.toLowerCase().match(rg)){
                            productsList.push(products[i]);
                        }
                    }
                    return productsList;
                }
            },
            getImageUrl(product_id){
                let images = JSON.parse(this.images);
                for (let i=0;i<images.length;i++){
                    if (images[i].product_id === product_id && images[i].is_main_image === 1){
                        return images[i].path;
                    }
                }
            },
            getAuthor(book_id){
                let books = JSON.parse(this.books);
                for (let i=0;i<books.length;i++){
                    if (books[i].id === book_id){
                        return books[i].author;
                    }
                }
            }
        },
        mounted() {
        }
    }
</script>
<style>
    .results{
        background-color: #ECECEC;
        color: #fff;
        width:75%;
        position: absolute;
        cursor:pointer;
        margin-top: 40px;
    }
    .result{
        padding-top: 9px;
        border-bottom: #E82323;
        border-left: #ECECEC;
        border-top: #ECECEC;
        border-right: #ECECEC;
        border-style: solid;
        padding-left: 5px;
    }
    .result:hover{
        background-color: #fff;
        border-left: #3C8DBC;
        border-top: #3C8DBC;
        border-right: #3C8DBC;
        color: #fff;
    }
    .result:hover > a{
        color: #fff;
    }
    a{
        color:black;
    }
    a:link{
        text-decoration: none;
    }
</style>