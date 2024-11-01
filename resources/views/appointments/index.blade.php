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
        <h4 class="text-blue h4 mx-auto">Liste des Rendez-vous</h4>
        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#createAppointmentModal">
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
                    <th>Patient</th>
                    <th>Docteur</th>
                    <th>Date du Rendez-vous</th>
                    <th>Description</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($appointments as $appointment)
                    <tr>
                        <td></td>
                        <td>{{ $appointment->patient->name }}</td>
                        <td>{{ $appointment->doctor->name }}</td>
                        <td>{{ $appointment->appointment_date }}</td>
                        <td>{{ $appointment->description }}</td>
                        <td>
                            <!-- Bouton Modifier -->
                            {{-- <a href="{{ route('appointments.show', ['appointment' => $appointment->id]) }}" class="btn btn-info btn-sm">
                                <i class="icon-copy fa fa-eye" aria-hidden="true"></i>
                            </a> --}}

                            <a href="#" class="btn btn-warning btn-sm" data-toggle="modal" data-target="#editAppointmentModal{{ $appointment->id }}">
                                <i class="icon-copy fa fa-pencil" aria-hidden="true"></i>
                            </a>

                            <a href="#" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#deleteAppointmentModal{{ $appointment->id }}">
                                <i class="icon-copy fa fa-trash" aria-hidden="true"></i>
                            </a>

                            <!-- Boîte modale de suppression -->
                            <div class="modal fade" id="deleteAppointmentModal{{ $appointment->id }}" tabindex="-1" role="dialog" aria-labelledby="deleteAppointmentModalLabel{{ $appointment->id }}" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="deleteAppointmentModalLabel{{ $appointment->id }}">Confirmation de suppression</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            Êtes-vous sûr de vouloir supprimer ce rendez-vous ?
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Annuler</button>
                                            <form method="post" action="{{ route('appointments.destroy', $appointment->id) }}" style="display:inline;">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger">Confirmer la suppression</button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Boîte modale de modification -->
                            <div class="modal fade" id="editAppointmentModal{{ $appointment->id }}" tabindex="-1" role="dialog" aria-labelledby="editAppointmentModalLabel{{ $appointment->id }}" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="editAppointmentModalLabel{{ $appointment->id }}">Modifier le rendez-vous</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <!-- Formulaire de modification de rendez-vous -->
                                            <form method="post" action="{{ route('appointments.update', $appointment->id) }}">
                                                @csrf
                                                @method('PUT')
                    
                                                <div class="form-group">
                                                    <label for="patient_id">Patient</label>
                                                    <select class="form-control" id="patient_id" name="patient_id" required>
                                                        @foreach ($patients as $patient)
                                                            <option value="{{ $patient->id }}" {{ $appointment->patient_id == $patient->id ? 'selected' : '' }}>{{ $patient->name }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                    
                                                <div class="form-group">
                                                    <label for="doctor_id">Docteur</label>
                                                    <select class="form-control" id="doctor_id" name="doctor_id" required>
                                                        @foreach ($doctors as $doctor)
                                                            <option value="{{ $doctor->id }}" {{ $appointment->doctor_id == $doctor->id ? 'selected' : '' }}>{{ $doctor->name }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                    
                                                <div class="form-group">
                                                    <label for="appointment_date">Date du Rendez-vous</label>
                                                    <input type="datetime-local" class="form-control" id="appointment_date" name="appointment_date" value="{{ $appointment->appointment_date }}" required>
                                                </div>
                            
                                                <div class="form-group">
                                                    <label for="description">Description</label>
                                                    <textarea class="form-control" id="description" name="description" rows="3">{{ $appointment->description }}</textarea>
                                                </div>
                    
                                                <button type="submit" class="btn btn-primary">Enregistrer les modifications</button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

<!-- Inclure les fichiers CSS de DataTables -->
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.11.6/css/jquery.dataTables.css">

<!-- Inclure le script d'initialisation de DataTables -->
<script>
    $(document).ready( function () {
        $('.datatable').DataTable();
    });
</script>

<!-- Boîte modale de création de rendez-vous -->
<div class="modal fade" id="createAppointmentModal" tabindex="-1" role="dialog" aria-labelledby="createAppointmentModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="createAppointmentModalLabel">Créer un nouveau rendez-vous</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <!-- Formulaire de création/modification de rendez-vous -->
                <form method="post" action="{{ route('appointments.store') }}">
                    @csrf

                    <div class="form-group">
                        <label for="patient_id">Patient</label>
                        <select class="form-control" id="patient_id" name="patient_id" required>
                            @foreach ($patients as $patient)
                                <option value="{{ $patient->id }}">{{ $patient->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="doctor_id">Docteur</label>
                        <select class="form-control" id="doctor_id" name="doctor_id" required>
                            @foreach ($doctors as $doctor)
                                <option value="{{ $doctor->id }}">{{ $doctor->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="appointment_date">Date du Rendez-vous</label>
                        <input type="datetime-local" class="form-control" id="appointment_date" name="appointment_date" required>
                    </div>

                    <div class="form-group">
                        <label for="description">Description</label>
                        <textarea class="form-control" id="description" name="description" rows="3"></textarea>
                    </div>

                    <button type="submit" class="btn btn-primary">Créer</button>
                </form>
            </div>
        </div>
    </div>
</div>

@endsection
