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
                            <b-dropdown-item v-if="rol == 1" href="/sedes">Sedes</b-dropdown-item>
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
                        <b-col cols="12" lg="9">
                          <b-form-group
                              label-for="nombre" 
                              label-size="sm" 
                              label="Nombre:">
                              <b-form-input id="nombre" size="sm" name="nombre" v-model="curso.nombre" style="text-transform:uppercase" autocomplete="off" required>
                              </b-form-input>
                              </b-form-group>
                        </b-col>
                        <b-col cols="12" lg="3">
                          <b-form-group
                              label-for="curso_oblig" 
                              label-size="sm" 
                              label="¿Curso Obligatorio?">
                              <b-form-checkbox id="curso_oblig" size="sm" v-model="curso.curso_oblig" name="curso_oblig" switch required>
                                <b v-if="curso.curso_oblig"> Si</b> <b v-else>No</b>
                              </b-form-checkbox>
                          </b-form-group>
                        </b-col>
                      </b-row>
                      <br>
                      <b-row>
                        <b-col cols="12" lg="3">
                          <b-form-group
                              label-for="fecha_inicio" 
                              label-size="sm" 
                              label="Fecha de inicio:">
                              <b-form-input id="fecha_inicio" type="date" size="sm" v-model="curso.fecha_inicio" placeholder="" required></b-form-input>
                            </b-form-group>
                        </b-col>
                        <b-col cols="12" lg="3">
                          <b-form-group
                              label-for="fecha_fin" 
                              label-size="sm" 
                              label="Fecha de fin:">
                              <b-form-input id="fecha_fin" type="date" size="sm" v-model="curso.fecha_fin" placeholder="" required></b-form-input>
                            </b-form-group>
                        </b-col>
                        <b-col cols="12" lg="3">
                          <b-form-group
                              label-for="hrs_cap" 
                              label-size="sm" 
                              label="Hrs. de Capacitación:">
                              <b-form-input id="hrs_cap" size="sm" type="number" v-model="curso.hrs_cap" required>
                              </b-form-input>
                          </b-form-group>
                        </b-col>
                        <b-col cols="12" lg="3">
                          <b-form-group
                              label-for="curso_int_ext" 
                              label-size="sm" 
                              label="Curso Interno o Externo:">
                              <label for=""></label>
                              <b-form-checkbox id="curso_int_ext" size="sm" v-model="curso.curso_int_ext" name="curso_int_ext" switch>
                              <b v-if="curso.curso_int_ext"> Externo</b> <b v-else>Interno</b>
                              </b-form-checkbox>
                          </b-form-group>
                        </b-col>
                      </b-row>
                      <br>
                      <b-row>
                        <b-col cols="12" lg="3">
                          <b-form-group
                              label-for="difundido_DP" 
                              label-size="sm" 
                              label="Difundido por la DP:">
                              <b-form-select id="difundido_DP" size="sm" v-model="curso.difundido_DP" :options="difundido_DPs" required></b-form-select>
                          </b-form-group>
                        </b-col>
                        <b-col cols="12" lg="9">
                          <b-form-group
                              label-for="institucion_id" 
                              label-size="sm" 
                              label="Institución:">
                            <b-form-input list="institucion_id" size="sm" v-model="curso.institucion_id" autocomplete="off" required>
                            </b-form-input>
                            <span class="span">Seleccione una institución de la lista</span>
                            <datalist id="institucion_id">
                              <option v-for="institucion in instituciones">{{ institucion.nombre }}</option>  
                            </datalist>
                          </b-form-group>                          
                        </b-col>
                      </b-row>
                      <br>
                      <b-row>
                        <b-col cols="12" lg="2">
                          <b-form-group
                              label-for="identificador_curso" 
                              label-size="sm" 
                              label="Id Curso:">
                              <b-form-input id="identificador_curso" size="sm" name="identificador_curso" v-model="curso.identificador_curso" autocomplete="off" required>
                              </b-form-input>
                          </b-form-group>
                        </b-col>
                        <b-col cols="12" lg="3">
                          <b-form-group
                              label-for="modalidad" 
                              label-size="sm" 
                              label="Modalidad:">
                            <b-form-select id="modalidad" size="sm" v-model="curso.modalidad" :options="modalidads" required></b-form-select>
                          </b-form-group>
                        </b-col>
                      </b-row>
                      <b-row class="mt-4 mb-4">
                          <b-col cols="1">
                              <b-button class="botones" size="sm" type="submit">Guardar</b-button>
                          </b-col>
                      </b-row>
                    </b-form>
            </b-modal>

            <!-- Inicio modal editar -->

            <b-modal centered id="modal-editar" size="xl" title="Editar Curso" hide-footer>
                    <b-form @submit.prevent="editar(curso_)">
                      <b-row>
                        <b-col cols="12" lg="9">
                          <b-form-group
                              label-for="nombre" 
                              label-size="sm" 
                              label="Nombre:">
                              <b-form-input id="nombre" size="sm" name="nombre" v-model="curso_.nombre" style="text-transform:uppercase" autocomplete="off">
                              </b-form-input>
                          </b-form-group>
                        </b-col>
                        <b-col cols="12" lg="3">
                          <b-form-group
                              label-for="curso_oblig" 
                              label-size="sm" 
                              label="¿Curso Obligatorio?">
                              <b-form-checkbox size="sm" id="curso_oblig" v-model="curso_.curso_oblig" name="check-button" switch>
                                <b v-if="curso_.curso_oblig"> Si</b> <b v-else>No</b>
                              </b-form-checkbox>
                          </b-form-group>
                        </b-col>
                      </b-row>
                      <br>
                      <b-row>
                        <b-col cols="12" lg="3">
                          <b-form-group
                              label-for="fecha_inicio" 
                              label-size="sm" 
                              label="Fecha de inicio:">
                              <b-form-input id="fecha_inicio" type="date" size="sm" v-model="curso_.fecha_inicio" placeholder=""></b-form-input>
                          </b-form-group>
                        </b-col>
                        <b-col cols="12" lg="3">
                          <b-form-group
                              label-for="fecha_fin" 
                              label-size="sm" 
                              label="Fecha de fin:">
                              <b-form-input id="fecha_fin" type="date" size="sm" v-model="curso_.fecha_fin" placeholder=""></b-form-input>
                          </b-form-group>
                        </b-col>
                        <b-col cols="12" lg="3">
                          <b-form-group
                              label-for="hrs_cap" 
                              label-size="sm" 
                              label="Hrs de Capacitación:">
                              <b-form-input type="number" id="hrs_cap" size="sm" v-model="curso_.hrs_cap">
                              </b-form-input>
                          </b-form-group>
                        </b-col>
                        <b-col cols="12" lg="3">
                          <b-form-group
                              label-for="curso_int_ext" 
                              label-size="sm" 
                              label="Curso Interno o Externo:">
                              <b-form-checkbox id="curso_int_ext" size="sm" v-model="curso_.curso_int_ext" switch>
                              <b v-if="curso_.curso_int_ext"> Externo</b> <b v-else>Interno</b>
                              </b-form-checkbox>
                          </b-form-group>
                        </b-col>
                      </b-row>
                      <br>
                      <b-row>
                        <b-col cols="12" lg="3">
                          <b-form-group
                              label-for="difundido_DP" 
                              label-size="sm" 
                              label="Difundido por la DP:">
                            <b-form-select id="difundido_DP" size="sm" v-model="curso_.difundido_DP" :options="difundido_DPs"></b-form-select>
                          </b-form-group>
                        </b-col>
                        <b-col cols="12" lg="9">
                          <b-form-group
                              label-for="institucion_id" 
                              label-size="sm" 
                              label="Institución::">
                              <b-form-input list="institucion_id" size="sm" v-model="curso_.institucion_id" autocomplete="off">
                              </b-form-input>
                              <span class="span">Si desea cambiar la Institución, deberá borrar la existente y seleccionar una nueva</span>
                              <datalist id="institucion_id">
                                <option v-for="institucion in instituciones">{{ institucion.nombre }}</option>  
                              </datalist> 
                          </b-form-group>                         
                        </b-col>
                      </b-row>
                      <br>
                      <b-row>
                        <b-col cols="12" lg="2">
                          <b-form-group
                              label-for="identificador_curso" 
                              label-size="sm" 
                              label="Id Curso:">
                            <b-form-input id="identificador_curso" size="sm" name="identificador_curso" v-model="curso_.identificador_curso" autocomplete="off">
                            </b-form-input>
                          </b-form-group>
                        </b-col>
                        <b-col cols="12" lg="3">
                          <b-form-group
                              label-for="modalidad" 
                              label-size="sm" 
                              label="Modalidad:">
                            <b-form-select id="modalidad" size="sm" v-model="curso_.modalidad" :options="modalidads" required></b-form-select>
                          </b-form-group>
                        </b-col>
                      </b-row>
                      <b-row class="mt-4 mb-4">
                          <b-col cols="1">
                              <b-button class="botones" size="sm" type="submit">Editar</b-button>
                          </b-col>
                      </b-row>
                    </b-form>
            </b-modal>

            <!-- Inicio modal detalles -->

            <b-modal centered id="modal-detalles" size="xl" title="Detalles del Curso" ok-only>
                      <b-row>
                        <b-col cols="12" lg="9">
                          <b-form-group
                              label-for="nombre" 
                              label-size="sm" 
                              label="Nombre:">
                              <b-form-input id="nombre" size="sm" name="nombre" v-model="curso_.nombre" readonly>
                              </b-form-input>
                          </b-form-group>
                        </b-col>
                        <b-col cols="12" lg="3">
                          <b-form-group
                              label-for="curso_oblig" 
                              label-size="sm" 
                              label="¿Curso Obligatorio?">
                              <b-form-input id="curso_oblig" size="sm" v-if="curso_.curso_oblig" readonly value="Si"></b-form-input>
                              <b-form-input id="curso_oblig" size="sm" v-if="curso_.curso_oblig === false" readonly value="No"></b-form-input>
                              <b-form-input id="curso_oblig" size="sm" v-if="curso_.curso_oblig === null " readonly value="Sin información"></b-form-input>
                          </b-form-group>
                        </b-col>
                      </b-row>
                      <br>
                      <b-row>
                        <b-col cols="12" lg="3">
                          <b-form-group
                              label-for="fecha_inicio" 
                              label-size="sm" 
                              label="Fecha de inicio:">
                              <b-form-input id="fecha_inicio" type="date" size="sm" v-model="curso_.fecha_inicio" readonly></b-form-input>
                          </b-form-group>
                        </b-col>
                        <b-col cols="12" lg="3">
                          <b-form-group
                              label-for="fecha_fin" 
                              label-size="sm" 
                              label="Fecha de fin:">
                              <b-form-input id="fecha_fin" type="date" size="sm" v-model="curso_.fecha_fin" readonly></b-form-input>
                          </b-form-group>
                        </b-col>
                        <b-col cols="12" lg="3">
                          <b-form-group
                              label-for="hrs_cap" 
                              label-size="sm" 
                              label="Hrs de Capacitación:">
                              <b-form-input id="hrs_cap" size="sm" v-model="curso_.hrs_cap" readonly>
                            </b-form-input>
                          </b-form-group>
                        </b-col>
                        <b-col cols="12" lg="3">
                          <b-form-group
                              label-for="curso_int_ext" 
                              label-size="sm" 
                              label="Curso Int. o Ext. :">
                              <b-form-input id="curso_int_ext" size="sm" v-if="curso_.curso_int_ext" readonly value="Externo"></b-form-input>
                              <b-form-input id="curso_int_ext" size="sm" v-else readonly value="Interno"></b-form-input>
                          </b-form-group>
                        </b-col>
                      </b-row>
                      <br>
                      <b-row>
                        <b-col cols="12" lg="3">
                          <b-form-group
                              label-for="difundido_DP" 
                              label-size="sm" 
                              label="Difundido por la DP:">
                              <b-form-input id="difundido_DP" size="sm" v-if="curso_.difundido_DP" readonly value="Si"></b-form-input>
                              <b-form-input id="difundido_DP" size="sm" v-if="curso_.difundido_DP === false" readonly value="No"></b-form-input>
                              <b-form-input id="difundido_DP" size="sm" v-if="curso_.difundido_DP === null " readonly value="Sin información"></b-form-input>
                          </b-form-group>
                        </b-col>
                        <b-col cols="12" lg="9">
                          <b-form-group
                              label-for="institucion_id" 
                              label-size="sm" 
                              label="Institución:">
                              <b-form-input list="institucion_id" size="sm" v-model="curso_.institucion_id" autocomplete="off" readonly>
                              </b-form-input>
                              <datalist id="institucion_id">
                                <option v-for="institucion in instituciones">{{ institucion.nombre }}</option>  
                              </datalist> 
                          </b-form-group>                         
                        </b-col>
                      </b-row>
                      <br>
                      <b-row>
                        <b-col cols="12" lg="2">
                          <b-form-group
                              label-for="identificador_curso" 
                              label-size="sm" 
                              label="Id Curso:">
                              <b-form-input id="identificador_curso" size="sm" v-if="curso_.identificador_curso === null " readonly value="Sin información"></b-form-input>
                              <b-form-input id="identificador_curso" size="sm" v-if="curso_.identificador_curso" readonly v-model="curso_.identificador_curso"></b-form-input>
                          </b-form-group>
                        </b-col>
                        <b-col cols="12" lg="3">
                          <b-form-group
                              label-for="modalidad" 
                              label-size="sm" 
                              label="Modalidad:">
                              <b-form-input id="modalidad" size="sm" v-model="curso_.modalidad" readonly></b-form-input>
                          </b-form-group>
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
                    v-if="row.item.estatus_id == 'Registrado'"
                    v-b-tooltip.hover title="Haga click para validar el curso">
                      <b-icon icon="check-square"></b-icon>
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
          { key: 'nombre', label: 'Nombre', class: 'text-center small',  sortable: true, sortDirection: 'desc', thStyle: { width: "25%" } },
          { key: 'fecha_fin', label: 'fecha de fin', class: 'text-center small', sortable: true, sortDirection: 'desc' },
          { key: 'institucion_id', label: 'Institución', class: 'text-center small', sortable: true, sortDirection: 'desc' , thStyle: { width: "25%" } },
          { key: 'identificador_curso', label: 'Id Curso', class: 'text-center small', sortable: true, sortDirection: 'desc' },
          { key: 'estatus_id', label: 'Estatus', class: 'text-center small', sortable: true, sortDirection: 'desc' },
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
          curso_oblig: false,
          hrs_cap: '',
          curso_int_ext:0,
          difundido_DP:'',
          modalidad:'',
          estatus_id:2,
          institucion_id:'',
          identificador_curso:''
        },
        curso_:{
          id:'',
          nombre:'',
          fecha_inicio:'',
          fecha_fin:'',
          curso_oblig: false,
          hrs_cap: '',
          curso_int_ext: false,
          difundido_DP:'',
          modalidad:'',
          estatus_id:2,
          institucion_id:'',
          identificador_curso:''
        },
        instituciones:{
          id:'',
          nombre:''
        },
        difundido_DPs: [
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
                  var institucion = this.curso.institucion_id
                  var institucion_filter = this.instituciones.filter(function(e){
                  return e.nombre === institucion                
                })
                console.log(institucion_filter);
                for( var resultado of institucion_filter){
                  this.resultado_institucion = resultado.id
                }
                console.log(this.resultado_institucion);              
                const params={
                nombre: this.curso.nombre,
                fecha_inicio:this.curso.fecha_inicio,
                fecha_fin:this.curso.fecha_fin,
                curso_oblig: this.curso.curso_oblig,
                hrs_cap: this.curso.hrs_cap,
                curso_int_ext: this.curso.curso_int_ext,
                difundido_DP: this.curso.difundido_DP,
                modalidad: this.curso.modalidad,
                estatus_id: this.curso.estatus_id,
                institucion_id:this.resultado_institucion,
                identificador_curso:this.curso.identificador_curso
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
                  this.curso.fecha_inicio = '';
                  this.curso.fecha_fin = '';
                  this.curso.curso_oblig = '';
                  this.curso.hrs_cap = '';
                  this.curso.curso_int_ext = '';
                  this.curso.difundido_DP = '';
                  this.curso.modalidad = '';
                  this.curso.estatus_id = '';
                  this.resultado_institucion = '';
                  this.curso.institucion_id = '';
                  this.curso.identificador_curso = '';
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
        this.curso_.id = item.id,
        this.curso_.nombre = item.nombre,
        this.curso_.fecha_inicio = item.fecha_inicio,
        this.curso_.fecha_fin = item.fecha_fin,
        this.curso_.curso_oblig = item.curso_oblig,
        this.curso_.hrs_cap = item.hrs_cap,
        this.curso_.curso_int_ext = item.curso_int_ext,
        this.curso_.difundido_DP = item.difundido_DP,
        this.curso_.modalidad = item.modalidad,
        this.curso_.estatus_id = item.estatus_id,
        this.curso_.institucion_id = item.institucion_id,
        this.curso_.identificador_curso = item.identificador_curso
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
            var institucion_ = item.institucion_id
            var institucion_filter_ = this.instituciones.filter(function(e){
              return e.nombre === institucion_                
            })
            console.log(institucion_filter_);
            for( var resultado of institucion_filter_){
              this.resultado_institucion_ = resultado.id
            }
            console.log(this.resultado_institucion_);
            if(item.estatus_id === 'Registrado'){
                this.curso_.estatus_id = 1;
            }else{
                this.curso_.estatus_id = 2;
            } 
            const params = {
              id: item.id,
              nombre: item.nombre,
              fecha_inicio: item.fecha_inicio,
              fecha_fin: item.fecha_fin,
              curso_oblig: item.curso_oblig,
              hrs_cap: item.hrs_cap,
              curso_int_ext: item.curso_int_ext,
              difundido_DP: item.difundido_DP,
              modalidad: item.modalidad,
              institucion_id:this.resultado_institucion_,
              estatus_id: this.curso_.estatus_id,
              identificador_curso: item.identificador_curso
            }
            console.log(params);
            axios.put(`/curso/${item.id}`, params)
            .then(res =>{
              //ocultar modal
              this.$bvModal.hide('modal-editar');
              const index = this.cursos.findIndex(
                cursoBuscar => cursoBuscar.id === item.id
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
                        axios.post(`curso/validar/${item.id}`)
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