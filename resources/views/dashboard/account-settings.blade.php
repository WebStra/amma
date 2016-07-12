
@extends('layout')
@section('content')

    <div class="container">
        <ul class="breadcrumbs">
            <li>
                <a href="#" class="icon-home"></a>
            </li>
            <li><a href="#" class="">Contul meu </a></li>
            <li>Setarile contului</li>
        </ul>
    </div>
    <section class="">
        <div class="container">
            <div class="row">
                <div class="col l3 m5 s12">
                    <div class="bordered divide-top">
                        <div class="person_card styled1">
                            <div class="display_flex border_bottom">
                                <div class="wrapp_img">
                                    <img src="assets/images/avatar1.jpg">
                                </div>
                                <div class="content">
                                    <h4>Nume Prenume</h4>
                                    <a href="#" class="btn_ btn_small btn_base waves-effect waves-teal f_small">Adaugă un produs</a>
                                </div>
                            </div>
                            <div class="buttons">
                                <ul class="links_to">
                                    <li><a href="#" class="active">Istoria cumpărăturilor</a></li>
                                    <li><a href="#">Produse Favorite (10)</a></li>
                                    <li><a href="#">Produsele mele (10)</a></li>
                                    <li><a href="#">Vouchere (2)</a></li>
                                    <li><a href="#">Setările contului</a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    
                </div>
                <div class="col l9 m7 s12">
                <div class="col s12">
                  <ul class="tabs">
                    <li class="tab"><a  class="active"  href="#personal_data">DATE PERSONALE</a></li>
                    <li class="tab"><a href="#livrare">DATELE LIVRĂRII</a></li>
                    <li class="tab"><a href="#juridice">PERSOANE JURIDICE</a></li>
                    <li class="tab"><a href="#card_data">DATELE CARDULUI</a></li>
                  </ul>
                </div>
                <div id="personal_data" class="col s12 tab_content">
                  
                  <form action="{{URL::to('setupdate')}}" method="POST" class="form styled2 row" enctype="multipart/form-data">
                   @include('partials.errors.list')   
                    <div class="col l12 m12 s12">
                      <div class="file-field input-field">
                        <div class="wrapp_img left">
                          <img src="assets/images/user_avatar/no-avatar2.png" height="78" width="78">
                        </div>
                        <div class="left">
                          <div class="btn_ btn_base input_file xsmall">
                            <span>Încarcă o poză</span>
                            <input type="file" name="photo">
                          </div>
                        </div>
                        <p class="left">* PNG, JPG minim 76x76px, proportie 1:1</p>
                      </div>
                    </div>
                    <div class="col l6 m6 s12">
                      <div class="input-field">
                      <span class="label">NUMELE</span>
                        <input type="text" name="fname" value="{{ Auth::user()->profile->firstname }}" placeholder="Ex: Ion">
                      </div>
                    </div>
                    <div class="col l6 m6 s12">
                      <div class="input-field">
                      <span class="label">PRENUMELE</span>
                        <input type="text" name="lname" value="{{ Auth::user()->profile->lastname }}" placeholder="Ex: Ciobanu">
                      </div>
                    </div>
                    <div class="col l6 m6 s12">
                      <div class="input-field">
                      <span class="label">TELEFON</span>
                        <input type="text" name="phone" value="{{ Auth::user()->profile->phone }}" placeholder="Ex: 070 323 677">
                      </div>
                    </div>
                    <div class="col l6 m6 s12">
                      <div class="input-field">
                      <span class="label">EMAIL</span>
                        <input type="email" name="email" value="{{ Auth::user()->email }}" placeholder="Ex: maria@gmail.com">
                      </div>
                    </div>
                    <div class="col l6 m6 s12">
                      <div class="input-field">
                      <span class="label">PAROLA</span>
                        <input type="password" name="password">
                      </div>
                    </div>
                    <div class="col l6 m6 s12">
                      <div class="input-field">
                      <span class="label">CONFIRMA PAROLA</span>
                        <input type="password" name="password_confirmation">
                      </div>
                    </div>
                    {{csrf_field()}}
                    <div class="col l8 m12 s12 offset-l2">
                        <input type="submit" class="btn btn_base center-block full_width" value="Trimite">
                    </div>
                  </form>
                </div>
                <div id="livrare" class="col s12 tab_content">
                  <div class="form_list" id="template1">
                    <div class="element  template"  >
                      <form action="#" class=" form styled2 row">
                        <div class="col l6 m6 s12">
                          <div class="input-field">
                          <span class="label">BENEFICIARUL</span>
                            <input type="text" placeholder="Ex: Ion Ciobanu">
                          </div>
                        </div>
                        <div class="col l6 m6 s12">
                          <div class="input-field select-field">
                          <span class="label">TARA</span>
                            <select class="no-init">
                                  <option value="" disabled selected>Alege Tara</option>                                  
                                  <option value="1">Option 1</option>
                                  <option value="2">Option 2</option>
                                  <option value="3">Option 3</option>
                                </select>
                          </div>
                        </div>
                        <div class="col l6 m6 s12">
                          <div class="input-field">
                          <span class="label">ORAȘUL</span>
                            <select class="no-init">
                                  <option value="" disabled selected>Alege Orasul</option>                                  
                                  <option value="1">Option 1</option>
                                  <option value="2">Option 2</option>
                                  <option value="3">Option 3</option>
                                </select>
                          </div>
                        </div>
                        <div class="col l6 m6 s12">
                          <div class="input-field">
                          <span class="label">ZIP / CODUL POȘTAL</span>
                            <input type="text" placeholder="Ex: 2008">
                          </div>
                        </div>
                        <div class="col l6 m6 s12">
                          <div class="input-field">
                          <span class="label">TELEFON</span>
                          <div class="inline-inputs">
                          <span class="like_input"> <span class="flag-icon flag-icon-md"></span> +373 </span>
                            <input type="text"placeholder="Ex: xx xxx xxx">                        
                          </div>
                      
                          </div>
                        </div>
                        <div class="col l6 m6 s12">
                          <div class="input-field">
                          <span class="label">MOBIL</span>
                            <input type="text" placeholder="Ex: 070 323 677">
                          </div>
                        </div>
                      </form>
                    </div>
                    <div class="element">
                      <form action="#" class=" form styled2 row">
                        <div class="col l6 m6 s12">
                          <div class="input-field">
                          <span class="label">BENEFICIARUL</span>
                            <input type="text" placeholder="Ex: Ion Ciobanu">
                          </div>
                        </div>
                        <div class="col l6 m6 s12">
                          <div class="input-field select-field">
                          <span class="label">TARA</span>
                            <select>
                                  <option value="" disabled selected>Alege Tara</option>                                  
                                  <option value="1">Option 1</option>
                                  <option value="2">Option 2</option>
                                  <option value="3">Option 3</option>
                                </select>
                          </div>
                        </div>
                        <div class="col l6 m6 s12">
                          <div class="input-field">
                          <span class="label">ORAȘUL</span>
                            <select>
                                  <option value="" disabled selected>Alege Orasul</option>                                  
                                  <option value="1">Option 1</option>
                                  <option value="2">Option 2</option>
                                  <option value="3">Option 3</option>
                                </select>
                          </div>
                        </div>
                        <div class="col l6 m6 s12">
                          <div class="input-field">
                          <span class="label">ZIP / CODUL POȘTAL</span>
                            <input type="text" placeholder="Ex: 2008">
                          </div>
                        </div>
                        <div class="col l6 m6 s12">
                          <div class="input-field">
                          <span class="label">TELEFON</span>
                          <div class="inline-inputs">
                          <span class="like_input"> <span class="flag-icon flag-icon-md"></span> +373 </span>
                            <input type="text"placeholder="Ex: xx xxx xxx">                        
                          </div>
                      
                          </div>
                        </div>
                        <div class="col l6 m6 s12">
                          <div class="input-field">
                          <span class="label">MOBIL</span>
                            <input type="text" placeholder="Ex: 070 323 677">
                          </div>
                        </div>
                      </form>
                    </div>

                  </div>
                  <span class="add_clone_after right" data-id="template1"><span class="icon-plus"></span> Adaugă o adresă nouă</span>
                </div>
                <div id="juridice" class="col s12 tab_content">
                3
                </div>
                <div id="card_data" class="col s12 tab_content">
                  <div class="form_list" id="template2">
                    <div class="element  template"  >
                      <form action="#" class=" form styled2 row">
                        <div class="col l6 m6 s12">
                          <div class="input-field">
                          <span class="label">NUMELE PRENUMELE</span>
                            <input type="text" placeholder="Ex: Ion Ciobanu">
                          </div>
                        </div>
                        <div class="col l6 m6 s12">
                          <div class="input-field">
                          <span class="label">NUMĂRUL CARDULUI</span>
                            <input type="text" placeholder="Ex: 4785 2221 3330 0001">
                          </div>
                        </div>
                        <div class="col l6 m6 s12">
                          <div class="input-field select-field">
                          <span class="label">VALABIL PÂNĂ</span>
                           <div class="row">
                             <div class="col l6 m6 s12">
                               <input type="text" placeholder="luna">
                             </div>
                             <div class="col l6 m6 s12">
                               <input type="text" placeholder="anul">
                             </div>
                           </div>
                          </div>
                        </div>
                        <div class="col l6 m6 s12">
                          <div class="input-field">
                          <span class="label">CVC2 / CVV2</span>
                            <input type="text" placeholder="Ex: 2008">
                          </div>
                        </div>  
                      </form>
                    </div>
                    <div class="element">
                      <form action="#" class="form styled2 row">
                        <div class="col l6 m6 s12">
                          <div class="input-field">
                          <span class="label">NUMELE PRENUMELE</span>
                            <input type="text" placeholder="Ex: Ion Ciobanu">
                          </div>
                        </div>
                        <div class="col l6 m6 s12">
                          <div class="input-field">
                          <span class="label">NUMĂRUL CARDULUI</span>
                            <input type="text" placeholder="Ex: 4785 2221 3330 0001">
                          </div>
                        </div>
                        <div class="col l6 m6 s12">
                          <div class="input-field select-field">
                          <span class="label">VALABIL PÂNĂ</span>
                           <div class="row">
                             <div class="col l6 m6 s12">
                               <input type="text" placeholder="luna">
                             </div>
                             <div class="col l6 m6 s12">
                               <input type="text" placeholder="anul">
                             </div>
                           </div>
                          </div>
                        </div>
                        <div class="col l6 m6 s12">
                          <div class="input-field">
                          <span class="label">CVC2 / CVV2</span>
                            <input type="text" placeholder="Ex: 2008">
                          </div>
                        </div>                      
                      </form>
                    </div>

                  </div>
                  <span class="add_clone_after right" data-id="template2"><span class="icon-plus"></span> Adaugă o adresă nouă</span>

                </div>
                    
                </div>
                <!--right block-->
            </div>
        </div>
    </section>
    
    </section>
@endsection
