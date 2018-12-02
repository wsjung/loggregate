@extends('layouts.app')

@section('content')
<main role="main" class="container">
    <div class="jumbotron text-center">
        <div class="container">
            <h3 class="display-4"><?php echo $studygroup[0]->groupName; ?></h3>
            <h5><b>Day(s):</b> <?php echo $studygroup[0]->meetDay ?>&nbsp <b>Time:</b> <?php echo $studygroup[0]->meetTime ?>&nbsp <b>Location:</b> <?php echo $studygroup[0]->meetLocation ?></h5>
             <hr class="my-4">
            <p align="center">
                <?php echo $studygroup[0]->description; ?>
            </p>
            <button class="btn btn-primary my-2">Join Group</button>
        </div>
    </div>

    <div class="container">
        <div>
            <h3>Group Posts</h3>
        </div>
    <div class="jumbotron">
        <?php
            foreach($comments as $comment){
                echo "
                 <hr class=\"my-4\">
                <div class=\"col-sm-8\">
                    <div class=\"panel panel-white post panel-shadow\">
                        <div class=\"post-heading\">
                            <div class=\"pull-left meta\">
                                <div class=\"title h6\">
                                    <a href=\"#\"><b>".$users->where('id',$comment->id)->first()->name."</b></a>
                                    made a post.
                                </div>
                                <h6>".$comment->timeStamp ."&nbsp&nbsp&nbsp". $comment->content."</h6>
                            </div>
                        </div>
                    </div>
                </div>
                ";
            }
        ?>
    </div>
</div>
</main>
@endsection
