@extends('app.layouts.app')
@section('content')
	
<div class="banner_section">
	<div class="container-fluid">
		<section class="slide-wrapper">
			<div class="container-fluid">
				<div id="myCarousel" class="carousel slide" data-ride="carousel">
					<!-- Indicators -->
					<ol class="carousel-indicators">
						<li data-target="#myCarousel" data-slide-to="0" class="active"></li>
						<li data-target="#myCarousel" data-slide-to="1"></li>
						<li data-target="#myCarousel" data-slide-to="2"></li>
						<li data-target="#myCarousel" data-slide-to="3"></li>
					</ol>

					<!-- Wrapper for slides -->
					<div class="carousel-inner">
						<div class="carousel-item active">
							<div class="row">
								<div class="col-sm-2 padding_0">
									<p class="mens_taital">Men Shoes</p>
									<div class="page_no">0/2</div>
									<p class="mens_taital_2">Men Shoes</p>
								</div>
								<div class="col-sm-5">
									<div class="banner_taital">
										<h1 class="banner_text">New Running Shoes </h1>
										<h1 class="mens_text"><strong>Men's Like Plex</strong></h1>
										<p class="lorem_text">ipsum dolor sit amet, consectetur adipiscing elit,
											sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.
										</p>
										<button class="buy_bt">Buy Now</button>
										<button class="more_bt">See More</button>
									</div>
								</div>
								<div class="col-sm-5">
									<div class="shoes_img">
										<img src="{{ asset('img/mobil.png')}}">
									</div>
								</div>
							</div>
						</div>
						<div class="carousel-item">
							<div class="row">
								<div class="col-sm-2 padding_0">
									<p class="mens_taital">Men Shoes</p>
									<div class="page_no">0/2</div>
									<p class="mens_taital_2">Men Shoes</p>
								</div>
								<div class="col-sm-5">
									<div class="banner_taital">
										<h1 class="banner_text">New Running Shoes </h1>
										<h1 class="mens_text"><strong>Men's Like Plex</strong></h1>
										<p class="lorem_text">ipsum dolor sit amet, consectetur adipiscing elit,
											sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.
										</p>
										<button class="buy_bt">Buy Now</button>
										<button class="more_bt">See More</button>
									</div>
								</div>
								<div class="col-sm-5">
									<div class="shoes_img"><img
											src="{{ asset('img/mobil.png')}}"></div>
								</div>
							</div>
						</div>
						<div class="carousel-item">
							<div class="row">
								<div class="col-sm-2 padding_0">
									<p class="mens_taital">Men Shoes</p>
									<div class="page_no">0/2</div>
									<p class="mens_taital_2">Men Shoes</p>
								</div>
								<div class="col-sm-5">
									<div class="banner_taital">
										<h1 class="banner_text">New Running Shoes </h1>
										<h1 class="mens_text"><strong>Men's Like Plex</strong></h1>
										<p class="lorem_text">ipsum dolor sit amet, consectetur adipiscing elit,
											sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.
										</p>
										<button class="buy_bt">Buy Now</button>
										<button class="more_bt">See More</button>
									</div>
								</div>
								<div class="col-sm-5">
									<div class="shoes_img"><img
											src="{{ asset('img/mobil.png')}}"></div>
								</div>
							</div>
						</div>
						<div class="carousel-item">
							<div class="row">
								<div class="col-sm-2 padding_0">
									<p class="mens_taital">Men Shoes</p>
									<div class="page_no">0/2</div>
									<p class="mens_taital_2">Men Shoes</p>
								</div>
								<div class="col-sm-5">
									<div class="banner_taital">
										<h1 class="banner_text">New Running Shoes </h1>
										<h1 class="mens_text"><strong>Men's Like Plex</strong></h1>
										<p class="lorem_text">ipsum dolor sit amet, consectetur adipiscing elit,
											sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.
										</p>
										<button class="buy_bt">Buy Now</button>
										<button class="more_bt">See More</button>
									</div>
								</div>
								<div class="col-sm-5">
									<div class="shoes_img"><img
											src="{{ asset('img/mobil.png')}}"></div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</section>
	</div>
</div>
</div>
<!-- header section end -->
<!-- new collection section start -->
<div class="layout_padding collection_section">
<div class="container">
	<h1 class="new_text"><strong>New Collection</strong></h1>
	<p class="consectetur_text">consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et
		dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation</p>
	<div class="collection_section_2">
		<div class="row">
			<div class="col-md-6">
				<div class="about-img">
					<button class="new_bt">New</button>
					<div class="shoes-img"><img src="{{ asset('img/mobil.png')}}"></div>
					<p class="sport_text">Men Sports</p>
					<div class="dolar_text">$<strong style="color: #f12a47;">90</strong> </div>
					<div class="star_icon">
						<ul>
							<li><a href="#"><img src="{{ asset('pullo/images/star-icon.png')}}"></a></li>
							<li><a href="#"><img src="{{ asset('pullo/images/star-icon.png')}}"></a></li>
							<li><a href="#"><img src="{{ asset('pullo/images/star-icon.png')}}"></a></li>
							<li><a href="#"><img src="{{ asset('pullo/images/star-icon.png')}}"></a></li>
							<li><a href="#"><img src="{{ asset('pullo/images/star-icon.png')}}"></a></li>
						</ul>
					</div>
				</div>
				<button class="seemore_bt">See More</button>
			</div>
			<div class="col-md-6">
				<div class="about-img2">
					<div class="shoes-img2"><img src="{{ asset('img/mobil.png')}}"></div>
					<p class="sport_text">Men Sports</p>
					<div class="dolar_text">$<strong style="color: #f12a47;">90</strong> </div>
					<div class="star_icon">
						<ul>
							<li><a href="#"><img src="{{ asset('pullo/images/star-icon.png')}}"></a></li>
							<li><a href="#"><img src="{{ asset('pullo/images/star-icon.png')}}"></a></li>
							<li><a href="#"><img src="{{ asset('pullo/images/star-icon.png')}}"></a></li>
							<li><a href="#"><img src="{{ asset('pullo/images/star-icon.png')}}"></a></li>
							<li><a href="#"><img src="{{ asset('pullo/images/star-icon.png')}}"></a></li>
						</ul>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
</div>
<div class="collection_section">
<div class="container">
	<h1 class="new_text"><strong>Racing Boots</strong></h1>
	<p class="consectetur_text">consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et
		dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation</p>
</div>
</div>
<div class="collectipn_section_3 layuot_padding">
<div class="container">
	<div class="racing_shoes">
		<div class="row">
			<div class="col-md-8">
				<div class="shoes-img3"><img src="{{ asset('img/mobil.png')}}"></div>
			</div>
			<div class="col-md-4">
				<div class="sale_text"><strong>Sale <br><span style="color: #0a0506;">JOGING</span>
						<br>SHOES</strong></div>
				<div class="number_text"><strong>$ <span style="color: #0a0506">100</span></strong></div>
				<button class="seemore">See More</button>
			</div>
		</div>
	</div>
</div>
</div>
<div class="collection_section layout_padding">

</div> 
 

@endsection