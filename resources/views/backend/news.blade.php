@extends('backend.template')
@section('route')
<div class="col-12">
    <div class="page-title-box d-sm-flex align-items-center justify-content-between">
        <h4 class="mb-sm-0">Analytics</h4>

        <div class="page-title-right">
            <ol class="breadcrumb m-0">
                <li class="breadcrumb-item"><a href="javascript: void(0);">Dashboards</a></li>
                <li class="breadcrumb-item active">Actualités</li>
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
                <h3 class="box-title">Liste des Actualités</h3>
            </div>
            <div class="col-lg-4">
                <button class="btn btn-seconday addnew" id="newuser" data-bs-toggle="modal" 
                data-bs-target="#createNewsModal">Ajouter</button>
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
                        <th>Catégorie</th>
                        <th>Pays Origine</th>
                        <th>Priorité</th>
                        <th>Créer Par</th>
                        <th>Validation</th>
                        <th>Status</th>
                        <th>></th>
                    </tr>
                </thead>
                <tbody>
                    @if ($allnews ?? '')
                        @foreach ($allnews as $item)
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
                                <td>{{ $item->category }}</td>
                                <td>{{ $item->country }}</td>
                                <td>
                                    @if ($item->priority == 0)
                                        <span class="activeitem">Par défault</span>
                                    @elseif ($item->priority == 1)
                                        <span class="activeitem">Faible</span>
                                    @elseif ($item->priority == 2)
                                        <span class="activeitem">Moyenne</span>
                                    @else
                                        <span class="activeitem">Haute</span>
                                    @endif
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
                                                data-message="Le status de cet actualité sera mis à jour!"
                                                data-type="warning"
                                                data-url="{{ route ('status-news')}}"
                                                data-token="{{csrf_token()}}">
                                                <i class="ri-pencil-fill align-bottom me-2 text-muted"></i>  Activer/Désactiver</a>
                                            </li>
                                            <li>
                                                <a class="dropdown-item validationForm" href="javascript:void()"
                                                data-id="{{$item->id}}"
                                                data-message="Après avoir affectué cette action l'actualité sera visible par les visiteurs!"
                                                data-type="success"
                                                data-url="{{ route ('validation-news')}}"
                                                data-token="{{csrf_token()}}">
                                                <i class="ri-shield-fill align-bottom me-2 text-muted"></i>  Approuver/Déapprouver</a>
                                            </li>
                                            <li>
                                                <a class="dropdown-item edit-item-btn" href="javascript:void()" 
                                                data-bs-toggle="modal" data-bs-target="#updateNewsModal"
                                                data-id="{{ $item->id }}"
                                                data-title="{{ $item->title }}"
                                                data-label="{{ $item->label }}"
                                                data-description="{{ $item->description }}"
                                                data-category="{{ $item->category }}"
                                                data-categoryid="{{ $item->categoryid }}"
                                                data-country="{{ $item->country }}"
                                                data-countryid="{{ $item->countryid }}"
                                                data-priority="{{ $item->priority }}"
                                                data-cover="{{ asset('storage/'.$item->cover) }}"
                                                data-video="{{ asset('storage/'.$item->video) }}">
                                                <i class="ri-pencil-fill align-bottom me-2 text-muted"></i> Modifier</a>
                                            </li>
                                            <li>
                                                <a class="dropdown-item edit-item-btn deleteForm" 
                                                href="javascript:void()" 
                                                data-id="{{$item->id}}"
                                                data-message="Cet Actualité sera supprimer!"
                                                data-type="warning"
                                                data-url="{{ route ('delete-news')}}"
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
                                <p style="font-size: 14px; margin-top:50px; color:#888">Aucune Actualité enregistré pour l'instant!</p>
                            </td>
                        </tr>
                    @endif
                </tbody>
            </table>
        </div>
        <!-- /.box-body -->
    </div>
    <!-- /.box -->     
    
    <!-- modale ajouter une actualité -->
    <div id="createNewsModal" class="modal fade" role="dialog">
        <div class="modal-dialog modal-lg">
            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <img class="col-lg-2 logoform" src="{{asset('images/logo.png')}}"/>
                    <h5 class="modal-title" id="exampleModalLabel">Création de l'Actualité</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form class="createform" lpformnum="1"  method="post" enctype="multipart/form-data" onsubmit="postSubmission()" action="{{ route ('create-news')}}">
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
                                    <input type="text" class="form-control" name="label" required placeholder="Label" />
                                    <hr>
                                </div>
                            </div>
                        </div>
                        <hr>

                        <div class="row">
                            <div class="col-lg-6 col-md-12 col-xs-12">
                                <p style="color: #888">Catégorie</p>
                                <div class="form-group label-floating" style="width: 100%;">
                                    <select name="category" class="form-control" required>
                                        <option value="" selected>Selectionner la categorie</option>
                                        @foreach ($allcategory as $item)
                                            <option value="{{$item->id}}">{{$item->title}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-lg-6 col-md-12 col-xs-12">
                                <p style="color: #888">Pays d'Origine</p>
                                <div class="form-group label-floating" style="width: 100%;">
                                    <select name="country" class="form-control" required>
                                        <option value="" selected>Selectionner le Pays d'origine</option>
                                        @foreach ($allcountry as $item)
                                            <option value="{{$item->id}}">{{$item->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                        <hr>

                        <div class="row">
                            <div class="col-lg-12 col-md-12 col-xs-12">
                                <p style="color: #888">Priorité</p>
                                <div class="form-group label-floating" style="width: 100%;">
                                    <select name="priority" class="form-control" required>
                                        <option value="0">Priorité par défault</option>
                                        <option value="1">Faible</option>
                                        <option value="2">Moyenne</option>
                                        <option value="3">Haute</option>
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
                                <p style="color: #888">Ajouter une vidéo (Optionnel)</p>
                                <div class="form-group label-floating" style="width: 100%;" >
                                    <input type="file" class="form-control" name="video"  />
                                </div>
                            </div>
                        </div><hr>

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

     <!-- modale Modifier une actualité -->
     <div id="updateNewsModal" class="modal fade" role="dialog">
        <div class="modal-dialog modal-lg">
            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <img class="col-lg-2 logoform" src="{{asset('images/logo.png')}}"/>
                    <h5 class="modal-title" id="exampleModalLabel">Mise à jour de l'actualité</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form class="updateform" lpformnum="1"  method="post" enctype="multipart/form-data" onsubmit="postSubmissionUpdate()" action="{{ route ('update-news')}}">
                    <div class="modal-body">
                        @csrf
                        <input type="hidden" id="newsid" name="id">
                        <div class="row">
                            <div class="col-lg-12 col-md-12 col-xs-12">
                                <p style="color: #888">Titre</p>
                                <div class="form-group label-floating" style="width: 100%;">
                                    <input class="form-control" id="newstitle" name="title" placeholder="Titre" />
                                    <hr>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-lg-12 col-md-12 col-xs-12">
                                <p style="color: #888">Label</p>
                                <div class="form-group label-floating" style="width: 100%;">
                                    <input type="text" id="newslabel" class="form-control" name="label" placeholder="Label" />
                                    <hr>
                                </div>
                            </div>
                        </div>
                        <hr>

                        <div class="row">
                            <div class="col-lg-6 col-md-12 col-xs-12">
                                <p style="color: #888">Catégorie</p>
                                <div class="form-group label-floating" style="width: 100%;">
                                    <select name="category" id="newscategory" class="form-control">
                                        <option value="" selected>Selectionner la categorie</option>
                                        @foreach ($allcategory as $item)
                                            <option value="{{$item->id}}">{{$item->title}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-lg-6 col-md-12 col-xs-12">
                                <p style="color: #888">Pays d'Origine</p>
                                <div class="form-group label-floating" style="width: 100%;">
                                    <select name="country" id="newscountry" class="form-control">
                                        <option value="" selected>Selectionner le Pays d'origine</option>
                                        @foreach ($allcountry as $item)
                                            <option value="{{$item->id}}">{{$item->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                        <hr>

                        <div class="row">
                            <div class="col-lg-12 col-md-12 col-xs-12">
                                <p style="color: #888">Priorité</p>
                                <div class="form-group label-floating" style="width: 100%;">
                                    <select name="priority" class="form-control" id="newspriority">
                                        <option value="0">Priorité par défault</option>
                                        <option value="1">Faible</option>
                                        <option value="2">Moyenne</option>
                                        <option value="3">Haute</option>
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
                                <video controls>
                                    <source src="" id="videotoupdate">
                                </video>
                            </div>
                            <div class="col-lg-6 col-md-12 col-xs-12" >
                                <p style="color: #888">Vidéo Liée</p>
                                <div class="form-group label-floating" style="width: 100%;" >
                                    <input type="file" class="form-control" id="video" name="video"  />
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