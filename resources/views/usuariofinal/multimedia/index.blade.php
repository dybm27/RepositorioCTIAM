@extends('usuariofinal.multimedia.layoutMultimedia')

@section('contenidoMultimedia')
	<div class="row-title">

		<div class="margen">

			<h2>Publicaciones</h2>

		</div> <!-- /margen -->

	</div> <!-- /row-title -->

	<div class="back-gris" id="multimedia">

		<div class="margen">

			<span class="categoria">Categorías</span>
			
			<ul class="categorias">
				<li><a href="{{route('multimedia_libros')}}">Libros</a></li>
				<li><a href="{{route('multimedia_revistas')}}">Revistas</a></li>
			</ul>

			<ul class="slide-multimedia">
				
				@foreach ($results as $result)
					<li>
						<div class="img-multimedia" style="background-image: url({{asset("EjemploImagenes/libros.png")}})"></div> <!-- /img-multimedia -->
						<div class="txt-temas">
							<p>{{$result['descripcion']}}</p>
							<a class="ver-pdf" data-type="iframe" data-src="{{asset($result['rutaPublica'])}}">
								<p>+ver</p>
							</a>
							<a class="descargar" 
								@if ($result['tipo']=='libro')
								href="{{route('descargar_libro_usuariofinal',$result['id'])}}"
								@else
								href="{{route('descargar_revista_usuariofinal',$result['id'])}}"
								@endif
							>
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

	<div id="videos">

		<div class="row-title">

			<div class="margen">

				<h2>Audiovisual</h2>

			</div> <!-- /margen -->

		</div> <!-- /row-title -->

		<div class="row-videos">

			
			@foreach ($videos as $video)
				<a class="fancybox" href="{{asset($video['rutaPublica'])}}">
					<svg version="1.1" id="play" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" height="70px" width="70px" viewbox="0 0 100 100" enable-background="new 0 0 100 100" xml:space="preserve">
						<path class="stroke-solid" fill="none" d="M49.9,2.5C23.6,2.8,2.1,24.4,2.5,50.4C2.9,76.5,24.7,98,50.3,97.5c26.4-0.6,47.4-21.8,47.2-47.7
							C97.3,23.7,75.7,2.3,49.9,2.5"></path>
						<path class="stroke-dotted" fill="none" d="M49.9,2.5C23.6,2.8,2.1,24.4,2.5,50.4C2.9,76.5,24.7,98,50.3,97.5c26.4-0.6,47.4-21.8,47.2-47.7
							C97.3,23.7,75.7,2.3,49.9,2.5"></path>
						<path class="icon" fill="gray" d="M38,69c-1,0.5-1.8,0-1.8-1.1V32.1c0-1.1,0.8-1.6,1.8-1.1l34,18c1,0.5,1,1.4,0,1.9L38,69z"></path>
					</svg>
					<img src="{{asset('EjemploImagenes/videos.jpg')}}">
				</a>
			@endforeach

			<div class="margen">

				<div class="blog-pagination">
					{{$videos->links()}}
				</div>

			</div> <!-- /margen -->

		</div> <!-- /row-videos -->
		
	</div> <!-- /videos -->
@endsection
