<template>
<div class="container">
 <div class="row">
     <div class="col-sm-9 col-md-7 col-lg-5 mx-auto">
         <div class="card border-0 shadow rounded-3 my-5">             
             <div class="card-body p-4 p-sm-5">
                 <h5 class="card-title text-center mb-5 fw-light fs-5">Iniciar Sesión vue</h5>                  
                  <form @submit.prevent>               
                     <div class="form-floating mb-3">
                         <input id="email" type="email" class="form-control" name="email" v-bind:class="{ 'is-invalid': attemptSubmit && missingEmail }" required  v-model="form.email" autofocus>
                         <label for="floatingInput">Correo Electronico</label>
                         <div class="invalid-feedback">El campo es requiredo.</div>
                     </div>
                     <div class="form-floating mb-3">
                         <input id="password" type="password" class="form-control" name="password" v-bind:class="{ 'is-invalid': attemptSubmit && missingPassword }" v-model="form.password" required autocomplete="current-password">
                         <label for="floatingPassword">Contraseña</label>
                           <div class="invalid-feedback">El campo es requiredo.</div>
                     </div>
                     <div class="d-grid">
                       <button @click="validateForm" class="btn btn-primary">
                             Iniciar Sesión
                         </button>
                     </div>
                     <hr class="my-4">
                 </form> 
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
            form:{  email: '', password: '', device_name: 'browser'},
            errors: [] ,
            attemptSubmit: false, 

        }
    },
    computed:
    {
        missingEmail () { return this.form.email == undefined || this.form.email ==  '' ; },
        missingPassword () { return this.form.password == '' || this.form.password == undefined ; },
    },
    methods:{
            validateForm () {
                this.attemptSubmit = true;
                if (this.missingEmail || this.missingPassword) {
                    event.preventDefault();
                }
                else
                {
                   this.loginUser() 
                }
            },        
         loginUser(){
           
             axios.post('/api/login', this.form).then((response) =>{
                localStorage.setItem('token', response.data)              
                 this.$router.push('/'); 
             }).catch((error) =>{
                 console.log(error.response.data.message);
                this.errors = error.response.data.errors;
            })
             
             
         }
    }
}
</script>