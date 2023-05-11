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
                <b-col>
                  <label for="empleado">Usuario:</label>  
                  <b-form-input readonly id="empleado" v-model="calificacion_.id_user"></b-form-input>
                </b-col>
                <b-col>
                  <label for="empleado">Curso:</label>
                  <b-form-input readonly id="empleado" v-model="calificacion_.id_curso"></b-form-input>
                </b-col>
              </b-row>
              <b-row>
                <b-col>
                  <label for="cursoFin">Curso finalizado:</label>
                  <p v-if="calificacion_.cursoFin">
                    <b-form-input readonly id="cursoFin" value="Si"></b-form-input>
                  </p>
                  <p v-else>
                    <b-form-input readonly id="cursoFin" value="No"></b-form-input>
                  </p>
                </b-col>
                <b-col>
                  <label for="aprobado">Curso Aprobado:</label>
                  <p v-if="calificacion_.aprobado">
                    <b-form-input readonly id="aprobado" value="Si"></b-form-input>
                  </p>
                  <p v-else>
                    <b-form-input readonly id="aprobado" value="No"></b-form-input>
                  </p>
                </b-col>
                <b-col>
                  <label for="cursoOblig">Curso Obligatorio:</label>
                  <p v-if="calificacion_.cursoOblig">
                    <b-form-input readonly id="cursoOblig" value="Si"></b-form-input>
                  </p>
                  <p v-else>
                    <b-form-input readonly id="cursoOblig" value="No"></b-form-input>
                  </p>
                </b-col>
                <b-col>
                  <label for="calif">Calificación:</label>
                  <b-form-input readonly id="calif" v-model="calificacion_.calif"></b-form-input>
                </b-col>
              </b-row>
              <b-row>
                <b-col>
                  <label for="hrsCap">Horas de Capacitación:</label>
                  <b-form-input readonly id="hrsCap" v-model="calificacion_.hrsCap"></b-form-input>
                </b-col>
                <b-col>
                  <label for="fecha">Fecha de finalización:</label>
                  <b-form-input readonly id="fecha" v-model="calificacion_.fecha"></b-form-input>
                </b-col>
                <b-col>
                  <label for="cursoOblig">Tipo de Curso:</label>
                  <p v-if="calificacion_.cursoIntExt">
                    <b-form-input readonly id="cursoOblig" value="Externo"></b-form-input>
                  </p>
                  <p v-else>
                    <b-form-input readonly id="cursoOblig" value="Interno"></b-form-input>
                  </p>
                </b-col>
              </b-row>
              <b-row>
                <b-col>
                  <label for="id_institucion">Institución que imparte:</label>
                  <b-form-input readonly id="id_institucion" v-model="calificacion_.id_institucion"></b-form-input>
                </b-col>
              </b-row>
              <b-row>
                <b-col>
                  <label for="difundidoDP">Difundido por la Dirección de Profesionalización:</label>
                  <p v-if="calificacion_.difundidoDP">
                    <b-form-input readonly id="difundidoDP" value="Si"></b-form-input>
                  </p>
                  <p v-else>
                    <b-form-input readonly id="difundidoDP" value="No"></b-form-input>
                  </p>
                </b-col>
                <b-col>
                  <label for="modalidad">Modalidad:</label>
                  <b-form-input readonly id="modalidad" v-model="calificacion_.modalidad"></b-form-input>
                </b-col>
              </b-row>
              <hr>
              <b-row>
                <b-col cols="12">
                  <label>Constancia:</label>
                  <br> 
                  <a v-if="calificacion_.urlConstancia" :href="calificacion_.urlConstancia" target="blank">Descargar constancia</a>
                  <p v-else>Sin constancia</p>
                  <!-- <iframe src='storage/constancias/IDkmXqU6mKX4RaUNgn2eiBzANTRum2A3v7CXktAY.pdf' height="100%" width="100%" scrolling="auto"></iframe> -->
                </b-col>
              </b-row>
              <br>
            </b-modal>

            <!-- Inicio modal rechazo  -->

            <b-modal centered id="modal-rechazar" title="Rechazar curso registrado" hide-footer>
                    <p style="color: #9d2449;">Está a punto de rechazar el curso seleccionado. <b-icon icon="exclamation-circle-fill" variant="danger"></b-icon></p>
                    <b-form @submit.prevent="editar(calificacion_)">
                      <b-row>
                        <b-col>
                          <label>Antes de continuar, ingrese los motivos de rechazo:</label>
                          <b-form-textarea
                            rows="3"
                            max-rows="6"
                            v-model="calificacion_.rechazo"
                          ></b-form-textarea>
                        </b-col>
                      </b-row>
                      <b-row class="mt-4 mb-4">
                          <b-col cols="1">
                              <b-button class="botones" type="submit">Rechazar</b-button>
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
                        @click="validar(row.item)" v-if="row.item.id_estatus == 'Registrado'"
                        v-b-tooltip.hover title="Haga click para validar el curso">
                        <b-icon icon="check-square"></b-icon>
                    </b-button>
                    <b-button size="sm" class="botones" 
                        @click="cargarDatos(row.item)" v-if="row.item.id_estatus == 'Registrado'" v-b-modal.modal-rechazar
                        v-b-tooltip.hover title="Haga click para rechazar el curso">
                        <b-icon icon="x-circle"></b-icon>
                    </b-button>                    
                </template>

                <template v-slot:cell(id_estatus)="row">
                  <p v-if="row.item.id_estatus === 'Registrado'"> <span>Registrado</span></p>
                  <p v-if="row.item.id_estatus === 'Rechazado'"> <span style="color: red;">Rechazado</span></p>                  
                  <p v-if="row.item.id_estatus === 'Validado'"> <span style="color: green;">Validado</span></p>
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
          { key: 'id_user', label: 'Empleado', class: 'text-center small', sortable: true, sortDirection: 'desc' },
          { key: 'id_curso', label: 'Curso', class: 'text-center small', sortable: true, sortDirection: 'desc' },
          { key: 'calif', label: 'Calificación', class: 'text-center small', sortable: true, sortDirection: 'desc' },
          { key: 'fecha', label: 'Fecha', class: 'text-center small', sortable: true, sortDirection: 'desc' },
          { key: 'id_estatus', label: 'Estatus', class: 'text-center small', sortable: true, sortDirection: 'desc' },
          { key: 'actions', class: 'text-center small', label: 'Acciones' }
        ],
        link: 'http://google.com',
        msgResult:'',
        rol:'',
        usrActual:'',
        calificaciones:[],
        calificacion:{
          id_user:'',
          id_curso:'',
          cursoFin:'',
          aprobado:'',
          cursoOblig:'',
          calif:'',
          hrsCap:'',
          fecha:'',
          anio:'',
          cursoIntExt:'',
          id_institucion:'',
          difundidoDP:'',
          modalidad:'',
          urlConstancia:'',
          nombreConstancia:'',
          id_estatus:''
        },
        calificacion_:{
          id_calificacion:'',
          id_user:'',
          id_curso:'',
          cursoFin:'',
          aprobado:'',
          cursoOblig:'',
          calif:'',
          hrsCap:'',
          fecha:'',
          anio:'',
          cursoIntExt:'',
          id_institucion:'',
          difundidoDP:'',
          modalidad:'',
          urlConstancia:'',
          nombreConstancia:'',
          id_estatus:'',
          rechazo:''
        },
        usuario: null,
        usuarios: [
          { value: 'A', text: 'Luis de Jesús Soria Zavala' },
          { value: 'B', text: 'Juan Manuel Vázquez Martínez' }
        ],
        cursoOblig: null,
        cursoObligs: [
          { value: 'A', text: 'Obligatorio' },
          { value: 'B', text: 'Optativo' }
        ],
        difundidoDP: null,
        difundidoDPs: [
          { value: 'A', text: 'Si' },
          { value: 'B', text: 'No' }
        ],
        checked: true,
        cursoIntExt: true,
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
      crear(){
        this.msgResult='',
        this.showMsgBoxCrear(); //Modal confirmación

      },
      showMsgBoxCrear(){
        this.$bvModal.msgBoxConfirm(`¿ Confirma que desea guardar el nuevo puesto?`, {
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
                descripcion: this.puesto.descripcion
              }
              axios.post('/puesto', params)
              .then(res=>{
                //ocultar modal
                this.$bvModal.hide('modal-crear');
                this.puestos.push(res.data)
                //mostrar toaster
                this.$toaster.success('Puesto creado con éxito!')
                //Limpiamos los campos
                this.puesto.descripcion = '';
                //recargamos cambios
                axios.get('/puesto')
                .then(res=>{
                    this.puestos = res.data;
                })
                .catch((error) => {
                            if (error) {
                                this.$toaster.error('Lo sentimos, el puesto no se pudo crear ')
                                console.log(error);
                            }
                    })
                })
              }
            })
      },
      cargarDatos(item){
        this.calificacion_.id_calificacion = item.id_calificacion
        this.calificacion_.id_user = item.id_user,
        this.calificacion_.id_curso = item.id_curso,
        this.calificacion_.cursoFin = item.cursoFin,
        this.calificacion_.aprobado = item.aprobado,
        this.calificacion_.cursoOblig = item.cursoOblig,
        this.calificacion_.calif = item.calif,
        this.calificacion_.hrsCap = item.hrsCap,
        this.calificacion_.fecha = item.fecha,
        this.calificacion_.anio = item.anio,
        this.calificacion_.cursoIntExt = item.cursoIntExt,
        this.calificacion_.id_institucion = item.id_institucion,
        this.calificacion_.difundidoDP = item.difundidoDP,
        this.calificacion_.modalidad = item.modalidad,
        this.calificacion_.urlConstancia = item.urlConstancia,
        this.calificacion_.nombreConstancia = item.nombreConstancia,
        this.calificacion_.id_estatus = item.id_estatus
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
            axios.put(`calificacion/${item.id_calificacion}`, params)
            //axios.put(`calificacion/rechazar/${item.id_calificacion}`, params)
            .then(res =>{
              //ocultar modal
              this.$bvModal.hide('modal-rechazar');
              const index = this.calificaciones.findIndex(
                calificacionBuscar => calificacionBuscar.id_calificacion === item.id_calificacion
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
                  this.$toaster.error('Ha ocuurido un error')
                  console.log(error);
                }
              })
            })
          }
        })
      },
      /* rechazar(item){
        this.cargarDatos(item);
        this.msgResult='';
        this.showMsgBoxRechazar(item); //Modal confirmación
      },
      showMsgBoxRechazar(item){
        this.$bvModal.msgBoxConfirm('¿Está seguro de rechazar el curso? esta acción no se puede revertir',
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
                    console.log(item.id_calificacion);
                    const params = {
                      rechazo: this.rechazo,
                    }
                    console.log(params);
                    console.log(this.calificacion_.id_calificacion);
                    axios.put(`calificacion/rechazar/${item.id_calificacion}`, params)
                    .then(res => {
                        //ocultar modal
                        this.$bvModal.hide('modal-rechazar');
                        const index = this.calificaciones.findIndex(
                          calificacionBuscar => calificacionBuscar.id_calificacion === item.id_calificacion
                        )
                        this.calificaciones[index] = res.data
                        //mostrar toaster
                        this.$toaster.success('¡Adscripción actualizada con éxito')
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
      }, */
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
                        console.log(item.id_calificacion);
                        axios.post(`calificacion/validar/${item.id_calificacion}`)
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
</style>