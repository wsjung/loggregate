@extends('layouts.app')

@section('content')
<main role="main" class="container">
    <?php
    if(isset($created)) {
        echo '<div href="/home" class="alert alert-success alert-dismissible fade show" role="alert">
        <strong>Crispy guacamole!</strong>  Your new group  <strong>' . $studygroup[0]->groupName . '</strong> has been created!
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
        </button>
        </div>';
    }
    if(isset($overlap)) {
        echo '<div href="/home" class="alert alert-danger alert-dismissible fade show" role="alert">
          <strong>Crispy guacamole!</strong>  Your new group  <strong>' . $studygroup[0]->groupName . '</strong> was created, but there is another group at a partially or fully overlapping time!
          <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>';
    }
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
            <?php
            if($studygroup[0]->ownerID==\Auth::user()->id){
                echo '
                <div class="dropdown" align="right">
                <a class="btn btn-secondary droptown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><img src="images/gearicon.jpeg" alt="settings"></a>

                <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                <a class="dropdown-item" href="#" data-toggle="modal" data-target="#updateModal">Update Group Information</a>
                <a class="dropdown-item" href="#" data-toggle="modal" data-target="#deleteModal">Delete Group</a>
                </div>
                </div>

                ';
            }
            ?>
            <!-- modal for info update -->
            <div class="modal fade bd-example-modal-lg" id="updateModal" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
              <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
                <div class="modal-content">
                  <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Update Information</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                  </button>
              </div>
              <div class="modal-body">
                <form id="updateForm" action="{{ route('groupupdate',$studygroup[0]->groupID) }}" method="GET">
                  <div align="left" class="form-group">
                    <label for="recipient-name" class="col-form-label">Group Name:</label>
                    <input type="text" class="form-control col-md-5" name="groupName" id="recipient-name" value="{{ $studygroup[0]->groupName }}">
                </div>
                <div align="left" class="form-group">
                    <label for="message-text" class="col-form-label">Description:</label>
                    <textarea class="form-control" id="message-text" name="groupDesc">{{ $studygroup[0]->description }}</textarea>
                </div>
                <div class="row">
                  <div align="left" class="form-group col-md-10">
                    <label for="message-text" class="col-form-label">Day(s):</label>
                    <br>
                    <div>
                      <?php
                      // code for generating checkmarks for days of the week
                      $days = array('M','Tu','W','Th','F','Sa','Su');

                      foreach($days as $day) {
                        $a = '<label class="col-sm-1"><input type="checkbox" class="form-control" name="'.$day.'" value="'.$day.'"';

                        if(strpos($studygroup[0]->meetDay,$day)) {
                            $a .= ' checked';
                        }

                        $a .= '></input><br>'.$day.'</label>';
                        echo $a;
                    }
                    ?>
                </div>
            </div>
        </div>
        <div align="left" class="form-group">
            <label for="message-text" class="col-form-label">Time:</label>
            <input type="time" class="form-control" id="message-text" name="meetTime" value="{{ $studygroup[0]->meetTime }}"></textarea>
        </div>
        <div align="left" class="form-group">
            <label for="message-text" class="col-form-label">Location:</label>
            <input type="text" class="form-control" id="message-text" name="meetLocation" value="{{ $studygroup[0]->meetLocation }}"></input>
        </div>
    </form>
</div>
<div class="modal-footer">
    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
    <button type="submit" form="updateForm" class="btn btn-primary">Update</button>
</div>
</div>
</div>
</div>
<!-- Modal for deletion -->
<div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">Are you absolutely sure?</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
      </button>
  </div>
  <div class="modal-body" align="left">
    <p>This action cannot be undone.</p>This will permanently delete the <?php echo $studygroup[0]->groupName ?> study group, its info, and comments.
</div>
<div class="modal-footer">
    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
    <a href="{{ route('groupdelete',$studygroup[0]->groupID) }}"><button type="button" class="btn btn-danger">Delete <strong><?php echo $studygroup[0]->groupName ?></strong></button></a>
</div>
</div>
</div>
</div>
<h3 class="display-4"><?php echo $studygroup[0]->groupName; ?></h3>
<h4><b><?php echo $courses[0]->subject . ": " .
$courses[0]->courseNum; ?></b></h4>
<h5><b>Day(s):</b> <?php echo $studygroup[0]->meetDay ?>&nbsp <b>Time:</b> <?php echo $studygroup[0]->meetTime ?>&nbsp <b>Location:</b> <?php echo $studygroup[0]->meetLocation ?></h5>
<hr class="my-4">
<p align="center">
    <?php
    echo $studygroup[0]->description;

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
    <div>
        <h3>Group Posts</h3>
        <hr class=\"my-4\">
    </div>

    <?php
    if($memcheck > 0){
        echo "<form action=\"/grouphome/".$studygroup[0]->groupID."/comment\" method=\"GET\" class=\"needs-validation\" novalidate>
        <div class=\"row\">
        <div class=\"col-md-10 mb-3\">
        <input type=\"text\" class=\"form-control\" id=\"content\" name=\"content\" placeholder=\"\" value=\"\" required>
        <div class=\"invalid-feedback\">
        Content is required.
        </div>
        </div>
        <div class=\"col-md-2 mb-3\">
        <button class=\"btn btn-primary\" type=\"submit\">Post</button>
        </div>
        </div>
        </form>";
    }
    ?>
    
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
                                    <img width=\"50px\" height=\"50px\" src=/storage/avatars/".$users->where('id',$comment->id)->first()->avatar.">
                                    <a href=\"#\"><b>".$users->where('id',$comment->id)->first()->name."</b></a>
                                    made a post on ".substr($comment->timeStamp,0,5).".
                                </div>
                                <h6>".substr($comment->timeStamp,10,6)."&nbsp&nbsp&nbsp&nbsp". $comment->content."</h6>
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
