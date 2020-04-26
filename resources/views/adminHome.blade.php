@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-3">
            <ul class="nav nav-tabs flex-column" id="myTab" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link active" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="profile-tab" data-toggle="tab" href="#profile" role="tab" aria-controls="profile" aria-selected="false">Profile</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="contact-tab" data-toggle="tab" href="#contact" role="tab" aria-controls="contact" aria-selected="false">Create Post</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="edit-tab" data-toggle="tab" href="#edit" role="tab" aria-controls="edit" aria-selected="false">Edit Post</a>
                    </li>
            </ul>
        </div>

        <div class="col-md-9">
            <div class="tab-content" id="myTabContent">
                 <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
                     <div class="card">
                        <div class="card-header"><strong>Welcome Admin</strong> : <i>  You are logged in!</i></div>

                        <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif
                        <span class="fa-stack">
                                                <!-- The icon that will wrap the number -->
                                                <span class="fas fa-comment-o fa-stack-3x"></span>
                                                <!-- a strong element with the custom content, in this case a number -->
                                                <strong class="fa-stack-1x">
                                                   20 
                                                </strong>
                                            </span>
                        You are logged in!
                         </div>
                     </div>
                 </div>
                 <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">
                    <div class="card">
                        <div class="card-header"><strong>Profile</strong> </div>

                                <div class="card-body">
                                @if (session('status'))
                                    <div class="alert alert-success" role="alert">
                                        {{ session('status') }}
                                    </div>
                                @endif
                                <div class="table-responsive">
                                    <table class="table">
                                        <thead class="thead-dark">
                                            <tr>
                                            <th>Name</th>
                                            <th>Email</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($user as $u)
                                        <tr>
                                            <td>{{$u->name}}</th>
                                            <td>{{$u->email}}</th>
                                            </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                             </div>
                     </div>
                </div>
                <div class="tab-pane fade" id="contact" role="tabpanel" aria-labelledby="contact-tab">
                     <div class="card">
                        <div class="card-header"><strong>Create Post</strong> <i>{{session('mssg')}}</i></div>

                        <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif
                            <form action="adminHome" method="POST">
                                @csrf
                                        <div class="form-group">
                                        <label for="comment">Post title:</label> 
                                        <input  class="form-control"  type="text" rows="5" name="post_title"></input>
                                        <label >Write Post:</label>
                                        <textarea class="form-control" placeholder="write post" rows="5"  name="mes_post"></textarea>
                                        </div>
                                        
                                        <button type="submit" class="btn btn-dark">Submit</button>
                            </form>
                         </div>
                     </div>
                </div>
                <div class="tab-pane fade" id="edit" role="tabpanel" aria-labelledby="profile-tab">
                    <div class="card">
                        <div class="card-header"><strong>  Edit Post</strong> </div>

                                <div class="card-body">
                                @if (session('status'))
                                    <div class="alert alert-success" role="alert">
                                        {{ session('status') }}
                                    </div>
                                @endif
                                @foreach($post as $i)
                            
                            <div class="card">
                                    <div class="card-body">
                                        <h4 class="card-title">{{$i->post_title}}</h4>
                                        <hr>
                                        <p class="card-text">{{$i->mes_post}}.</p>
                                        
                                        <a href="#" class="card-link">{{$i->created_at}}</a>
                                      <form action="adminHome/{{$i->id}}" method="post">
                                      @csrf
                                      @method('DELETE')
                                      <button class="btn btn-danger">delete</button>
                                      </form>
                                       
                                        
                                    </div>
                                </div>
                            <br>
                                @endforeach
                            
                                </div>
                     </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
