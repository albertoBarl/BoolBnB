@extends('layouts.app')
@section('content')

<div class="jumbotron my_jumbotron p-5 mb-4 bg-light">
    <div class="container py-5 text-center w-100">

        <div class="logo_laravel">
            <img src="https://seeklogo.com/images/A/airbnb-logo-1D03C48906-seeklogo.com.png" alt="airbnb-logo-sm" class="airbnblogosm">
        </div>

        <h1 class="display-5 fw-bold text-white">
            Affitta con AirBnB
        </h1>

        <a class="btn btn-light mt-3" href="{{ route('admin.apartments.index') }}">{{ __('Aggiungi una struttura') }}</a>

    </div>
</div>

<div class="content">
    <div class="container">
        
        <div class="row row-cols-1 row-cols-md-2 row-cols-lg-3 g-4">

            <div class="col text-center">
                <div class="card h-100">
                    <div class="card-header">
                        Appartamenti
                    </div>

                    <div class="card-body">
                        <p class="card-text">Nessun appartamento è troppo piccolo o troppo elegant. Lorem ipsum dolor sit amet consectetur adipisicing elit. Ducimus laborum consectetur cumque.</p>
                    </div>

                </div>
            </div>

            <div class="col text-center">
                <div class="card h-100">
                    <div class="card-header">
                        Baite
                    </div>

                    <div class="card-body">
                        <p class="card-text">Non importa quanto sperduta se lorem ipsum, dolor sit amet consectetur adipisicing elit. Iusto, perspiciatis.</p>
                    </div>
                    
                </div>
            </div>

            <div class="col text-center">
                <div class="card h-100">
                    <div class="card-header">
                        Grotte
                    </div>

                    <div class="card-body">
                        <p class="card-text">Umide e poco arredate o lussuose con lorem, ipsum dolor sit amet consectetur adipisicing elit. Eos ipsum numquam veniam tempora obcaecati! Lorem ipsum dolor sit amet.</p>
                    </div>
                    
                </div>
            </div>

            <div class="col text-center">
                <div class="card h-100">
                    <div class="card-header">
                        Trulli
                    </div>

                    <div class="card-body">
                        <p class="card-text">Trullallero trullallà Lorem ipsum, dolor sit amet consectetur adipisicing elit. Est, ducimus. Saepe similique, esse inventore eveniet veniam voluptas ratione vel atque.</p>
                    </div>
                    
                </div>
            </div>

            <div class="col text-center">
                <div class="card h-100">
                    <div class="card-header">
                        Wow!
                    </div>

                    <div class="card-body">
                        <p class="card-text">Tutte le case che non rientrano in nessuna categoria Lorem ipsum dolor sit amet consectetur adipisicing elit. At quia illo necessitatibus. Lorem ipsum dolor.</p>
                    </div>
                    
                </div>
            </div>

            <div class="col text-center">
                <div class="card h-100">
                    <div class="card-header">
                        Castelli
                    </div>

                    <div class="card-body">
                        <p class="card-text">Dal più grande al più piccolo, ogni castello fa sentire come se Lorem, ipsum dolor sit amet consectetur adipisicing elit. Optio, officiis. Lorem ipsum dolor sit amet consectetur adipisicing.</p>
                    </div>
                    
                </div>
            </div>

        </div>

    </div>
</div>

<footer class="row align-items-center my_footercontainer px-5 bg-light mt-5 shadow-sm">

    <!-- <div class="col-9 my_footercolmd">
        <ul>
            <li>© 2023 Airbnb, Inc.</li>
            <li><a href="#">Privacy</a> &#x2022; <a href="#">Termini</a> &#x2022; <a href="#">Mappa del sito</a> &#x2022; <a href="#">Dettagli dell'azienda</a> &#x2022; <a href="#">Destinazioni</a></li>
        </ul>
    </div> -->

    <div class="col-9 my_footercollg py-3">
            © 2023 Airbnb, Inc. &#x2022; <a href="#">Privacy</a> &#x2022; <a href="#">Termini</a> &#x2022; <a href="#">Mappa del sito</a> &#x2022; <a href="#">Dettagli dell'azienda</a> &#x2022; <a href="#">Destinazioni</a>
    </div>

    <div class="col-3 text-end"> <a class="btn my_footerbtn" role="button" data-bs-toggle="offcanvas" href="#offcanvasFooter" aria-controls="offcanvasFooter">Supporto e risorse <fa icon="angle-up" /></a> </div>

</footer>

@endsection