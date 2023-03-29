<template>
<div>
    <b-navbar toggleable="lg" class="background-nav" type="dark">
        <img v-bind:src="'img/logo-header.svg'" class="logo-gobmx">
        <!-- Right aligned nav items -->
            <b-navbar-nav class="ml-auto">
                <b-nav-item-dropdown v-if="rol == 1" text="Catálogos" class="mr-4" right>
                        <b-dropdown-item v-if="rol == 1" href="/adscripciones">Areas</b-dropdown-item>
                        <b-dropdown-item v-if="rol == 1" href="/cursos">Cursos</b-dropdown-item>
                        <b-dropdown-item v-if="rol == 1" href="/estados">Estados</b-dropdown-item>
                        <b-dropdown-item v-if="rol == 1" href="/grados">Grados de estudio</b-dropdown-item>
                        <b-dropdown-item v-if="rol == 1" href="/instituciones">Instituciones</b-dropdown-item>
                        <b-dropdown-item v-if="rol == 1" href="/niveles">Niveles</b-dropdown-item>
                        <b-dropdown-item v-if="rol == 1" href="/nombramientos">Nombramientos</b-dropdown-item>
                        <b-dropdown-item v-if="rol == 1" href="/puestos">Puestos</b-dropdown-item>
                        <b-dropdown-item v-if="rol == 1" href="/usuarios">Usuarios</b-dropdown-item>
                </b-nav-item-dropdown>
                <b-nav-item-dropdown v-if="rol == 1" text="Administración" class="mr-4" right>
                        <b-dropdown-item v-if="rol == 1" href="/kardex">Kardex</b-dropdown-item>
                        <b-dropdown-item v-if="rol == 1" href="/calificaciones">Validación de cursos externos</b-dropdown-item>
                </b-nav-item-dropdown>
                <b-nav-item-dropdown v-if="rol == 1 || rol == 2" text="Servicios" class="mr-4" right>
                        <b-dropdown-item v-if="rol == 1 || rol == 2" href="/capturar">Capturar cursos</b-dropdown-item>
                </b-nav-item-dropdown>
                <b-nav-item-dropdown right>
                    <!-- Using 'button-content' slot -->
                    <template #button-content>
                        <em>{{usrActual}}</em>
                    </template>
                    <b-dropdown-item href="#" @click.prevent="logout">Cerrar Sesión</b-dropdown-item>
                </b-nav-item-dropdown>
            </b-navbar-nav>
    </b-navbar>
    <br> <br> <br>
    <center><h1>Bienvenidos al Sistema: <br> "Expediente Electrónico de Capacitación"</h1></center>
    <div class="col d-flex justify-content-center">
        <b-card
            class="text-center mt-4"
        >
            <b-card-text class="text-center">
                <img v-bind:src="'img/bienvenida.png'" class="img_central">
                <br> <br>
                <p>Usuario actual: <strong class="texto"> <span style="color:#9d2449">{{usrActual}}</span> </strong></p> 
            </b-card-text>
        </b-card>
    </div>
</div>
</template>

<script>
export default {
    data() {
    return {
        autenticado: '',
        usrActual: '',
        rol: ''
    }
    },
    created(){
        axios.get('/autenticado')
        .then(res=>{
            this.autenticado = res.data;
        })
        axios.get('/usrActual')
        .then(res=>{
            this.usrActual = res.data;
        })
        axios.get('/rol')
        .then(res=>{
            this.rol = res.data;
        })        
    },
    methods:{
        logout() {
            axios.post('/logout')
            .then(res=>{
                window.location.href = '/login';
            })              
        },
    }
}
</script>


<style scoped>
.background-nav{
background-color: #13322B;
}
.logo-gobmx{
width: 451px;
height: 48px;
}
.botones{
background-color: #13322B !important;
border-color: #13322B !important;
color: white !important;
}
.botones:hover{
background-color: #B38E5D !important;
border-color: #B38E5D !important;
color: #fff !important;
}
.img_central{
width: 358px;
height: 358px;
margin-left: auto;
margin-right: auto;
}
h1{
color: #285C4D !important;
}
</style>