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
                            <b-dropdown-item v-if="rol == 1" href="/puestos">Puestos</b-dropdown-item>
                            <b-dropdown-item v-if="rol == 1" href="/sedes">Sedes</b-dropdown-item>
                            <!-- <b-dropdown-item v-if="rol == 1" href="/usuarios">Usuarios</b-dropdown-item> -->
                    </b-nav-item-dropdown>
                    <b-nav-item-dropdown v-if="rol == 1" text="Administración" class="mr-4" right>
                            <b-dropdown-item v-if="rol == 1" href="/kardex">Kardex</b-dropdown-item>
                            <b-dropdown-item class="activo active" v-if="rol == 1" href="/calificaciones">Validación de cursos externos</b-dropdown-item>
                            
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
          <!-- <div>
            <b-tabs content-class="mt-3">
              <b-tab title="Cursos Registrados" active><p>I'm the first tab</p></b-tab>
              <b-tab title="Second"><p>I'm the second tab</p></b-tab>
              <b-tab title="Disabled" disabled><p>I'm a disabled tab!</p></b-tab>
            </b-tabs>
          </div> -->

            <h3 class="my-4">Listado de cursos</h3>

            <!-- Inicio modal detalles -->

            <b-modal centered id="modal-detalles" scrollable size="xl" title="Detalles del Curso" hide-footer>
              <b-row>
                <b-col cols="12" lg="6">
                  <b-form-group
                      label-for="usuario_id" 
                      label-size="sm" 
                      label="Usuario:">
                      <b-form-input readonly id="usuario_id" size="sm" v-model="calificacion_.usuario_id"></b-form-input>
                  </b-form-group>
                </b-col>
                <b-col cols="12" lg="6">
                  <b-form-group
                      label-for="curso_id" 
                      label-size="sm" 
                      label="Curso:">
                      <b-form-input readonly id="curso_id" size="sm" v-model="calificacion_.curso_id"></b-form-input>
                  </b-form-group>
                </b-col>
              </b-row>
              <b-row>
                <b-col cols="12" lg="3">
                  <b-form-group
                      label-for="curso_fin" 
                      label-size="sm" 
                      label="Curso finalizado:">
                      <p v-if="calificacion_.curso_fin">
                        <b-form-input readonly id="curso_fin" size="sm" value="Si"></b-form-input>
                      </p>
                      <p v-else>
                        <b-form-input readonly id="curso_fin" size="sm" value="No"></b-form-input>
                      </p>
                  </b-form-group>
                </b-col>
                <b-col cols="12" lg="3">
                  <b-form-group
                      label-for="aprobado" 
                      label-size="sm" 
                      label="Curso Aprobado:">
                      <p v-if="calificacion_.aprobado">
                        <b-form-input readonly id="aprobado" size="sm" value="Si"></b-form-input>
                      </p>
                      <p v-else>
                        <b-form-input readonly id="aprobado" size="sm" value="No"></b-form-input>
                      </p>
                  </b-form-group>
                </b-col>
                <b-col cols="12" lg="3">
                  <b-form-group
                      label-for="curso_oblig" 
                      label-size="sm" 
                      label="Curso Obligatorio:">
                      <p v-if="calificacion_.curso_oblig">
                        <b-form-input readonly id="curso_oblig" size="sm" value="Si"></b-form-input>
                      </p>
                      <p v-else>
                        <b-form-input readonly id="curso_oblig" size="sm" value="No"></b-form-input>
                      </p>
                  </b-form-group>
                </b-col>
                <b-col cols="12" lg="3">
                  <b-form-group
                      label-for="calif" 
                      label-size="sm" 
                      label="Calificación:">
                      <b-form-input readonly id="calif" size="sm" v-model="calificacion_.calif"></b-form-input>
                  </b-form-group>
                </b-col>
              </b-row>
              <b-row>
                <b-col cols="12" lg="4">
                  <b-form-group
                      label-for="hrs_cap" 
                      label-size="sm" 
                      label="Horas de Capacitación:">
                      <b-form-input readonly id="hrs_cap" size="sm" v-model="calificacion_.hrs_cap"></b-form-input>
                  </b-form-group>
                </b-col>
                <b-col cols="12" lg="4">
                  <b-form-group
                      label-for="fecha" 
                      label-size="sm" 
                      label="Fecha de finalización:">
                      <b-form-input readonly id="fecha" size="sm" v-model="calificacion_.fecha"></b-form-input>
                  </b-form-group>
                </b-col>
                <b-col cols="12" lg="4">
                  <b-form-group
                      label-for="curso_int_ext" 
                      label-size="sm" 
                      label="Tipo de Curso:">
                      <p v-if="calificacion_.curso_int_ext">
                        <b-form-input readonly id="curso_int_ext" size="sm" value="Externo"></b-form-input>
                      </p>
                      <p v-else>
                        <b-form-input readonly id="curso_int_ext" size="sm" value="Interno"></b-form-input>
                      </p>
                  </b-form-group>
                </b-col>
              </b-row>
              <b-row>
                <b-col cols="12" lg="12">
                  <b-form-group
                      label-for="institucion_id" 
                      label-size="sm" 
                      label="Institución que imparte:">
                      <b-form-input readonly id="institucion_id" size="sm" v-model="calificacion_.institucion_id"></b-form-input>
                  </b-form-group>
                </b-col>
              </b-row>
              <b-row>
                <b-col cols="12" lg="6">
                  <b-form-group
                      label-for="difundido_DP" 
                      label-size="sm"
                      label="Difundido por la Dirección de Profesionalización:">
                      <p v-if="calificacion_.difundido_DP">
                        <b-form-input readonly id="difundido_DP" size="sm" value="Si"></b-form-input>
                      </p>
                      <p v-else>
                        <b-form-input readonly id="difundido_DP" size="sm" value="No"></b-form-input>
                      </p>
                  </b-form-group>
                </b-col>
                <b-col cols="12" lg="6">
                  <b-form-group
                      label-for="modalidad" 
                      label-size="sm"
                      label="Modalidad:">
                    <b-form-input readonly id="modalidad" size="sm" v-model="calificacion_.modalidad"></b-form-input>
                  </b-form-group>
                </b-col>
              </b-row>
              <hr>
              <b-row>
                <b-col cols="12" lg="12">
                  <b-form-group
                      label-for="url_constancia" 
                      label-size="sm"
                      label="Constancia:">
                      <a v-if="calificacion_.url_constancia" :href="calificacion_.url_constancia" id="url_constancia" size="sm" target="blank">Descargar constancia</a>
                      <p v-else id="url_constancia" size="sm">Sin constancia</p>
                      <!-- <iframe src='storage/constancias/IDkmXqU6mKX4RaUNgn2eiBzANTRum2A3v7CXktAY.pdf' height="100%" width="100%" scrolling="auto"></iframe> -->
                  </b-form-group>
                </b-col>
              </b-row>
              <br>
            </b-modal>

            <!-- Inicio modal rechazo  -->

            <b-modal centered id="modal-rechazar" title="Rechazar curso registrado" hide-footer>
                    <p class="tarjeta" style="color: #9d2449;">Está a punto de rechazar el curso seleccionado. <b-icon icon="exclamation-circle-fill" variant="danger"></b-icon></p>
                    <b-form @submit.prevent="editar(calificacion_)">
                      <b-row>
                        <b-col>
                          <b-form-group
                              label-for="rechazo" 
                              label-size="sm"
                              label="Antes de continuar, ingrese los motivos de rechazo:">
                              <b-form-textarea
                                id="rechazo"
                                size="sm"
                                rows="3"
                                max-rows="6"
                                v-model="calificacion_.rechazo"
                              ></b-form-textarea>
                          </b-form-group>
                        </b-col>
                      </b-row>
                      <b-row class="mt-4 mb-4">
                          <b-col cols="1">
                              <b-button class="botones" size="sm" type="submit">Rechazar</b-button>
                          </b-col>
                      </b-row>
                    </b-form>
            </b-modal>

            <b-container fluid>
                <!-- User Interface controls -->
                <b-row>
                    <b-col cols="3" class="mb-4">
                        <b-form-group
                        label=""
                        label-for="filter-input"
                        label-size="sm"
                        class="mb-0"
                        >
                        <b-input-group size="sm">
                            <b-form-input
                            id="filter-input"
                            v-model="filter"
                            type="search"
                            placeholder="Buscar"
                            ></b-form-input>

                            <b-input-group-append>
                            <b-button  class="botones" @click="filter = ''">Limpiar</b-button>
                            </b-input-group-append>
                        </b-input-group>
                        </b-form-group>
                    </b-col>
                </b-row>

                <!-- Main table element -->
                <b-table striped hover
                class="table table-sm"
                :items="calificaciones"
                :fields="fields"
                :current-page="currentPage"
                :per-page="perPage"
                :filter="filter"
                :filter-included-fields="filterOn"
                :sort-by.sync="sortBy"
                :sort-desc.sync="sortDesc"
                :sort-direction="sortDirection"
                empty-text="Sin registros por mostrar"
                stacked="md"
                show-empty
                small
                @filtered="onFiltered"
                >
                <template #cell(name)="row">
                    {{ row.value.first }} {{ row.value.last }}
                </template>

                <template #cell(actions)="row">
                    <b-button size="sm" class="detalles" 
                        @click="cargarDatos(row.item)" v-b-modal.modal-detalles
                        v-b-tooltip.hover title="Haga click si desea ver los detalles del curso">
                        <b-icon icon="eye"></b-icon>
                    </b-button>
                    <b-button size="sm" class="botones" 
                        @click="validar(row.item)" v-if="row.item.estatus_id == 'Registrado'"
                        v-b-tooltip.hover title="Haga click para validar el curso">
                        <b-icon icon="check-square"></b-icon>
                    </b-button>
                    <b-button size="sm" class="botones" 
                        @click="cargarDatos(row.item)" v-if="row.item.estatus_id == 'Registrado'" v-b-modal.modal-rechazar
                        v-b-tooltip.hover title="Haga click para rechazar el curso">
                        <b-icon icon="x-circle"></b-icon>
                    </b-button>                    
                </template>

                <template v-slot:cell(estatus_id)="row">
                  <p v-if="row.item.estatus_id === 'Registrado'"> <span>Registrado</span></p>
                  <p v-if="row.item.estatus_id === 'Rechazado'"> <span style="color: red;">Rechazado</span></p>                  
                  <p v-if="row.item.estatus_id === 'Validado'"> <span style="color: green;">Validado</span></p>
                </template>

                <template #row-details="row">
                    <b-card>
                    <ul>
                        <li v-for="(value, key) in row.item" :key="key">{{ key }}: {{ value }}</li>
                    </ul>
                    </b-card>
                </template>
                </b-table>

                <b-row align-h="end">
                    <b-col cols="3" class="my-1">
                        <b-form-group
                        label="Mostrar por página"
                        label-for="per-page-select"
                        label-cols-sm="6"
                        label-cols-md="4"
                        label-cols-lg="3"
                        label-align-sm="right"
                        label-size="sm"
                        class="mb-0"
                        >
                        <b-form-select
                            id="per-page-select"
                            v-model="perPage"
                            :options="pageOptions"
                            size="sm"
                        ></b-form-select>
                        </b-form-group>
                    </b-col>
                </b-row>
                <b-row align-h="end">
                    <b-col cols="3" class="my-1">
                        <b-pagination
                        v-model="currentPage"
                        :total-rows="totalregistros"
                        :per-page="perPage"
                        align="fill"
                        size="sm"
                        class="my-0"
                        ></b-pagination>
                    </b-col>
                </b-row>

                <!-- Info modal -->
                <b-modal :id="infoModal.id" :title="infoModal.title" ok-only @hide="resetInfoModal">
                <pre>{{ infoModal.content }}</pre>
                </b-modal>
            </b-container>
        </div>
    </div>
