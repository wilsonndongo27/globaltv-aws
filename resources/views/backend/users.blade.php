@extends('backend.template')
@section('route')
<div class="col-12">
    <div class="page-title-box d-sm-flex align-items-center justify-content-between">
        <h4 class="mb-sm-0">Analytics</h4>

        <div class="page-title-right">
            <ol class="breadcrumb m-0">
                <li class="breadcrumb-item"><a href="javascript: void(0);">Dashboards</a></li>
                <li class="breadcrumb-item active">Utilisateurs</li>
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
                <h3 class="box-title">Liste des utilisateurs</h3>
                <h6 class="box-subtitle">Vous pouvez extraire ou imprimer la liste au format (excel, csv et pdf)</h6>
            </div>
            <div class="col-lg-4">
                <button class="btn btn-seconday addnew" id="newuser" data-bs-toggle="modal" 
                data-bs-target="#createUserModal">Ajouter</button>
            </div>
        </div>
        <!-- /.box-header -->
        <div class="box-body">
            <table class="table table-hover display nowrap margin-top-10 table-responsive global-data-table">
                <thead>
                    <tr>
                        <th>Photos</th>
                        <th>Noms</th>
                        <th>Téléphone</th>
                        <th>Email</th>
                        <th>Pays</th>
                        <th>Ville</th>
                        <th>Adresses</th>
                        <th>Status</th>
                        <th>></th>
                    </tr>
                </thead>
                <tbody>
                    @if ($allusers ?? '')
                        @foreach ($allusers as $item)
                            <tr>
                                <td class="imagecolumn">
                                    <a href="Javascript:void()" id="detailmodal"
                                    data-name="{{ $item->name }}"
                                    data-email="{{ $item->email }}"
                                    data-phone="{{ $item->phone }}"
                                    data-status="{{ $item->is_active }}"
                                    data-photo="{{ asset('storage/'.$item->pp) }}"
                                    >
                                        <img class="zoom"  style="border-radius: 100%;"
                                        @if ($item->pp) 
                                            src="{{ asset('storage/'.$item->pp) }}" 
                                        @else
                                            src="{{ asset('image/user-default.png') }}" 
                                        @endif 
                                        alt="{{$item->pp}}" alt="" />
                                    </a>
                                </td>
                                <td>{{ $item->name }}</td>
                                <td>{{ $item->phone }}</td>
                                <td>{{ $item->email }}</td>
                                <td>{{ $item->country }}</td>
                                <td>{{ $item->city }}</td>
                                <td>{{ $item->address }}</td>
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
                                                data-message="Le status de cet utilisateur sera mis à jour!"
                                                data-type="warning"
                                                data-url="{{ route ('status-user')}}"
                                                data-token="{{csrf_token()}}">
                                                <i class="ri-pencil-fill align-bottom me-2 text-muted"></i>  Activer/Désactiver</a>
                                            </li>
                                            <li>
                                                <a class="dropdown-item edit-item-btn" href="javascript:void()" 
                                                data-bs-toggle="modal" data-bs-target="#updateUserModal"
                                                data-id="{{ $item->id }}"
                                                data-name="{{ $item->name }}"
                                                data-email="{{ $item->email }}"
                                                data-phone="{{ $item->phone }}"
                                                data-country="{{ $item->country }}"
                                                data-countryid="{{ $item->countryid }}"
                                                data-state="{{ $item->state }}"
                                                data-stateid="{{ $item->stateid }}"
                                                data-city="{{ $item->city }}"
                                                data-cityid="{{ $item->cityid }}"
                                                data-address="{{ $item->address }}"
                                                data-type="{{ $item->type }}"
                                                data-pp="{{ asset('storage/'.$item->pp) }}">
                                                <i class="ri-pencil-fill align-bottom me-2 text-muted"></i> Modifier</a>
                                            </li>
                                            <li>
                                                <a class="dropdown-item edit-item-btn" href="javascript:void()"
                                                 data-bs-toggle="modal" data-bs-target="#updateUserPassword"
                                                 data-id="{{ $item->id }}">
                                                 <i class="ri-pencil-fill align-bottom me-2 text-muted"></i> Modifier le mot de passe
                                                </a>
                                            </li>
                                            <li>
                                                <a class="dropdown-item edit-item-btn deleteForm" 
                                                href="javascript:void()" 
                                                data-id="{{$item->id}}"
                                                data-message="Cet utilisateur sera supprimer!"
                                                data-type="warning"
                                                data-url="{{ route ('delete-user')}}"
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
                                <p style="font-size: 14px; margin-top:50px; color:#888">Aucun utilisateur enregistré pour l'instant!</p>
                            </td>
                        </tr>
                    @endif
                </tbody>
            </table>
        </div>
        <!-- /.box-body -->
    </div>
    <!-- /.box -->     
    
    <!-- modale ajouter un utilisateur -->
    <div id="createUserModal" class="modal fade" role="dialog">
        <div class="modal-dialog modal-lg">
            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <img class="col-lg-2 logoform" src="{{asset('images/logo.png')}}"/>
                    <h5 class="modal-title" id="exampleModalLabel">Création de l'utilisateur</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form class="createform" lpformnum="1"  method="post" enctype="multipart/form-data" action="{{ route ('create-user')}}">
                    <div class="modal-body">
                        @csrf
                        <div class="row">
                            <div class="col-lg-12 col-md-12 col-xs-12">
                                <p style="color: #888">Nom complet</p>
                                <div class="form-group label-floating" style="width: 100%;">
                                    <input class="form-control"  name="name" required placeholder="nom de l'utilisateur" />
                                    <hr>
                                </div>
                            </div>
                        </div>

                        
                        <div class="col-lg-12 col-md-12 col-xs-12">
                            <p style="color: #888">Type Utilisateur</p>
                            <div class="form-group label-floating" style="width: 100%;">
                                <select class="form-control" required name="type">
                                    <option value="">Selectionner le type d'utilisateur</option>
                                    <option value="1">Staff</option>
                                    <option value="2">Agent Support</option>
                                    <option value="3">Administrateur</option>
                                    <option value="4">Super Administrateur</option>
                                    <option value="5">Utilisateur API</option>
                                </select>
                            </div>
                        </div><hr>

                        <div class="row">
                            <div class="col-lg-6 col-md-12 col-xs-12">
                                <p style="color: #888">Pays</p>
                                <div class="form-group label-floating" style="width: 100%;">
                                    <select class="form-control" id="country-dropdown" required name="country" url="{{ route ('get-states-by-country')}}" token="{{csrf_token()}}">
                                        <option value="">Selectionner le pays</option>
                                        @foreach ($countries as $country) 
                                            <option value="{{$country->id}}">
                                                {{$country->name}}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-lg-6 col-md-12 col-xs-12">
                                <p style="color: #888">Région</p>
                                <div class="form-group label-floating" style="width: 100%;">
                                    <select class="form-control" id="state-dropdown" required name="state" url="{{ route ('get-cities-by-state')}}" token="{{csrf_token()}}">
                                        <option value="">Selectionner la Région</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <hr>

                        <div class="row">
                            <div class="col-lg-6 col-md-12 col-xs-12">
                                <p style="color: #888">Ville</p>
                                <div class="form-group label-floating" style="width: 100%;">
                                    <select class="form-control" name="city" id="city-dropdown" required>
                                        <option value="">Selectionner le pays</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-lg-6 col-md-12 col-xs-12">
                                <p style="color: #888">Adresse</p>
                                <div class="form-group label-floating" style="width: 100%;">
                                    <input type="text" class="form-control" name="address" required placeholder="adresse de l'utilisateur" />
                                    <hr>
                                </div>
                            </div>
                        </div>
                        <hr>

                        <div class="row">
                            <div class="col-lg-6 col-md-12 col-xs-12">
                                <p style="color: #888">Numéro de téléphone</p>
                                <div class="form-group label-floating" style="width: 100%;">
                                    <input type="number" class="form-control"  name="phone" required placeholder="numéro de téléphone de l'utilisateur" />
                                    <hr>
                                </div>
                            </div>
                            <div class="col-lg-6 col-md-12 col-xs-12">
                                <p style="color: #888">Adresse email</p>
                                <div class="form-group label-floating" style="width: 100%;">
                                    <input type="email" autocomplete="off" class="form-control" name="email" required placeholder="email de l'utilisateur" />
                                    <hr>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-lg-6 col-md-12 col-xs-12" >
                                <p style="color: #888">Mot de passe</p>
                                <div class="form-group label-floating"  id="show_hide_password" style="width: 100%;" >
                                    <input type="password" class="form-control" id="inputPassword" name="password" required  />
                                    <div class="input-group-addon hideviewpass">
                                        <a href="javacript:void()"><i class="fa fa-eye-slash" aria-hidden="true"></i></a>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6 col-md-12 col-xs-12" >
                                <p style="color: #888">Photo de profile</p>
                                <div class="form-group label-floating" style="width: 100%;" >
                                    <input type="file" class="form-control" id="photo" name="photo" required  />
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

    <!-- modale modifier un utilisateur -->
    <div id="updateUserModal" class="modal fade" role="dialog">
        <div class="modal-dialog modal-lg">
            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <img class="col-lg-2 logoform" src="{{asset('images/logo.png')}}"/>
                    <h5 class="modal-title" id="exampleModalLabel">Mettre à jour l'utilisateur</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form class="updateform" lpformnum="1"  method="post" enctype="multipart/form-data" action="{{ route ('update-user')}}">
                    <div class="modal-body">
                        @csrf
                        <input type="hidden" type="text" id="userid" name="id">
                        <div class="row">
                            <div class="col-lg-12 col-md-12 col-xs-12">
                                <p style="color: #888">Nom complet</p>
                                <div class="form-group label-floating" style="width: 100%;">
                                    <input class="form-control"  name="name" id="username" placeholder="nom de l'utilisateur" />
                                    <hr>
                                </div>
                            </div>
                        </div>

                        
                        <div class="col-lg-12 col-md-12 col-xs-12">
                            <p style="color: #888">Type Utilisateur</p>
                            <div class="form-group label-floating" style="width: 100%;">
                                <select class="form-control" name="type" id="usertype">
                                    <option value="">Selectionner le type d'utilisateur</option>
                                    <option value="1">Staff</option>
                                    <option value="2">Agent Support</option>
                                    <option value="3">Administrateur</option>
                                    <option value="4">Super Administrateur</option>
                                    <option value="5">Utilisateur API</option>
                                </select>
                            </div>
                        </div><hr>

                        <div class="row">
                            <div class="col-lg-6 col-md-12 col-xs-12">
                                <p style="color: #888">Pays</p>
                                <div class="form-group label-floating" style="width: 100%;">
                                    <select class="form-control usercountry" id="country-dropdown" name="country" url="{{ route ('get-states-by-country')}}" token="{{csrf_token()}}">
                                        <option value="">Selectionner le pays</option>
                                        @foreach ($countries as $country) 
                                            <option value="{{$country->id}}">
                                                {{$country->name}}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-lg-6 col-md-12 col-xs-12">
                                <p style="color: #888">Région</p>
                                <div class="form-group label-floating" style="width: 100%;">
                                    <select class="form-control userstate" id="state-dropdown" name="state" url="{{ route ('get-cities-by-state')}}" token="{{csrf_token()}}">
                                        <option value="">Selectionner la Région</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <hr>

                        <div class="row">
                            <div class="col-lg-6 col-md-12 col-xs-12">
                                <p style="color: #888">Ville</p>
                                <div class="form-group label-floating" style="width: 100%;">
                                    <select class="form-control usercity" name="city" id="city-dropdown">
                                        <option value="">Selectionner la ville</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-lg-6 col-md-12 col-xs-12">
                                <p style="color: #888">Adresse</p>
                                <div class="form-group label-floating" style="width: 100%;">
                                    <input type="text" class="form-control" id="useraddress" name="address" placeholder="adresse de l'utilisateur" />
                                    <hr>
                                </div>
                            </div>
                        </div>
                        <hr>

                        <div class="row">
                            <div class="col-lg-6 col-md-12 col-xs-12">
                                <p style="color: #888">Numéro de téléphone</p>
                                <div class="form-group label-floating" style="width: 100%;">
                                    <input type="number" class="form-control" id="userphone"  name="phone" placeholder="numéro de téléphone de l'utilisateur" />
                                    <hr>
                                </div>
                            </div>
                            <div class="col-lg-6 col-md-12 col-xs-12">
                                <p style="color: #888">Adresse email</p>
                                <div class="form-group label-floating" style="width: 100%;">
                                    <input type="email" id="useremail" autocomplete="off" class="form-control" name="email" placeholder="email de l'utilisateur" />
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
                                <p style="color: #888">Photo de profile</p>
                                <div class="form-group label-floating" style="width: 100%;" >
                                    <input type="file" class="form-control" id="photo" name="photo"  />
                                </div>
                            </div>
                        </div><hr>

                    </div>
                    <div class="modal-footer">
                        <button data-bs-dismiss="modal" aria-label="Close" class="btn btn-bg-secondary">Annuler</button>
                        <button type="submit" class="btn btn-primary newBtn buttomupdate">Sauvegarder</button>
                    </div>
                </form>

            </div>
        </div>
    </div>
    <!-- end popup -->

    <!-- modale modifier le mot de passe des utilisateurs -->
     <div id="updateUserPassword" class="modal fade" role="dialog">
        <div class="modal-dialog">
            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <img class="col-lg-2 logoform" src="{{asset('images/logo.png')}}"/>
                    <h5 class="modal-title" id="exampleModalLabel">Réinitialiser le mot de passe </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form class="updateform" lpformnum="1"  method="post" enctype="multipart/form-data" action="{{ route ('password-user')}}">
                    <div class="modal-body">
                        @csrf
                        <div class="row">
                            <div class="col-lg-12 col-md-12 col-xs-12" >
                                <p style="color: #888">Nouveau Mot de passe</p>
                                <div class="form-group label-floating"  id="show_hide_password" style="width: 100%;" >
                                    <input type="password" class="form-control" id="inputPassword" name="password1" required  />
                                    <div class="input-group-addon hideviewpass">
                                        <a href="javacript:void()"><i class="fa fa-eye-slash" aria-hidden="true"></i></a>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-12 col-md-12 col-xs-12" >
                                <p style="color: #888">Confirmer le Mot de passe</p>
                                <div class="form-group label-floating"  id="show_hide_password" style="width: 100%;" >
                                    <input type="password" class="form-control" id="inputPassword" name="password2" required  />
                                    <div class="input-group-addon hideviewpass">
                                        <a href="javacript:void()"><i class="fa fa-eye-slash" aria-hidden="true"></i></a>
                                    </div>
                                </div>
                            </div>
                        </div><hr>

                    </div>
                    <div class="modal-footer">
                        <button data-bs-dismiss="modal" aria-label="Close" class="btn btn-bg-secondary">Annuler</button>
                        <button type="submit" class="btn btn-primary newBtn updatecreate">Sauvegarder</button>
                    </div>
                </form>

            </div>
        </div>
    </div>
    <!-- end popup -->
</div>
@endsection