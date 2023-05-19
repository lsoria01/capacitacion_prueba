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
              <b-button size="sm" class="botones mb-4" v-b-modal.modal-crear>Crear Usuario</b-button> <br>
            </b-row>

            <!-- Inicio modal crear -->
            
            <b-modal centered id="modal-crear" size="xl" title="Nuevo Usuario" scrollable hide-footer>
              <b-form @submit.prevent="crear">
              <b-row>
                <b-col cols="6">
                  <label>CURP:</label>
                    <b-form-input autocomplete="off" v-model="usuario.curp" style="text-transform:uppercase" maxlength="18">
                    </b-form-input>
                    <span class="span">Escriba el CURP del nuevo usuario:</span>
                </b-col>
                <b-col cols="1">
                  <b-button 
                    class="botones"
                    @click="buscacurp()"
                    style="margin-left: -25px; margin-top: 33px;"
                    v-b-tooltip.hover.right title=" Haga click para buscar la información del CURP ">
                      <b-icon icon="search" animation="fade"></b-icon>
                  </b-button>
                </b-col>
              </b-row>
              <br>
              <hr>
              <br>
              <b-row>
                <b-col cols="3">
                  <label>Apellido Paterno:</label>
                  <b-form-input type="text" v-model="datos.apellido1" autocomplete="off" readonly>
                  </b-form-input>
                </b-col>
                <b-col cols="3">
                  <label>Apellido Materno:</label>
                  <b-form-input type="text" v-model="datos.apellido2" autocomplete="off" readonly>
                  </b-form-input>
                </b-col>
                <b-col cols="6">
                  <label>Nombres:</label>
                  <b-form-input type="text" v-model="datos.nombres" autocomplete="off" readonly>
                  </b-form-input>
                </b-col>
              </b-row>
              <br>
              <b-row>
                <b-col cols="1">
                  <label>Sexo:</label>
                  <b-form-input v-model="datos.sexo" autocomplete="off" readonly>
                  </b-form-input>
                </b-col>
                <b-col cols="3">
                  <label>RFC:</label>
                  <b-form-input v-model="usuario.rfc" style="text-transform:uppercase" autocomplete="off">
                  </b-form-input>
                </b-col>
                <b-col cols="2">
                  <label>No Empleado:</label>
                  <b-form-input v-model="usuario.numEmpl" autocomplete="off">
                  </b-form-input>
                </b-col>
                <b-col cols="6">
                  <label>Email:</label>
                  <b-form-input v-model="usuario.email" autocomplete="off">
                  </b-form-input>
                </b-col>
              </b-row>
              <br>
              <b-row>
                <b-col cols="2">
                  <label>Estatus:</label>
                  <b-form-select v-model="usuario.estatus" :options="estatusOp"></b-form-select>
                </b-col>
                <b-col cols="2">
                  <label>Rol:</label>
                  <b-form-select v-model="usuario.rol" :options="rolOp"></b-form-select>
                </b-col>
                <b-col cols="2">
                  <label>Password:</label>
                  <b-form-input type="password" :type="passwordFieldType" v-model="password" autocomplete="off">
                  </b-form-input>                  
                </b-col>
                <b-col cols="2">
                  <label>Confirmar password:</label>
                  <b-form-input type="password" :type="passwordFieldType" v-model="indicio" autocomplete="off">
                  </b-form-input>
                </b-col>
                <!-- Mensaje de password correcto -->
                <b-col cols="2" v-if="password === indicio && password != '' ">
                  <span class="badge badge-success" style="margin-top: 40px;">Password correcto  <b-icon icon="check-square"></b-icon></span>
                  <p class="success"></p>
                </b-col>
                <b-col cols="1" v-if="password === indicio && password != '' ">
                  <b-button variant="success" size="sm"
                            @click="switchVisibility" style="margin-left: -35px; margin-top: 33px;"
                            v-b-tooltip.hover title=" Haga click para ver/ocultar la contraseña ">
                            <b-icon icon="eye"></b-icon>
                  </b-button>
                </b-col>
                <!-- Mensaje de password incorrecto -->
                <b-col cols="2" v-if="password != indicio && indicio != '' ">
                  <span class="badge badge-danger" style="margin-top: 40px;">Password incorrecto  <b-icon icon="check-square"></b-icon></span>
                  <p class="success"></p>
                </b-col>
              </b-row>
              <br><hr><br>
              <b-row>
                <b-col cols="5">
                  <label>Fecha de ingreso:</label>
                  <b-form-datepicker v-model="usuario.fechaIngr" id="fecha_inicio" placeholder=""></b-form-datepicker>
                </b-col>
                <b-col cols="7">
                  <label>Puesto:</label>
                    <b-form-input list="id_puesto" v-model="usuario.id_puesto" autocomplete="off">
                    </b-form-input>
                    <datalist id="id_puesto">
                      <option v-for="puesto in puestos">{{ puesto.descripcion }}</option>  
                    </datalist>  
                    <span class="span">Seleccione un puesto de la lista:</span>
                </b-col>
              </b-row>
              <b-row>
                <b-col cols="3">
                  <label>Nivel:</label>
                  <b-form-input list="id_nivel" v-model="usuario.id_nivel" autocomplete="off">
                  </b-form-input>
                  <datalist id="id_nivel">
                    <option v-for="nivel in niveles">{{ nivel.nomenclatura }}</option>  
                  </datalist>
                  <span class="span">Seleccione un nivel de la lista:</span>
                </b-col>
                <b-col cols="9">
                  <label>Adscripción:</label>
                  <b-form-input list="id_adscripcion" v-model="usuario.id_adscripcion" autocomplete="off">
                  </b-form-input>
                  <datalist id="id_adscripcion">
                    <option v-for="adscripcion in adscripciones">{{ adscripcion.descripcion }}</option>  
                  </datalist>
                  <span class="span">Seleccione una adscripción de la lista:</span>
                </b-col>
              </b-row>
              <br>
              <b-row>
                <b-col cols="6">
                  <label>Ciudad en donde está adscrita la plaza:</label>
                  <b-form-input v-model="usuario.ciudadAdscr" autocomplete="off">
                  </b-form-input>
                </b-col>
                <b-col cols="6">
                  <label>Estado en donde está adscrita la plaza:</label>
                  <b-form-input list="id_estado" v-model="usuario.id_estado" autocomplete="off">
                  </b-form-input>
                  <datalist id="id_estado">
                    <option v-for="estado in estados">{{ estado.nombre }}</option>  
                  </datalist>
                  <span class="span">Seleccione un estado de la lista:</span>
                </b-col>
              </b-row>
              <br>
              <b-row>
                <b-col cols="5">
                  <label>Último grado de estudios:</label>
                  <b-form-input list="id_gradoEst" v-model="usuario.id_gradoEst" autocomplete="off">
                  </b-form-input>
                  <datalist id="id_gradoEst">
                    <option v-for="grado in grados">{{ grado.nombre }}</option>  
                  </datalist>
                  <span class="span">Seleccione un grado de estudios de la lista:</span>
                </b-col>
                <b-col cols="7">
                  <label>Nombre del último grado de estudios:</label>
                  <b-form-input v-model="usuario.descripEstud" autocomplete="off">
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

            <!-- Inicio modal detalles -->

            <b-modal centered id="modal-detalles" size="xl" title="Detalles del Usuario" scrollable ok-only>
              <b-row>
                <b-col cols="6">
                  <label>CURP:</label>
                    <b-form-input autocomplete="off" v-model="usuario_.curp" style="text-transform:uppercase" maxlength="18" readonly>
                    </b-form-input>
                </b-col>
              </b-row>
              <br>
              <hr>
              <br>
              <b-row>
                <b-col cols="6">
                  <label>Nombre completo:</label>
                  <b-form-input type="text" v-model="usuario_.nombreCompleto" readonly>
                  </b-form-input>
                </b-col>
              </b-row>
              <br>
              <b-row>
                <b-col cols="1">
                  <label>Sexo:</label>
                  <b-form-input v-if="usuario_.sexo === true" value="H" readonly></b-form-input>
                  <b-form-input v-if="usuario_.sexo === false" value="M" readonly></b-form-input>
                </b-col>
                <b-col cols="3">
                  <label>RFC:</label>
                  <b-form-input v-model="usuario_.rfc" style="text-transform:uppercase" readonly>
                  </b-form-input>
                </b-col>
                <b-col cols="2">
                  <label>No Empleado:</label>
                  <b-form-input v-model="usuario_.numEmpl" readonly>
                  </b-form-input>
                </b-col>
                <b-col cols="6">
                  <label>Email:</label>
                  <b-form-input v-model="usuario_.email" readonly>
                  </b-form-input>
                </b-col>
              </b-row>
              <br>
              <b-row>
                <b-col cols="2">
                  <label>Estatus:</label>
                  <b-form-input v-if="usuario_.estatus === true" value="Activo" readonly></b-form-input>
                  <b-form-input v-if="usuario_.estatus === false" value="Inactivo" readonly></b-form-input>
                </b-col>
                <b-col cols="2">
                  <label>Rol:</label>
                  <b-form-input v-if="usuario_.rol === 1" value="Administrador" readonly></b-form-input>
                  <b-form-input v-if="usuario_.rol === 2" value="Usuario" readonly></b-form-input>
                </b-col>
              </b-row>
              <br><hr><br>
              <b-row>
                <b-col cols="5">
                  <label>Fecha de ingreso:</label>
                  <b-form-datepicker v-model="usuario_.fechaIngr" id="fecha_inicio" readonly></b-form-datepicker>
                </b-col>
                <b-col cols="7">
                  <label>Puesto:</label>
                  <b-form-input v-model="usuario_.id_puesto" readonly>
                  </b-form-input>
                </b-col>
              </b-row>
              <b-row>
                <b-col cols="3">
                  <label>Nivel:</label>
                  <b-form-input v-model="usuario_.id_nivel" readonly>
                  </b-form-input>
                </b-col>
                <b-col cols="9">
                  <label>Adscripción:</label>
                  <b-form-input v-model="usuario_.id_adscripcion" readonly>
                  </b-form-input>
                </b-col>
              </b-row>
              <br>
              <b-row>
                <b-col cols="6">
                  <label>Ciudad en donde está adscrita la plaza:</label>
                  <b-form-input v-model="usuario_.ciudadAdscr" readonly>
                  </b-form-input>
                </b-col>
                <b-col cols="6">
                  <label>Estado en donde está adscrita la plaza:</label>
                  <b-form-input v-model="usuario_.id_estado" readonly>
                  </b-form-input>
                </b-col>
              </b-row>
              <br>
              <b-row>
                <b-col cols="5">
                  <label>Último grado de estudios:</label>
                  <b-form-input v-model="usuario_.id_gradoEst" readonly>
                  </b-form-input>
                </b-col>
                <b-col cols="7">
                  <label>Nombre del último grado de estudios:</label>
                  <b-form-input v-model="usuario_.descripEstud" readonly>
                  </b-form-input>
                </b-col>
              </b-row>
            </b-modal>

            <!-- Inicio modal editar -->

            <b-modal centered id="modal-editar" size="xl" title="Editar Usuario" scrollable hide-footer>
              <b-form @submit.prevent="editar(usuario_)">
                <b-row>
                  <b-col cols="6">
                    <label>CURP:</label>
                      <b-form-input autocomplete="off" v-model="usuario_.curp" style="text-transform:uppercase" maxlength="18" readonly>
                      </b-form-input>
                  </b-col>
                </b-row>
                <br>
                <hr>
                <br>
                <b-row>
                  <b-col cols="6">
                    <label>Nombre completo:</label>
                    <b-form-input type="text" v-model="usuario_.nombreCompleto" readonly>
                    </b-form-input>
                  </b-col>
                </b-row>
                <br>
                <b-row>
                  <b-col cols="1">
                    <label>Sexo:</label>
                    <b-form-input v-if="usuario_.sexo === true" value="H" readonly></b-form-input>
                    <b-form-input v-if="usuario_.sexo === false" value="M" readonly></b-form-input>
                  </b-col>
                  <b-col cols="3">
                    <label>RFC:</label>
                    <b-form-input v-model="usuario_.rfc" style="text-transform:uppercase" >
                    </b-form-input>
                  </b-col>
                  <b-col cols="2">
                    <label>No Empleado:</label>
                    <b-form-input v-model="usuario_.numEmpl" >
                    </b-form-input>
                  </b-col>
                  <b-col cols="6">
                    <label>Email:</label>
                    <b-form-input v-model="usuario_.email" >
                    </b-form-input>
                  </b-col>
                </b-row>
                <br>
                <b-row>
                  <b-col cols="2">
                    <label>Estatus:</label>
                    <b-form-select v-model="usuario_.estatus" :options="estatusOp"></b-form-select>
                  </b-col>
                  <b-col cols="2">
                    <label>Rol:</label>
                    <b-form-select v-model="usuario_.rol" :options="rolOp"></b-form-select>
                  </b-col>
                  <b-col cols="2">
                    <label for="">¿Cambiar contraseña?</label>
                    <b-form-checkbox v-model="cambiapwd" name="check-button" switch>
                      <b v-if="cambiapwd"> Si</b> <b v-else>No</b>
                    </b-form-checkbox>
                  </b-col>
                  <b-col cols="2" v-if="cambiapwd == 1">
                    <label>Password:</label>
                    <b-form-input type="password" :type="passwordFieldType" v-model="password">
                    </b-form-input>                  
                  </b-col>
                  <b-col cols="2" v-if="cambiapwd == 1">
                    <label>Confirmar password:</label>
                    <b-form-input type="password" :type="passwordFieldType" v-model="indicio">
                    </b-form-input>
                  </b-col>
                  <!-- Mensaje de password correcto -->
                  <b-col cols="1" v-if="password === indicio && password != '' ">
                    <span class="badge badge-success" style="margin-top: 40px; margin-left:-20px;">Password correcto  <b-icon icon="check-square"></b-icon></span>
                    <p class="success"></p>
                  </b-col>
                  <b-col cols="1" v-if="password === indicio && password != '' ">
                    <b-button variant="success" size="sm"
                              @click="switchVisibility" style="margin-left: 25px; margin-top: 33px;"
                              v-b-tooltip.hover title=" Haga click para ver/ocultar la contraseña ">
                              <b-icon icon="eye"></b-icon>
                    </b-button>
                  </b-col>
                  <!-- Mensaje de password incorrecto -->
                  <b-col cols="1" v-if="password != indicio && indicio != '' ">
                    <span class="badge badge-danger" style="margin-left:-20px; margin-top: 40px;">Password incorrecto  <b-icon icon="x-circle"></b-icon></span>
                    <p class="success"></p>
                  </b-col>
                </b-row>
                <br><hr><br>
                <b-row>
                  <b-col cols="5">
                    <label>Fecha de ingreso:</label>
                    <b-form-datepicker v-model="usuario_.fechaIngr" id="fecha_inicio" ></b-form-datepicker>
                  </b-col>
                  <b-col cols="7">
                    <label>Puesto:</label>
                    <b-form-input list="id_puesto" v-model="usuario_.id_puesto" autocomplete="off">
                    </b-form-input>
                    <datalist id="id_puesto">
                      <option v-for="puesto in puestos">{{ puesto.descripcion }}</option>  
                    </datalist>
                    <span class="span">Si desea editar el puesto, deberá seleccionar uno nuevo de la lista:</span>
                  </b-col>
                </b-row>
                <b-row>
                  <b-col cols="3">
                    <label>Nivel:</label>
                    <b-form-input list="id_nivel" v-model="usuario_.id_nivel" autocomplete="off">
                    </b-form-input>
                    <datalist id="id_nivel">
                      <option v-for="nivel in niveles">{{ nivel.nomenclatura }}</option>  
                    </datalist>
                    <span class="span">Si desea editar el nivel, deberá seleccionar uno nuevo de la lista:</span>
                  </b-col>
                  <b-col cols="9">
                    <label>Adscripción:</label>
                    <b-form-input list="id_adscripcion" v-model="usuario_.id_adscripcion" autocomplete="off">
                    </b-form-input>
                    <datalist id="id_adscripcion">
                      <option v-for="adscripcion in adscripciones">{{ adscripcion.descripcion }}</option>  
                    </datalist>
                    <span class="span">Si desea editar la adscripción, deberá seleccionar una nueva de la lista:</span>
                  </b-col>
                </b-row>
                <br>
                <b-row>
                  <b-col cols="6">
                    <label>Ciudad en donde está adscrita la plaza:</label>
                    <b-form-input v-model="usuario_.ciudadAdscr" >
                    </b-form-input>
                  </b-col>
                  <b-col cols="6">
                    <label>Estado en donde está adscrita la plaza:</label>
                    <b-form-input list="id_estado" v-model="usuario_.id_estado" autocomplete="off">
                    </b-form-input>
                    <datalist id="id_estado">
                      <option v-for="estado in estados">{{ estado.nombre }}</option>  
                    </datalist>
                    <span class="span">Si desea editar el estado, deberá seleccionar uno nuevo de la lista:</span>
                  </b-col>
                </b-row>
                <br>
                <b-row>
                  <b-col cols="5">
                    <label>Último grado de estudios:</label>
                    <b-form-input list="id_gradoEst" v-model="usuario_.id_gradoEst" autocomplete="off">
                    </b-form-input>
                    <datalist id="id_gradoEst">
                      <option v-for="grado in grados">{{ grado.nombre }}</option>  
                    </datalist>
                    <span class="span">Si desea editar el grado de estudios, deberá seleccionar uno nuevo de la lista:</span>
                  </b-col>
                  <b-col cols="7">
                    <label>Nombre del último grado de estudios:</label>
                    <b-form-input v-model="usuario_.descripEstud" >
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
                :items="usuarios"
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
                      v-b-tooltip.hover title="Haga click si desea editar el usuario">
                      <b-icon icon="pencil-square"></b-icon>
                    </b-button>
                    <b-button size="sm" class="botones" @click="cargarDatos(row.item)" v-b-modal.modal-detalles
                      v-b-tooltip.hover title="Haga click si desea ver los detalles del usuario">
                      <b-icon icon="eye"></b-icon>
                    </b-button>
                    <b-button size="sm" class="botones" @click="cambiaEstatus(row.item)"
                      v-b-tooltip.hover title="Haga click si cambiar el estatus del usuario">
                      <b-icon icon="arrow-left-right"></b-icon>
                    </b-button>
                </template>

                <template v-slot:cell(estatus)="row">
                  <p v-if="row.item.estatus === true"> <span style="color: green;">Activo</span></p>
                  <p v-if="row.item.estatus === false"> <span style="color: red;">Inactivo</span></p>                  
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
          { key: 'numEmpl', label: 'Número de Empleado', class: 'text-center small', sortable: true, sortDirection: 'desc' , thStyle: { width: "15%" } },
          { key: 'nombreCompleto', label: 'Nombre completo', class: 'text-center small', sortable: true, sortDirection: 'desc', thStyle: { width: "15%" } },
          { key: 'id_adscripcion', label: 'Adscripcion', class: 'text-center small', sortable: true, sortDirection: 'desc' , thStyle: { width: "15%" } },
          { key: 'email', label: 'Correo electrónico', class: 'text-center small', sortable: true, sortDirection: 'desc' , thStyle: { width: "15%" } },
          { key: 'estatus', label: 'Estatus', class: 'text-center small', sortable: true, sortDirection: 'desc' , thStyle: { width: "15%" } },
          { key: 'actions', class: 'text-center small', label: 'Acciones' }
        ],
        rol:'',
        usrActual:'',
        usuarios:[],
        msgResult:'',
        url: 'http://10.68.8.25:8000/curp',
        password:'',
        passwordFieldType: "password",
        indicio:'',
        cambiapwd: 0,
        datos:{
          apellido1: '',
          apellido2: '',
          nombres: '',
          sexo:''
        },
        usuario:{
          id:'',
          numEmpl:'',
          curp:'',
          nombreCompleto:'',
          rfc:'',
          id:'',
          email:'',
          estatus:'',
          rol:'',
          fechaIngr:'',
          id_puesto:'',
          id_nivel:'',
          id_adscripcion:'',
          ciudadAdscr:'',
          id_estado:'',
          id_gradoEst:'',
          descripEstud:''
        },
        usuario_:{
          id:'',
          numEmpl:'',
          curp:'',
          nombreCompleto:'',
          nombre:'',
          rfc:'',
          id:'',
          email:'',
          indicio:'',
          password:'',
          estatus:'',
          rol:'',
          fechaIngr:'',
          id_puesto:'',
          id_nivel:'',
          id_adscripcion:'',
          ciudadAdscr:'',
          sexo:'',
          id_estado:'',
          id_gradoEst:'',
          descripEstud:''
        },
        estatusOp: [
          { value: true, text: 'Activo' },
          { value: false, text: 'Inactivo' }
        ],
        rolOp: [
          { value: 1, text: 'Administrador' },
          { value: 2, text: 'Usuario' }
        ],
        puestos:{
          id_puesto:'',
          descripcion:'',
        },
        niveles:{
          id_nivel:'',
          nomenclatura:''
        },
        adscripciones:{
          id_adscripcion:'',
          descripcion:''
        },
        estados:{
          id_estado:'',
          nombre:''
        },
        grados:{
          id_gradoEst:'',
          nombre:''
        },
        resultado_puesto: '',
        resultado_nivel:'',
        resultado_adscripcion:'',
        resultado_estado:'',
        resultado_grado:'',
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
        axios.get('/usuario')
        .then(res=>{
            this.usuarios = res.data;
        })
        axios.get('/rol')
        .then(res=>{
            this.rol = res.data;
        })
        axios.get('/usrActual')
        .then(res=>{
            this.usrActual = res.data;
        })
        axios.get('/puesto')
        .then(res=>{
            this.puestos = res.data;
        })
        axios.get('/nivel')
        .then(res=>{
            this.niveles = res.data;
        })
        axios.get('/adscripcion')
        .then(res=>{
            this.adscripciones = res.data;
        })
        axios.get('/estado')
        .then(res=>{
            this.estados = res.data;
        })
        axios.get('/grado')
        .then(res=>{
            this.grados = res.data;
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
        return this.usuarios.length;
      },
    },
    mounted() {
      // Set the initial number of items
      this.totalRows = this.usuarios.length
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
      switchVisibility() {
        this.passwordFieldType = this.passwordFieldType === "password" ? "text" : "password";
      },
      crear(){
        this.msgResult='',
        this.showMsgBoxCrear(); //Modal confirmación

      },
      showMsgBoxCrear(){
        this.$bvModal.msgBoxConfirm(`¿ Confirma que desea guardar el nuevo usuario?`, {
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
                //info del puesto
                var puesto = this.usuario.id_puesto
                var puesto_filter = this.puestos.filter(function(e){
                return e.descripcion === puesto                
                })
                console.log(puesto_filter);
                for( var resultadoPuesto of puesto_filter){
                  this.resultado_puesto = resultadoPuesto.id_puesto
                }
                console.log(this.resultado_puesto); 
                //info del nivel
                var nivel = this.usuario.id_nivel
                var nivel_filter = this.niveles.filter(function(e){
                return e.nomenclatura === nivel                
                })
                console.log(nivel_filter);
                for( var resultadoNivel of nivel_filter){
                  this.resultado_nivel = resultadoNivel.id_nivel
                }
                console.log(this.resultado_nivel);
                //info de la adscripción
                var adscripcion = this.usuario.id_adscripcion
                var adscripcion_filter = this.adscripciones.filter(function(e){
                return e.descripcion === adscripcion                
                })
                console.log(adscripcion_filter);
                for( var resultadoAdscripcion of adscripcion_filter){
                  this.resultado_adscripcion = resultadoAdscripcion.id_adscripcion
                }
                console.log(this.resultado_adscripcion);
                //info del estado
                var estado = this.usuario.id_estado
                var estado_filter = this.estados.filter(function(e){
                return e.nombre === estado                
                })
                console.log(estado_filter);
                for( var resultadoEstado of estado_filter){
                  this.resultado_estado = resultadoEstado.id_estado
                }
                console.log(this.resultado_estado);
                //info grado de estudios
                var grado = this.usuario.id_gradoEst
                var grado_filter = this.grados.filter(function(e){
                return e.nombre === grado                
                })
                console.log(grado_filter);
                for( var resultadoGrado of grado_filter){
                  this.resultado_grado = resultadoGrado.id_gradoEst
                }
                console.log(this.resultado_grado);
                //concatenar apellidos y nombres
                this.usuario.nombreCompleto =  this.datos.nombres + ' ' + this.datos.apellido1 + ' ' + this.datos.apellido2;
                if(this.datos.sexo == 'H'){
                  this.datos.sexo = 1;
                }
                else{
                  this.datos.sexo = 0;
                }
              const params={
                numEmpl: this.usuario.numEmpl,
                curp: this.usuario.curp,
                nombreCompleto: this.usuario.nombreCompleto,
                rfc: this.usuario.rfc,
                sexo: this.datos.sexo,
                email: this.usuario.email,
                estatus: this.usuario.estatus,
                rol: this.usuario.rol,
                password: this.password,
                indicio: this.indicio,
                fechaIngr: this.usuario.fechaIngr,
                id_puesto: this.resultado_puesto,
                id_nivel: this.resultado_nivel,
                id_adscripcion: this.resultado_adscripcion,
                ciudadAdscr: this.usuario.ciudadAdscr,
                id_estado: this.resultado_estado,
                id_gradoEst: this.resultado_grado,
                descripEstud: this.usuario.descripEstud
              }
              console.log(params);
              axios.post('/usuario', params)
              .then(res=>{
                //ocultar modal
                this.$bvModal.hide('modal-crear');
                this.usuarios.push(res.data)
                //mostrar toaster
                this.$toaster.success('¡Usuario creado con éxito!')
                //Limpiamos los campos
                this.usuario.curp = '',
                this.datos.apellido1 = '',
                this.datos.apellido2 = '',
                this.datos.nombres = '',
                this.datos.sexo = '',
                this.usuario.rfc = '',
                this.usuario.numEmpl = '',
                this.usuario.email = '',
                this.usuario.estatus = '',
                this.usuario.rol = '',
                this.password = '',
                this.indicio = '',
                this.usuario.fechaIngr = '',
                this.usuario.id_puesto = '',
                this.usuario.id_nivel = '',
                this.usuario.id_adscripcion = '',
                this.usuario.ciudadAdscr= '',
                this.usuario.id_estado = '',
                this.usuario.id_gradoEst = '',
                this.usuario.descripEstud = '',
                this.resultado_puesto = '',
                this.resultado_nivel ='',
                this.resultado_adscripcion ='',
                this.resultado_estado ='',
                this.resultado_grado =''
                //recargamos cambios
                axios.get('/usuario')
                .then(res=>{
                    this.usuarios = res.data;
                })
                .catch((error) => {
                            if (error) {
                                this.$toaster.error('Lo sentimos, el usuario no se pudo crear ')
                                console.log(error);
                            }
                    })
                })
              }
            })
      },
      cargarDatos(item){
        this.usuario_.id = item.id,
        this.usuario_.numEmpl = item.numEmpl,
        this.usuario_.curp  = item.curp,
        this.usuario_.nombreCompleto  = item.nombreCompleto,
        this.usuario_.rfc  = item.rfc,
        this.usuario_.email  = item.email,
        this.usuario_.indicio  = item.indicio,
        this.usuario_.estatus  = item.estatus,
        this.usuario_.rol  = item.rol,
        this.usuario_.sexo  = item.sexo,
        this.usuario_.password  = item.password,
        this.usuario_.indicio  = item.indicio,
        this.usuario_.fechaIngr  = item.fechaIngr,
        this.usuario_.id_puesto  = item.id_puesto,
        this.usuario_.id_nivel  = item.id_nivel,
        this.usuario_.id_adscripcion  = item.id_adscripcion,
        this.usuario_.ciudadAdscr  = item.ciudadAdscr,
        this.usuario_.id_estado  = item.id_estado,
        this.usuario_.id_gradoEst  = item.id_gradoEst,
        this.usuario_.descripEstud  = item.descripEstud,
        this.password = '',
        this.indicio = '',
        this.cambiapwd = 0
      },
      editar(item){
        this.msgResult='';
        this.showMsgBoxEditar(item); //Modal confirmación
      },
      showMsgBoxEditar(item){
        this.$bvModal.msgBoxConfirm(`¿ Confirma que desea editar el usuario actual ?`, {
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
            //info del puesto
            var puesto_ = this.usuario_.id_puesto
            var puesto_filter_ = this.puestos.filter(function(e){
            return e.descripcion === puesto_                
            })
            console.log(puesto_filter_);
            for( var resultadoPuesto_ of puesto_filter_){
              this.resultado_puesto = resultadoPuesto_.id_puesto
            }
            console.log(this.resultado_puesto); 
            //info del nivel
            var nivel_ = this.usuario_.id_nivel
            var nivel_filter_ = this.niveles.filter(function(e){
            return e.nomenclatura === nivel_                
            })
            console.log(nivel_filter_);
            for( var resultadoNivel_ of nivel_filter_){
              this.resultado_nivel = resultadoNivel_.id_nivel
            }
            console.log(this.resultado_nivel);
            //info de la adscripción
            var adscripcion_ = this.usuario_.id_adscripcion
            var adscripcion_filter_ = this.adscripciones.filter(function(e){
            return e.descripcion === adscripcion_                
            })
            console.log(adscripcion_filter_);
            for( var resultadoAdscripcion_ of adscripcion_filter_){
              this.resultado_adscripcion = resultadoAdscripcion_.id_adscripcion
            }
            console.log(this.resultado_adscripcion);
            //info del estado
            var estado_ = this.usuario_.id_estado
            var estado_filter_ = this.estados.filter(function(e){
            return e.nombre === estado_                
            })
            console.log(estado_filter_);
            for( var resultadoEstado_ of estado_filter_){
              this.resultado_estado = resultadoEstado_.id_estado
            }
            console.log(this.resultado_estado);
            //info grado de estudios
            var grado_ = this.usuario_.id_gradoEst
            var grado_filter_ = this.grados.filter(function(e){
            return e.nombre === grado_                
            })
            console.log(grado_filter_);
            for( var resultadoGrado_ of grado_filter_){
              this.resultado_grado = resultadoGrado_.id_gradoEst
            }
            console.log(this.resultado_grado);
            if(this.cambiapwd == 1){
              this.usuario_.password = this.password;
            }
            if(this.cambiapwd == 0){
              this.usuario_.password = item.indicio;
            }
            const params = {
              rfc: item.rfc,
              numEmpl: item.numEmpl,
              email: item.email,
              estatus: item.estatus,
              rol: item.rol,
              password: this.usuario_.password,
              indicio: this.usuario_.password,
              fechaIngr: item.fechaIngr,
              id_puesto: this.resultado_puesto,
              id_nivel: this.resultado_nivel,
              id_adscripcion: this.resultado_adscripcion,
              ciudadAdscr: item.ciudadAdscr,
              id_estado: this.resultado_estado,
              id_gradoEst: this.resultado_grado,
              descripEstud: item.descripEstud
            }
            console.log(params);
            axios.put(`/usuario/${item.id}`, params)
            .then(res =>{
              //ocultar modal
              this.$bvModal.hide('modal-editar');
              const index = this.usuarios.findIndex(
                usuarioBuscar => usuarioBuscar.id === item.id
              )
              this.usuarios[index] = res.data
              //mostrar toaster
              this.$toaster.success('Usuario actualizado con éxito')
              //limpiamos campos password e indicio
              this.password = '',
              this.indicio = '',
              this.cambiapwd = 0
              //Recargamos los cambios
              axios.get('/usuario')
                .then(res=>{
                    this.usuarios = res.data
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
      cancelar(){
            this.$bvModal.hide('modal-editar');
      },
      logout() {
          axios.post('/logout')
          .then(res=>{
              window.location.href = '/login';
          })              
      },
      prueba(){
        console.log("api renapo");
        axios.get(`${this.url}`)
        .then(res=>{
            console.log(res.data);
        })
      },
      buscacurp(){
        axios.get(`${this.url}/${this.usuario.curp}`)
        .then(res=>{
            this.datos = res.data.datos;
            if(this.datos){
              this.$toaster.success('Datos de usuario encontrados!')
            }
        })
        .catch((error) => {
            if (error) {
                this.$toaster.error('Lo sentimos, intente de nuevo ')
                //limpiamos campos
                this.datos.apellido1 = '';
                this.datos.apellido2 = '';
                this.datos.nombres = '';
                this.datos.sexo = '';
                console.log(error);
            }
        })
      },
      cambiaEstatus(item){
          this.$bvModal.msgBoxConfirm('¿Está seguro de cambiar el estatus? esta acción no se puede revertir',
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
                        axios.post(`usuario/cambiaEstatus/${item.id}`)
                        .then(res => {
                            //ocultar spinner
                            loader.hide();
                            //mostrar toaster
                            this.$toaster.success('¡Estatus cambiado con éxito!')
                            //Refrescamos cambios
                            axios.get('/usuario')
                            .then(res=>{
                                this.usuarios = res.data;
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
.span{
  color:#B38E5D;
  font-size:14px;
}

/* label {
  font-weight: bold;
} */
</style>