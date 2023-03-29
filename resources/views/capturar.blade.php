

<!-- <form action ="{{ route ('calificacion.store') }}" method ="POST" enctype ="multipart/form-data"> 
  @csrf
  <div class="row">
    <div class="input-field col s6">
      <input type="file" name= "urlConstancia" class="form-control">
      <label for="modalidad">*constancia:</label>
        <div class="invalid-feedback">
          La descripción es obligatoria
        </div>
        <button class="btn btn-success mt-2" type = "submit">Prueba</button>
        <p>Documentos: <a href="{{Storage::url('n4FtNm3uw2pPkyHNM4Tq5KOUQYPwW2YqqxTYp4RG.jpg')}}">img</a></p>
    </div>
  </div>
</form> -->

<link href="{{asset('css/app.css')}}" rel="stylesheet"> <!--Añadimos el css generado con webpack-->
<div id="app">
    <capturar/>
</div>

<script src="{{asset('js/app.js')}}"></script> <!--Añadimos el js generado con webpack, donde se encuentra nuestro componente vuejs-->