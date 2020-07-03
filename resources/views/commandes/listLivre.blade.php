@extends('layouts.app')

@section('content')
<div class="container">

    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">{{ __('Charger les produits') }}</div>


                <div class="card-body">
                    <table class="table">
                        <thead>
                          <tr>
                            <th scope="col">#</th>
                            <th scope="col">Nom</th>
                            <th scope="col">Reference</th>
                            <th scope="col">Liste Commande</th>
                            <th scope="col">Operateur</th>
                            <th scope="col">Montant</th>
                            <th scope="col">Telephone</th>
                            <th scope="col">Date</th>
                          </tr>
                        </thead>
                        <tbody>
                            @foreach ($commandes as $key=> $item)
                            <tr>
                                <th scope="row"> {{ $key }} </th>
                                <td>{{ $item->nom_utilisateur }} </td>
                                <td>{{ $item->reference }} </td>

                                <td>{{ $item->liste_commande }}</td>

                                <td>{{ $item->operator_transaction_ref }}</td>
                                <td>{{ $item->transaction_amount }}</td>
                                <td>{{ $item->customer_phone_number }}</td>
                                <td>{{ $item->created_at }}</td>

                            </tr>
                            @endforeach
                        </tbody>
                      </table>
                </div>
            </div>
        </div>
    </div>
@endsection
