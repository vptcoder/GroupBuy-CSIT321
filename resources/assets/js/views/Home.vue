<template>
<!-- NOTES: This file is for home page -->
    <div>
        <div class="container">
            <div class="row"> 
                 <br>
                 <div class="col-sm-3" ><img src="/assets/img/icons/shoes.png">Food</div>
                 <div class="col-sm-3" ><img src="/assets/img/icons/shoes.png">Shoes</div>
                 <div class="col-sm-3" ><img src="/assets/img/icons/shoes.png">Garden</div>
                 <div class="col-sm-3" ><img src="/assets/img/icons/shoes.png">Boy</div>
            </div>
            <div class="row">
                 <div class="col-sm-3" ><img src="/assets/img/icons/shoes.png">pig</div>
                 <div class="col-sm-3" ><img src="/assets/img/icons/shoes.png">Pets</div>
                 <div class="col-sm-3" ><img src="/assets/img/icons/shoes.png">Fashion</div>
                 <div class="col-sm-3" ><img src="/assets/img/icons/shoes.png">GG</div>
            </div>
        </div>
        <div style="text-align:center">
            <button type="button" style="background-color:red;width:20px;height:10px"></button>
            <button type="button" style="width:20px;height:10px"></button>
        </div>
        <br>
        <div class="container">
            <row>
                <b>Popular Groupbuy</b>
                <input type="button" value="" style="margin-left:120px;width: 10px; height: 10px; background-color:#CCD1D1;border-radius:50%;border: none">
                <input type="button" value="" style="margin-left:10px;width: 10px; height: 10px; border-radius:50%;border: none">
                <input type="button" value="" style="margin-left:10px;width: 10px; height: 10px; border-radius:50%;border: none">
            </row>
            <div class="row" >
                 <div class="col-sm-4"><img src="/assets/img/products/nike.png"> </div>
                 <div class="col-sm-4"><img src="/assets/img/products/nike.png"></div>
                 <div class="col-sm-4"><img src="/assets/img/products/nike.png"></div>
            </div>
        </div>
        <br><br>
         <div class ="item prod" v-for="(product,index) in products" :key="index">
                  <router-link :to="{ path: '/products/'+product.id}">
                    <img :src="product.image" :alt="product.name">
                    <span class ="name" v-html="product.name"></span><br>
                    <div align="center"><span class="price">$ {{product.price}}</span></div>
                    <button class="col-md-4 btn btn-sm btn-primary float-right">Buy Now</button>
                  </router-link>
        </div>
    </div>
</template>

<script>
    export default {
        data(){
            return {
                products : []
            }
        },
        mounted(){
            axios.get("api/products/").then(response => this.products = response.data)      
        }
    }
</script>

<style scoped>
.title{
    text-align: center;
}
.col-sm-3{
  float: center;
  display: block;
  background-color: #f4f4f4;
  width: 22%;
  height: 15%;
  margin: 1%;
  text-align:center;
}
.col-sm-3 img {
  min-height: 80%;
  max-height: 80%;
  min-width: 80%;
  max-width: 80%;
  text-align : center;
}
.col-sm-4 {
  margin: 2% 3%;
  width: 26%;
  height: 15%;
  background-color: #f4f4f4;
}

.col-sm-4 img {
  min-height: 70%;
  max-height: 70%;
  min-width: 100%;
  max-width: 100%;
}

.item.prod {
  float: left;
  display: block;
  background-color: #FBEEE6;
  width: 47%;
  height: 15%;
  margin: 2% 1%;
}

.item.prod img{
  min-height: 70%;
  max-height: 70%;
  min-width: 100%;
  max-width: 100%;
} 
.item.prod .name {
  font-size: 14px;
  color:red;
}

.item.prod .price {
  font-size: 14px;
  font-weight: bold;
  color:black;
}


</style>
