<!-- resources/views/agents/index.blade.php -->

@extends('layouts.app')

@section('content')
@if ($errors->any())
<div class="alert alert-danger">
    <ul>
        @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
        @endforeach
    </ul>
</div>
@endif
    <div class="card-box mb-30">
        <div class="pd-20 d-flex justify-content-between">
            <h4 class="text-blue h4 mx-auto">Liste des agents</h4>
            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#createagentModal">
                <i class="icon-copy fa fa-plus" aria-hidden="true"></i>
            </button>
        </div>
       

        <div class="pb-20">
            <table class="datatable table nowrap">
                <thead>
                    <tr>
                        <th>
                            <div class="dt-checkbox">
                                <input type="checkbox" name="select_all" value="1" id="example-select-all">
                                <span class="dt-checkbox-label"></span>
                            </div>
                        </th>
                        <th>Nom</th>
                        <th>Téléphone</th>
                        <th>Adresse</th>
                        <th>Actions</th>
                        
                    </tr>
                </thead>
                <tbody>
                    @foreach ($agents as $agent)
                        <tr>
                            <td></td>
                            <td>{{ $agent->name }}</td>
                            <td>{{ $agent->phone }}</td>
                            <td>{{ $agent->address }}</td>
            
                                <!-- Afficher le QR code directement -->
                                {{-- {!! QrCode::size(50)->generate($agent->qrcode) !!} --}}
                         
                            
                            <td>
                               <!-- Bouton Modifier -->
                               <a href="{{ route('agents.show', ['agent' => $agent->id]) }}" class="btn btn-info btn-sm">
                                <i class="icon-copy fa fa-eye" aria-hidden="true"></i>
                                </a>
                                <a href="#" class="btn btn-warning btn-sm" data-toggle="modal" data-target="#editagentModal{{ $agent->id }}">
                                    <i class="icon-copy fa fa-pencil" aria-hidden="true"></i>
                                </a>
                                <a href="#" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#deleteagentModal{{ $agent->id }}">
                                    <i class="icon-copy fa fa-trash" aria-hidden="true"></i>
                                </a>
                                <!-- Boîte modale de suppression -->
                                <div class="modal fade" id="deleteagentModal{{ $agent->id }}" tabindex="-1" role="dialog" aria-labelledby="deleteagentModalLabel{{ $agent->id }}" aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="deleteagentModalLabel{{ $agent->id }}">Confirmation de suppression</h5>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                Êtes-vous sûr de vouloir supprimer le agent "{{ $agent->name }}" ?
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Annuler</button>
                                                <form method="post" action="{{ route('agents.destroy', $agent->id) }}" style="display:inline;">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger">Confirmer la suppression</button>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- Boîte modale de modification -->
                                        <div class="modal fade" id="editagentModal{{ $agent->id }}" tabindex="-1" role="dialog" aria-labelledby="editagentModalLabel{{ $agent->id }}" aria-hidden="true">
                                            <div class="modal-dialog" role="document">
                                                <div class="modal-content">
                                                    <!-- ... autres balises modales ... -->
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="editagentModalLabel{{ $agent->id }}">Modifier le agent</h5>
                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <!-- Formulaire de modification de agent va ici -->
                                                        <form method="post" action="{{ route('agents.update', $agent->id) }}">
                                                            @csrf
                                                            @method('PUT')

                                                            <div class="form-group">
                                                                <label for="name">Nom</label>
                                                                <input type="text" class="form-control" id="name" name="name" value="{{ $agent->name }}" required>
                                                            </div>

                                                            <div class="form-group">
                                                                <label for="email">Email</label>
                                                                <input type="email" class="form-control" id="email" name="email" value="{{ $agent->email }}" required>
                                                            </div>

                                                            <div class="form-group">
                                                                <label for="telephone">Téléphone</label>
                                                                <input type="tel" class="form-control" id="telephone" name="phone" value="{{ $agent->phone }}" required>
                                                            </div>
                                                            <div class="form-group">
                                                                <label for="telephone">Qr Code</label>
                                                                <input type="text" class="form-control" id="qrcode" name="qrcode" value="{{ old('qrcode', $agent->qrcode) }}" readonly>
                                                            </div>

                                                            <div class="form-group">
                                                                <label for="adresse">Adresse</label>
                                                                <input type="text" class="form-control" id="adresse" name="address" value="{{ $agent->address }}" required>
                                                            </div>

                                                            <button type="submit" class="btn btn-primary">Modifier</button>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                            </td>
                            
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    <!-- Inclure les fichiers CSS de DataTables -->
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.11.6/css/jquery.dataTables.css">

    <!-- Inclure jQuery -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <!-- Inclure DataTables -->
    <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.11.6/js/jquery.dataTables.js"></script>

    <!-- Inclure le script d'initialisation de DataTables -->
    <script>
        $(document).ready( function () {
            $('.datatable').DataTable();
        });
    </script>

   <!-- Boîte modale de création de agent -->
<!-- Boîte modale de création d'agent -->
<div class="modal fade" id="createagentModal" tabindex="-1" role="dialog" aria-labelledby="createagentModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="createagentModalLabel">Créer un nouvel agent</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form method="post" action="{{ route('agents.store') }}">
                    @csrf

                    <div class="form-group">
                        <label for="nom">Nom</label>
                        <input type="text" class="form-control" id="nom" name="name" required>
                    </div>

                    <div class="form-group">
                        <label for="email">Email</label>
                        <input type="email" class="form-control" id="email" name="email" required>
                    </div>

                    <div class="form-group">
                        <label for="telephone">Téléphone</label>
                        <input type="tel" class="form-control" id="telephone" name="phone" required>
                    </div>

                    <div class="form-group">
                        <label for="adresse">Adresse</label>
                        <input type="text" class="form-control" id="adresse" name="address" required>
                    </div>

                    <button type="submit" class="btn btn-primary">Créer</button>
                </form>
            </div>
        </div>
    </div>
</div>


@endsection

