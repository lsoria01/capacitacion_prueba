<template>
    <div>
        <b-navbar toggleable="lg" class="background-nav" type="dark">
            <a href="/home"><img v-bind:src="'img/logo-header.svg'" class="logo-gobmx"></a>
        </b-navbar>
        <!-- Alas de fondo -->
        <b-img left v-bind:src="'img/alas5.png'" alt="Escudo" class="alas-login"></b-img>
        <!-- Inicio Formulario -->
        <div class="marco">
            <b-card-group>
                <b-card
                class="borde-login"
                title="Iniciar sesión"
                style="max-width: 35rem;"
                align="center"
                border-variant="borde-login"
                >
                <b-card-text>
                    <b-form @submit.prevent="ingresar">
                        <b-row>
                            <b-col cols="12">
                                <label for="curp" class="mt-4">CURP:</label>
                                <b-form-input id="curp" type="text" name="curp" v-model="curp" maxlength="18"></b-form-input>
                            </b-col>
                            <b-col cols="12">
                                <label for="password">Password:</label>
                                <b-form-input id="password" type="password" name="password" v-model="password"></b-form-input>
                            </b-col>
                            <b-col cols="12">
                                <b-button block type="submit" class="mt-4 float-right botones">Ingresar</b-button>
                            </b-col>
                            <!-- Sección de recuperar contraseña -->
                            <b-col cols="12">
                                <b-button variant="link" class="mt-4 float-right" v-b-modal.modal-reseteo style="font-size:13px;">Recuperar contraseña</b-button>
                            </b-col>                            
                        </b-row>
                    </b-form>
                </b-card-text>
                </b-card>
            </b-card-group>
            <br>            
        </div>
        <!-- Fin formulario -->
        <!-- Modal de confirmación -->
        <b-modal centered id="modal-reseteo" title="Recuperación de contraseña" hide-footer>
            <div class="container">
                <b-form @submit.prevent="validar">
                    <div>
                        <b-row class="my-1">
                            <p class="text-justify">Por favor, introduzca su correo <strong>electrónico institucional</strong></p> <br>
                            <b-col sm="12">
                            <b-form-group>
                            <b-form-input type="text" required v-model="correo" autocomplete="off"></b-form-input>
                            </b-form-group>
                            </b-col>
                        </b-row>
                            <b-button type="submit" class="botones mt-4 mb-4" >Enviar</b-button>
                    </div>
                </b-form>
            </div>
        </b-modal>
        
    </div>
</template>

<script>
export default {
    data(){
        return{
            usuarios: [],
            curp: '',
            password:'',
            correo:'',
            nombreCompleto:'',
            indicio:''
        }

    },

    created(){
        axios.get('/usuario')
        .then(res => {
            this.usuarios = res.data;
        })
    },

    methods:{
        ingresar(){
            const params = {
                curp: this.curp,
                password: this.password              
            }
            axios.post('/login', params)
            .then(res =>{
                window.location.href = `${window.location.origin}/home`;
            })
            .catch((error) => {
                          if (error) {
                              //limpiamos los campos
                              this.curp = '';
                              this.password = '';
                              //Mostrar mensaje de error
                              this.$toaster.error(' Usuario o contraseña incorrectos :( ')
                              //Ocultar Overlay
                              loader.hide();
                              console.log(error);
                          }
                }); 
        },

        validar(){
            //validar curp existente
             var correo = this.correo;
             var resultado = this.usuarios.filter(function(e)
             {
                 return e.correo === correo;
                 
             });
             console.log(resultado);
             if(resultado == ''){
                 //Mostrar mensaje de error
                this.$toaster.error(' El correo ingresado no coincide con los registros del sistema. ')
             }
             else{
                //console.log('siguiente paso');
                this.validar_existente();
             }
            
        },

        validar_existente(){
            for(var usuario of this.usuarios){
                if(this.correo === usuario.correo){
                    this.nombreCompleto = usuario.persona_id;
                    this.indicio = usuario.indicio;
                    //console.log(usuario.correo, usuario.usuario);
                    //console.log('pasa a la función validar_existente');
                    const params = {
                        correo: usuario.correo,
                        usuario: usuario.usuario,
                        indicio: this.indicio,
                        nombreCompleto: this.nombreCompleto
                    }
                    //iniciar spinner
                    var loader =  this.$loading.show({
                    container: null
                    });
                    //ocultar modal
                    this.$bvModal.hide('modal-reseteo');
                    //console.log(this.correo);
                    axios.post('/correo/getMail', params)
                    .then(res =>{
                        console.log(params);
                        //ocultar spinner
                        loader.hide(); 
                        //Mostrar mensaje de confirmación de envío
                        this.$toaster.success( `Se han enviado sus datos de acceso al correo: "${this.correo}" `)
                        //limpiamos los campos
                        this.correo = '';
                    })
                    .catch((error) => {
                          if (error) {
                              //Mostrar mensaje de error
                              this.$toaster.error(' Ha ocurrido un error ')
                              console.log(error);
                          }
                    }); 
                }
            }
            
            return;  
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
.alas-login{
position: fixed;
height: 90%;
bottom: 0;
background-repeat: no-repeat;
}
.marco{
    margin-right: 30%;
    margin-left: 35%;
    margin-top: 8%;
    position: relative;
    align-content: center;
}
.borde-login{
    border:2px solid #B38E5D;
}
.boton{
    background-color:#13322B ;
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
</style>		