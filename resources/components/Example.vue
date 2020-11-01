<template>
    <div>
        <p>hhhhh</p>
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