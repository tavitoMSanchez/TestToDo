<template>
    <div class="row mt-3">
        <div class="col-10 mb-2 "></div>
        <div class="col-2 mb-2 ">
            <button type="button" class="btn btn-primary" @click="showModal" v-show="visibleAdd" >
                <i class="fas fa fa-plus-circle"></i> Agregar tarea
            </button>
            <button @click="deleteTasksComplete()" class="btn btn-danger" v-show="visibleDelete" v-bind:disabled="tasksComplete.length == 0"> <i class="fas fa-trash"></i>Eliminar</button>
        </div>      
    <div > 
         <!-- Modal -->       
         <Modal v-show="isModalVisible" @close="closeModal" @emitmodel="saveTask" ref="childComponent"/>  
    
      		<!-- tabs -->
			<div class="pcss3t pcss3t-effect-scale pcss3t-theme-1">
				<input type="radio" name="pcss3t" checked value="false"  @click="inputClick(false)" id="tab1" class="tab-content-first">
				<label for="tab1"><i class="fa-solid fa-clock-rotate-left"></i> Tareas Pendientes</label>				
				<input type="radio" name="pcss3t" id="tab2" value="true" @click="inputClick(true)" class="tab-content-2">
				<label for="tab2"><i class="fa-regular fa-circle-check" ></i> Tareas Completadas</label>				
				<ul>
					<li class="tab-content tab-content-first typography">
						    <table id="myTable" class="table table-striped" >
                                <thead>
                                    <tr>
                                        <th>Titulo</th>
                                        <th>Descripción</th>
                                        <th>Creado</th>
                                        <th>Editado</th>                                       
                                        <th>Acciones</th>
                                    </tr>
                                </thead>      
                                <tbody>
                                 <tr v-for="task in tasks" :key="task.id" class="item-row">
                                    <td>{{ task.title}}</td>              
                                    <td>{{ task.description}}</td>
                                    <td>{{   moment(task.created_at).format('LL')  }}</td>
                                    <td>{{   moment(task.updated_at).format('LL')  }}</td>                                    
                                    <td > 
                                       <a type="button" @click="editTask(task.id)" class="btn btn-primary" title="Editar"><i style="color:black" class="fa-solid fa-pencil"></i></a>
                                       <a style=" margin-right:5px;margin-left:5px;" type="button" @click="deleteTask(task.id)" class="btn btn-danger"><i style="color:black" title="Eliminar" class=" fas fa-trash"></i></a>
                                       <a type="button" @click="completeTask(task.id)" class="btn btn-success"><i style="color:black" title="Completar" class="fa-solid fa-circle-check"></i></a>
                                    </td>
                                </tr> 
                                </tbody>
                            </table>					
					</li>					
					<li class="tab-content tab-content-2 typography">
						 <table id="myTableComplete" class="table table-striped">
                                <thead>
                                    <tr>
                                        <th>Titulo</th>
                                        <th>Descripción</th>
                                        <th>Creado</th>
                                        <th>Editado</th>
                                        <th>Usuario Asignado</th>
                                        <th>Acciones</th>
                                    </tr>
                                </thead>      
                                <tbody>
                             <tr v-for="task in tasksComplete" :key="task.id">
                                     <td>{{ task.title}}</td>              
                                    <td>{{ task.description}}</td>
                                    <td>{{   moment(task.created_at).format('LL')  }}</td>
                                    <td>{{   moment(task.updated_at).format('LL')  }}</td>
                                    <td>{{ task.user_id}}</td>
                                    <td>                                    
                                     <a type="button" @click="deleteTask(task.id)" class="btn btn-danger"><i style="color:black" class="fas fa-trash"></i></a>
                                    </td>
                                </tr> 
                                </tbody>
                            </table>
					</li>					
				</ul>
			</div>
    </div>
    </div>
</template>

   <script>
