@extends('layouts.app')

@section('content')



<link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<!------ Include the above in your HEAD tag ---------->

<div class="container">
    <div class="row">
        <div class="col-lg-12 my-3">
            <div class="pull-right">
                <div class="btn-group">
                    <button class="btn btn-info" id="list">
                        List View
                    </button>
                    <button class="btn btn-danger" id="grid">
                        Grid View
                    </button>
                </div>
            </div>
        </div>
    </div> 
    <div id="products" class="row view-group">
        <?php $count = 1; if(isset($list) && !empty($list)){ ?>
            @foreach ($list as $pro)
                <div class="item col-xs-4 col-lg-4">
                    <div class="thumbnail card">
                        <div class="img-event">
                            <img class="group list-group-image img-fluid" src="http://placehold.it/400x250/000/fff" alt="" />
                        </div>
                        <div class="caption card-body">
                            <h4 class="group card-title inner list-group-item-heading">
                                {{ $pro->name }}</h4>
                           <!--  <p class="group inner list-group-item-text">
                               {{ $pro->description }}</p> -->
                            <div class="row">
                                <div class="col-xs-12 col-md-6">
                                    <p class="lead">
                                     Price :  &#x20b9; {{ $pro->price }}</p>
                                </div>
                                <div class="col-xs-12 col-md-6">
                                    <a class="btn btn-success" href="{{ url('productDetails/'.$pro->id) }}">Buy Now</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
            <?php } ?>
               
            </div>
</div>
<script type="text/javascript">
    $(document).ready(function() {
            $('#list').click(function(event){event.preventDefault();$('#products .item').addClass('list-group-item');});
            $('#grid').click(function(event){event.preventDefault();$('#products .item').removeClass('list-group-item');$('#products .item').addClass('grid-group-item');});
        });
</script>
@endsection