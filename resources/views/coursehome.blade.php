@extends('layouts.app')

@section('content')
<main role="main" class="container">
    <?php 
    if(isset($subbed)) {
        echo '<div href="/home" class="alert alert-success alert-dismissible fade show" role="alert">
          <strong>Crispy guacamole!</strong>  You subscribed to <strong>' . $courses->subject . ' : ' . $courses->courseNum . '</strong>. View them in the <a href="/home" ><u>home page</u></a>!
          <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>';
    }
    if(isset($unsubbed)) {
        echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
          <strong>Crispy guacamole!</strong> Successfully unsubscribed from  <strong>' . $courses->subject . ' : ' . $courses->courseNum . '</strong>.
          <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>';
    }
    ?>
    <section class="jumbotron text-center">
            <div class="container">
              <h1 class="jumbotron-heading"><?php echo $courses->name; ?></h1>
              <h3><?php echo $courses->subject . " " . $courses->courseNum; ?></h3>
                <p>
                    <!-- Need to create conditional for authorized -->
                    @auth
                    <?php
                        if($subscribed->where('courseID',$courses->courseID)->where('id', \Auth::user()->id)->count() === 0){
                            echo "
                                <form action=\"/sub/".$courses->courseID."\" method=\"GET\">
                                <button class=\"btn btn-primary my-2\">Subscribe</button>
                                <form>
                            ";
                        }
                        else /*if ($subscribed->where('courseID',$courses->courseID)->where('id', \Auth::user()->id)->count() === 1)*/{
                            echo "
                            <form action=\"/unsub/".$courses->courseID."\" method=\"GET\">
                            <button class=\"btn btn-primary my-2\">Unsubscribe</button>
                            <form>
                            ";

                            // can only create study group if subscribed to course.
                             
                            if($studygroup->count()===0) {
                              echo '<a href="/groupregister/'.$courses->courseID.'" id="createButton" class="btn btn-secondary my-2">Create a Study Group</a>';
                            } else {
                              echo '<a href="/groupregister/'.$courses->courseID.'" class="btn btn-secondary my-2">Create a Study Group</a>';
                            }
                        }
                    ?>
                    @else
                    @endauth
                </p>
                <?php
                if($studygroup->count()===0) { 
                  echo '<br><div class="alert alert-warning alert-dismissible fade show" role="alert">
                    <strong>Oh noes!</strong> Looks like there are no study groups right now</strong>.
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button>
                  </div>';
                  echo '<div class="alert alert-info alert-dismissible fade show" role="alert">
                    <strong></strong> Create the first study group for <strong>'.$courses->subject . ' : ' . $courses->courseNum .'</strong>!</strong>.
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button>
                  </div>';
                }
                ?>
            </div>
        </section>
        <div class="album py-5 bg-light">
        <div class="container">

          <div class="row">

            <?php
                foreach($studygroup as $sgroup){
                    echo "
                    <div class=\"col-md-4\">
                      <div class=\"card mb-4 shadow-sm\">
                        <h4 style=\"margin-top: 20px;\" class=\"card-text-top\" align=\"center\">" . $sgroup->groupName ."</h4>
                        <div class=\"card-body\">
                          <p class=\"card-text\">Meet Day(s): " . $sgroup->meetDay . "<br/>Meet Time: " . $sgroup->meetTime . "<br/>Meet Location: " . $sgroup->meetLocation . "</p>
                          <div class=\"d-flex justify-content-between align-items-center\">
                            <div class=\"btn-group\">
                                <a type=\"button\" class=\"btn btn-primary my-2\" href=\"/grouphome/".$sgroup->groupID."\">View Group</a>
                            </div>
                            <!--<small class=\"text-muted\">[Group Owner]</small>-->
                          </div>
                        </div>
                      </div>
                    </div>
                    ";
                }
            ?>
          </div>
        </div>
      </div>
</main>
@endsection
