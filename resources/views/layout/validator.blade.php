@if(count($errors))
    <div class="alert alert-danger">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
        <ul>
            @foreach($errors -> all() as $error)
            <li>{{$error}}</li>
            @endforeach
        </ul>
        <audio id="chatAudio">
            <source src="audio/error.ogg" />
            <source src="audio/error.mp3" />
            <source src="audio/error.wav" />
        </audio>
        <?php
            echo "<script>$('#chatAudio')[0].play()</script>";
        ?>
    </div>
@endif