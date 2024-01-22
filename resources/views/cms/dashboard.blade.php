@extends('cms/layouts/contentLayoutMaster')

@section('title', 'Dashboard')

@section('content')
<section id="dashboard-analytics">
    <div class="row match-height">
        <div class="card card-congratulations">
            <div class="card-body text-center">
                <img src="{{ asset('cms/images/elements/decore-left.png') }}" class="congratulations-img-left" alt="card-img-left">
                <img src="{{ asset('cms/images/elements/decore-right.png') }}" class="congratulations-img-right" alt="card-img-right">
                <div class="avatar avatar-xl bg-primary shadow">
                    <div class="avatar-content">
                    <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-award font-large-1"><circle cx="12" cy="8" r="7"></circle><polyline points="8.21 13.89 7 23 12 20 17 23 15.79 13.88"></polyline></svg>
                    </div>
                </div>
                <div class="text-center">
                    <h1 class="mb-1 text-white">Bienvenid@ @if (Auth::check()) {{ Auth::user()->name }}  @endif</h1>
                </div>

                <x-select table="lang" langPref="tipo.doc" class="select2" multiple sel="" start="1" end="3"/>
            </div>
        </div>
    </div>
</section>
@endsection
