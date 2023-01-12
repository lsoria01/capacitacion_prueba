<template>
    <div>
        <b-navbar toggleable="lg" class="background-nav" type="dark">
            <img v-bind:src="'img/logo-header.svg'" class="logo-gobmx">
            <!-- Right aligned nav items -->
            <b-navbar-nav class="ml-auto">
                <b-nav-item-dropdown v-if="rol == 1" text="Administración" class="mr-4" right>
                        <b-dropdown-item v-if="rol == 1" href="/adscripciones">Adscripciones</b-dropdown-item>
                        <b-dropdown-item v-if="rol == 1" href="/calificaciones">Calificaciones</b-dropdown-item>
                        <b-dropdown-item v-if="rol == 1" href="/cursos">Cursos</b-dropdown-item>
                        <b-dropdown-item v-if="rol == 1" href="/nombramientos">Nombramientos</b-dropdown-item>
                        <b-dropdown-item v-if="rol == 1" href="/puestos">Puestos</b-dropdown-item>
                        <b-dropdown-item v-if="rol == 1" href="/usuarios">Usuarios</b-dropdown-item>
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
        <div class="container">
            <h3 class="my-4 row justify-content-center">EXPEDIENTE ELECTRÓNICO DE DESARROLLO PROFESIONAL</h3>
            <br> <br>
            <!-- Información del usuario -->
            <div style="padding-left: 90px; padding-right: 90px;" >
                <table class="table striped hover">
                    <thead style="display:none">
                        <tr>
                        <th></th>
                        <th></th>
                        <th></th>
                        <th></th>
                        <th></th>
                        <th></th>
                        </tr>
                    </thead>
                    <tbody style="text-align: center;" v-for="autentic in autenticado" :key="autentic.id">
                        <tr>
                            <th colspan="3" class="renglonUno">ID Empleado</th>
                            <th colspan="3" class="renglonUno">Nombre</th>
                        </tr>
                        <tr>
                            <td colspan="3" class="renglonDos">{{autentic.id}}</td>
                            <td colspan="3" class="renglonDos">{{autentic.name}}</td>
                        </tr>
                        <tr>
                            <th colspan="2" class="renglonUno">Puesto</th>
                            <th colspan="2" class="renglonUno">Nivel</th>
                            <th colspan="2" class="renglonUno">Adscripción</th>
                        </tr>
                        <tr>
                            <td colspan="2">{{autentic.puesto}}</td>
                            <td colspan="2">{{autentic.nivel}}</td>
                            <td colspan="2">{{autentic.adscripcion}}</td>
                        </tr>
                        <tr>
                            <th colspan="3" class="renglonUno">Fecha de ingreso al CFCRL</th>
                            <th colspan="3" class="renglonUno">Superior Jerárquico</th>
                        </tr>
                        <tr>
                            <td colspan="3">{{autentic.fechaIngr}}</td>
                            <td colspan="3"><p v-if="autentic.superior == 22">DIRECCIÓN DE INNOVACIÓN Y PROCESOS</p> </td>
                        </tr>
                        <tr>
                            <th colspan="2" class="renglonUno">CURP</th>
                            <th colspan="2" class="renglonUno">Correo Electrónico</th>
                            <th colspan="2" class="renglonUno">Fecha</th>
                        </tr>
                        <tr>
                            <td colspan="2">{{autentic.curp}}</td>
                            <td colspan="2">{{autentic.email}}</td>
                            <td colspan="2">{{fecha_hoy}}</td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <!-- Información del nombramiento -->
            <br> <br>
            <!-- <div style="padding-left: 90px; padding-right: 90px;" >
                <p style="text-align: center;"><b>Nombramiento</b></p>
                <table class="table table-striped">
                    <thead style="text-align: center;">
                        <tr>
                        <th class="renglonUno">Tipo</th>
                        <th class="renglonUno">Fecha de emisión</th>
                        <th class="renglonUno">Ratificación</th>
                        </tr>
                    </thead>
                    <tbody style="text-align: center;" v-for="nombram in nombramiento" :key="nombram.id">
                        <tr>
                            <td>{{nombram.tipo}}</td>
                            <td>{{nombram.fecEmis}}</td>
                            <td>{{nombram.fecRatif}}</td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <br> <br> -->
            <!-- Sección de búsqueda -->
            <p class="my-4 row justify-content-center"><b>Seleccione el año del ejercicio o el periodo de consulta</b></p>
            <b-row>
                <b-col cols="4">
                    <label for="anio">Año</label>
                    <b-form-input id="anio" v-model="anio">año</b-form-input>
                </b-col>
                <b-col cols="2">
                </b-col>

                <b-col cols="3">
                    <label for="anioIni">Año Inicial</label>
                    <b-form-input id="anioIni"></b-form-input>
                </b-col>
                <b-col cols="3">
                    <label for="anioFin">Año Final</label>
                    <b-form-input id="anioFin"></b-form-input>
                </b-col>
            </b-row>
            <br> <br>
            <b-row>
                <b-col cols="3">
                    <b-button class="renglonDos" @click="buscarAnio()">Consultar</b-button>
                </b-col>
                <b-col cols="3">
                    
                </b-col>
                <b-col cols="6">
                    <b-button class="renglonDos" @click="buscarIniFin()">Consultar</b-button>
                </b-col>
            </b-row>
            <br> <br>
            <!-- Historial de horas de capacitación -->
            <div v-if="historial">
                <p class="my-4"><b>A continuación se detalla el historial de las horas de capacitación tomadas en el año 2022:</b></p>
                    <table class="table table-striped" style="text-align: center;">
                        <thead>
                            <tr>
                                <th class="renglonUno">No.</th>
                                <th class="renglonUno">Año</th>
                                <th class="renglonUno">Tipo de curso</th>
                                <th class="renglonUno">Categoría</th>
                                <th class="renglonUno">Nombre del curso</th>
                                <!-- <th class="renglonUno">Calificación</th> -->
                                <!-- <th class="renglonUno">Fecha</th>
                                <th class="renglonUno">ID_Curso</th> -->
                                <th class="renglonUno">Horas de Capacitación</th>
                                <th class="renglonUno">Calificación</th>
                            </tr>
                        </thead>
                        
                        <tbody>
                            <tr v-for="calif in resultado" :key="calif.id">
                                <td>{{calif.id_calificacion}}</td>
                                <td>{{calif.anio}}</td>
                                <td><p v-if="calif.cursoOblig">Obligatorio</p> <p v-else>Optativo</p> </td>                                
                                <td>{{calif.categoriaInst}}</td>
                                <td>{{calif.curso}}</td>
                                <td>{{calif.hrsCap}}</td>
                                <td>{{calif.calif}}</td>
                            </tr>
                        </tbody>
                    </table>
                    <br> <br>
                    <div style="margin-left: 60%;">
                        <table class="table table-striped" style="text-align: center;">
                            <thead>
                                <tr>
                                    <th class="renglonUno">No.</th>
                                    <th class="renglonUno">Ejercicio</th>
                                    <th class="renglonUno">TOTAL DE HORAS DE AÑO</th>
                                    <th class="renglonUno">CUMPLIMIENTO</th> 
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>1</td>
                                    <td>2022</td>
                                    <td>42</td>
                                    <td>Cumple</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <br> <br>
                    <b-row align-h="end">
                        <b-button class="renglonDos my-4" @click="reportePDF()">Generar PDF</b-button>
                    </b-row>
                    <!-- <div class="mb-4">
                        <b-row>
                             <b-col cols="3">
                                <vue-qr text="www.centrolaboral.gob.mx" :callback="test" qid="testid"></vue-qr>
                            </b-col>
                            <b-col cols="9">
                                <div class="my-4 row justify-content-center renglonUno"> Observaciones: </div>
                                <textarea class="form-control" id="observaciones" rows="4"></textarea>
                            </b-col>
                        </b-row>                    
                    </div> -->
            </div>
        </div>

        <!-- Inicio del rubro PDF -->
        <div>
            <vue-html2pdf
              :show-layout="false"
              :float-layout="true"
              :enable-download="false"
              :preview-modal="false"
              :paginate-elements-by-height="1000"
              :pdf-quality="2"
              :manual-pagination="true"
              :html-to-pdf-options="htmlToPdfOptions"
              pdf-format="a4"
              pdf-content-width="92%"
              @beforeDownload="beforeDownload($event)"              
              @hasStartedGeneration="hasStartedGeneration()"
              
              ref="html2Pdf"
            >
                <section slot="pdf-content">
                    <section class="pdf-item">
                        <!-- Imagen header -->
                        <div class="container ml-4 mb-4">
                            <b-img left v-bind:src="'img/encabezado.png'" width= "158px" height= "35px" alt="Left image"></b-img>
                            <p style="text-align: right; font-size: 10px">CENTRO FEDERAL DE CONCILIACIÓN Y REGISTRO LABORAL <br> COORDINACIÓN GENERAL DE ADMINISTRACIÓN Y FINAZAS <br>DIRECCIÓN DE PROFESIONALIZACIÓN</p>
                        </div>
                        <div>
                            <h3 class="my-4 row justify-content-center" style="font-size: 13px">EXPEDIENTE ELECTRÓNICO DE DESARROLLO PROFESIONAL</h3>
                            <!-- Información del usuario -->
                            <div style="padding-left: 40px;">
                                <table class="table table-sm striped hover">
                                    <thead style="display:none">
                                        <tr>
                                        <th></th>
                                        <th></th>
                                        <th></th>
                                        <th></th>
                                        <th></th>
                                        <th></th>
                                        </tr>
                                    </thead>
                                    <tbody style="text-align: center; font-size: 10px" v-for="autentic in autenticado" :key="autentic.id">
                                        <tr>
                                            <th colspan="3" class="renglonUno">ID Empleado</th>
                                            <th colspan="3" class="renglonUno">Nombre</th>
                                        </tr>
                                        <tr>
                                            <td colspan="3" class="renglonDos">{{autentic.id}}</td>
                                            <td colspan="3" class="renglonDos">{{autentic.name}}</td>
                                        </tr>
                                        <tr>
                                            <th colspan="2" class="renglonUno">Puesto</th>
                                            <th colspan="2" class="renglonUno">Nivel</th>
                                            <th colspan="2" class="renglonUno">Adscripción</th>
                                        </tr>
                                        <tr>
                                            <td colspan="2">{{autentic.puesto}}</td>
                                            <td colspan="2">{{autentic.nivel}}</td>
                                            <td colspan="2">{{autentic.adscripcion}}</td>
                                        </tr>
                                        <tr>
                                            <th colspan="3" class="renglonUno">Fecha de ingreso al CFCRL</th>
                                            <th colspan="3" class="renglonUno">Superior Jerárquico</th>
                                        </tr>
                                        <tr>
                                            <td colspan="3">{{autentic.fechaIngr}}</td>
                                            <td colspan="3"><p v-if="autentic.superior == 22">DIRECCIÓN DE INNOVACIÓN Y PROCESOS</p> </td>
                                        </tr>
                                        <tr>
                                            <th colspan="2" class="renglonUno">CURP</th>
                                            <th colspan="2" class="renglonUno">Correo Electrónico</th>
                                            <th colspan="2" class="renglonUno">Fecha</th>
                                        </tr>
                                        <tr>
                                            <td colspan="2">{{autentic.curp}}</td>
                                            <td colspan="2">{{autentic.email}}</td>
                                            <td colspan="2">{{fecha_hoy}}</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                            <br> <br>
                            <!-- Historial de horas de capacitación -->
                            <div v-if="historial" style="padding-left: 40px;">
                                    <table class="table table-sm striped hover" style="text-align: center; font-size: 10px">
                                        <thead style="display:none">
                                            <tr>
                                                <th></th>
                                                <th></th>
                                                <th></th>
                                                <th></th>
                                                <th></th>
                                                <th></th>
                                                <th></th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <th colspan="7" class="renglonUno">Historial de Capacitación</th>
                                            </tr>
                                            <tr>
                                                <th colspan="1" class="renglonDos">No.</th>
                                                <th colspan="1" class="renglonDos">Año</th>
                                                <th colspan="1" class="renglonDos">Tipo de curso</th>
                                                <th colspan="1" class="renglonDos">Categoría</th>
                                                <th colspan="1" class="renglonDos">Nombre del curso</th>
                                                <th colspan="1" class="renglonDos">Horas de Capacitación</th>
                                                <th colspan="1" class="renglonDos">Calificación</th>
                                            </tr>
                                            <tr v-for="calif in resultado" :key="calif.id">
                                                <td colspan="1">{{calif.id_calificacion}}</td>
                                                <td colspan="1">{{calif.anio}}</td>
                                                <td colspan="1"><p v-if="calif.cursoOblig">Obligatorio</p> <p v-else>Optativo</p> </td>                                
                                                <td colspan="1">{{calif.categoriaInst}}</td>
                                                <td colspan="1">{{calif.curso}}</td>
                                                <td colspan="1">{{calif.hrsCap}}</td>
                                                <td colspan="1">{{calif.calif}}</td>
                                            </tr>
                                        </tbody>
                                    </table>
                                    <br> <br>
                                    <div style="margin-left: 60%;">
                                        <table class="table table-sm striped hover" style="text-align: center; font-size: 10px">
                                            <thead>
                                                <tr>
                                                    <th class="renglonUno">No.</th>
                                                    <th class="renglonUno">Ejercicio</th>
                                                    <th class="renglonUno">TOTAL DE HORAS DE AÑO</th>
                                                    <th class="renglonUno">CUMPLIMIENTO</th> 
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <td>1</td>
                                                    <td>2022</td>
                                                    <td>42</td>
                                                    <td>Cumple</td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                    <br> <br>
                            </div>
                        </div>
                        <br> <br> <br> <br> <br> <br> <br> <br> <br>
                        <div class="container ml-4">
                            <p style="text-align: center; font-size: 8px">Si tienes alguna duda, envía por favor un correo al Mtro. Oscar Olguín León, Subdirector de Formación y Desarrollo, al correo: oscar.olguin@centrolaboral.gob.mx; Extensión: 20073 
                                o bien, con la Lic. Rebeca Berenice Sánchez Santos, Jefa de Departamento de Seguimiento a la Formación Profesional, al correo: rebeca.sanchez@centrolaboral.gob.mx 
                                <br>
                                <!-- Imagen footer -->
                                <b-img center v-bind:src="'img/footer.png'" width= "624px" height= "45px" alt="Center image"></b-img>
                             </p>
                        </div>                        
                    </section>
                </section>

            </vue-html2pdf>
        </div>
    </div>
