@extends('avored::layouts.app')

@section('meta_title')
    {{ __('avored::system.pages.title.list', ['attribute' => __('avored::system.terms.product')]) }}: Books and Bucks
@endsection

@section('page_title')
    <div class="text-gray-800 flex items-center mt-5">
        <div class="text-xl text-red-700 font-semibold">
            Add Products to offer
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

        var allProducts = JSON.parse(`<?php echo $productsForJS ?>`);
        var choosenProducts = JSON.parse(`<?php echo $choosenProducts ?>`);
        sampleApp.controller('myCtrl', function($scope) {
            $scope.allProducts = allProducts;
            $scope.products = choosenProducts.toString();
        });

    </script>

    <div class="mt-2">
    </div>
    <div class="mt-2" ng-app="sampleApp" ng-controller="myCtrl">
        <form action="{{route('admin.offer.update')}}" method="post">
            @csrf
            <label for="products">Products</label>
            <input type="hidden" value="{{$offer_id}}" name="offer_id">
            <select multiple ng-model="products" name="products[]" id="products" class="selectpicker form-control"  data-live-search="true">
                <option ng-repeat="(key,value) in allProducts" value="<% key %>"><% value %></option>
            </select>

            <button type="submit" class="btn mt-4 btn-danger">Save</button>
        </form>
    </div>
@endsection