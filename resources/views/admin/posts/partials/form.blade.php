<div class="form-group">
    {!! Form::label('name', 'Nombre:') !!}
    {!! Form::text('name', null, ['class' => 'form-control', 'placeholder' => "Ingrese el Nombre del Post", 'autocomplete' => 'off']) !!}
    @error('name')
        <small class="text-danger">{{ $message }}</small>
    @enderror
</div>

<div class="form-group">
    {!! Form::label('slug', 'Slug:') !!}
    {!! Form::text('slug', null, ['class' => 'form-control', 'placeholder' => "Ingrese el Slug del Post", 'readonly']) !!}
    @error('slug')
        <small class="text-danger">{{ $message }}</small>
    @enderror
</div>

<div class="form-group">
    {!! Form::label('category_id', 'Categoria') !!}
    {!! Form::select('category_id', $categories, null, ['class' => 'form-control']) !!}
    @error('category_id')
        <small class="text-danger">{{ $message }}</small>
    @enderror
</div>


<div class="form-group">
    <p class="font-weight-bold">Etiquetas</p>
    @foreach ($tags as $tag)
        <label class="mr-2">
            {!! Form::checkbox('tags[]', $tag->id, null) !!}
            {{$tag->name}}
        </label>
    @endforeach
    @error('tags')
        <br>
        <small class="text-danger">{{ $message }}</small>
    @enderror
</div>


<div class="form-group">
    <p class="font-weight-bold">Estado</p>
    <label class="mr-2">
        {!! Form::radio('status', 1, true) !!}
        Borrrador
    </label>
    <label>
        {!! Form::radio('status', 2) !!}
        Publicado
    </label>
    @error('status')
        <small class="text-danger">{{ $message }}</small>
    @enderror
</div>

<div class="row mb-3">
    <div class="col">
        <div class="image-wrapper">
            @isset ($post->image)
                <img id="picture" src="{{ Storage::url($post->image->url) }}" alt="">
            @else
                <img id="picture" src="https://cdn.pixabay.com/photo/2023/06/01/15/30/flowers-8033801_1280.jpg" alt="">
            @endisset
        </div>
    </div>
    <div class="col">
        <div class="from-group">
            {!! Form::label('file', 'Imagen que se mostrará en el post')!!}
            {!! Form::file('file', ['class' => 'form-control-file', 'accept' => 'image/*']) !!}
        </div>
        @error('file')
            <small class="text-danger">{{ $message }}</small>
        @enderror
        <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Perspiciatis, velit. Quis esse fugiat harum sequi adipisci? Tempore ex repudiandae necessitatibus reiciendis repellat suscipit et debitis? Asperiores illum id explicabo minima.</p>
    </div>
</div>


<div class="form-group">
    {!! Form::label('extract', 'Extracto') !!}
    {!! Form::textarea('extract', null, ['class' => 'form-control']) !!}
    @error('extract')
        <small class="text-danger">{{ $message }}</small>
    @enderror
</div>

<div class="form-group">
    {!! Form::label('body', 'Cuerpo del Post') !!}
    {!! Form::textarea('body', null, ['class' => 'form-control']) !!}
    @error('body')
        <small class="text-danger">{{ $message }}</small>
    @enderror
</div>