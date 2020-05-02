<template>
    <div>
        <div class="table">
            <thead>
                <tr>
                    <th>Restaurant Name</th>
                    <th>Address</th>
                    <th>Phone</th>
                    <th>Deal</th>
                    <th>Image</th>
                </tr>
            </thead>
            <tbody v-if= "allRestaurants" >
                <tr v-for="(restaurant, index) in restaurants">
                    <td>{{ restaurant.restaurantName }}</td>
                    <td>{{ restaurant.address }}</td>
                    <td>{{ restaurant.phone }}</td>
                    <td>{{ restaurant.deal }}</td>
                    <td>{{ restaurant.image }}</td>
                </tr>
            </tbody>
        </div>

        <!-- create modal -->
    <!-- <button @click="showCreateModal" class="btn btn-primary btn-block" >Add a Restaurant</button> -->
<button @click="showCreateModal" type="button" class="btn btn-primary" data-toggle="modal" data-target="#s">Add a Restaurant</button>

<!-- Modal -->
 <div class="modal fade" id="addRestaurantModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" >Add Restaurant</h5>
      
      </div>
      <div class="modal-body">
            <div class="form-group" >
                <label for="restaurantName" >Restaurant Name </label>
                <input v-model="rest.restaurantName" type="text"  class="from-control" >
            </div> 
            <div class="form-group" >
                <label for="address" >Adress </label>
                <input v-model="rest.address" type="text" id="address" class="from-control" >
            </div>
             <div class="form-group" >
                <label for="phone" >Phone </label>
                <input v-model="rest.phone" type="text" id="phone" class="from-control" >
            </div> 
            <div class="form-group" >
                <label for="deal" >Deal </label>
                <input v-model="rest.deal" type="text" id="deal" class="from-control" >
            </div>
             <div class="form-group" >
                <label for="image" >Image </label>
                <input v-model="rest.image" type="text" id="image" class="from-control" >
            </div> 
        
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button @click="createRestaurant" type="button" class="btn btn-primary">Add to Restaurant List</button>
      </div>
    </div>
  </div>
</div> 
        
    </div>
</template>

<script>
    export default {
        data(){
            return{
                rest:{
                    restaurantName: '',
                    address: '',
                    phone: '',
                    deal: '',
                    image: '',
                },
                restaurants:[],
                uri: 'http://localhost:8000/api/restaurants',
                errors:[],
                allRestaurants: true
            }
        },
 
        methods:{
             showCreateModal(){
                $("#addRestaurantModal").modal("show");
            },
            createRestaurant(){
                axios.post(this.uri, {restaurantName:this.rest.restaurantName, address:this.rest.address, phone:this.rest.phone, deal:this.rest.deal, image:this.rest.image})
                .then(response=>{
                    console.log(response.data);
                    this.restaurants.push(response.data);
                $("#addRestaurantModal").modal("hide");

                })
                .catch(error=>{
                     this.errors = [];
                    if(error.response.data.errors){
                        this.errors.push(error.response.data.errors.name[0]);
                    }
                    if(error.response.data.errors.body){
                        this.errors.push(errors.response.data.errors.body[0]);
                    }
                });
            },
            loadRestaurants(){
                // make call to get all restaurants
                axios.get(this.uri).then((response) =>{
                    // console.log(response.data.restaurants);
                    this.restaurants = response.data.restaurants;
                    console.log(this.restaurants);

                }).catch(error =>{
                    console.log(error);
                });
            }
        },
        mounted() {
            this.loadRestaurants();
            console.log('Component mounted.')
        }
    }
</script>
