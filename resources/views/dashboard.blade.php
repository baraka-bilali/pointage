@extends('layouts.app')

<div class="main-container">
    <div class="pd-ltr-20">
        <h1>Bonjour <span style="color: rgb(13, 86, 196)">{{ Auth::user()?->name }}</span> <br> Bienvenue sur la page d'acceuil d'administration <br> de la station Total <span style="color: red">Energies</span> </h1>
    </div>
</div>

<div class="main-container">
    <div class="pd-ltr-20">
        <div class="row">
            <div class="col-xl-3 mb-30">
                <div class="card-box height-100-p widget-style1">
                    <div class="d-flex flex-wrap align-items-center">
                        <div class="progress-data">
                            <div id="chart"></div>
                        </div>
                        <div class="widget-data">
                            <div class="h4 mb-0">500</div>
                            <div class="weight-600 font-14">Agents</div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 mb-30">
                <div class="card-box height-100-p widget-style1">
                    <div class="d-flex flex-wrap align-items-center">
                        <div class="progress-data">
                            <div id="chart2"></div>
                        </div>
                        <div class="widget-data">
                            <div class="h4 mb-0">400</div>
                            <div class="weight-600 font-14">Retards</div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 mb-30">
                <div class="card-box height-100-p widget-style1">
                    <div class="d-flex flex-wrap align-items-center">
                        <div class="progress-data">
                            <div id="chart3"></div>
                        </div>
                        <div class="widget-data">
                            <div class="h4 mb-0">350</div>
                            <div class="weight-600 font-14">Absence</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>