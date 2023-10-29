@extends('backend.template')
@section('route')
<div class="col-12">
    <div class="page-title-box d-sm-flex align-items-center justify-content-between">
        <h4 class="mb-sm-0">Analytics</h4>

        <div class="page-title-right">
            <ol class="breadcrumb m-0">
                <li class="breadcrumb-item"><a href="javascript: void(0);">Dashboards</a></li>
                <li class="breadcrumb-item active">Podcasts</li>
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
                <h3 class="box-title">Liste des Podcasts</h3>
            </div>
            <div class="col-lg-4">
                <button class="btn btn-seconday addnew" id="newuser" data-bs-toggle="modal" 
                data-bs-target="#createPodcastModal">Ajouter</button>
            </div>
        </div><br>
        <!-- /.box-header -->
        <div class="box-body">
            <table class="table table-hover display nowrap margin-top-10 table-responsive global-data-table">
                <thead>
                    <tr>
                        <th>Couverture</th>
                        <th>Titre</th>
                        <th>Label</th>
                        <th>Programme</th>
                        <th>Audio du Podcast</th>
                        <th>Créer Par</th>
                        <th>Validation</th>
                        <th>Sponsoring</th>
                        <th>Status</th>
                        <th>></th>
                    </tr>
                </thead>
                <tbody>
                    @if ($allpodcast ?? '')
                        @foreach ($allpodcast as $item)
                            <tr>
                                <td class="imagecolumn">
                                    <a href="Javascript:void()" id="detailmodal"
                                    data-title="{{ $item->title }}"
                                    data-label="{{ $item->label }}"
                                    data-description="{{ $item->description }}"
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
                                <td>{{ Str::limit($item->label, 20, '...') }}</td>
                                <td>{{ $item->program }}</td>
                                <td>
                                    <audio controls class="audioitem">
                                        <source src="{{asset('storage/'.$item->audio)}}">
                                        </audio>
                                </td>
                                <td>{{ $item->author }}</td>
                                <td>
                                    @if ($item->is_valid == 1)
                                        <span class="activeitem">Approuver</span>
                                    @else
                                        <span class="activeitem">Non Approuver</span>
                                    @endif
                                </td>
                                <td>
                                    @if ($item->is_sponsoring == 1)
                                        <span class="activeitem">Sponsoriser</span>
                                    @else
                                        <span class="activeitem">Non Sponsoriser</span>
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
                                                data-message="Le status de ce podcast sera mis à jour!"
                                                data-type="warning"
                                                data-url="{{ route ('status-podcast')}}"
                                                data-token="{{csrf_token()}}">
                                                <i class="ri-pencil-fill align-bottom me-2 text-muted"></i>  Activer/Désactiver</a>
                                            </li>
                                            <li>
                                                <a class="dropdown-item validationForm" href="javascript:void()"
                                                data-id="{{$item->id}}"
                                                data-message="Après avoir affectué cette action ce podcast sera visible par les visiteurs!"
                                                data-type="success"
                                                data-url="{{ route ('validation-podcast')}}"
                                                data-token="{{csrf_token()}}">
                                                <i class="ri-shield-fill align-bottom me-2 text-muted"></i>  Approuver/Déapprouver</a>
                                            </li>
                                            @if ($item->is_sponsoring == 1)
                                                <li>
                                                    <a class="dropdown-item validationForm" href="javascript:void()"
                                                    data-id="{{$item->id}}"
                                                    data-message="Ce Podcast ne sera plus sponsorisé"
                                                    data-type="success"
                                                    data-url="{{ route ('sponsoring-podcast')}}"
                                                    data-token="{{csrf_token()}}">
                                                    <i class="ri-article-fill align-bottom me-2 text-muted"></i>Supprimer le Sponsoring</a>
                                                </li>
                                            @else
                                                <li>
                                                    <a class="dropdown-item" href="javascript:void()"
                                                        data-bs-toggle="modal" data-bs-target="#SponsoringModal"
                                                        data-id="{{$item->id}}">
                                                    <i class="ri-article-fill align-bottom me-2 text-muted"></i>  Sponsorisé</a>
                                                </li>
                                            @endif
                                            <li>
                                                <a class="dropdown-item edit-item-btn" href="javascript:void()" 
                                                data-bs-toggle="modal" data-bs-target="#updatePodcastModal"
                                                data-id="{{ $item->id }}"
                                                data-title="{{ $item->title }}"
                                                data-label="{{ $item->label }}"
                                                data-description="{{ $item->description }}"
                                                data-program="{{ $item->program }}"
                                                data-programid="{{ $item->programid }}"
                                                data-cover="{{ asset('storage/'.$item->cover) }}"
                                                data-audio="{{ asset('storage/'.$item->audio) }}">
                                                <i class="ri-pencil-fill align-bottom me-2 text-muted"></i> Modifier</a>
                                            </li>
                                            <li>
                                                <a class="dropdown-item edit-item-btn deleteForm" 
                                                href="javascript:void()" 
                                                data-id="{{$item->id}}"
                                                data-message="Cet podcast sera supprimer!"
                                                data-type="warning"
                                                data-url="{{ route ('delete-podcast')}}"
                                                data-token="{{csrf_token()}}">
                                                <i class="ri-delete-bin-line"></i> Supprimer</a>
                                            </li>
                                        </ul>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    @else
                        <tr >
                            <td colspan="12" class="text-primary text-center" >
                                <p style="font-size: 14px; margin-top:50px; color:#888">Aucun Podcast enregistré pour l'instant!</p>
                            </td>
                        </tr>
                    @endif
                </tbody>
            </table>
        </div>
        <!-- /.box-body -->
    </div>
    <!-- /.box -->     
    
    <!-- modale ajouter un podcast -->
    <div id="createPodcastModal" class="modal fade" role="dialog">
        <div class="modal-dialog modal-lg">
            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <img class="col-lg-2 logoform" src="{{asset('images/logo.png')}}"/>
                    <h5 class="modal-title" id="exampleModalLabel">Création de Podcast</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form class="createform" lpformnum="1"  method="post" enctype="multipart/form-data" onsubmit="postSubmission()" action="{{ route ('create-podcast')}}">
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
                                <p style="color: #888">Label</p>
                                <div class="form-group label-floating" style="width: 100%;">
                                    <input class="form-control"  name="label" required placeholder="Label" />
                                    <hr>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-lg-12 col-md-12 col-xs-12">
                                <p style="color: #888">Programme</p>
                                <div class="form-group label-floating" style="width: 100%;">
                                    <select name="program" class="form-control" required>
                                        <option value="" selected>Selectionner le programme</option>
                                        @foreach ($allprogram as $item)
                                            <option value="{{$item->id}}">{{$item->title}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                        <hr>

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

                        <div class="row">
                            <div class="col-lg-12 col-md-12 col-xs-12" >
                                <p style="color: #888">Photo de couverture</p>
                                <div class="form-group label-floating" style="width: 100%;" >
                                    <input type="file" class="form-control" name="cover" required  />
                                </div>
                            </div>
                        </div><hr>

                        <div class="row">
                            <div class="col-lg-12 col-md-12 col-xs-12" >
                                <p style="color: #888">Ajouter un fichier audio (Mp3, Wav)</p>
                                <div class="form-group label-floating" style="width: 100%;" >
                                    <input type="file" class="form-control" name="audio"  required/>
                                </div>
                            </div>
                        </div><hr>

                    </div>
                    <div class="modal-footer">
                        <button data-bs-dismiss="modal" aria-label="Close" class="btn btn-bg-secondary">Annuler</button>
                        <button type="submit" class="btn btn-primary newBtn buttoncreate">Sauvegarder</button>
                    </div>
                </form>

            </div>
        </div>
    </div>
    <!-- end popup -->

    <!-- modale Modifier un podcast -->
    <div id="updatePodcastModal" class="modal fade" role="dialog">
        <div class="modal-dialog modal-lg">
            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <img class="col-lg-2 logoform" src="{{asset('images/logo.png')}}"/>
                    <h5 class="modal-title" id="exampleModalLabel">Mise à jour du Podcast</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form class="updateform" lpformnum="1"  method="post" enctype="multipart/form-data" onsubmit="postSubmissionUpdate()" action="{{ route ('update-podcast')}}">
                    <div class="modal-body">
                        @csrf
                        <input type="hidden" id="podcastid" name="id">
                        <div class="row">
                            <div class="col-lg-12 col-md-12 col-xs-12">
                                <p style="color: #888">Titre</p>
                                <div class="form-group label-floating" style="width: 100%;">
                                    <input class="form-control" id="podcasttitle" name="title" placeholder="Titre" />
                                    <hr>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-lg-12 col-md-12 col-xs-12">
                                <p style="color: #888">Label</p>
                                <div class="form-group label-floating" style="width: 100%;">
                                    <input class="form-control"  name="label" id="podcastlabel" placeholder="Label" />
                                    <hr>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-lg-12 col-md-12 col-xs-12">
                                <p style="color: #888">Programme</p>
                                <div class="form-group label-floating" style="width: 100%;">
                                    <select name="program" class="form-control" id="podcastprogram">
                                        <option value="" selected>Selectionner le programme</option>
                                        @foreach ($allprogram as $item)
                                            <option value="{{$item->id}}">{{$item->title}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                        <hr>

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

                        <div class="row">
                            <div class="col-lg-6 col-md-12 col-xs-12" >
                                <p style="color: #888">Vidéo </p>
                                <audio controls id="audiotoupdate">
                                    <source src="" >
                                </audio>
                            </div>
                            <div class="col-lg-6 col-md-12 col-xs-12" >
                                <p style="color: #888">Vidéo du podcast</p>
                                <div class="form-group label-floating" style="width: 100%;" >
                                    <input type="file" class="form-control" id="audio" name="audio"  />
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

     <!-- modale sponsoring -->
     <div id="SponsoringModal" class="modal fade" role="dialog">
        <div class="modal-dialog">
            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <img class="col-lg-2 logoform" src="{{asset('images/logo.png')}}"/>
                    <h5 class="modal-title" id="exampleModalLabel">Sponsorisé ce Podcast</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form class="updateform" lpformnum="1"  method="post" enctype="multipart/form-data" action="{{ route ('sponsoring-podcast')}}">
                    <div class="modal-body">
                        @csrf
                        <input type="hidden" id="podcastsponsoringid" name="id">
                        <div class="row">
                            <div class="col-lg-12 col-md-12 col-xs-12">
                                <p style="color: #888">Période de sponsoring</p>
                                <div class="form-group label-floating" style="width: 100%;">
                                    <select name="sponsoring" class="form-control">
                                        <option value="" selected>Choisir une période</option>
                                        <option value="1">Période de 1 - 3 Jours</option>
                                        <option value="2">Période de 1 - 7 Jours</option>
                                        <option value="3">Période de 1 - 14 Jours</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <hr>


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