@extends('Admin::layout')
@section('content')
<main>
    <ul class="breadcrumbs">
        <li><a href="">Home</a></li>
        <li class="divider">/</li>
        <li><a href="" class="active">Profil</a></li>
    </ul>
    <div class="container">
        <div class="row">
            <div class="col-md-3">
                <div class="carte">
                    <a href="" class="active"><i class="bx bxs-user me-2 fs-6"></i>Profil</a>
                    <a href=""><i class="bx bxs-chat me-2 fs-6"></i>Message</a>
                    <a href=""><i class="bx bxs-bell me-2 fs-6"></i>Notification</a>
                </div>
            </div>
            <div class="col-md-9">
                <div class="card border shadow mb-5">
                    <div class="card-body border sahadow">
                        <div class="container">
                            {{-- les utilisateurs --}}
                                <div class="col-md-3">
                                    <div class="list-group">

                                        @foreach($users as $user)
                                        <a class="list-group-item d-flex justify-content-between align-items-center" href="{{ route('conversation_show', $user->id) }}">
                                            {{ $user->nom }}
                                            @if(isset($unread[$user->id]))
                                                
                                                    {{ $unread[$user->id] }}
                                                
                                            @endif
                                        </a>
                                        
                                    
                                        @endforeach
                                    </div>
                                </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>  
    </div>
    
</main> 
@endsection