import moment from 'moment';
import 'moment/locale/es';
import {  ref } from "vue"
import { useRouter } from "vue-router"
import Modal from './Modal.vue'
import datable from 'datatables.net-bs5';
const router = useRouter()
   export default{ 
      name: 'TaskIndex', 
      components: {
      Modal,
    },      
       mounted(){
                this.getTask()
                this.getTaskComplete()
                this.moment = moment;
            },
            data(){
                return{ 
                    isModalVisible: false,
                    formx: {title:'',description:'',details:'',user_id:''} ,              
                    tasks: [],
                    tasksComplete:[],
                    visibleDelete: false,
                    visibleAdd: true,
                }
            },
             methods:{               
                  inputClick(val) {
                    if(val == true)
                    {
                    this.visibleAdd = false;  
                    this.visibleDelete = true;                    
                    }else{
                    this.visibleDelete = false;  
                    this.visibleAdd = true;    
                    }            
                   },                  
                   showModal() {
                    this.isModalVisible = true;
                    this.$refs.childComponent.resetForm();
                   },
                   closeModal() {
                    this.isModalVisible = false;
                    this.$refs.childComponent.resetForm();
                   },
                    table(){
                            this.$nextTick(() =>{
                                $('#myTable').DataTable({
                                        order: [[ 0, 'asc' ]],
                                        language: {
                                            "decimal": "",
                                            "emptyTable": "No hay información",
                                            "info": "Mostrando _START_ a _END_ de _TOTAL_ Entradas",
                                            "infoEmpty": "Mostrando 0 to 0 of 0 Entradas",
                                            "infoFiltered": "(Filtrado de _MAX_ total entradas)",
                                            "infoPostFix": "",
                                            "thousands": ",",
                                            "lengthMenu": "Mostrar _MENU_ Entradas",
                                            "loadingRecords": "Cargando...",
                                            "processing": "Procesando...",
                                            "search": "Buscar:",
                                            "zeroRecords": "Sin resultados encontrados",
                                            "paginate": {
                                                "first": "Primero",
                                                "last": "Ultimo",
                                                "next": "Siguiente",
                                                "previous": "Anterior"
                                            }
                                        },
                                });
                            });
                        },
                    tableComplete(){
                            this.$nextTick(() =>{
                                $('#myTableComplete').DataTable({
                                        language: {
                                            "decimal": "",
                                            "emptyTable": "No hay información",
                                            "info": "Mostrando _START_ a _END_ de _TOTAL_ Entradas",
                                            "infoEmpty": "Mostrando 0 to 0 of 0 Entradas",
                                            "infoFiltered": "(Filtrado de _MAX_ total entradas)",
                                            "infoPostFix": "",
                                            "thousands": ",",
                                            "lengthMenu": "Mostrar _MENU_ Entradas",
                                            "loadingRecords": "Cargando...",
                                            "processing": "Procesando...",
                                            "search": "Buscar:",
                                            "zeroRecords": "Sin resultados encontrados",
                                            "paginate": {
                                                "first": "Primero",
                                                "last": "Ultimo",
                                                "next": "Siguiente",
                                                "previous": "Anterior"
                                            }
                                        },
                                });
                            });
                        },
                    getTask(){
                                axios.get("api/get_tasks").then(res=>{
                                this.tasks = res.data
                                $('#myTable').DataTable().destroy()
                                this.table()
                            });
                        },
                    getTaskComplete(){
                                axios.get("api/get_tasks_complete").then(res=>{
                                this.tasksComplete = res.data
                                $('#myTableComplete').DataTable().destroy()
                                this.tableComplete()
                            });
                        },
                    deleteTasksComplete(){
                                Swal.fire({
                                icon: "warning",
                                title:"¿Seguro desea eliminar?",
                                showCancelButton: true,
                                confirmButtonColor:'#3085d6',
                                cancelButtonText:'No',
                                confirmButtonText:'Si, eliminar!'
                            })
                            .then((result) =>{
                                if(result.value)
                                {
                                axios.get("api/delete_all_task_complete")
                                    .then(()=>{
                                        Swal.fire({
                                                    icon: "success",
                                                    title:"Tareas Completas Eliminadas"
                                                
                                                })
                                        this.getTask()
                                        this.getTaskComplete()
                                    })
                                    .catch((error) => {
                                        Swal.fire({
                                                    icon: "warning",
                                                    title:error
                                                
                                                })
                                    })
                                }
                            })            
                        },
                    editTask (id){                        
                        axios.get('/api/get_edit_task/'+id)
                                    .then((response) =>{
                                    let dataform = []
                                    dataform  =  response.data;                                  
                                    this.$refs.childComponent.editForm(dataform);
                                        this.isModalVisible = true;
                                    })
                                    .catch((error) => {
                                        Swal.fire({
                                                    icon: "warning",
                                                    title:error
                                        })
                        })
                
                    //         this.$router.push({
                    //     name: 'editarTarea', 
                    //     params: { id: id }
                    // });
                            },
                    deleteTask (id){      
                            Swal.fire({
                                icon: "warning",
                                title:"¿Seguro desea eliminar?",
                                showCancelButton: true,
                                confirmButtonColor:'#3085d6',
                                cancelButtonText:'No',
                                confirmButtonText:'Si, eliminar!'
                            })
                            .then((result) =>{
                                if(result.value)
                                {
                                    axios.get('/api/delete_task/'+id)
                                    .then(()=>{
                                        Swal.fire({
                                                    icon: "success",
                                                    title:"Tarea Eliminada"
                                                
                                                })
                                        this.getTask()
                                        this.getTaskComplete()
                                    })
                                    .catch((error) => {
                                        Swal.fire({
                                                    icon: "warning",
                                                    title:error
                                                
                                                })
                                    })
                                }
                            })
                    },
                    completeTask (id){      
                            Swal.fire({
                                icon: "warning",
                                title:"¿Seguro esta completada?",
                                showCancelButton: true,
                                confirmButtonColor:'#3085d6',
                                cancelButtonText:'No',
                                confirmButtonText:'Si, Completar!'
                            })
                            .then((result) =>{
                                if(result.value)
                                {
                                    axios.get('/api/complete_task/'+id)
                                    .then(()=>{
                                        Swal.fire({
                                                    icon: "success",
                                                    title:"Tarea Completada"
                                                
                                                })
                                        this.getTask()
                                        this.getTaskComplete()
                                    })
                                    .catch((error) => {
                                        Swal.fire({
                                                    icon: "warning",
                                                    title:error
                                                
                                                })
                                    })
                                }
                            })
                    },
                    saveTask(obj){                      
                        if(obj.id == ''){
                            axios.post("/api/add_task/",obj)
                            .then((response)=>{
                            this.$refs.childComponent.resetForm();             
                            this.getTask()      
                            this.isModalVisible = false;
                                Swal.fire({
                                    icon: "success",
                                    title:"Tarea Agregada"
                                })

                            })
                            .catch((error) =>
                            {
                                console.log(error);
                            })
                        }else{
                            axios.post("/api/update_edit_task/",obj)
                            .then((response)=>{
                            this.$refs.childComponent.resetForm();             
                            this.getTask()      
                            this.isModalVisible = false;
                                Swal.fire({
                                    icon: "success",
                                    title:"Tarea Actualizada"
                                })

                            })
                            .catch((error) =>
                            {
                                console.log(error);
                            })
                        }
            // const formData = new FormData()
            // formData.append('title',form.value.title)
            // formData.append('description',form.value.description)
            // formData.append('details',form.value.details)
            // formData.append('user_id',form.value.user_id)         
           
        },      
   }
      
   } 

    
 </script>


