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
    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/vue@2/dist/vue.js"></script>
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  </head>
  <body>
<div class="container" id="app">
  
    <form @submit.prevent="saveCustomer">
        <fieldset>
          <legend>Customer Information</legend>
          <p v-if="errors.length">
            <b>Please correct the following error(s):</b>
            <ul>
              <li class="text-danger" v-for="error in errors">
                @{{ error }}
              </li>
            </ul>
          </p>
          <div class="mb-3">
            <label for="disabledTextInput" class="form-label">Customer Id</label>
            <input type="text" v-model="form.customer_id" class="form-control" value="{{$customer_id}}" placeholder="Enter customer name">
          </div>
          <div class="mb-3">
            <label for="disabledTextInput" class="form-label">Customer Name</label>
            <input type="text" v-model="form.customer_name" class="form-control" placeholder="Enter customer name">
          </div>
          <div class="mb-3">
            <label for="disabledTextInput" class="form-label">Email</label>
            <input type="text" v-model="form.customer_email" class="form-control" placeholder="Enter customer name">
          </div>

          <div class="mb-3">
            <label for="disabledTextInput" class="form-label">Customer Mobile</label>
            <input type="number" v-model="form.customer_mobile" value="+88" class="form-control" placeholder="Enter customer name">
          </div>
          <div class="mb-3">
            <label for="disabledTextInput" class="form-label">Customer Division</label>
            <select v-model="form.customer_division" id="supplier_r" class=" form-select form-control ss" data-toggle="select2">
              <option value="" selected="">Select Division Name
              </option>

              @foreach($divisions as $division)
                <option value="{{$division->name }}" data-target="{{ $division->id }}">

                    {{ $division->name }}
                </option>
              @endforeach
          </select>          </div>
          <div class="mb-3">
            <label for="disabledTextInput" class="form-label">Customer Zone/Area</label>
            <select v-model="form.customer_area" id="" class="form-control subcatecomauto2 subcatcat" aria-invalid="false">
              <option value="" selected="" disabled="">Select District </option>
              @foreach( $districts as $district)
              <option value="{{$district->name }}" data-target="{{ $district->id }}">
                  {{ $district->name }}
              </option>
              @endforeach

          </select>          </div>
          <div class="mb-3">
            <label for="disabledTextInput" class="form-label">Customer Address</label>
            <textarea class=" form-control ckeditor" v-model="form.customer_address"></textarea>
          </div>
        
            
          <button type="submit"  class="btn btn-primary">Submit</button>
        </fieldset>
      </form>
      
</div>



 <script>
  var  vm = new Vue({
    // Assigning id of DOM in parameter
    el: '#app',
    // Assigning values of parameter
    data: {
      errors: [],
      form :{
        customer_id : " ",
        customer_name : " ",
        customer_email: " ",
        customer_mobile: " ",
        customer_division: " ",
        customer_area: " ",
        customer_address: " ",
      },
      
    },

    methods : {  
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
      // Creating function
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
             window.location.href = "/agent/customer/view";
          })
          .catch((error) => (this.errors.push = error.response.data.errors));
        }
      }
    }
  });
</script>    


  </body>
</html>
