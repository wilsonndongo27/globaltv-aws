@extends('backend.template')
@section('linking')
@section('pageroute')
    <h4 class="page-title mb-0">
        Accueil - <span class="fw-normal">Entreprise</span>
    </h4>
@endsection
@section('body')
<div>
    <div class="col-xl-12">

        <!-- Marketing campaigns -->
        <div class="card">
                <div class="card-header d-flex align-items-center">
                    <h5 class="mb-0">Information sur l'entreprise</h5>
                    <div class="d-inline-flex ms-auto">
                        <i class="ph ph-pencil editinfo"></i>
                    </div>
                </div>
                
            @if ($company)
                <div class="row blocklineinfocompany">
                    <div class="d-flex align-items-center col-lg-6">
                        <div>
                            <span class="text-body fw-semibold labelinfocompany">Nom de l'Entreprise : </span>
                            <span class="infotext">GLOBAL TV</span>
                        </div>
                    </div>
                    <div class="d-flex align-items-center col-lg-6">
                        <div>
                            <span class="text-body fw-semibold labelinfocompany">Vision : </span>
                            <span class="infotext">GLOBAL TV, Est un chaine de télévision</span>
                        </div>
                    </div>
                </div><hr>
                <div class="blocklineinfocompany">
                    <div class="d-flex align-items-center">
                        <div>
                            <span class="text-body fw-semibold labelinfocompany">Objectif : </span>
                            <span class="infotext">GLOBAL TV, I recently launched a new package that gives you a powerful setup for dealing with the 
                                different Countries, States and Cities of the world, all through a comfortable Laravel syntax using Eloquent.</span>
                        </div>
                    </div>
                </div><hr>

                <div class="row blocklineinfocompany">
                    <div class="d-flex align-items-center col-lg-6">
                        <div>
                            <span class="text-body fw-semibold labelinfocompany">Adresse Email : </span>
                            <span class="infotext">wilson@gmai.com</span>
                        </div>
                    </div>
                    <div class="d-flex align-items-center col-lg-6">
                        <div>
                            <span class="text-body fw-semibold labelinfocompany">Téléphone : </span>
                            <span class="infotext">XXXXX99999</span>
                        </div>
                    </div>
                </div><hr>

                <div class="row blocklineinfocompany">
                    <div class="d-flex align-items-center col-lg-6">
                        <div>
                            <span class="text-body fw-semibold labelinfocompany">Logo  </span>
                            <img src="" alt="">
                        </div>
                    </div>
                    <div class="d-flex align-items-center col-lg-6">
                        <div>
                            <span class="text-body fw-semibold labelinfocompany">Couverture </span>
                            <img src="" alt="">
                        </div>
                    </div>
                </div><hr>
            @else
                <div>
                    <div colspan="7" class="text-primary text-center blockemptygabarit" >
                        <a href="#" class="btn btn-primary" id="addCompany">
                            Aucune information enregistrer, veuillez cliquer ici pour enregistrer!
                        </a>
                    </div>
                </div>
            @endif
        
        </div>
    </div>
    
    <!-- modale de add infos company -->
    <div id="companyModal" class="modal fade" role="dialog">
        <div class="modal-dialog modal-lg">
            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header row">
                    <img class="col-lg-2 logoform" src="{{asset('images/logomini.jpeg')}}"/>
                    <h4 class="col-lg-7 modal-title">Ajouter les informations de entreprise</h4>
                    <button type="button" class="col-lg-2 close" data-dismiss="modal">&times;</button>
                </div>
                <form class="createform" lpformnum="1"  method="post" enctype="multipart/form-data" onsubmit="postSubmission()" action="{{ route('create-company')}}">
                    <div class="modal-body">
                        @csrf
                        <div class="row">
                            <div class="col-lg-12 col-md-12 col-xs-12">
                                <p>Nom de l'entreprise</p>
                                <div class="form-group label-floating">
                                    <input class="form-control" name="name" required placeholder="Nom" />
                                    <hr>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-lg-12 col-md-12 col-xs-12">
                                <p>La vision de l'entreprise</p>
                                <div class="form-group label-floating">
                                    <textarea class="form-control" name="vision"  required rows="6" placeholder="La vision de l'company"></textarea>
                                    <hr>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-lg-12 col-md-12 col-xs-12">
                                <p>Objectifs de l'entreprise</p>
                                <div class="form-group label-floating">
                                    <div class="editor" style="height:40vh">
                                    </div>
                                    <input class="form-control post-content" name="objectif" type="hidden"/>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-lg-12 col-md-12 col-xs-12">
                                <p>Adresse google map de l'entreprise</p>
                                <div class="form-group label-floating">
                                    <input class="form-control" name="mapLink" required placeholder="Map" />
                                    <hr>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-lg-5 col-md-12 col-xs-12 col-xs-12" >
                                <p>Logo de l'entreprise</p>
                                <div class="form-group label-floating">
                                    <input type="file" class="form-control" id="logo" name="logo" required  />
                                    <hr>
                                </div>
                            </div>
                            <div class="col-lg-5 col-md-12 col-xs-12 col-xs-12" >
                                <p>Photo de couverture de l'entreprise (Optionnel)</p>
                                <div class="form-group label-floating">
                                    <input type="file" class="form-control" id="cover" name="cover"  />
                                    <hr>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="reset" data-dismiss="modal" aria-label="Close" aria-hidden="true" class="btn btn-bg-secondary">Annuler</button>
                        <button type="submit" class="btn btn-primary newBtn buttoncreate">Sauvegarder</button>
                    </div>
                </form>

            </div>
        </div>
    </div>
    <!-- end popup -->

    <!-- Modale pour mettre les informations de l'entreprise -->
    <div id="updateCompanyModal" class="modal fade" role="dialog">
        <div class="modal-dialog modal-lg">
            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header row">
                    <img class="col-lg-2 logoform" src="{{asset('images/logomini.jpeg')}}"/>
                    <h4 class="col-lg-7 modal-title">Mise à jour des informations de l'entreprise</h4>
                    <button type="button" class="col-lg-2 close" data-dismiss="modal">&times;</button>
                </div>
                <form class="updateform" lpformnum="1"  method="post" enctype="multipart/form-data" onsubmit="postSubmissionUpdate()" action="{{ route('update-company')}}">
                    <div class="modal-body">
                        @csrf
                        <div class="row">
                            <div class="col-lg-12 col-md-12 col-xs-12">
                                <p>Nom de l'entreprise</p>
                                <div class="form-group label-floating">
                                    <input class="form-control" name="name" id="companyname" required placeholder="Nom" />
                                    <hr>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-lg-12 col-md-12 col-xs-12">
                                <p>La vision de l'entreprise</p>
                                <div class="form-group label-floating">
                                    <textarea class="form-control" name="vision" id="companyvision"  required rows="6" placeholder="La vision de l'company"></textarea>
                                    <hr>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-lg-12 col-md-12 col-xs-12">
                                <p>Objectifs de l'entreprise</p>
                                <div class="form-group label-floating">
                                    <div class="editorupdate" style="height:40vh">
                                    </div>
                                    <input class="form-control post-content-update" name="objectif" type="hidden"/>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-lg-12 col-md-12 col-xs-12">
                                <p>Adresse google map de l'entreprise</p>
                                <div class="form-group label-floating">
                                    <input class="form-control" id="companymap" name="mapLink" placeholder="Map" />
                                    <hr>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-lg-5 col-md-12 col-xs-12">
                                <img src="" alt="" class="updateimage" id="companylogo">
                            </div>
                            <div class="col-lg-5 col-md-12 col-xs-12 col-xs-12" >
                                <p>Logo de l'entreprise</p>
                                <div class="form-group label-floating">
                                    <input type="file" class="form-control" id="logo" name="logo"  />
                                    <hr>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-5 col-md-12 col-xs-12" >
                                <img src="" alt="" class="updateimage" id="companycover">
                            </div>
                            <div class="col-lg-5 col-md-12 col-xs-12 col-xs-12" >
                                <p>Photo de couverture de l'entreprise (Optionnel)</p>
                                <div class="form-group label-floating">
                                    <input type="file" class="form-control" id="cover" name="cover"  />
                                    <hr>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="reset" data-dismiss="modal" aria-label="Close" aria-hidden="true" class="btn btn-bg-secondary">Annuler</button>
                        <button type="submit" class="btn btn-primary newBtn buttonupdate">Sauvegarder</button>
                    </div>
                </form>

            </div>
        </div>
    </div>
    <!-- end popup -->
</div>
</div>
@endsection

