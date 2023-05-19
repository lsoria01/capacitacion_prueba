<template>
    <div>
        <b-navbar toggleable="lg" class="background-nav" type="dark">
          <a href="/home"><img v-bind:src="'img/logo-header.svg'" class="logo-gobmx"></a>
          <!-- Right aligned nav items -->
                    <b-navbar-nav class="ml-auto">
                      <b-nav-item-dropdown v-if="rol == 1" text="Catálogos" class="mr-4" right>
                            <b-dropdown-item v-if="rol == 1" href="/adscripciones">Areas</b-dropdown-item>
                            <b-dropdown-item class="activo active" v-if="rol == 1" href="/cursos">Cursos</b-dropdown-item>
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
              <b-button size="sm" class="botones mb-4" v-b-modal.modal-crear>Crear Curso</b-button>
            </b-row>

            <!-- Inicio modal crear -->

            <b-modal centered id="modal-crear" size="xl" title="Nuevo Curso" hide-footer>
                    <b-form @submit.prevent="crear">
                      <b-row>
                        <b-col cols="10">
                          <label>Nombre:</label>
                          <b-form-input id="nombre" name="nombre" v-model="curso.nombre" style="text-transform:uppercase" autocomplete="off" required>
                          </b-form-input>
                        </b-col>
                        <b-col cols="2">
                          <label for="">¿Curso Obligatorio?</label>
                          <b-form-checkbox v-model="curso.cursoOblig" name="cursoOblig" switch required>
                            <b v-if="curso.cursoOblig"> Si</b> <b v-else>No</b>
                          </b-form-checkbox>
                        </b-col>
                      </b-row>
                      <br>
                      <b-row>
                        <b-col cols="4">
                          <label for="fecha_inicio">Fecha de inicio:</label>
                          <b-form-datepicker id="fecha_inicio" v-model="curso.fecha_inicio" placeholder="" required></b-form-datepicker>
                        </b-col>
                        <b-col cols="4">
                          <label for="fecha_fin">Fecha de fin:</label>
                          <b-form-datepicker id="fecha_fin" v-model="curso.fecha_fin" placeholder="" required></b-form-datepicker>
                        </b-col>
                        <b-col cols="2">
                          <label>Hrs de Capacitación:</label>
                          <b-form-input type="number" v-model="curso.hrsCap" required>
                          </b-form-input>
                        </b-col>
                        <b-col cols="2">
                          <label for="">Curso Interno o Externo:</label>
                            <b-form-checkbox v-model="curso.cursoIntExt" name="cursoIntExt" switch required>
                            <b v-if="curso.cursoIntExt"> Externo</b> <b v-else>Interno</b>
                          </b-form-checkbox>
                        </b-col>
                      </b-row>
                      <br>
                      <b-row>
                        <b-col cols="2">
                          <label for="">Difundido por la DP:</label>
                          <b-form-select v-model="curso.difundidoDP" :options="difundidoDPs" required></b-form-select>
                        </b-col>
                        <b-col cols="10">
                          <label for="id_institucion">Institución:</label>
                          <b-form-input list="id_institucion" v-model="curso.id_institucion" autocomplete="off" required>
                          </b-form-input>
                          <span class="span">Seleccione una institución de la lista</span>
                          <datalist id="id_institucion">
                            <option v-for="institucion in instituciones">{{ institucion.descripcion }}</option>  
                          </datalist>                          
                        </b-col>
                      </b-row>
                      <br>
                      <b-row>
                        <b-col cols="2">
                          <label>Id Curso:</label>
                          <b-form-input id="folio" name="folio" v-model="curso.folio" autocomplete="off" required>
                          </b-form-input>
                        </b-col>
                        <b-col cols="3">
                          <label>Modalidad:</label>
                          <b-form-select v-model="curso.modalidad" :options="modalidads" required></b-form-select>
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

            <b-modal centered id="modal-editar" size="xl" title="Editar Curso" hide-footer>
                    <b-form @submit.prevent="editar(curso_)">
                      <b-row>
                        <b-col cols="10">
                          <label>Nombre:</label>
                          <b-form-input id="nombre" name="nombre" v-model="curso_.nombre" style="text-transform:uppercase">
                          </b-form-input>
                          <span class="span">Si desea cambiar el nombre, deberá borrar el existente y seleccionar uno nuevo</span>
                        </b-col>
                        <b-col cols="2">
                          <label for="">¿Curso Obligatorio?</label>
                          <b-form-checkbox v-model="curso_.cursoOblig" name="check-button" switch>
                            <b v-if="curso_.cursoOblig"> Si</b> <b v-else>No</b>
                          </b-form-checkbox>
                        </b-col>
                      </b-row>
                      <br>
                      <b-row>
                        <b-col cols="4">
                          <label for="fecha_inicio">Fecha de inicio:</label>
                          <b-form-datepicker id="fecha_inicio" v-model="curso_.fecha_inicio" placeholder=""></b-form-datepicker>
                        </b-col>
                        <b-col cols="4">
                          <label for="fecha_fin">Fecha de fin:</label>
                          <b-form-datepicker id="fecha_fin" v-model="curso_.fecha_fin" placeholder=""></b-form-datepicker>
                        </b-col>
                        <b-col cols="2">
                          <label>Hrs de Capacitación:</label>
                          <b-form-input type="number" v-model="curso_.hrsCap">
                          </b-form-input>
                        </b-col>
                        <b-col cols="2">
                          <label for="">Curso Interno o Externo:</label>
                            <b-form-checkbox v-model="curso_.cursoIntExt" switch>
                            <b v-if="curso_.cursoIntExt"> Externo</b> <b v-else>Interno</b>
                          </b-form-checkbox>
                        </b-col>
                      </b-row>
                      <br>
                      <b-row>
                        <b-col cols="2">
                          <label for="">Difundido por la DP:</label>
                          <b-form-select v-model="curso_.difundidoDP" :options="difundidoDPs"></b-form-select>
                        </b-col>
                        <b-col cols="10">
                          <label for="id_institucion">Institución:</label>
                          <b-form-input list="id_institucion" v-model="curso_.id_institucion" autocomplete="off">
                          </b-form-input>
                          <span class="span">Si desea cambiar la Institución, deberá borrar la existente y seleccionar una nueva</span>
                          <datalist id="id_institucion">
                            <option v-for="institucion in instituciones">{{ institucion.descripcion }}</option>  
                          </datalist>                          
                        </b-col>
                      </b-row>
                      <br>
                      <b-row>
                        <b-col cols="2">
                          <label>Id Curso:</label>
                          <b-form-input id="folio" name="folio" v-model="curso_.folio">
                          </b-form-input>
                        </b-col>
                        <b-col cols="3">
                          <label>Modalidad:</label>
                          <b-form-select v-model="curso_.modalidad" :options="modalidads" required></b-form-select>
                        </b-col>
                      </b-row>
                      <b-row class="mt-4 mb-4">
                          <b-col cols="1">
                              <b-button class="botones" type="submit">Editar</b-button>
                          </b-col>
                      </b-row>
                    </b-form>
            </b-modal>

            <!-- Inicio modal detalles -->

            <b-modal centered id="modal-detalles" size="xl" title="Detalles del Curso" ok-only>
                      <b-row>
                        <b-col cols="10">
                          <label>Nombre:</label>
                          <b-form-input id="nombre" name="nombre" v-model="curso_.nombre" readonly>
                          </b-form-input>
                        </b-col>
                        <b-col cols="2">
                          <label for="">¿Curso Obligatorio?</label> 
                          <br>
                          <b-form-input v-if="curso_.cursoOblig" readonly value="Si"></b-form-input>
                          <b-form-input v-if="curso_.cursoOblig === false" readonly value="No"></b-form-input>
                          <b-form-input v-if="curso_.cursoOblig === null " readonly value="Sin información"></b-form-input>
                        </b-col>
                      </b-row>
                      <br>
                      <b-row>
                        <b-col cols="4">
                          <label for="fecha_inicio">Fecha de inicio:</label>
                          <b-form-datepicker id="fecha_inicio" v-model="curso_.fecha_inicio" readonly></b-form-datepicker>
                        </b-col>
                        <b-col cols="4">
                          <label for="fecha_fin">Fecha de fin:</label>
                          <b-form-datepicker id="fecha_fin" v-model="curso_.fecha_fin" readonly></b-form-datepicker>
                        </b-col>
                        <b-col cols="2">
                          <label>Hrs de Capacitación:</label>
                          <b-form-input v-model="curso_.hrsCap" readonly>
                          </b-form-input>
                        </b-col>
                        <b-col cols="2">
                          <label for="">Curso Int. o Ext. :</label>
                          <b-form-input v-if="curso_.cursoIntExt" readonly value="Externo"></b-form-input>
                          <b-form-input v-else readonly value="Interno"></b-form-input>
                        </b-col>
                      </b-row>
                      <br>
                      <b-row>
                        <b-col cols="2">
                          <label for="">Difundido por la DP:</label>
                          <b-form-input v-if="curso_.difundidoDP" readonly value="Si"></b-form-input>
                          <b-form-input v-if="curso_.difundidoDP === false" readonly value="No"></b-form-input>
                          <b-form-input v-if="curso_.difundidoDP === null " readonly value="Sin información"></b-form-input>
                        </b-col>
                        <b-col cols="10">
                          <label for="id_institucion">Institución:</label>
                          <b-form-input list="id_institucion" v-model="curso_.id_institucion" autocomplete="off" readonly>
                          </b-form-input>
                          <datalist id="id_institucion">
                            <option v-for="institucion in instituciones">{{ institucion.descripcion }}</option>  
                          </datalist>                          
                        </b-col>
                      </b-row>
                      <br>
                      <b-row>
                        <b-col cols="2">
                          <label>Id Curso:</label>
                          <b-form-input v-if="curso_.folio === null " readonly value="Sin información"></b-form-input>
                          <b-form-input v-if="curso_.folio" readonly v-model="curso_.folio"></b-form-input>
                        </b-col>
                        <b-col cols="3">
                          <label>Modalidad:</label>
                          <b-form-input v-model="curso_.modalidad" readonly></b-form-input>
                        </b-col>
                      </b-row>
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
                :items="cursos"
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
                      v-b-tooltip.hover title="Haga click si desea editar el curso">
                      <b-icon icon="pencil-square"></b-icon>
                    </b-button>
                    <b-button size="sm" class="botones" @click="cargarDatos(row.item)" v-b-modal.modal-detalles
                      v-b-tooltip.hover title="Haga click si desea ver los detalles del curso">
                      <b-icon icon="eye"></b-icon>
                    </b-button>
                    <b-button size="sm" class="botones" @click="validar(row.item)" 
                    v-if="row.item.id_estatus == 'Registrado'"
                    v-b-tooltip.hover title="Haga click para validar el curso">
                      <b-icon icon="check-square"></b-icon>
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
          { key: 'nombre', label: 'Nombre', class: 'text-center small',  sortable: true, sortDirection: 'desc', thStyle: { width: "25%" } },
          { key: 'fecha_fin', label: 'fecha de fin', class: 'text-center small', sortable: true, sortDirection: 'desc' },
          { key: 'id_institucion', label: 'Institución', class: 'text-center small', sortable: true, sortDirection: 'desc' , thStyle: { width: "25%" } },
          { key: 'folio', label: 'Id Curso', class: 'text-center small', sortable: true, sortDirection: 'desc' },
          { key: 'id_estatus', label: 'Estatus', class: 'text-center small', sortable: true, sortDirection: 'desc' },
          { key: 'actions', label: 'Accioness', class: 'text-center small'},
        ],
        msgResult:'',
        rol:'',
        usrActual:'',
        cursos:[],
        curso:{
          nombre:'',
          fecha_inicio:'',
          fecha_fin:'',
          cursoOblig: false,
          hrsCap: '',
          cursoIntExt:0,
          difundidoDP:'',
          modalidad:'',
          id_estatus:2,
          id_institucion:'',
          folio:''
        },
        curso_:{
          id_curso:'',
          nombre:'',
          fecha_inicio:'',
          fecha_fin:'',
          cursoOblig: false,
          hrsCap: '',
          cursoIntExt: false,
          difundidoDP:'',
          modalidad:'',
          id_estatus:2,
          id_institucion:'',
          folio:''
        },
        instituciones:{
          id_institucion:'',
          descripcion:''
        },
        difundidoDPs: [
          { value: true, text: 'Si' },
          { value: false, text: 'No' }
        ],
        modalidads: [
        { value: 'EN LÍNEA', text: 'EN LÍNEA' },
        { value: 'MIXTO', text: 'MIXTO' },
        { value: 'PRESENCIAL', text: 'PRESENCIAL' }
        ],        
        resultado_institucion:'',
        resultado_institucion_:'',
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
        axios.get('/curso')
        .then(res=>{
            this.cursos = res.data;
        })
        axios.get('/rol')
        .then(res=>{
            this.rol = res.data;
        })
        axios.get('/usrActual')
        .then(res=>{
            this.usrActual = res.data;
        })
        axios.get('/nombreInstituciones')
        .then(res=>{
            this.instituciones = res.data;
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
          return this.cursos.length;
        },
    },
    mounted() {
      // Set the initial number of items
      this.totalRows = this.cursos.length
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
        this.$bvModal.msgBoxConfirm(`¿ Confirma que desea guardar el nuevo curso?`, {
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
                  var institucion = this.curso.id_institucion
                  var institucion_filter = this.instituciones.filter(function(e){
                  return e.descripcion === institucion                
                })
                console.log(institucion_filter);
                for( var resultado of institucion_filter){
                  this.resultado_institucion = resultado.id_institucion
                }
                console.log(this.resultado_institucion);              
                const params={
                nombre: this.curso.nombre,
                fecha_inicio:this.curso.fecha_inicio,
                fecha_fin:this.curso.fecha_fin,
                cursoOblig: this.curso.cursoOblig,
                hrsCap: this.curso.hrsCap,
                cursoIntExt: this.curso.cursoIntExt,
                difundidoDP: this.curso.difundidoDP,
                modalidad: this.curso.modalidad,
                id_estatus: this.curso.id_estatus,
                id_institucion:this.resultado_institucion,
                folio:this.curso.folio
              }
              console.log(params);
               axios.post('/curso', params)
              .then(res=>{
                //ocultar modal
                this.$bvModal.hide('modal-crear');
                this.cursos.push(res.data)
                //mostrar toaster
                this.$toaster.success('Curso creado con éxito!')
                //Limpiamos los campos
                this.curso.nombre = '';
                //recargamos cambios
                axios.get('/curso')
                .then(res=>{
                    this.cursos = res.data;
                })
                .catch((error) => {
                            if (error) {
                                this.$toaster.error('Lo sentimos, el curso no se pudo crear ')
                                console.log(error);
                            }
                    })
                })
              }
            })
      },
      cargarDatos(item){
        this.curso_.id_curso = item.id_curso,
        this.curso_.nombre = item.nombre,
        this.curso_.fecha_inicio = item.fecha_inicio,
        this.curso_.fecha_fin = item.fecha_fin,
        this.curso_.cursoOblig = item.cursoOblig,
        this.curso_.hrsCap = item.hrsCap,
        this.curso_.cursoIntExt = item.cursoIntExt,
        this.curso_.difundidoDP = item.difundidoDP,
        this.curso_.modalidad = item.modalidad,
        this.curso_.id_estatus = item.id_estatus,
        this.curso_.id_institucion = item.id_institucion,
        this.curso_.folio = item.folio
      },
      editar(item){
        this.msgResult='';
        this.showMsgBoxEditar(item); //Modal confirmación
      },
      showMsgBoxEditar(item){
        this.$bvModal.msgBoxConfirm(`¿ Confirma que desea editar el curso actual ?`, {
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
            var institucion_ = item.id_institucion
            var institucion_filter_ = this.instituciones.filter(function(e){
              return e.descripcion === institucion_                
            })
            console.log(institucion_filter_);
            for( var resultado of institucion_filter_){
              this.resultado_institucion_ = resultado.id_institucion
            }
            console.log(this.resultado_institucion_);
            if(item.id_estatus === 'Registrado'){
                this.curso_.id_estatus = 1;
            }else{
                this.curso_.id_estatus = 2;
            } 
            const params = {
              id_curso: item.id_curso,
              nombre: item.nombre,
              fecha_inicio: item.fecha_inicio,
              fecha_fin: item.fecha_fin,
              cursoOblig: item.cursoOblig,
              hrsCap: item.hrsCap,
              cursoIntExt: item.cursoIntExt,
              difundidoDP: item.difundidoDP,
              modalidad: item.modalidad,
              id_institucion:this.resultado_institucion_,
              id_estatus: this.curso_.id_estatus,
              folio: item.folio
            }
            console.log(params);
            axios.put(`/curso/${item.id_curso}`, params)
            .then(res =>{
              //ocultar modal
              this.$bvModal.hide('modal-editar');
              const index = this.cursos.findIndex(
                cursoBuscar => cursoBuscar.id_curso === item.id_curso
              )
              this.cursos[index] = res.data
              //mostrar toaster
              this.$toaster.success('Curso actualizado con éxito')
              //Recargamos los cambios
              axios.get('/curso')
                .then(res=>{
                    this.cursos = res.data
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
                        console.log(item.id_curso);
                        axios.post(`curso/validar/${item.id_curso}`)
                        .then(res => {
                            console.log(res.data);
                            //ocultar spinner
                            loader.hide();
                            //mostrar toaster
                            this.$toaster.success('¡Curso validado con éxito!')
                            //Refrescamos cambios
                            axios.get('/curso')
                            .then(res=>{
                                this.cursos = res.data;
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
.nameOfTheClass {
   max-width: 200px !important;
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
}.activo{
  background-color: #D4C19C !important;
}
.span{
  color:#B38E5D;
  font-size:14px;
}

</style>