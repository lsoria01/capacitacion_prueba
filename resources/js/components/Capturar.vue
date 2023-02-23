<template>
  <div>
      <b-navbar toggleable="lg" class="background-nav" type="dark">
        <img v-bind:src="'img/logo-header.svg'" class="logo-gobmx">
        <!-- Right aligned nav items -->
              <b-navbar-nav class="ml-auto">
                  <b-nav-item-dropdown v-if="rol == 1" text="Administración" class="mr-4" right>
                      <b-dropdown-item v-if="rol == 1" href="/home">Home</b-dropdown-item>
                      <b-dropdown-item v-if="rol == 1" href="/adscripciones">Areas</b-dropdown-item>
                      <b-dropdown-item v-if="rol == 1" href="/calificaciones">Calificaciones</b-dropdown-item>
                      <b-dropdown-item v-if="rol == 1" href="/cursos">Cursos</b-dropdown-item>
                      <b-dropdown-item v-if="rol == 1" href="/estados">Estados</b-dropdown-item>
                      <b-dropdown-item v-if="rol == 1" href="/grados">Grados de estudio</b-dropdown-item>
                      <b-dropdown-item v-if="rol == 1" href="/instituciones">Instituciones</b-dropdown-item>
                      <b-dropdown-item v-if="rol == 1" href="/niveles">Niveles</b-dropdown-item>
                      <b-dropdown-item v-if="rol == 1" href="/nombramientos">Nombramientos</b-dropdown-item>
                      <b-dropdown-item v-if="rol == 1" href="/puestos">Puestos</b-dropdown-item>
                      <b-dropdown-item v-if="rol == 1" href="/usuarios">Usuarios</b-dropdown-item>
                  </b-nav-item-dropdown>
                  <b-nav-item-dropdown right>
                      <!-- Using 'button-content' slot -->
                      <template #button-content>
                          <em>{{usrActual}}</em>
                      </template>
                      <b-dropdown-item href="/home">Inicio</b-dropdown-item>
                      <b-dropdown-item href="#" @click.prevent="logout">Cerrar Sesión</b-dropdown-item>
                  </b-nav-item-dropdown>
              </b-navbar-nav>
      </b-navbar>
      <div class="container my-4">
        <b-row>
          <b-col cols="12">
            <b-form-group
              label="Nombre del curso:"
              label-for="curso"
            >
              <b-form-input
                id="curso"
                type="text"
              ></b-form-input>
            </b-form-group>
          </b-col>
        </b-row>
        <b-row>
          <b-col>
            <b-form-group
              label="Calificación:"
              label-for="calificacion"
            >
              <b-form-input
                id="calificacion"
                type="number"
              ></b-form-input>
            </b-form-group>
          </b-col>
          <b-col>
            <b-form-group
              label="Horas de capacitación:"
              label-for="horas"
            >
              <b-form-input
                id="horas"
                type="number"
              ></b-form-input>
            </b-form-group>
          </b-col>
        </b-row>
        <b-row>
          <b-col cols="6">
            <label for="">Institución que emite</label>
            <b-form-select v-model="selected" :options="options"></b-form-select>
          </b-col>
          <b-col v-if="selected == 3" cols="6">
            <b-form-group
              label="Otra:"
              label-for="otra"
            >
              <b-form-input
                id="otra"
                type="text"
              ></b-form-input>
            </b-form-group>
          </b-col>
        </b-row>
        <hr>
        <b-row>
          <b-col>
            <label for="example-datepicker">Fecha de la constancia</label>
              <b-form-datepicker id="example-datepicker" class="mb-2" placeholder="Seleccione una fecha"></b-form-datepicker>
          </b-col>
          <b-col>
            <label for="constancia">Cargar constancia</label>
            <b-form-file
            placeholder="Seleccione un archivo"
            ></b-form-file>
          </b-col>
        </b-row>
        <br>
        <b-row align-h="end">
          <b-button class="botones mb-4">Capturar curso</b-button>
        </b-row>
      </div>
  </div>
</template>

<script>
  export default {
    data() {
      return {
        autenticado: '',
        usrActual: '',
        rol: '',
        selected: null,
        options: [
          { value: null, text: 'Seleccione una opción' },
          { value: '1', text: 'CFCRL' },
          { value: '2', text: 'INAI' },
          { value: '3', text: 'Otra'}
        ]
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
</style>