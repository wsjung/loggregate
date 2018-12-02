@extends('layouts.app')

@section('content')
<main role="main" class="container">
    <?php 
    if(isset($join)) {
        echo '<div href="/home" class="alert alert-success alert-dismissible fade show" role="alert">
          <strong>Crispy guacamole!</strong>  You joined group <strong>' . $studygroup[0]->groupName . '</strong>. View them in the <a href="/home" ><u>home page</u></a>!
          <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>';
    }
    if(isset($leave)) {
        echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
          <strong>Crispy guacamole!</strong> Successfully left group <strong>' . $studygroup[0]->groupName . '</strong>.
          <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>';
    }
    ?>
    <div class="jumbotron text-center">
        <div class="container">
            <h3 class="display-4"><?php echo $studygroup[0]->groupName; ?></h3>
            <h5>Meet Day: <?php echo $studygroup[0]->meetDay ?><br/>Meet Time: <?php echo $studygroup[0]->meetTime ?><br/>Meet Location: <?php echo $studygroup[0]->meetLocation ?></h5>
            <p align="center">
                <?php
                    // check if user is group member
                    if($memcheck === 0) {
                        echo '<form action="/grouphome/'.$studygroup[0]->groupID.'/join"><button class="btn btn-primary my-2">Join Group</button></form>';
                    } else {
                        echo '<form action="/grouphome/'.$studygroup[0]->groupID.'/leave"><button class="btn btn-danger my-2">Leave Group</button></form>';
                    }
                ?>
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
