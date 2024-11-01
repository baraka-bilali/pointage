<!-- resources/views/patients/index.blade.php -->

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
            <h4 class="text-blue h4 mx-auto">Liste des Patients</h4>
            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#createPatientModal">
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
                        <th>Email</th>
                        <th>Téléphone</th>
                        <th>Adresse</th>
                        <th>Actions</th>
                        
                    </tr>
                </thead>
                <tbody>
                    @foreach ($patients as $patient)
                        <tr>
                            <td></td>
                            <td>{{ $patient->name }}</td>
                            <td>{{ $patient->email }}</td>
                            <td>{{ $patient->phone }}</td>
                            <td>{{ $patient->address }}</td>
                            <td>
                               <!-- Bouton Modifier -->
                               <a href="{{ route('patients.show', ['patient' => $patient->id]) }}" class="btn btn-info btn-sm">
                                 <i class="icon-copy fa fa-eye" aria-hidden="true"></i>
                               </a>
                            
                            

                                <a href="#" class="btn btn-warning btn-sm" data-toggle="modal" data-target="#editPatientModal{{ $patient->id }}">
                                    <i class="icon-copy fa fa-pencil" aria-hidden="true"></i>
                                </a>
                        
                                <a href="#" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#deletePatientModal{{ $patient->id }}">
                                    <i class="icon-copy fa fa-trash" aria-hidden="true"></i>
                                </a>
                                <!-- Boîte modale de suppression -->
                                <div class="modal fade" id="deletePatientModal{{ $patient->id }}" tabindex="-1" role="dialog" aria-labelledby="deletePatientModalLabel{{ $patient->id }}" aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="deletePatientModalLabel{{ $patient->id }}">Confirmation de suppression</h5>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                Êtes-vous sûr de vouloir supprimer le patient "{{ $patient->name }}" ?
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Annuler</button>
                                                <form method="post" action="{{ route('patients.destroy', $patient->id) }}" style="display:inline;">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger">Confirmer la suppression</button>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- Boîte modale de modification -->
                                        <div class="modal fade" id="editPatientModal{{ $patient->id }}" tabindex="-1" role="dialog" aria-labelledby="editPatientModalLabel{{ $patient->id }}" aria-hidden="true">
                                            <div class="modal-dialog" role="document">
                                                <div class="modal-content">
                                                    <!-- ... autres balises modales ... -->
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="editPatientModalLabel{{ $patient->id }}">Modifier le patient</h5>
                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <!-- Formulaire de modification de patient va ici -->
                                                        <form method="post" action="{{ route('patients.update', $patient->id) }}">
                                                            @csrf
                                                            @method('PUT')

                                                            <div class="form-group">
                                                                <label for="nom">Nom</label>
                                                                <input type="text" class="form-control" id="nom" name="name" value="{{ $patient->name }}" required>
                                                            </div>

                                                            <div class="form-group">
                                                                <label for="email">Email</label>
                                                                <input type="email" class="form-control" id="email" name="email" value="{{ $patient->email }}" required>
                                                            </div>

                                                            <div class="form-group">
                                                                <label for="telephone">Téléphone</label>
                                                                <input type="tel" class="form-control" id="telephone" name="phone" value="{{ $patient->phone }}" required>
                                                            </div>

                                                            <div class="form-group">
                                                                <label for="adresse">Adresse</label>
                                                                <input type="text" class="form-control" id="adresse" name="address" value="{{ $patient->address }}" required>
                                                            </div>

                                                            <button type="submit" class="btn btn-primary">Enregistrer les modifications</button>
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

   <!-- Boîte modale de création de patient -->
<div class="modal fade" id="createPatientModal" tabindex="-1" role="dialog" aria-labelledby="createPatientModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="createPatientModalLabel">Créer un nouveau patient</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <!-- Formulaire de création de patient va ici -->
                <form method="post" action="{{ route('patients.store') }}">
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

