<template>
    <div>
        <b-navbar toggleable="lg" class="background-nav" type="dark">
          <a href="/home"><img v-bind:src="'img/logo-header.svg'" class="logo-gobmx"></a>
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
                            <b-dropdown-item class="activo active" v-if="rol == 1" href="/puestos">Puestos</b-dropdown-item>
                            <!-- <b-dropdown-item v-if="rol == 1" href="/usuarios">Usuarios</b-dropdown-item> -->
                    </b-nav-item-dropdown>
                    <b-nav-item-dropdown v-if="rol == 1" text="Administración" class="mr-4" right>
                            <b-dropdown-item v-if="rol == 1" href="/kardex">Kardex</b-dropdown-item>
                            <b-dropdown-item v-if="rol == 1" href="/calificaciones">Validación de cursos externos</b-dropdown-item>
                    </b-nav-item-dropdown>
                    <b-nav-item-dropdown v-if="rol == 1 || rol == 2" text="Servicios" class="mr-4" right>
                            <b-dropdown-item v-if="rol == 1 || rol == 2" href="/capturar">Registrar cursos externos</b-dropdown-item>
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
        <div class="container my-4">
            <h3>
                Mi cuenta
                <hr>
            </h3>
            <br>
            <b-tabs content-class="mt-3" v-for="usuario in usuarios" :key="usuario.id">
                <b-tab title="Datos generales" active>
                    <br> <br>
                    <b-row>
                        <b-col cols="">
                            <label>Número de empleado:</label>
                            <b-form-input v-model="usuario.numEmpl" readonly>
                            </b-form-input>
                        </b-col>
                        <b-col cols="">
                            <label>Nombre completo:</label>
                            <b-form-input v-model="usuario.nombreCompleto" readonly>
                            </b-form-input>
                        </b-col>
                        <b-col cols="">
                            <label>Puesto:</label>
                            <b-form-input v-model="usuario.id_puesto" readonly>
                            </b-form-input>
                        </b-col>
                    </b-row>
                    <br>
                    <hr>
                    <br>
                    <b-row>
                        <b-col cols="">
                            <label>Correo:</label>
                            <b-form-input v-model="usuario.email" readonly>
                            </b-form-input>
                        </b-col>
                        <b-col cols="">
                            <label>Adscripción:</label>
                            <b-form-input v-model="usuario.id_adscripcion" readonly>
                            </b-form-input>
                        </b-col>
                    </b-row>
                </b-tab>
                <b-tab title="Contraseña">
                    <br>
                    <h4>Cambio de contraseña</h4>
                    <br>
                    <b-form @submit.prevent="actualizar">
                        <b-row>
                            <b-col cols="">
                                <label>Contraseña actual:</label>
                                <b-form-input type="password" v-model="passwordAnterior" required>
                                </b-form-input>
                            </b-col>
                        </b-row>
                        <br> <hr> <br>
                        <b-row>
                            <b-col cols="">
                                <label>Nueva contraseña:</label>
                                <b-form-input type="password" v-model="password" required>
                                </b-form-input>
                            </b-col>
                            <b-col cols="">
                                <label>Confirmar la contraseña:</label>
                                <b-form-input type="password" v-model="indicio" required>
                                </b-form-input>
                            </b-col>
                            <!-- Mensaje de password correcto -->
                            <b-col cols="2" v-if="password === indicio && password != '' ">
                                <span class="badge badge-success" style="margin-top: 40px;">Password correcto  <b-icon icon="check-square"></b-icon></span>
                                <p class="success"></p>
                            </b-col>
                            <!-- Mensaje de password incorrecto -->
                            <b-col cols="2" v-if="password != indicio && indicio != '' ">
                                <span class="badge badge-danger" style="margin-top: 40px;">Password incorrecto  <b-icon icon="check-square"></b-icon></span>
                                <p class="success"></p>
                            </b-col>
                        </b-row>
                        <b-row align-h="end" class="my-4 mr-2">
                            <b-col cols="1">
                                <b-button class="botones" type="submit">Guardar</b-button>
                            </b-col>
                        </b-row>
                    </b-form>

                </b-tab>
            </b-tabs>
        </div>
    </div>
</template>

<script>
  export default {
    data() {
      return {
        msgResult:'',
        rol:'',
        usrActual:'',
        usuarios:[],
        usuario:{
            id:'',
            numEmpl:'',
            nombreCompleto:'',
            id_puesto:'',
            id_adscripcion:'',
            email:''
        },
        id:'',
        passwordAnterior:'',
        password:'',
        indicio:'',
        totalRows: 1,
        currentPage: 1,
        perPage: 5,
        pageOptions: [5, 10, 15, { value: 100, text: "100" }],
        sortBy: '',
        sortDesc: false,
        sortDirection: 'asc',
        filter: null,
        filterOn: [],
        infoModal: {
          id: 'info-modal',
          title: '',
          content: ''
        }
      }
    },
    created(){
        axios.get('/rol')
        .then(res=>{
            this.rol = res.data;
        })
        axios.get('/usrActual')
        .then(res=>{
            this.usrActual = res.data;
        })
        axios.get('/autenticado')
        .then(res=>{
            this.usuarios = res.data;
        })
        axios.get('/idUsrActual')
        .then(res=>{
            this.id = res.data;
        })
    },
    methods: {
      logout() {
            axios.post('/logout')
            .then(res=>{
                window.location.href = '/login';
            })              
        },
        actualizar(){
            if(this.passwordAnterior === this.indicio){
                this.$toaster.error('La nueva contraseña es igual a la anterior')
                this.passwordAnterior = '';
                this.password = '';
                this.indicio = '';
            }
            else{
                this.msgResult='',
                this.showMsgBoxactualizar(); //Modal confirmación
            }        

        },
        showMsgBoxactualizar(){
            this.$bvModal.msgBoxConfirm(`¿ Confirma que desea cambiar el password? Esta acción no se puede revertir`, {
                    title: 'Aviso',
                    size: 'sm',
                    buttonSize: 'sm',
                    okTitle: 'Aceptar',
                    okColor: '#285C4D',
                    cancelTitle: 'Cancelar',
                    hideHeaderClose: false,
                    centered: true
                })
                .then(value=>{
                if(value){
                const params={
                    password: this.password
                }
                console.log(params);
                axios.put(`usuario/actualizaPassword/${this.id}`, params)
                .then(res=>{
                    console.log(res.data);
                    //mostrar toaster
                    this.$toaster.success('¡Contraseña actualizada con éxito!')
                    //Limpiamos los campos
                    this.passwordAnterior = '';
                    this.password = '';
                    this.indicio = '';
                        })
                }
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
.activo{
  background-color: #D4C19C !important;
}
</style>