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
                            <th scope="col">Action</th>
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
                                <td><!-- Button trigger modal -->
                                    <button type="button" onclick="myFunction({{ $item->id }})" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">
                                     Livrer
                                    </button>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                      </table>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
              Voulez vous vraiment livrer?
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-dismiss="modal">Annuler</button>
              <a href="#"><button type="button" class="btn btn-primary">Oui</button></a>
            </div>
          </div>
        </div>
      </div>
</div>


<script>
    function myFunction(e) {
       $("a").prop("href", "http://localhost/p/livrer-cmd/"+e)
        // $("a").prop("href", url('/livrer-cmd/'+e))


    }
</script>
@endsection
