<!-- index.blade.php -->

@extends('products.layout')

@section('content')
<style>
  .uper {
    margin-top: 40px;
  }
</style>

<div class="uper">
  @if(session()->get('success'))
    <div class="alert alert-success">
      {{ session()->get('success') }}  
    </div><br />
  @endif
  <a class="btn btn-success" href="{{ route('products.create') }}"> Create </a>
  <a class="btn btn-primary pull-right" href="#" id="advanced-search"> Search </a>
  <p id="search-detail">Hello World</p>

  
  <h2>Products Listing</h2>
  <table class="table table-striped">
    <thead>
        <tr>
          <td>ID</td>
          <td>Name</td>
          <td>Code</td>
          <td>Price</td>
          <td>Action</td>
        </tr>
    </thead>
    <tbody>
        @foreach($products as $product)
        <tr>
            <td>{{$product->id}}</td>
            <td>{{$product->name}}</td>
            <td>{{$product->code}}</td>
            <td>{{$product->price}}</td>
            <td>
                <form action="{{ route('products.destroy', $product->id)}}" method="post">
                    <a class="btn btn-info" href="{{ route('products.show',$product->id) }}"><i class="fa fa-eye"></i></a>
                    <a href="{{ route('products.edit',$product->id)}}" class="btn btn-primary"><i class="fa fa-pencil"></i></a>
                    
                    @csrf
                    @method('DELETE')
                    <button class="btn btn-danger" type="submit"><i class="fa fa-trash"></i></button>
                </form>
            </td>
        </tr>
        @endforeach
    </tbody>
  </table>
<div>

{!! $products->links() !!}
@endsection