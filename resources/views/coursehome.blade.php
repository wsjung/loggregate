@extends('layouts.app')

@section('content')
<main role="main" class="container">
    <section class="jumbotron text-center">
            <div class="container">
              <h1 class="jumbotron-heading">[Course Name]</h1>
                <p>
                    <!-- Need to create conditional for subscription -->
                    <a href="#" class="btn btn-primary my-2">Subscribe</a>

                    @auth
                    <!-- Need to create conditional for authorized -->
                    <a href="{{ route('groupregister') }}" class="btn btn-secondary my-2">Create a Study Group</a>
                    @else
                    @endauth

                </p>
            </div>
        </section>
        <div class="album py-5 bg-light">
        <div class="container">

          <div class="row">
            <div class="col-md-4">
              <div class="card mb-4 shadow-sm">
                <p class="card-text-top" align="center">[Study Group Name]</p>
                <div class="card-body">
                  <p class="card-text">[Meet Day(s)]<br/>[Meet Time(s)]<br/>[Meet Location(s)]</p>
                  <div class="d-flex justify-content-between align-items-center">
                    <div class="btn-group">
                      <button type="button" class="btn btn-sm btn-outline-secondary">View</button>
                      <button type="button" class="btn btn-sm btn-outline-secondary">Subscribe</button>
                    </div>
                    <small class="text-muted">[Group Owner]</small>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-md-4">
              <div class="card mb-4 shadow-sm">
                <p class="card-text-top" align="center">[Study Group Name]</p>
                <div class="card-body">
                  <p class="card-text">[Meet Day(s)]<br/>[Meet Time(s)]<br/>[Meet Location(s)]</p>
                  <div class="d-flex justify-content-between align-items-center">
                    <div class="btn-group">
                      <button type="button" class="btn btn-sm btn-outline-secondary">View</button>
                      <button type="button" class="btn btn-sm btn-outline-secondary">Subscribe</button>
                    </div>
                    <small class="text-muted">[Group Owner]</small>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-md-4">
              <div class="card mb-4 shadow-sm">
                <p class="card-text-top" align="center">[Study Group Name]</p>
                <div class="card-body">
                  <p class="card-text">[Meet Day(s)]<br/>[Meet Time(s)]<br/>[Meet Location(s)]</p>
                  <div class="d-flex justify-content-between align-items-center">
                    <div class="btn-group">
                      <button type="button" class="btn btn-sm btn-outline-secondary">View</button>
                      <button type="button" class="btn btn-sm btn-outline-secondary">Subscribe</button>
                    </div>
                    <small class="text-muted">[Group Owner]</small>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
</main>
@endsection
