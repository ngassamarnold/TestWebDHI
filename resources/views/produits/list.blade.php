@extends('layouts.app')

@section('content')
<div class="container">

    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">{{ __('Liste des produits') }}</div>


                <div class="card-body">
                    <table class="table">
                        <thead>
                          <tr>
                            <th scope="col">#</th>
                            <th scope="col">Categorie</th>
                            <th scope="col">Nom</th>
                            <th scope="col">Quantite</th>
                            <th scope="col">Prix Unitaie</th>
                          </tr>
                        </thead>
                        <tbody>
                            @foreach ($produits as $key=> $item)
                            <tr>
                                <th scope="row"> {{ $key }} </th>
                                <td>{{ $item->categorie }} </td>
                                <td>{{ $item->nom }} </td>

                                <td>{{ $item->quantite }}</td>

                                <td>{{ $item->prixU }}</td>

                            </tr>
                            @endforeach
                        </tbody>
                      </table>
                </div>
            </div>
        </div>
    </div>

@endsection
