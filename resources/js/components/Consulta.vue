<template>
    <div>
        <b-navbar toggleable="lg" class="background-nav" type="dark">
        <img v-bind:src="'img/logo-header.svg'" class="logo-gobmx">
        </b-navbar>
        <div class="container">
            <br> <br>   
            <b-form inline>
                <label class="sr-only" for="inline-form-input-name">Name</label>
                <b-form-input
                id="inline-form-input-name"
                class="mb-2 mr-sm-2 mb-sm-0"
                placeholder="Buscar empleado por ID"
                v-model="palabra"
                ></b-form-input>
                <b-button variant="primary" @click="buscar()">Buscar</b-button>
            </b-form>
            <br> <br>
            <!-- Información del usuario -->
            <div style="padding-left: 90px; padding-right: 90px;" v-for="item in encontrado" :key="item.id">
                <table class="table table-striped">
                    <thead>
                        <tr>
                        <th></th>
                        <th></th>
                        <th></th>
                        <th></th>
                        <th></th>
                        <th></th>
                        </tr>
                    </thead>
                    <tbody style="text-align: center;">
                        <tr>
                            <th colspan="3">ID Empleado</th>
                            <th colspan="3">Nombre</th>
                        </tr>
                        <tr>
                            <td colspan="3">{{item.id}}</td>
                            <td colspan="3">{{item.name}}</td>
                        </tr>
                        <tr>
                            <th colspan="3">Puesto</th>
                            <th colspan="3">Adscripción</th>
                        </tr>
                        <tr>
                            <td colspan="3">{{item.puesto}}</td>
                            <td colspan="3">{{item.adscripcion}}</td>
                        </tr>
                        <tr>
                            <th colspan="2">CURP</th>
                            <th colspan="2">Correo Electrónico</th>
                            <th colspan="2">Fecha</th>
                        </tr>
                        <tr>
                            <td colspan="2">{{item.curp}}</td>
                            <td colspan="2">{{item.email}}</td>
                            <td colspan="2">27/07/2022</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    data() {
        return{
            usuarios:[],
            palabra:'',
            id:'',
            name:'',
            puesto:'',
            adscripcion:'',
            email:'',
            curp:'',
            encontrado:''
        }
        
    },

    created(){
        axios.get('/usuario')
        .then(res=>{
            this.usuarios = res.data;
        }) 
    },

    methods:{
        buscar(){
            var palabra = this.palabra
            var resultado = this.usuarios.filter(function(e){
                return e.id == palabra
            })
            this.encontrado = resultado
            console.log(this.encontrado);      
        }
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
</style>