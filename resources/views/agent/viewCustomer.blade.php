<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Phone Text</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet"
     integrity="sha384-gH2yIJqKdNHPEq0n4Mqa/HGKIhSkIHeL5AyhkYV8i59U5AR6csBvApHHNl/vI1Bx" crossorigin="anonymous">
     <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js" integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3" crossorigin="anonymous"></script>
     <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.min.js" integrity="sha384-7VPbUDkoPSGFnVtYi0QogXtr74QeVeeIs99Qfg5YCF+TidwNdjvaKZX19NZ/e6oz" crossorigin="anonymous"></script>
     <script src="https://code.jquery.com/jquery-3.6.1.min.js" 
     integrity="sha256-o88AwQnZB+VDvE9tvIXrMQaPlFFSUTR+nldQm1LuPXQ=" crossorigin="anonymous"></script>
     <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/vue@2/dist/vue.js"></script>
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>

  </head>
  <body>
    <div class="content-wrapper" id="app">
        <section class="content">
            <div class="container-fluid">
                <div class="container">
            <form @submit.prevent="saveCustomer">

            <fieldset>
              <legend>Add Customer Information</legend>
              <p v-if="errors.length">
                <b>Please correct the following error(s):</b>
                <ul>
                  <li class="text-danger" v-for="error in errors">
                    @{{ error }}
                  </li>
                </ul>
              </p>
              <div class="row">
              <div class="col-4">
                <label for="disabledTextInput" class="form-label">Customer Id</label>
                <input type="text" v-model="form.customer_id" class="form-control" value="{{$customer_id}}" placeholder="Enter customer name">
              </div>
              <div class="col-4">
                <label for="disabledTextInput" class="form-label">Customer Name</label>
                <input type="text" v-model="form.customer_name" class="form-control" placeholder="Enter customer name">
              </div>
              <div class="col-4">
                <label for="disabledTextInput" class="form-label">Email</label>
                <input type="text" v-model="form.customer_email" class="form-control" placeholder="Enter customer name">
              </div>
            </div>
            <div class="row">
              <div class="col-4">
                <label for="disabledTextInput" class="form-label">Customer Mobile</label>
                <input type="number" v-model="form.customer_mobile" value="+88" class="form-control" placeholder="Enter customer name">
              </div>
              <div class="col-4">
                <label for="disabledTextInput" class="form-label">Customer Division</label>
                <select v-model="form.customer_division" id="supplier_r" class=" form-select form-control ss" data-toggle="select2">
                  <option value="" selected="">Select Division Name
                  </option>
    
                  @foreach($divisions as $division)
                    <option value="{{$division->name }}" data-target="{{ $division->id }}">
    
                        {{ $division->name }}
                    </option>
                  @endforeach
              </select>       
               </div>
              <div class="col-4">
                <label for="disabledTextInput" class="form-label">Customer Zone/Area</label>
                <select v-model="form.customer_area" id="" class="form-control subcatecomauto2 subcatcat" aria-invalid="false">
                  <option value="" selected="" disabled="">Select District </option>
                  @foreach( $districts as $district)
                  <option value="{{$district->name }}" data-target="{{ $district->id }}">
                      {{ $district->name }}
                  </option>
                  @endforeach
    
              </select>         
             </div>
            </div>
              <div class="mb-3">
                <label for="disabledTextInput" class="form-label">Customer Address</label>
                <textarea class=" form-control ckeditor" v-model="form.customer_address"></textarea>
              </div>
            
                
              <button type="submit"  class="btn btn-primary">Submit</button>
            </fieldset>
          </form>
                </div>
   
                <div class="row"  style="margin-top: 60px">
                    <div class="col-md-12">
                      
                        <legend style="margin-left: 60px">All Customer Information</legend>
                 
                        <div id="print-area">
                            <div class="card m-5">
                              

                                <table id="datatable-buttons" class="table table-striped dt-responsive nowrap w-100">
                                    <thead>
                                        <tr>
                                          
                                            <th>customer_id</th>
                                            <th>customer_name</th>
                                            <th>customer_email</th>
                                            <th>customer_mobile</th>
                                            <th>customer_division</th>
                                            <th>customer_area</th>
                                            <th>customer_address</th>
                                         
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr v-for="item in lists">
                                            <td>@{{item.customer_id}}</td>
                                            <td>@{{item.customer_name}}</td>
                                            <td>@{{item.customer_email}}</td>
                                            <td>@{{item.customer_mobile}}</td> 
                                            <td>@{{item.customer_division}}</td>
                                            <td>@{{item.customer_area}}</td>
                                            <td>@{{item.customer_address}}</td> 
                                            <td >                                       
                                                <button  @click.prevent="edit(item.id)"  data-bs-toggle="modal" data-bs-target="#exampleModal"
                                                class="action btn btn-warning btn-sm">
                                                    <i class="fa fa-pencil-alt"></i>
                                                    edit
                                                </button>

                                                <button  @click.prevent="deleteCustomer(item.id)"  
                                                class="action btn btn-danger btn-sm">
                                                    <i class="fa fa-pencil-alt"></i>
                                                   delete
                                                </button>
                                            </td>
                                        </tr>
                                    </tbody>
                                    <!-- Button trigger modal -->
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
    
            </div>


        </section>

        {{-- modal section  --}}
        <div class="modal  editModel " tabindex="-1" id="exampleModal" >
            <div class="modal-dialog">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title">Modal title</h5>
                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form @submit.prevent="updateCustomer(form.id)" >
                        <fieldset>
                          <legend>Customer Information</legend>
                        <div class="mb-3">
                            <label for="disabledTextInput" class="form-label">Customer Id</label>
                            <input type="text" v-model="form.customer_id" class="form-control"  placeholder="Enter customer name">
                        </div>
                        <div class="mb-3">
                            <label for="disabledTextInput" class="form-label">Customer Name</label>
                            <input type="text" v-model="form.customer_name" class="form-control" placeholder="Enter customer name">
                        </div>
                        <div class="mb-3">
                            <label for="disabledTextInput" class="form-label">Email</label>
                            <input type="text" v-model="form.customer_email"  class="form-control" 
                                placeholder="Enter customer name">
                        </div>
                
                        <div class="mb-3">
                            <label for="disabledTextInput" class="form-label">Customer Mobile</label>
                            <input type="number" v-model="form.customer_mobile"  class="form-control"   placeholder="Enter customer name">
                        </div>
                        <div class="mb-3">
                            <label for="disabledTextInput" class="form-label">Customer Division</label>
                            <select v-model="form.customer_division" id="supplier_r" class=" form-select form-control ss" data-toggle="select2">
                              <option value="" selected="">Select Division Name
                              </option>
                
                              @foreach($divisions as $division)
                                <option value="{{$division->id }}" data-target="{{ $division->id }}">
                                    {{ $division->name }}
                                </option>
                              @endforeach
                          </select>          
                        </div>
                        <div class="mb-3">
                            <label for="disabledTextInput" class="form-label">Customer Zone/Area</label>
                            <select v-model="form.customer_area" id="" class="form-control subcatecomauto2 subcatcat" aria-invalid="false">
                               <option  disabled="">Select District </option>
                                    @foreach( $districts as $district)
                                        <option value="{{$district->id }}" data-target="{{ $district->id }}">
                                            {{ $district->name }}
                                        </option>
                                    @endforeach
                            </select>         
                         </div>
                          <div class="mb-3">
                            <label for="disabledTextInput" class="form-label">Customer Address</label>
                            <textarea class=" form-control ckeditor" v-model="form.customer_address"></textarea>
                          </div>
                        
                          <button type="submit"  class="btn btn-primary">Submit</button>
                        </fieldset>
                      </form>
                </div>
                <div class="modal-footer">
                  <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                  {{-- <button type="button" class="btn btn-primary">Save changes</button> --}}
                </div>
              </div>
            </div>
        </div>
        {{-- end of modal section  --}}
    </div>
    <script>
        const app = new  Vue({
            el: '#app',
            data: {
                 
                    lists:[], 
                    errors: [],
                    form :{
                        id:" ",
                        customer_id : " ",
                        customer_name : " ",
                        customer_email: " ",
                        customer_mobile: " ",
                        customer_division: " ",
                        customer_area: " ",
                        customer_address: " ",
             
                }
            },
            methods:{

                view(){
                    axios.get("/agent/customer/getData")
                    .then(response=>{
                        this.lists = response.data.customer;
                       
                    });
                },
                edit(customer_id){
                    axios.get(`/agent/customer/edit/${customer_id}`)
                    .then(response=>{
                        customer = response.data.customer;
                        this.form.id  = customer.id
                        this.form.customer_id  = customer.customer_id
                        this.form.customer_name  = customer.customer_name
                        this.form.customer_email    = customer.customer_email
                        this.form.customer_mobile   = customer.customer_mobile
                        this.form.customer_division = customer.customer_division
                        this.form.customer_area     = customer.customer_area
                        this.form.customer_address  = customer.customer_address;
                    });
                },
                updateCustomer(customer_id){

                    axios
                    .post(`/agent/customer/update/${customer_id}`,this.form)
                    .then(response=>{
                        // this.view();
                        
                        let listData=this.form;
                        console.log(this.form);
                        list.map(function(obj,index){
                            if(obj.id==customer_id){
                                // this.lists.$set(index, listData)
                                lists[index].customer_id = this.form.customer_id;
                                console.log(lists[index].customer_id);
                        
                            }
                            })

                     



                        $('.editModel').modal('hide');

                    })
                    .catch((error) => (this.errors = error.response.data.errors));
                },
             

                deleteCustomer(customer_id){

                    Swal.fire({
                            title: 'Are you sure?',
                            text: "You won't be able to revert this!",
                            icon: 'warning',
                            showCancelButton: true,
                            confirmButtonColor: '#3085d6',
                            cancelButtonColor: '#d33',
                            confirmButtonText: 'Yes, delete it!'
                            }).then((result) => {
                            if (result.isConfirmed) {
                                
                        axios.get(`/agent/customer/delete/${customer_id}`)
                        .then(response=>{
                        
                        // this.view();
                        Swal.fire(
                                'Deleted!',
                                'Your file has been deleted.',
                                'success'
                                )
                              }); 
                            }
                            })
                },  

            cleanError : function(){
        this.errors = [];
      },
      checkForm : function(){
            if (this.form.customer_id==" ") {
              this.errors.push('customer_id is required.');
            }
            if (this.form.customer_name==" ") {
              this.errors.push('customer_name is required.');
            }
            if (this.form.customer_email==" ") {
              this.errors.push('customer_email is required.');
            }
            if (this.form.customer_mobile==" ") {
              this.errors.push('customer_mobile is required.');
            }
            if (this.form.customer_division==" ") {
              this.errors.push('customer_division is required.');
            }
            if (this.form.customer_area==" ") {
              this.errors.push('customer_area is required.');
            }
            if (this.form.customer_address==" ") {
              this.errors.push('customer_address is required.');
            }
            // event.preventDefault();
            console.log(this.form);
      },
                
                saveCustomer(event){

                  
                            this.cleanError();
                            this.checkForm();
                            if(this.errors.length === 0) {
                              axios
                              .post("/agent/customer/store/", this.form)
                              .then(() => {
                                Swal.fire({
                                          position: 'top-end',
                                          icon: 'success',
                                          title: 'Customer added successfully',
                                          showConfirmButton: false,
                                          timer: 3500
                                        })
                                        this.view();
                              })
                              .catch((error) => (this.errors.push = error.response.data.errors));
                            }
      }
                 },
            mounted(){
                this.view()
            }  
        })
    </script> 


  </body>
</html>
