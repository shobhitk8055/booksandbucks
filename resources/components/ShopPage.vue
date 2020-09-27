<template>
    <div class="container-fluid ml-5 mr-5 mt-5">
        <!-- Section tittle -->
        <div class="row justify-content-center">
            <div class="col-xl-7 col-lg-8 col-md-10">
                <div class="section-tittle mb-70 text-center">
                    <h2>Shop</h2>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-xl-3 col-lg-4 col-md-2" >
                <div style="">
                    <h3>Categories</h3>
                </div>
            </div>
            <div class="col-xl-8 col-lg-4 col-md-6" >
                <div class="row">
                    <div class="col-xl-4 col-lg-4 col-md-6 col-sm-6" v-for="product in products">
                        <div class="single-popular-items mb-50 text-center">
                            <div class="popular-img">
                                <img :src="getImageURL(product.id)" alt="">
                            </div>
                            <div class="popular-caption">
                                <h4 style="padding-top: 15px;"><a style="color:#444444" href="">{{product.name}}</a></h4>
                                <span>
                            </span>
                                    ₹ {{ numberFormat(product.price) }}
                            </div>
                            <form  method="post" action="">
                                <input type="hidden" name="slug" :value="product.slug" />
                                <input type="hidden" name="_token" :value="csrf" />

                                <input type="hidden" name="qty" value="1" />
                                <button style="width: 100%; background-color: #0b0b0b; padding-top:10px; padding-bottom: 10px;" type="submit" >
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
        props: ['product','image','csrf'],
        data() {
            return {
                products:JSON.parse(this.product),
                images : this.getImageURL(1)
            }
        },
        methods: {
            getImageURL(id){
                let images = JSON.parse(this.image);
                for (let i =0;i<images.length;i++){
                    if (images[i].id === id){
                        return "storage/"+images[i].path
                    }
                }
            },
            numberFormat(price){
                return parseInt(price,10).toFixed(2);
            }
        },
        mounted() {

        }
    }
</script>