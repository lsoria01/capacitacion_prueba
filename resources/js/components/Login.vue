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
                        <label for="curp" class="mt-4">CURP:</label>
                        <b-form-input id="curp" type="text" name="curp" v-model="curp" maxlength="18"></b-form-input>
                        <label for="password">Password:</label>
                        <b-form-input id="password" type="password" name="password" v-model="password"></b-form-input>
                        <b-button type="submit" class="mt-4 float-right boton">Ingresar</b-button>
                    </b-form>
                </b-card-text>
                </b-card>
            </b-card-group>
        
        </div>
        <!-- Fin formulario -->
    </div>
</template>

<script>
export default {
    data(){
        return{
            curp: '',
            password:''
        }

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
        test(dataUrl,id){
            console.log(url, id)
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
</style>