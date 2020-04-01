@extends('admin.layout')

@section('header')
       <h1>
        NOTICIAS
        <small>Crear publicacion</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="{{ route('dashboard') }}"><i class="fa fa-dashboard"></i> Inicio</a></li>
        <li><a href="{{ route('admin.posts.index') }}"><i class="fa fa-list"></i> Noticias</a></li>
        <li class="active">Crear</li>

      </ol>
@stop

@section('content')
<div class="row">

    <form method="POST" action=" {{ route('admin.posts.update', $post) }}">
        {{ csrf_field() }} {{ method_field('PUT') }}
	<div class="col-md-8">
		
	 <div class="box box-primary">

            

            <div class="box-body">

            	<div class="form-group {{ $errors->has('title') ? 'has-error' : ''}}">
            		<label>Titulo de la noticia</label>
            		<input name="title" class="form-control" value="{{ old('title', $post->title) }}"
                    placeholder="Ingresa aqui el titulo de la noticia">

                    {!! $errors->first('title', '<span class="help-block">:message</span>') !!}
            	</div>

                <div class="form-group {{ $errors->has('body') ? 'has-error' : ''}}">
                    <label>Contenido de la publicación</label>
                    <textarea rows="10" name="body" id="editor" class="form-control" placeholder="Ingresa el contenido completo de la noticia">{{ old('body', $post->body )}}</textarea>

                    {!! $errors->first('body', '<span class="help-block">:message</span>') !!}
                    
                </div>
            </div>
    </div>
</div>

	<div class="col-md-4">
        <div class=" box box-primary">

    <div class="box-body"> 

        <div class="form-group">
                <label>Fecha de publicación:</label>

                <div class="input-group date">
                  <div class="input-group-addon">
                    <i class="fa fa-calendar"></i>
                  </div>
                  <input name="published_at"
                  class="form-control pull-right" 
                  value="{{ old('published_at', $post->published_at ? $post->published_at->format('d/m/Y') : null) }}"
                  type="text" 
                  id="datepicker">
                </div>
                <!-- /.input group -->
              </div>

                <div class="form-group {{ $errors->has('category') ? 'has-error' : ''}}">
                    <label>Categorias</label>
                    <select name="category" class="form-control">
                        <option value="">Selecciona una categoria</option>
                        @foreach($categories as $category)
                        <option value="{{ $category->id}}"
                            {{ old('category', $post->category_id ) == $category->id ? 'selected' : '' }}
                            > {{ $category->name}}</option>
                        @endforeach
                        
                    </select>


                {!! $errors->first('category', '<span class="help-block">:message</span>') !!}

                </div>

                <div class="form-group {{ $errors->has('tags') ? 'has-error' : ''}}">
                <label>Etiquetas</label>
                <select name="tags[]" 
                class="form-control select2"    
                multiple="multiple"        
                data-placeholder="Seleciona una o más etiquetas" 
                    style="width: 100%;">
                        @foreach($tags as $tag)
                        <option {{ collect(old('tags',$post->tags->pluck('id')))->contains($tag->id) ? 'selected' : ''}} 
                            value="{{ $tag->id }}">{{ $tag->name }}</option>
                @endforeach
                </select>

                    {!! $errors->first('tags', '<span class="help-block">:message</span>') !!}

                </div>

                <div class="form-group {{ $errors->has('excerpt') ? 'has-error' : ''}}">
                    <label>Extracto de la noticia</label>
                    <textarea name="excerpt" 
                    class="form-control" 
                    placeholder="Ingresa un extracto de la noticia">{{ old('excerpt', $post->excerpt )}}</textarea>

                    {!! $errors->first('excerpt', '<span class="help-block">:message</span>') !!}
                    
                </div>
                <div class="form-group">
                    <div class="dropzone"></div>
                    
                </div>
                <div type="submit" class="form-group">
                    <button class="btn btn-primary btn-block">Guardar noticia</button>
                </div>
            </div>
         </div>
        </div>
   </form>
</div>

@stop

@push('styles')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.7.0/dropzone.css">
    <link rel="stylesheet" href="/adminlte/plugins/datepicker/datepicker3.css">
    <link rel="stylesheet" href="/adminlte/plugins/select2/select2.min.css">
@endpush

@push('scripts')
<script src="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.7.0/min/dropzone.min.js"></script>
<script src="https://cdn.ckeditor.com/4.13.0/standard/ckeditor.js"></script>
<script src="/adminlte/plugins/select2/select2.full.min.js"></script>
<script src="/adminlte/plugins/datepicker/bootstrap-datepicker.js"></script>

<script>
        $('#datepicker').datepicker({
      autoclose: true
    });
        $('.select2').select2();

    CKEDITOR.replace('editor');

    var myDropzone = new Dropzone('.dropzone', {
        url: '/admin/posts/{{ $post->url }}/photos',
        paramName: 'photo',
        acceptedFiles: 'image/*',
        maxFilessize: 2,
        headers: {
            'X-CSRF-TOKEN': '{{ csrf_token() }}'
        },
        dictDefaultMessage: 'Arrastra las fotos aqui para subirlas'
    });

    myDropzone.on('error', function(file, res){
        var msg = res.errors.photo[0];
        $('.dz-error-message:last> span').text(msg);
    });

    Dropzone.autoDiscover = false;



</script>

@endpush


