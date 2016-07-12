@extends('layout')

@section('content')
    <div class="container">
      <h1>Contactele noastre</h1>
      <h4>Dacă aveți întrebări scrie un mesaj!</h4>
    </div>
    <div id="map"></div>
    <div class="container">
      <div class="row">
        <div class="col l6 m12 s12">
          <h3 class="styled1">Datele de contact</h3>
          <ul class="contacts">
            <li>
              <i class="icon-pin"></i>
              <h4 class="styled2">Adresa noastră</h4>
              <p class="c_base">mun. Chișinău, str. Mihai Viteazu 43</p>
            </li>
            <li>
              <i class="icon-email"></i>
              <h4 class="styled2">Adresa electronică</h4>
              <p class="c_base">info@ecommerce.md</p>
            </li>
            <li>
              <i class="icon-phone"></i>
              <h4 class="styled2">Telefon de contact</h4>
              <p><strong class="small">Directorul Executiv /</strong><span class="c_base">+373 69 221 478</span></p>
              <p><strong class="small">Departamentul de vânzări /</strong><span class="c_base">+373 69 221 478</span></p>
              <p><strong class="small">Departamentul tehnic /</strong><span class="c_base">+373 69 221 478</span></p>
            </li>
          </ul>
        </div>
        <div class="col l6 m12 s12">
          <div class="wrapp_form styled1 on_map">
            <form class="form styled2 row" action="{{ URL::to('send_form') }}" method="POST">
             @include('partials.errors.list')
              <h5  class="col s12">Formă de contact</h5>

              <div class="col s12">
                <div class="input-field">
                  <input type="text" name="name" placeholder="Numele prenumele">
                </div>
              </div>
              <div class="col s12">
                <div class="input-field">
                  <input type="email" name="email" placeholder="Adresa electronica">
                </div>
              </div>
              <div class="col s12">
                <div class="input-field">
                <div class="inline-inputs">
                  <input type="text" name="phone" placeholder="Telefon">                        
                </div>        
                </div>
              </div>
              <div class="col s12">
                <div class="input-field">
                <div class="inline-inputs">
                <textarea name="message" placeholder="Mesajul Dvs"></textarea>                      
                </div>        
                </div>
              </div>
              {{csrf_field()}}
              <div class="col s12">
                <input type="submit" class="btn btn_base center-block full_width" value="Trimite mesajul">
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
@endsection
