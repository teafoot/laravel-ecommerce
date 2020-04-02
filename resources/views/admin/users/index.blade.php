@extends("admin.layouts.master")

@section("page")
  View Users
@endsection

@section("content")
  <div class="row">
    <div class="col-md-12">
      @include('admin.layouts.message')
      <div class="card">
        <div class="header">
          <h4 class="title">Users</h4>
          <p class="category">List of all registered users</p>
        </div>
        <div class="content table-responsive table-full-width">
          <table class="table table-striped">
            <thead>
              <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Email</th>
                <th>Registered At</th>
                <th>Status</th>
                <th>Actions</th>
              </tr>
            </thead>
            <tbody>
              @foreach($users as $user)
                <tr>
                  <td>{{ $user->id }}</td>
                  <td>{{ $user->name }}</td>
                  <td>{{ $user->email }}</td>
                  <td>{{ $user->created_at->diffForHumans() }}</td>
                  <td>
                    @if($user->status)
                      <span class="label label-success">Active</span>
                    @else
                      <span class="label label-danger">Blocked</span>  
                    @endif
                  </td>
                  <td>
                    {{ link_to_route('users.show', ' Order Details', $user->id, ['class' => 'btn btn-sm btn-primary ti-view-list-alt', 'title' => 'Details']) }}
                    @if($user->status)
                      {{ Form::open(['route' => ['users.block', $user->id], 'method' => 'post']) }}
                        {{ Form::button(' Block User', ['type' => 'submit', 'class' => 'btn btn-sm btn-danger ti-close']) }}
                      {{ Form::close() }}
                    @else
                      {{ Form::open(['route' => ['users.activate', $user->id], 'method' => 'post']) }}
                        {{ Form::button(' Activate User', ['type' => 'submit', 'class' => 'btn btn-sm btn-success ti-check']) }}
                      {{ Form::close() }}
                    @endif
                  </td>
                </tr>
              @endforeach
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
@endsection
