<template>
  <transition name="modal-fade" >
  <div class="modal-backdrop" role="dialog" v-show="true">
    <div  id="myModal"  >   
            <div class="modal-dialog">
              <div class="modal-content">
                  <div class="modal-header bg-dark ">
                      <h5 class="modal-title" id="exampleModalLabel" style="color:white">Tarea</h5>
                      <button type="button" class="btn-close"  @click="close" aria-label="Close modal"></button>
                  </div>
              <form ref="task" @submit.prevent>
                      <div class="modal-body">
                              <div class="col-12 mb-2">
                                  <div class="form-group">
                                      <label >Titulo</label>
                                      <input type="number" v-show="false" v-model="formx.id"  name="" id="">
                                      <input type="text" class="form-control" v-model="formx.title" v-bind:class="{ 'is-invalid': attemptSubmit && missingTitle }"  name="" id="" >
                                      <div class="invalid-feedback">El campo es requiredo.</div>
                                  </div>
                              </div>
                            <div class="col-12 mb-2">
                                  <div class="form-group">
                                      <label >Descripcion</label>
                                      <input type="text" class="form-control" v-model="formx.description" v-bind:class="{ 'is-invalid': attemptSubmit && missingDescription }"  name="" id="" >
                                      <div class="invalid-feedback">El campo es requiredo.</div>
                                  </div>
                              </div>
                              <div class="col-12 mb-2">
                                  <label for="floatingTextarea">Detalles</label>
                                  <div class="form-floating">                                  
                                      <textarea id="floatingTextarea" style="height:100px" v-model="formx.details" v-bind:class="{ 'is-invalid': attemptSubmit && missingDetails }" class="form-control" > </textarea>
                                      <div class="invalid-feedback">El campo es requiredo.</div>
                                  </div>
                              </div>
                              <!-- <div class="col-12 mb-2">
                                  <div class="form-group">
                                      <label >Usuario</label>
                                      <input type="number" class="form-control" v-model="formx.user_id"   name="" id="">
                                  </div>
                              </div> -->
                              <div class="modal-footer">
                              <button  class="btn btn-danger"  @click="close">Cancelar</button>
                              <button type="submit" @click="validateForm" class="btn btn-success">Guardar</button>       
                              </div>
                      </div>
              </form> 
              </div>
          </div>
      </div>       
  </div>      
</transition>
</template>

<script>
  export default {
    name: 'Modal',
   props:['groups'],
   data(){
      return{                     
              formx: {title:'',description:'',details:'',user_id:''} ,
               attemptSubmit: false,
        }  
    },
     computed:
           {
           missingTitle () { return this.formx.title == undefined || this.formx.title ==  '' ; },
           missingDescription () { return this.formx.description == '' || this.formx.description == undefined ; },
           missingDetails () { return this.formx.details == '' || this.formx.details == undefined ; },
            },
    methods: {
      close() {
        this.$emit('close');
        this.resetForm()
        this.attemptSubmit = false;
      },      
      resetForm(){  
      this.formx.id = ''    
      this.formx.title = ''
      this.formx.description = ''
      this.formx.details = ''
      },
      editForm(dataform){           
       this.formx.id = dataform.id
       this.formx.title = dataform.title
       this.formx.description = dataform.description
       this.formx.details = dataform.details
      },
      validateForm () {   
                     
                this.attemptSubmit = true;
                if (this.missingTitle || this.missingDescription || this.missingDetails ) {
                    event.preventDefault();
                }
                else
                {
                   this.submitForm() 
                }
            },
      submitForm() {
      this.attemptSubmit = false;
      this.$emit('emitmodel',this.formx)
    },
    },
    
    
  };
</script>
<style>

  .modal-fade-enter,
  .modal-fade-leave-to {
    opacity: 0;
  }

  .modal-fade-enter-active,
  .modal-fade-leave-active {
    transition: opacity .5s ease;
  }
</style>