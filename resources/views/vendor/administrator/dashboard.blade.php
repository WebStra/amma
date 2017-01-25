@extends('administrator::layout')

@section('content')
    <div class="content body">
        <div class="row">
            <!-- Small boxes (Stat box) -->
            <div class="col-lg-3 col-xs-6">
                <!-- small box -->
                <div class="small-box bg-aqua">
                    <div class="inner">
                        <h3>{{count($lot->getModel()->get())}}</h3>
                        <p>Lots Number</p>
                    </div>
                    <div class="icon">
                        <i class="ion ion-bag"></i>
                    </div>
                    <a href="{{URL::to('admin/lot')}}" class="small-box-footer">Go to Lots <i
                                class="fa fa-arrow-circle-right"></i></a>
                </div>
            </div>
            <!-- ./col -->
            <div class="col-lg-3 col-xs-6">
                <!-- small box -->
                <div class="small-box bg-green">
                    <div class="inner">
                        <h3>{{count($vendor)}}</h3>

                        <p>Vendors Number</p>
                    </div>
                    <div class="icon">
                        <i class="fa fa-cart-arrow-down"></i>
                    </div>
                    <a href="{{URL::to('admin/allvendors')}}" class="small-box-footer">Go to Vendors <i class="fa fa-arrow-circle-right"></i></a>
                </div>
            </div>
            <!-- ./col -->
            <div class="col-lg-3 col-xs-6">
                <!-- small box -->
                <div class="small-box bg-yellow">
                    <div class="inner">
                        <h3>{{count($user)}}</h3>

                        <p>Users Number</p>
                    </div>
                    <div class="icon">
                        <i class="ion ion-person-add"></i>
                    </div>
                    <a href="{{URL::to('admin/members')}}" class="small-box-footer">Go to Users <i
                                class="fa fa-arrow-circle-right"></i></a>
                </div>
            </div>
            <!-- ./col -->
            <div class="col-lg-3 col-xs-6">
                <!-- small box -->
                <div class="small-box bg-red">
                    <div class="inner">
                        <h3>{{count($visitors)}}</h3>

                        <p>Unique Visitors</p>
                    </div>
                    <div class="icon">
                        <i class="ion ion-pie-graph"></i>
                    </div>
                    <a href="#" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
                </div>
            </div>
            <div class="col-md-6">
                <!-- DONUT CHART -->
                <div class="box box-danger">
                    <div class="box-header with-border">
                        <h3 class="box-title">Lots Status</h3>

                        <div class="box-tools pull-right">
                            <button type="button" class="btn btn-box-tool" data-widget="collapse"><i
                                        class="fa fa-minus"></i>
                            </button>
                            <button type="button" class="btn btn-box-tool" data-widget="remove"><i
                                        class="fa fa-times"></i></button>
                        </div>
                    </div>
                    <div class="box-body chart-responsive">
                        <div class="chart" id="sales-chart" style="height: 300px; position: relative;"></div>
                    </div>
                    <!-- /.box-body -->
                </div>
                <!-- /.box -->
            </div>
            <!-- PRODUCT LIST -->
            <div class="col-xs-6">
                <div class="box box-primary">
                    <div class="box-header with-border">
                        <h3 class="box-title">Recently Added Lots</h3>

                        <div class="box-tools pull-right">
                            <button type="button" class="btn btn-box-tool" data-widget="collapse"><i
                                        class="fa fa-minus"></i>
                            </button>
                            <button type="button" class="btn btn-box-tool" data-widget="remove"><i
                                        class="fa fa-times"></i></button>
                        </div>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">
                        <ul class="products-list product-list-in-box">
                            @foreach($lot->getLatestLot(4) as $item)
                                <li class="item">
                                    <div class="product-img">
                                        <img src="{{($item->vendor->present()->cover()) ? $item->vendor->present()->cover() : '/assets/images/no-avatar2.png'}}" alt="Product Image">
                                    </div>
                                    <div class="product-info">
                                        <a href="{{URL::to('admin/lot?id='.$item->id)}}" class="product-title">{{$item->name}}
                                            <span class="label label-success pull-right">{{$item->yield_amount}} {{$item->currency->sign}}</span></a>
                                        <span class="product-description">{{str_limit($item->description,$limit=40,$end='..')}}</span>
                                    </div>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                    <!-- /.box-body -->
                    <div class="box-footer text-center">
                        <a href="{{URL::to('admin/lot')}}" class="uppercase">View All Lots</a>
                    </div>
                    <!-- /.box-footer -->
                </div>

            </div>

            <div class="col-md-6">
                {{--<!-- AREA CHART -->--}}
                {{--<div class="box box-primary">--}}
                    {{--<div class="box-header with-border">--}}
                        {{--<h3 class="box-title">Area Chart</h3>--}}

                        {{--<div class="box-tools pull-right">--}}
                            {{--<button type="button" class="btn btn-box-tool" data-widget="collapse"><i--}}
                                        {{--class="fa fa-minus"></i>--}}
                            {{--</button>--}}
                            {{--<button type="button" class="btn btn-box-tool" data-widget="remove"><i--}}
                                        {{--class="fa fa-times"></i></button>--}}
                        {{--</div>--}}
                    {{--</div>--}}
                    {{--<div class="box-body chart-responsive">--}}
                        {{--<div class="chart" id="revenue-chart" style="height: 300px;"></div>--}}
                    {{--</div>--}}
                    {{--<!-- /.box-body -->--}}
                {{--</div>--}}
                {{--<!-- /.box -->--}}
            </div>

        </div>
    </div>
@endsection

@section('js')
    <script>
        $(function () {
            "use strict";

            // AREA CHART
//            var area = new Morris.Area({
//                element: 'revenue-chart',
//                resize: true,
//                data: [
//                    {y: '2011 Q1', item1: 2666, item2: 2666},
//                    {y: '2011 Q2', item1: 2778, item2: 2294},
//                    {y: '2011 Q3', item1: 4912, item2: 1969},
//                    {y: '2011 Q4', item1: 3767, item2: 3597},
//                    {y: '2012 Q1', item1: 6810, item2: 1914},
//                    {y: '2012 Q2', item1: 5670, item2: 4293},
//                    {y: '2012 Q3', item1: 4820, item2: 3795},
//                    {y: '2012 Q4', item1: 15073, item2: 5967},
//                    {y: '2013 Q1', item1: 10687, item2: 4460},
//                    {y: '2013 Q2', item1: 8432, item2: 5713}
//                ],
//                xkey: 'y',
//                ykeys: ['item1', 'item2'],
//                labels: ['Item 1', 'Item 2'],
//                lineColors: ['#a0d0e0', '#3c8dbc'],
//                hideHover: 'auto'
//            });

            //DONUT CHART
            var donut = new Morris.Donut({
                element: 'sales-chart',
                resize: true,
                colors: ["#f39c12", "#00a65a", "#00c0ef", "#dd4b39"],
                data: [
                    {label: "Loturi in Asteptare", value: '{{$lot->getByStatus('pending')}}'},
                    {label: "Loturi Active", value: '{{$lot->getByStatus('verified')}}'},
                    {label: "Loturi Expirate", value: '{{$lot->getByStatus('expired')}}'},
                    {label: "Loturi Anulate", value: '{{$lot->getByStatus('declined')}}'}
                ],
                hideHover: 'auto'
            });

        });
    </script>
@endsection

