<template>
    <nav class="sb-topnav navbar navbar-expand navbar-dark bg-dark">           
            <a class="navbar-brand ps-3" >To-Do</a>       
            <button class="btn btn-link btn-sm order-1 order-lg-0 me-4 me-lg-0" id="sidebarToggle" href="#!"><i class="fas fa-bars"></i></button>

            <ul class="navbar-nav ms-auto mr-md-0 me-3 me-lg-4">
                            <h5 class="text-center" style="color:white">{{currentUser.email}}</h5> 
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" id="navbarDropdown" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false"><i class="fas fa-user fa-fw"></i></a>
                    <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">                  
                        <li><hr class="dropdown-divider" /></li>
                        <li class="text-center"> <a type="button" @click.prevent="logout">Cerrar Sesión<i class="fas fa-sign-out-alt"></i></a></li>
                    </ul>
                </li>
            </ul>
    </nav>
        <div id="layoutSidenav">
            <div id="layoutSidenav_nav">
                <nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
                    <div class="sb-sidenav-menu">
                        <div class="nav">
                            <div class="sb-sidenav-menu-heading">Tarea</div>
                            <router-link exact-active-class="active" to="/"  class="nav-link active" aria-current="page" >
                                <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                                Lista de Tareas
                            </router-link>                          
                        </div>
                    </div>                  
                </nav>
            </div>
            <div id="layoutSidenav_content">
                <main>
                    <div class="container-fluid px-4">
                      <p></p>
                        <div class="card mb-4">
                            <div class="card-header">
                                <i class="fas fa-table me-1"></i>
                               
                            </div>
                            <div >
                                
                                   <router-view></router-view>
                             
                            </div>
                        </div>
                    </div>
                </main>
                <footer class="py-4 bg-light mt-auto">
                    <div class="container-fluid px-4">
                        <div class="d-flex align-items-center justify-content-between small">
                            <div class="text-muted"> &copy; 2022</div>                          
                        </div>
                    </div>
                </footer>
            </div>
        </div> 
</template>
<script>
export default {
    data(){
        return{
            user: null,
              currentUser: {},
              token: localStorage.getItem('token')
        }
    },
    methods:{
     logout(){
       
                axios.post('api/logout').then((response) => {
                    localStorage.removeItem('token')
                    this.$router.push('/login')
                }).catch((errors) => {
                    console.log(errors)
                })
            }
    },
   mounted() {
            window.axios.defaults.headers.common['Authorization'] = `Bearer ${this.token}`
            // this.getEmployees()
            axios.get('api/user').then((response) => {
                this.currentUser = response.data;              
            }).catch((errors) => {
                console.log(errors)
            })
        }
}
</script>