</template>

<script>
  export default {
    data() {
      return {
        fields: [
          { key: 'usuario_id', label: 'Empleado', class: 'text-center small', sortable: true, sortDirection: 'desc' },
          { key: 'curso_id', label: 'Curso', class: 'text-center small', sortable: true, sortDirection: 'desc' },
          { key: 'calif', label: 'Calificación', class: 'text-center small', sortable: true, sortDirection: 'desc' },
          { key: 'fecha', label: 'Fecha', class: 'text-center small', sortable: true, sortDirection: 'desc' },
          { key: 'estatus_id', label: 'Estatus', class: 'text-center small', sortable: true, sortDirection: 'desc' },
          { key: 'actions', class: 'text-center small', label: 'Acciones' }
        ],
        link: 'http://google.com',
        msgResult:'',
        rol:'',
        usrActual:'',
        calificaciones:[],
        calificacion:{
          usuario_id:'',
          curso_id:'',
          curso_fin:'',
          aprobado:'',
          curso_oblig:'',
          calif:'',
          hrs_cap:'',
          fecha:'',
          anio:'',
          curso_int_ext:'',
          institucion_id:'',
          difundido_DP:'',
          modalidad:'',
          url_constancia:'',
          nombre_constancia:'',
          estatus_id:''
        },
        calificacion_:{
          id:'',
          usuario_id:'',
          curso_id:'',
          curso_fin:'',
          aprobado:'',
          curso_oblig:'',
          calif:'',
          hrs_cap:'',
          fecha:'',
          anio:'',
          curso_int_ext:'',
          institucion_id:'',
          difundido_DP:'',
          modalidad:'',
          url_constancia:'',
          nombre_constancia:'',
          estatus_id:'',
          rechazo:''
        },
        usuario: null,
        usuarios: [
          { value: 'A', text: 'Luis de Jesús Soria Zavala' },
          { value: 'B', text: 'Juan Manuel Vázquez Martínez' }
        ],
        curso_oblig: null,
        curso_obligs: [
          { value: 'A', text: 'Obligatorio' },
          { value: 'B', text: 'Optativo' }
        ],
        difundido_DP: null,
        difundido_DPs: [
          { value: 'A', text: 'Si' },
          { value: 'B', text: 'No' }
        ],
        checked: true,
        curso_int_ext: true,
        totalRows: 1,
        currentPage: 1,
        perPage: 5,
        pageOptions: [5, 10, 15, { value: 100, text: "Mostrar más" }],
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
        axios.get('/calificacion')
        .then(res=>{
            this.calificaciones = res.data;
        })
        axios.get('/rol')
        .then(res=>{
            this.rol = res.data;
        })
        axios.get('/usrActual')
        .then(res=>{
            this.usrActual = res.data;
        })
    },
    computed: {
      sortOptions() {
        // Create an options list from our fields
        return this.fields
          .filter(f => f.sortable)
          .map(f => {
            return { text: f.label, value: f.key }
          })
      },
      totalregistros(){
          return this.calificaciones.length;
        },
    },
    mounted() {
      // Set the initial number of items
      this.totalRows = this.calificaciones.length
    },
    methods: {
      info(item, index, button) {
        this.infoModal.title = `Row index: ${index}`
        this.infoModal.content = JSON.stringify(item, null, 2)
        this.$root.$emit('bv::show::modal', this.infoModal.id, button)
      },
      resetInfoModal() {
        this.infoModal.title = ''
        this.infoModal.content = ''
      },
      onFiltered(filteredItems) {
        // Trigger pagination to update the number of buttons/pages due to filtering
        this.totalRows = filteredItems.length
        this.currentPage = 1
      },
      cargarDatos(item){
        this.calificacion_.id = item.id
        this.calificacion_.usuario_id = item.usuario_id,
        this.calificacion_.curso_id = item.curso_id,
        this.calificacion_.curso_fin = item.curso_fin,
        this.calificacion_.aprobado = item.aprobado,
        this.calificacion_.curso_oblig = item.curso_oblig,
        this.calificacion_.calif = item.calif,
        this.calificacion_.hrs_cap = item.hrs_cap,
        this.calificacion_.fecha = item.fecha,
        this.calificacion_.anio = item.anio,
        this.calificacion_.curso_int_ext = item.curso_int_ext,
        this.calificacion_.institucion_id = item.institucion_id,
        this.calificacion_.difundido_DP = item.difundido_DP,
        this.calificacion_.modalidad = item.modalidad,
        this.calificacion_.url_constancia = item.url_constancia,
        this.calificacion_.nombre_constancia = item.nombre_constancia,
        this.calificacion_.estatus_id = item.estatus_id
        //Rechazo
        this.calificacion_.rechazo = item.rechazo;
      },
      editar(item){
        this.msgResult='';
        this.showMsgBoxEditar(item); //Modal confirmación
      },
      showMsgBoxEditar(item){
        this.$bvModal.msgBoxConfirm(`¿ Confirma que desea rechazar el curso ?`, {
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
            const params = {
              rechazo: item.rechazo,
            }
            console.log(params);
            axios.put(`calificacion/${item.id}`, params)
            //axios.put(`calificacion/rechazar/${item.id}`, params)
            .then(res =>{
              //ocultar modal
              this.$bvModal.hide('modal-rechazar');
              const index = this.calificaciones.findIndex(
                calificacionBuscar => calificacionBuscar.id === item.id
              )
              this.calificaciones[index] = res.data
              //mostrar toaster
              this.$toaster.success('Curso rechazado con éxito')
              //Recargamos los cambios
              axios.get('/calificacion')
                .then(res=>{
                    this.calificaciones = res.data
                })
              .catch((error) => {
                if (error) {
                  this.$toaster.error('Ha ocurrido un error')
                  console.log(error);
                }
              })
            })
          }
        })
      },
      validar(item){
          this.$bvModal.msgBoxConfirm('¿Está seguro de validar el curso? esta acción no se puede revertir',
              {
                title: 'Confirmar autorización',
                okTitle: 'Si',
                cancelTitle: 'Cancelar',
                centered: true,
                footerClass: 'p-2',
                hideHeaderClose: false,
              })
              .then(value => {
                    if (value){
                        //iniciar spinner
                        var loader =  this.$loading.show({
                        container: null
                        });
                        console.log(item.id);
                        axios.post(`calificacion/validar/${item.id}`)
                        .then(res => {
                            console.log(res.data);
                            //ocultar spinner
                            loader.hide();
                            //mostrar toaster
                            this.$toaster.success('¡Curso validado con éxito!')
                            //Refrescamos cambios
                            axios.get('/calificacion')
                            .then(res=>{
                                this.calificaciones = res.data;
                            })
                                                        
                            })
                            .catch((error) => {
                                      if (error) {
                                          this.$toaster.error('Ha ocurrido un error :( ')
                                          //Ocultar Overlay
                                          loader.hide();
                                          console.log(error);
                                      }
                            });                 
                    }               
              })
                
      },
      cancelar(){
            this.$bvModal.hide('modal-editar');
      },
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

.detalles{
  background-color: #13322B !important;
  border-color: #13322B !important;
  color: white !important;
}
.detalles:hover{
  background-color: #B38E5D !important;
  border-color: #B38E5D !important;
  color: #fff !important;
}
.detalles:focus{
  background-color: #13322B !important;
  border: solid #a42145 !important;
  color:  white !important;
}
.activo{
  background-color: #D4C19C !important;
}
.tarjeta{
  font-size: 14px;
}
</style>