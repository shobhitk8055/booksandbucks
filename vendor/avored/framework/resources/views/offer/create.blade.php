@extends('avored::layouts.app')

@section('meta_title')
    {{ __('avored::system.pages.title.list', ['attribute' => __('avored::system.terms.product')]) }}: Books and Bucks
@endsection

@section('page_title')
    <div class="text-gray-800 flex items-center mt-5">
        <div class="text-xl text-red-700 font-semibold">
            Add offer
        </div>
    </div>
@endsection

@section('content')
    <link rel="stylesheet" href="{{asset('assets/css/bootstrap.min.css')}}">
    <script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.6.9/angular.min.js"></script>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.13.1/css/bootstrap-select.css" />
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.13.1/js/bootstrap-select.min.js"></script>

    <script>
        var sampleApp = angular.module('sampleApp', [], function($interpolateProvider) {
            $interpolateProvider.startSymbol('<%');
            $interpolateProvider.endSymbol('%>');
        });

        var genreOptions = JSON.parse(`<?php echo $genreOptions ?>`);
        var productOptions = JSON.parse(`<?php echo $productOptions ?>`);
        var category_product = JSON.parse(`<?php echo $category_product ?>`);
        var genre_book = JSON.parse(`<?php echo $genre_book ?>`);
        sampleApp.controller('myCtrl', function($scope) {
            $scope.type= "discount_percent";
            $scope.category= ['1'];
            $scope.genreOptions = function () {
                if ($scope.category[0]=== "1"){
                    return genreOptions;
                }
            };
            $scope.productOptions = function(){
                let category_ids = $scope.category;
                let pro_cat_ids = [];
                let products = {};
                for (let i =0;i<category_ids.length; i++){
                    for (let j=0;j<category_product.length; j++){
                        if (category_product[j].category_id === parseInt(category_ids[i])){
                            pro_cat_ids.push(category_product[j]);
                        }
                    }
                }

                for (let i = 0; i<pro_cat_ids.length; i++){
                    for (const product_id in productOptions){
                        if (parseInt(product_id) === parseInt(pro_cat_ids[i].product_id)){
                            products[product_id.toString()]= productOptions[product_id];
                        }
                    }
                }
                return products;
            }
            $scope.genres= [];
        });
    </script>
    <style>
        .mul-select{
            width: 100%;
        }
    </style>
    <div class="mt-2" ng-app="sampleApp" ng-controller="myCtrl">
        <form action="{{route('admin.offer.store')}}" method="post">
            @csrf

            <div class="row">
                <div class="col">
                    <label for="name">Name</label>
                    <input id="name" type="text" ng-model="name" name="name" class="form-control" placeholder="name">
                </div>
                <div class="col">
                    <label for="name">Slug</label>
                    <input id="slug" type="text" name="slug" class="form-control" placeholder="slug">
                </div>
            </div>

            <div class="row mt-3">
                <div class="col">
                    <label for="type">Type of discount</label>
                    <select id="type" ng-model="type" name="type" class="form-control">
                        <option value="discount_percent">Discount percent off</option>
                        <option value="discount_amount">Discount amount off</option>
                        <option value="fixed_amount">Fixed amount</option>
                    </select>
                </div>
                <div class="col" ng-if="type === 'discount_percent'">
                    <label for="amount">Discount percent off</label>
                    <input id="amount" type="number" name="discount_percent" class="form-control">
                </div>
                <div class="col" ng-if="type === 'discount_amount'">
                    <label for="amount">Discount amount off</label>
                    <input id="amount" type="number" name="discount_amount" class="form-control">
                </div>
                <div class="col" ng-if="type === 'fixed_amount'">
                    <label for="amount">Fixed amount</label>
                    <input id="amount" type="number" name="fixed_amount" class="form-control">
                </div>
            </div>
            <div class="row mt-2" style="padding-top: 10px;">
                <div class="col">
                    <label for="category">Categories</label>
                    <select multiple ng-model="category" id="category" name="category[]" class="selectpicker form-control">
                        @foreach($categoryOptions as $category => $value)
                        <option value="{{$category}}">{{$value}}</option>
                            @endforeach
                    </select>
                    {{--<select class="mul-select form-control" ng-model="category" id="category" multiple>--}}
                        {{--@foreach($categoryOptions as $category => $value)--}}
                        {{--<option value="{{$category}}">{{$value}}</option>--}}
                            {{--@endforeach--}}
                    {{--</select>--}}
                </div>
                <div class="col">
                    <div >
                        <label for="genres">Genres</label>
                        <select multiple ng-model="genres" id="genres" name="genres[]" class="selectpicker form-control">
                            <option ng-repeat="(key,value) in genreOptions()" value="<% key %>"><% value %></option>
                        </select>
                        {{--<select class="mul-select form-control" ng-model="genres" id="genres" multiple>--}}
                            {{--<option ng-repeat="(key,value) in genreOptions()" value="<% key %>"><% value %></option>--}}
                        {{--</select>--}}
                    </div>
                </div>
            </div>
            <div style="margin-top: 10px;">
                {{--<label for="products">Products</label><% products %>--}}
                {{--<select multiple ng-model="products" id="products" class="selectpicker form-control"  data-live-search="true" data-style="btn-primary">--}}
                            {{--<option ng-repeat="(key,value) in productOptions()" value="<% key %>"><% value %></option>--}}
                {{--</select>--}}

                {{--<label for="products">Products</label><% products %>--}}
                {{--<select class="mul-select form-control" ng-model="products" id="products" multiple>--}}
                    {{--<option ng-repeat="(key,value) in productOptions()" value="<% key %>"><% value %></option>--}}
                {{--</select>--}}
            </div>

            <button type="submit" class="btn mt-4 btn-danger">Create</button>
        </form>
    </div>

@endsection
