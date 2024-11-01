@extends('layouts.app')

@section('content')
<div class="card-box mb-30">
    <div class="pd-20">
        <h4 class="text-blue h4">Détails de l'agent</h4>
    </div>
    <div class="pb-20">
        <table class="table table-striped">
            <tr>
                <th>Nom</th>
                <td>{{ $agent->name }}</td>
            </tr>
            <tr>
                <th>Email</th>
                <td>{{ $agent->email }}</td>
            </tr>
            <tr>
                <th>Téléphone</th>
                <td>{{ $agent->phone }}</td>
            </tr>
            <tr>
                <th>Adresse</th>
                <td>{{ $agent->address }}</td>
            </tr>
            <tr>
                <th>QR Code</th>
                <td>
                    <!-- Afficher le QR code directement -->
                    {!! QrCode::size(100)->generate($agent->qrcode) !!}
                </td>
            </tr>
        </table>
    </div>
    <a href="{{ route('agents.index') }}" class="btn btn-primary">Retour à la liste</a>
</div>
@endsection
