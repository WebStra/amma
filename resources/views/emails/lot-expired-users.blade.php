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
    <table style="margin: 0 auto;">
        <thead style="margin-bottom: 20px;">
        <tr>
            <th style="color:#000; border-bottom: 1px solid #000;" data-field="id">Nr.</th>
            <th style="color:#000; border-bottom: 1px solid #000;">Denumire</th>
            <th style="color:#000; border-bottom: 1px solid #000;">Cantitate</th>
            <th style="color:#000; border-bottom: 1px solid #000;">Pret</th>
            <th style="color:#000; border-bottom: 1px solid #000;">Vezi</th>
        </tr>
        </thead>
        <tbody>
        <?php $i=0; ?>
        @foreach($products as $item)
            <?php $i++; ?>
            <tr>
                <td style="color:#000; text-align: left; border-bottom: 1px solid #000;">{{$i}}</td>
                <td style="color:#000; text-align: left; border-bottom: 1px solid #000;">{{$item['name']}}</td>
                <td style="color:#000; text-align: center; border-bottom: 1px solid #000;">{{$item['count']}}</td>
                <td style="color:#000; text-align: left; border-bottom: 1px solid #000;">{{$item['price']}}</td>
                <td style="color:#000; text-align: left; border-bottom: 1px solid #000;"><a
                            style="padding: 3px 5px; font-size: 12px; border-radius: 10px; display: block; background: #ff6f00; color: #fff; text-decoration: none; text-align: center;"
                            href="{{route('view_single_prod_spec',['involve'=>$item['product_hash']])}}">Vezi produsul</a></td>
            </tr>
        @endforeach
        </tbody>
    </table>
    <br>
    <a href="{{route('view_lot',['lot'=>$lot->id])}}" style="background:#ff6f00; display:block; padding: 10px 15px; color:#fff; max-width:120px; margin: auto;">Vezi Oferta</a>
@endsection

