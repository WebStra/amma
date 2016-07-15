@extends('layout')

@section('content')
    <section class="suport">
        <div class="container">
            <h1>SUPPORT TEHNIC <span class="c_base">24/24</span></h1>
            <h4>Pentru mai multe a beneficia de ajutor, <a class="c_base" href="{{ route('contacts') }}">contactați-ne!</a></h4>
        </div>
        <img src="/assets/images/wide_img.jpg" class="wide_img">
        <div class="container">
            <div class="row content">
                @if(count($faq))
                    <div class="col l5 m5 s12">
                        <h4><i class="icon-chat"></i>Întrebări frecvente și răspunsuri</h4>
                        <ul>
                            @foreach($faq as $item)
                                <li>
                                    <h5><i class="icon-play i-list"></i>{{ $item->title }}</h5>
                                    {!! $item->body !!}
                                </li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                <div class="col l7 m7 s12">
                    <div class="wrapp_img">
                        <img src="/assets/images/image_suport.jpg">
                    </div>
                    <div class="display-flex">
                        <i class="icon-phone"></i>
                        <div>
                            <h4>Sunați-ne la numărul de telefon</h4>
                            <p class="c_base">(+373) 69 845 100</p>
                        </div>
                    </div>

                    <div class="display-flex no-flex-med-down">

                        <div class="display-flex">
                            <i class="icon-skype"></i>
                            <div>
                                <h4>Scrie-ne pe skype</h4>
                                <p class="c_base">{{ settings()->getOption('support::skype') }}</p>
                            </div>
                        </div>
                        <span class="sau hide-on-med-and-down">sau</span>
                        <div class="display-flex">
                            <i class="icon-email"></i>
                            <div>
                                <h4>Pe email</h4>
                                <p class="c_base">{{ settings()->getOption('support::email') }}</p>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection