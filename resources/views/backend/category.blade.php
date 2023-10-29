@extends('backend.template')
@section('route')
<div class="col-12">
    <div class="page-title-box d-sm-flex align-items-center justify-content-between">
        <h4 class="mb-sm-0">Analytics</h4>

        <div class="page-title-right">
            <ol class="breadcrumb m-0">
                <li class="breadcrumb-item"><a href="javascript: void(0);">Dashboards</a></li>
                <li class="breadcrumb-item active">Catégories</li>
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
                <h3 class="box-title">Liste des Catégories</h3>
            </div>
            <div class="col-lg-4">
                <button class="btn btn-seconday addnew" data-bs-toggle="modal" 
                data-bs-target="#createCategoryModal">Ajouter</button>
            </div>
        </div><br>
        <!-- /.box-header -->
        <div class="box-body">
            <table class="table table-hover display nowrap margin-top-10 table-responsive global-data-table">
                <thead>
                    <tr>
                        <th>Titre</th>
                        <th>Créer Par</th>
                        <th>Status</th>
                        <th>></th>
                    </tr>
                </thead>
                <tbody>
                    @if ($allcategory ?? '')
                        @foreach ($allcategory as $item)
                            <tr>
                                <td>{{ $item->title }}</td>
                                <td>{{ $item->author }}</td>
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
                                                data-message="Le status de cet catégorie sera mis à jour!"
                                                data-type="warning"
                                                data-url="{{ route ('status-category')}}"
                                                data-token="{{csrf_token()}}">
                                                <i class="ri-pencil-fill align-bottom me-2 text-muted"></i>  Activer/Désactiver</a>
                                            </li>
                                            <li>
                                                <a class="dropdown-item edit-item-btn" href="javascript:void()" 
                                                data-bs-toggle="modal" data-bs-target="#updateCategoryModal"
                                                data-id="{{ $item->id }}"
                                                data-title="{{ $item->title }}"
                                                data-description="{{ $item->description }}">
                                                <i class="ri-pencil-fill align-bottom me-2 text-muted"></i> Modifier</a>
                                            </li>
                                            <li>
                                                <a class="dropdown-item edit-item-btn deleteForm" 
                                                href="javascript:void()" 
                                                data-id="{{$item->id}}"
                                                data-message="Cet Catégorie sera supprimer!"
                                                data-type="warning"
                                                data-url="{{ route ('delete-category')}}"
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
                            <td colspan="7" class="text-primary text-center" >
                                <p style="font-size: 14px; margin-top:50px; color:#888">Aucune Catégorie enregistré pour l'instant!</p>
                            </td>
                        </tr>
                    @endif
                </tbody>
            </table>
        </div>
        <!-- /.box-body -->
    </div>
    <!-- /.box -->     
    
    <!-- modale ajouter une Catégorie -->
    <div id="createCategoryModal" class="modal fade" role="dialog">
        <div class="modal-dialog modal-lg">
            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <img class="col-lg-2 logoform" src="{{asset('images/logo.png')}}"/>
                    <h5 class="modal-title" id="exampleModalLabel">Création de la Catégorie</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form class="createform" lpformnum="1"  method="post" enctype="multipart/form-data" onsubmit="postSubmission()" action="{{ route ('create-category')}}">
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

     <!-- modale Modifier une Catégorie -->
     <div id="updateCategoryModal" class="modal fade" role="dialog">
        <div class="modal-dialog modal-lg">
            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <img class="col-lg-2 logoform" src="{{asset('images/logo.png')}}"/>
                    <h5 class="modal-title" id="exampleModalLabel">Mise à jour de la Catégorie</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form class="updateform" lpformnum="1"  method="post" enctype="multipart/form-data" onsubmit="postSubmissionUpdate()" action="{{ route ('update-category')}}">
                    <div class="modal-body">
                        @csrf
                        <input type="hidden" id="categoryid" name="id">
                        <div class="row">
                            <div class="col-lg-12 col-md-12 col-xs-12">
                                <p style="color: #888">Titre</p>
                                <div class="form-group label-floating" style="width: 100%;">
                                    <input class="form-control" id="categorytitle" name="title" placeholder="Titre" />
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