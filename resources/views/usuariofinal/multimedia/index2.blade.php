@extends('usuariofinal.multimedia.layoutMultimedia')

@section('contenidoMultimedia')



	<div class="back-gris">

		<div class="margen">
			
			<ul class="breadcrumbs">
				<li><a href="{{route('multimedia')}}">Multimedia</a> - </li>
				<li>{{$tipo}}</li>		
			</ul> <!-- /breadcrumbs -->

			<span class="categoria">Categorías</span>
			
			<ul class="categorias">
				<li @if ($tipo=='libros')class="active"	@endif>
					<a href="{{route('multimedia_libros')}}">Libros</a>
				</li>
				<li @if ($tipo=='revistas')class="active"	@endif>
					<a href="{{route('multimedia_revistas')}}">Revistas</a>
				</li>
			</ul>

			<ul class="slide-multimedia">
				
				@foreach ($results as $result)
					<li>
						<div class="img-multimedia" style="background-image: url({{asset("EjemploImagenes/libros.png")}})"></div> <!-- /img-multimedia -->
						<div class="txt-temas">
							<p>{{$result['descripcion']}}</p>
							<a class="ver-pdf" data-type="iframe" data-src="{{asset($result['rutaPublica'])}}" href="javascript:;">
								<p>+ver</p>
							</a>
							<a class="descargar" @if ($tipo=='libros')
							href="{{route('descargar_libro_usuariofinal',$result['id'])}}"
							@else
							href="{{route('descargar_revista_usuariofinal',$result['id'])}}"
							@endif>
								<p>Descargar</p>
							</a>
						</div> <!-- /txt-temas -->
					</li>
				@endforeach
			</ul>
		</div>
		
		<div class="blog-pagination">
			{{$results->links()}}
		</div>
	</div> 
@endsection
