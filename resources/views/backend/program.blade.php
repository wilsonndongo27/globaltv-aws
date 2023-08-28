@extends('backend.template')
@section('route')
<div class="col-12">
    <div class="page-title-box d-sm-flex align-items-center justify-content-between">
        <h4 class="mb-sm-0">Analytics</h4>

        <div class="page-title-right">
            <ol class="breadcrumb m-0">
                <li class="breadcrumb-item"><a href="javascript: void(0);">Dashboards</a></li>
                <li class="breadcrumb-item active">Programmes</li>
            </ol>
        </div>

    </div>
</div>
@endsection
@section('body')
<div class="col-12">
    <div class="box">
        <div class="box-header headerpage row">
            <div class="col-lg-8">
                <h3 class="box-title">Liste des Programmes</h3>
            </div>
            <div class="col-lg-4">
                <button class="btn btn-seconday addnew" data-bs-toggle="modal" 
                data-bs-target="#createProgramModal">Ajouter</button>
            </div>
        </div><br>
        <!-- /.box-header -->
        <div class="box-body">
            <table class="table table-hover display nowrap margin-top-10 table-responsive global-data-table">
                <thead>
                    <tr>
                        <th>Couverture</th>
                        <th>Titre</th>
                        <th>Jour(s) de diffusion</th>
                        <th>Heur de début</th>
                        <th>Heur de fin</th>
                        <th>Date Prochaine Diffusion</th>
                        <th>Validation</th>
                        <th>Status</th>
                        <th>></th>
                    </tr>
                </thead>
                <tbody>
                    @if ($allprogram ?? '')
                        @foreach ($allprogram as $item)
                            <tr>
                                <td class="imagecolumn">
                                    <a href="Javascript:void()" id="detailmodal"
                                    data-title="{{ $item->title }}"
                                    data-timestart="{{ $item->time_start }}"
                                    data-timeend="{{ $item->time_end }}"
                                    data-date="{{ $item->date }}"
                                    data-day="{{ $item->day }}"
                                    data-description="{{ $item->description }}"
                                    data-valid="{{ $item->is_valid }}"
                                    data-status="{{ $item->is_active }}"
                                    data-cover="{{ asset('storage/'.$item->cover) }}"
                                    >
                                        <img class="zoom"  style="border-radius: 10%;"
                                        @if ($item->cover) 
                                            src="{{ asset('storage/'.$item->cover) }}" 
                                        @else
                                            src="{{ asset('image/user-default.png') }}" 
                                        @endif 
                                        alt="{{$item->cover}}" alt="" />
                                    </a>
                                </td>
                                <td>{{ Str::limit($item->title, 20, '...') }}</td>
                                <td>{{ Str::limit($item->day, 20, '...') }}</td>
                                <td>{{ $item->time_start }}</td>
                                <td>{{ $item->time_end }}</td>
                                <td>{{ $item->date }}</td>
                                <td>
                                    @if ($item->is_valid == 1)
                                        <span class="activeitem">Approuver</span>
                                    @else
                                        <span class="activeitem">Non Approuver</span>
                                    @endif
                                </td>
                                <td>
                                    @if ($item->is_active == 1)
                                        <span class="activeitem">Actif</span>
                                    @else
                                        <span class="activeitem">inactif</span>
                                    @endif
                                </td>
                                <td>
                                    <div class="dropdown d-inline-block">
                                        <button class="btn btn-soft-secondary btn-sm dropdown" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                            <i class="ri-more-fill align-middle"></i>
                                        </button>
                                        <ul class="dropdown-menu dropdown-menu-end">
                                            <li>
                                                <a class="dropdown-item statusForm" href="javascript:void()"
                                                data-id="{{$item->id}}"
                                                data-message="Le status de ce programme sera mis à jour!"
                                                data-type="warning"
                                                data-url="{{ route ('status-program')}}"
                                                data-token="{{csrf_token()}}">
                                                <i class="ri-indeterminate-circle-fill align-bottom me-2 text-muted"></i>  Activer/Désactiver</a>
                                            </li>
                                            <li>
                                                <a class="dropdown-item validationForm" href="javascript:void()"
                                                data-id="{{$item->id}}"
                                                data-message="Après avoir affectué cette action ce programme sera visible par les visiteurs!"
                                                data-type="success"
                                                data-url="{{ route ('validation-program')}}"
                                                data-token="{{csrf_token()}}">
                                                <i class="ri-shield-fill align-bottom me-2 text-muted"></i>  Approuver/Déapprouver</a>
                                            </li>
                                            <li>
                                                <a class="dropdown-item edit-item-btn" href="javascript:void()" 
                                                data-bs-toggle="modal" data-bs-target="#updateProgramModal"
                                                data-id="{{ $item->id }}"
                                                data-title="{{ $item->title }}"
                                                data-day="{{ $item->day }}"
                                                data-timestart="{{ $item->time_start }}"
                                                data-timeend="{{ $item->time_end }}"
                                                data-date="{{ $item->date }}"
                                                data-description="{{ $item->description }}"
                                                data-cover="{{ asset('storage/'.$item->cover) }}">
                                                <i class="ri-pencil-fill align-bottom me-2 text-muted"></i> Modifier</a>
                                            </li>
                                            <li>
                                                <a class="dropdown-item edit-item-btn deleteForm" 
                                                href="javascript:void()" 
                                                data-id="{{$item->id}}"
                                                data-message="Cet Programme sera supprimer!"
                                                data-type="warning"
                                                data-url="{{ route ('delete-program')}}"
                                                data-token="{{csrf_token()}}">
                                                <i class="fa fa-trash"></i> Supprimer</a>
                                            </li>
                                        </ul>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    @else
                        <tr >
                            <td colspan="12" class="text-primary text-center" >
                                <p style="font-size: 14px; margin-top:50px; color:#888">Aucun Programme enregistré pour l'instant!</p>
                            </td>
                        </tr>
                    @endif
                </tbody>
            </table>
        </div>
        <!-- /.box-body -->
    </div>
    <!-- /.box -->     
    
    <!-- modale ajouter une programme -->
    <div id="createProgramModal" class="modal fade" role="dialog">
        <div class="modal-dialog modal-lg">
            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <img class="col-lg-2 logoform" src="{{asset('images/logo.png')}}"/>
                    <h5 class="modal-title" id="exampleModalLabel">Création de Programme</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form class="createform" lpformnum="1"  method="post" enctype="multipart/form-data" onsubmit="postSubmission()" action="{{ route ('create-program')}}">
                    <div class="modal-body">
                        @csrf
                        <input type="hidden" name="author" value="{{Auth::user()->id}}">
                        <div class="row">
                            <div class="col-lg-12 col-md-12 col-xs-12">
                                <p style="color: #888">Titre</p>
                                <div class="form-group label-floating" style="width: 100%;">
                                    <input class="form-control"  name="title" required placeholder="Titre" />
                                    <hr>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-lg-12 col-md-12 col-xs-12">
                                <p>Description</p>
                                <div class="form-group label-floating">
                                    <div class="editor" style="height:40vh">
                                    </div>
                                    <input class="form-control post-content" name="description" type="hidden"/>
                                    <hr>
                                </div>
                            </div>
                        </div>
                        
                        <div class="col-lg-12 col-md-12 col-xs-12">
                            <p style="color: #888">Les Jour de diffusion du programme</p>
                            <div class="form-group label-floating" style="width: 100%;">
                                <select name="day[]" class="form-control select" multiple>
                                    <option value="">Selectionner</option>
                                    <option value="Lundi">Lundi</option>
                                    <option value="Mardi">Mardi</option>
                                    <option value="Mercredi">Mercredi</option>
                                    <option value="Jeudi">Jeudi</option>
                                    <option value="Vendredi">Vendredi</option>
                                    <option value="Samedi">Samedi</option>
                                    <option value="Dimanche">Dimanche</option>
                                </select>
                            </div>
                        </div>
                        <hr>

                        <div class="row">
                            <div class="col-lg-4 col-md-12 col-xs-12">
                                <p style="color: #888">Date de la prochaine Diffusion</p>
                                <div class="form-group label-floating" style="width: 100%;">
                                    <input type="date" required class="form-control" name="date">
                                </div>
                            </div>
                            <div class="col-lg-4 col-md-12 col-xs-12">
                                <p style="color: #888">Heur de début</p>
                                <div class="form-group label-floating" style="width: 100%;">
                                    <input type="time" name="time_start" required class="form-control">
                                </div>
                            </div>
                            <div class="col-lg-4 col-md-12 col-xs-12">
                                <p style="color: #888">Heur de Fin</p>
                                <div class="form-group label-floating" style="width: 100%;">
                                    <input type="time" name="time_end" required class="form-control">
                                </div>
                            </div>
                        </div>
                        <hr>

                        <div class="row">
                            <div class="col-lg-12 col-md-12 col-xs-12" >
                                <p style="color: #888">Photo de couverture</p>
                                <div class="form-group label-floating" style="width: 100%;" >
                                    <input type="file" class="form-control" name="cover" required  />
                                </div>
                            </div>
                        </div>
                        <hr>

                    </div>
                    <div class="modal-footer">
                        <button data-bs-dismiss="modal" aria-label="Close" class="btn btn-bg-secondary">Annuler</button>
                        <button type="submit" class="btn btn-primary newBtn buttomcreate">Sauvegarder</button>
                    </div>
                </form>

            </div>
        </div>
    </div>
    <!-- end popup -->

    <!-- modale Modifier une programme -->
    <div id="updateProgramModal" class="modal fade" role="dialog">
        <div class="modal-dialog modal-lg">
            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <img class="col-lg-2 logoform" src="{{asset('images/logo.png')}}"/>
                    <h5 class="modal-title" id="exampleModalLabel">Mise à jour du Programme</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form class="updateform" lpformnum="1"  method="post" enctype="multipart/form-data" onsubmit="postSubmissionUpdate()" action="{{ route ('update-program')}}">
                    <div class="modal-body">
                        @csrf
                        <input type="hidden" id="programid" name="id">
                        <div class="row">
                            <div class="col-lg-12 col-md-12 col-xs-12">
                                <p style="color: #888">Titre</p>
                                <div class="form-group label-floating" style="width: 100%;">
                                    <input class="form-control" id="programtitle" name="title" placeholder="Titre" />
                                    <hr>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-lg-12 col-md-12 col-xs-12">
                                <p>Description</p>
                                <div class="form-group label-floating">
                                    <div class="editorupdate" style="height:40vh">
                                    </div>
                                    <input class="form-control post-content-update" name="description" type="hidden"/>
                                    <hr>
                                </div>
                            </div>
                        </div>
                       
                        <div class="col-lg-12 col-md-12 col-xs-12">
                            <p style="color: #888">Jour de diffusion du programme : <span class="activeitem" id="programday"></span></p>
                            <div class="form-group label-floating" style="width: 100%;">
                                <select name="day[]" class="form-control select" multiple>
                                    <option value="">Selectionner</option>
                                    <option value="Lundi">Lundi</option>
                                    <option value="Mardi">Mardi</option>
                                    <option value="Mercredi">Mercredi</option>
                                    <option value="Jeudi">Jeudi</option>
                                    <option value="Vendredi">Vendredi</option>
                                    <option value="Samedi">Samedi</option>
                                    <option value="Dimanche">Dimanche</option>
                                </select>
                            </div>
                        </div>
                        <hr>

                        <div class="row">
                            <div class="col-lg-4 col-md-12 col-xs-12">
                                <p style="color: #888">Date de la prochaine Diffusion</p>
                                <div class="form-group label-floating" style="width: 100%;">
                                    <input type="date" name="date" id="programdate" class="form-control">
                                </div>
                            </div>
                            <div class="col-lg-4 col-md-12 col-xs-12">
                                <p style="color: #888">Heur de début</p>
                                <div class="form-group label-floating" style="width: 100%;">
                                    <input type="time" name="time_start" id="programtimestart" class="form-control">
                                </div>
                            </div>
                            <div class="col-lg-4 col-md-12 col-xs-12">
                                <p style="color: #888">Heur de Fin</p>
                                <div class="form-group label-floating" style="width: 100%;">
                                    <input type="time" id="programtimeend" name="time_end" class="form-control">
                                </div>
                            </div>
                        </div>
                        <hr>

                        
                        <div class="row">
                            <div class="col-lg-6 col-md-12 col-xs-12" >
                                <p style="color: #888">Photo </p>
                                <img src="" alt="" id="imagetoupdate">
                            </div>
                            <div class="col-lg-6 col-md-12 col-xs-12" >
                                <p style="color: #888">Photo de Couverture</p>
                                <div class="form-group label-floating" style="width: 100%;" >
                                    <input type="file" class="form-control" id="cover" name="cover"  />
                                </div>
                            </div>
                        </div><hr>

                    </div>
                    <div class="modal-footer">
                        <button data-bs-dismiss="modal" aria-label="Close" class="btn btn-bg-secondary">Annuler</button>
                        <button type="submit" class="btn btn-primary newBtn buttonupdate">Sauvegarder</button>
                    </div>
                </form>

            </div>
        </div>
    </div>
    <!-- end popup -->

</div>
@endsection