@extends('layouts.app')

@section('content')
<div class="container-fluid card-box mb-40">
    <div class="pd-ltr-20 xs-pd-20-10">
        <div class="min-height-200px">
            <div class="page-header">
                <div class="row">
                    <div class="col-md-6 col-sm-12">
                        <div class="title">
                            <h4>Dossier Médical</h4>
                        </div>
                        <!-- Ajouter la navigation ici si nécessaire -->
                    </div>
                    <div class="col-md-6 col-sm-12 text-right">
                        <!-- Ajouter les deux boutons ici -->
                        <button class="btn btn-primary" onclick="openEditModal()"> Créer rendez-vous</button>
                        <button class="btn btn-primary" onclick="openEditModal()"> Modifier</button>
                        <button class="btn btn-success" onclick="window.print()">Imprimer en PDF</button>
                    </div>
                </div>
            </div>
            <div class="invoice-wrap">
                <div class="invoice-box">
                    <div class="invoice-header">
                        <!-- Ajouter le logo ici si nécessaire -->
                    </div>
                    <h4 class="text-center mb-30 weight-600">DOSSIER MÉDICAL</h4>
                    <div class="row pb-30">
                        <div class="col-md-6">
                            <h5 class="mb-15">Nom du Patient: {{ $patient->name }}</h5>
                            <p class="font-14 mb-5">Date de Consultation: <strong class="weight-600">{{ $medicalRecord->date }}</strong></p>
                            <!-- Ajouter d'autres informations du patient si nécessaire -->
                        </div>
                        <div class="col-md-6">
                            <div class="text-right">
                                @if ($medicalRecord->user)
                                    <p class="font-14 mb-5">Nom du Médecin: <strong class="weight-600">{{ $medicalRecord->user->name }}</strong></p>
                                    <!-- Ajouter d'autres informations du médecin si nécessaire -->
                                @else
                                    <p class="font-14 mb-5">Aucun médecin associé</p>
                                @endif
                            </div>
                        </div>
                    </div>
                    
                    <div class="invoice-desc pb-30">
                        <div class="invoice-desc-head clearfix">
                            <div class="invoice-sub">Symptômes</div>
                            <div class="invoice-rate">Diagnostic</div>
                            <div class="invoice-hours">Traitement</div>
                        </div>
                        <div class="invoice-desc-body">
                            <ul>
                                <li class="clearfix">
                                    <div class="invoice-sub">{{ $medicalRecord->symptom }}</div>
                                    <div class="invoice-rate">{{ $medicalRecord->diagnosis }}</div>
                                    <div class="invoice-hours">{{ $medicalRecord->treatment }}</div>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="footer-wrap pd-20 mb-20 card-box">
            Hopital ma providence
        </div>
    </div>  
 </div>

 <!-- Modal de modification -->
<div class="modal fade" id="editMedicalRecordModal" tabindex="-1" role="dialog" aria-labelledby="editMedicalRecordModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editMedicalRecordModalLabel">Modifier le dossier médical</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <!-- Formulaire de modification de dossier médical va ici -->
                <form method="post" action="{{ route('medical-records.update', ['medical_record' => $medicalRecord->id]) }}">
                    @csrf
                    @method('PUT')
                
                    <!-- Ajoute les champs nécessaires pour la modification -->
                    <div class="form-group">
                        <label for="symptom">Symptômes</label>
                        <input type="text" class="form-control" id="symptom" name="symptom" value="{{ $medicalRecord->symptom }}" required>
                    </div>
                
                    <div class="form-group">
                        <label for="diagnosis">Diagnostic</label>
                        <input type="text" class="form-control" id="diagnosis" name="diagnosis" value="{{ $medicalRecord->diagnosis }}" required>
                    </div>
                
                    <div class="form-group">
                        <label for="treatment">Traitement</label>
                        <input type="text" class="form-control" id="treatment" name="treatment" value="{{ $medicalRecord->treatment }}" required>
                    </div>
                
                    <div class="form-group">
                        <label for="date">Date</label>
                        <input type="date" class="form-control" id="date" name="date" value="{{ $medicalRecord->date }}" required>
                    </div>
                
                    <button type="submit" class="btn btn-primary">Enregistrer les modifications</button>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
    // Fonction pour ouvrir le modal de modification
    function openEditModal() {
        $('#editMedicalRecordModal').modal('show');
    }
</script>

@endsection
