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
                          <b-dropdown-item v-if="rol == 1" href="/calificaciones">Validación de cursos externos</b-dropdown-item>
                  </b-nav-item-dropdown>
                  <b-nav-item-dropdown v-if="rol == 1 || rol == 2" text="Servicios" class="mr-4" right>
                          <b-dropdown-item class="activo active" v-if="rol == 1 || rol == 2" href="/capturar">Registrar cursos externos</b-dropdown-item>
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
            <b-button size="sm" class="botones mb-4" v-b-modal.modal-crear>Registrar curso</b-button>
          </b-row>
          <!-- <b-row align-h="end">
            <b-button size="sm" class="botones mb-4" v-b-modal.modal-archivos>Capturar nuevo curso-constancia</b-button>
          </b-row> -->
          
          <h3 style="color:#285C4D">Mis cursos registrados</h3>
          <hr>
          <br> <br>

          <!-- Inicio modal crear -->

          <b-modal centered id="modal-crear" size="xl" title="Nuevo Curso  Externo" hide-footer>
                  <b-form @submit.prevent="crear" enctype="multipart/form-data">
                    <b-row>
                      <b-col cols="8">
                        <label for="curso">Nombre del curso:</label> <br>
                        <span class="span">Selecciona o busca el curso a registrar del listado:</span>
                        <b-form-input list="curso" v-model="miCurso.curso_id" autocomplete="off" required>
                        </b-form-input>
                        <datalist id="curso">
                          <option v-for="curso in cursos">{{ curso.nombre }}</option>  
                        </datalist>
                        <span class="span"> <u>Si tu curso no se encuentra en el listado. Debes ir al botón <strong>"el curso no aparece en el listado"</strong></u></span>                          
                      </b-col>
                      <b-col cols="1">
                        <b-button size="sm" 
                          class="botones" 
                          style="margin-top: 55px; margin-left: -20px;" 
                          v-b-tooltip.hover title="Haga click para buscar los detalles del curso seleccionado"
                          @click="buscaDetalles()">
                          <b-icon icon="search"></b-icon>
                        </b-button>                        
                      </b-col>
                      <b-col cols="2">
                        <label for="">Acreditación</label>
                        <b-form-checkbox v-model="miCurso.aprobado" name="check-button" switch required>
                          <b v-if="miCurso.aprobado"> Aprobado</b> <b v-else>No aprobado</b>
                        </b-form-checkbox>
                      </b-col>
                    </b-row>
                    <br>
                    <b-row v-if="detalles">
                      <b-col cols="11">
                        <b-card sub-title="Detalles del curso">
                          <b-card-text>
                            <b> - Institución:</b>  <p style="color: #285C4D; display: inline;"> {{ detallesCurso.institucion_id }} </p><br>
                            <b> - Horas de Capacitación:</b> <p style="color: #285C4D; display: inline;">{{ detallesCurso.hrs_cap }} </p><br>
                            <b> - Modalidad:</b> <p style="color: #285C4D; display: inline;">{{ detallesCurso.modalidad }} </p><br>
                            <b> - Obligatorio u optativo:</b> <p v-if="detallesCurso.curso_oblig" style="color: #285C4D; display: inline;">Obligatorio</p> <p v-if="detallesCurso.curso_oblig === null " style="color: #285C4D; display: inline;">Sin información</p> <p v-if="detallesCurso.curso_oblig === false" style="color: #285C4D; display: inline;">Optativo</p> <br>
                            <b> - Fecha de finalización del curso:</b> <p style="color: #285C4D; display: inline;"> {{ detallesCurso.fecha_fin }} </p><br>                           
                          </b-card-text>
                        </b-card>
                      </b-col>
                    </b-row>
                    <br>
                    <b-row>
                      <b-col cols="2">
                          <label>Calificación:</label>
                          <b-form-input type="number" v-model="miCurso.calif" autocomplete="off" required>
                          </b-form-input>
                      </b-col>
                      <b-col cols="6">
                        <b-form-group label="Constancia:" >
                          <b-form-file placeholder="Seleccione el archivo PDF a subir" @change="select_file" required></b-form-file>
                          <span class="span"><strong>Importante:</strong> El archivo PDF no puede ser mayor a <u>10Mb</u></span>
                        </b-form-group>
                      </b-col>
                      <b-col cols="4">
                        <b-button class="botones" style="margin-top: 31px;" @click="showAlert()"
                        v-b-modal.modal-crearCurso>
                        El curso no aparece en el listado 
                        <b-icon icon="exclamation-circle">
                        </b-icon>
                        </b-button>
                      </b-col>
                    </b-row>
                    <br>
                    <b-row class="mt-4 mb-4">
                        <b-col cols="1">
                            <b-button class="botones" type="submit">Guardar</b-button>
                        </b-col>
                    </b-row>
                  </b-form>
          </b-modal>

          <!-- Inicio modal detalles -->

          <b-modal centered id="modal-detalles" size="xl" title="Detalles del Curso" ok-only>
                <b-row>
                  <b-col cols="8">
                    <label for="curso">Nombre del curso:</label>
                    <b-form-input list="curso" v-model="miCurso_.curso_id" autocomplete="off" readonly>
                    </b-form-input>                        
                  </b-col>
                  <b-col cols="2">
                    <label for="">Acreditación</label>
                    <b-form-input v-if="miCurso_.aprobado" readonly value="Aprobado"></b-form-input>
                    <b-form-input v-else readonly value="No aprobado"></b-form-input>
                  </b-col>
                </b-row>
                <br>
                <b-row>
                  <b-col cols="11">
                    <b-card sub-title="Detalles del curso">
                      <b-card-text>
                        <b> - Institución:</b>  <p style="color: #285C4D; display: inline;"> {{ miCurso_.institucion_id }} </p><br>
                        <b> - Horas de Capacitación:</b> <p style="color: #285C4D; display: inline;">{{ miCurso_.hrs_cap }} </p><br>
                        <b> - Modalidad:</b> <p style="color: #285C4D; display: inline;">{{ miCurso_.modalidad }} </p><br>
                        <b> - Obligatorio u optativo:</b> <p v-if="miCurso_.curso_oblig" style="color: #285C4D; display: inline;">Obligatorio</p> <p v-else style="color: #285C4D; display: inline;">Optativo</p> <br>
                        <b> - Fecha de finalización del curso:</b> <p style="color: #285C4D; display: inline;"> {{ miCurso_.fecha_fin }} </p><br>                           
                      </b-card-text>
                    </b-card>
                  </b-col>
                </b-row>
                <br>
                <b-row>
                  <b-col cols="2">
                      <label>Calificación:</label>
                      <b-form-input v-model="miCurso_.calif" readonly>
                      </b-form-input>
                  </b-col>
                  <b-col cols="6">
                    <label>Constancia:</label>
                    <br> 
                    <a v-if="miCurso_.url_constancia" :href="miCurso_.url_constancia" target="blank">Descargar constancia ({{ miCurso_.nombre_constancia }})</a>
                    <p v-else>Sin constancia</p>
                  </b-col>
                </b-row>
                <br>
          </b-modal>

          <!-- Inicio modal crear curso -->

          <b-modal centered id="modal-crearCurso" size="xl" title="Nuevo Curso" hide-footer>
                    <b-form @submit.prevent="crearCurso">
                      <b-row>
                        <b-col cols="12">
                          <b-alert
                          :show="dismissCountDown"
                          dismissible
                          fade
                          variant="danger"
                          @dismiss-count-down="countDownChanged"
                        >
                          <center>
                          <b> ¿Estás seguro que tu curso no está en el listado? <br> Si anotas uno existente, la solicitud no será validada y deberás iniciar el registro del curso. </b><br> <br>
                          Este aviso desaparecerá en:  {{ dismissCountDown }} segundos... <br>
                          <b-progress
                            variant="danger"
                            :max="dismissSecs"
                            :value="dismissCountDown"
                            height="4px"
                          ></b-progress>
                          </center>
                        </b-alert>
                        </b-col>
                      </b-row>
                      <b-row>
                        <b-col cols="12">
                          <label>Nombre:</label>
                          <b-form-input id="nombre" name="nombre" v-model="curso.nombre" style="text-transform:uppercase" autocomplete="off" required>
                          </b-form-input>
                        </b-col>
                        <!-- No se muestra del lado del usuario -->
                        <!-- <b-col cols="2">
                          <label for="">¿Curso Obligatorio?</label>
                          <b-form-checkbox v-model="curso.curso_oblig" name="check-button" switch>
                            <b v-if="curso.curso_oblig"> Si</b> <b v-else>No</b>
                          </b-form-checkbox>
                        </b-col> -->
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
                          <b-form-input type="number" v-model="curso.hrs_cap" required>
                          </b-form-input>
                        </b-col>
                        <b-col cols="2">
                          <label for="">Curso Interno o Externo:</label>
                            <b-form-checkbox v-model="curso.curso_int_ext" name="curso_int_ext" switch required>
                            <b v-if="curso.curso_int_ext"> Externo</b> <b v-else>Interno</b>
                          </b-form-checkbox>
                        </b-col>
                      </b-row>
                      <br>
                      <b-row>
                        <!-- No se muestra del lado del usuario -->
                        <!-- <b-col cols="2">
                          <label for="">Difundido por la DP:</label>
                          <b-form-select v-model="curso.difundido_DP" :options="difundido_DPs"></b-form-select>
                        </b-col> -->
                        <b-col cols="12">
                          <label for="institucion_id">Institución:</label>
                          <b-form-input list="institucion_id" v-model="curso.institucion_id" autocomplete="off">
                          </b-form-input>
                          <span class="span">Selecciona o busca la Institución a registrar del listado:</span>
                          <datalist id="institucion_id">
                            <option v-for="institucion in instituciones">{{ institucion.nombre }}</option>  
                          </datalist>                          
                        </b-col>
                      </b-row>
                      <br>
                      <b-row>
                        <!-- No se muestra del lado del usuario -->
                        <!-- <b-col cols="2">
                          <label>Id Curso:</label>
                          <b-form-input id="folio" name="folio" v-model="curso.folio" autocomplete="off">
                          </b-form-input>
                        </b-col> -->
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

            <!-- Inicio modal rechazo  -->

            <b-modal centered id="modal-rechazo" title="Detalles del rechazo" hide-footer>
                <b-row>
                  <b-col>
                    <label>Motivos de rechazo:</label>
                    <b-form-textarea
                      rows="3"
                      max-rows="6"
                      v-model="miCurso_.rechazo"
                      readonly
                    ></b-form-textarea>
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
                  <b-button size="sm" class="botones" @click="cargarDatos(row.item)" v-b-modal.modal-detalles
                      v-b-tooltip.hover title="Haga click si desea ver los detalles del curso">
                      <b-icon icon="eye"></b-icon>
                  </b-button>
                  <b-button size="sm" class="botones" 
                      @click="cargarDatos(row.item)"
                      v-if="row.item.estatus_id == 'Rechazado'" 
                      v-b-modal.modal-rechazo
                      v-b-tooltip.hover title="Haga click para conocer los motivos de rechazo">
                      <b-icon icon="exclamation-triangle"></b-icon>
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
    /* Obtener la fecha de hoy */
    /* const today = new Date().toISOString().slice(0, 10) */
    /* const today = new Date().toLocaleDateString().split('T')[0].replaceAll("/", "-") */
    var today = new Date();
    var dd = String(today.getDate()).padStart(2, '0');
    var mm = String(today.getMonth() + 1).padStart(2, '0'); //January is 0!
    var yyyy = today.getFullYear();
    today = yyyy + '-' + mm + '-' + dd;
    const fecha = today;
    return {
      fields: [
          { key: 'curso_id', label: 'Curso', class: 'text-center small', sortable: true, sortDirection: 'desc' },
          { key: 'calif', label: 'Calificación', class: 'text-center small', sortable: true, sortDirection: 'desc' },
          { key: 'hrs_cap', label: 'Hrs de Cap.', class: 'text-center small', sortable: true, sortDirection: 'desc' },
          { key: 'fecha', label: 'Fecha', class: 'text-center small', sortable: true, sortDirection: 'desc' },
          { key: 'estatus_id', label: 'Estatus', class: 'text-center small', sortable: true, sortDirection: 'desc' },
          { key: 'actions', class: 'text-center small', label: 'Acciones' }
      ],
      dismissSecs: 20,
      dismissCountDown: 0,
      showDismissibleAlert: false,
      fecha_hoy:fecha,
      detalles: false,
      archivo:null,
      msgResult:'',
      rol:'',
      usrActual:'',
      idUsrActual:'',
      misCursos:[],
      miCurso:{
        usuario_id:'',
        curso_id:'',
        curso_fin:'',
        aprobado:false,
        calif:'',
        fecha:'',
        anio:'',
        url_constancia:'',
        nombre_constancia:'',
        estatus_id:''
      },
      miCurso_:{
        id_calificacion:'',
        id_user:'',
        id_curso:'',
        cursoFin:'',
        aprobado:false,
        calif:'',
        fecha:'',
        anio:'',
        rechazo:'',
        url_constancia:'',
        nombre_constancia:'',
        estatus_id:'',
        //detalles del curso
        institucion_id:'',
        hrs_cap:'',
        modalidad:'',
        curso_oblig:'',
        fecha_fin:''
      },
      cursos:{
        id:'',
        nombre:''
      },
      instituciones:{
        id:'',
        nombre:''
      },
      resultado_curso:'',
      resultado_institucion:'',
      //muestra los detalles del curso
      detallesCurso:{
        curso_int_ext:'',
        curso_oblig:'',
        difundido_DP:'',
        fecha_fin:'',
        fecha_inicio:'',
        folio:'',
        hrs_cap:'',
        curso_id:'',
        estatus_id:'',
        institucion_id:'',
        modalidad:'',
        nombre:''
      },
      //captura los datos del curso que no aparece en la lista
      curso:{
        nombre:'',
        fecha_inicio:'',
        fecha_fin:'',
        curso_oblig: false,
        hrs_cap: '',
        curso_int_ext:0,
        difundido_DP:'',
        modalidad:'',
        estatus_id:1,
        institucion_id:'',
        folio:''
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
    buscaDetalles(){
      console.log();
      this.detalles = 1;
      //valor del id-curso
      var curso = this.miCurso.curso_id
      var curso_filter = this.cursos.filter(function(e){
      return e.nombre === curso                
      })
      for( var resultadoCurso of curso_filter){
        this.detallesCurso = resultadoCurso
      }
      console.log(this.detallesCurso);
    },
    crear(){
      //validación de curso existente en datalist
      var cursoCap = this.miCurso.curso_id
      var cursoCapFilter = this.cursos.filter(function(e){
        return e.nombre === cursoCap
      })
      console.log(cursoCapFilter);
      if(cursoCapFilter != ''){
        this.msgResult='',
        this.showMsgBoxCrear(); //Modal confirmación
        console.log("Si pasa");
      }
      else{
        this.$toaster.error('Lo sentimos, debe seleccionar un curso de la lista')
        this.miCurso.curso_id = '';
      }
    },
    showMsgBoxCrear(){
      this.$bvModal.msgBoxConfirm(`¿ Confirma que desea guardar el nuevo curso externo?`, {
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
              var curso = this.miCurso.curso_id
              var curso_filter = this.cursos.filter(function(e){
              return e.nombre === curso                
              })
              //console.log(curso_filter);
              for( var resultadoCurso of curso_filter){
                this.resultado_curso = resultadoCurso.id
              }
              //console.log("El id bueno del curso es ",this.resultado_curso);
              var fechaCompleta = this.fecha_hoy;
              var fecha = fechaCompleta.split('-');
              console.log(fecha[0]);    
              this.miCurso.anio = fecha[0];
              //console.log(this.miCurso.anio);   
              //envío de params por formData
              let formData = new FormData();
              formData.append('usuario_id', this.idUsrActual);
              formData.append('curso_id', this.resultado_curso);
              formData.append('curso_fin', this.miCurso.aprobado);
              formData.append('aprobado', this.miCurso.aprobado);
              formData.append('calif', this.miCurso.calif);
              formData.append('fecha', this.fecha_hoy);
              formData.append('anio', this.miCurso.anio);
              formData.append('estatus_id', 1);
              formData.append('file', this.archivo);
              //console.log(formData);
              axios.post('/calificacion', formData)
              .then(res=>{
              //ocultar modal
              this.$bvModal.hide('modal-crear');
              this.misCursos.push(res.data)
              //mostrar toaster
              this.$toaster.success('Curso creado con éxito!')
              //Limpiamos los campos
              this.miCurso.curso_id = '',
              this.resultado_curso = '',
              this.miCurso.aprobado = '',
              this.miCurso.curso_oblig = '',
              this.miCurso.calif = '',
              this.miCurso.fecha = '',
              //Volvemos a ocultar el apartado de detalles 
              this.detalles= false;
              this.detallesCurso.institucion_id = '';
              this.detallesCurso.hrs_cap = '';
              this.detallesCurso.modalidad = '';
              this.detallesCurso.curso_oblig = '';
              this.detallesCurso.fecha_fin = '';
              //recargamos cambios
              axios.get('/califAuth')
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
      this.miCurso_.id = item.id,
      this.miCurso_.usuario_id = item.usuario_id,
      this.miCurso_.curso_id = item.curso_id,
      this.miCurso_.curso_fin = item.curso_fin,
      this.miCurso_.aprobado = item.aprobado,
      this.miCurso_.calif = item.calif,
      this.miCurso_.fecha = item.fecha,
      this.miCurso_.anio = item.anio,
      this.miCurso_.rechazo = item.rechazo,
      this.miCurso_.url_constancia = item.url_constancia,
      this.miCurso_.nombre_constancia = item.nombre_constancia,
      this.miCurso_.estatus_id = item.estatus_id,
      //detalles del curso 
      this.miCurso_.institucion_id = item.institucion_id,
      this.miCurso_.hrs_cap = item.hrs_cap,
      this.miCurso_.modalidad = item.modalidad,
      this.miCurso_.curso_oblig = item.curso_oblig,
      this.miCurso_.fecha_fin = item.fecha_fin
    },
    cancelar(){
        this.$bvModal.hide('modal-editar');
    },
    countDownChanged(dismissCountDown) {
        this.dismissCountDown = dismissCountDown
    },
    showAlert() {
      this.dismissCountDown = this.dismissSecs
    },
    crearCurso(){
      //validación de institución existente en datalist
      var institucionCap = this.curso.institucion_id
      var institucionCapFilter = this.instituciones.filter(function(e){
        return e.nombre === institucionCap
      })
      console.log(institucionCapFilter);
      if(institucionCapFilter != ''){
        this.msgResult='',
        this.showMsgBoxCrearCurso(); //Modal confirmación
        console.log("Si pasa");
      }
      else{
        this.$toaster.error('Lo sentimos, debe seleccionar una Institución de la lista')
        this.curso.institucion_id = '';
      }       
    },
    showMsgBoxCrearCurso(){
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
              //curso_oblig: this.curso.curso_oblig,
              hrs_cap: this.curso.hrs_cap,
              curso_int_ext: this.curso.curso_int_ext,
              //difundido_DP: this.curso.difundido_DP,
              modalidad: this.curso.modalidad,
              estatus_id: this.curso.estatus_id,
              institucion_id:this.resultado_institucion,
              //folio:this.curso.folio
            }
            console.log(params);
              axios.post('/curso', params)
            .then(res=>{
              //ocultar modal
              this.$bvModal.hide('modal-crearCurso');
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
.span{
  color:#B38E5D;
  font-size:14px;
}
.activo{
  background-color: #D4C19C !important;
}
</style>