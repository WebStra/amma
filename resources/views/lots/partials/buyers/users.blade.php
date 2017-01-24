<table class="responsive-table">
    <thead>
        <tr>
            <th data-field="id">Nr.</th>
            <th data-field="email">Email</th>
            <th data-field="firstname">Firstname</th>
            <th data-field="lastname">Lastname</th>
            <th data-field="phone">Phone</th>
            <th data-field="product">Item</th>
        </tr>
    </thead>
    <tbody>
        @foreach($involved as $key => $invol)
            <tr>
                <td>{{++$key}}</td>
                <td>{{$invol->buyer->email}}</td>
                <td>{{$invol->buyer->profile->firstname}}</td>
                <td>{{$invol->buyer->profile->lastname}}</td>
                <td>{{$invol->buyer->profile->phone}}</td>
                <td><a href="{{route('view_single_prod_spec',['involve'=>$invol->product_hash])}}">Vezi produsul</a></td>
            </tr>
        @endforeach
    </tbody>
</table>
