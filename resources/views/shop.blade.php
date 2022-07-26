@extends('layout')

@section('title', 'Products')

@section('extra-css')
    <link rel="stylesheet" href="{{ asset('css/algolia.css') }}">
@endsection

@section('content')
@component('components.breadcrumbs')
        <a href="/">Home</a>
        <i class="fa fa-chevron-right breadcrumb-separator"></i>
        <span>Shop</span>
    @endcomponent
    <div class="container">
        @if (session()->has('success_message'))
            <div class="alert alert-success">
                {{ session()->get('success_message') }}
            </div>
        @endif

        @if(count($errors) > 0)
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
    </div>
<div class="breadcrumbs">
    <div class="container">
        <a href="/">Home</a>
        <i class="fa fa-chevron-right breadcrumbs-seperator"></i>
        <a href="{{route('shop.index')}}">shop</a>
        <i class="fa fa-chevron-right breadcrumbs-seperator"></i>
        <span>Mackbook pro</span>
    </div>
</div><!-- end breadcrumbs -->
<div class="products-section container">
    <div class="sidebar">
        <h3>By Catogray</h3>
        <ul>
            @foreach($categories as $category)
            <li class="{{ setActiveCategory($category->slug) }}"><a href="{{ route('shop.index', ['category' => $category->slug]) }}">{{ $category->name }}</a></li>
            @endforeach
           
        </ul>
        <h3>By Price</h3>
        <!-- <ul>
            <li><a href="#">$0 -$700</a></li>
            <li><a href="#">%700 -$2500</a></li>
            <li><a href="#">$2500+</a></li>
        </ul> -->
    </div><!--end sidebar -->
    <div>
    <div>
            <div class="products-header">
                <h1 class="stylish-heading">{{ $categoryName }}</h1>
                <div>
                    <strong>Price: </strong>
                    <a href="{{ route('shop.index', ['category'=> request()->category, 'sort' => 'low_high']) }}">Low to High</a> |
                    <a href="{{ route('shop.index', ['category'=> request()->category, 'sort' => 'high_low']) }}">High to Low</a>

                </div>
            </div>
        <div class="products text-center">
        @forelse ($products as $product)
                    <div class="product">
                        <a href="{{ route('shop.show', $product->slug) }}"><img src="{{asset('img/'. $product->slug. '.jpg')}}" alt="product"></a>
                        <a href="{{ route('shop.show', $product->slug) }}"><div class="product-name">{{ $product->name }}</div></a>
                        <div class="product-price">{{ $product->persertPrice() }}</div>
                    </div>
                @empty
                    <div style="text-align: left">No items found</div>
                @endforelse
      
      <div class="spacer"></div>
        </div><!-- end products--> 
        
        <!-- {{ $products->links() }} -->
        {{ $products->appends(request()->input())->links() }}
    </div>
    </div>
    </div>
    @include('footer')
</div>
@endsection
