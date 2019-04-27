<template>
    <div class="container">
        <div class="form-group">
            <label for="name">Name</label>
            <input v-model="name" type="text" class="form-control" placeholder="Name">
        </div>
        <div class="form-group">
            <label for="price">Price</label>
            <input v-model="price" type="number" class="form-control" placeholder="" step="any">
        </div>
        <div class="form-group">
            <label for="quantity">Quantity</label>
            <input  v-model="quantity" type="number" class="form-control" placeholder="">
        </div>
        <div class="form-group">
            <label for="total">Total</label>
            <span class="badge-success px-1" >{{ total }}</span>
        </div>
        <button @click="createProduct" class="btn btn-primary" >Create</button>
    </div>
</template>

<script>
    export default {
        data: function(){
            return {
                name:'',
                price:0,
                quantity:0
            }
        },
        methods: {
            //Validate if the data is valid
            isOK:function(){
                try{
                    if(this.name=='' || this.name.length < 3 ){
                        throw 'Name is empty or have less then 3 characters';
                    }

                    if(parseInt(this.price)==0){
                        throw 'The price is not valid';
                    }

                    if(parseInt(this.quantity)==0){
                        throw 'The quantity is not valid';
                    }
                    return true;
                }catch (e) {
                    this.showError('The input data is not valid!');
                    return false;
                }
            },
            //Show error using Sweet alert
            showError:function(e){
                swal("Error!", e, "error");
            },
            //Store the Product on the database via AJAX request
            createProduct: function(){
                let data = {
                    'name':this.name,
                    'price':this.price,
                    'quantity':this.quantity,
                    'total':this.total
                };

                if(!this.isOK()){
                    return false;
                }
                let that = this;
                //Store Product on the database
                axios.post(system.url_store_product,data).then(response => {
                    let data = response.data;
                    console.log(response);
                    console.log('errors: '+data.errors);
                    //Catch errors
                    if(data.description){
                        console.log('description: '+data.description);
                        throw data.description;
                    }
                    swal("Product added!", "Successfully added!").then((btnAnswer) => {
                        if(btnAnswer){
                            //redirect to product list
                            window.location.replace(system.url_products);
                        }
                    });

                }).catch(e => {
                    that.showError(e);
                })
            }
        },
        computed:{
            total: function () {
                return this.quantity * this.price;
            }
        },
    }
</script>
