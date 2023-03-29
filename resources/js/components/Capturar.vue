<template>
  <div>
      <b-navbar toggleable="lg" class="background-nav" type="dark">
        <img v-bind:src="'img/logo-header.svg'" class="logo-gobmx">
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
                          <b-dropdown-item v-if="rol == 1" href="/usuarios">Usuarios</b-dropdown-item>
                  </b-nav-item-dropdown>
                  <b-nav-item-dropdown v-if="rol == 1" text="Administración" class="mr-4" right>
                          <b-dropdown-item v-if="rol == 1" href="/kardex">Kardex</b-dropdown-item>
                          <b-dropdown-item v-if="rol == 1" href="/calificaciones">Validación de cursos externos</b-dropdown-item>
                  </b-nav-item-dropdown>
                  <b-nav-item-dropdown v-if="rol == 1 || rol == 2" text="Servicios" class="mr-4" right>
                          <b-dropdown-item v-if="rol == 1 || rol == 2" href="/capturar">Capturar cursos</b-dropdown-item>
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
            <b-button size="sm" class="botones mb-4" v-b-modal.modal-crear>Capturar nuevo curso</b-button>
          </b-row>
          <b-row align-h="end">
            <b-button size="sm" class="botones mb-4" v-b-modal.modal-archivos>Capturar nuevo curso-constancia</b-button>
          </b-row>

          
          <h3 style="color:#285C4D">Mis cursos capturados</h3>
          <hr>
          <br> <br>

          <!-- Modal de archivos -->

          <b-modal centered id="modal-archivos" size="xl" title="Nuevo Curso" hide-footer>
            <b-form @submit.prevent="save">
              <b-row>
                <b-col cols="12">
                  <b-form-group label="Constancia:" >
                    <b-form-file placeholder="Seleccione el archivo PDF a subir" @change="select_file"></b-form-file>
                  </b-form-group>
                </b-col>
              </b-row>
              <b-row>
                <b-col cols="12">
                  <b-button class="botones mb-4" type="submit">Guardar</b-button>
                </b-col>
              </b-row>
            </b-form>
          </b-modal>

          <!-- Inicio modal crear -->

          <b-modal centered id="modal-crear" size="xl" title="Nuevo Curso" hide-footer>
                  <b-form @submit.prevent="crear">
                    <b-row>
                      <b-col cols="9">
                          <label for="curso">Nombre del curso:</label>
                          <b-form-input list="curso" v-model="miCurso.curso" autocomplete="off">
                          </b-form-input>
                          <datalist id="curso">
                            <option v-for="curso in cursos">{{ curso.nombre }}</option>  
                          </datalist>                          
                        </b-col>
                        <b-col cols="3">
                          <label for="">Acreditación</label>
                          <b-form-checkbox v-model="miCurso.aprobado" name="check-button" switch>
                            <b v-if="miCurso.aprobado"> Aprobado</b> <b v-else>No aprobado</b>
                          </b-form-checkbox>
                        </b-col>
                    </b-row>
                    <br>
                    <b-row>
                      <b-col cols="2">
                        <label for="">¿Curso Obligatorio?</label>
                        <b-form-checkbox v-model="miCurso.cursoOblig" name="check-button" switch>
                          <b v-if="miCurso.cursoOblig"> Si</b> <b v-else>No</b>
                        </b-form-checkbox>
                      </b-col>
                      <b-col cols="2">
                          <label>Calificación:</label>
                          <b-form-input v-model="miCurso.calif">
                          </b-form-input>
                      </b-col>
                      <b-col cols="2">
                          <label>Hrs de Capacitación:</label>
                          <b-form-input v-model="miCurso.hrsCap">
                          </b-form-input>
                      </b-col>
                      <b-col cols="5">
                          <label for="">Fecha de finalización</label>
                          <b-form-datepicker v-model="miCurso.fecha" class="mb-2" placeholder="Seleccione una fecha"></b-form-datepicker>
                        </b-col>
                    </b-row>
                    <br>
                    <b-row>
                        <b-col cols="2">
                          <label for="">Curso Interno o Externo:</label>
                            <b-form-checkbox v-model="miCurso.cursoIntExt" switch>
                            <b v-if="miCurso.cursoIntExt"> Externo</b> <b v-else>Interno</b>
                          </b-form-checkbox>
                        </b-col>
                        <b-col cols="9" v-if = "miCurso.cursoIntExt == 1">
                          <label for="">Nombre de la Institución:</label>
                          <b-form-input list="id_institucion" v-model="miCurso.id_institucion" autocomplete="off">
                          </b-form-input>
                          <datalist id="id_institucion">
                            <option v-for="institucion in instituciones">{{ institucion.descripcion }}</option>  
                          </datalist> 
                        </b-col>
                    </b-row>
                    <br>
                    <b-row>
                      <b-col cols="2">
                          <label for="">Difundido por la DP:</label>
                          <b-form-select v-model="miCurso.difundidoDP" :options="difundidoDPs"></b-form-select>
                      </b-col>
                      <b-col cols="3">
                        <label>Modalidad:</label>
                        <b-form-input v-model="miCurso.modalidad"></b-form-input>
                      </b-col>
                      <b-col cols="6">
                        <b-form-group label="Constancia:" >
                          <b-form-file placeholder="Seleccione el archivo PDF a subir"></b-form-file>
                        </b-form-group>
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

          <!-- <b-modal centered id="modal-editar" title="Editar Curso" hide-footer>
                  <b-form @submit.prevent="editar(adscripcion_)">
                    <b-row>
                      <b-col cols="12">
                        <label>Nombre:</label>
                        <b-form-input id="descripcion" name="descripcion" v-model="adscripcion_.descripcion">
                        </b-form-input>
                      </b-col>
                    </b-row>
                    <b-row class="mt-4 mb-4">
                        <b-col cols="1">
                            <b-button class="botones" type="submit">Editar</b-button>
                        </b-col>
                    </b-row>
                  </b-form>
          </b-modal> -->

          <!-- Inicio modal Detalles -->

          <b-modal centered id="modal-detalles" size="xl" title="Detalles del Curso" hide-footer>
                  <b-form @submit.prevent="crear">
                    <b-row>
                      <b-col cols="9">
                          <label for="curso">Nombre del curso:</label>
                          <b-form-input list="curso" v-model="miCurso_.curso" autocomplete="off" readonly>
                          </b-form-input>
                          <datalist id="curso">
                            <option v-for="curso in cursos">{{ curso.nombre }}</option>  
                          </datalist>                          
                        </b-col>
                        <b-col cols="3">
                          <label for="">Acreditación</label>
                          <b-form-checkbox v-model="miCurso_.aprobado" name="check-button" switch>
                            <b v-if="miCurso_.aprobado"> Aprobado</b> <b v-else>No aprobado</b>
                          </b-form-checkbox>
                        </b-col>
                    </b-row>
                    <br>
                    <b-row>
                      <b-col cols="2">
                        <label for="">¿Curso Obligatorio?</label>
                        <b-form-checkbox v-model="miCurso_.cursoOblig" name="check-button" switch>
                          <b v-if="miCurso_.cursoOblig"> Si</b> <b v-else>No</b>
                        </b-form-checkbox>
                      </b-col>
                      <b-col cols="2">
                          <label>Calificación:</label>
                          <b-form-input v-model="miCurso_.calif" readonly>
                          </b-form-input>
                      </b-col>
                      <b-col cols="2">
                          <label>Hrs de Capacitación:</label>
                          <b-form-input v-model="miCurso_.hrsCap" readonly>
                          </b-form-input>
                      </b-col>
                      <b-col cols="5">
                          <label for="">Fecha de finalización</label>
                          <b-form-datepicker v-model="miCurso_.fecha" class="mb-2" placeholder="Seleccione una fecha" readonly></b-form-datepicker>
                        </b-col>
                    </b-row>
                    <br>
                    <b-row>
                        <b-col cols="2">
                          <label for="">Curso Interno o Externo:</label>
                            <b-form-checkbox v-model="miCurso_.cursoIntExt" switch>
                            <b v-if="miCurso_.cursoIntExt"> Externo</b> <b v-else>Interno</b>
                          </b-form-checkbox>
                        </b-col>
                        <b-col cols="9" v-if = "miCurso_.cursoIntExt == 1">
                          <label for="">Nombre de la Institución:</label>
                          <b-form-input list="id_institucion" v-model="miCurso_.id_institucion" autocomplete="off" readonly>
                          </b-form-input>
                          <datalist id="id_institucion">
                            <option v-for="institucion in instituciones">{{ institucion.descripcion }}</option>  
                          </datalist> 
                        </b-col>
                    </b-row>
                    <br>
                    <b-row>
                      <b-col cols="2">
                        <label for="difundidoDP">Difundido por la DP:</label>
                        <p v-if="miCurso_.difundidoDP">
                          <b-form-input readonly id="difundidoDP" value="Si"></b-form-input>
                        </p>
                        <p v-else>
                          <b-form-input readonly id="difundidoDP" value="No"></b-form-input>
                        </p>
                      </b-col>
                      <b-col cols="3">
                        <label>Modalidad:</label>
                        <b-form-input v-model="miCurso_.modalidad" readonly></b-form-input>
                      </b-col>
                      <b-col cols="6">
                        <b-form-group label="Constancia:" >
                          <b-form-file placeholder="Sin Constancia" disabled></b-form-file>
                        </b-form-group>
                      </b-col>
                    </b-row>
                    <b-row class="mt-4 mb-4">
                        <b-col cols="1">
                            <b-button class="botones" type="submit">Guardar</b-button>
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
              <b-table
              class="table table-sm"
              :items="misCursos"
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
                  <b-button size="sm" class="botones" @click="cargarDatos(row.item)" v-b-modal.modal-detalles>
                      Detalles
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
          { key: 'id_calificacion', label: 'Número', class: 'text-center small', sortable: true, sortDirection: 'desc' },
          { key: 'curso', label: 'Curso', class: 'text-center small', sortable: true, sortDirection: 'desc' },
          { key: 'calif', label: 'Calificación', class: 'text-center small', sortable: true, sortDirection: 'desc' },
          { key: 'hrsCap', label: 'Hrs de Cap.', class: 'text-center small', sortable: true, sortDirection: 'desc' },
          { key: 'fecha', label: 'Fecha', class: 'text-center small', sortable: true, sortDirection: 'desc' },
          { key: 'id_estatus', label: 'Estatus', class: 'text-center small', sortable: true, sortDirection: 'desc' },
          { key: 'actions', class: 'text-center small', label: 'Acciones' }
      ],
      archivo:null,
      msgResult:'',
      rol:'',
      usrActual:'',
      idUsrActual:'',
      misCursos:[],
      miCurso:{
        empleado:'',
        curso:'',
        cursoFin:'',
        aprobado:false,
        cursoOblig:false,
        calif:'',
        hrsCap:'',
        fecha:'',
        anio:'',
        cursoIntExt:false,
        id_institucion:'',
        difundidoDP:'',
        modalidad:'',
        urlConstancia:'',
        nombreConstancia:'',
        id_estatus:''
      },
      miCurso_:{
        empleado:'',
        curso:'',
        cursoFin:'',
        aprobado:false,
        cursoOblig:false,
        calif:'',
        hrsCap:'',
        fecha:'',
        anio:'',
        cursoIntExt:false,
        id_institucion:'',
        difundidoDP:'',
        modalidad:'',
        urlConstancia:'',
        nombreConstancia:'',
        id_estatus:''
      },
      cursos:{
        id_curso:'',
        nombre:''
      },
      instituciones:{
          id_institucion:'',
          descripcion:''
      },
      difundidoDPs: [
        { value: '1', text: 'Si' },
        { value: '0', text: 'No' }
      ],
      resultado_curso:'',
      resultado_institucion:'',
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
      axios.get('/califAuth')
      .then(res=>{
          this.misCursos = res.data;
      })
      axios.get('/rol')
      .then(res=>{
          this.rol = res.data;
      })
      axios.get('/usrActual')
      .then(res=>{
          this.usrActual = res.data;
      })
      axios.get('/idUsrActual')
      .then(res=>{
          this.idUsrActual = res.data;
      })
      axios.get('/curso')
      .then(res=>{
          this.cursos = res.data;
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
        return this.misCursos.length;
      },
  },
  mounted() {
    // Set the initial number of items
    this.totalRows = this.misCursos.length
  },
  methods: {
    select_file(event){
      this.archivo = event.target.files[0];
    },
    /* save(){
      let pdf = new FormData();
      for (let key in this.archivo){
        pdf.append(key, this.archivo[key])
      }
      console.log(this.archivo);
      axios.post('/calificacion', this.archivo)
      .then(res=>{
        this.misCursos.push(res.data)
        console.log(res.data);
      })     

    }, */
    save(){
      let fd = new FormData();
      fd.append('file', this.archivo);
      axios.post('/calificacion', fd)
      .then(res=>{
        console.log("response", res.data)
      })
    },
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
              //valor del id-curso
              var curso = this.miCurso.curso
              var curso_filter = this.cursos.filter(function(e){
              return e.nombre === curso                
              })
              //console.log(curso_filter);
              for( var resultadoCurso of curso_filter){
                this.resultado_curso = resultadoCurso.id_curso
              }
              console.log("El id del curso es ",this.resultado_curso);
              //valor del id-institución
              var institucion = this.miCurso.id_institucion
              var institucion_filter = this.instituciones.filter(function(e){
              return e.descripcion === institucion                
              })
              console.log(institucion_filter);
              for( var resultadoInst of institucion_filter){
                this.resultado_institucion = resultadoInst.id_institucion
              }
              console.log("El id de la institucion es ",this.resultado_institucion);
              var fechaCompleta = this.miCurso.fecha;
              var fecha = fechaCompleta.split('-');
              //console.log(fecha[0]);    
              this.miCurso.anio = fecha[0];
              //console.log(this.miCurso.anio);   
            const params={
              empleado: this.idUsrActual,
              curso: this.resultado_curso,
              cursoFin: this.miCurso.aprobado,
              aprobado: this.miCurso.aprobado,
              cursoOblig: this.miCurso.cursoOblig,
              calif: this.miCurso.calif,
              hrsCap: this.miCurso.hrsCap,
              fecha: this.miCurso.fecha,
              anio: this.miCurso.anio,
              cursoIntExt: this.miCurso.cursoIntExt,
              id_institucion: this.resultado_institucion,
              difundidoDP: this.miCurso.difundidoDP,
              modalidad: this.miCurso.modalidad,
              id_estatus: 1              
            }
            console.log(params);
            axios.post('/calificacion', params)
            .then(res=>{
              //ocultar modal
              this.$bvModal.hide('modal-crear');
              this.misCursos.push(res.data)
              //mostrar toaster
              this.$toaster.success('Curso creado con éxito!')
              //Limpiamos los campos
              this.miCurso.curso = '',
              this.resultado_curso = '',
              this.miCurso.aprobado = '',
              this.miCurso.cursoOblig = '',
              this.miCurso.calif = '',
              this.miCurso.hrsCap = '',
              this.miCurso.fecha = '',
              this.miCurso.anio = '',
              this.miCurso.cursoIntExt = '',
              this.miCurso.difundidoDP = '',
              this.miCurso.modalidad = '',
              //recargamos cambios
              axios.get('/calificacion')
              .then(res=>{
                  this.misCursos = res.data;
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
      this.miCurso_.id_calificacion = item.id_calificacion,
      this.miCurso_.empleado = item.empleado,
      this.miCurso_.curso = item.curso,
      this.miCurso_.cursoFin = item.cursoFin,
      this.miCurso_.aprobado = item.aprobado,
      this.miCurso_.cursoOblig = item.cursoOblig,
      this.miCurso_.calif = item.calif,
      this.miCurso_.hrsCap = item.hrsCap,
      this.miCurso_.fecha = item.fecha,
      this.miCurso_.anio = item.anio,
      this.miCurso_.cursoIntExt = item.cursoIntExt,
      this.miCurso_.id_institucion = item.id_institucion,
      this.miCurso_.difundidoDP = item.difundidoDP,
      this.miCurso_.modalidad = item.modalidad,
      this.miCurso_.urlConstancia = item.urlConstancia,
      this.miCurso_.nombreConstancia = item.nombreConstancia,
      this.miCurso_.id_estatus = item.id_estatus
    },
    editar(item){
      this.msgResult='';
      this.showMsgBoxEditar(item); //Modal confirmación
    },
    showMsgBoxEditar(item){
      this.$bvModal.msgBoxConfirm(`¿ Confirma que desea editar la adscripción actual ?`, {
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
            id_adscripcion : item.id_adscripcion,
            descripcion: item.descripcion
          }
          axios.put(`/adscripcion/${item.id_adscripcion}`, params)
          .then(res =>{
            //ocultar modal
            this.$bvModal.hide('modal-editar');
            const index = this.adscripciones.findIndex(
              adscripcionBuscar => adscripcionBuscar.id_adscripcion === item.id_adscripcion
            )
            this.adscripciones[index] = res.data
            //mostrar toaster
            this.$toaster.success('¡Adscripción actualizada con éxito')
            //Recargamos los cambios
            axios.get('/adscripcion')
              .then(res=>{
                  this.adscripciones = res.data
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
.custom-file-input:lang(en) ~ .custom-file-label::after {
  content: 'Browse1';
}
</style>