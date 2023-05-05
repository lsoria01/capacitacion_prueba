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
            <b-row align-h="end">
              <b-button size="sm" class="botones mb-4" v-b-modal.modal-crear>Crear Puesto</b-button>
            </b-row>

            <!-- Inicio modal crear -->

            <b-modal centered id="modal-crear" title="Nuevo Puesto" hide-footer>
                    <b-form @submit.prevent="crear">
                      <b-row>
                        <b-col cols="12">
                          <label>Nombre:</label>
                          <b-form-input id="descripcion" name="descripcion" v-model="puesto.descripcion" style="text-transform:uppercase">
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

            <b-modal centered id="modal-editar" title="Editar Puesto" hide-footer>
                    <b-form @submit.prevent="editar(puesto_)">
                      <b-row>
                        <b-col cols="12">
                          <label>Nombre:</label>
                          <b-form-input id="descripcion" name="descripcion" v-model="puesto_.descripcion" style="text-transform:uppercase">
                          </b-form-input>
                        </b-col>
                      </b-row>
                      <b-row class="mt-4 mb-4">
                          <b-col cols="1">
                              <b-button class="botones" type="submit">Editar</b-button>
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
                :items="puestos"
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
                    <b-button size="sm" class="botones" @click="cargarDatos(row.item)" v-b-modal.modal-editar>
                        Editar
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
          { key: 'id_puesto', label: 'Número', class: 'text-center small', sortable: true, sortDirection: 'desc' },
          { key: 'descripcion', label: 'Nombre', class: 'text-center small', sortable: true, sortDirection: 'desc' },
          { key: 'actions', class: 'text-center small', label: 'Acciones' }
        ],
        msgResult:'',
        rol:'',
        usrActual:'',
        puestos:[],
        puesto:{
          descripcion:''
        },
        puesto_:{
          id_puesto:'',
          descripcion:''
        },
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
        axios.get('/puesto')
        .then(res=>{
            this.puestos = res.data;
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
          return this.puestos.length;
        },
    },
    mounted() {
      // Set the initial number of items
      this.totalRows = this.puestos.length
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
        this.puesto_.id_puesto = item.id_puesto,
        this.puesto_.descripcion = item.descripcion
      },
      editar(item){
        this.msgResult='';
        this.showMsgBoxEditar(item); //Modal confirmación
      },
      showMsgBoxEditar(item){
        this.$bvModal.msgBoxConfirm(`¿ Confirma que desea editar el puesto actual ?`, {
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
              id_puesto : item.id_puesto,
              descripcion: item.descripcion
            }
            axios.put(`/puesto/${item.id_puesto}`, params)
            .then(res =>{
              //ocultar modal
              this.$bvModal.hide('modal-editar');
              const index = this.puestos.findIndex(
                puestoBuscar => puestoBuscar.id_puesto === item.id_puesto
              )
              this.puestos[index] = res.data
              //mostrar toaster
              this.$toaster.success('¡Puesto actualizado con éxito')
              //Recargamos los cambios
              axios.get('/puesto')
                .then(res=>{
                    this.puestos = res.data
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
.activo{
  background-color: #D4C19C !important;
}
</style>