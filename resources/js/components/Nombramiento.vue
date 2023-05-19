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
                            <b-dropdown-item class="activo active" v-if="rol == 1" href="/nombramientos">Nombramientos</b-dropdown-item>
                            <b-dropdown-item v-if="rol == 1" href="/puestos">Puestos</b-dropdown-item>
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
            <b-row align-h="end">
              <b-button size="sm" class="botones mb-4" v-b-modal.modal-crear>Crear Nombramiento</b-button>
            </b-row>

            <!-- Inicio modal crear -->

            <b-modal centered id="modal-crear" title="Nuevo Nombramiento" hide-footer>
                    <b-form @submit.prevent="crear">
                      <b-row>
                        <!-- Antiguo autocomplete -->
                        <!-- <b-col cols="12">
                          <label>Empleado</label>
                          <vue-bootstrap-typeahead
                            class="mb-4"
                            v-model="nombre"
                            size="sm"
                            :data="usuarios"
                            :serializer="seleccionado => seleccionado.name"
                            @hit="empleadoSeleccionado = $event"
                            placeholder="Tecleé el nombre del empleado"
                          />
                          <div v-if="nombre !== '' " class="mb-2">
                            <span> <b>Empleado seleccionado:</b> {{empleadoSeleccionado.name}}</span><br>
                            <span> <b>Adscripción:</b> {{empleadoSeleccionado.adscripcion}}</span>
                            <br>
                          </div>                         
                        </b-col> -->
                        <b-col cols="12">
                          <label>Empleado:</label>
                          <b-form-input list="empleado" v-model="nombramiento.id_user" autocomplete="off" required>
                          </b-form-input>
                          <datalist id="empleado">
                            <option v-for="usuario in usuarios">{{ usuario.nombreCompleto }}</option>  
                          </datalist>
                          <span class="span">Seleccione un usuario de la lista</span>
                        </b-col>
                        <b-col cols="12" class="mb-4">
                          <label>Tipo:</label>
                          <b-form-input id="tipo"  name="tipo" v-model="nombramiento.tipo" autocomplete="off" style="text-transform:uppercase" required>
                          </b-form-input>
                        </b-col>
                        <b-col cols="6">
                          <label>Fecha de Emisión:</label>
                          <b-form-input type="date" v-model="nombramiento.fecEmis" placeholder="Seleccione una fecha" required>
                          </b-form-input>
                        </b-col>
                        <b-col cols="6">
                          <label>Fecha de Ratificación:</label>
                          <b-form-input type="date" v-model="nombramiento.fecRatif" required>
                          </b-form-input>
                        </b-col>
                      </b-row>
                      <b-row class="mt-4 mb-4">
                          <b-col cols="1">
                              <b-button class="botones" type="submit">Guardar</b-button>
                          </b-col>
                      </b-row>
                    </b-form>
            </b-modal>

            <!-- Inicio modal editar -->

            <b-modal centered id="modal-editar" title="Editar Nombramiento" hide-footer>
                    <b-form @submit.prevent="editar(nombramiento_)">
                      <b-row>
                        <!-- Antiguo autocomplete -->
                        <!-- <b-col cols="12" class="mb-4" v-if="siEdita == 0">
                          <label size="sm">Empleado</label>
                          <b-form-input size="sm" v-model="nombramiento_.empleado" @click="edita()">
                          </b-form-input>
                        </b-col>
                        <b-col cols="12" v-if="siEdita == 1">
                          <label>Empleado</label>
                          <vue-bootstrap-typeahead
                            class="mb-4"
                            v-model="nombramiento_.empleado"
                            size="sm"
                            :data="usuarios"
                            :serializer="seleccionado => seleccionado.name"
                            @hit="empleadoSeleccionado = $event"
                            placeholder="Tecleé el nombre del empleado"
                          />
                          <div v-if="nombre !== '' " class="mb-2">
                            <span> <b>Empleado seleccionado:</b> {{empleadoSeleccionado.name}}</span><br>
                            <span> <b>Adscripción:</b> {{empleadoSeleccionado.adscripcion}}</span>
                            <br>
                          </div>
                        </b-col> -->
                        <b-col cols="12">
                          <label>Empleado</label>
                          <b-form-input list="empleado" v-model="nombramiento_.id_user" autocomplete="off">
                          </b-form-input>
                          <datalist id="empleado">
                            <option v-for="usuario in usuarios">{{ usuario.nombreCompleto }}</option>  
                          </datalist>
                        </b-col>
                        <b-col cols="12" class="mb-4">
                          <label>Tipo</label>
                          <b-form-input id="tipo" name="tipo" v-model="nombramiento_.tipo" style="text-transform:uppercase">
                          </b-form-input>
                        </b-col>
                        <b-col cols="6">
                          <label>Fecha de Emisión</label>
                          <b-form-input id="fecEmis" name="fecEmis" type="date" v-model="nombramiento_.fecEmis">
                          </b-form-input>
                        </b-col>
                        <b-col cols="6">
                          <label>Fecha de Ratificación</label>
                          <b-form-input id="fecRatif" name="fecRatif" type="date" v-model="nombramiento_.fecRatif">
                          </b-form-input>
                        </b-col>
                      </b-row>
                      <b-row align-h="end" class="mt-4 mb-4">
                          <b-col>
                              <b-button class="botones mr-2" type="submit">Editar</b-button>
                              <b-button class="botones" @click="cancelar()">Cancelar</b-button>
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
                class=" table striped hover table-sm"
                :items="nombramientos"
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
                  <b-button size="sm" class="botones" @click="cargarDatos(row.item)" v-b-modal.modal-editar 
                    v-b-tooltip.hover title="Haga click si desea editar el nombramiento">
                    <b-icon icon="pencil-square"></b-icon>
                  </b-button>
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
          { key: 'tipo', label: 'Tipo', class: 'text-center small', sortable: true, sortDirection: 'desc' },
          { key: 'fecEmis', label: 'Fecha de Emisión', class: 'text-center small', sortable: true, sortDirection: 'desc' },
          { key: 'fecRatif', label: 'Fecha de Ratificación', class: 'text-center small', sortable: true, sortDirection: 'desc' },
          { key: 'actions', class: 'text-center small', label: 'Acciones' }
        ],
        siEdita :'0',
        msgResult:'',
        rol:'',
        usrActual:'',
        usuarios:[],
        nombre:'',
        noEditado:'',
        nombramientos:[],
        nombramiento:{
          id_user:'',
          tipo:'',
          fecEmis:'',
          fecRatif:''
        },
        nombramiento_:{
          id_user:'',
          tipo:'',
          fecEmis:'',
          fecRatif:''
        },
        empleadoSeleccionado:{
          id:'',
          name:'',
          adscripcion:''
        },
        usrExistente:{
          id:'',
          name:'',
          adscripcion:''
        },
        resultado_empleado:'',
        resultado_empleado_:'',
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
        axios.get('/nombramiento')
        .then(res=>{
            this.nombramientos = res.data;
        })
        axios.get('/rol')
        .then(res=>{
            this.rol = res.data;
        })
        axios.get('/usrActual')
        .then(res=>{
            this.usrActual = res.data;
        })
        axios.get('/usuario')
        .then(res=>{
            this.usuarios = res.data;
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
          return this.nombramientos.length;
        },
    },
    mounted() {
      // Set the initial number of items
      this.totalRows = this.nombramientos.length
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
      edita(){
        this.siEdita = 1;
      },
      crear(){
        this.msgResult='',
        this.showMsgBoxCrear(); //Modal confirmación

      },
      showMsgBoxCrear(){
        this.$bvModal.msgBoxConfirm(`¿ Confirma que desea guardar el nuevo nombramiento?`, {
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
                  var id_user = this.nombramiento.id_user
                  var id_user_filter = this.usuarios.filter(function(e){
                  return e.nombreCompleto === id_user                
                })
                console.log(id_user_filter);
                for( var resultado of id_user_filter){
                  this.resultado_empleado = resultado.id
                }
                console.log(this.resultado_empleado); 
              const params={
                id_user: this.resultado_empleado,
                tipo: this.nombramiento.tipo,
                fecEmis: this.nombramiento.fecEmis,
                fecRatif: this.nombramiento.fecRatif
              }
              console.log(params);
              axios.post('/nombramiento', params)
              .then(res=>{
                //ocultar modal
                this.$bvModal.hide('modal-crear');
                this.nombramientos.push(res.data)
                //mostrar toaster
                this.$toaster.success('Nombramiento creado con éxito!')
                //Limpiamos los campos
                this.nombramiento.id_user = '';
                this.nombramiento.tipo = '';
                this.nombramiento.fecEmis = '';
                this.nombramiento.fecRatif = '';
                //recargamos cambios
                axios.get('/nombramiento')
                .then(res=>{
                    this.nombramientos = res.data;
                })
                .catch((error) => {
                            if (error) {
                                this.$toaster.error('Lo sentimos, el nombramiento no se pudo crear ')
                                console.log(error);
                            }
                    })
                })
              }
            })
      },
      cargarDatos(item){
        this.nombramiento_.id_nombramiento = item.id_nombramiento,
        this.nombramiento_.id_user = item.id_user,
        this.nombramiento_.tipo = item.tipo,
        this.nombramiento_.fecEmis = item.fecEmis,
        this.nombramiento_.fecRatif = item.fecRatif
      },
      editar(item){
        this.msgResult='';
        this.showMsgBoxEditar(item); //Modal confirmación
      },
      showMsgBoxEditar(item){
        this.$bvModal.msgBoxConfirm(`¿ Confirma que desea editar el nombramiento actual ?`, {
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
              var id_user_ = item.id_user
              var id_user_filter_ = this.usuarios.filter(function(e){
              return e.nombreCompleto === id_user_                
            })
            console.log(id_user_filter_);
            for( var resultado_ of id_user_filter_){
              this.resultado_empleado_ = resultado_.id
            }
            console.log(this.resultado_empleado_);   
            const params = {
              id_nombramiento : item.id_nombramiento,
              id_user: this.resultado_empleado_,
              tipo: item.tipo,
              fecEmis: item.fecEmis,
              fecRatif: item.fecRatif
            }
            axios.put(`/nombramiento/${item.id_nombramiento}`, params)
              .then(res =>{
                //ocultar modal
                this.$bvModal.hide('modal-editar');
                const index = this.nombramientos.findIndex(
                  nombramientoBuscar => nombramientoBuscar.id_nombramiento === item.id_nombramiento
                )
                this.nombramientos[index] = res.data
                //mostrar toaster
                this.$toaster.success('Nombramiento actualizado con éxito')
                //Limpiamos los campos
                this.nombramiento_.id_user = '';
                this.nombramiento_.tipo = '';
                this.nombramiento_.fecEmis = '',
                this.nombramiento_.fecRatif = '',
                
                this.siEdita = 0;            
                //Recargamos los cambios
                axios.get('/nombramiento')
                .then(res=>{
                    this.nombramientos = res.data;

                })
                .catch((error) => {
                  if (error) {
                    this.$toaster.error('Ha ocurrido un error')
                    console.log(error);
                  }
                })
            })
          }
          /* Antiguo autocomplete */
          /* if(value){
            if(this.empleadoSeleccionado.id === ''){
              console.log('El id viene vacío');
              var existente = this.usuarios.filter(function(e){
                return e.name == item.empleado
              })
              this.usrExistente = existente;
              //Obtenemos el id
              for(var nuevo of existente){
                this.noEditado = nuevo.id
              }
              //Inicio
                const params = {
                  id_nombramiento : item.id_nombramiento,
                  empleado: this.noEditado,
                  tipo: item.tipo,
                  fecEmis: item.fecEmis,
                  fecRatif: item.fecRatif
                }
                axios.put(`/nombramiento/${item.id_nombramiento}`, params)
                .then(res =>{
                  //ocultar modal
                  this.$bvModal.hide('modal-editar');
                  const index = this.nombramientos.findIndex(
                    nombramientoBuscar => nombramientoBuscar.id_nombramiento === item.id_nombramiento
                  )
                  this.nombramientos[index] = res.data
                  //mostrar toaster
                  this.$toaster.success('Nombramiento actualizado con éxito')
                  //Limpiamos los campos
                  this.nombramiento_.empleado = '';
                  this.nombramiento_.tipo = '';
                  this.nombramiento_.fecEmis = '',
                  this.nombramiento_.fecRatif = '',
                  
                  this.siEdita = 0;            
                  //Recargamos los cambios
                  axios.get('/nombramiento')
                  .then(res=>{
                      this.nombramientos = res.data;

                  })
                  .catch((error) => {
                    if (error) {
                      this.$toaster.error('Ha ocuurido un error')
                      console.log(error);
                    }
                  })
                })
              //Fin
            }
            else{
              const params = {
                id_nombramiento : item.id_nombramiento,
                empleado: this.empleadoSeleccionado.id,
                tipo: item.tipo,
                fecEmis: item.fecEmis,
                fecRatif: item.fecRatif
              }
              axios.put(`/nombramiento/${item.id_nombramiento}`, params)
              .then(res =>{
                //ocultar modal
                this.$bvModal.hide('modal-editar');
                const index = this.nombramientos.findIndex(
                  nombramientoBuscar => nombramientoBuscar.id_nombramiento === item.id_nombramiento
                )
                this.nombramientos[index] = res.data
                //mostrar toaster
                this.$toaster.success('Nombramiento actualizado con éxito')
                //Limpiamos los campos
                this.nombramiento_.empleado = '';
                this.nombramiento_.tipo = '';
                this.nombramiento_.fecEmis = '',
                this.nombramiento_.fecRatif = '',
                
                this.siEdita = 0;            
                //Recargamos los cambios
                axios.get('/nombramiento')
                .then(res=>{
                    this.nombramientos = res.data;

                })
                .catch((error) => {
                  if (error) {
                    this.$toaster.error('Ha ocuurido un error')
                    console.log(error);
                  }
                })
              })
            }
          } */
        })
      },
      cancelar(){
            this.$bvModal.hide('modal-editar');
            this.siEdita = 0;
      },
      logout() {
            axios.post('/logout')
            .then(res=>{
                window.location.href = '/login';
            })              
      },
      pruebas(item){
        console.log(item);
      }
    }
  }
</script>

<style scoped>
.general{
  font-family: 'Montserrat', sans-serif;
  font-size: 12px;
}
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
.span{
  color:#B38E5D;
  font-size:14px;
}
</style>