</template>

<script>
export default{
    data(){
            /* Obtener la fecha de hoy */
            /* const today = new Date().toISOString().slice(0, 10) */
            /* const today = new Date().toLocaleDateString().split('T')[0].replaceAll("/", "-") */
            var today = new Date();
            var dd = String(today.getDate()).padStart(2, '0');
            var mm = String(today.getMonth() + 1).padStart(2, '0'); //January is 0!
            var yyyy = today.getFullYear();
            today = yyyy + '-' + mm + '-' + dd;
            const fecha = today;
        return{
            fecha_hoy:fecha,
            autenticado:'',
            nombramiento:'',
            usrActual:'',
            calificacion:[],
            anio:'',
            historial:false,
            rol:'',
            //PDF
            htmlToPdfOptions: {
                margin: [0.5, 1, 0.5, 1], //top, left, bottom, right
                filename: "expediente", 
                image: { type: 'svg'},
                enableLinks: true,
                html2canvas: {
                dpi: 384,
                letterRendering: true,
                useCORS: true,
                scrollX: 0,
                scrollY: 0,
                },
                jsPDF: {
                unit: 'cm',
                format: 'a4',
                orientation: 'portrait' //Vertical
                }
            }
        }
    },
    created(){
        axios.get('/autenticado')
        .then(res=>{
            this.autenticado = res.data;
        })
        axios.get('/nombramientoAuth')
        .then(res=>{
            this.nombramiento = res.data;
        })
        axios.get('/usrActual')
        .then(res=>{
            this.usrActual = res.data;
        })
        axios.get('/calificacion')
        .then(res=>{
            this.calificacion = res.data;
        })
        axios.get('/rol')
        .then(res=>{
            this.rol = res.data;
        })

        
    },
    methods:{
        logout() {
            axios.post('/logout')
            .then(res=>{
                window.location.href = '/login';
            })              
        },
        buscarAnio(){
            var anio = this.anio
            var resultado = this.calificacion.filter(function(e){
                return e.anio == anio
            })
            this.resultado = resultado
            console.log(this.resultado);
            this.historial = 1;
            this.anio = '';
            //iniciar spinner
            var loader =  this.$loading.show({
                container: null
            });
            //ocultar spinner
            loader.hide();

        },
        buscarIniFin(){
            console.log('buscarIniFin');
        },

        reportePDF(){
            this.generateReport();
        },

        generateReport () {
            this.$refs.html2Pdf.generatePdf()
            
        },
        async beforeDownload ({ html2pdf, options, pdfContent }) {
              //iniciar spinner
              var loader =  this.$loading.show({
              container: null
              });
              await html2pdf().set(options).from(pdfContent).toPdf().get('pdf').then((pdf) => {
                  const totalPages = pdf.internal.getNumberOfPages()
                  for (let i = 1; i <= totalPages; i++) {
                      pdf.setPage(i)
                      pdf.setFontSize(8)
                      pdf.setTextColor(150)
                      //Footer PDF
                      
                      //paginado
                      pdf.text('Pagina ' + i + ' de ' + totalPages, (pdf.internal.pageSize.getWidth() * 0.81), (pdf.internal.pageSize.getHeight() - 0.9))
                  } 
              }).save()
              //ocultar spinner
              loader.hide();
              this.$toaster.success('¡PDF generado con éxito!')
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
.renglonUno{
    background-color: #13322B;
    color: #fff
}
.renglonDos{
    background-color: #B38E5D;
    color: #fff
}
.fuente{
    font-size: 10px;
}
</style>