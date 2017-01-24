@extends('emails.layout')


@section('subject')

@endsection

@section('message')
    <p>Oferta <a href="{{route('view_lot',['lot'=>$lot->id])}}">{{$lot->name}}</a> a expirat!</p>
    <p>In curind vinzatorul va lua legatura cu dumneavoastra!</p>
    <table style="text-align: left; margin: 20px auto; border: 1px solid #000;">
        <tbody>
        <tr>
            <td style="border-bottom: 1px solid #000;">Denumire:</td>
            <td style="border-bottom: 1px solid #000;">{{$vendor->name}}</td>
        </tr>
        <tr>
            <td style="border-bottom: 1px solid #000;">Telefon:</td>
            <td style="border-bottom: 1px solid #000;">+373 {{$vendor->phone}}</td>
        </tr>
        <tr>
            <td>Email:</td>
            <td>{{$vendor->email}}</td>
        </tr>
        </tbody>
    </table>
    <strong style="color:#000; display: block;">Produsele la care participi:</strong>
    <br>

    <a href="{{route('my_involved',['involve'=>'involve'])}}" style="background:#ff6f00; display:block; padding: 10px 15px; color:#fff; max-width:120px; margin: auto;">Vezi Produsele</a>
@endsection

