@extends('emails.layout')


@section('subject')

@endsection

@section('message')
    <p>Oferta <a href="{{route('view_lot',['lot'=>$lot->id])}}">{{$lot->name}}</a> a expirat!</p>
    <p>Cumparatori:</p>
    <table style="margin: 0 auto;">
        <thead style="margin-bottom: 20px;">
        <tr>
            <th style="color:#000; border-bottom: 1px solid #000;" data-field="id">Nr.</th>
            <th style="color:#000; border-bottom: 1px solid #000;" data-field="email">Email</th>
            <th style="color:#000; border-bottom: 1px solid #000;" data-field="firstname">Firstname</th>
            <th style="color:#000; border-bottom: 1px solid #000;" data-field="lastname">Lastname</th>
            <th style="color:#000; border-bottom: 1px solid #000;" data-field="phone">Phone</th>
            <th style="color:#000; border-bottom: 1px solid #000;" data-field="product">Item</th>
        </tr>
        </thead>
        <tbody>
        <?php $i=0;?>
        @foreach($users as $key =>$item)
            <?php $i++; ?>
        <tr>
            <td style="color:#000; text-align: left; border-bottom: 1px solid #000;">{{$i}}</td>
            <td style="color:#000; text-align: left; border-bottom: 1px solid #000;">{{$item['user']['email']}}</td>
            <td style="color:#000; text-align: left; border-bottom: 1px solid #000;">{{$item['user']['firstname']}}</td>
            <td style="color:#000; text-align: left; border-bottom: 1px solid #000;">{{$item['user']['lastname']}}</td>
            <td style="color:#000; text-align: left; border-bottom: 1px solid #000;">{{$item['user']['phone']}}</td>
            <td style="color:#000; text-align: left; border-bottom: 1px solid #000;"><a style="padding: 3px 5px; font-size: 14px; border-radius: 10px; display: block; background: #ff6f00; color: #fff; text-decoration: none;" href="{{route('view_single_prod_spec',['involve'=>$item['user']['product_hash']])}}">Vezi produsul</a></td>
        </tr>
            @endforeach
        </tbody>
    </table>

@endsection

