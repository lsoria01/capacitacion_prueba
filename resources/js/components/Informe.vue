<template>
    <div>
        <b-navbar toggleable="lg" class="background-nav" type="dark">
        <img v-bind:src="'img/logo-header.svg'" class="logo-gobmx">
        </b-navbar>
        <div class="container">
            <br>
            <h3 class="my-4">Registro de horas de capacitación</h3>
            <br>
            <!-- Información del usuario -->
                <div style="padding-left: 90px; padding-right: 90px;">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                            <th></th>
                            <th></th>
                            <th></th>
                            <th></th>
                            <th></th>
                            <th></th>
                            </tr>
                        </thead>
                        <tbody style="text-align: center;">
                            <tr>
                                <th colspan="3">ID Empleado</th>
                                <th colspan="3">Nombre</th>
                            </tr>
                            <tr>
                                <td colspan="3">150</td>
                                <td colspan="3">Blanca Lizbeth Morales Balderas</td>
                            </tr>
                            <tr>
                                <th colspan="3">Puesto</th>
                                <th colspan="3">Adscripción</th>
                            </tr>
                            <tr>
                                <td colspan="3">Jefatura de departamento eventual</td>
                                <td colspan="3">Coordinación General Territorial</td>
                            </tr>
                            <tr>
                                <th colspan="2">CURP</th>
                                <th colspan="2">Correo Electrónico</th>
                                <th colspan="2">Fecha</th>
                            </tr>
                            <tr>
                                <td colspan="2">SOZL850330HDFRVS00</td>
                                <td colspan="2">luis.soria@centrolaboral.gob.mx</td>
                                <td colspan="2">27/07/2022</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <br> <br>
            <!-- Historial de horas de capacitación -->
            <p class="my-4"><b>A continuación se detalla el historial de las horas de capacitación tomadas en el año 2022:</b></p>
                <table class="table table-striped" style="text-align: center;">
                    <thead>
                        <tr>
                            <th>No.</th>
                            <th>Nombre del curso</th>
                            <th>Calificación</th>
                            <th>Fecha</th>
                            <th>ID_Curso</th>
                            <th>Horas de Capacitación</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>1</td>
                            <td>HACIA UN NUEVO MODELO LABORAL</td>
                            <td>9.5</td>
                            <td>08/03/2022</td>
                            <td>CFCRL05SARS08242022</td>
                            <td>16</td>
                        </tr>
                        <tr>
                            <td>2</td>
                            <td>COMPETENCIAS DE LIDERAZGO Y TRABAJO EN EQUIPO PARA LA ALTA DIRECCIÓN PÚBLICA</td>
                            <td>N/A</td>
                            <td>11/03/2022</td>
                            <td>N/A</td>
                            <td>36</td>
                        </tr>
                    </tbody>
                </table>
                <br> <br>
                <div style="margin-left: 60%;">
                    <table class="table table-striped" style="text-align: center;">
                        <thead>
                            <tr>
                                <th>No.</th>
                                <th>Ejercicio</th>
                                <th>TOTAL DE HORAS DE AÑO</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>1</td>
                                <td>año</td>
                                <td></td>
                            </tr>
                            <tr>
                                <td>2</td>
                                <td>año</td>
                                <td></td>
                            </tr>
                            <tr>
                                <td>3</td>
                                <td>año</td>
                                <td></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <div>
                    <table>
                        <tr>
                            <td><vue-qr text="www.centrolaboral.gob.mx" :callback="test" qid="testid"></vue-qr></td>
                            <td style="text-align: center;">Observaciones:</td>
                        </tr>
                    </table>
                    
                </div>
        </div>
        <!-- Qr -->
      
    <!-- Qr -->
    </div>
</template>

<script>
export default {
    data() {
        return{
            
        } 
    },
    methods:{
        test(dataUrl,id){
            console.log(url, id)
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
</style>

