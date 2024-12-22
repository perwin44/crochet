@extends('frontend.layouts.master')
@section('title')
{{$settings->site_name}} 
@endsection

@section('content')


@include('frontend.home.sections.shop')


@include('frontend.home.sections.category')


{{-- @include('frontend.home.sections.brands') --}}


@include('frontend.home.sections.products')


@include('frontend.home.sections.show')


@include('frontend.home.sections.best-selling')


@include('frontend.home.sections.discounts')


@include('frontend.home.sections.most-popular')


@include('frontend.home.sections.just-arrived')


{{-- @include('frontend.home.sections.blog')


@include('frontend.home.sections.app')


@include('frontend.home.sections.looking-for') --}}


@include('frontend.home.sections.final-cards')

@endsection