<template>
    <div>
        <b-navbar toggleable="lg" class="background-nav" type="dark">
            <img v-bind:src="'img/logo-header.svg'" class="logo-gobmx">
            <!-- Right aligned nav items -->
            <b-navbar-nav class="ml-auto">
                <b-nav-item-dropdown v-if="rol == 1" text="Administración" class="mr-4" right>
                        <b-dropdown-item v-if="rol == 1" href="/adscripciones">Adscripciones</b-dropdown-item>
                        <b-dropdown-item v-if="rol == 1" href="/calificaciones">Calificaciones</b-dropdown-item>
                        <b-dropdown-item v-if="rol == 1" href="/cursos">Cursos</b-dropdown-item>
                        <b-dropdown-item v-if="rol == 1" href="/nombramientos">Nombramientos</b-dropdown-item>
                        <b-dropdown-item v-if="rol == 1" href="/puestos">Puestos</b-dropdown-item>
                        <b-dropdown-item v-if="rol == 1" href="/usuarios">Usuarios</b-dropdown-item>
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
        <div class="container">
            <h3 class="my-4 row justify-content-center">EXPEDIENTE ELECTRÓNICO DE DESARROLLO PROFESIONAL</h3>
            <br> <br>
            <!-- Información del usuario -->
            <div style="padding-left: 90px; padding-right: 90px;" >
                <table class="table striped hover">
                    <thead style="display:none">
                        <tr>
                        <th></th>
                        <th></th>
                        <th></th>
                        <th></th>
                        <th></th>
                        <th></th>
                        </tr>
                    </thead>
                    <tbody style="text-align: center;" v-for="autentic in autenticado" :key="autentic.id">
                        <tr>
                            <th colspan="3" class="renglonUno">ID Empleado</th>
                            <th colspan="3" class="renglonUno">Nombre</th>
                        </tr>
                        <tr>
                            <td colspan="3" class="renglonDos">{{autentic.id}}</td>
                            <td colspan="3" class="renglonDos">{{autentic.name}}</td>
                        </tr>
                        <tr>
                            <th colspan="2" class="renglonUno">Puesto</th>
                            <th colspan="2" class="renglonUno">Nivel</th>
                            <th colspan="2" class="renglonUno">Adscripción</th>
                        </tr>
                        <tr>
                            <td colspan="2">{{autentic.puesto}}</td>
                            <td colspan="2">{{autentic.nivel}}</td>
                            <td colspan="2">{{autentic.adscripcion}}</td>
                        </tr>
                        <tr>
                            <th colspan="6" class="renglonUno">Fecha de ingreso al CFCRL</th>
                        </tr>
                        <tr>
                            <td colspan="6">{{autentic.fechaIngr}}</td>
                        </tr>
                        <tr>
                            <th colspan="2" class="renglonUno">CURP</th>
                            <th colspan="2" class="renglonUno">Correo Electrónico</th>
                            <th colspan="2" class="renglonUno">Fecha</th>
                        </tr>
                        <tr>
                            <td colspan="2">{{autentic.curp}}</td>
                            <td colspan="2">{{autentic.email}}</td>
                            <td colspan="2">27/07/2022</td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <!-- Información del nombramiento -->
            <br> <br>
            <!-- <div style="padding-left: 90px; padding-right: 90px;" >
                <p style="text-align: center;"><b>Nombramiento</b></p>
                <table class="table table-striped">
                    <thead style="text-align: center;">
                        <tr>
                        <th class="renglonUno">Tipo</th>
                        <th class="renglonUno">Fecha de emisión</th>
                        <th class="renglonUno">Ratificación</th>
                        </tr>
                    </thead>
                    <tbody style="text-align: center;" v-for="nombram in nombramiento" :key="nombram.id">
                        <tr>
                            <td>{{nombram.tipo}}</td>
                            <td>{{nombram.fecEmis}}</td>
                            <td>{{nombram.fecRatif}}</td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <br> <br> -->
            <!-- Sección de búsqueda -->
            <p class="my-4 row justify-content-center"><b>Seleccione el año del ejercicio o el periodo de consulta</b></p>
            <b-row>
                <b-col cols="4">
                    <label for="anio">Año</label>
                    <b-form-input id="anio" v-model="anio">año</b-form-input>
                </b-col>
                <b-col cols="2">
                </b-col>

                <b-col cols="3">
                    <label for="anioIni">Año Inicial</label>
                    <b-form-input id="anioIni"></b-form-input>
                </b-col>
                <b-col cols="3">
                    <label for="anioFin">Año Final</label>
                    <b-form-input id="anioFin"></b-form-input>
                </b-col>
            </b-row>
            <br> <br>
            <b-row>
                <b-col cols="3">
                    <b-button class="renglonDos" @click="buscarAnio()">Consultar</b-button>
                </b-col>
                <b-col cols="3">
                    
                </b-col>
                <b-col cols="6">
                    <b-button class="renglonDos" @click="buscarIniFin()">Consultar</b-button>
                </b-col>
            </b-row>
            <br> <br>
            <!-- Historial de horas de capacitación -->
            <div v-if="historial">
                <p class="my-4"><b>A continuación se detalla el historial de las horas de capacitación tomadas en el año 2022:</b></p>
                    <table class="table table-striped" style="text-align: center;">
                        <thead>
                            <tr>
                                <th class="renglonUno">No.</th>
                                <th class="renglonUno">Año</th>
                                <th class="renglonUno">Tipo de curso</th>
                                <th class="renglonUno">Categoría</th>
                                <th class="renglonUno">Nombre del curso</th>
                                <!-- <th class="renglonUno">Calificación</th> -->
                                <!-- <th class="renglonUno">Fecha</th>
                                <th class="renglonUno">ID_Curso</th> -->
                                <th class="renglonUno">Horas de Capacitación</th>
                                <th class="renglonUno">Calificación</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr v-for="calif in resultado" :key="calif.id">
                                <td>{{calif.id_calificacion}}</td>
                                <td>{{calif.anio}}</td>
                                <td>{{calif.cursoOblig}}</td>                                
                                <td>{{calif.categoriaInst}}</td>
                                <td>{{calif.curso}}</td>
                                <td>{{calif.hrsCap}}</td>
                                <td>{{calif.hrsCap}}</td>
                            </tr>
                        </tbody>
                    </table>
                    <br> <br>
                    <div style="margin-left: 60%;">
                        <table class="table table-striped" style="text-align: center;">
                            <thead>
                                <tr>
                                    <th class="renglonUno">No.</th>
                                    <th class="renglonUno">Ejercicio</th>
                                    <th class="renglonUno">TOTAL DE HORAS DE AÑO</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>1</td>
                                    <td>año</td>
                                    <td></td>
                                </tr>
                                <tr>
                                    <td>2</td>
                                    <td>año</td>
                                    <td></td>
                                </tr>
                                <tr>
                                    <td>3</td>
                                    <td>año</td>
                                    <td></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <br> <br>
                    <div class="mb-4">
                        <b-row>
                            <!-- <b-col cols="3">
                                <vue-qr text="www.centrolaboral.gob.mx" :callback="test" qid="testid"></vue-qr>
                            </b-col> -->
                            <b-col cols="9">
                                <div class="my-4 row justify-content-center renglonUno"> Observaciones: </div>
                                <textarea class="form-control" id="observaciones" rows="4"></textarea>
                            </b-col>
                        </b-row>                    
                    </div>
            </div>
        </div>
    </div>
</template>

<script>
export default{
    data(){
        return{
            autenticado:'',
            nombramiento:'',
            usrActual:'',
            calificacion:[],
            anio:'',
            historial:false,
            rol:''
        }
    },
    created(){
        axios.get('/autenticado')
        .then(res=>{
            this.autenticado = res.data;
        })
        axios.get('/nombramientoAuth')
        .then(res=>{
            this.nombramiento = res.data;
        })
        axios.get('/usrActual')
        .then(res=>{
            this.usrActual = res.data;
        })
        axios.get('/calificacion')
        .then(res=>{
            this.calificacion = res.data;
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
        buscarAnio(){
            var anio = this.anio
            var resultado = this.calificacion.filter(function(e){
                return e.anio == anio
            })
            this.resultado = resultado
            console.log(this.resultado);
            this.historial = 1;
            this.anio = '';

        },
        buscarIniFin(){
            console.log('buscarIniFin');
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
.renglonUno{
    background-color: #13322B;
    color: #fff
}
.renglonDos{
    background-color: #B38E5D;
    color: #fff
}
</style>