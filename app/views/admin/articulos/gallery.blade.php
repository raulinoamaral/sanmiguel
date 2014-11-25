@extends('admin/layouts.master')
@section('css')
@parent
{{HTML::style('css/jquery.fileupload.css') }}
@stop
@section('script')
@parent
    {{ HTML::script('js/jquery.ui.widget.js') }}
    {{ HTML::script('js/jquery-ui.js') }}
    {{ HTML::script('js/admin.js') }}
    {{ HTML::script('js/jquery.fileupload.js') }}
    {{ HTML::script('js/load-image.min.js') }}
    {{ HTML::script('js/canvas-to-blob.min.js') }}
    {{ HTML::script('js/jquery.iframe-transport.js') }}
    {{ HTML::script('js/jquery.fileupload-process.js') }}
    {{ HTML::script('js/jquery.fileupload-image.js') }}
    {{ HTML::script('js/fileUpload.js') }}
    <script>

$(function () {
    $('#fileupload').fileupload({
        dataType: 'json',
        autoUpload: true,
        acceptFileTypes: /^image\/(gif|jpeg|png)$/,
        maxNumberOfFiles: 10,
        loadImageFileTypes: /^image\/(gif|jpeg|png)$/,
        done: function(){},
        progressall: function (e, data) {
        var progress = parseInt(data.loaded / data.total * 100, 10);
        $('#progress .bar').css(
            'width',
            progress + '%'
        );
        if(progress == 100)
        {
            $("#agregar-imagenes").removeClass('disabled');
            $("#agregar-imagenes").on("click",function(){
                $('#formAddPhotos').submit();
             });
        }
    },
    disableImageResize: /Android(?!.*Chrome)|Opera/
        .test(window.navigator && navigator.userAgent),
    imageMaxWidth: 800,
    imageMaxHeight: 800,
    imageCrop: true,
    imageQuality: 70.0,
    previewThumbnail: false,
    disableImagePreview: true
    });
});
</script>
    <script>
  $(function() {
    $( "#sortable" ).sortable();
    $( "#sortable" ).disableSelection();
  });
  </script>
@stop
@section('content')
<section id="wrapper" class="container">
    @include('admin.layouts.header')
    <h1>Galer&iacute;a de im&aacute;genes de: {{ $articulo->name }}</h1>
    <p>Arrastre las im&aacute;genes y ord&eacute;nelas a su gusto. Opcionalmente puede agregar una descripci&oacute;n para cada imagen.</p>
    <hr>
    <section id="galeria-articulo">
        {{ Form::open(array('id' => 'formEditGallery', 'method' => 'POST', 'url' => 'admin/articulos/'.$articulo->id.'/updateGallery', 'novalidate', 'onSubmit' => "return actualizarOrdenGaleria()"))}}
        <input type="hidden" value="" id="ordenGaleria" name="ordenGaleria">
        <input type="hidden" value="" id="descripcionGaleria" name="descripcionGaleria">
        <ul id="sortable" class="selector">
            @foreach($articulo->photos()->orderBy('position', 'asc')->get() as $imagen)
                <li id="orden_{{ $imagen->id }}">
                    <img src="{{ $imagen->getMinSrc() }}" width="200" height="200" onDblClick="borrarImagen('{$nombre}', {$value.idFotoPropiedad}, '{$barrio}', '{$tipoPropiedad}')" />
                    <input type="text" class="descripcion" value="{{ $imagen->description }}" id="descripcion_{{ $imagen->id }}" maxlength="200" />
                </li>
            @endforeach
        </ul>
        <div class="clear"></div>
        <div class="row">
            <div class="col-xs-12 col-sm-6 col-md-6 col-lg-6">
                {{ Form::close() }}
                {{ Form::open(array('id' => 'formAddPhotos', 'method' => 'POST', 'files' => 'true', 'url' => 'admin/articulos/'.$articulo->id.'/addPhotos')) }}
                {{ Form::label('Agregar nuevas im&aacute;genes') }}
                <span class="btn btn-success fileinput-button">
                <i class="glyphicon glyphicon-plus"></i>
                <span>Examinar im&aacute;genes...</span>
            {{ Form::file('files[]', array('id' => 'fileupload', 'multiple' => 'true', 'accept' => 'image/jpg')) }}
            </span>
            <div id="contadorArchivosSeleccionados" class="alert @if(!$errors->has('files'))hidden @endif">
            </div>
                
            </div>
            <div class="col-xs-12 col-sm-6 col-md-6 col-lg-6">
                {{ Form::label('') }}
                {{ Form::button('Agregar im&aacute;genes', array('id'=> 'agregar-imagenes', 'class' => 'btn btn-success disabled')) }}
                {{ Form::close() }}
            </div>
        </div>
        <div class="row">
            <div class="col-xs-12 col-sm-6 col-md-6 col-lg-6">
                <!-- The global progress bar -->
            <div id="progress" class="progress progress-striped active">
                <div class="bar progress-bar progress-bar-success" style="width: 0%"></div>
            </div>
            </div>
            <div class="col-xs-12 col-sm-6 col-md-6 col-lg-6">
                <div class="row">
                    <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">
                        {{ Session::flash('message', '<strong>S&oacute;lo un aviso:</strong> No se han guardado cambios en la galer&iacute;a.'); Session::flash('messageType', 'info');   }}
                        <button type="button" class="btn btn-warning" onClick="location.href='{{ URL::previous() }}'">Cancelar</button>
                    </div>
                    <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">
                        <input type="button" class="btn btn-success" onClick="submitForm('formEditGallery')" value="Guardar">
                        </div>

                </div>
            </div>
        </div>
    </section>
</section>
@stop