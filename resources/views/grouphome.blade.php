@extends('layouts.app')

@section('content')
<main role="main" class="container">
    <div class="jumbotron text-center">
        <div class="container">
            <h3 class="display-4"><?php echo $studygroup[0]->groupName; ?></h3>
            <h5>Meet Day: <?php echo $studygroup[0]->meetDay ?><br/>Meet Time: <?php echo $studygroup[0]->meetTime ?><br/>Meet Location: <?php echo $studygroup[0]->meetLocation ?></h5>
            <p align="center">
                <button class="btn btn-primary my-2">Join Group</button>
            </p>
        </div>
    </div>

    <div class="container">
    <div class="row">

        <div class="col-sm-8">
            <div class="panel panel-white post panel-shadow">
                <div class="post-heading">
                    <div class="pull-left meta">
                        <div class="title h5">
                            <a href="#"><b>Conor Muldoon</b></a>
                            made a post.
                        </div>
                        <h6 class="text-muted time">1 minute ago</h6>
                    </div>
                </div>
                <div class="post-description">
                    <p>Eat my ass Derek Albosta!!! Hahahaha see you in class buddy!</p>
                </div>
            </div>
        </div>
    </div>
</div>
</main>
@endsection
