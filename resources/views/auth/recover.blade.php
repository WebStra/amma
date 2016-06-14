@extends('auth.layout')

@section('content')
    <div class=" display-table  authentification">
        <div class="td">
            <h1>RESTABILEȘTE PAROLA</h1>
            <p>Introduce adresa electronică pentru a restabili parola.</p>
            <form action="#" class="form styled3 row">
                <div class="col s12">
                    <div class="input-field">
                        <span class="label">ADRESA ELECTRONICA*</span>
                        <input type="email" placeholder="Ex: maria@gmail.com">
                    </div>
                </div>

                <div class="col s12">
                    <input type="submit" value="Trimite cererea" class="btn btn_base btn_submit full_width">

                </div>

            </form>
        </div>
    </div>
@endsection